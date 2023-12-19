<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examenes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		if( stripos($_SESSION['permiso']['historial_examenes'], 'r') !== FALSE) 
		{

	        $data = array(
	            'titulo' => 'Página en construcción',
	            'contenido' => 'inicio/mensaje'
	        );

	        $this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}
	
}
