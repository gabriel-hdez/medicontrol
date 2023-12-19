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

            <div class="row">
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
                <div class="col s12 l4 input-field">
                    <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $usuario->tlf; ?>">
                    <label for="tlf">TELÉFONO</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>
            <div class="row">
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
                <div class="col s12 l4 input-field">
                    <i class="material-icons prefix password" data-visibility="off">visibility</i>
                    <input id="clave" name="clave" type="password" class="validate" >
                    <label for="clave">CAMBIAR CONTRASEÑA</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>            
            </div>
            <div class="row">
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