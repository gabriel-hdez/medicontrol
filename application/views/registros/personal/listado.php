<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['registros_personal'], 'c') !== FALSE): ?>
		  <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('registros/personal/agregar'); ?>">AGREGAR</a>
        <?php endif; ?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" >
		<thead>
        	<tr>
            	<!-- <th class="center">NRO</th> -->
                <th class="center">CEDULA</th>
                <th class="center">NOMBRES</th>
                <th class="center">APELLIDOS</th>
                <th class="center">PERFIL</th>
                <th class="center">INSTITUTO</th>
                <?php if( stripos($_SESSION['permiso']['registros_personal'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_personal'], 'd') !== FALSE ): ?>
            	   <th class="center">ACCIONES</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($personal as $item): ?>
        	<tr>
                <td class="center"><?php echo strtoupper(substr($item->tipo_persona, 0,1)).'-'.$item->cedula;?></td>
                <td class="center"><?php echo $item->nombres;?></td>
                <td class="center"><?php echo $item->apellidos;?></td>
                <td class="center"><?php echo $item->perfil;?></td>
                <td class="center"><?php echo $item->institucion;?></td>
                <?php if( stripos($_SESSION['permiso']['registros_personal'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_personal'], 'd') !== FALSE ): ?>
                <td class="center">
                    <?php if($item->detalle_estado == '1'){ ?>
                        <?php if( stripos($_SESSION['permiso']['registros_personal'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/personal/estado/').$item->id_detalle_usuario; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php endif; ?>
                        <?php if( stripos($_SESSION['permiso']['registros_personal'], 'u') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/personal/editar/').$item->id_detalle_usuario; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        <?php endif; ?>
                    <?php }else{ ?>
                        <?php if( stripos($_SESSION['permiso']['registros_personal'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/personal/estado/').$item->id_detalle_usuario; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
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