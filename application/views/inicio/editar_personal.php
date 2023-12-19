<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

    <div class="card"  >
	
        <div class="row titulo">
    		<h4 class="left"><?php echo $titulo;?></h4>		
    	</div>

    	<form data-response="json" method="POST" action="<?php echo base_url('inicio/usuario_actualizar');?>">
            <input type="hidden" name="token" value="editar">
            <input type="hidden" name="id" value="<?php echo $usuario->id_usuario; ?>">
            <input type="hidden" name="id_personal" value="<?php echo $usuario->id_personal; ?>">

            <div class="row">
                <div class="col s12 l4 input-field">
                    <select name="id_tipo_persona" id="id_tipo_persona" class="select2 browser-default" >
                        <?php foreach($tipos_persona as $item): ?>
                            <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($usuario->id_tipo_persona == $item->id_tipo_persona){ echo 'selected'; } ?> ><?php echo $item->tipo_persona; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="id_tipo_persona" class="active">TIPO DE PERSONA</label>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="cedula" name="cedula" type="text" class="validate" placeholder="12345678" value="<?php echo $usuario->cedula; ?>">
                    <label for="cedula">CEDULA</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div> 
                <div class="col s12 l4 input-field">
                    <input id="colegiatura" name="colegiatura" type="text" class="validate" placeholder="Pedro" value="<?php echo $usuario->colegiatura; ?>">
                    <label for="colegiatura">NUMERO COLEGIATURA</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4 input-field">
                    <input id="nombres" name="nombres" type="text" class="validate" placeholder="Pedro" value="<?php echo $usuario->nombres; ?>">
                    <label for="nombres">NOMBRES</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="apellidos" name="apellidos" type="text" class="validate" placeholder="Perez" value="<?php echo $usuario->apellidos; ?>">
                    <label for="apellidos">APELLIDOS</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" >
                    <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>         
                <div class="col s12 l4 input-field">
                    <select name="id_genero" id="id_genero" class="select2 browser-default" >
                        <?php foreach($generos as $item): ?>
                            <option value="<?php echo $item->id_genero; ?>" <?php if($usuario->id_genero == $item->id_genero){ echo 'selected'; } ?> ><?php echo $item->genero; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="id_genero" class="active">GÉNERO</label>
                </div>
            </div>
               
            <div class="row">
                <div class="col s12 l4 input-field">
                    <select name="id_estado" id="id_estado" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios'); ?>" >
                        <?php foreach($estados as $item): ?>
                            <option value="<?php echo $item->id_estado; ?>" <?php if($usuario->id_estado == $item->id_estado){ echo 'selected'; } ?> ><?php echo $item->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="id_estado" class="active">ESTADO</label>
                </div>
                <div class="col s12 l4 input-field">
                    <select name="id_municipio" id="id_municipio" class="select2 browser-default select-anidado select-municipios" data-url="<?php echo base_url('inicio/parroquias/select-parroquias'); ?>" >
                        <?php foreach($municipios as $item): ?>
                            <option value="<?php echo $item->id_municipio; ?>" <?php if($usuario->id_municipio == $item->id_municipio){ echo 'selected'; } ?> ><?php echo $item->municipio; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="id_municipio" class="active">MUNICIPIO</label>
                </div>
                <div class="col s12 l4 input-field">
                    <select name="id_parroquia" id="id_parroquia" class="select2 browser-default select-parroquias" >
                        <?php foreach($parroquias as $item): ?>
                            <option value="<?php echo $item->id_parroquia; ?>" <?php if($usuario->id_parroquia == $item->id_parroquia){ echo 'selected'; } ?> ><?php echo $item->parroquia; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="id_parroquia" class="active">PARROQUIA</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4 input-field">
                    <input id="direccion" name="direccion" type="text" class="validate" >
                    <label for="direccion">DIRECCIÓN</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>  
                <div class="col s12 l4 input-field">
                    <input id="usuario" name="usuario" type="text" class="validate" placeholder="Usuario" value="<?php echo $usuario->usuario;?>">
                    <label for="usuario">USUARIO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="correo" name="correo" type="text" class="validate" placeholder="pedro@correo.com" value="<?php echo $usuario->correo; ?>">
                    <label for="correo">CORREO ELECTRÓNICO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l4 input-field">
                    <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $usuario->tlf; ?>">
                    <label for="tlf">TELÉFONO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <input id="pregunta" name="pregunta" type="text" class="validate" value="<?php echo $this->encryption->decrypt($usuario->pregunta); ?>">
                    <label for="pregunta">PREGUNTA DE SEGURIDAD</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <i class="material-icons prefix password" data-visibility="off">visibility</i>
                    <input id="respuesta" name="respuesta" type="password" class="validate" value="<?php echo $this->encryption->decrypt($usuario->respuesta); ?>">
                    <label for="respuesta">RESPUESTA DE SEGURIDAD</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>            
            </div>
            <div class="row">
                <div class="col s12 l4 input-field">
                    <i class="material-icons prefix password" data-visibility="off">visibility</i>
                    <input id="clave" name="clave" type="password" class="validate" >
                    <label for="clave">CAMBIAR CONTRASEÑA</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
                <div class="col s12 l4 input-field">
                    <i class="material-icons prefix password" data-visibility="off">visibility</i>
                    <input id="repetir" name="repetir" type="password" class="validate" >
                    <label for="repetir">REPETIR CONTRASEÑA</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>
          
        </div>

        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue">ACTUALIZAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('inicio/bienvenido'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

    </div>
<script> 
$(document).ready(function(){
  
  function formatState (state) {
      if (!state.id) {
        return state.text;
      }
      var baseUrl = $('#iso').attr('data-url');
      var $state = $(
        '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" style="width:40px" /> ' + state.text + '</span>'
      );
      return $state;
    };

    $("#iso").select2({
      templateResult: formatState
    });

    $('#fecha_nacimiento').datepicker({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        maxDate: new Date(),
        //defaultDate: new Date(fecha),
        i18n: {
          cancel: 'CANCELAR',
          clear: 'LIMPIAR',
          done: 'LISTO',
          previousMonth: '<',
          nextMonth: '>',
          months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
          weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          weekdaysAbbrev: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa']
        }
    });

});
</script>