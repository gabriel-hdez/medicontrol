<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script defer>
(function($){
    $(function(){

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

                            $(afectado).empty();
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

    var fechaActual = new Date();
    var fechaMax = fechaActual.setFullYear(fechaActual.getFullYear() - 18);

    $('#fecha_nacimiento').datepicker({
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