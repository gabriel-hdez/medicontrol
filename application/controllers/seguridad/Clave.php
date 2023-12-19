<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clave extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$config['js'] = array('ajax/forms');
		$this->resources->initialize($config);
		$this->load->view('seguridad/clave/identificar');
	}

	public function identificar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('recuperar_identificar') == TRUE) 
	 		{
	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'usuarios', 
				 	'where'  => 'usuarios.usuario="'.$usuario.'" OR usuarios.correo ="'.$usuario.'"',
				 	'return' => 'row',
				);
				$usuario = $this->crud->read($data['data']);

				if ($usuario != NULL) 
				{
					$_SESSION['usuario']['check'] 	= TRUE;
	    			//$_SESSION['usuario']['usuario'] 	= $usuario->nombres.' '.$usuario->apellidos;
	    			$_SESSION['usuario']['correo']  	= $usuario->correo ;
	    			$_SESSION['usuario']['pregunta'] 	= $this->encryption->decrypt($usuario->pregunta);
	    			$_SESSION['usuario']['id']      	= $usuario->id_usuario ;

					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Usuario '.$_SESSION['usuario']['correo'].' identificado',  
	            		'redirect'  => base_url('seguridad/clave/pregunta'), 
	            	);
	            	echo json_encode($json);
				} 
				else 
				{
					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Usuario no identificado',  
	            		//'redirect'  => base_url('seguridad/usuarios'), 
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

	public function pregunta()
	{
		/*if ($this->input->is_ajax_request()) 
		{*/
			if ($_SESSION['usuario']['check'] == TRUE) 
			{
				$config['js'] = array('ajax/forms');
				$this->resources->initialize($config);
				$this->load->view('seguridad/clave/pregunta');
			} 
			else 
			{
				$this->session->sess_destroy();
				redirect(base_url('seguridad/clave'));	
			}			
	 	/*}
	 	else
	 	{
	 		show_404();
	 	}*/
	}

	public function respuesta()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('recuperar_confirmar') == TRUE) 
	 		{
	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'usuarios', 
				 	'where'  => 'usuarios.id_usuario="'.$_SESSION['usuario']['id'].'"',
				 	'return' => 'row',
				);
				$usuario = $this->crud->read($data['data']);

				if ($this->encryption->decrypt($usuario->respuesta) == $respuesta) 
				{
					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => $_SESSION['usuario']['usuario'].' ya puedes cambiar tu contraseña',  
	            		'redirect'  => base_url('seguridad/clave/cambio'), 
	            	);
	            	echo json_encode($json);
				} 
				else 
				{
					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Verifique su respuesta',  
	            		//'redirect'  => base_url('seguridad/usuarios'), 
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

	public function cambio()
	{
		/*if ($this->input->is_ajax_request()) 
		{*/
			if ($_SESSION['usuario']['check'] == TRUE) 
			{
				$config['js'] = array('ajax/forms');
				$this->resources->initialize($config);
				$this->load->view('seguridad/clave/cambio');
			} 
			else 
			{
				$this->session->sess_destroy();
				redirect(base_url('seguridad/clave'));	
			}			
	 	/*}
	 	else
	 	{
	 		show_404();
	 	}*/
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('recuperar_actualizar') == TRUE) 
	 		{
	 			$data = array(
            		'table' => 'usuarios', 
            		'where'  => 'usuarios.id_usuario="'.$_SESSION['usuario']['id'].'"',
            	);
	 			$data['set'] = array(
            		'clave'  => $this->encryption->encrypt($clave), 
            	);
            	if ($this->crud->edit($data) == TRUE) 
				{
					$this->session->sess_destroy();

					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => $_SESSION['usuario']['usuario'].' contraseña actualizada exitosamente',  
	            		'redirect'  => base_url(), 
	            	);
	            	echo json_encode($json);
				}
				else
				{
					$json = array(
	            		'status'      => 'alert',  
	            		'info'        => 'Ha ocurrido un error al actualizar la contraseña, contacte a los desarrolladores' 
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




}
