<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['registros_pacientes'], 'c') !== FALSE): ?>
		  <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('registros/pacientes/agregar'); ?>">AGREGAR</a>
        <?php endif; ?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" >
		<thead>
        	<tr>
            	<!-- <th class="center">NRO</th> -->
                <th class="center">CEDULA</th>
                <th class="center">NOMBRES</th>
                <th class="center">APELLIDOS</th>
                <th class="center">FECHA NACIMIENTO</th>
                <?php if( stripos($_SESSION['permiso']['registros_pacientes'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_pacientes'], 'd') !== FALSE ): ?>
            	   <th class="center">ACCIONES</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($pacientes as $item): ?>
        	<tr>
                <td class="center"><?php echo strtoupper( substr($item->tipo_persona,0,1)).'-'.$item->cedula;?></td>
                <td class="center"><?php echo $item->nombres;?></td>
                <td class="center"><?php echo $item->apellidos;?></td>
                <td class="center"><?php echo $item->fecha_nacimiento;?></td>
                <?php if( stripos($_SESSION['permiso']['registros_pacientes'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_pacientes'], 'd') !== FALSE ): ?>
                <td class="center">
                    <?php if($item->estado == '1'){ ?>
                        <?php if( stripos($_SESSION['permiso']['registros_pacientes'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/pacientes/estado/').$item->id_paciente; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php endif; ?>
                        <?php if( stripos($_SESSION['permiso']['registros_pacientes'], 'u') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/pacientes/editar/').$item->id_paciente; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        <?php endif; ?>
                    <?php }else{ ?>
                        <?php if( stripos($_SESSION['permiso']['registros_pacientes'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/pacientes/estado/').$item->id_paciente; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
                                <i class="material-icons">restore</i>
                            </a>
                        <?php endif; ?>
                    <?php } ?>
                </td>
                <?php endif; ?>
        	</tr>
            <?php endforeach; ?>
           
        </tbody>
	</table>
</div>
<!--   carga libreria datatables  -->
<?php $this->load->view('template/datatables'); ?>