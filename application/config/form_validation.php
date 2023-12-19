<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    //  ---------------------------------------------------------------------------------------------  
    'login' => array(
        array(
            'field' => 'usuario',
            'label' => 'usuario',
            'rules' => 'required'
        ),
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'required'
        )
    ),
    //  ---------------------------------------------------------------------------------------------  
    'recuperar_identificar' => array(
        array(
            'field' => 'usuario',
            'label' => 'usuario o correo electrónico',
            'rules' => 'required'
        ),
    ), 
    //  ---------------------------------------------------------------------------------------------  
    'recuperar_confirmar' => array(
        array(
            'field' => 'respuesta',
            'label' => 'respuesta',
            'rules' => 'required'
        ),
    ),  
    //  ---------------------------------------------------------------------------------------------  
    'recuperar_actualizar' => array(
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'max_length[16]|matches[repetir]'
        ),
        array(
            'field' => 'repetir',
            'label' => 'repetir contraseña',
            'rules' => 'max_length[16]|matches[clave]'
        ),
    ),   
    //  ---------------------------------------------------------------------------------------------  
    'perfiles' => array(
        array(
            'field' => 'perfil',
            'label' => 'nombre del perfil',
            'rules' => 'required|max_length[25]'
        ),
    ), 
    //  ---------------------------------------------------------------------------------------------  
    'perfiles_editar' => array(
        array(
            'field' => 'perfil',
            'label' => 'nombre del perfil',
            'rules' => 'required|max_length[25]'
        ),
    ), 
    //  ---------------------------------------------------------------------------------------------  
    'usuarios' => array(
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]|is_unique[usuarios.correo]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'usuario' => array(
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]|is_unique[usuarios.correo]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
        array(
            'field' => 'clave2',
            'label' => 'contraseña',
            'rules' => 'required|max_length[16]|matches[repetir]'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta de seguridad',
            'rules' => 'required'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta de seguridad',
            'rules' => 'required'
        ),
        array(
            'field' => 'repetir',
            'label' => 'repetir contraseña',
            'rules' => 'required|max_length[16]|matches[clave2]'
        ),
    ), 
    //  ---------------------------------------------------------------------------------------------  
    'usuarios_editar' => array(
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
    ),  
    //  ---------------------------------------------------------------------------------------------  
    'usuario_editar' => array(
        array(
            'field' => 'usuario',
            'label' => 'usuario',
            'rules' => 'required|max_length[25]'
        ),
        array(
            'field' => 'pregunta',
            'label' => 'pregunta de seguridad',
            'rules' => 'required'
        ),
        array(
            'field' => 'respuesta',
            'label' => 'respuesta de seguridad',
            'rules' => 'required'
        ),        
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'max_length[16]|matches[repetir]'
        ),
        array(
            'field' => 'repetir',
            'label' => 'repetir contraseña',
            'rules' => 'max_length[16]|matches[clave]'
        ),
    ), 
    //  ---------------------------------------------------------------------------------------------  
    'instituciones' => array(
        array(
            'field' => 'rif',
            'label' => 'rif',
            'rules' => 'required|is_unique[instituciones.rif]'
        ),
        array(
            'field' => 'institucion',
            'label' => 'institucion',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]|is_unique[instituciones.correo]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'dirección',
            'rules' => 'required|max_length[255]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'instituciones_editar' => array(
        array(
            'field' => 'institucion',
            'label' => 'institucion',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'dirección',
            'rules' => 'required|max_length[255]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'pacientes' => array(
        array(
            'field' => 'fecha_nacimiento',
            'label' => 'fecha de nacimiento',
            'rules' => 'required'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[10]|is_unique[pacientes.cedula]'
        ),
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'direccion',
            'rules' => 'required|max_length[255]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]|is_unique[usuarios.correo]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'pacientes_editar' => array(
        array(
            'field' => 'fecha_nacimiento',
            'label' => 'fecha de nacimiento',
            'rules' => 'required'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[10]'
        ),
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'direccion',
            'rules' => 'required|max_length[255]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'personal' => array(
        array(
            'field' => 'fecha_nacimiento',
            'label' => 'fecha de nacimiento',
            'rules' => 'required'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[12]|is_unique[personal.cedula]'
        ),
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'direccion',
            'rules' => 'required|max_length[255]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]|is_unique[usuarios.correo]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
        array(
            'field' => 'colegiatura',
            'label' => 'numero colegiado',
            'rules' => 'required|is_unique[personal.colegiatura]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'personal_editar' => array(
        array(
            'field' => 'fecha_nacimiento',
            'label' => 'fecha de nacimiento',
            'rules' => 'required'
        ),
        array(
            'field' => 'cedula',
            'label' => 'cedula',
            'rules' => 'required|max_length[12]'
        ),
        array(
            'field' => 'nombres',
            'label' => 'nombres',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'apellidos',
            'label' => 'apellidos',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'direccion',
            'label' => 'direccion',
            'rules' => 'required|max_length[255]'
        ),
        array(
            'field' => 'correo',
            'label' => 'correo electrónico',
            'rules' => 'required|valid_email|max_length[100]'
        ), 
        array(
            'field' => 'tlf',
            'label' => 'teléfono',
            'rules' => 'required|exact_length[12]'
        ),
        array(
            'field' => 'colegiatura',
            'label' => 'numero colegiado',
            'rules' => 'required'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'insumos' => array(
        /*array(
            'field' => 'codigo',
            'label' => 'codigo',
            'rules' => 'required|is_unique[insumos.codigo]|max_length[12]'
        ),*/
        array(
            'field' => 'insumo',
            'label' => 'insumo',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'presentacion',
            'label' => 'presentacion',
            'rules' => 'required'
        ),
        /*array(
            'field' => 'minimo',
            'label' => 'stock minimo',
            'rules' => 'required'
        ),*/ 
    ),
    //  ---------------------------------------------------------------------------------------------  
    'insumos_editar' => array(
        /*array(
            'field' => 'codigo',
            'label' => 'codigo',
            'rules' => 'required|max_length[12]'
        ),*/
        array(
            'field' => 'insumo',
            'label' => 'insumo',
            'rules' => 'required|max_length[50]'
        ),
        array(
            'field' => 'presentacion',
            'label' => 'presentacion',
            'rules' => 'required'
        ),
        /*array(
            'field' => 'minimo',
            'label' => 'stock minimo',
            'rules' => 'required'
        ),*/ 
    ),
    //  ---------------------------------------------------------------------------------------------  
    'ajustes' => array(
        array(
            'field' => 'cantidad',
            'label' => 'cantidad',
            'rules' => 'required|max_length[12]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'especialidades' => array(
        array(
            'field' => 'especialidad',
            'label' => 'especialidad',
            'rules' => 'required|max_length[30]|is_unique[especialidades.especialidad]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'especialidades_editar' => array(
        array(
            'field' => 'especialidad',
            'label' => 'especialidad',
            'rules' => 'required|max_length[30]'
        ),
    ),
    //  ---------------------------------------------------------------------------------------------  
    'aprobacion' => array(
        array(
            'field' => 'clave',
            'label' => 'contraseña',
            'rules' => 'required'
        ),
        array(
            'field' => 'fecha_asignada',
            'label' => 'fecha asignada',
            'rules' => 'required'
        ),
        array(
            'field' => 'hora_asignada',
            'label' => 'hora asignada',
            'rules' => 'required'
        )
    ),
    
    
    
    
);