<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
(function($){
    $(function(){

        $('#fecha_vencimiento').datepicker({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            minDate: new Date(),
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
})(jQuery);
</script>