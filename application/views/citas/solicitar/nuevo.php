<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('citas/solicitar/guardar');?>">
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default select-anidado" data-url="<?php echo base_url('citas/solicitar/especialidad/select-especialidad'); ?>" >
                    <option value="0" >Seleccione</option>
                    <?php foreach($instituciones as $item): ?>
                        <option value="<?php echo $item->id_institucion; ?>" ><?php echo $item->institucion; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_institucion" class="active">INSTITUCION</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_especialidad" id="id_especialidad" class="select2 browser-default select-especialidad select-anidado" data-url="<?php echo base_url('citas/solicitar/personal/select-personal'); ?>" >
                    <option value="0" >Seleccione</option>
                </select>
                <label for="id_especialidad" class="active">ESPECIALIDAD</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_personal" id="id_personal" class="select2 browser-default select-personal" data-url="<?php echo base_url('citas/solicitar/horario'); ?>" >
                    <option value="0" >Seleccione</option>
                </select>
                <label for="id_personal" class="active">MEDICO ESPECIALISTA</label>
            </div> 
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="fecha_solicitud" name="fecha_solicitud" type="text" class="validate datepicker habilitar" disabled>
                <label for="fecha_solicitud">FECHA SOLICITUD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>         
            <div class="col s12 l4 input-field">
                <input id="hora_solicitud" name="hora_solicitud" type="text" class="validate timepicker habilitar" data-url="<?php echo base_url('citas/solicitar/horas'); ?>" disabled>
                <label for="hora_solicitud">HORA SOLICITUD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>         
        </div>
        <!-- PACIENTE -->
        <div class="row titulo">
            <h5 class="center" >Datos del paciente</h5>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_tipo_persona" id="id_tipo_persona" class="select2 browser-default" >
                    <?php foreach($tipos_persona as $item): if($item->id_tipo_persona <= 2): ?>
                        <option value="<?php echo $item->id_tipo_persona; ?>" ><?php echo $item->tipo_persona; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_tipo_persona" class="active">NACIONALIDAD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="cedula" name="cedula" type="text" class="validate simple-field-data-mask" data-mask="00000000" placeholder="12345678" data-url="<?php echo base_url('registros/pacientes/paciente'); ?>">
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
                        <option value="<?php echo $item->id_genero; ?>" ><?php echo $item->genero; ?></option>
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
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue">GUARDAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('citas/solicitar'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Maneja el evento de cambio del elemento de selección (personalSelect)
            $('#id_personal').change(function() {
                // Obtiene el valor seleccionado
                var seleccion = $(this).val();
                var url = $(this).attr('data-url');
                // Habilite el campo si se selecciona un personal (puedes ajustar la condición según tus necesidades)
                if (seleccion !== '0') {
                    $('.habilitar').prop('disabled', false);

                    $.ajax({
                        url: url, // Reemplaza con la URL a la que deseas hacer la petición
                        type: 'POST', // Tipo de petición (GET, POST, etc.)
                        dataType: 'json', // Tipo de datos que esperas recibir (puede ser 'json', 'xml', 'html', etc.)
                        data: {'id_personal': seleccion},
                        success: function(data) {

                            var disponibilidadJson = data;
                            
                            var diasDisponibles = disponibilidadJson.map(function(item) {
                                return parseInt(item.dia); // Convierte a entero, ya que datepicker espera un número (0-6)
                            });

                            // Inicializar el Datepicker
                            $('#fecha_solicitud').datepicker({
                                format: 'yyyy-mm-dd',
                                formatSubmit: 'yyyy-mm-dd',
                                minDate: new Date(),
                                disableDayFn: function(date) {
                                    var diaSeleccionado = date.getDay();
                                    return (diasDisponibles.indexOf(diaSeleccionado) === -1);
                                },
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
                        },
                        error: function(xhr, status, error) {
                            // La función que se ejecuta si hay un error en la petición
                            M.toast({html: 'Ha ocurrido un error al validar el horario'})
                        }
                    });

                } else {
                    // Deshabilita el campo si no se selecciona ningún personal
                    $('.habilitar').prop('disabled', true);
                }
            });


            $('.timepicker').timepicker({
                twelveHour: false,
                showClearBtn: false,
            });

            $('.timepicker').change(function() {
                // Validar la hora seleccionada al cerrar el timepicker
                var horaSeleccionada = $(this).val();
                var url = $(this).attr('data-url');
                var fechaSeleccionada = $('#fecha_solicitud').val();
                // Realizar una solicitud AJAX al servidor para validar la hora
                $.ajax({
                    url: url, // Reemplaza con la ruta correcta a tu script de validación en el servidor
                    method: 'POST',
                    data: {
                        horaSeleccionada: horaSeleccionada,
                        fechaSeleccionada: fechaSeleccionada
                    },
                    success: function(response) {
                        if (response !== '') {
                            M.toast({html: response});
                            $('.timepicker').focus().val(''); 
                        } 
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', status, error);
                    }
                });
            });


            $('#cedula').on('paste keyup' , function (event) 
            {
                var cedula = $(this).val();
                var url = $(this).attr('data-url');

                $.ajax({
                    url: url,
                    type:'POST',
                    //dataType: 'json',
                    data: { cedula : cedula },
                    beforeSend:function(){ 
                        $('.progress').removeClass('hide');
                    }
                })
               .done(function(respuesta){
                    
                    var json = $.parseJSON(respuesta);  

                    if (json.status == "alert")
                    {
                        if(json.info != null)
                        {
                            M.toast({
                                html: json.info , 
                                displayLength:3000, 
                                completeCallback: function(){
                                   
                                   
                                }});
                        }
                    }   
                   // else
                    //{ 
                        for( var inputs in json)
                        {
                            var ids = "#"+inputs;
                            //$('.searchbar').removeClass('invalid').siblings('.helper-text').attr('data-error', '');
                            $(ids).addClass('valid active').siblings('.helper-text').attr('data-success', '');
                            
                            if ( $(ids).attr('type') == 'text' || $(ids).attr('type') == 'hidden' ) 
                            {
                                $(ids).val(json[inputs]);
                                M.updateTextFields();
                            }
                            else
                            {
                                $.each(json.seleccion_select, function(afectado, opcion) {

                                    $(afectado+' > option[value="'+ opcion +'"]').attr('selected','selected');
                                
                                });

                                $.each(json.crear_select, function(afectado, contenido) {

                                    $.each(contenido, function(clave, valor) 
                                    {
                                        $(afectado).empty();
                                        
                                    });
                                });

                                $.each(json.crear_select, function(afectado, contenido) {

                                    $.each(contenido, function(clave, valor) 
                                    {
                                        $(afectado).append('<option value="' + clave + '">' + valor + '</option>');
                                    });
                                });


                            }
                        }
                    //}           
                })
                .fail(function(respuesta) {
                    M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
                })
                .always(function(respuesta) {
                    $('.progress').addClass('hide'); 
                    console.log(respuesta);
                });
            });

            /*var fechaActual = new Date();
            var fechaMax = fechaActual.setFullYear(fechaActual.getFullYear() - 18);

            $('#fecha_nacimiento').datepicker({
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                maxDate: new Date(fechaMax),
                defaultDate: new Date(fechaMax),*/

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
</div>	

