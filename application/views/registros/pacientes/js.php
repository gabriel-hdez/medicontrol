<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script defer>

function validarEdad() {
    const fechaNacimiento = new Date(document.getElementById('fecha_nacimiento').value);
    const fechaActual = new Date();
    const diferenciaTiempo = fechaActual - fechaNacimiento;
    const edad = diferenciaTiempo / (1000 * 60 * 60 * 24 * 365.25);
    const edadMinima = 18;

    if (edad >= edadMinima) {
      document.getElementById("representante").classList.add("hide");
    } else {
      document.getElementById("representante").classList.remove("hide");
    }
}

(function($){
    $(function(){

    $('#cedula_r').on('paste keyup' , function (event) 
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
                            
                           /* $('#fecha_nacimiento_r, #cedula_r, #nombres_r, #apellidos_r, #correo_r, #tlf_r, #direccion_r').val("");
                            
                            $('#id_parentesco > option:selected').attr('selected',false);
                            $('#id_parentesco > option:first').attr('selected','selected');

                            $('#genero_r > option:selected').attr('selected',false);
                            $('#genero_r > option:first').attr('selected','selected');

                            
                            $('#genero_r, #id_estado_r, #id_municipio_r, #id_parroquia_r').empty();
                            //$('#id_municipio_r, #id_parroquia_r').append('<option value="0">SELECCIONE</option>');


                            $('#id_estado_r > option:selected').attr('selected',false);
                            $('#id_estado_r > option:first').attr('selected','selected');

                            $('#id_municipio_r > option:selected').attr('selected',false);
                            $('#id_municipio_r > option:first').attr('selected','selected');

                            $('#id_parroquia_r > option:selected').attr('selected',false);
                            $('#id_parroquia_r > option:first').attr('selected','selected');*/
                           
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

    $('#fecha_nacimiento').datepicker({
        format: 'yyyy-mm-dd',

        /*disableDayFn: function(date) {
                    // Ejemplo: deshabilita los domingos (0), lunes (1) y miércoles (3)
                    return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 3);
        },*/
        
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

    var fechaActual = new Date();
    var fechaMax = fechaActual.setFullYear(fechaActual.getFullYear() - 12);

    $('#fecha_nacimiento_r').datepicker({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        maxDate: new Date(fechaMax),
        defaultDate: new Date(fechaMax),
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
})(jQuery);
</script>	