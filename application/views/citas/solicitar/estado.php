<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
    
    <div class="row titulo">
        <h4 class="left" ><?php echo $titulo;?></h4>
    </div>

    <form data-response="json" method="POST" action="<?php echo base_url('citas/solicitar/actualizar');?>">
        <input type="hidden" name="token" value="<?php echo $accion; ?>">
        <input type="hidden" name="id" value="<?php echo $cita->id_cita; ?>">

        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default select-anidado" data-url="<?php echo base_url('citas/solicitar/especialidad/select-especialidad'); ?>" disabled >
                    <option value="0" >Seleccione</option>
                    <?php foreach($instituciones as $item): ?>
                        <option value="<?php echo $item->id_institucion; ?>" <?php if($item->id_institucion == $cita->cita_institucion){ echo 'selected';}?> ><?php echo $item->institucion; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_institucion" class="active">INSTITUCION</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_especialidad" id="id_especialidad" class="select2 browser-default select-especialidad select-anidado" data-url="<?php echo base_url('citas/solicitar/personal/select-personal'); ?>" disabled >
                    <option value="0" >Seleccione</option>
                    <?php foreach($especialidades as $item): ?>
                        <option value="<?php echo $item->id_especialidad; ?>" <?php if($item->id_especialidad == $cita->cita_especialidad){ echo 'selected';}?> ><?php echo $item->especialidad; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_especialidad" class="active">ESPECIALIDAD</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_personal" id="id_personal" class="select2 browser-default select-personal" data-url="<?php echo base_url('citas/solicitar/horario'); ?>" disabled >
                    <option value="0" >Seleccione</option>
                    <?php foreach($personal as $item): ?>
                        <option value="<?php echo $item->id_personal; ?>" <?php if($item->id_personal == $cita->cita_personal){ echo 'selected';}?> ><?php echo substr($item->tipo_persona, 0,1).'-'.$item->cedula.', '.$item->nombres.' '.$item->apellidos; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_personal" class="active">MEDICO ESPECIALISTA</label>
            </div> 
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="fecha_solicitud" name="fecha_solicitud" type="text" class="validate datepicker habilitar" value="<?php echo $cita->fecha_solicitud; ?>" disabled >
                <label for="fecha_solicitud">FECHA SOLICITUD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>         
            <div class="col s12 l4 input-field">
                <input id="hora_solicitud" name="hora_solicitud" type="text" class="validate timepicker habilitar" value="<?php echo $cita->hora_solicitud; ?>" data-url="<?php echo base_url('citas/solicitar/horas'); ?>" disabled >
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
                <select name="id_tipo_persona" id="id_tipo_persona" class="select2 browser-default" disabled >
                    <?php foreach($tipos_persona as $item): if($item->id_tipo_persona <= 2): ?>
                        <option value="<?php echo $item->id_tipo_persona; ?>" <?php if($item->id_tipo_persona == $cita->id_tipo_persona){ echo 'selected';}?> ><?php echo $item->tipo_persona; ?></option>
                    <?php endif; endforeach; ?>
                </select>
                <label for="id_tipo_persona" class="active">NACIONALIDAD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="cedula" name="cedula" type="text" class="validate simple-field-data-mask" data-mask="00000000" placeholder="12345678" data-url="<?php echo base_url('registros/pacientes/paciente'); ?>" value="<?php echo $cita->cedula;?>" disabled >
                <label for="cedula">CEDULA</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>  
            <div class="col s12 l4 input-field">
                <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="validate datepicker" onchange="validarEdad()" placeholder="1999-01-01" value="<?php echo $cita->fecha_nacimiento;?>" disabled >
                <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        </div>         
        <div class="row"> 
            <div class="col s12 l4 input-field">
                <input id="nombres" name="nombres" type="text" class="validate" placeholder="Pedro Jose" value="<?php echo $cita->nombres;?>" disabled >
                <label for="nombres">NOMBRES</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="apellidos" name="apellidos" type="text" class="validate" placeholder="Perez Gonzalez" value="<?php echo $cita->apellidos;?>" disabled >
                <label for="apellidos">APELLIDOS</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>   
            <div class="col s12 l4 input-field">
                <select name="id_genero" id="id_genero" class="select2 browser-default" disabled >
                    <?php foreach($generos as $item): ?>
                        <option value="<?php echo $item->id_genero; ?>" <?php if($item->id_genero == $cita->id_genero){ echo 'selected';}?> ><?php echo $item->genero; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_genero" class="active">GÉNERO</label>
            </div>
        </div>
        <div class="row">     
            <div class="col s12 l4 input-field">
                <input id="correo" name="correo" type="text" class="validate" placeholder="pedro@correo.com" value="<?php echo $cita->correo;?>" disabled >
                <label for="correo">CORREO ELECTRÓNICO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <input id="tlf" name="tlf" type="text" class="validate simple-field-data-mask" data-mask="0000-0000000" placeholder="1234-1234567" value="<?php echo $cita->tlf;?>" disabled >
                <label for="tlf">TELÉFONO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_estado" id="id_estado" class="select2 browser-default select-anidado" data-url="<?php echo base_url('inicio/municipios/select-municipios'); ?>" disabled >
                        <option value="0" >Seleccione</option>
                    <?php foreach($estados as $item): ?>
                        <option value="<?php echo $item->id_estado; ?>" <?php if($item->id_estado == $cita->id_estado){ echo 'selected';}?> ><?php echo $item->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_estado" class="active">ESTADO</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4 input-field">
                <select name="id_municipio" id="id_municipio" class="select2 browser-default select-anidado select-municipios" data-url="<?php echo base_url('inicio/parroquias/select-parroquias'); ?>" disabled >
                    <option value="0" >Seleccione</option>
                    <?php foreach($municipios as $item): ?>
                        <option value="<?php echo $item->id_municipio; ?>" <?php if($item->id_municipio == $cita->id_municipio){ echo 'selected';}?> ><?php echo $item->municipio; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_municipio" class="active">MUNICIPIO</label>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_parroquia" id="id_parroquia" class="select2 browser-default select-parroquias" disabled >
                    <option value="0" >Seleccione</option>
                     <?php foreach($parroquias as $item): ?>
                        <option value="<?php echo $item->id_parroquia; ?>" <?php if($item->id_parroquia == $cita->id_parroquia){ echo 'selected';}?> ><?php echo $item->parroquia; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_parroquia" class="active">PARROQUIA</label>
            </div>
            <div class="col s12 l4 input-field">
                <input id="direccion" name="direccion" type="text" class="validate" value="<?php echo $cita->direccion;?>" disabled >
                <label for="direccion">DIRECCIÓN</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>       
        </div>
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue"><?php echo $accion; ?></button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('citas/solicitar'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                minDate: new Date(),
                disableDayFn: function(date) {
                    var diaSeleccionado = date.getDay();
                    var diasDisponibles = [<?php echo $dias; ?>]; // Ejemplo de días disponibles (ajusta según tu array)
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


            $('.timepicker').timepicker({
                twelveHour: false,
                showClearBtn: false,
            });

            $('.timepicker').change(function() {
                // Validar la hora seleccionada al cerrar el timepicker
                var horaSeleccionada = $(this).val();
                var url = $(this).attr('data-url');
                var fechaSeleccionada = $('#fecha_asignada').val();
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


        });
    </script>
</div>  

