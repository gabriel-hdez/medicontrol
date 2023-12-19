<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

   <form data-response="json" method="POST" action="<?php echo base_url('registros/pacientes/actualizar');?>">
        <input type="hidden" name="token" value="<?php echo $accion; ?>">
        <input type="hidden" name="id" value="<?php echo $paciente->id_paciente?>">

        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="nac" id="nac" class="select2 browser-default" disabled>
                    <?php foreach($tipos_persona as $item): if($item->id_tipo_persona <= 2): ?>
                        <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($item->id_tipo_persona == $paciente->id_tipo_persona){echo 'selected';}?> ><?php echo $item->tipo_persona; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="nac" class="active">NACIONALIDAD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="cedula" name="cedula" type="text" class="validate" placeholder="12345678" value="<?php echo $paciente->cedula; ?>" disabled>
                <label for="cedula">CEDULA</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" value="<?php echo $paciente->fecha_nacimiento; ?>" disabled>
                <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="nombres" name="nombres" type="text" class="validate" placeholder="Pedro Jose" value="<?php echo $paciente->nombres; ?>" disabled>
                <label for="nombres">NOMBRES</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="apellidos" name="apellidos" type="text" class="validate" placeholder="Perez Gonzalez" value="<?php echo $paciente->apellidos; ?>" disabled>
                <label for="apellidos">APELLIDOS</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>   
            <div class="col s12 l4 input-field">
                <select name="genero" id="genero" class="select2 browser-default" disabled>
                    <?php foreach($generos as $item): ?>
                        <option value="<?php echo $item->id_genero; ?>" <?php if($item->id_genero == $paciente->id_genero){echo 'selected';}?> ><?php echo $item->genero; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="genero" class="active">GÉNERO</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="correo" name="correo" type="text" class="validate" placeholder="pedro@correo.com" value="<?php echo $paciente->correo; ?>" disabled>
                <label for="correo">CORREO ELECTRÓNICO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $paciente->tlf; ?>" disabled>
                <label for="tlf">TELÉFONO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_estado" id="id_estado" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios'); ?>" disabled>
                       <option value="<?php echo $paciente->id_estado; ?>" ><?php echo $paciente->nombre; ?></option>
                </select>
                <label for="id_estado" class="active">ESTADO</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_municipio" id="id_municipio" class="select2 browser-default select-anidado select-municipios" data-url="<?php echo base_url('inicio/parroquias/select-parroquias'); ?>" disabled>
                    <option value="<?php echo $paciente->id_municipio; ?>" ><?php echo $paciente->municipio; ?></option>
                </select>
                <label for="id_municipio" class="active">MUNICIPIO</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_parroquia" id="id_parroquia" class="select2 browser-default select-parroquias" disabled>
                    <option value="<?php echo $paciente->id_parroquia; ?>" ><?php echo $paciente->municipio; ?></option>
                </select>
                <label for="id_parroquia" class="active">PARROQUIA</label>
            </div>

            <div class="col s12 l4 input-field">
                <input id="direccion" name="direccion" type="text" class="validate" value="<?php echo $paciente->direccion; ?>" disabled>
                <label for="direccion">DIRECCIÓN</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>  
                  
        </div>

        <?php if($representante != null): ?>
        <div id="representante">
            <div class="row titulo">
                <h4 class="left" >Datos del representante</h4>
            </div>

           <div class="row">
                <div class="col s12 l4 input-field">
                    <select name="id_parentesco" id="id_parentesco" class="select2 browser-default" disabled>
                        <option value="0" >Seleccione</option>
                        <?php foreach($parentescos as $item): ?>
                            <option value="<?php echo $item->id_parentesco; ?>" <?php if($paciente->id_parentesco == $item->id_parentesco){echo 'selected';}?> ><?php echo $item->parentesco; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="id_parentesco" class="active">PARENTESCO CON EL PACIENTE</label>
                </div>
                <div class="col s12 l4 input-field">
                    <select name="nac_r" id="nac_r" class="select2 browser-default" disabled>
                         <?php foreach($tipos_persona as $item): if($item->id_tipo_persona <= 2): ?>
                            <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($item->id_tipo_persona == $representante->id_tipo_persona){echo 'selected';}?> ><?php echo $item->tipo_persona; ?></option>
                        <?php endif; endforeach; ?>
                    </select>
                    <label for="nac_r" class="active">NACIONALIDAD</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="cedula_r" name="cedula_r" type="text" class="validate" placeholder="12345678" data-url="<?php echo base_url('registros/pacientes/cedula'); ?>" value="<?php echo $representante->cedula; ?>" disabled>
                    <label for="cedula_r">CEDULA</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>  
            </div>
            <div class="row"> 
                <div class="col s12 l4 input-field">
                    <input id="fecha_nacimiento_r" name="fecha_nacimiento_r" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" value="<?php echo $representante->fecha_nacimiento; ?>" disabled>
                    <label for="fecha_nacimiento_r">FECHA DE NACIMIENTO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>          
                <div class="col s12 l4 input-field">
                    <input id="nombres_r" name="nombres_r" type="text" class="validate" placeholder="Pedro Jose" value="<?php echo $representante->nombres; ?>" disabled>
                    <label for="nombres_r">NOMBRES</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="apellidos_r" name="apellidos_r" type="text" class="validate" placeholder="Perez Gonzalez" value="<?php echo $representante->apellidos; ?>" disabled>
                    <label for="apellidos_r">APELLIDOS</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>   
            </div>
            <div class="row">
                <div class="col s12 l4 input-field">
                    <select name="genero_r" id="genero_r" class="select2 browser-default" disabled>
                        <?php foreach($generos as $item): ?>
                            <option value="<?php echo $item->id_genero; ?>" <?php if($item->id_genero == $representante->id_genero){echo 'selected';}?> ><?php echo $item->genero; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="genero_r" class="active">GÉNERO</label>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="correo_r" name="correo_r" type="text" class="validate" placeholder="pedro@correo.com" value="<?php echo $representante->correo; ?>" disabled>
                    <label for="correo_r">CORREO ELECTRÓNICO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="tlf_r" name="tlf_r" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $representante->tlf; ?>" disabled>
                    <label for="tlf_r">TELÉFONO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4 input-field">
                    <select name="id_estado_r" id="id_estado_r" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios-r'); ?>" disabled>
                            <option value="<?php echo $representante->id_estado; ?>" ><?php echo $representante->nombre; ?></option>
                    </select>
                    <label for="id_estado_r" class="active">ESTADO</label>
                </div>
                <div class="col s12 l4 input-field">
                    <select name="id_municipio_r" id="id_municipio_r" class="select2 browser-default select-anidado select-municipios-r" data-url="<?php echo base_url('inicio/parroquias/select-parroquias-r'); ?>" disabled>
                        <option value="<?php echo $representante->id_municipio; ?>" ><?php echo $representante->municipio; ?></option>
                    </select>
                    <label for="id_municipio_r" class="active">MUNICIPIO</label>
                </div>
                <div class="col s12 l4 input-field">
                    <select name="id_parroquia_r" id="id_parroquia_r" class="select2 browser-default select-parroquias-r" disabled>
                        <option value="<?php echo $representante->id_parroquia; ?>" ><?php echo $representante->municipio; ?></option>
                    </select>
                    <label for="id_parroquia_r" class="active">PARROQUIA</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    <input id="direccion_r" name="direccion_r" type="text" class="validate"  value="<?php echo $representante->direccion; ?>" disabled>
                    <label for="direccion_r">DIRECCIÓN</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>

        </div> 
        <?php endif;?> 
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue"><?php echo $accion; ?></button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('registros/pacientes'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>	

