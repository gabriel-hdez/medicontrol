<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bd extends CI_Controller {

	//	funcion construct, las instacias y lo que aqui se haga se aplica al resto de las funciones
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}
	
	public function nuevo()
	{
		if( stripos($_SESSION['permiso']['seguridad_bd'], 'c') !== FALSE || stripos($_SESSION['permiso']['seguridad_bd'], 'u') !== FALSE ) 
		{
			
			$data['titulo'] = 'Base de datos';
			$data['contenido'] = 'seguridad/bd/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function respaldo()
	{
		if( stripos($_SESSION['permiso']['seguridad_bd'], 'c') !== FALSE ) 
		{
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');

			$filename = 'backup_'.date('Y-m-d_H-i-s').'.zip';

			$prefs = array(
			    'tables'      => array(),   // Tablas para respaldar. Si está vacío, respalda todas las tablas.
			    'ignore'      => array(),   // Tablas a ignorar durante el respaldo.
			    'filename'    => 'backup.sql',   // Nombre del archivo de respaldo
			    'format'      => 'txt',    // Puedes elegir 'zip' o 'txt'
			    'add_drop'    => true,     // Agrega una declaración DROP TABLE antes de cada CREATE TABLE
			    'add_insert'  => true,     // Agrega datos INSERT con cada CREATE TABLE
			    'newline'     => "\n",     // Nueva línea utilizada en el archivo de respaldo
			);

			$backup =& $this->dbutil->backup($prefs);

			// Carga la librería Zip y agrega el respaldo
			$this->load->library('zip');
			$this->zip->add_data('backup.sql', $backup);

			// Guarda el archivo en el servidor
			write_file('files/bd/'.$filename, $this->zip->get_zip());

			// Descarga el archivo al usuario
			force_download('backup.zip', $this->zip->get_zip());
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}
	
	

	
}
