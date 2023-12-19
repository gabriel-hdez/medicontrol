<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['registros_instituciones'], 'c') !== FALSE): if($_SESSION['login']['id_institucion_actual'] == 0): ?>
		  <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('registros/instituciones/agregar'); ?>">AGREGAR</a>
        <?php endif; endif; ?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" id="instituciones" >
		<thead>
        	<tr>
            	<th class="center" width="10%">RIF</th>
                <th class="center" width="15%">INSTITUCIÓN</th>
                <th class="center" width="15%">TELEFONO</th>
                <th class="center" width="30%">CORREO ELECTRÓNICO</th>
                <th class="center" width="20%">DIRECCIÓN</th>
                <?php if( stripos($_SESSION['permiso']['registros_instituciones'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_instituciones'], 'd') !== FALSE ): ?>
            	   <th class="center" width="10%">ACCIONES</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($instituciones as $item): ?>
        	<tr>
                <td class="center"><?php echo strtoupper(substr($item->tipo_persona,0,1)).'-'.$item->rif ;?></td>
                <td class="center"><?php echo $item->institucion;?></td>
                <td class="center"><?php echo $item->tlf;?></td>
                <td class="center"><?php echo $item->correo;?></td>
                <td class="center" width="20%"><?php echo $item->direccion;?></td>
                <?php if( stripos($_SESSION['permiso']['registros_instituciones'], 'u') !== FALSE || stripos($_SESSION['permiso']['registros_instituciones'], 'd') !== FALSE ): ?>
                <td class="center">
                    <?php if($item->estado == '1'){ ?>
                        <?php if( stripos($_SESSION['permiso']['registros_instituciones'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/instituciones/estado/').$item->id_institucion; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php endif; ?>
                        <?php if( stripos($_SESSION['permiso']['registros_instituciones'], 'u') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/instituciones/editar/').$item->id_institucion; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        <?php endif; ?>
                    <?php }else{ ?>
                        <?php if( stripos($_SESSION['permiso']['registros_instituciones'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('registros/instituciones/estado/').$item->id_institucion; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
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