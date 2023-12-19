<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('inicio/login');
	}

	public function mantenimiento()
	{
		$data['titulo'] = 'Pagina en construccion';
		$this->load->view('errors/mantenimiento', $data);
	}

	//	INICIAR SESION
	public function login()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('login') == TRUE)
	        {
	        	$data = array('usuario' => $usuario);
        		$login = $this->crud->login($data);

        		if($login == TRUE)
        		{
	        		if ($clave == $this->encryption->decrypt($login->clave)) 
	        		{	        			
	        			$data['data'] = array(
						 	'select' => '*, personal.id_personal AS id_personal, pacientes.id_paciente AS id_paciente', 
						 	'table'  => 'detalles_usuarios',
						 	'join'  => array(
						 		'perfiles' 		=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
						 		'privilegios' 	=> 'privilegios.id_perfil = perfiles.id_perfil', 
						 		'instituciones'	=> 'instituciones.id_institucion = detalles_usuarios.id_institucion, LEFT', 
						 		'pacientes'		=> 'pacientes.id_paciente = detalles_usuarios.id, LEFT', 
						 		'personal'		=> 'personal.id_personal = detalles_usuarios.id, LEFT', 
						 	),
						 	'where'  => 'detalles_usuarios.id_usuario ="'.$login->id_usuario.'" AND detalles_usuarios.estado = "1" ',
						 	'return' => 'result',
						);
						$usuario = $this->crud->read($data['data']);

						//var_dump($usuario->id); die();

						$instituciones = array();
						$perfiles = array();
						foreach ($usuario as $item) 
						{
							$_SESSION['login']['check'] 			= TRUE;
		        			$_SESSION['login']['id_usuario']      	= $login->id_usuario;
		        			$_SESSION['login']['usuario'] 			= $login->usuario;
		        			$_SESSION['login']['correo']  			= $login->correo ;
		        			$_SESSION['login']['nombres_apellidos'] = $item->nombres.' '.$item->apellidos;
		        			$_SESSION['login']['id_paciente']		= $item->id;
		        			$_SESSION['login']['id_personal']		= $item->id;

		        			$id_institucion = $item->id_institucion;
						    $id_perfil = $item->id_perfil;
						    $institucion = $item->institucion;

						    $perfiles[$id_perfil] = $institucion.' | '.$item->perfil;

						    $_SESSION['login']['perfiles'] = $perfiles;

						    if (!isset($_SESSION['login']['id_perfil_actual'])) {
						        $_SESSION['login']['id_perfil_actual'] = $id_perfil;
						        $_SESSION['login']['id_institucion_actual'] = $id_institucion;
						    }
						}						

	        			$data['data'] = array(
						 	'select' => '*', 
						 	'table'  => 'submenu',
						 	'return' => 'result',
						);
						$opciones = $this->crud->read($data['data']);

						foreach ($opciones as $item) 
						{
							$privilegio = $item->privilegio;
							$_SESSION['permiso'][$privilegio] = $usuario[0]->$privilegio;
						}

						//var_dump($_SESSION); die();

	        			$json = array(
				    		'status' 	=> 'alert',
				    		'info' 		=> '¡Bienvenido '.$_SESSION['login']['usuario'].'!',
				    		'redirect'  => base_url('inicio/bienvenido')
				    	);
				    	echo json_encode($json);						

	        		} 
	        		else 
	        		{
	        			$json = array(
				    		'status' 	=> 'alert',
				    		'info' 		=> 'Clave incorrecta'
				    	);
				    	echo json_encode($json);
	        		}        	
        		}
        		else
        		{
        			$json = array(
			    		'status' 	=> 'alert',
			    		'info' 		=> 'Usuario introducido no existe'
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

	//	CARGA BIENVENIDA AL SISTEMA
	public function bienvenido()
	{
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
		unset($_SESSION['token']);

		/*$data['titulo'] = array(
			'Inicio' => base_url('inicio/bienvenido'), 
			'Bitacora' => base_url('inicio/bienvenido'), 
		);*/
		
		//$data['titulo'] = ' ';
		$data['contenido'] = 'inicio/bienvenido';
		$this->load->view('render', $data);
	}

	public function permisos()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'detalles_usuarios',
			 	'join'  => array(
			 		'perfiles' 		=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
			 		'privilegios' 	=> 'privilegios.id_perfil = perfiles.id_perfil', 
			 		'instituciones'	=> 'instituciones.id_institucion = detalles_usuarios.id_institucion, LEFT', 
			 		'pacientes'		=> 'pacientes.id_paciente = detalles_usuarios.id, LEFT', 
			 		'personal'		=> 'personal.id_personal = detalles_usuarios.id, LEFT', 
			 	),
			 	'where'  => 'detalles_usuarios.id_usuario ="'.$_SESSION['login']['id_usuario'].'" AND detalles_usuarios.id_perfil="'.$select_perfil.'"',
			 	'return' => 'row',
			);
			$usuario = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'submenu',
			 	'return' => 'result',
			);
			$opciones = $this->crud->read($data['data']);

			foreach ($opciones as $item) 
			{
				$privilegio = $item->privilegio;
				$_SESSION['permiso'][$privilegio] = $usuario->$privilegio;
			}

			$instituciones = array();
			$perfiles = array();
			
			$id_institucion = $usuario->id_institucion;
		    $id_perfil = $usuario->id_perfil;
		    $institucion = $usuario->institucion;

		    $perfiles[$id_perfil] = $institucion.' | '.$usuario->perfil;

		    $_SESSION['login']['perfiles'] = $perfiles;
		    $_SESSION['login']['id_perfil_actual'] = $id_perfil;
		    $_SESSION['login']['id_institucion_actual'] = $id_institucion;

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'detalles_usuarios',
			 	'join'  => array(
			 		'perfiles' 		=> 'perfiles.id_perfil = detalles_usuarios.id_perfil', 
			 		'privilegios' 	=> 'privilegios.id_perfil = perfiles.id_perfil', 
			 		'instituciones'	=> 'instituciones.id_institucion = detalles_usuarios.id_institucion, LEFT', 
			 		'usuarios'		=> 'usuarios.id_usuario = detalles_usuarios.id_usuario, LEFT', 
			 		'pacientes'		=> 'pacientes.id_paciente = detalles_usuarios.id, LEFT', 
			 		'personal'		=> 'personal.id_personal = detalles_usuarios.id, LEFT', 
			 	),
			 	'where'  => 'detalles_usuarios.id_usuario ="'.$_SESSION['login']['id_usuario'].'" AND detalles_usuarios.id_perfil <> "'.$select_perfil.'" AND detalles_usuarios.estado = "1" ',
			 	'return' => 'result',
			);
			$usuarios = $this->crud->read($data['data']);

			foreach ($usuarios as $item) 
			{
				$id_institucion = $item->id_institucion;
			    $id_perfil = $item->id_perfil;
			    $institucion = $item->institucion;

			    $perfiles[$id_perfil] = $institucion.' | '.$item->perfil;

			    $_SESSION['login']['perfiles'] = $perfiles;
			}

			$json = array(
	    		'status' 	=> 'alert',
	    		'info' 		=> 'Aplicando cambios...',
	    		'redirect'  => base_url('inicio/bienvenido')
	    	);
	    	echo json_encode($json);
	 	}
		else
		{
			show_404();
		}
	}
	
	//	CERRAR SESION
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());	
	}

	public function usuario_registrar()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('usuario') == TRUE) 
	 		{
	 			$data['data'] = array(		 				 
	 				'id_perfil' => '4',  
	 				'usuario'  	=> $correo,  
	 				'clave'  	=> $this->encryption->encrypt($clave2),  
	 				'nombres'  	=> $nombres,  
	 				'apellidos' => $apellidos,  
	 				'iso'  		=> $iso,  
	 				//'cedula'  	=> $cedula,  
	 				'correo'  	=> $correo,  
	 				'pregunta' 	=> $this->encryption->encrypt($pregunta),  
	 				'respuesta' => $this->encryption->encrypt($respuesta),  
	 				'tlf'  		=> $tlf,  
	 			);
	 			$data['table'] = 'usuarios';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'usuarios', 
				 	'where'  => 'usuarios.correo = "'.$correo.'"',
				 	'return' => 'row',
				);
				$resultado = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => 0, 
	 				'tabla'   		=> 'usuarios',  
	 				'id'    		=> $resultado->id_usuario, 
	 				'bitacora'		=> 'Usuario registrado', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

 				$json = array(
            		'status'      => 'login', 
            		'usuario'     => $correo, 
            		'info'        => '¡Usuario creado exitosamente!',  
            		//'redirect'  => base_url('archivos/usuarios'), 
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

	public function usuario_editar()
	{
		if ($_SESSION['login']['check'] == TRUE) 
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
			 	'select' => '*, usuarios.id_usuario AS id_usuario', 
			 	'table'  => 'usuarios',
			 	'join'  => array(
			 		//'perfiles' => 'perfiles.id_perfil = '.$_SESSION['login']['id_perfil'], 
			 		'personal' => 'personal.id_personal = '.$_SESSION['login']['id_usuario'], 
			 	),
			 	'where'  => 'usuarios.id_usuario = '.$_SESSION['login']['id_usuario'],  
			 	'return' => 'row',
			);
			$usuario = $data['usuario'] = $this->crud->read($data['data']);

			if($usuario != NULL)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'municipios',
				 	'where'  => 'municipios.id_estado = '.$usuario->id_estado,  
				 	'return' => 'result',
				);
				$data['municipios'] = $this->crud->read($data['data']);

				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'parroquias',
				 	'where'  => 'parroquias.id_municipio = '.$usuario->id_municipio,  
				 	'return' => 'result',
				);
				$data['parroquias'] = $this->crud->read($data['data']);
				
				$data['contenido'] = 'inicio/editar_personal';
			}
			
			if($usuario == NULL)
			{
				$data['data'] = array(
				 	'select' => '*, usuarios.id_usuario AS id_usuario', 
				 	'table'  => 'usuarios',
				 	'join'  => array(
				 		//'perfiles' => 'perfiles.id_perfil = '.$_SESSION['login']['id_perfil'], 
				 		'pacientes' => 'pacientes.id_paciente = '.$_SESSION['login']['id_usuario'], 
				 	),
				 	'where'  => 'usuarios.id_usuario = '.$_SESSION['login']['id_usuario'],  
				 	'return' => 'row',
				);
				$usuario = $data['usuario'] = $this->crud->read($data['data']);

				if($usuario != NULL)
				{
					$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'municipios',
					 	'where'  => 'municipios.id_estado = '.$usuario->id_estado,  
					 	'return' => 'result',
					);
					$data['municipios'] = $this->crud->read($data['data']);

					$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'parroquias',
					 	'where'  => 'parroquias.id_municipio = '.$usuario->id_municipio,  
					 	'return' => 'result',
					);
					$data['parroquias'] = $this->crud->read($data['data']);
				}

				$data['contenido'] = 'inicio/editar_paciente';
			}
			
			if($data['usuario'] == NULL)
			{
				$data['data'] = array(
				 	'select' => '*, usuarios.id_usuario AS id_usuario', 
				 	'table'  => 'usuarios',
				 	'where'  => 'usuarios.id_usuario = '.$_SESSION['login']['id_usuario'],  
				 	'return' => 'row',
				);
				$usuario = $data['usuario'] = $this->crud->read($data['data']);
				
				$data['contenido'] = 'inicio/editar_admin';
			}
			
			$data['titulo'] = 'Editar mis datos';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url()); 
		}
	}

	public function usuario_actualizar()
	{
		//	solo peticiones AJAX permitidas
		if ($this->input->is_ajax_request()) 
		{
			//	se extraen los valores enviados mediante POST en variables llamadas igual a sus llaves 	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if (isset($id_personal) )
	 		{
	 			if ($this->form_validation->run('personal_editar') == TRUE)
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

	        		$data = array(
			    		'select' => '*', 
			    		'table'  => 'personal', 
			    		'where'  => 'personal.cedula ="'.$cedula.'" AND personal.id_personal <> "'.$id_personal.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('cedula' => 'La cedula '.$cedula.' ya existe');
	            		echo json_encode($json);
	            		die();
			    	}

			    	$data = array(
	            		'table' => 'personal', 
	            		'where' => 'personal.id_personal = '.$id_personal, 
	            	); 
	            	$data['set'] = array(
		 				'id_tipo_persona'  	=> $id_tipo_persona,   
		 				'cedula'  			=> $cedula,   
		 				'colegiatura'  		=> $colegiatura,   
		 				'nombres'  			=> $nombres,   
		 				'apellidos'  		=> $apellidos,   
	            		'fecha_nacimiento'  => $fecha_nacimiento,   
		 				'genero'  			=> $genero,    
		 				'id_estado'  		=> $id_estado,   
		 				'id_municipio'  	=> $id_municipio,   
		 				'id_parroquia'  	=> $id_parroquia,   
		 				'direccion'  		=> $direccion  
	            	);
	            	$this->crud->edit($data);

	 			}
	 			else
	 			{
	 				echo json_encode($this->form_validation->error_array());
	 			}
	 		}

	 		if (isset($id_paciente)) 
	 		{
	 			if ($this->form_validation->run('pacientes_editar') == TRUE)
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

	        		$data = array(
			    		'select' => '*', 
			    		'table'  => 'pacientes', 
			    		'where'  => 'pacientes.cedula ="'.$cedula.'" AND pacientes.id_paciente <> "'.$id_paciente.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('cedula' => 'La cedula '.$cedula.' ya existe');
	            		echo json_encode($json);
	            		die();
			    	}

			    	$data = array(
	            		'table' => 'pacientes', 
	            		'where' => 'pacientes.id_paciente = '.$id_paciente, 
	            	); 
	            	$data['set'] = array(
		 				'id_tipo_persona'  	=> $id_tipo_persona,   
		 				'cedula'  			=> $cedula,     
		 				'nombres'  			=> $nombres,   
		 				'apellidos'  		=> $apellidos,   
	            		'fecha_nacimiento'  => $fecha_nacimiento,   
		 				'genero'  			=> $genero,    
		 				'id_estado'  		=> $id_estado,   
		 				'id_municipio'  	=> $id_municipio,   
		 				'id_parroquia'  	=> $id_parroquia,   
		 				'direccion'  		=> $direccion  
	            	);
	            	$this->crud->edit($data);
	            }
	            else
	            {
	            	echo json_encode($this->form_validation->error_array());
	            }
	 		}

	 		//if(isset($id))
	 		//{
	 			if ($this->form_validation->run('usuario_editar') == TRUE) 
	 			{
	 				//	se verifica el usuario como campo unico pero igual al existente
	 				$data = array(
			    		'select' => '*', 
			    		'table'  => 'usuarios', 
			    		'where'  => 'usuarios.usuario ="'.$usuario.'" AND usuarios.id_usuario <> "'.$_SESSION['login']['id_usuario'].'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('usuario' => 'El usuario '.$usuario.' ya existe');
	            		echo json_encode($json);
	            		die();
			    	} 
			    	$data = array(
			    		'select' => '*', 
			    		'table'  => 'usuarios', 
			    		'where'  => 'usuarios.correo ="'.$correo.'" AND usuarios.id_usuario <> "'.$_SESSION['login']['id_usuario'].'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('correo' => 'El correo electrónico ya existe');
	            		echo json_encode($json);
	            		die();
			    	} 		
				    		
	    			$data = array(
	            		'table' => 'usuarios', 
	            		'where' => 'usuarios.id_usuario = '.$_SESSION['login']['id_usuario'], 
	            	);
	            	if (isset($clave) && $clave != NULL) 
	            	{
	            		$data['set'] = array(
		            		'usuario'  	=> $usuario,  
			 				'clave'  	=> $this->encryption->encrypt($clave),   
			 				'correo'  	=> $correo,  
			 				'tlf'  		=> $tlf, 
			 				'pregunta' 	=> $this->encryption->encrypt($pregunta),  
	 						'respuesta' => $this->encryption->encrypt($respuesta),  
		            	);
	            	} 
	            	else 
	            	{
	            		$data['set'] = array(
		            		'usuario'  	=> $usuario,  
			 				'correo'  	=> $correo,  
			 				'tlf'  		=> $tlf, 
			 				'pregunta' 	=> $this->encryption->encrypt($pregunta),  
	 						'respuesta' => $this->encryption->encrypt($respuesta),  
		            	);
	            	}           	
	            	//	se procede a actualizar el usuario
	            	if ($this->crud->edit($data) == TRUE) 
	            	{
	        		
		 				$data['data'] = array(		 				 
			 				'responsable'   => $_SESSION['login']['id_usuario'], 
			 				'tabla'   		=> 'usuarios',  
			 				'id'    		=> $_SESSION['login']['id_usuario'], 
			 				'bitacora'		=> 'Usuario editado', 
			 			);
			 			$data['table'] = 'bitacora';
			 			$this->crud->create($data);
		 				
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => '¡Usuario editado exitosamente!',  
		            		'redirect'  => base_url('inicio/bienvenido'), 
		            		//'clearInputs'  => 'on',
		            	);
		            	echo json_encode($json);
			 			
	            	} 
	            	else 
	            	{
	            		$json = array(
		            		'status'      => 'alert',  
		            		'info'        => 'Ha ocurrido un error al editar el usuario contacte a los desarrolladores' 
		            	);
		            	echo json_encode($json);
	            	}
				    	
			    	
	 			} 
	 			else 
	 			{
	 				echo json_encode($this->form_validation->error_array());
	 			}
	 		//}

	 		
		}
		//	sino, error 404  
		else 
		{
			show_404();
		}
	}

	public function municipios($param)
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 	
			$data['data'] = array(
			 	'select' 	=> '*', 
			 	'table'  	=> 'municipios',
			 	'where'  	=> 'municipios.id_estado = "'.$busqueda.'"',
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
	 					'id' 		=> $item->id_municipio, 
	 					'opcion' 	=> $item->municipio, 
	 				);
	 			}
 			} 			

			$json = array(
        		'status'    => 'select', 
        		'ajax'    	=> $param, 
        		'info'    	=> 'Municipios cargados', 
        		'options'   => $options,   
        	);
        	echo json_encode($json);		 				           
		} 
		else 
		{
			show_404();
		}
	}

	public function parroquias($param)
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 	
			$data['data'] = array(
			 	'select' 	=> '*', 
			 	'table'  	=> 'parroquias',
			 	'where'  	=> 'parroquias.id_municipio = "'.$busqueda.'"',
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
	 					'id' 		=> $item->id_parroquia, 
	 					'opcion' 	=> $item->parroquia, 
	 				);
	 			}
 			} 			

			$json = array(
        		'status'    => 'select', 
        		'ajax'    	=> $param, 
        		'info'    	=> 'Parroquias cargados', 
        		'options'   => $options,   
        	);
        	echo json_encode($json);		 				           
		} 
		else 
		{
			show_404();
		}
	}

}
