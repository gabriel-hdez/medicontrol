<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles extends CI_Controller {

	//	funcion construct, las instacias y lo que aqui se haga se aplica al resto de las funciones
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}
	//	funcion index, por defecto muestra el listado de usuarios
	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['registros_perfiles'], 'r') !== FALSE) 
		{
			//	construye el query para consultar los usuarios
			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'perfiles',
				 	'join' 	=> array(
				 		'instituciones'	=> 'perfiles.id_institucion = instituciones.id_institucion, LEFT', 
				 	),  
				 	'order'  => 'perfiles.id_perfil DESC',
				 	'return' => 'result', 
				);
				$data['perfiles'] = $this->crud->read($data['data']);
			}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'perfiles',
				 	'join' 	=> array(
				 		'instituciones'	=> 'perfiles.id_institucion = instituciones.id_institucion, LEFT', 
				 	),   
				 	'where'  => 'instituciones.id_institucion = '.$_SESSION['login']['id_institucion_actual'],
				 	'order'  => 'perfiles.id_perfil DESC',
				 	'return' => 'result', 
				);
				$data['perfiles'] = $this->crud->read($data['data']);
			}
			//	titulo de la pagina
			$data['titulo'] = 'Perfiles';
			//	se indica ubicacion y vista
			$data['contenido'] = 'registros/perfiles/listado';
			//	renderiza vista
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}
	//	funcion nuevo, carga vista formulario de nuevo usuario
	public function agregar()
	{
		if( stripos($_SESSION['permiso']['registros_perfiles'], 'c') !== FALSE) 
		{
			$config['js'] = array('ajax/forms');

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	'where'	=> 'instituciones.estado ="1"',
			 	'return' => 'result',
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Nuevo perfil';
			$_SESSION['token'] = 'nuevo';
			//	se indica ubicacion y vista
			$data['contenido'] = 'registros/perfiles/agregar';
			//	renderiza vista
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}
	//	funcion guardar, valida y setea los datos para crear un nuevo usuario
	public function guardar()
	{
		//	solo peticiones AJAX permitidas
		if ($this->input->is_ajax_request()) 
		{
			//	se extraen los valores enviados mediante POST en variables llamadas igual a sus llaves 	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		//	si pasa las validaciones a los inputs, ver config/form_validation.php
	 		if ($this->form_validation->run('perfiles') == TRUE) 
	 		{
	 			$data = array(
		    		'select' => '*', 
		    		'table'  => 'perfiles', 
		    		'where'  => 'perfiles.perfil ="'.$perfil.'" AND perfiles.id_institucion = "'.$id_institucion.'"',
		    		'return'  => 'check'
		    	);
		    	if ($this->crud->read($data) == TRUE) 
		    	{
		    		$json = array('perfil' => 'El perfil ya existe');
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

	 			$data['data'] = array(		 				 
	 				'perfil'    		=> $perfil,  
	 				'id_institucion'    => $id_institucion,  
	 			);
	 			$data['table'] = 'perfiles';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'perfiles', 
				 	'where'  => 'perfiles.perfil = "'.$perfil.'"',
				 	'return' => 'row',
				);
				$resultado = $this->crud->read($data['data']);
					
				$data['data'] = array(
				    'select' => '*', 
				    'table'  => 'submenu',
				    'return' => 'result',
				);
				$opciones = $this->crud->read($data['data']);

				$data['data'] = array(		 				 
	 				'id_perfil'    => $resultado->id_perfil, 	
	 			);
				foreach ($opciones as $opcion) 
				{
					$permiso = $opcion->privilegio;
					$string = NULL;

					if(isset($_POST[$permiso])){
						foreach ($_POST[$permiso] as $key => $value) {
							$string.=$value;
						}
					}
					$data['data'][$permiso] = $string;
				}
		 		$data['table'] = 'privilegios';
		 		$this->crud->create($data);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'perfiles',  
	 				'id'    		=> $resultado->id_perfil, 
	 				'bitacora'		=> 'Perfil registrado', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			if( stripos($_SESSION['permiso']['registros_perfiles'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Perfil creado exitosamente!',  
	            		'redirect'  => base_url('registros/perfiles'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Perfil creado exitosamente!',  
	            		'clearInputs'  => 'on',
	            		//'redirect'  => base_url('archivos/usuarios/nuevo'), 
	            	);
	            	echo json_encode($json);
	 			}
	 		}
	 		else 
	 		{
	 			echo json_encode($this->form_validation->error_array());
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
		if( stripos($_SESSION['permiso']['registros_perfiles'], 'u') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'perfiles',
			 	'where'  => 'perfiles.id_perfil = '.$id,  
			 	'return' => 'row',
			);
			$data['perfil'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	//'where'  => 'instituciones.estado = "1"',  
			 	'return' => 'result',
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'privilegios',
			 	'where'  => 'privilegios.id_perfil = '.$id,  
			 	'return' => 'row',
			);
			$data['privilegio'] = $this->crud->read($data['data']);

			//	titulo de la pagina
			$data['titulo'] = 'Editar perfil';
			$_SESSION['token'] = 'editar';
			//	se indica ubicacion y vista
			$data['contenido'] = 'registros/perfiles/editar';
			//	renderiza vista
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['registros_perfiles'], 'd') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'perfiles',
			 	'where'  => 'perfiles.id_perfil = '.$id,  
			 	'return' => 'row',
			);
			$perfil = $data['perfil'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	//'where'  => 'instituciones.estado = "1"',  
			 	'return' => 'result',
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'privilegios',
			 	'where'  => 'privilegios.id_perfil = '.$id,  
			 	'return' => 'row',
			);
			$data['privilegio'] = $this->crud->read($data['data']);

			if($perfil->estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			//	titulo de la pagina
			$data['titulo'] = $accion.' perfil';
			$_SESSION['token'] = $accion;
			//	se indica ubicacion y vista
			$data['contenido'] = 'registros/perfiles/estado';
			//	renderiza vista
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
	 			if ($this->form_validation->run('perfiles_editar') == TRUE) 
	 			{
	 				//	se verifica el usuario como campo unico pero igual al existente
	 				$data = array(
			    		'select' => '*', 
			    		'table'  => 'perfiles', 
			    		'where'  => 'perfiles.perfil ="'.$perfil.'"  AND perfiles.id_perfil <> "'.$id.'" AND perfiles.id_institucion = "'.$id_institucion.'" ',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('perfil' => 'El perfil ya existe');
	            		echo json_encode($json);
			    	} 
			    	else 
			    	{
		    			$data = array(
		            		'table' => 'perfiles', 
		            		'where' => 'perfiles.id_perfil = '.$id, 
		            	);
	            		$data['set'] = array(
		            		'perfil' 			=> $perfil,
		            		'id_institucion' 	=> $id_institucion,
		            	);
		            	$this->crud->edit($data);

						$data['data'] = array(
						    'select' => '*', 
						    'table'  => 'submenu',
						    'return' => 'result',
						);
						$opciones = $this->crud->read($data['data']);

						$data = array(
		            		'table' => 'privilegios', 
		            		'where' => 'privilegios.id_perfil = '.$id, 
		            	);
						foreach ($opciones as $opcion) 
						{
							$permiso = $opcion->privilegio;
							$string = NULL;

							if(isset($_POST[$permiso])){
								foreach ($_POST[$permiso] as $key => $value) {
									$string.=$value;
								}
							}
							$data['set'][$permiso] = $string;
						}
						$this->crud->edit($data);
					    
					    $data['data'] = array(		 				 
			 				'responsable'   => $_SESSION['login']['id_usuario'], 
			 				'tabla'   		=> 'perfiles',  
			 				'id'    		=> $id, 
			 				'bitacora'		=> 'Perfil editado', 
			 			);
			 			$data['table'] = 'bitacora';
			 			$this->crud->create($data); 	

			 			$json = array(
		            		'status'      => 'alert', 
		            		'info'        => '¡Perfil editado exitosamente!',  
		            		'redirect'  => base_url('registros/perfiles'), 
		            		//'clearInputs'  => 'on',
		            	);
		            	echo json_encode($json);
		            }		
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
				 	'table'  => 'perfiles',
				 	'where'  => 'perfiles.id_perfil = '.$id, 
				 	'return' => 'row',
				);
				$perfil = $this->crud->read($data['data']);

				if($perfil->estado == '0')
				{
					$data = array(
	            		'table' => 'perfiles', 
	            		'where' => 'perfiles.id_perfil = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'perfiles',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Perfil activado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Perfil activado exitosamente!',  
	            		'redirect'  => base_url('registros/perfiles'), 
	            		//'clearInputs'  => 'on',
	            	);
	            	echo json_encode($json);
		 			
				}
				else
				{
					$data = array(
	            		'table' => 'perfiles', 
	            		'where' => 'perfiles.id_perfil = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'perfiles',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Perfil desactivado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Perfil desactivado exitosamente!',  
	            		'redirect'  => base_url('registros/perfiles'), 
	            		//'clearInputs'  => 'on',
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

	
}
