<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('registros/pacientes/actualizar');?>">
        <input type="hidden" name="token" value="editar">
        <input type="hidden" name="id_paciente" value="<?php echo $paciente->id_paciente?>">
        <input type="hidden" name="id_usuario_paciente" value="<?php echo $paciente->id_usuario?>">
       
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_tipo_persona" id="id_tipo_persona" class="select2 browser-default" >
                    <?php foreach($tipos_persona as $item): if($item->id_tipo_persona <= 2): ?>
                        <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($item->id_tipo_persona == $paciente->id_tipo_persona){echo 'selected';}?> ><?php echo $item->tipo_persona; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_tipo_persona" class="active">NACIONALIDAD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="cedula" name="cedula" type="text" class="validate simple-field-data-mask" data-mask="000000000" placeholder="12345678" value="<?php echo $paciente->cedula; ?>">
                <label for="cedula">CEDULA</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" value="<?php echo $paciente->fecha_nacimiento; ?>">
                <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div> 
        </div>        
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="nombres" name="nombres" type="text" class="validate" placeholder="Pedro Jose" value="<?php echo $paciente->nombres; ?>">
                <label for="nombres">NOMBRES</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="apellidos" name="apellidos" type="text" class="validate" placeholder="Perez Gonzalez" value="<?php echo $paciente->apellidos; ?>">
                <label for="apellidos">APELLIDOS</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>   
            <div class="col s12 l4 input-field">
                <select name="id_genero" id="id_genero" class="select2 browser-default" >
                    <?php foreach($generos as $item): ?>
                        <option value="<?php echo $item->id_genero; ?>" <?php if($item->id_genero == $paciente->id_genero){echo 'selected';}?> ><?php echo $item->genero; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_genero" class="active">GÉNERO</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="correo" name="correo" type="text" class="validate" placeholder="pedro@correo.com" value="<?php echo $paciente->correo; ?>">
                <label for="correo">CORREO ELECTRÓNICO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $paciente->tlf; ?>">
                <label for="tlf">TELÉFONO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_estado" id="id_estado" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios'); ?>" >
                    <?php foreach($estados as $item): ?>
                        <option value="<?php echo $item->id_estado; ?>" <?php if($paciente->id_estado == $item->id_estado){echo 'selected';}?> ><?php echo $item->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_estado" class="active">ESTADO</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_municipio" id="id_municipio" class="select2 browser-default select-anidado select-municipios" data-url="<?php echo base_url('inicio/parroquias/select-parroquias'); ?>" >
                    <option value="<?php echo $paciente->id_municipio; ?>" ><?php echo $paciente->municipio; ?></option>
                    <?php foreach($municipios_paciente as $item): if($paciente->id_municipio != $item->id_municipio):?>
                        <option value="<?php echo $item->id_municipio; ?>" ><?php echo $item->municipio; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_municipio" class="active">MUNICIPIO</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_parroquia" id="id_parroquia" class="select2 browser-default select-parroquias" >
                    <option value="<?php echo $paciente->id_parroquia; ?>" ><?php echo $paciente->municipio; ?></option>
                    <?php foreach($parroquias_paciente as $item): if($paciente->id_parroquia != $item->id_parroquia):?>
                        <option value="<?php echo $item->id_parroquia; ?>" ><?php echo $item->parroquia; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_parroquia" class="active">PARROQUIA</label>
            </div>

            <div class="col s12 l4 input-field">
                <input id="direccion" name="direccion" type="text" class="validate" value="<?php echo $paciente->direccion; ?>">
                <label for="direccion">DIRECCIÓN</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>  
        </div>

        <?php if($representante != null): ?>
            <input type="hidden" name="id_representante" value="<?php echo $representante->id_paciente?>">
            <input type="hidden" name="id_usuario_representante" value="<?php echo $representante->id_usuario?>">
        
            <div id="representante">
                <div class="row titulo">
                    <h4 class="left" >Datos del representante</h4>
                </div>

                <div class="row">
                    <div class="col s12 l4 input-field">
                        <select name="id_parentesco" id="id_parentesco" class="select2 browser-default" >
                            <option value="0" >Seleccione</option>
                            <?php foreach($parentescos as $item): ?>
                                <option value="<?php echo $item->id_parentesco; ?>" <?php if($paciente->id_parentesco == $item->id_parentesco){echo 'selected';}?> ><?php echo $item->parentesco; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_parentesco" class="active">PARENTESCO CON EL PACIENTE</label>
                    </div>
                    <div class="col s12 l4 input-field">
                        <select name="id_tipo_persona_r" id="id_tipo_persona_r" class="select2 browser-default" >
                            <?php foreach($tipos_persona as $item): if($item->id_tipo_persona <= 2): ?>
                                <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($item->id_tipo_persona == $representante->id_tipo_persona){echo 'selected';}?> ><?php echo $item->tipo_persona; ?></option>
                            <?php endif; endforeach; ?>
                        </select>
                        <label for="id_tipo_persona_r" class="active">NACIONALIDAD</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>
                    <div class="col s12 l4 input-field">
                        <input id="cedula_r" name="cedula_r" type="text" class="validate" placeholder="12345678" data-url="<?php echo base_url('registros/pacientes/representante'); ?>" value="<?php echo $representante->cedula; ?>">
                        <label for="cedula_r">CEDULA</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>  
                </div>
                <div class="row"> 
                    <div class="col s12 l4 input-field">
                        <input id="fecha_nacimiento_r" name="fecha_nacimiento_r" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" value="<?php echo $representante->fecha_nacimiento; ?>">
                        <label for="fecha_nacimiento_r">FECHA DE NACIMIENTO</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>         
                    <div class="col s12 l4 input-field">
                        <input id="nombres_r" name="nombres_r" type="text" class="validate" placeholder="Pedro Jose" value="<?php echo $representante->nombres; ?>">
                        <label for="nombres_r">NOMBRES</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>
                    <div class="col s12 l4 input-field">
                        <input id="apellidos_r" name="apellidos_r" type="text" class="validate" placeholder="Perez Gonzalez" value="<?php echo $representante->apellidos; ?>">
                        <label for="apellidos_r">APELLIDOS</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>   
                </div>
                <div class="row">
                    <div class="col s12 l4 input-field">
                        <select name="id_genero_r" id="id_genero_r" class="select2 browser-default" >
                            <?php foreach($generos as $item): ?>
                                <option value="<?php echo $item->id_genero; ?>" <?php if($item->id_genero == $representante->id_genero){echo 'selected';}?> ><?php echo $item->genero; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_genero_r" class="active">GÉNERO</label>
                    </div>
                    <div class="col s12 l4 input-field">
                        <input id="correo_r" name="correo_r" type="text" class="validate" placeholder="pedro@correo.com" value="<?php echo $representante->correo; ?>">
                        <label for="correo_r">CORREO ELECTRÓNICO</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>
                    <div class="col s12 l4 input-field">
                        <input id="tlf_r" name="tlf_r" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $representante->tlf; ?>">
                        <label for="tlf_r">TELÉFONO</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l4 input-field">
                        <select name="id_estado_r" id="id_estado_r" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios-r'); ?>" >
                            <?php foreach($estados as $item): ?>
                                <option value="<?php echo $item->id_estado; ?>" <?php if($representante->id_estado == $item->id_estado){echo 'selected';}?> ><?php echo $item->nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="id_estado_r" class="active">ESTADO</label>
                    </div>
                    <div class="col s12 l4 input-field">
                        <select name="id_municipio_r" id="id_municipio_r" class="select2 browser-default select-anidado select-municipios-r" data-url="<?php echo base_url('inicio/parroquias/select-parroquias-r'); ?>" >
                            <option value="<?php echo $representante->id_municipio; ?>" ><?php echo $representante->municipio; ?></option>
                            <?php foreach($municipios_paciente as $item): if($representante->id_municipio != $item->id_municipio):?>
                                <option value="<?php echo $item->id_municipio; ?>" ><?php echo $item->municipio; ?></option>
                            <?php endif; endforeach; ?>
                        </select>
                        <label for="id_municipio_r" class="active">MUNICIPIO</label>
                    </div>
                    <div class="col s12 l4 input-field">
                        <select name="id_parroquia_r" id="id_parroquia_r" class="select2 browser-default select-parroquias-r" >
                            <option value="<?php echo $representante->id_parroquia; ?>" ><?php echo $representante->municipio; ?></option>
                            <?php foreach($parroquias_paciente as $item): if($representante->id_parroquia != $item->id_parroquia):?>
                                <option value="<?php echo $item->id_parroquia; ?>" ><?php echo $item->parroquia; ?></option>
                            <?php endif; endforeach; ?>
                        </select>
                        <label for="id_parroquia_r" class="active">PARROQUIA</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 input-field">
                        <input id="direccion_r" name="direccion_r" type="text" class="validate"  value="<?php echo $representante->direccion; ?>">
                        <label for="direccion_r">DIRECCIÓN</label>
                        <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                    </div>
                </div>
            </div>  
        <?php endif;?>
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue">ACTUALIZAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('registros/pacientes'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>

<?php $this->load->view('registros/pacientes/js'); ?>