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
            .done(function(respuesta, status, xhr){

                if(response == 'json')
                {
                    var json = $.parseJSON(respuesta);
                    if (json.status == "alert")
                    {
                        if(json.info != null)
                        {
                            M.toast({
                                html: json.info , 
                                displayLength:3000, 
                                completeCallback: function(){
                                    if(json.msj != null)
                                    {
                                        M.toast({html: json.msj , displayLength:2500});
                                    }
                                    if(json.tabSelected != null)
                                    {
                                        $('.tabs').tabs('select', json.tabSelected);
                                    }
                                    if(json.updateData != null)
                                    {
                                        $('.updateData').html(json.updateData);
                                    } 
                                    if(json.updateSource != null)
                                    {
                                        $('.updateSource').attr('src',json.updateSource);
                                    }
                                    if (json.submit != null) 
                                    {
                                        $(json.submit).submit();
                                    }
                                    if (json.tema != null) 
                                    {
                                        location.reload();
                                    }
                                   
                                }});
                        }
                        if(json.modal != null)
                        {
                            if (json.action != null) 
                            {
                                $(json.modal).modal(json.action);
                            } 
                            else
                            {
                                $('.modal').modal("close");
                                //$(json.modal).modal("open");
                            }
                        }
                        if(json.unlock != null)
                        {
                            $('.'+json.unlock).removeAttr('disabled','disabled');
                        }
                        if(json.lock != null)
                        {
                            $('.'+json.unlock).attr('disabled','disabled');
                        }
                        if(json.preview != null)
                        {
                            $('#preview').attr('src', json.preview);
                            $('.show').addClass('hide');
                        }
                        if(json.clearInputs == "on" )
                        {
                            $('.validate').val("");
                            $('select > option:selected').attr('selected',false);
                            $('select > option:first').attr('selected','selected');
                        }
                        if(json.updateInput != null)
                        {
                            var input = json.idInput;
                            var value = json.updateInput;
                            $(input).val(value);
                        }

                        $('.validate').removeClass('invalid').siblings('.helper-text').attr('data-error', "");

                        if(json.redirect != null)
                        {
                            window.location.href = json.redirect;
                        }

                        if(json.newWindow != null)
                        {
                            var pestana = window.open(json.newWindow , "_blank");
                            pestana.focus();
                        }

                        //$('#'+formID)[0].reset();   
                    }
                    else if(json.status == "login")
                    {
                        $('.modal').modal("close");
                        $('#'+formID)[0].reset();      
                        
                        M.toast({
                            html: json.info , 
                            displayLength:2000, 
                            completeCallback: function(){
                                    
                               $('#login').modal("open");
                               $('#usuario').focus().val(json.usuario);
                        }});
                    }
                    else if(json.status == "select")
                    {
                        M.toast({html: json.info , displayLength:2500});

                        $(json.ajax).empty();
                        
                        $.each(json.options, function(key, value) {
                            $(json.ajax).append('<option value="' + value.id + '">' + value.opcion + '</option>');
                        });

                        if (json.ajax2 != null) 
                        {
                           $(json.ajax2).empty();
                        
                            $.each(json.options2, function(key, value) {
                                $(json.ajax2).append('<option value="' + value.id + '">' + value.opcion + '</option>');
                            }); 
                        }   
                        if (json.ajax3 != null) 
                        {
                           $(json.ajax3).empty();
                        
                            $.each(json.options3, function(key, value) {
                                $(json.ajax3).append('<option value="' + value.id + '">' + value.opcion + '</option>');
                            }); 
                        }            
                        
                        $('.modal').modal("close");
                        //$('#'+formID)[0].reset();      
                    }
                    else if(json.status == "ajax")
                    {                        
                        var recargar    = json.recargar;
                        var datos       = json.data;
                        var url         = json.url;
                        var info        = json.info;

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: datos,
                            /*cache:false,
                            contentType:false,
                            processData:false,*/
                            beforeSend:function(){ 
                                $('.progress').removeClass('hide');
                            }
                        })
                        .done( function(respuesta){
                            $(recargar).html();
                            $(recargar).html(respuesta);
                            
                            if(info != '')
                            {
                                M.toast({
                                    html: info , 
                                    displayLength:2000, 
                                    completeCallback: function(){    
                                }});
                                $('.modal').modal("close");
                            }

                            /*if(close != '')
                            {
                                $('.modal').modal("close");
                            }*/

                        }) 
                        .fail(function(respuesta) {
                            M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
                            $('.validate').addClass('invalid');
                        })
                        .always(function(respuesta) {
                            console.log(respuesta);
                            $('.progress').addClass('hide'); 

                            /*if ( $.fn.dataTable.isDataTable('.display') ) 
                            {
                                var table = $('.display').DataTable();
                                
                                table.destroy();

                                $(table).DataTable({
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
                                });*/
                            //}
                            //$('.dt-select').addClass("browser-default").val('-1');
                        });
                    }
                    else
                    {
                        for( var inputs in json)
                        {
                            if(json.hasOwnProperty(inputs))
                            {
                                var ids = '#'+inputs+'';
                                $(ids).addClass('invalid').siblings('.helper-text').attr('data-error', json[inputs]);
                                //$(ids).first().focus();
                            }
                            else
                            {
                                $(ids).removeClass('invalid').siblings('.helper-text').attr('data-error', "");
                            }
                        }
                    }
                }
                else if(response == 'html')
                {
                    /*$.ajax({ 
                        type: "POST", 
                        url: "your url goes here", 
                        data: "data to be sent", 
                        success: function(response, status, xhr){ 
                            var ct = xhr.getResponseHeader("content-type") || ""; 
                            if (ct.indexOf('html') > -1) { 
                            //do something 
                            } 
                            if (ct.indexOf('json') > -1) { 
                            // handle json here 
                        } 
                    } });*/
                    $('#'+reload).html();
                    $('#'+reload).html(respuesta);
                }
                else
                {
                     //M.toast({html: json.info , displayLength:2500});
                    if ( $.fn.dataTable.isDataTable( reload ) ) 
                    {
                        var table = $('#'+reload).DataTable();
                        
                        table.destroy();

                        $(table).html(respuesta);

                        $(table).DataTable({
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