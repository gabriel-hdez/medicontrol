<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articulos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['insumos_articulos'], 'r') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'insumos', 
			 	'join'  => array(
			 		'unidades_medida' => 'unidades_medida.id_unidad_medida = insumos.id_unidad_medida', 
			 	),  
			 	'order'  => 'insumos.id_insumo DESC',
			 	'return' => 'result', 
			);
			$data['insumos'] = $this->crud->read($data['data']);
			
			$data['titulo'] = 'Insumos';
			$data['contenido'] = 'insumos/articulos/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function nuevo()
	{
		if( stripos($_SESSION['permiso']['insumos_articulos'], 'c') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'unidades_medida',    
			 	'return' => 'result', 
			);
			$data['unidades_medida'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Nuevo insumo';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'insumos/articulos/nuevo';
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

	 		if ($this->form_validation->run('insumos') == TRUE) 
	 		{
	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'insumos', 
				 	'return' => 'result',
				);
				$resultado = $this->crud->read($data['data']);
				$contar = count($resultado);
				$codigo = 'COD-'.$contar++;


	 			$data['data'] = array(		 				 
	 				'codigo' 		=> $codigo,  
	 				'insumo'  		=> $insumo,  
	 				'id_unidad_medida'  => $id_unidad_medida,  
	 				'presentacion'  => $presentacion,  
	 				//'minimo' 		=> $minimo,   
	 				'descripcion'  	=> $descripcion,  
	 			);
	 			$data['table'] = 'insumos';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'insumos', 
				 	'where'  => 'insumos.codigo = "'.$codigo.'"',
				 	'return' => 'row',
				);
				$resultado = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'insumos',  
	 				'id'    		=> $resultado->id_insumo, 
	 				'bitacora'		=> 'Insumo registrado', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			if( stripos($_SESSION['permiso']['insumos_articulos'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Insumo creado exitosamente!',  
	            		'redirect'  => base_url('insumos/articulos'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Insumo creado exitosamente!',  
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
		if( stripos($_SESSION['permiso']['insumos_articulos'], 'u') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'insumos',
			 	'where'  => 'insumos.id_insumo = '.$id,  
			 	'return' => 'row',
			);
			$data['insumo'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'unidades_medida',    
			 	'return' => 'result', 
			);
			$data['unidades_medida'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Editar insumo';
			$data['contenido'] = 'insumos/articulos/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['insumos_articulos'], 'd') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'insumos',
			 	'where'  => 'insumos.id_insumo = '.$id,  
			 	'return' => 'row',
			);
			$insumo = $data['insumo'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'unidades_medida',    
			 	'return' => 'result', 
			);
			$data['unidades_medida'] = $this->crud->read($data['data']);
			
			if($insumo->estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			
			$data['titulo'] = $accion.' insumo';
			$data['contenido'] = 'insumos/articulos/estado';
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
	 			if ($this->form_validation->run('insumos_editar') == TRUE) 
	 			{
	 				//	se verifica el usuario como campo unico pero igual al existente
	 				/*$data = array(
			    		'select' => '*', 
			    		'table'  => 'insumos', 
			    		'where'  => 'insumos.codigo ="'.$codigo.'" AND insumos.id_insumo <> "'.$id.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('codigo' => 'El codigo ya existe');
	            		echo json_encode($json);
	            		die();
			    	}*/ 
			    	
			    	$data = array(
	            		'table' => 'insumos', 
	            		'where' => 'insumos.id_insumo = '.$id, 
	            	);
            		$data['set'] = array(  
	            		//'codigo' 		=> $codigo,  
		 				'insumo'  		=> $insumo,  
		 				'id_unidad_medida'  => $id_unidad_medida,  
		 				'presentacion'  => $presentacion,  
		 				//'minimo' 		=> $minimo,   
		 				'descripcion'  	=> $descripcion,  
	            	);	            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'insumos',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Insumo editado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    	

		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Insumo editado exitosamente!',  
	            		'redirect'  => base_url('insumos/articulos'), 
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
				 	'table'  => 'insumos',
				 	'where'  => 'insumos.id_insumo = '.$id, 
				 	'return' => 'row',
				);
				$insumo = $this->crud->read($data['data']);

				if($insumo->estado == '0')
				{
					$data = array(
	            		'table' => 'insumos', 
	            		'where' => 'insumos.id_insumo = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'insumos',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Insumo activado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Insumo activado exitosamente!',  
	            		'redirect'  => base_url('insumos/articulos'), 
	            	);
	            	echo json_encode($json);
		 			
				}
				else
				{
					$data = array(
	            		'table' => 'insumos', 
	            		'where' => 'insumos.id_insumo = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'insumos',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Insumo desactivado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Insumo desactivado exitosamente!',  
	            		'redirect'  => base_url('insumos/articulos'), 
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
