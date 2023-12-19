<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('registros/perfiles/actualizar');?>">
        <input type="hidden" name="token" value="<?php echo $accion; ?>">
        <input type="hidden" name="id" value="<?php echo $perfil->id_perfil; ?>">

        <div class="row">
            <div class="col s12 m6 l4 input-field">
                <input id="perfil" name="perfil" type="text" value="<?php echo $perfil->perfil;?>" readonly>
                <label for="perfil">NOMBRE DEL PERFIL</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default "  disabled>
                    <?php foreach($instituciones as $item): ?>
                        <option value="<?php echo $item->id_institucion; ?>" <?php if($perfil->id_institucion == $item->id_institucion){echo 'selected';}?> ><?php echo $item->institucion; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_institucion" class="active">INSTITUTO DE SALUD</label>
            </div>
            
        </div>
        
        <?php $this->load->view('registros/perfiles/privilegios'); ?>
        
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue"><?php echo $accion; ?></button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('registros/perfiles'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

	</div>

