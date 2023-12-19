<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['registros_personal'], 'r') !== FALSE) 
		{
			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*, detalles_usuarios.estado AS detalle_estado', 
				 	'table'  => 'personal', 
				 	'join' 	=> array(
				 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
				 		'instituciones' 		=> 'instituciones.id_institucion = detalles_usuarios.id_institucion', 
				 		'perfiles' 				=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
				 		'tipos_persona'			=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
				 	),  
				 	'where'  => 'detalles_usuarios.id_institucion <> 0 ',
				 	'order'  => 'personal.id_personal DESC',
				 	'return' => 'result', 
				);
				$data['personal'] = $this->crud->read($data['data']);

			}
			else
			{
				$data['data'] = array(
				 	'select' => '*, detalles_usuarios.estado AS detalle_estado', 
				 	'table'  => 'personal', 
				 	'join' 	=> array(
				 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
				 		'instituciones' 		=> 'instituciones.id_institucion = detalles_usuarios.id_institucion', 
				 		'perfiles' 				=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
				 		'tipos_persona'			=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
				 	),  
				 	'where'  => 'detalles_usuarios.id_institucion = '.$_SESSION['login']['id_institucion_actual'],
				 	'order'  => 'personal.id_personal DESC',
				 	'return' => 'result', 
				);
				$data['personal'] = $this->crud->read($data['data']);	
			}
			
			$data['titulo'] = 'Personal';
			$data['contenido'] = 'registros/personal/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function agregar()
	{
		if( stripos($_SESSION['permiso']['registros_personal'], 'c') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'where'  => 'tipos_persona.id_tipo_persona <= "2"',
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
			 	'table'  => 'instituciones',
			 	'where'	=> 'instituciones.estado ="1"',
			 	'return' => 'result',
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			if($_SESSION['login']['id_institucion_actual'] != 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'perfiles',
				 	'where'	=> 'perfiles.estado ="1" AND perfiles.id_institucion = '.$_SESSION['login']['id_institucion_actual'],
				 	'return' => 'result',
				);
				$data['perfiles'] = $this->crud->read($data['data']);
			}

			$data['titulo'] = 'Nuevo personal';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'registros/personal/agregar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function cedula()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'	=> 'detalles_usuarios.id = personal.id_personal, LEFT', 
			 		'usuarios' 		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		//'generos' 		=> 'personal.id_genero = generos.id_genero, LEFT', 
			 		//'tipos_persona'	=> 'personal.id_tipo_persona = tipos_persona.id_tipo_persona , LEFT', 
			 		'estados' 		=> 'personal.id_estado = estados.id_estado , LEFT', 
			 		'municipios' 	=> 'personal.id_municipio = municipios.id_municipio, LEFT', 
			 		'parroquias' 	=> 'personal.id_parroquia = parroquias.id_parroquia, LEFT', 
			 	), 
			 	'where'  => 'detalles_usuarios.id_institucion <> 0 AND personal.cedula = "'.$cedula.'" AND personal.estado ="1"',  
			 	'return' => 'row', 
			);
			$personal = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'where'  => 'tipos_persona.id_tipo_persona <= 2',
			 	'return' => 'result',
			);
			$tipos_persona = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'generos',
			 	'return' => 'result',
			);
			$generos = $this->crud->read($data['data']);

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

			if($personal != '')
			{
				$sel_genero = array();
				foreach ($generos as $item) {
				    if ($item->id_genero == $personal->id_genero) {
				        // Agregar el género coincidente al principio del array
				        $sel_genero = array($item->id_genero => $item->genero) + $sel_genero;
				    } else {
				        // Agregar los géneros que no coinciden al array
				        $sel_genero[$item->id_genero] = $item->genero;
				    }
				}

				//var_dump($sel_genero); die();

				$sel_tipo_persona = array();
				foreach ($tipos_persona as $item) {
				    if ($item->id_tipo_persona == $personal->id_tipo_persona) {
				        $sel_tipo_persona = array($item->id_tipo_persona => $item->tipo_persona) + $sel_tipo_persona;
				    } else {
				        $sel_tipo_persona[$item->id_tipo_persona] = $item->tipo_persona;
				    }
				}

	 			$sel_estado = array( 
 					$personal->id_estado => $personal->nombre,
 				);

	 			$sel_municipio = array( 
 					$personal->id_municipio => $personal->municipio,
 				);

 				$sel_parroquia = array( 
 					$personal->id_parroquia => $personal->parroquia,
 				);
				
				$json = array(
		    		'fecha_nacimiento'	=> $personal->fecha_nacimiento, 
		    		'nombres'  			=> $personal->nombres, 
		    		'apellidos'  		=> $personal->apellidos, 
		    		'correo'  			=> $personal->correo, 
		    		'tlf'  				=> $personal->tlf, 
		    		'direccion'  		=> $personal->direccion, 
		    		'colegiatura'  		=> $personal->colegiatura, 
		    		
		    		'crear_select'	=> array(
		    			'#id_tipo_persona'	=> $sel_tipo_persona, 
		    			'#id_genero' 		=> $sel_genero, 
		    			'#id_estado' 		=> $sel_estado, 
		    			'#id_municipio' 	=> $sel_municipio, 
		    			'#id_parroquia' 	=> $sel_parroquia, 
		    		),
		    	);							
			    echo json_encode($json);
			    
			}
			else
			{
				$sel_genero = array();
				foreach ($generos as $item) {
				    $sel_genero[$item->id_genero] = $item->genero;
				}

				$sel_tipo_persona = array();
				foreach ($tipos_persona as $item) {
				    $sel_tipo_persona[$item->id_tipo_persona] = $item->tipo_persona;
				}

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
		    		'colegiatura'  		=> '', 
		    		
		    		'crear_select'			=> array(
		    			'#id_tipo_persona' 	=> $sel_tipo_persona, 
		    			'#id_genero' 		=> $sel_genero, 
		    			'#id_estado' 		=> $sel_estado, 
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

	public function perfiles($param)
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 	
			$data['data'] = array(
			 	'select' 	=> '*', 
			 	'table'  	=> 'perfiles',
			 	'where'  	=> 'perfiles.id_institucion = "'.$busqueda.'" AND perfiles.id_institucion <> 0',
			 	'return' 	=> 'result', 
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
	 					'id' 		=> $item->id_perfil, 
	 					'opcion' 	=> $item->perfil, 
	 				);
	 			}
 			} 			

			$json = array(
        		'status'    => 'select', 
        		'ajax'    	=> $param, 
        		'info'    	=> 'Perfiles cargados', 
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
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
			 		'usuarios' 				=> 'usuarios.id_usuario = detalles_usuarios.id_usuario',
			 	),
			 	'where'  => 'personal.cedula = "'.$cedula.'" AND personal.estado ="1"',  
			 	'return' => 'row', 
			);
			$personal = $data['personal'] = $this->crud->read($data['data']);

	 		if($personal == NULL)
	 		{

		 		if ($this->form_validation->run('personal') == TRUE) 
		 		{
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

		 			if($id_institucion == '0')
		 			{
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => 'Seleccione el instituto de salud', 
		            	);
		            	echo json_encode($json);
		            	die();
		 			}

		 			if($id_perfil == '0')
		 			{
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => 'Seleccione el perfil', 
		            	);
		            	echo json_encode($json);
		            	die();
		 			}

		 			$fechaNac = new DateTime($fecha_nacimiento);
		 			$fechaActual = new DateTime();
		 			$diferencia = $fechaActual->diff($fechaNac);
		 			$edad = $diferencia->y;
		 			$edadMinima = 18;

				    // si es menor de edad, primero se valida el personal
				    if ($edad < $edadMinima) 
				    {
				    	$json = array(
		            		'status'      => 'alert', 
		            		'info'        => 'El personal a ingresar debe ser mayor de edad', 
		            	);
		            	echo json_encode($json);
		            	die();
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
		 				'fecha_nacimiento'  => $fecha_nacimiento,   
		 				'id_tipo_persona'  	=> $id_tipo_persona,   
		 				'cedula'  			=> $cedula,   
		 				'nombres'  			=> $nombres,   
		 				'apellidos'  		=> $apellidos,   
		 				'id_genero'  		=> $id_genero,    
		 				'id_estado'  		=> $id_estado,   
		 				'id_municipio'  	=> $id_municipio,   
		 				'id_parroquia'  	=> $id_parroquia,   
		 				'direccion'  		=> $direccion,   
		 				'colegiatura'  		=> $colegiatura   
		 			);
		 			$data['table'] = 'personal';
		 			$this->crud->create($data);
		 			
	 				$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'personal', 
					 	'where'  => 'personal.fecha_nacimiento = "'.$fecha_nacimiento.'" AND 
					 	personal.id_tipo_persona = "'.$id_tipo_persona.'" AND 
					 	personal.cedula = "'.$cedula.'" AND 
					 	personal.nombres = "'.$nombres.'" AND 
					 	personal.apellidos = "'.$apellidos.'" AND 
					 	personal.id_genero = "'.$id_genero.'" AND 
					 	personal.id_estado = "'.$id_estado.'" AND 
					 	personal.id_municipio = "'.$id_municipio.'" AND 
					 	personal.id_parroquia = "'.$id_parroquia.'" AND 
					 	personal.direccion = "'.$direccion.'" AND
					 	personal.colegiatura = "'.$colegiatura.'" ',
					 	'return' => 'row',
					);
					$personal = $this->crud->read($data['data']);
		
					$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'personal',  
		 				'id'    		=> $personal->id_personal, 
		 				'bitacora'		=> 'Personal registrado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);

		 			$data['data'] = array(		 				 
		 				'id_perfil'   		=> $id_perfil, 
		 				'id_usuario'   		=> $usuario->id_usuario,  
		 				'id'   				=> $personal->id_personal,  
		 				'id_institucion'   	=> $id_institucion,  
		 			);
		 			$data['table'] = 'detalles_usuarios';
		 			$this->crud->create($data);

		 			if( stripos($_SESSION['permiso']['registros_personal'], 'r') !== FALSE)
		 			{
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => '¡Personal creado exitosamente!',  
		            		'redirect'  => base_url('registros/personal'), 
		            	);
		            	echo json_encode($json);
		 			}
		 			else
		 			{
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => '¡Personal creado exitosamente!',  
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
	 			if($personal->id_perfil == $id_perfil)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Perfil ya asociado al personal',  
	            	);
	            	echo json_encode($json);
	            	die();
	 			}
	 			else
	 			{
		 			$data['data'] = array(		 				 
		 				'id_perfil'   		=> $id_perfil, 
		 				'id_usuario'   		=> $personal->id_usuario,  
		 				'id'   				=> $personal->id_personal,  
		 				'id_institucion'   	=> $id_institucion,  
		 			);
		 			$data['table'] = 'detalles_usuarios';
		 			$this->crud->create($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'personal',  
		 				'id'    		=> $personal->id_personal, 
		 				'bitacora'		=> 'Personal registrado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);

		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Personal creado exitosamente!',  
	            		'redirect'  => base_url('registros/personal'), 
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

	public function editar($id)
	{
		if( stripos($_SESSION['permiso']['registros_personal'], 'u') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*, personal.direccion AS direccion1', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
			 		'usuarios' 				=> 'usuarios.id_usuario = detalles_usuarios.id_usuario',
			 	), 
			 	'where'  => 'detalles_usuarios.id_detalle_usuario = "'.$id.'" AND personal.estado ="1"',  
			 	'return' => 'row', 
			);
			$personal = $data['personal'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	'where'  => 'instituciones.estado = "1"',  
			 	'return' => 'result',
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'perfiles',
			 	'where'  => 'perfiles.id_institucion = "'.$personal->id_institucion.'"',  
			 	'return' => 'result',
			);
			$data['perfiles'] = $this->crud->read($data['data']);

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
			 	'where'  => 'municipios.id_estado = "'.$personal->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$personal->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Editar personal';
			$data['contenido'] = 'registros/personal/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['registros_personal'], 'd') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*, personal.direccion AS direccion1, detalles_usuarios.estado AS detalle_estado', 
			 	'table'  => 'personal', 
			 	'join' 	=> array(
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = personal.id_personal', 
			 		'usuarios' 				=> 'usuarios.id_usuario = detalles_usuarios.id_usuario',
			 	), 
			 	'where'  => 'detalles_usuarios.id_detalle_usuario = "'.$id.'" AND personal.estado ="1"',  
			 	'return' => 'row', 
			);
			$personal = $data['personal'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	'where'  => 'instituciones.estado = "1"',  
			 	'return' => 'result',
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'perfiles',
			 	'where'  => 'perfiles.id_institucion = "'.$personal->id_institucion.'"',  
			 	'return' => 'result',
			);
			$data['perfiles'] = $this->crud->read($data['data']);

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
			 	'where'  => 'municipios.id_estado = "'.$personal->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$personal->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);	

			if($personal->detalle_estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			
			$data['titulo'] = $accion.' personal';
			$data['contenido'] = 'registros/personal/estado';
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
	 			if ($this->form_validation->run('personal_editar') == TRUE) 
	 			{
	 				//	se verifica el usuario como campo unico pero igual al existente
	 				$data = array(
			    		'select' => '*', 
			    		'table'  => 'usuarios', 
			    		'where'  => 'usuarios.correo ="'.$correo.'" AND usuarios.id_usuario <> "'.$id_usuario.'"',
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
			    		'table'  => 'personal',  
			    		'where'  => 'personal.cedula ="'.$cedula.'" AND personal.id_personal <> "'.$id_personal.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('cedula' => 'La cedula ya existe');
	            		echo json_encode($json);
	            		die();
			    	}

			    	$data = array(
			    		'select' => '*', 
			    		'table'  => 'personal',  
			    		'where'  => 'personal.colegiatura ="'.$colegiatura.'" AND personal.id_personal <> "'.$id_personal.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('colegiatura' => 'El numero colegiado ya existe');
	            		echo json_encode($json);
	            		die();
			    	}

		    		$data = array(
	            		'table' => 'usuarios', 
	            		'where' => 'usuarios.id_usuario = "'.$id_usuario.'"', 
	            	);
            		$data['set'] = array(
	            		'usuario'  	=> $correo,  
	            		'correo'  	=> $correo,  
			 			'tlf'  		=> $tlf, 
	            	);			    		            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'usuarios',  
		 				'id'    		=> $id_usuario, 
		 				'bitacora'		=> 'Usuario editado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data); 

		 			$data = array(
	            		'table' => 'personal', 
	            		'where' => 'personal.id_personal = "'.$id_personal.'"', 
	            	);
            		$data['set'] = array(
		 				'id_tipo_persona'  	=> $id_tipo_persona,   
		 				'cedula'  			=> $cedula,   
		 				'nombres'  			=> $nombres,   
		 				'apellidos'  		=> $apellidos,   
	            		'fecha_nacimiento'  => $fecha_nacimiento,   
		 				'id_genero'  		=> $id_genero,    
		 				'id_estado'  		=> $id_estado,   
		 				'id_municipio'  	=> $id_municipio,   
		 				'id_parroquia'  	=> $id_parroquia,   
		 				'direccion'  		=> $direccion,
		 				'colegiatura'  		=> $colegiatura 
	            	);			    		            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'personal',  
		 				'id'    		=> $id_personal, 
		 				'bitacora'		=> 'Personal editado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data); 

		 			$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'detalles_usuarios', 
					 	'where'  => 'detalles_usuarios.id_usuario = "'.$id_usuario.'"',  
					 	'return' => 'result', 
					);
					$personal = $this->crud->read($data['data']);

					$flag = 0;
					foreach ($personal as $item) {
						if($item->id_perfil == $id_perfil)
						{
							$flag = 1;
						}
					}

					if($flag == 0)
					{
						$data = array(
		            		'table' => 'detalles_usuarios', 
		            		'where' => 'detalles_usuarios.id_detalle_usuario = "'.$id_detalle_usuario.'"', 
		            	);
			 			$data['set'] = array(		 				 
			 				'id_perfil'   		=> $id_perfil,   
			 				'id_institucion'   	=> $id_institucion,  
			 			);
			 			$data['table'] = 'detalles_usuarios';
			 			$this->crud->edit($data);
					}

		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Personal editado exitosamente!',  
	            		'redirect'  => base_url('registros/personal'), 
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
				 	'table'  => 'detalles_usuarios',
				 	'where'  => 'detalles_usuarios.id_detalle_usuario = '.$id, 
				 	'return' => 'row',
				);
				$personal = $this->crud->read($data['data']);

				if($personal->estado == '0')
				{
					$data = array(
	            		'table' => 'detalles_usuarios', 
	            		'where' => 'detalles_usuarios.id_detalle_usuario = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'personal',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Personal activado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Personal activado exitosamente!',  
	            		'redirect'  => base_url('registros/personal'), 
	            	);
	            	echo json_encode($json);		 			
				}
				else
				{
					$data = array(
	            		'table' => 'detalles_usuarios', 
	            		'where' => 'detalles_usuarios.id_detalle_usuario = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'personal',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Personal desactivado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Personal desactivado exitosamente!',  
	            		'redirect'  => base_url('registros/personal'), 
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
