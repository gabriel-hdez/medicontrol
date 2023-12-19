<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instituciones extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['registros_instituciones'], 'r') !== FALSE) 
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
			
			$data['titulo'] = 'Instituciones';
			$data['contenido'] = 'registros/instituciones/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function agregar()
	{
		if( stripos($_SESSION['permiso']['registros_instituciones'], 'c') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Crear institucion';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'registros/instituciones/agregar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('instituciones') == TRUE) 
	 		{
	 			$data['data'] = array(		  
	 				'id_tipo_persona'	=> $id_tipo_persona,   
	 				'rif'  			=> $rif,   
	 				'institucion'  	=> $institucion,   
	 				'correo'  		=> $correo,   
	 				'tlf'  			=> $tlf,   
	 				'id_estado'  	=> $id_estado,   
	 				'id_municipio'  => $id_municipio,   
	 				'id_parroquia'  => $id_parroquia,   
	 				'direccion'  	=> $direccion,   
	 			);
	 			$data['table'] = 'instituciones';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'instituciones', 
				 	'where'  => 'instituciones.correo = "'.$correo.'"',
				 	'return' => 'row',
				);
				$resultado = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'instituciones',  
	 				'id'    		=> $resultado->id_institucion, 
	 				'bitacora'		=> 'Institucion registrada', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			if( stripos($_SESSION['permiso']['registros_instituciones'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Institucion creada exitosamente!',  
	            		'redirect'  => base_url('registros/instituciones'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Institucion creada exitosamente!',  
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
		if( stripos($_SESSION['permiso']['registros_instituciones'], 'u') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);
			
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	'where'  => 'instituciones.id_institucion = '.$id,  
			 	'return' => 'row',
			);
			$data['institucion'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Editar institucion';
			$data['contenido'] = 'registros/instituciones/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['registros_instituciones'], 'd') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'tipos_persona',
			 	'return' => 'result',
			);
			$data['tipos_persona'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'estados',
			 	'return' => 'result',
			);
			$data['estados'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'instituciones',
			 	'where'  => 'instituciones.id_institucion = '.$id,  
			 	'return' => 'row',
			);
			$institucion = $data['institucion'] = $this->crud->read($data['data']);

			if($institucion->estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			
			$data['titulo'] = $accion.' institucion';
			$data['contenido'] = 'registros/instituciones/estado';
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
	 			if ($this->form_validation->run('instituciones_editar') == TRUE) 
	 			{
	 				//	se verifica el usuario como campo unico pero igual al existente
	 				$data = array(
			    		'select' => '*', 
			    		'table'  => 'instituciones', 
			    		'where'  => 'instituciones.correo ="'.$correo.'" AND instituciones.id_institucion <> "'.$id.'"',
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
			    		'table'  => 'instituciones', 
			    		'where'  => 'instituciones.rif ="'.$rif.'" AND instituciones.id_institucion <> "'.$id.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('rif' => 'El RIF ya existe');
	            		echo json_encode($json);
	            		die();
			    	} 

		    		$data = array(
	            		'table' => 'instituciones', 
	            		'where' => 'instituciones.id_institucion = '.$id, 
	            	);
            		$data['set'] = array(
	            		'id_tipo_persona'  	=> $id_tipo_persona,    
	            		'rif'  			=> $rif,    
	            		'institucion'  	=> $institucion,    
		 				'correo'  		=> $correo,  
		 				'tlf' 			=> $tlf,    
		 				'id_estado'  	=> $id_estado,  
		 				'id_municipio'  => $id_municipio,  
		 				'id_parroquia'  => $id_parroquia,  
		 				'direccion'  	=> $direccion,  
	            	);			    		            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'instituciones',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Institucion editada', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    	

		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Institucion editada exitosamente!',  
	            		'redirect'  => base_url('registros/instituciones'), 
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
				 	'table'  => 'instituciones',
				 	'where'  => 'instituciones.id_institucion = '.$id, 
				 	'return' => 'row',
				);
				$institucion = $this->crud->read($data['data']);

				if($institucion->estado == '0')
				{
					$data = array(
	            		'table' => 'instituciones', 
	            		'where' => 'instituciones.id_institucion = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'instituciones',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Institucion activada', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Institucion activada exitosamente!',  
	            		'redirect'  => base_url('registros/instituciones'), 
	            	);
	            	echo json_encode($json);		 			
				}
				else
				{
					$data = array(
	            		'table' => 'instituciones', 
	            		'where' => 'instituciones.id_institucion = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'instituciones',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Institucion desactivada', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Institucion desactivada exitosamente!',  
	            		'redirect'  => base_url('registros/instituciones'), 
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
