<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('registros/instituciones/actualizar');?>">
        <input type="hidden" name="token" value="<?php echo $accion; ?>">
        <input type="hidden" name="id" value="<?php echo $institucion->id_institucion; ?>">

        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="razon" id="razon" class="select2 browser-default" disabled>
                    <?php foreach($tipos_persona as $item): if($item->id_tipo_persona > 2): ?>
                        <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($item->id_tipo_persona == $institucion->id_tipo_persona){echo 'selected';}?> ><?php echo $item->tipo_persona; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="razon" class="active">RAZON SOCIAL</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="rif" name="rif" type="text" class="validate simple-field-data-mask" data-mask="00000000-0" placeholder="12345678-9" value="<?php echo $institucion->rif; ?>" disabled>
                <label for="rif">RIF</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!">Campo obligatorio</span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="institucion" name="institucion" type="text" class="validate" placeholder="Nombre de la institucion" value="<?php echo $institucion->institucion; ?>" disabled>
                <label for="institucion">INSTITUCION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        </div>
        <div class="row">            
            <div class="col s12 l4 input-field">
                <input id="correo" name="correo" type="text" class="validate" placeholder="institucion@correo.com" value="<?php echo $institucion->correo; ?>"  disabled>
                <label for="correo">CORREO ELECTRÓNICO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $institucion->tlf; ?>" disabled>
                <label for="tlf">TELÉFONO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_estado" id="id_estado" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios'); ?>" disabled>
                        
                    <?php foreach($estados as $item): ?>
                        <option value="<?php echo $item->id_estado; ?>" <?php if($item->id_estado == $institucion->id_estado){echo 'selected';}?> ><?php echo $item->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_estado" class="active">ESTADO</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_municipio" id="id_municipio" class="select2 browser-default select-anidado select-municipios" data-url="<?php echo base_url('inicio/parroquias/select-parroquias'); ?>" disabled>
                   
                    <?php foreach($municipios as $item): if($item->id_estado == $institucion->id_estado): ?>
                        <option value="<?php echo $item->id_municipio; ?>" <?php if($item->id_municipio == $institucion->id_municipio){echo 'selected';}?> ><?php echo $item->municipio; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_municipio" class="active">MUNICIPIO</label>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_parroquia" id="id_parroquia" class="select2 browser-default select-parroquias" disabled>
                    
                   <?php foreach($parroquias as $item): if($item->id_municipio == $institucion->id_municipio): ?>
                        <option value="<?php echo $item->id_parroquia; ?>" <?php if($item->id_parroquia == $institucion->id_parroquia){echo 'selected';}?> ><?php echo $item->parroquia; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_parroquia" class="active">PARROQUIA</label>
            </div>

            <div class="col s12 l4 input-field">
                <input id="direccion" name="direccion" type="text" class="validate"  value="<?php echo $institucion->direccion; ?>" disabled>
                <label for="direccion">DIRECCIÓN</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div> 
            
        </div>
        
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue"><?php echo $accion; ?></button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('registros/instituciones'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>	

