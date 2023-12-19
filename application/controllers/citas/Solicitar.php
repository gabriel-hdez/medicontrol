<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		unset($_SESSION['token']);
		if( stripos($_SESSION['permiso']['citas_solicitar'], 'r') !== FALSE) 
		{
			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				if($_SESSION['login']['id_perfil_actual'] == 2)
				{
					$data['data'] = array(
					 	'select' => '*, pacientes.cedula AS pac_cedula, pacientes.nombres AS pac_nombre, pacientes.apellidos AS pac_apellido, personal.cedula AS med_cedula, personal.nombres AS med_nombre, personal.apellidos AS med_apellido', 
					 	'table'  => 'citas',  
					 	'join'  => array(
					 		'instituciones' 	=> 'instituciones.id_institucion = citas.id_institucion', 
					 		'pacientes' 		=> 'pacientes.id_paciente = citas.id_paciente', 
					 		'especialidades' 	=> 'especialidades.id_especialidad = citas.id_especialidad', 
					 		'personal' 			=> 'personal.id_personal = citas.id_personal', 
					 		'tipos_persona' 	=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona', 
					 	),  
					 	'where'  => 'citas.id_paciente ='.$_SESSION['login']['id_paciente'] ,
					 	'order'  => 'citas.id_cita DESC',
					 	'return' => 'result', 
					);
					$data['citas'] = $this->crud->read($data['data']);
				}
				else
				{
					$data['data'] = array(
					 	'select' => '*, pacientes.cedula AS pac_cedula, pacientes.nombres AS pac_nombre, pacientes.apellidos AS pac_apellido, personal.cedula AS med_cedula, personal.nombres AS med_nombre, personal.apellidos AS med_apellido', 
					 	'table'  => 'citas',  
					 	'join'  => array(
					 		'instituciones' 	=> 'instituciones.id_institucion = citas.id_institucion', 
					 		'pacientes' 		=> 'pacientes.id_paciente = citas.id_paciente', 
					 		'especialidades' 	=> 'especialidades.id_especialidad = citas.id_especialidad', 
					 		'personal' 			=> 'personal.id_personal = citas.id_personal', 
					 		'tipos_persona' 	=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona', 
					 		//'bitacora' 			=> 'bitacora.id = citas.id_cita', 
					 	),  
					 	//'where'  => 'bitacora.tabla ="citas" AND bitacora.responsable ='.$_SESSION['login']['id_usuario'] ,
					 	'order'  => 'citas.id_cita DESC',
					 	'return' => 'result', 
					);
					$data['citas'] = $this->crud->read($data['data']);
				}

			}
			else
			{
				$data['data'] = array(
				 	'select' => '*, pacientes.cedula AS pac_cedula, pacientes.nombres AS pac_nombre, pacientes.apellidos AS pac_apellido, personal.cedula AS med_cedula, personal.nombres AS med_nombre, personal.apellidos AS med_apellido', 
				 	'table'  => 'citas',  
				 	'join'  => array(
				 		'instituciones' 	=> 'instituciones.id_institucion = citas.id_institucion', 
				 		'pacientes' 		=> 'pacientes.id_paciente = citas.id_paciente', 
				 		'especialidades' 	=> 'especialidades.id_especialidad = citas.id_especialidad', 
				 		'personal' 			=> 'personal.id_personal = citas.id_personal', 
				 	),  
				 	'where'  => 'citas.id_institucion ="'.$_SESSION['login']['id_institucion_actual'].'" AND citas.id_personal ='.$_SESSION['login']['id_personal'] ,
				 	'order'  => 'citas.id_cita DESC',
				 	'return' => 'result', 
				);
				$data['citas'] = $this->crud->read($data['data']);
			}
			
			$data['titulo'] = 'Solicitudes de cita';
			$data['contenido'] = 'citas/solicitar/listado';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function nuevo()
	{
		if( stripos($_SESSION['permiso']['citas_solicitar'], 'c') !== FALSE) 
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

			if($_SESSION['login']['id_institucion_actual'] == 0)
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'disponibilidad',
				 	'join' 	=> array(
				 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'group_by'  => 'instituciones.id_institucion',
				 	'where'  => 'disponibilidad.estado ="1"',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'table' => 'disponibilidad', 
				 	'join' 	=> array(
				 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'group_by'  => 'instituciones.id_institucion',
				 	'where'  => 'disponibilidad.estado ="1" AND instituciones.id_institucion ="'.$_SESSION['login']['id_institucion_actual'].'"',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			}

			$data['titulo'] = 'Nueva solicitud de cita';
			//$_SESSION['token'] = 'nuevo';
			$data['contenido'] = 'citas/solicitar/nuevo';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function especialidad($param)
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		$_SESSION['token']['id_institucion'] = $busqueda;
	 	
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'especialidades'	=> 'especialidades.id_especialidad = disponibilidad.id_especialidad', 
			 	), 
			 	'where'  => 'disponibilidad.estado ="1" AND disponibilidad.id_institucion ="'.$busqueda.'"',
			 	'group_by'  => 'especialidades.id_especialidad',
			 	'return' => 'result', 
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
	 					'id' 		=> $item->id_especialidad, 
	 					'opcion' 	=> $item->especialidad, 
	 				);
	 			}
 			} 			

			$json = array(
        		'status'    => 'select', 
        		'info'    	=> 'Especialidades cargado', 
        		'ajax'    	=> $param, 
        		'options'   => $options,   
        	);
        	echo json_encode($json);		 				           
		} 
		else 
		{
			show_404();
		}
	}

	public function personal($param)
	{
		if ($this->input->is_ajax_request()) 
		{	
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		$_SESSION['token']['id_especialidad'] = $busqueda;
	 	
			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'personal'		=> 'personal.id_personal = disponibilidad.id_personal', 
			 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'disponibilidad.id_institucion = "'.$_SESSION['token']['id_institucion'].'"
			 	AND disponibilidad.id_especialidad ="'.$busqueda.'"',
			 	'order'  => 'personal.id_personal DESC',
			 	'return' => 'result', 
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
	 					'id' 		=> $item->id_personal, 
	 					'opcion' 	=> substr($item->tipo_persona, 0,1).'-'.$item->cedula.', '.$item->nombres.' '.$item->apellidos, 
	 				);
	 			}
 			} 			

			$json = array(
        		'status'    => 'select', 
        		'info'    	=> 'Personal cargado', 
        		'ajax'    	=> $param, 
        		'options'   => $options,   
        	);
        	echo json_encode($json);		 				           
		} 
		else 
		{
			show_404();
		}
	}

	public function horario()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }	
	 		
	 		$_SESSION['token']['id_personal'] = $id_personal;

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',  
			 	'where'  => 'disponibilidad.id_institucion = "'.$_SESSION['token']['id_institucion'].'"
			 		AND disponibilidad.id_especialidad ="'.$_SESSION['token']['id_especialidad'].'"
			 		AND disponibilidad.id_personal ="'.$id_personal.'"',
			 	'return' => 'row', 
			);
			$respuesta = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'horarios',  
			 	'where'  => 'horarios.id_disponibilidad = "'.$respuesta->id_disponibilidad.'"',
			 	'return' => 'result', 
			);
			$horario = $this->crud->read($data['data']);	

			header('Content-Type: application/json');
			echo json_encode($horario);		 				           
		} 
		else 
		{
			show_404();
		}
	}

	public function horas()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }	

	 		$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',  
			 	'where'  => 'disponibilidad.id_institucion = "'.$_SESSION['token']['id_institucion'].'"
			 		AND disponibilidad.id_especialidad ="'.$_SESSION['token']['id_especialidad'].'"
			 		AND disponibilidad.id_personal ="'.$_SESSION['token']['id_personal'].'"',
			 	'return' => 'row', 
			);
			$respuesta = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'horarios',  
			 	'where'  => 'horarios.id_disponibilidad = "'.$respuesta->id_disponibilidad.'"',
			 	'return' => 'result', 
			);
			$horario = $this->crud->read($data['data']);	

			$validacion = '';
			$diaSemana = date("N", strtotime($fechaSeleccionada));
			foreach ($horario as $item) {
				if($item->dia == $diaSemana)
				{
					$timestampSeleccionado = strtotime($horaSeleccionada);
				    $timestampInicio = strtotime($item->hora_inicio);
				    $timestampFinal = strtotime($item->hora_final);

				    if($timestampSeleccionado >= $timestampInicio && $timestampSeleccionado <= $timestampFinal)
				    {
				    	$validacion = '';
				    }
				    else
				    {
				    	$validacion = 'La hora seleccionada debe ser mayor que '.$item->hora_inicio.' y menor que '.$item->hora_final;
				    }
				}
			}

			header('Content-Type: application/json');
			echo json_encode($validacion);		 				           
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

	 		if ($this->form_validation->run('pacientes_editar') == TRUE) 
	 		{
	 			if($id_genero == '0')
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Seleccione el genero', 
	            	);
	            	echo json_encode($json);
	            	die();
	 			}

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
	 			
	 			/*$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'usuarios', 
				 	'where'  => 'usuarios.correo = "'.$correo.'"',
				 	'return' => 'row',
				);
				$usuario = $this->crud->read($data['data']);
				if($usuario != NULL)
				{
					$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'El correo electronico esta asociado a otro usuario', 
	            	);
	            	echo json_encode($json);
	            	die();
				}*/

	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'pacientes', 
				 	'where'  => 'pacientes.cedula = "'.$cedula.'"',
				 	'return' => 'row',
				);
				$paciente = $this->crud->read($data['data']);
				
				if($paciente == NULL)
				{
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
		 				'id_tipo_persona'  	=> $id_tipo_persona,   
		 				'cedula'  			=> $cedula,   
		 				'nombres'  			=> $nombres,   
		 				'apellidos'  		=> $apellidos,   
		 				'fecha_nacimiento'  => $fecha_nacimiento,   
		 				'id_genero'  		=> $id_genero,    
		 				'id_estado'  		=> $id_estado,   
		 				'id_municipio'  	=> $id_municipio,   
		 				'id_parroquia'  	=> $id_parroquia,   
		 				'direccion'  		=> $direccion   
		 			);
		 			$data['table'] = 'pacientes';
		 			$this->crud->create($data);
			 			
	 				$data['data'] = array(
					 	'select' => '*', 
					 	'table'  => 'pacientes', 
					 	'where'  => 'pacientes.fecha_nacimiento = "'.$fecha_nacimiento.'" AND 
					 	pacientes.id_tipo_persona = "'.$id_tipo_persona.'" AND 
					 	pacientes.cedula = "'.$cedula.'" AND 
					 	pacientes.nombres = "'.$nombres.'" AND 
					 	pacientes.apellidos = "'.$apellidos.'" AND 
					 	pacientes.id_genero = "'.$id_genero.'" AND 
					 	pacientes.id_estado = "'.$id_estado.'" AND 
					 	pacientes.id_municipio = "'.$id_municipio.'" AND 
					 	pacientes.id_parroquia = "'.$id_parroquia.'" AND 
					 	pacientes.direccion = "'.$direccion.'" ',
					 	'return' => 'row',
					);
					$paciente = $this->crud->read($data['data']);
		 			
					$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'pacientes',  
		 				'id'    		=> $paciente->id_paciente, 
		 				'bitacora'		=> 'Paciente registrado', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);
		 			
		 			$data['data'] = array(	
		 				'id_perfil'  		=> 2,  
		 				'id_usuario'  		=> $usuario->id_usuario,    
		 				'id'  				=> $paciente->id_paciente,  
		 				'id_institucion'	=> 0 
		 			);
		 			$data['table'] = 'detalles_usuarios';
		 			$this->crud->create($data);
				}
				
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'pacientes', 
				 	'where'  => 'pacientes.cedula = "'.$cedula.'"',
				 	'return' => 'row',
				);
				$paciente = $this->crud->read($data['data']);

				$data['data'] = array(	
	 				'id_paciente'  		=> $paciente->id_paciente,  
	 				'id_especialidad'  	=> $id_especialidad,    
	 				'id_personal'  		=> $id_personal,  
	 				'id_institucion'	=> $id_institucion,  
	 				'fecha_solicitud'	=> $fecha_solicitud, 
	 				'hora_solicitud'	=> $hora_solicitud, 
	 				'aprobacion'		=> '0000-00-00', 
	 			);
	 			$data['table'] = 'citas';
	 			$this->crud->create($data);

	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'citas', 
				 	'where'  => 'citas.id_paciente = "'.$paciente->id_paciente.'" AND 
				 	citas.id_especialidad = "'.$id_especialidad.'" AND 
				 	citas.id_personal = "'.$id_personal.'" AND 
				 	citas.id_institucion = "'.$id_institucion.'" AND 
				 	citas.fecha_solicitud = "'.$fecha_solicitud.'" AND 
				 	citas.hora_solicitud = "'.$hora_solicitud.'"',
					'return' => 'row',
				);
				$cita = $this->crud->read($data['data']);

				$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'citas',  
	 				'id'    		=> $cita->id_cita, 
	 				'bitacora'		=> 'Cita registrada', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data);

	 			if( stripos($_SESSION['permiso']['citas_solicitar'], 'r') !== FALSE)
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Solicitud de cita creada exitosamente!',  
	            		'redirect'  => base_url('citas/solicitar'), 
	            	);
	            	echo json_encode($json);
	 			}
	 			else
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Solicitud de cita creada exitosamente!',  
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
		if( stripos($_SESSION['permiso']['citas_solicitar'], 'u') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*, citas.id_institucion AS cita_institucion, citas.id_especialidad AS cita_especialidad, citas.id_paciente AS cita_paciente, citas.id_personal AS cita_personal', 
			 	'table'  => 'citas',
			 	'join' 	=> array(
			 		'pacientes'				=> 'pacientes.id_paciente = citas.id_paciente', 
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = citas.id_paciente',
			 		'usuarios'				=> 'usuarios.id_usuario = detalles_usuarios.id_usuario',
			 	),    
			 	'where'  => 'detalles_usuarios.id_perfil = "2" AND citas.id_cita ="'.$id.'"',
			 	'return' => 'row', 
			);
			$cita = $data['cita'] = $this->crud->read($data['data']);

			$_SESSION['token']['id_institucion'] = $cita->cita_institucion;
			$_SESSION['token']['id_especialidad'] = $cita->cita_especialidad;
			$_SESSION['token']['id_personal'] = $cita->cita_personal;

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
			 	'table'  => 'disponibilidad',
			 	'join' 	=> array(
			 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
			 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
			 	),  
			 	'group_by'  => 'instituciones.id_institucion',
			 	'where'  => 'disponibilidad.estado ="1"',
			 	'return' => 'result', 
			);
			$data['instituciones'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'where'  => 'municipios.id_estado = "'.$cita->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$cita->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'especialidades'	=> 'especialidades.id_especialidad = disponibilidad.id_especialidad', 
			 	), 
			 	'where'  => 'disponibilidad.estado ="1" AND disponibilidad.id_institucion ="'.$cita->cita_institucion.'"',
			 	'group_by'  => 'especialidades.id_especialidad',
			 	'return' => 'result', 
			);
			$data['especialidades'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'personal'		=> 'personal.id_personal = disponibilidad.id_personal', 
			 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'disponibilidad.id_institucion = "'.$cita->cita_institucion.'"
			 	AND disponibilidad.id_especialidad ="'.$cita->cita_especialidad.'"',
			 	'order'  => 'personal.id_personal DESC',
			 	'return' => 'result', 
			);
			$data['personal'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',
			 	'join' 	=> array(
			 		'horarios'		=> 'horarios.id_disponibilidad = disponibilidad.id_disponibilidad', 
			 	),
			 	'where'  => 'disponibilidad.id_especialidad = "'.$cita->cita_especialidad.'" AND
			 		disponibilidad.id_institucion = "'.$cita->cita_institucion.'" AND
			 		disponibilidad.id_personal = "'.$cita->cita_personal.'" AND
			 		disponibilidad.estado = "1"',  
			 	'return' => 'result',
			);
			$horarios = $this->crud->read($data['data']);

			$numerosDias = [];
			foreach ($horarios as $item) {
			    $numerosDias[] = $item->dia;
			}
			$cadenaDias = implode(", ", $numerosDias);
			$data['dias'] = $cadenaDias;

			$data['titulo'] = 'Editar solicitud de cita';
			$data['contenido'] = 'citas/solicitar/editar';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function aprobacion($id)
	{
		if( stripos($_SESSION['permiso']['citas_solicitar'], 'a') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*, citas.id_institucion AS cita_institucion, citas.id_especialidad AS cita_especialidad, citas.id_paciente AS cita_paciente, citas.id_personal AS cita_personal', 
			 	'table'  => 'citas',
			 	'join' 	=> array(
			 		'pacientes'				=> 'pacientes.id_paciente = citas.id_paciente', 
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = citas.id_paciente',
			 		'usuarios'				=> 'usuarios.id_usuario = detalles_usuarios.id_usuario',
			 	),    
			 	'where'  => 'detalles_usuarios.id_perfil = "2" AND citas.id_cita ="'.$id.'"',
			 	'return' => 'row', 
			);
			$cita = $data['cita'] = $this->crud->read($data['data']);

			$_SESSION['token']['id_institucion'] = $cita->cita_institucion;
			$_SESSION['token']['id_especialidad'] = $cita->cita_especialidad;
			$_SESSION['token']['id_personal'] = $cita->cita_personal;

			if($cita->aprobacion == '0000-00-00')
			{
				$data['accion'] = 'Aprobar';
			}	
			else
			{
				$data['accion'] = 'Desaprobar';
			}

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

			/*if($_SESSION['login']['id_institucion_actual'] == 0)
			{*/
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'disponibilidad',
				 	'join' 	=> array(
				 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'group_by'  => 'instituciones.id_institucion',
				 	'where'  => 'disponibilidad.estado ="1"',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			/*}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'select' => 'disponibilidad', 
				 	'join' 	=> array(
				 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'group_by'  => 'instituciones.id_institucion',
				 	'where'  => 'disponibilidad.estado ="1"',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			}*/

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'where'  => 'municipios.id_estado = "'.$cita->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$cita->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'especialidades'	=> 'especialidades.id_especialidad = disponibilidad.id_especialidad', 
			 	), 
			 	'where'  => 'disponibilidad.estado ="1" AND disponibilidad.id_institucion ="'.$cita->cita_institucion.'"',
			 	'group_by'  => 'especialidades.id_especialidad',
			 	'return' => 'result', 
			);
			$data['especialidades'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'personal'		=> 'personal.id_personal = disponibilidad.id_personal', 
			 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'disponibilidad.id_institucion = "'.$cita->cita_institucion.'"
			 	AND disponibilidad.id_especialidad ="'.$cita->cita_especialidad.'"',
			 	'order'  => 'personal.id_personal DESC',
			 	'return' => 'result', 
			);
			$data['personal'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',
			 	'join' 	=> array(
			 		'horarios'		=> 'horarios.id_disponibilidad = disponibilidad.id_disponibilidad', 
			 	),
			 	'where'  => 'disponibilidad.id_especialidad = "'.$cita->cita_especialidad.'" AND
			 		disponibilidad.id_institucion = "'.$cita->cita_institucion.'" AND
			 		disponibilidad.id_personal = "'.$cita->cita_personal.'" AND
			 		disponibilidad.estado = "1"',  
			 	'return' => 'result',
			);
			$horarios = $this->crud->read($data['data']);

			$numerosDias = [];
			foreach ($horarios as $item) {
			    $numerosDias[] = $item->dia;
			}
			$cadenaDias = implode(", ", $numerosDias);
			$data['dias'] = $cadenaDias;

			$data['titulo'] = $data['accion'].' cita';
			$data['contenido'] = 'citas/solicitar/aprobacion';
			$this->load->view('render', $data);
		}
		else
		{
			redirect(base_url('inicio/bienvenido'));
		}
	}

	public function estado($id)
	{
		if( stripos($_SESSION['permiso']['citas_solicitar'], 'd') !== FALSE) 
		{
			$data['data'] = array(
			 	'select' => '*, citas.id_institucion AS cita_institucion, citas.id_especialidad AS cita_especialidad, citas.id_paciente AS cita_paciente, citas.id_personal AS cita_personal', 
			 	'table'  => 'citas',
			 	'join' 	=> array(
			 		'pacientes'				=> 'pacientes.id_paciente = citas.id_paciente', 
			 		'detalles_usuarios'		=> 'detalles_usuarios.id = citas.id_paciente',
			 		'usuarios'				=> 'usuarios.id_usuario = detalles_usuarios.id_usuario',
			 	),    
			 	'where'  => 'detalles_usuarios.id_perfil = "2" AND citas.id_cita ="'.$id.'"',
			 	'return' => 'row', 
			);
			$cita = $data['cita'] = $this->crud->read($data['data']);

			$_SESSION['token']['id_institucion'] = $cita->cita_institucion;
			$_SESSION['token']['id_especialidad'] = $cita->cita_especialidad;
			$_SESSION['token']['id_personal'] = $cita->cita_personal;

			if($cita->estado == '1')
			{
				$data['accion'] = 'Desactivar ';
			}	
			else
			{
				$data['accion'] = 'Activar';
			}

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

			/*if($_SESSION['login']['id_institucion_actual'] == 0)
			{*/
				$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'disponibilidad',
				 	'join' 	=> array(
				 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'group_by'  => 'instituciones.id_institucion',
				 	'where'  => 'disponibilidad.estado ="1"',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			/*}
			else
			{
				$data['data'] = array(
				 	'select' => '*', 
				 	'select' => 'disponibilidad', 
				 	'join' 	=> array(
				 		'instituciones'	=> 'instituciones.id_institucion = disponibilidad.id_institucion', 
				 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = instituciones.id_tipo_persona', 
				 	),  
				 	'group_by'  => 'instituciones.id_institucion',
				 	'where'  => 'disponibilidad.estado ="1"',
				 	'return' => 'result', 
				);
				$data['instituciones'] = $this->crud->read($data['data']);
			}*/

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'municipios',
			 	'where'  => 'municipios.id_estado = "'.$cita->id_estado.'"',  
			 	'return' => 'result',
			);
			$data['municipios'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'parroquias',
			 	'where'  => 'parroquias.id_municipio = "'.$cita->id_municipio.'"',  
			 	'return' => 'result',
			);
			$data['parroquias'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'especialidades'	=> 'especialidades.id_especialidad = disponibilidad.id_especialidad', 
			 	), 
			 	'where'  => 'disponibilidad.estado ="1" AND disponibilidad.id_institucion ="'.$cita->cita_institucion.'"',
			 	'group_by'  => 'especialidades.id_especialidad',
			 	'return' => 'result', 
			);
			$data['especialidades'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad', 
			 	'join' 	=> array(
			 		'personal'		=> 'personal.id_personal = disponibilidad.id_personal', 
			 		'tipos_persona'	=> 'tipos_persona.id_tipo_persona = personal.id_tipo_persona ',
			 	),  
			 	'where'  => 'disponibilidad.id_institucion = "'.$cita->cita_institucion.'"
			 	AND disponibilidad.id_especialidad ="'.$cita->cita_especialidad.'"',
			 	'order'  => 'personal.id_personal DESC',
			 	'return' => 'result', 
			);
			$data['personal'] = $this->crud->read($data['data']);

			$data['data'] = array(
			 	'select' => '*', 
			 	'table'  => 'disponibilidad',
			 	'join' 	=> array(
			 		'horarios'		=> 'horarios.id_disponibilidad = disponibilidad.id_disponibilidad', 
			 	),
			 	'where'  => 'disponibilidad.id_especialidad = "'.$cita->cita_especialidad.'" AND
			 		disponibilidad.id_institucion = "'.$cita->cita_institucion.'" AND
			 		disponibilidad.id_personal = "'.$cita->cita_personal.'" AND
			 		disponibilidad.estado = "1"',  
			 	'return' => 'result',
			);
			$horarios = $this->crud->read($data['data']);

			$numerosDias = [];
			foreach ($horarios as $item) {
			    $numerosDias[] = $item->dia;
			}
			$cadenaDias = implode(", ", $numerosDias);
			$data['dias'] = $cadenaDias;

			$data['titulo'] = $data['accion'].' cita';
			$data['contenido'] = 'citas/solicitar/estado';
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
	 		if ($token == 'aprobacion') 
	 		{
		    	$data = array(
		    		'select' => '*', 
		    		'table'  => 'usuarios', 
		    		'where'  => 'usuarios.id_usuario = "'.$_SESSION['login']['id_usuario'].'"',
		    		'return'  => 'row'
		    	);
		    	$usuario = $this->crud->read($data);
		    	if ($this->encryption->decrypt($usuario->clave) == $clave)
        		{	
        			$data = array(
			    		'select' => '*', 
			    		'table'  => 'citas', 
			    		'where'  => 'citas.id_cita = "'.$id.'"',
			    		'return'  => 'row'
			    	);
			    	$cita = $this->crud->read($data);

			    	if($cita->aprobacion == '0000-00-00')
			    	{
			    		if ($this->form_validation->run('aprobacion') == TRUE) 
 						{
				    		$data = array(
			            		'table' => 'citas', 
			            		'where' => 'citas.id_cita = '.$id, 
			            	);
		            		$data['set'] = array(
			            		'aprobacion'  		=> date('Y-m-d'),  
					 			'fecha_asignada' 	=> $fecha_asignada, 
					 			'hora_asignada' 	=> $hora_asignada, 
			            	);			    		            	
			            	$this->crud->edit($data);

			            	$data['data'] = array(		 				 
				 				'responsable'   => $_SESSION['login']['id_usuario'], 
				 				'tabla'   		=> 'citas',  
				 				'id'    		=> $id, 
				 				'bitacora'		=> 'Cita aprobada', 
				 			);
				 			$data['table'] = 'bitacora';
				 			$this->crud->create($data);

				 			$json = array(
			            		'status'      => 'alert', 
			            		'info'        => '¡Cita aprobada exitosamente!',  
			            		'redirect'  => base_url('citas/solicitar'), 
			            		//'clearInputs'  => 'on',
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
			    		$data = array(
		            		'table' => 'citas', 
		            		'where' => 'citas.id_cita = '.$id, 
		            	);
	            		$data['set'] = array(
		            		'aprobacion'  		=> '0000-00-00',  
				 			'fecha_asignada' 	=> '0000-00-00', 
				 			'hora_asignada' 	=> '00:00', 
		            	);			    		            	
		            	$this->crud->edit($data);

		            	$data['data'] = array(		 				 
			 				'responsable'   => $_SESSION['login']['id_usuario'], 
			 				'tabla'   		=> 'citas',  
			 				'id'    		=> $id, 
			 				'bitacora'		=> 'Cita desaprobada', 
			 			);
			 			$data['table'] = 'bitacora';
			 			$this->crud->create($data); 
			 			
			 			$json = array(
		            		'status'      => 'alert', 
		            		'info'        => '¡Cita desaprobada exitosamente!',  
		            		'redirect'  => base_url('citas/solicitar'), 
		            		//'clearInputs'  => 'on',
		            	);
		            	echo json_encode($json);
			    	}			   
		    	} 
		    	else
		    	{
		    		$json = array('clave' => 'Contraseña incorrecta');
            		echo json_encode($json);
            		die();			    		
		    	}		            		
	 			
	 		} 
	 		elseif($token == 'editar')
	 		{
	 			if($fecha_solicitud == '')
			    {
			    	$json = array('fecha_solicitud' => 'Debe ingresar una fecha de solicitud de cita');
            		echo json_encode($json);
            		die();	
			    }
				
				if($hora_solicitud == '')
			    {
			    	$json = array('hora_solicitud' => 'Debe ingresar una hora de solicitud de cita');
            		echo json_encode($json);
            		die();
			    }

			    $data = array(
            		'table' => 'citas', 
            		'where' => 'citas.id_cita = '.$id, 
            	);
        		$data['set'] = array( 
		 			'fecha_solicitud' 	=> $fecha_solicitud, 
		 			'hora_solicitud' 	=> $hora_solicitud, 
            	);			    		            	
            	$this->crud->edit($data);

            	$data['data'] = array(		 				 
	 				'responsable'   => $_SESSION['login']['id_usuario'], 
	 				'tabla'   		=> 'citas',  
	 				'id'    		=> $id, 
	 				'bitacora'		=> 'Cita editada', 
	 			);
	 			$data['table'] = 'bitacora';
	 			$this->crud->create($data); 
	 			
	 			$json = array(
            		'status'      => 'alert', 
            		'info'        => '¡Cita editada exitosamente!',  
            		'redirect'  => base_url('citas/solicitar'), 
            		//'clearInputs'  => 'on',
            	);
            	echo json_encode($json);
	 		}
	 		else 
	 		{
	 			$data['data'] = array(
				 	'select' => '*', 
				 	'table'  => 'citas',
				 	'where'  => 'citas.id_cita = '.$id, 
				 	'return' => 'row',
				);
				$cita = $this->crud->read($data['data']);

				if($cita->estado == '0')
				{
					$data = array(
	            		'table' => 'citas', 
	            		'where' => 'citas.id_cita = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '1',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'citas',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Cita activada', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Cita activada exitosamente!',  
	            		'redirect'  => base_url('citas/solicitar'), 
	            	);
	            	echo json_encode($json);		 			
				}
				else
				{
					$data = array(
	            		'table' => 'citas', 
	            		'where' => 'citas.id_cita = '.$id, 
	            	);
					$data['set'] = array(		 				 
		 				'estado'  	=> '0',  
		 			);
		 			$this->crud->edit($data);

		 			$data['data'] = array(		 				 
		 				'responsable'   => $_SESSION['login']['id_usuario'], 
		 				'tabla'   		=> 'citas',  
		 				'id'    		=> $id, 
		 				'bitacora'		=> 'Cita desactivada', 
		 			);
		 			$data['table'] = 'bitacora';
		 			$this->crud->create($data);    
		 				
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Cita desactivada exitosamente!',  
	            		'redirect'  => base_url('citas/solicitar'), 
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

	public function pdf($id)
	{
	 	$data['data'] = array(
	      'select' => '*, pacientes.fecha_nacimiento AS pac_nacimiento, pacientes.cedula AS pac_cedula, pacientes.nombres AS pac_nombre, pacientes.apellidos AS pac_apellido, personal.cedula AS med_cedula, personal.nombres AS med_nombre, personal.apellidos AS med_apellido', 
	      'table'  => 'citas',  
	      'join'  => array(
	        'instituciones'   => 'instituciones.id_institucion = citas.id_institucion', 
	        'pacientes'     => 'pacientes.id_paciente = citas.id_paciente',  
	        //'tipos_persona'   => 'tipos_persona.id_tipo_persona = pacientes.id_tipo_persona', 
	        'especialidades'  => 'especialidades.id_especialidad = citas.id_especialidad', 
	        'personal'      => 'personal.id_personal = citas.id_personal', 
	        //'tipos_persona'   => 'tipos_persona.id_tipo_persona = personal.id_tipo_persona', 
	      ),  
	      'where'  => 'citas.id_cita ='.$id,
	      'return' => 'row', 
	    );
	    $cita = $data['cita'] = $this->crud->read($data['data']);

		$this->load->library('tcpdf/TCPDF.php');

		$pdf = new TCPDF('P', 'mm', 'letter', true, 'UTF-8', false);
		$title = 'Comprobante de cita';
		$pdf->SetTitle($title);	
		$pdf->SetMargins('20', '10', '20', '10');
		$pdf->SetFont('Helvetica', '', 10);

		$html = $this->load->view('citas/solicitar/comprobante', $data, TRUE);
		
		$pdf->AddPage();	
		
		$pdf->writeHTMLCell(0, 0, '', 5, $html, 0, 1, 0, true, '', true);

		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 200, // width of a single module in points
		    'module_height' => 200 // height of a single module in points
		);
		// QRCODE,L : QR-CODE Low error correction
		$pdf->write2DBarcode($cita->pac_cedula.' | '.$cita->pac_nombre.' '.$cita->pac_apellido.' | '.$cita->institucion.' | '.$cita->especialidad.' | '.$cita->med_nombre.' '.$cita->med_apellido , 'QRCODE,H', 10, 250, 25, 25, $style, 'N');

		header("Content-type: application/pdf");
		$pdf->Output( $title.'.pdf', 'I');
		
	}

	
}
