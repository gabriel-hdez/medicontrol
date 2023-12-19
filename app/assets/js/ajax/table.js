(function($){
    $(function(){   
        
        $('body').on('submit','form', function(event)
        {
            event.preventDefault();

            var formData = new FormData($(this)[0]);
            var formID = $(this).attr('id');
            var response = $(this).attr('data-response');
            var reload   = $(this).attr('data-reload');
            
            $.ajax({
                url:$(this).attr('action'),
                type:$(this).attr('method'),
                data:formData,
                //dataType: 'json',
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function(){ 
                    $('.progress').removeClass('hide');
                }
            })
            .done(function(respuesta){
                if(response == 'html')
                {
                    $('#'+reload).html();
                    $('#'+reload).html(respuesta);
                }
                else if(response == 'table')
                {
                     //M.toast({html: json.info , displayLength:2500});
                    if ( $.fn.dataTable.isDataTable( reload ) ) 
                    {
                        var table = $('#'+reload).DataTable();
                        
                        table.destroy();

                        $(table).html(respuesta);

                        $(table).DataTable({
                           /* "ajax":{
                                "method":"POST",
                                "url": json.url,
                            },*/
                            "language": {
                                "lengthMenu": '<div class="input-field col s2" style="width:12rem;">'+
                                '<label class="active"></label>'+
                                '<select class="dt-select" style="margin-top:0.5rem;">'+
                                '<option value="-1">TODOS LOS REGISTROS</option>'+
                                '<option value="5">5 registros</option>'+
                                '<option value="10">10 registros</option>'+
                                '<option value="15">15 registros</option>'+
                                '<option value="20">20 registros</option>'+
                               '</select></div>',
                               "sSearchPlaceholder": "Buscar...",
                                //"sLengthMenu":     "Mostrar _MENU_ registros",
                                "sProcessing":     "<p class='center teal-text'>Procesando...</p>",
                                "sLoadingRecords": "<p class='center teal-text'>Cargando...</p>",
                                "sZeroRecords":    "<p class='center red-text'>No se encontraron resultados</p>",
                                "sEmptyTable":     "<p class='center red-text'>Ningún dato disponible para mostrar</p>",
                                "sInfo":           "<p class='center grey-text'>Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros</p>",
                                "sInfoEmpty":      "<p class='center grey-text'>Mostrando registros del 0 al 0 de un total de 0 registros</p>",
                                "sInfoFiltered":   "<p class='center grey-text'>(filtrado de un total de _MAX_ registros)</p>",
                                "sInfoPostFix":    "",
                                "sSearch":         "",
                                "sUrl":            "",
                                "sInfoThousands":  ".",
                                "oPaginate": {
                                    "sFirst":    "Primero",
                                    "sLast":     "Último",
                                    "sNext":     "Siguiente",
                                    "sPrevious": "Anterior"
                                },
                                "oAria": {
                                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                },
                            },
                              
                            "pageLength": -1,
                            "order": []
                        });
                    }
                    $('.dt-select').addClass("browser-default").val('-1');
                }
            })
            .fail(function(respuesta) {
                M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
                $('.validate').addClass('invalid');
            })
            .always(function(respuesta) {
                console.log(respuesta);
                $('.progress').addClass('hide'); 
            });
        });
    });
})(jQuery);