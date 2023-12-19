<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
        <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'c') !== FALSE): ?>
		  <a  class="right waves-effectwaves-light btn blue" href="<?php echo base_url('citas/solicitar/nuevo'); ?>">NUEVO</a>
        <?php endif; ?>
	</div>

	<table class="display highlight" cellspacing="0" width="100%" id="especialidades" >
		<thead>
        	<tr>
            	<!-- <th class="center">NRO</th> -->
                <th class="center" width="10%">FECHA SOLICITUD</th>
                <th class="center" width="20%">INSTITUCION</th>
                <th class="center" width="10%">ESPECIALIDAD</th>
                <th class="center" width="15%">MEDICO</th>
                <th class="center" width="15%">PACIENTE</th>
                <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'u') !== FALSE || stripos($_SESSION['permiso']['citas_solicitar'], 'd') !== FALSE ): ?>
            	   <th class="center" width="10%">ACCIONES</th>
                <?php endif; ?>
                <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'a') !== FALSE || $_SESSION['login']['id_perfil_actual'] == 2 ):?>
                    <th class="center" width="10%">APROBACION</th>
                <?php endif; ?>
          	</tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $item): ?>
        	<tr>
                <td class="center"><?php echo $item->fecha_solicitud;?></td>
                <td class="center"><?php echo $item->institucion;?></td>
                <td class="center"><?php echo $item->especialidad;?></td>
                <td class="center"><?php echo $item->med_nombre.' '.$item->med_apellido;?></td>
                <td class="center"><?php echo $item->pac_nombre.' '.$item->pac_apellido;?></td>

                <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'u') !== FALSE || stripos($_SESSION['permiso']['citas_solicitar'], 'd') !== FALSE ): ?>
                    <?php if($item->estado == '1'){ ?>
                        <td class="center">
                        <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'd') !== FALSE): ?>
                            <a href="<?php echo base_url('citas/solicitar/estado/').$item->id_cita; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Desactivar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php endif; ?>
                        <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'u') !== FALSE): ?>
                            <a href="<?php echo base_url('citas/solicitar/editar/').$item->id_cita; ?>" class="center btn-floating waves-effect waves-light blue-grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">mode_edit</i>
                            </a>
                        <?php endif; ?>

                        <?php //if($_SESSION['login']['id_perfil_actual'] == 2): ?>
                            </td>
                            <td class="center">
                                <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'a') !== FALSE ): ?>
                                    <label>
                                        <input type="checkbox" class="check" data-url="<?php echo base_url('citas/solicitar/aprobacion/').$item->id_cita;?>" <?php if($item->aprobacion != '0000-00-00'){echo 'checked';}?> >
                                        <span></span>
                                    </label>
                                <?php endif; ?>
                                <?php if($item->aprobacion == '0000-00-00'){ ?>
                                    <a class="center btn-floating waves-effect waves-light tooltipped" data-position="top" data-tooltip="Comprobante PDF" disabled>
                                        <i class="material-icons">picture_as_pdf</i>
                                    </a>
                                <?php }else{ ?>
                                    <a target="_blank" href="<?php echo base_url('citas/solicitar/pdf/').$item->id_cita; ?>" class="center btn-floating waves-effect waves-light blue tooltipped" data-position="top" data-tooltip="Comprobante PDF" >
                                        <i class="material-icons">picture_as_pdf</i>
                                    </a>
                                <?php } ?>
                            </td> 
                        <?php //endif; ?>

                    <?php }else{ ?>

                        <?php if( stripos($_SESSION['permiso']['citas_solicitar'], 'd') !== FALSE): ?>
                            <td></td>
                            <td>
                                <a href="<?php echo base_url('citas/solicitar/estado/').$item->id_cita; ?>" class="center btn-floating waves-effect waves-light red darken-2 tooltipped" data-position="top" data-tooltip="Activar">
                                    <i class="material-icons">restore</i>
                                </a>
                            </td>
                        <?php endif; ?>
                    <?php } ?>
                <?php endif; ?>

        	</tr>
            <?php endforeach; ?>
           
        </tbody>
	</table>
</div>

<!-- <div id="modal" class="modal">
    <form data-response="json" id="formAprobracion" method="POST" action="<?php //echo base_url('citas/especialidades/agregar');?>">
        <input name="param" type="hidden" value="#id_especialidad">
        
        <div class="modal-content">
            <div class="row center">
                <h5>Aprobar cita</h5>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6 push-m3 push-l3">
                    <i class="material-icons prefix password blue-grey-text text-darken-3" data-visibility="off">visibility</i>
                    <input id="clave" name="clave" type="password" class="validate" style="background: transparent !important;">
                    <label for="clave">CONTRASEÑA</label>
                    <span class="helper-text" data-success="¡Se ve bien!"></span>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="waves-effect waves-light btn blue actualizar" >AGREGAR</button>
          <a class="modal-close waves-effect waves-light btn-flat">CERRAR</a>
        </div>
    </form>
</div> -->

<!--   carga libreria datatables  -->
<?php $this->load->view('template/datatables'); ?>

<script defer>
$(document).ready(function() {
   
   $('.check').change(function() {
        var url = $(this).attr('data-url');
        window.location.href = url;        
    }); 

});
</script> 