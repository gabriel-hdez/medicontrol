<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		/*$this->load->library('CedulaVE');
		$data = $this->cedulave->get('V', '25880768');
		var_dump($data);*/

		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['registros_pacientes'], 'r') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = pacientes.id_tipo_persona', 
			 	), 
			 	'order'  => 'pacientes.id_paciente DESC',
			 	'return' => 'result', 
			);
			$data['pacientes'] = $this->crud->read($data['data']);
			
			$data['titulo'] = 'Pacientes';
			$data['contenido'] = 'registros/pacientes/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function agregar()
	{
		if( stripos($_SESSION['permiso']['registros_pacientes'], 'c') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'generos',
			 	'return' => 'result',
			);
			$data['generos'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parentescos',
			 	'return' => 'result',
			);
			$data['parentescos'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Nuevo paciente';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'registros/pacientes/agregar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	// Buscar representante por cedula
	public function representante()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'estados' 		=> 'pacientes.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'pacientes.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'pacientes.id_parroquia = parroquias.id_parroquia, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.cedula = "'.$cedula.'" AND pacientes.estado ="1"',  
			 	'return' => 'row', 
			);
			$representante = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'generos',
			 	'return' => 'result',
			);
			$data['generos'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$estados = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'return' => 'result',
			);
			$municipios = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'return' => 'result',
			);
			$parroquias = $this->crud->read($data['data']);

			if($representante != '')
			{
	 			$fechaNac = new DateTime($representante->fecha_nacimiento);
	 			$fechaActual = new DateTime();
	 			$diferencia = $fechaActual->diff($fechaNac);
	 			$edad = $diferencia->y;
	 			$edadMinima = 18;

			    // Si el representante es mayor de edad
			    if ($edad >= $edadMinima) 
			    {
		 			if ($representante->id_genero == "1") 
		 			{
		 				
		 				$sel_genero = array( 
		 					'1' => 'Femenino', 
		 					'2' => 'Masculino', 
		 				);	 			
		 			}
		 			else
		 			{
		 				$sel_genero = array( 
		 					'2' => 'Masculino', 
		 					'1' => 'Femenino', 
		 				);
		 			}

		 			if ($representante->id_tipo_persona == "1") 
		 			{
		 				
		 				$sel_nacionalidad = array( 
		 					'1' => 'Venezolana', 
		 					'2' => 'Extranjera', 
		 				);	 			
		 			}
		 			else
		 			{
		 				$sel_nacionalidad = array( 
		 					'2' => 'Extranjera', 
		 					'1' => 'Venezolana', 
		 				);
		 			}


		 			$sel_estado = array( 
	 					$representante->id_estado => $representante->nombre,
	 				);

		 			$sel_municipio = array( 
	 					$representante->id_municipio => $representante->municipio,
	 				);

	 				$sel_parroquia = array( 
	 					$representante->id_parroquia => $representante->parroquia,
	 				);
					
					$json = array(
			    		'fecha_nacimiento_r'	=> $representante->fecha_nacimiento, 
			    		'nombres_r'  			=> $representante->nombres, 
			    		'apellidos_r'  			=> $representante->apellidos, 
			    		'correo_r'  			=> $representante->correo, 
			    		'tlf_r'  				=> $representante->tlf, 
			    		'direccion_r'  			=> $representante->direccion, 
			    		
			    		'crear_select'	=> array(
			    			'#id_tipo_persona_r'=> $sel_nacionalidad, 
			    			'#id_genero_r' 		=> $sel_genero, 
			    			'#id_estado_r' 		=> $sel_estado, 
			    			'#id_municipio_r' 	=> $sel_municipio, 
			    			'#id_parroquia_r' 	=> $sel_parroquia, 
			    		),

			    		/*'seleccion_select'		=> array(
			    			'#genero_r' => 'f', 
			    		)*/
			    	);							
				    echo json_encode($json);
			    } 
			    else 
			    {
			   		// si es Menor de edad

			   		$sel_genero = array( 
 						'0' => 'Seleccione', 
	 					'1' => 'Femenino', 
	 					'2' => 'Masculino', 
	 				);

	 				$sel_estado = array( 
	 					'0' => 'Seleccione',
	 				);
		 			foreach ($estados as $item) 
		 			{		 				
		 				$sel_estado[$item->id_estado] = $item->nombre;				
		 			}

		 			$sel_municipio = array( 
	 					'0' => 'Seleccione',
	 				);

	 				$sel_parroquia = array( 
	 					'0' => 'Seleccione',
	 				);

					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'El representante debe ser mayor de edad', 

	            		'fecha_nacimiento_r'	=> '', 
			    		'nombres_r'  			=> '', 
			    		'apellidos_r'  			=> '', 
			    		'correo_r'  			=> '', 
			    		'tlf_r'  				=> '', 
			    		'direccion_r'  			=> '', 
			    		
			    		'crear_select'			=> array(
			    			'#id_genero_r' 	=> $sel_genero, 
			    			'#id_estado_r' 	=> $sel_estado, 
			    			'#id_municipio_r' 	=> $sel_municipio, 
			    			'#id_parroquia_r' 	=> $sel_parroquia, 
			    		),
	            	);
	            	echo json_encode($json);
	            	die();
			    }
			}
			else
			{
				$sel_genero = array( 
 					'0' => 'Seleccione', 
 					'1' => 'Femenino', 
 					'2' => 'Masculino', 
 				);

 				$sel_estado = array( 
 					'0' => 'Seleccione',
 				);
	 			foreach ($estados as $item) 
	 			{		 				
	 				$sel_estado[$item->id_estado] = $item->nombre;	 				
	 			}

	 			$sel_municipio = array( 
 					'0' => 'Seleccione',
 				);

 				$sel_parroquia = array( 
 					'0' => 'Seleccione',
 				);

				$json = array(
		    		'fecha_nacimiento_r'	=> '', 
		    		'nombres_r'  			=> '', 
		    		'apellidos_r'  			=> '', 
		    		'correo_r'  			=> '', 
		    		'tlf_r'  				=> '', 
		    		'direccion_r'  			=> '', 
		    		
		    		'crear_select'			=> array(
		    			'#id_genero_r' 	=> $sel_genero, 
		    			'#id_estado_r' 	=> $sel_estado, 
		    			'#id_municipio_r' 	=> $sel_municipio, 
		    			'#id_parroquia_r' 	=> $sel_parroquia, 
		    		),
		    	);
				echo json_encode($json);
			}

		} 
		else 
		{
			show_404();
		}
	}

	// Buscar paciente por cedula
	public function paciente()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'estados' 		=> 'pacientes.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'pacientes.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'pacientes.id_parroquia = parroquias.id_parroquia, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.cedula = "'.$cedula.'" AND pacientes.estado ="1"',  
			 	'return' => 'row', 
			);
			$paciente = $this->crud->read($data['data']);

			//var_dump($paciente); die();

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'generos',
			 	'return' => 'result',
			);
			$data['generos'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$estados = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'return' => 'result',
			);
			$municipios = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'return' => 'result',
			);
			$parroquias = $this->crud->read($data['data']);

			if($paciente != '')
			{
	 			/*$fechaNac = new DateTime($paciente->fecha_nacimiento);
	 			$fechaActual = new DateTime();
	 			$diferencia = $fechaActual->diff($fechaNac);
	 			$edad = $diferencia->y;
	 			$edadMinima = 18;

			    // Si el paciente es mayor de edad
			    if ($edad >= $edadMinima) 
			    {*/
		 			if ($paciente->id_genero == "1") 
		 			{
		 				
		 				$sel_genero = array( 
		 					'1' => 'Femenino', 
		 					'2' => 'Masculino', 
		 				);	 			
		 			}
		 			else
		 			{
		 				$sel_genero = array( 
		 					'2' => 'Masculino', 
		 					'1' => 'Femenino', 
		 				);
		 			}

		 			if ($paciente->id_tipo_persona == "1") 
		 			{
		 				
		 				$sel_nacionalidad = array( 
		 					'1' => 'Venezolana', 
		 					'2' => 'Extranjera', 
		 				);	 			
		 			}
		 			else
		 			{
		 				$sel_nacionalidad = array( 
		 					'2' => 'Extranjera', 
		 					'1' => 'Venezolana', 
		 				);
		 			}

		 			$sel_estado = array( 
	 					$paciente->id_estado => $paciente->nombre,
	 				);

		 			$sel_municipio = array( 
	 					$paciente->id_municipio => $paciente->municipio,
	 				);

	 				$sel_parroquia = array( 
	 					$paciente->id_parroquia => $paciente->parroquia,
	 				);
					
					$json = array(
			    		'fecha_nacimiento'	=> $paciente->fecha_nacimiento, 
			    		'nombres'  			=> $paciente->nombres, 
			    		'apellidos'  		=> $paciente->apellidos, 
			    		'correo'  			=> $paciente->correo, 
			    		'tlf'  				=> $paciente->tlf, 
			    		'direccion'  		=> $paciente->direccion, 
			    		
			    		'crear_select'	=> array(
			    			'#id_tipo_persona'	=> $sel_nacionalidad, 
			    			'#id_genero' 		=> $sel_genero, 
			    			'#id_estado' 		=> $sel_estado, 
			    			'#id_municipio' 	=> $sel_municipio, 
			    			'#id_parroquia' 	=> $sel_parroquia, 
			    		),

			    		/*'seleccion_select'		=> array(
			    			'#genero_r' => 'f', 
			    		)*/
			    	);							
				    echo json_encode($json);
			    /*} 
			    else 
			    {
			   		// si es Menor de edad

			   		$sel_genero = array( 
 						'0' => 'Seleccione', 
	 					'1' => 'Femenino', 
	 					'2' => 'Masculino', 
	 				);

	 				$sel_estado = array( 
	 					'0' => 'Seleccione',
	 				);
		 			foreach ($estados as $item) 
		 			{		 				
		 				$sel_estado[$item->id_estado] = $item->nombre;				
		 			}

		 			$sel_municipio = array( 
	 					'0' => 'Seleccione',
	 				);

	 				$sel_parroquia = array( 
	 					'0' => 'Seleccione',
	 				);

					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'El paciente debe ser mayor de edad', 

	            		'fecha_nacimiento'	=> '', 
			    		'nombres'  			=> '', 
			    		'apellidos'  		=> '', 
			    		'correo'  			=> '', 
			    		'tlf'  				=> '', 
			    		'direccion'  		=> '', 
			    		
			    		'crear_select'		=> array(
			    			'#id_genero' 	=> $sel_genero, 
			    			'#id_estado' 	=> $sel_estado, 
			    			'#id_municipio' 	=> $sel_municipio, 
			    			'#id_parroquia' 	=> $sel_parroquia, 
			    		),
	            	);
	            	echo json_encode($json);
	            	die();
			    }*/
			}
			else
			{
				$sel_genero = array( 
 					'0' => 'Seleccione', 
 					'1' => 'Femenino', 
 					'2' => 'Masculino', 
 				);

 				$sel_estado = array( 
 					'0' => 'Seleccione',
 				);
	 			foreach ($estados as $item) 
	 			{		 				
	 				$sel_estado[$item->id_estado] = $item->nombre;	 				
	 			}

	 			$sel_municipio = array( 
 					'0' => 'Seleccione',
 				);

 				$sel_parroquia = array( 
 					'0' => 'Seleccione',
 				);

				$json = array(
		    		'fecha_nacimiento'	=> '', 
		    		'nombres'  			=> '', 
		    		'apellidos'  		=> '', 
		    		'correo'  			=> '', 
		    		'tlf'  				=> '', 
		    		'direccion'  		=> '', 
		    		
		    		'crear_select'		=> array(
		    			'#id_genero' 	=> $sel_genero, 
		    			'#id_estado' 	=> $sel_estado, 
		    			'#id_municipio' 	=> $sel_municipio, 
		    			'#id_parroquia' 	=> $sel_parroquia, 
		    		),
		    	);
				echo json_encode($json);
			}

		} 
		else 
		{
			show_404();
		}
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('pacientes') == TRUE) 
	 		{
	 			if($id_genero == '0')
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Seleccione el genero', 
	            	);
	            	echo json_encode($json);
	            	die();
	 			}

	 			if($id_estado == '0')
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Seleccione el estado', 
	            	);
	            	echo json_encode($json);
	            	die();
	 			}

	 			if($id_municipio == '0')
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Seleccione el municipio', 
	            	);
	            	echo json_encode($json);
	            	die();
	 			}

	 			if($id_parroquia == '0')
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Seleccione la parroquia', 
	            	);
	            	echo json_encode($json);
	            	die();
	 			}

	 			$fechaNac = new DateTime($fecha_nacimiento);
	 			$fechaActual = new DateTime();
	 			$diferencia = $fechaActual->diff($fechaNac);
	 			$edad = $diferencia->y;
	 			$edadMinima = 18;

			    // si es menor de edad, primero se valida el representante
			    if ($edad <= $edadMinima) 
			    {
			    	if($id_parentesco == '0')
		 			{
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => 'Seleccione el parentesco con el paciente', 
		            	);
		            	echo json_encode($json);
		            	die();
		 			}

		 			$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'usuarios', 
					 	'where'  => 'usuarios.correo = "'.$correo_r.'"',
					 	'return' => 'row',
					);
					$representante = $this->crud->read($data['data']);

					if($representante == null)
					{
						$data['data'] = array(	
			 				'usuario'  	=> $correo_r,  
			 				'clave'  	=> $this->encryption->encrypt($cedula_r),    
			 				'correo'  	=> $correo_r,  
			 				'tlf'  		=> $tlf_r, 
			 				'pregunta' 	=> $this->encryption->encrypt('Confirme su numero de telefono'),  
			 				'respuesta' => $this->encryption->encrypt($tlf_r), 
			 			);
			 			$data['table'] = 'usuarios';
			 			$this->crud->create($data);

			 			$data['data'] = array(
						 	'select' => '*', 
						 	'table'  => 'usuarios', 
						 	'where'  => 'usuarios.correo = "'.$correo_r.'"',
						 	'return' => 'row',
						);
						$usuario = $this->crud->read($data['data']);
			
						$data['data'] = array(		 				 
			 				'responsable'   => $_SESSION['login']['id_usuario'], 
			 				'tabla'   		=> 'usuarios',  
			 				'id'    		=> $usuario->id_usuario, 
			 				'bitacora'		=> 'Usuario registrado', 
			 			);
			 			$data['table'] = 'bitacora';
			 			$this->crud->create($data);

			 			$data['data'] = array(		    
			 				'id_tipo_persona'  	=> $id_tipo_persona_r,   
			 				'cedula'  			=> $cedula_r,   
			 				'nombres'  			=> $nombres_r,   
			 				'apellidos'  		=> $apellidos_r,   
			 				'fecha_nacimiento'  => $fecha_nacimiento_r,   
			 				'id_genero'  		=> $id_genero_r,    
			 				'id_estado'  		=> $id_estado_r,   
			 				'id_municipio'  	=> $id_municipio_r,   
			 				'id_parroquia'  	=> $id_parroquia_r,   
			 				'direccion'  		=> $direccion_r   
			 			);
			 			$data['table'] = 'pacientes';
			 			$this->crud->create($data);
			 			
		 				$data['data'] = array(
						 	'select' => '*', 
						 	'table'  => 'pacientes', 
						 	'where'  => 'pacientes.fecha_nacimiento = "'.$fecha_nacimiento_r.'" AND 
						 	pacientes.id_tipo_persona = "'.$id_tipo_persona_r.'" AND 
						 	pacientes.cedula = "'.$cedula_r.'" AND 
						 	pacientes.nombres = "'.$nombres_r.'" AND 
						 	pacientes.apellidos = "'.$apellidos_r.'" AND 
						 	pacientes.id_genero = "'.$id_genero_r.'" AND 
						 	pacientes.id_estado = "'.$id_estado_r.'" AND 
						 	pacientes.id_municipio = "'.$id_municipio_r.'" AND 
						 	pacientes.id_parroquia = "'.$id_parroquia_r.'" AND 
						 	pacientes.direccion = "'.$direccion_r.'" ',
						 	'return' => 'row',
						);
						$representante = $this->crud->read($data['data']);
			 			
						$data['data'] = array(		 				 
			 				'responsable'   => $_SESSION['login']['id_usuario'], 
			 				'tabla'   		=> 'pacientes',  
			 				'id'    		=> $representante->id_paciente, 
			 				'bitacora'		=> 'Paciente registrado', 
			 			);
			 			$data['table'] = 'bitacora';
			 			$this->crud->create($data);
			 			
			 			$data['data'] = array(	
			 				'id_perfil'  		=> 2,  
			 				'id_usuario'  		=> $usuario->id_usuario,    
			 				'id'  				=> $representante->id_paciente,  
			 				'id_institucion'	=> 0 
			 			);
			 			$data['table'] = 'detalles_usuarios';
			 			$this->crud->create($data);
					}

					$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'pacientes', 
					 	'join' 	=> array(
					 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
					 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
					 	), 
					 	'where'  => 'usuarios.correo = "'.$correo_r.'"',
					 	'return' => 'row',
					);
					$representante = $this->crud->read($data['data']);
			    } 

			    $data['data'] = array(	  
	 				'usuario'  	=> $correo,  
	 				'clave'  	=> $this->encryption->encrypt($cedula),    
	 				'correo'  	=> $correo,  
	 				'tlf'  		=> $tlf, 
	 				'pregunta' 	=> $this->encryption->encrypt('Confirme su numero de telefono'),  
	 				'respuesta' => $this->encryption->encrypt($tlf), 
	 			);
	 			$data['table'] = 'usuarios';
	 			$this->crud->create($data);

	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'usuarios', 
				 	'where'  => 'usuarios.correo = "'.$correo.'"',
				 	'return' => 'row',
				);
				$usuario = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'usuarios',  
	 				'id'    		=> $usuario->id_usuario, 
	 				'bitacora'		=> 'Usuario registrado', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			$data['data'] = array(		   
	 				'id_tipo_persona'  	=> $id_tipo_persona,   
	 				'cedula'  			=> $cedula,   
	 				'nombres'  			=> $nombres,   
	 				'apellidos'  		=> $apellidos,   
	 				'fecha_nacimiento'  => $fecha_nacimiento,   
	 				'id_genero'  		=> $id_genero,    
	 				'id_estado'  		=> $id_estado,   
	 				'id_municipio'  	=> $id_municipio,   
	 				'id_parroquia'  	=> $id_parroquia,   
	 				'direccion'  		=> $direccion   
	 			);
	 			$data['table'] = 'pacientes';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'pacientes', 
				 	'where'  => 'pacientes.fecha_nacimiento = "'.$fecha_nacimiento.'" AND 
				 	pacientes.id_tipo_persona = "'.$id_tipo_persona.'" AND 
				 	pacientes.cedula = "'.$cedula.'" AND 
				 	pacientes.nombres = "'.$nombres.'" AND 
				 	pacientes.apellidos = "'.$apellidos.'" AND 
				 	pacientes.id_genero = "'.$id_genero.'" AND 
				 	pacientes.id_estado = "'.$id_estado.'" AND 
				 	pacientes.id_municipio = "'.$id_municipio.'" AND 
				 	pacientes.id_parroquia = "'.$id_parroquia.'" AND 
				 	pacientes.direccion = "'.$direccion.'" ',
				 	'return' => 'row',
				);
				$paciente = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'pacientes',  
	 				'id'    		=> $paciente->id_paciente, 
	 				'bitacora'		=> 'Paciente registrado', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			$data['data'] = array(	
	 				'id_perfil'  		=> 2,  
	 				'id_usuario'  		=> $usuario->id_usuario,    
	 				'id'  				=> $paciente->id_paciente,  
	 				'id_institucion'	=> 0 
	 			);
	 			$data['table'] = 'detalles_usuarios';
	 			$this->crud->create($data);

	 			if ($edad <= $edadMinima) 
			    {
			    	$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'representantes', 
					 	'where'  => 'representantes.id_paciente = "'.$paciente->id_paciente.'" AND 
					 	representantes.id_representante = "'.$representante->id_paciente.'" ',
					 	'return' => 'row',
					);
					$resultado = $this->crud->read($data['data']);

					if($resultado == null)
					{
						$data['data'] = array(		 				 
			 				'id_paciente'   	=> $paciente->id_paciente, 
			 				'id_representante' 	=> $representante->id_paciente,  
			 				'id_parentesco'    	=> $id_parentesco, 
			 			);
			 			$data['table'] = 'representantes';
			 			$this->crud->create($data);

					}
			    }

	 			if( stripos($_SESSION['permiso']['registros_pacientes'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Paciente creado exitosamente!',  
	            		'redirect'  => base_url('registros/pacientes'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Paciente creado exitosamente!',  
	            		'clearInputs'  => 'on',
	            	);
	            	echo json_encode($json);
	 			}
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

	public function editar($id)
	{
		if( stripos($_SESSION['permiso']['registros_pacientes'], 'u') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*, pacientes.id_paciente AS id_paciente', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'estados' 		=> 'pacientes.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'pacientes.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'pacientes.id_parroquia = parroquias.id_parroquia, LEFT', 
			 		'representantes'	=> 'pacientes.id_paciente = representantes.id_paciente, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.id_paciente = "'.$id.'"',  
			 	'return' => 'row', 
			);
			$paciente = $data['paciente'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'generos',
			 	'return' => 'result',
			);
			$data['generos'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'where'  => 'municipios.id_estado = "'.$paciente->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios_paciente'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$paciente->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias_paciente'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'estados' 		=> 'pacientes.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'pacientes.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'pacientes.id_parroquia = parroquias.id_parroquia, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.id_paciente = "'.$paciente->id_representante.'"',  
			 	'return' => 'row', 
			);
			$representante = $data['representante'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parentescos',
			 	'return' => 'result',
			);
			$data['parentescos'] = $this->crud->read($data['data']);

			if($representante != null)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'municipios',
				 	'where'  => 'municipios.id_estado = "'.$representante->id_estado.'"',  
				 	'return' => 'result',
				);
				$data['municipios_representante'] = $this->crud->read($data['data']);
				
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'parroquias',
				 	'where'  => 'parroquias.id_municipio = "'.$representante->id_municipio.'"',  
				 	'return' => 'result',
				);
				$data['parroquias_representante'] = $this->crud->read($data['data']);
			}
			

			$data['titulo'] = 'Editar paciente';
			$data['contenido'] = 'registros/pacientes/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['registros_pacientes'], 'd') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*, pacientes.id_paciente AS id_paciente', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'estados' 		=> 'pacientes.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'pacientes.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'pacientes.id_parroquia = parroquias.id_parroquia, LEFT', 
			 		'representantes'	=> 'pacientes.id_paciente = representantes.id_paciente, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.id_paciente = "'.$id.'"',  
			 	'return' => 'row', 
			);
			$paciente = $data['paciente'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'generos',
			 	'return' => 'result',
			);
			$data['generos'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'where'  => 'municipios.id_estado = "'.$paciente->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios_paciente'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$paciente->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias_paciente'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'pacientes', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'estados' 		=> 'pacientes.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'pacientes.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'pacientes.id_parroquia = parroquias.id_parroquia, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.id_paciente = "'.$paciente->id_representante.'"',  
			 	'return' => 'row', 
			);
			$representante = $data['representante'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parentescos',
			 	'return' => 'result',
			);
			$data['parentescos'] = $this->crud->read($data['data']);

			if($representante != null)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'municipios',
				 	'where'  => 'municipios.id_estado = "'.$representante->id_estado.'"',  
				 	'return' => 'result',
				);
				$data['municipios_representante'] = $this->crud->read($data['data']);
				
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'parroquias',
				 	'where'  => 'parroquias.id_municipio = "'.$representante->id_municipio.'"',  
				 	'return' => 'result',
				);
				$data['parroquias_representante'] = $this->crud->read($data['data']);
			}

			if($paciente->estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			
			$data['titulo'] = $accion.' paciente';
			$data['contenido'] = 'registros/pacientes/estado';
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
	 			//	si pasa las validaciones a los inputs, ver config/form_validation.php
	 			if ($this->form_validation->run('pacientes_editar') == TRUE) 
	 			{
	 				//	se verifica el usuario como campo unico pero igual al existente
	 				$data = array(
			    		'select' => '*', 
			    		'table'  => 'pacientes', 
			    		'join' 	=> array(
					 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 				'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
					 	), 
			    		'where'  => 'detalles_usuarios.id_institucion = "0" AND usuarios.correo ="'.$correo.'" AND usuarios.id_usuario <> "'.$id_usuario_paciente.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('correo' => 'El correo electrónico ya existe');
	            		echo json_encode($json);
	            		die();
			    	}
			    	$data = array(
			    		'select' => '*', 
			    		'table'  => 'pacientes',  
			    		'where'  => 'pacientes.cedula ="'.$cedula.'" AND pacientes.id_paciente <> '.$id_paciente.'',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('cedula' => 'La cedula ya existe');
	            		echo json_encode($json);
	            		die();
			    	}

			    	if(isset($id_representante))
			    	{
				    	$data = array(
				    		'select' => '*', 
				    		'table'  => 'pacientes', 
				    		'join' 	=> array(
						 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 					'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
						 	), 
				    		'where'  => 'detalles_usuarios.id_institucion = "0" AND usuarios.correo ="'.$correo_r.'" AND usuarios.id_usuario <> "'.$id_usuario_representante.'"',
				    		'return'  => 'check'
				    	);
				    	if ($this->crud->read($data) == TRUE) 
				    	{
				    		$json = array('correo_r' => 'El correo electrónico ya existe');
		            		echo json_encode($json);
		            		die();
				    	} 
				    	
				    	$data = array(
				    		'select' => '*', 
				    		'table'  => 'pacientes', 
				    		'join' 	=> array(
						 		'detalles_usuarios'	=> 'detalles_usuarios.id = pacientes.id_paciente, LEFT', 
			 					'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
						 	), 
				    		'where'  => 'detalles_usuarios.id_institucion = "0" AND pacientes.cedula ="'.$cedula_r.'" AND pacientes.id_paciente <> "'.$id_representante.'"',
				    		'return'  => 'check'
				    	);
				    	if ($this->crud->read($data) == TRUE) 
				    	{
				    		$json = array('cedula_r' => 'La cedula ya existe');
		            		echo json_encode($json);
		            		die();
				    	} 
			    	} 

		    		$data = array(
	            		'table' => 'usuarios', 
	            		'where' => 'usuarios.id_usuario = '.$id_usuario_paciente, 
	            	);
            		$data['set'] = array(
	            		'correo'  	=> $correo,  
			 			'tlf'  		=> $tlf, 
	            	);			    		            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'usuarios',  
		 				'id'    		=> $id_usuario_paciente, 
		 				'bitacora'		=> 'Usuario editado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data); 

		 			$data = array(
	            		'table' => 'pacientes', 
	            		'where' => 'pacientes.id_paciente = '.$id_paciente, 
	            	);
            		$data['set'] = array(
		 				'id_tipo_persona'  	=> $id_tipo_persona,   
		 				'cedula'  			=> $cedula,   
	            		'fecha_nacimiento'  => $fecha_nacimiento,   
		 				'nombres'  			=> $nombres,   
		 				'apellidos'  		=> $apellidos,   
		 				'id_genero'  		=> $id_genero,    
		 				'id_estado'  		=> $id_estado,   
		 				'id_municipio'  	=> $id_municipio,   
		 				'id_parroquia'  	=> $id_parroquia,   
		 				'direccion'  		=> $direccion 
	            	);			    		            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'pacientes',  
		 				'id'    		=> $id_paciente, 
		 				'bitacora'		=> 'Paciente editado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data); 

		 			if(isset($id_representante))
		 			{
			 			$data = array(
		            		'table' => 'usuarios', 
		            		'where' => 'usuarios.id_usuario = '.$id_usuario_representante, 
		            	);
	            		$data['set'] = array(
		            		'correo'  	=> $correo_r,  
				 			'tlf'  		=> $tlf_r, 
		            	);			    		            	
		            	$this->crud->edit($data); 

			 			$data = array(
		            		'table' => 'pacientes', 
		            		'where' => 'pacientes.id_paciente = '.$id_representante, 
		            	);
	            		$data['set'] = array(
			 				'id_tipo_persona'  	=> $id_tipo_persona_r,   
			 				'cedula'  			=> $cedula_r,   
		            		'fecha_nacimiento'  => $fecha_nacimiento_r,   
			 				'nombres'  			=> $nombres_r,   
			 				'apellidos'  		=> $apellidos_r,   
			 				'id_genero'  		=> $id_genero_r,    
			 				'id_estado'  		=> $id_estado_r,   
			 				'id_municipio'  	=> $id_municipio_r,   
			 				'id_parroquia'  	=> $id_parroquia_r,   
			 				'direccion'  		=> $direccion_r 
		            	);			    		            	
		            	$this->crud->edit($data); 

		            	$data = array(
		            		'table' => 'representantes', 
		            		'where' => 'representantes.id_paciente = "'.$id_paciente.'" AND representantes.id_representante = "'.$id_representante.'"', 
		            	);
	            		$data['set'] = array(
		            		'id_parentesco'  	=> $id_parentesco,   
		            	);			    		            	
		            	$this->crud->edit($data); 
		 			}


		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Paciente editado exitosamente!',  
	            		'redirect'  => base_url('registros/pacientes'), 
	            		//'clearInputs'  => 'on',
	            	);
	            	echo json_encode($json);
		            		
	 			} 
	 			else 
	 			{
	 				echo json_encode($this->form_validation->error_array());
	 			}
	 		//	sino se procede a eliminar o restaurar el usuario
	 		} 
	 		else 
	 		{
	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'pacientes',
				 	'where'  => 'pacientes.id_paciente = '.$id, 
				 	'return' => 'row',
				);
				$institucion = $this->crud->read($data['data']);

				if($institucion->estado == '0')
				{
					$data = array(
	            		'table' => 'pacientes', 
	            		'where' => 'pacientes.id_paciente = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'pacientes',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Paciente activado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Paciente activado exitosamente!',  
	            		'redirect'  => base_url('registros/pacientes'), 
	            	);
	            	echo json_encode($json);		 			
				}
				else
				{
					$data = array(
	            		'table' => 'pacientes', 
	            		'where' => 'pacientes.id_paciente = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'pacientes',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Paciente desactivado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Paciente desactivado exitosamente!',  
	            		'redirect'  => base_url('registros/pacientes'), 
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
