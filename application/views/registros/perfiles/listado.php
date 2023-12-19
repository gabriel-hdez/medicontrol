<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['registros_perfiles'], 'c') !== FALSE): ?>
		  <a  class="right waves-effect waves-light btn blue" href="<?php echo base_url('registros/perfiles/agregar'); ?>">AGREGAR</a>
        <?php endif; ?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" id="perfiles" >
		<thead>
        	<tr>
            	<!-- <th class="center">NRO</th> -->
                <th class="center">PERFIL</th>
                <th class="center">INSTITUTO DE SALUD</th>
                <?php if( stripos($_SESSION['permiso']['registros_perfiles'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_perfiles'], 'd') !== FALSE ): ?>
            	   <th class="center">ACCIONES</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($perfiles as $item): ?>
        	<tr>
        		<!-- <td class="center"><?php //echo $item->id_perfil;?></td> -->
                <td class="center"><?php echo $item->perfil;?></td>
                <td class="center"><?php echo $item->institucion;?></td>
                <?php if( stripos($_SESSION['permiso']['registros_perfiles'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_perfiles'], 'd') !== FALSE ): ?>
                <td class="center">
                    <?php if($item->id_perfil > 2): ?>
                        <?php if($item->estado == '1'){ ?>
                            <?php if( stripos($_SESSION['permiso']['registros_perfiles'], 'd') !== FALSE): ?>
                                <a href="<?php echo base_url('registros/perfiles/estado/').$item->id_perfil; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                    <i class="material-icons">close</i>
                                </a>
                            <?php endif; ?>
                            <?php if( stripos($_SESSION['permiso']['registros_perfiles'], 'u') !== FALSE): ?>
                                <a href="<?php echo base_url('registros/perfiles/editar/').$item->id_perfil; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                    <i class="material-icons">mode_edit</i>
                                </a>
                            <?php endif; ?>
                        <?php }else{ ?>
                            <?php if( stripos($_SESSION['permiso']['registros_perfiles'], 'd') !== FALSE): ?>
                                <a href="<?php echo base_url('registros/perfiles/estado/').$item->id_perfil; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
                                    <i class="material-icons">restore</i>
                                </a>
                            <?php endif; ?>
                        <?php } endif; ?>

                    <!-- <a href="<?php // echo base_url('perfiles/restaurar/').$item->id_perfil; ?>" class="center btn-floating waves-effect waves-light green darken-2 tooltipped" data-position="top" data-tooltip="Aprobar">
                        <i class="material-icons">check</i>
                    </a>
                    <a href="<?php // echo base_url('perfiles/restaurar/').$item->id_perfil; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Reporte PDF">
                        <i class="material-icons">print</i>
                    </a> -->
                </td>
                <?php endif; ?>
        	</tr>
            <?php endforeach; ?>
           
        </tbody>
	</table>
</div>
<!--   carga libreria datatables  -->
<?php $this->load->view('template/datatables'); ?>