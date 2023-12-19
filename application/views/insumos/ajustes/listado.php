<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['insumos_ajustes'], 'c') !== FALSE): ?>
          <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('insumos/ajustes/nuevo'); ?>">NUEVO</a>
        <?php 
        endif; if( stripos($_SESSION['permiso']['insumos_reporte'], 'r') !== FALSE): ?>
		  <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('insumos/ajustes/pdf'); ?>" style="margin-right: 1rem;" target="_blank">REPORTE PDF</a>
          <?php endif;?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
		<thead>
        	<tr>
                <th class="center">INSTITUCION</th>
                <th class="center">CODIGO</th>
                <th class="center">INSUMO</th>
                <th class="center">TIPO</th>
                <th class="center">CANTIDAD</th>
                <?php if( stripos($_SESSION['permiso']['insumos_ajustes'], 'u') !== FALSE || stripos($_SESSION['permiso']['insumos_ajustes'], 'd') !== FALSE ): ?>
            	   <th class="center">ACCIONES</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($insumos as $item): ?>
        	<tr>
                <td class="center"><?php echo $item->institucion;?></td>
                <td class="center"><?php echo $item->codigo;?></td>
                <td class="center"><?php echo $item->insumo;?></td>
                <td class="center"><?php if($item->tipo == 'e'){echo 'ENTRADA';}else{echo 'SALIDA';} ;?></td>
                <td class="center"><?php echo $item->cantidad;?></td>
                <?php if( stripos($_SESSION['permiso']['insumos_ajustes'], 'u') !== FALSE || stripos($_SESSION['permiso']['insumos_ajustes'], 'd') !== FALSE ): ?>
                <td class="center">
                    <?php if($item->estado == '1'){ ?>
                        <?php if( stripos($_SESSION['permiso']['insumos_ajustes'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('insumos/ajustes/estado/').$item->id_ajuste; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php endif; ?>
                        <?php if( stripos($_SESSION['permiso']['insumos_ajustes'], 'u') !== FALSE): ?>
                            <a href="<?php echo base_url('insumos/ajustes/editar/').$item->id_ajuste; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        <?php endif; ?>
                    <?php }else{ ?>
                        <?php if( stripos($_SESSION['permiso']['insumos_ajustes'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('insumos/ajustes/estado/').$item->id_ajuste; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
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