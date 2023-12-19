<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script defer>
$(document).ready(function() {
    // Inicializa el Timepicker
    $('.timepicker').timepicker({
        twelveHour: false,
        showClearBtn: false,
    });

    // Función para validar que la hora de inicio no sea mayor que la hora final
    function validarHoras($horaInicio, $horaFinal) {
        var horaInicio = $horaInicio.val();
        var horaFinal = $horaFinal.val();

        // Compara las horas
        if (horaInicio && horaFinal && horaInicio >= horaFinal) {
            M.toast({html: 'La hora de inicio no puede ser mayor o igual que la hora final'});
            $horaInicio.val('').focus(); // Limpia el campo de hora de inicio y lo enfoca
        }
    }

    // Maneja el evento de cambio del checkbox principal
    $('#checkboxPrincipal').change(function() {
        // Encuentra todos los checkboxes dentro de la tabla
        var $checkboxes = $('table input[type="checkbox"]').not('#checkboxPrincipal');

        // Encuentra todos los campos de tiempo dentro de la tabla
        var $camposTiempo = $('table input[name^="hora_"]');

        // Establece el estado de los demás checkboxes y campos de tiempo según el estado del checkbox principal
        $checkboxes.prop('checked', $(this).is(':checked')).change();
        $camposTiempo.prop('disabled', !$(this).is(':checked'));
    });

    // Maneja el evento de cambio de los checkboxes individuales
    $('input[type="checkbox"]').not('#checkboxPrincipal').change(function() {
        // Encuentra los elementos en la misma fila
        var $tr = $(this).closest('tr');
        var $horaInicio = $tr.find('input[name="hora_inicio[]"]');
        var $horaFinal = $tr.find('input[name="hora_final[]"]');

        // Habilita o deshabilita los campos según el estado del checkbox
        if ($(this).is(':checked')) {
            $horaInicio.prop('disabled', false);
            $horaFinal.prop('disabled', false);
        } else {
            $horaInicio.prop('disabled', true);
            $horaFinal.prop('disabled', true);
        }
    });

    // Maneja el evento de cambio del input de la hora de inicio
    $('input[name^="hora_inicio"]').change(function() {
        var $tr = $(this).closest('tr');
        var $horaFinal = $tr.find('input[name^="hora_final"]');

        // Validar que la hora de inicio no sea mayor que la hora final
        validarHoras($(this), $horaFinal);
    });

    // Maneja el evento de cambio del input de la hora final
    $('input[name^="hora_final"]').change(function() {
        var $tr = $(this).closest('tr');
        var $horaInicio = $tr.find('input[name^="hora_inicio"]');

        // Validar que la hora de inicio no sea mayor que la hora final
        validarHoras($horaInicio, $(this));
    });

});
</script>   