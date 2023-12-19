<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['citas_especialidades'], 'r') !== FALSE) 
		{
			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'disponibilidad',  
				 	'join'  => array(
				 		'especialidades' => 'especialidades.id_especialidad = disponibilidad.id_especialidad', 
				 		'instituciones' => 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'personal' => 'personal.id_personal = disponibilidad.id_personal', 
				 		'tipos_persona' => 'tipos_persona.id_tipo_persona = personal.id_tipo_persona', 
				 	),  
				 	'order'  => 'disponibilidad.id_disponibilidad DESC',
				 	'return' => 'result', 
				);
				$data['especialidades'] = $this->crud->read($data['data']);

			}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'disponibilidad',  
				 	'join'  => array(
				 		'especialidades' => 'especialidades.id_especialidad = disponibilidad.id_especialidad', 
				 		'instituciones' => 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'personal' => 'personal.id_personal = disponibilidad.id_personal', 
				 		'tipos_persona' => 'tipos_persona.id_tipo_persona = personal.id_tipo_persona', 
				 	),  
				 	'where'  => 'disponibilidad.id_institucion ="'.$_SESSION['login']['id_institucion_actual'].'"',
				 	'order'  => 'disponibilidad.id_disponibilidad DESC',
				 	'return' => 'result', 
				);
				$data['especialidades'] = $this->crud->read($data['data']);
			}
			
			$data['titulo'] = 'Especialidades';
			$data['contenido'] = 'citas/especialidades/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function nuevo()
	{
		if( stripos($_SESSION['permiso']['citas_especialidades'], 'c') !== FALSE) 
		{
			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones',
				 	'join' 	=> array(
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'order'  => 'instituciones.id_institucion DESC',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);

				$data['personal'] = array();
			}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones',
				 	'join' 	=> array(
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'where'  => 'instituciones.id_institucion = '.$_SESSION['login']['id_institucion_actual'],
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);

				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'personal', 
				 	'join' 	=> array(
				 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
				 		'instituciones' 		=> 'instituciones.id_institucion = detalles_usuarios.id_institucion', 
				 		'perfiles' 				=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
				 		'tipos_persona'			=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
				 	),  
				 	'where'  => 'detalles_usuarios.id_institucion = "'.$_SESSION['login']['id_institucion_actual'].'"',
				 	'return' => 'result', 
				);
				$data['personal'] = $this->crud->read($data['data']);
			}

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'especialidades',  
			 	'where'  => 'especialidades.estado ="1"',
			 	'return' => 'result', 
			);
			$data['especialidades'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'dias', 
			 	'return' => 'result', 
			);
			$data['dias'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Nueva especialidad';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'citas/especialidades/nuevo';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function agregar()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('especialidades') == TRUE) 
	 		{
	 			$data['data'] = array(		  
	 				'especialidad'  	=> $especialidad,      
	 			);
	 			$data['table'] = 'especialidades';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'especialidades', 
				 	'where'  => 'especialidades.especialidad = "'.$especialidad.'"',
				 	'return' => 'row',
				);
				$resultado = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'especialidades',  
	 				'id'    		=> $resultado->id_especialidad, 
	 				'bitacora'		=> 'Especialidad registrada', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			$data['data'] = array(
				 	'select' 	=> '*', 
				 	'table'  	=> 'especialidades',
				 	'where'  	=> 'especialidades.estado ="1"',
				 	'return' 	=> 'result', 
				);
				$respuesta = $this->crud->read($data['data']);

				$options = array();
					$options[] = array( 
					'id' 		=> '0', 
					'opcion' 	=> 'Seleccione', 
				);				
				if ($respuesta != NULL) 
				{		
		 			foreach ($respuesta as $item) 
		 			{
		 				$options[] = array( 
		 					'id' 		=> $item->id_especialidad, 
		 					'opcion' 	=> $item->especialidad, 
		 				);
		 			}
				} 			

				$json = array(
		    		'status'    => 'select', 
		    		'info'    	=> 'Especialidades cargadas', 
		    		'ajax'    	=> $param, 
		    		'options'   => $options,   
		    	);
		    	echo json_encode($json);
	 		}
	 		else 
	 		{
	 			echo json_encode($this->form_validation->error_array());
	 		}
		} 
		else 
		{
			show_404();
		}
	}

	public function personal($param)
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 	
			$data['data'] = array(
			 	'select' => '*, detalles_usuarios.estado AS detalle_estado', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
			 		'instituciones' 		=> 'instituciones.id_institucion = detalles_usuarios.id_institucion', 
			 		'perfiles' 				=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
			 		'tipos_persona'			=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'detalles_usuarios.id_institucion = "'.$busqueda.'"',
			 	'order'  => 'personal.id_personal DESC',
			 	'return' => 'result', 
			);
			$respuesta = $this->crud->read($data['data']);

 			$options = array();
 			$options[] = array( 
				'id' 		=> '0', 
				'opcion' 	=> 'Seleccione', 
			);
 			if ($respuesta != NULL) {
 				
	 			foreach ($respuesta as $item) 
	 			{
	 				$options[] = array( 
	 					'id' 		=> $item->id_personal, 
	 					'opcion' 	=> substr($item->tipo_persona, 0,1).'-'.$item->cedula.', '.$item->nombres.' '.$item->apellidos, 
	 				);
	 			}
 			} 			

			$json = array(
        		'status'    => 'select', 
        		'info'    	=> 'Personal cargado', 
        		'ajax'    	=> $param, 
        		'options'   => $options,   
        	);
        	echo json_encode($json);		 				           
		} 
		else 
		{
			show_404();
		}
	}

	public function guardar()
	{
		//	solo peticiones AJAX permitidas
		if ($this->input->is_ajax_request()) 
		{
			//	se extraen los valores enviados mediante POST en variables llamadas igual a sus llaves 	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($id_especialidad == 0) {
	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => 'Debe seleccionar una especialidad', 
            	);
            	echo json_encode($json);
            	die();
	 		}

	 		if ($id_institucion == 0) {
	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => 'Debe seleccionar una institucion', 
            	);
            	echo json_encode($json);
            	die();
	 		}

	 		if ($id_personal == 0) {
	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => 'Debe seleccionar un medico especialista', 
            	);
            	echo json_encode($json);
            	die();
	 		}

	 		if(!isset($dia)){
	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => 'Debe seleccionar un dia e ingresar una hora de inicio y final', 
            	);
            	echo json_encode($json);
            	die();
	 		}

	 		if(isset($hora_inicio) || isset($hora_final)){
	 			$validacion = 0;
	 			foreach ($hora_inicio as $key => $value) {
	 				if($value == ''){ $validacion = 1;}
	 			}

	 			foreach ($hora_final as $key => $value) {
	 				if($value == ''){ $validacion = 1;}
	 			}	
	 		}

	 		if($validacion == 1){
	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => 'Debe ingresar una hora de inicio y final', 
            	);
            	echo json_encode($json);
            	die();
	 		}

 			$data = array(
	    		'select' => '*', 
	    		'table'  => 'disponibilidad', 
	    		'where'  => 'disponibilidad.id_especialidad ="'.$id_especialidad.'" 
	    			AND disponibilidad.id_institucion = "'.$id_institucion.'"
	    			AND disponibilidad.id_personal = "'.$id_personal.'"',
	    		'return'  => 'check'
	    	);
	    	if ($this->crud->read($data) == TRUE) 
	    	{
	    		$json = array(
            		'status'      => 'alert', 
            		'info'        => 'La especialidad tiene un horario en la institucion con el personal seleccionado', 
            	);
            	echo json_encode($json);
            	die();
	    	}
	    	else
	    	{
	 			$data['data'] = array(		 				 
	 				'id_especialidad'   => $id_especialidad,  
	 				'id_institucion'    => $id_institucion,  
	 				'id_personal'    	=> $id_personal,  
	 			);
	 			$data['table'] = 'disponibilidad';
	 			$this->crud->create($data);

	 			$data['disponibilidad'] = array(
		    		'select' => '*', 
		    		'table'  => 'disponibilidad', 
		    		'where'  => 'disponibilidad.id_especialidad ="'.$id_especialidad.'" 
		    			AND disponibilidad.id_institucion = "'.$id_institucion.'"
		    			AND disponibilidad.id_personal = "'.$id_personal.'"',
		    		'return'  => 'row'
		    	);
	 			$disponibilidad = $this->crud->read($data['disponibilidad']);

	 			foreach ($dia as $key => $value) {
	 				$data['data'] = array(		 				 
		 				'id_disponibilidad' => $disponibilidad->id_disponibilidad,  
		 				'dia'    		=> $value,  
		 				'hora_inicio'   => $hora_inicio[$key],  
		 				'hora_final'    => $hora_final[$key],  
		 			);
		 			$data['table'] = 'horarios';
		 			$this->crud->create($data);
	 			}

	 			$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'disponibilidad',  
	 				'id'    		=> $disponibilidad->id_disponibilidad, 
	 				'bitacora'		=> 'Especialidad registrada', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			if( stripos($_SESSION['permiso']['citas_especialidades'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Especialidad creada exitosamente!',  
	            		'redirect'  => base_url('citas/especialidades'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Especialidad creada exitosamente!',  
	            		'clearInputs'  => 'on',
	            		//'redirect'  => base_url('archivos/usuarios/nuevo'), 
	            	);
	            	echo json_encode($json);
	 			}
	    	}
	 		
		}
		//	sino, error 404  
		else 
		{
			show_404();
		}
	}

	public function editar($id)
	{
		if( stripos($_SESSION['permiso']['citas_especialidades'], 'u') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',    
			 	'where'  => 'disponibilidad.id_disponibilidad ="'.$id.'"',
			 	'return' => 'row', 
			);
			$disponibilidad = $data['disponibilidad'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'horarios',    
			 	'where'  => 'horarios.id_disponibilidad ="'.$id.'"',
			 	'return' => 'result', 
			);
			$data['horarios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'especialidades',  
			 	'where'  => 'especialidades.estado ="1"',
			 	'return' => 'result', 
			);
			$data['especialidades'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'dias', 
			 	'return' => 'result', 
			);
			$data['dias'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
			 		'instituciones' 		=> 'instituciones.id_institucion = detalles_usuarios.id_institucion', 
			 		'perfiles' 				=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
			 		'tipos_persona'			=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'detalles_usuarios.id_institucion = "'.$disponibilidad->id_institucion.'"',
			 	'return' => 'result', 
			);
			$data['personal'] = $this->crud->read($data['data']);

			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones',
				 	'join' 	=> array(
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'order'  => 'instituciones.id_institucion DESC',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);

			}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones',
				 	'join' 	=> array(
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'where'  => 'instituciones.id_institucion = '.$_SESSION['login']['id_institucion_actual'],
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			}			

			$data['titulo'] = 'Editar especialidad';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'citas/especialidades/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['citas_especialidades'], 'u') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',    
			 	'where'  => 'disponibilidad.id_disponibilidad ="'.$id.'"',
			 	'return' => 'row', 
			);
			$disponibilidad = $data['disponibilidad'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'horarios',    
			 	'where'  => 'horarios.id_disponibilidad ="'.$id.'"',
			 	'return' => 'result', 
			);
			$data['horarios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'especialidades',  
			 	'where'  => 'especialidades.estado ="1"',
			 	'return' => 'result', 
			);
			$data['especialidades'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'dias', 
			 	'return' => 'result', 
			);
			$data['dias'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
			 		'instituciones' 		=> 'instituciones.id_institucion = detalles_usuarios.id_institucion', 
			 		'perfiles' 				=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
			 		'tipos_persona'			=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'detalles_usuarios.id_institucion = "'.$disponibilidad->id_institucion.'"',
			 	'return' => 'result', 
			);
			$data['personal'] = $this->crud->read($data['data']);

			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones',
				 	'join' 	=> array(
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'order'  => 'instituciones.id_institucion DESC',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);

			}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones',
				 	'join' 	=> array(
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'where'  => 'instituciones.id_institucion = '.$_SESSION['login']['id_institucion_actual'],
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			}			

			if($disponibilidad->estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			
			$data['titulo'] = $accion.' especialidad';

			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'citas/especialidades/estado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function actualizar()
	{
		//	solo peticiones AJAX permitidas
		if ($this->input->is_ajax_request()) 
		{
			//	se extraen los valores enviados mediante POST en variables llamadas igual a sus llaves 	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		//	si el token es editar se procede a editar el usuario
	 		if ($token == 'editar') 
	 		{
		 		if ($id_especialidad == 0) {
		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Debe seleccionar una especialidad', 
	            	);
	            	echo json_encode($json);
	            	die();
		 		}

		 		if ($id_institucion == 0) {
		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Debe seleccionar una institucion', 
	            	);
	            	echo json_encode($json);
	            	die();
		 		}

		 		if ($id_personal == 0) {
		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Debe seleccionar un medico especialista', 
	            	);
	            	echo json_encode($json);
	            	die();
		 		}

		 		if(!isset($dia)){
		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Debe seleccionar un dia e ingresar una hora de inicio y final', 
	            	);
	            	echo json_encode($json);
	            	die();
		 		}

		 		if(isset($hora_inicio) || isset($hora_final)){
		 			$validacion = 0;
		 			foreach ($hora_inicio as $key => $value) {
		 				if($value == ''){ $validacion = 1;}
		 			}

		 			foreach ($hora_final as $key => $value) {
		 				if($value == ''){ $validacion = 1;}
		 			}	
		 		}

		 		if($validacion == 1){
		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Debe ingresar una hora de inicio y final', 
	            	);
	            	echo json_encode($json);
	            	die();
		 		}

		 		/*$data = array(
		    		'select' => '*', 
		    		'table'  => 'disponibilidad', 
		    		'where'  => 'disponibilidad.id_especialidad ="'.$id_especialidad.'" 
		    			AND disponibilidad.id_institucion = "'.$id_institucion.'"
		    			AND disponibilidad.id_personal = "'.$id_personal.'"',
		    		'return'  => 'check'
		    	);
		    	if ($this->crud->read($data) == TRUE) 
		    	{
		    		$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'La especialidad tiene un horario en la institucion con el personal seleccionado', 
	            	);
	            	echo json_encode($json);
	            	die();
		    	}*/		    		

	    		$data = array(
            		'table' => 'disponibilidad', 
            		'where' => 'disponibilidad.id_disponibilidad = '.$id, 
            	);
        		$data['set'] = array(
            		'id_especialidad'  	=> $id_especialidad,  
            		'id_institucion'  	=> $id_institucion,  
		 			'id_personal'  		=> $id_personal, 
            	);			    		            	
            	$this->crud->edit($data);
				    
			    $data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'disponibilidad',  
	 				'id'    		=> $id, 
	 				'bitacora'		=> 'Especialidad editada', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data); 

	 			$data['data'] = array(		 				 
	 				'table' => 'horarios',  
	 				'where' => 'horarios.id_disponibilidad ="'.$id.'"',  
	 			);
	 			$this->crud->erase($data['data']);

	 			foreach ($dia as $key => $value) {
	 				$data['data'] = array(		 				 
		 				'id_disponibilidad' => $id,  
		 				'dia'    		=> $value,  
		 				'hora_inicio'   => $hora_inicio[$key],  
		 				'hora_final'    => $hora_final[$key],  
		 			);
		 			$data['table'] = 'horarios';
		 			$this->crud->create($data);
	 			}

	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => '¡Especialidad editada exitosamente!',  
            		'redirect'  => base_url('citas/especialidades'), 
            		//'clearInputs'  => 'on',
            	);
            	echo json_encode($json);
	 			
	 		} 
	 		else 
	 		{
	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'disponibilidad',
				 	'where'  => 'disponibilidad.id_disponibilidad = '.$id, 
				 	'return' => 'row',
				);
				$disponibilidad = $this->crud->read($data['data']);

				if($disponibilidad->estado == '0')
				{
					$data = array(
	            		'table' => 'disponibilidad', 
	            		'where' => 'disponibilidad.id_disponibilidad = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'disponibilidad',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Especialidad activado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Especialidad activada exitosamente!',  
	            		'redirect'  => base_url('citas/especialidades'), 
	            	);
	            	echo json_encode($json);		 			
				}
				else
				{
					$data = array(
	            		'table' => 'disponibilidad', 
	            		'where' => 'disponibilidad.id_disponibilidad = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'disponibilidad',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Especialidad desactivado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Especialidad desactivada exitosamente!',  
	            		'redirect'  => base_url('citas/especialidades'), 
	            	);
	            	echo json_encode($json);
				}
	 		}
		}
		else 
		{
			show_404();
		}
	}


	
}
