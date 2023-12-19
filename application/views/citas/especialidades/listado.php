<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['citas_especialidades'], 'c') !== FALSE): ?>
		  <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('citas/especialidades/nuevo'); ?>">NUEVO</a>
        <?php endif; ?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" id="especialidades" >
		<thead>
        	<tr>
            	<!-- <th class="center">NRO</th> -->
                <th class="center">INSTITUCION</th>
                <th class="center">ESPECIALIDAD</th>
                <th class="center">MEDICO</th>
                <?php if( stripos($_SESSION['permiso']['citas_especialidades'], 'u') !== FALSE || stripos($_SESSION['permiso']['citas_especialidades'], 'd') !== FALSE ): ?>
            	   <th class="center">ACCIONES</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($especialidades as $item): ?>
        	<tr>
                <td class="center"><?php echo $item->institucion;?></td>
                <td class="center"><?php echo $item->especialidad;?></td>
                <td class="center"><?php echo substr($item->tipo_persona, 0,1).'-'.$item->cedula.', '.$item->nombres.' '.$item->apellidos;?></td>
                <?php if( stripos($_SESSION['permiso']['citas_especialidades'], 'u') !== FALSE || stripos($_SESSION['permiso']['citas_especialidades'], 'd') !== FALSE ): ?>
                <td class="center">
                    <?php if($item->estado == '1'){ ?>
                        <?php if( stripos($_SESSION['permiso']['citas_especialidades'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('citas/especialidades/estado/').$item->id_disponibilidad; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php endif; ?>
                        <?php if( stripos($_SESSION['permiso']['citas_especialidades'], 'u') !== FALSE): ?>
                            <a href="<?php echo base_url('citas/especialidades/editar/').$item->id_disponibilidad; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        <?php endif; ?>
                    <?php }else{ ?>
                        <?php if( stripos($_SESSION['permiso']['citas_especialidades'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('citas/especialidades/estado/').$item->id_disponibilidad; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
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