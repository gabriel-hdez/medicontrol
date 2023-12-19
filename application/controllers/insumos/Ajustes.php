<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['insumos_ajustes'], 'r') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'ajustes', 
			 	'join'  => array(
			 		'insumos' => 'insumos.id_insumo = ajustes.id_insumo', 
			 		'unidades_medida' => 'unidades_medida.id_unidad_medida = insumos.id_unidad_medida', 
			 		'instituciones' => 'instituciones.id_institucion = ajustes.id_institucion', 
			 	),  
			 	//'where'  => 'ajustes.estado = "1"',
			 	'order'  => 'insumos.id_insumo DESC',
			 	'return' => 'result', 
			);
			$data['insumos'] = $this->crud->read($data['data']);
			
			$data['titulo'] = 'Ajustes de inventario';
			$data['contenido'] = 'insumos/ajustes/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function nuevo()
	{
		if( stripos($_SESSION['permiso']['insumos_ajustes'], 'c') !== FALSE) 
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

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'insumos',    
			 	'where' => 'insumos.estado = "1"', 
			 	'return' => 'result', 
			);
			$data['insumos'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Nuevo ajuste de inventario';
			$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'insumos/ajustes/nuevo';
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

	 		if ($this->form_validation->run('ajustes') == TRUE) 
	 		{
	 			$data['data'] = array(		 				 
	 				'id_institucion' 	=> $id_institucion,  
	 				'id_insumo'  		=> $id_insumo,  
	 				'tipo'  			=> $tipo,  
	 				'cantidad'  		=> $cantidad,  
	 				'fecha_vencimiento' => $fecha_vencimiento,   
	 				'descripcion'  		=> $descripcion,  
	 			);
	 			$data['table'] = 'ajustes';
	 			$this->crud->create($data);
	 			
 				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'ajustes', 
				 	'where'  => 'ajustes.id_institucion = "'.$id_institucion.'" AND
				 		ajustes.id_insumo = "'.$id_insumo.'" AND
				 		ajustes.tipo = "'.$tipo.'" AND
				 		ajustes.cantidad = "'.$cantidad.'" AND
				 		ajustes.fecha_vencimiento = "'.$fecha_vencimiento.'" AND
				 		ajustes.descripcion = "'.$descripcion.'" ',
				 	'return' => 'row',
				);
				$resultado = $this->crud->read($data['data']);
	
				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'ajustes',  
	 				'id'    		=> $resultado->id_ajuste, 
	 				'bitacora'		=> 'Ajuste registrado', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			if( stripos($_SESSION['permiso']['insumos_ajustes'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Ajuste registrado exitosamente!',  
	            		'redirect'  => base_url('insumos/ajustes'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Ajuste registrado exitosamente!',  
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
		if( stripos($_SESSION['permiso']['insumos_ajustes'], 'u') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'ajustes',
			 	'join'  => array(
			 		'insumos' => 'insumos.id_insumo = ajustes.id_insumo', 
			 		'instituciones' => 'instituciones.id_institucion = ajustes.id_institucion', 
			 	),
			 	'where'  => 'ajustes.id_ajuste = '.$id,  
			 	'return' => 'row',
			);
			$data['ajuste'] = $this->crud->read($data['data']);

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

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'insumos',    
			 	'where' => 'insumos.estado = "1"', 
			 	'return' => 'result', 
			);
			$data['insumos'] = $this->crud->read($data['data']);

			$data['titulo'] = 'Editar ajuste de inventario';
			$data['contenido'] = 'insumos/ajustes/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['insumos_ajustes'], 'd') !== FALSE ) 
		{
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'ajustes',
			 	'join'  => array(
			 		'insumos' => 'insumos.id_insumo = ajustes.id_insumo', 
			 		'instituciones' => 'instituciones.id_institucion = ajustes.id_institucion', 
			 	),
			 	'where'  => 'ajustes.id_ajuste = '.$id,  
			 	'return' => 'row',
			);
			$ajuste = $data['ajuste'] = $this->crud->read($data['data']);

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

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'insumos',    
			 	'where' => 'insumos.estado = "1"', 
			 	'return' => 'result', 
			);
			$data['insumos'] = $this->crud->read($data['data']);
			
			if($ajuste->estado == '0')
				{ $accion = $data['accion'] = 'Activar'; }
			else{ $accion = $data['accion'] = 'Desactivar';}
			
			$data['titulo'] = $accion.' ajuste de inventario';
			$data['contenido'] = 'insumos/ajustes/estado';
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
	 			if ($this->form_validation->run('ajustes') == TRUE) 
	 			{			    	
			    	$data = array(
	            		'table' => 'ajustes', 
	            		'where' => 'ajustes.id_ajuste = '.$id, 
	            	);
            		$data['set'] = array(  
		 				'tipo'  				=> $tipo,  
	            		'cantidad' 				=> $cantidad,  
		 				'fecha_vencimiento'  	=> $fecha_vencimiento,  
		 				'descripcion'  			=> $descripcion,   
	            	);	            	
	            	$this->crud->edit($data);
				    
				    $data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'ajustes',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Ajuste editado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    	

		 			$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Ajuste editado exitosamente!',  
	            		'redirect'  => base_url('insumos/ajustes'), 
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
				 	'table'  => 'ajustes',
				 	'where'  => 'ajustes.id_ajuste = '.$id, 
				 	'return' => 'row',
				);
				$insumo = $this->crud->read($data['data']);

				if($insumo->estado == '0')
				{
					$data = array(
	            		'table' => 'ajustes', 
	            		'where' => 'ajustes.id_ajuste = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'ajustes',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Ajuste activado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Ajuste activado exitosamente!',  
	            		'redirect'  => base_url('insumos/ajustes'), 
	            	);
	            	echo json_encode($json);
		 			
				}
				else
				{
					$data = array(
	            		'table' => 'ajustes', 
	            		'where' => 'ajustes.id_ajuste = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'ajustes',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Ajuste desactivado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Ajuste desactivado exitosamente!',  
	            		'redirect'  => base_url('insumos/ajustes'), 
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

	public function pdf()
	{
		/*$keys_post = array_keys($this->input->post());
	 	foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }*/

	 	/*$idInstitucion = $_SESSION['login']['id_institucion_actual'];

        $sql = 'SELECT b.institucion, i.codigo, i.insumo, u.medida, u.notacion, i.descripcion, i.presentacion,  
                COALESCE(SUM(CASE WHEN a.tipo = "e" THEN a.cantidad ELSE 0 END), 0) -
                COALESCE(SUM(CASE WHEN a.tipo = "s" THEN a.cantidad ELSE 0 END), 0) AS existencia
                FROM insumos i
                LEFT JOIN ajustes a ON i.id_insumo = a.id_insumo
                LEFT JOIN instituciones b ON a.id_institucion = b.id_institucion
                LEFT JOIN unidades_medida u ON u.id_unidad_medida = i.id_unidad_medida
                WHERE a.estado = "1"';

        if ($idInstitucion != 0) 
        {
            $sql .= ' AND a.id_institucion = '.$idInstitucion;
        }
        $sql .= ' GROUP BY a.id_institucion, i.id_insumo, i.insumo';
        $data['sql'] = array('sql' => $sql, );*/

		$this->load->library('tcpdf/TCPDF.php');

		$pdf = new TCPDF('P', 'mm', 'letter', true, 'UTF-8', false);
		$title = 'Reporte de inventario';
		$pdf->SetTitle($title);	
		$pdf->SetMargins('20', '10', '20', '10');
		$pdf->SetFont('Helvetica', '', 10);

		$html = $this->load->view('insumos/ajustes/reporte', '', TRUE);
		
		$pdf->AddPage();	
		
		/*$pdf->SetY(230);
		$pdf->Cell(0, 13, $_SESSION['login']['nombre'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 13, $_SESSION['login']['cargo'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 13, $_SESSION['login']['facultad'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 13, $_SESSION['login']['sede'], 0, 1, 'C', 0, '', 0, false, 'M', 'M');*/
		
		$pdf->writeHTMLCell(0, 0, '', 5, $html, 0, 1, 0, true, '', true);

		/*$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 100, // width of a single module in points
		    'module_height' => 100 // height of a single module in points
		);*/
		// QRCODE,L : QR-CODE Low error correction
		/*$pdf->write2DBarcode($estudiante->cedula.' | '.$estudiante->primer_nombre.' '.$estudiante->segundo_nombre.' '.$estudiante->primer_apellido.' '.$estudiante->segundo_apellido.' | '.$estudiante->carrera.' | '.$estudiante->periodo.' | '.$estudiante->modalidad_ingreso , 'QRCODE,H', 10, 250, 25, 25, $style, 'N');*/
		
		
		header("Content-type: application/pdf");
		$pdf->Output( $title.'.pdf', 'I');
		
	}

	
}
