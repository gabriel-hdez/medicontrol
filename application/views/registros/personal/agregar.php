<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('registros/personal/guardar');?>">
        
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_tipo_persona" id="id_tipo_persona" class="select2 browser-default"  >
                    <?php foreach($tipos_persona as $item): ?>
                        <option value="<?php echo $item->id_tipo_persona; ?>"  ><?php echo $item->tipo_persona; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_tipo_persona" class="active">NACIONALIDAD</label>
            </div> 
            <div class="col s12 l4 input-field">
                <input id="cedula" name="cedula" type="text" class="validate simple-field-data-mask" data-mask="000000000" placeholder="12345678" data-url="<?php echo base_url('registros/personal/cedula'); ?>">
                <label for="cedula">CEDULA</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>  
            <div class="col s12 l4 input-field">
                <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" >
                <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>      
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="nombres" name="nombres" type="text" class="validate" placeholder="Pedro Jose">
                <label for="nombres">NOMBRES</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="apellidos" name="apellidos" type="text" class="validate" placeholder="Perez Gonzalez">
                <label for="apellidos">APELLIDOS</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>   
            <div class="col s12 l4 input-field">
                <select name="id_genero" id="id_genero" class="select2 browser-default" >
                    <?php foreach($generos as $item): ?>
                        <option value="<?php echo $item->id_genero; ?>"  ><?php echo $item->genero; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_genero" class="active">GÉNERO</label>
            </div>            
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="correo" name="correo" type="text" class="validate" placeholder="pedro@correo.com">
                <label for="correo">CORREO ELECTRÓNICO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567">
                <label for="tlf">TELÉFONO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_estado" id="id_estado" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios'); ?>" >
                        <option value="0" >Seleccione</option>
                    <?php foreach($estados as $item): ?>
                        <option value="<?php echo $item->id_estado; ?>" ><?php echo $item->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_estado" class="active">ESTADO</label>
            </div>            
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_municipio" id="id_municipio" class="select2 browser-default select-anidado select-municipios" data-url="<?php echo base_url('inicio/parroquias/select-parroquias'); ?>" >
                    <option value="0" >Seleccione</option>
                </select>
                <label for="id_municipio" class="active">MUNICIPIO</label>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_parroquia" id="id_parroquia" class="select2 browser-default select-parroquias" >
                    <option value="0" >Seleccione</option>
                </select>
                <label for="id_parroquia" class="active">PARROQUIA</label>
            </div>
            <div class="col s12 l4 input-field">
                <input id="direccion" name="direccion" type="text" class="validate" >
                <label for="direccion">DIRECCIÓN</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>            
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="colegiatura" name="colegiatura" type="text" class="validate" >
                <label for="colegiatura">NUMERO COLEGIADO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default select-anidado" data-url="<?php echo base_url('registros/personal/perfiles/select-perfil'); ?>" >
                        <option value="0" >Seleccione</option>
                    <?php foreach($instituciones as $item): if($item->id_institucion == $_SESSION['login']['id_institucion_actual']){ ?>
                        <option value="<?php echo $item->id_institucion; ?>" ><?php echo $item->institucion; ?></option>
                    <?php break; }else{ ?>
                        <option value="<?php echo $item->id_institucion; ?>" ><?php echo $item->institucion; ?></option>
                    <?php } endforeach; ?>
                </select>
                <label for="id_institucion" class="active">INSTITUTO DE SALUD</label>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_perfil" id="id_perfil" class="select2 browser-default select-perfil"  >
                        <option value="0" >Seleccione</option>
                    <?php if(isset($perfiles)){ foreach ($perfiles as $item): ?>
                        <option value="<?php echo $item->id_perfil; ?>" ><?php echo $item->perfil; ?></option>
                    <?php endforeach; } ?>
                </select>
                <label for="id_perfil" class="active">PERFIL</label>
            </div>
        </div>      
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue">GUARDAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('registros/personal'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>

<?php $this->load->view('registros/personal/js'); ?>

