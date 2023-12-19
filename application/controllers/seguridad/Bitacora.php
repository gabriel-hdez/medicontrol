<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora extends CI_Controller {

	//	funcion construct, las instacias y lo que aqui se haga se aplica al resto de las funciones
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}
	
	public function index()
	{
		if( stripos($_SESSION['permiso']['seguridad_bitacora'], 'r') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'bitacora',
			 	'join'   => array('usuarios' => 'bitacora.responsable = usuarios.id_usuario , LEFT'), 
			 	'order'  => 'bitacora.fecha DESC',
			 	'return' => 'result', 
			);
			$data['bitacora'] = $this->crud->read($data['data']);
			$data['titulo'] = 'Bitácora';
			$data['contenido'] = 'seguridad/bitacora/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}
	
	

	
}
