<?php
defined('BASEPATH') OR exit('No direct script access allowed');


  $data['data'] = array(
      'select' => '*', 
      'table'  => 'usuarios',  
      'join'  => array(
        'detalles_usuarios'   => 'detalles_usuarios.id_usuario = usuarios.id_usuario', 
      ),  
      'where'  => 'detalles_usuarios.id_perfil ="2" AND detalles_usuarios.id_institucion ="0" AND detalles_usuarios.id ='.$cita->id_paciente,
      'return' => 'row', 
    );
    $usuario = $this->crud->read($data['data']);


?>
<html>
  <head>
    <style>
        .center{
          text-align: center;
        }
        .titulo{
          font-size: 9px;
          font-weight: bold;
        }
        .tabla{
          width: 100%;
        }
        .linea>td, .linea>th{
          border: 1px solid #000;
        }
        .gris{
          background-color: #CCC;
        }
        th,td{
          line-height: 18px;
          vertical-align: top;        
        }
        p{
          font-size: 11px;
        }
        .parrafo{
          line-height: 25pt;
          text-align: justify;
        }
      </style>
  </head>      
   <body>
       <h2 class="center">MEDICONTROL</h2>     
       
       <h3 class="center">COMPROBANTE DE CITA</h3>     

        <table class="tabla" >
            <thead>
              <tr class="linea">
                  <td class="titulo center gris">INSTITUCION</td>
                  <td class="titulo center gris">ESPECIALIDAD</td>
                </tr>
                         
              <tr class="linea">
                <td class="center"><?php echo $cita->institucion;?></td>
                <td class="center"><?php echo $cita->especialidad;?></td>
              </tr>               
            
              <tr class="linea">
                  <td class="titulo center gris">MEDICO ESPECIALISTA</td>
                  <td class="titulo center gris">FECHA Y HORA SOLICITUD</td>
              </tr>
                         
              <tr class="linea">
                <td class="center"><?php echo $cita->med_cedula.' '.$cita->med_nombre.' '.$cita->med_apellido;?></td>
                <td class="center"><?php echo $cita->fecha_solicitud.', '.$cita->hora_solicitud; ?></td>
              </tr> 

              <tr class="linea">
                  <td class="titulo center gris">FECHA APROBACION</td>
                  <td class="titulo center gris">FECHA Y HORA ASIGNADA</td>
              </tr>
                         
              <tr class="linea">
                <td class="center"><?php echo $cita->aprobacion;?></td>
                <td class="center"><?php echo $cita->fecha_asignada.', '.$cita->hora_asignada; ?></td>
              </tr>               
        </table>

       <h3 class="center">DATOS DEL PACIENTE</h3>  

       <table class="tabla" >
            <thead>
              <tr class="linea">
                  <td class="titulo center gris">CEDULA</td>
                  <td class="titulo center gris">NOMBRES Y APELLIDOS</td>
                </tr>
                         
              <tr class="linea">
                <td class="center"><?php echo $cita->pac_cedula;?></td>
                <td class="center"><?php echo $cita->pac_nombre.' '.$cita->pac_apellido;?></td>
              </tr>               
            
              <tr class="linea">
                  <td class="titulo center gris">FECHA NACIMIENTO</td>
                  <td class="titulo center gris">CORREO ELECTRONICO</td>
              </tr>
                         
              <tr class="linea">
                <td class="center"><?php echo $cita->pac_nacimiento;?></td>
                <td class="center"><?php echo $usuario->correo; ?></td>
              </tr> 
              <tr class="linea">
                  <td class="titulo center gris">TELEFONO</td>
              </tr>
                         
              <tr class="linea">
                <td class="center"><?php echo $usuario->tlf;?></td>
              </tr>               
        </table>

   </body>     
</html>