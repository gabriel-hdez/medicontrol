<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
    	<div class="row titulo">
    		<h4 class="left" ><?php echo $titulo;?></h4>
    	</div>

        <form data-response="json" method="POST" action="<?php echo base_url('registros/perfiles/actualizar');?>">
            <input type="hidden" name="token" value="editar">
            <input type="hidden" name="id" value="<?php echo $perfil->id_perfil; ?>">

            <div class="row">
                <div class="col s12 m6 l4 input-field">
                    <input id="perfil" name="perfil" type="text" class="validate" value="<?php echo $perfil->perfil;?>">
                    <label for="perfil">NOMBRE DEL PERFIL</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>

                <div class="col s12 l4 input-field">
                    <select name="id_institucion" id="id_institucion" class="select2 browser-default "  >
                        <?php foreach($instituciones as $item): if($item->id_institucion == $_SESSION['login']['id_institucion_actual']){ ?>
                            <option value="<?php echo $item->id_institucion; ?>" ><?php echo $item->institucion; ?></option>
                        <?php break; }else{ ?>
                            <option value="<?php echo $item->id_institucion; ?>" <?php if($perfil->id_institucion == $item->id_institucion){echo 'selected';}?>  ><?php echo $item->institucion; ?></option>
                        <?php } endforeach; ?>
                    </select>
                    <label for="id_institucion" class="active">INSTITUTO DE SALUD</label>
                </div>
            </div>

            <?php $this->load->view('registros/perfiles/privilegios'); ?>

            <div class="row p-bottom-2">
                <div class="col s12 center">
                    <button type="submit" class="waves-effect waves-light btn blue">ACTUALIZAR</button>
                    <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('registros/perfiles'); ?>">REGRESAR</a>
                </div>
            </div>
        </form>

	</div>
