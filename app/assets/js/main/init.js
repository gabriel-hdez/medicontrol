/* 
/* FOUNDATION */
//$(document).foundation();
/* PRELOADER */
$(window).on('load', function(event) {
  var render = (event.timeStamp/1000).toFixed(2);
  $('#rendered').html(render);
  //$('#rendered').html(event.timeStamp/1000);
  //console.log(render);
  setTimeout(function() {
    $('body').addClass('loaded');
  }, 200);
});

/*let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});*/

function doTheClock(){
  var hoy = new Date();

  var meses = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
  var dias = new Array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');

  var hora = hoy.getHours();
  if(hora < 10) hora = '0'+hoy.getHours();

  var minutos = hoy.getMinutes();
  if(minutos < 10) minutos = '0'+hoy.getMinutes();

  var segundos = hoy.getSeconds();
  if(segundos < 10) segundos = '0'+hoy.getSeconds();

  var mostrar = dias[hoy.getDay()]+', '+hoy.getDate()+' de '+meses[hoy.getMonth()]+' de '+hoy.getFullYear()+' - '+hora+':'+minutos+':'+segundos;

  window.setTimeout("doTheClock()", 1000);
  //return mostrar;
  $("#fecha_hora").html(mostrar);
}

doTheClock();

/* funcion nextThrough: busca cualquier elemento siguiente sin importar la estructura del DOM */
/* $('.selector').nextThrough('.elemento siguiente').addClass('hide') */
(function ($) {
  'use strict';
  $.fn.nextThrough = function (selector) {
    var $reference = $(this).last(),
      $set = $(selector).add($reference),
      $pos = $set.index($reference);

      if($set.lenght === $pos)
      {
        return $();
      }

      return $set.eq($pos + 1);
  };
}(jQuery));


/* MATERIALIZE */

/*document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, options);

  instances.open();
});
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      direction: 'right',
      hoverEnabled: false
    });
});*/


(function($){
    $(function(){


    if( $(".select-img") )
    {
      $(".select-img").each(function() {
        var id = $(this).attr('id');

        function formatState(state) {
          if (!state.id) {
            return state.text;
          }
          var baseUrl = $('#' + id).attr('data-url');
          var $state = $(
            '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" width="25px" class="img-flag" /> ' + state.text + '</span>'
          );
          return $state;
        }

        $('#' + id).select2({
          width: "100%",
          templateResult: formatState
        });
      });
    }
    else
    {
      $('select').select2({width: "100%"});
    }
    
    $('input').attr('autocomplete', 'off');
    $('.slider').slider({indicators: true});
    $('.modal').modal({'dismissible':false});
    $('.tabs').tabs();
    $('.dropdown-trigger').dropdown({'hover':false});
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    //$('select').formSelect();
    $('.tap-target').tapTarget();
    $('.materialboxed').materialbox();
    $('.tabs').tabs();
    //$('.parallax').parallax();
    //$('.slider').slider({indicators: true});
    //$('input').attr({autocomplete: 'off'});

    $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: true,
      duration: 200,
      // autoplay: true,
    });
    window.setInterval(function() { $(".carousel").carousel('next') }, 5000);
    //$('input.validate').characterCounter();
    //$('#modal1').modal("open");
    //M.toast({html: 'I am a toast!', displayLength:6000});

   /* $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        //maxYear: 2018,
        //maxDate: new Date(),
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
    });*/

    /* SCROLLBAR PERFECTO 
    $('select').not('.disabled').formSelect();
    var leftnav = $(".page-topbar").height();
    var leftnavHeight = window.innerHeight - leftnav;
    if (!$('#slide-out.leftside-navigation').hasClass('native-scroll')) {
      $('.leftside-navigation').perfectScrollbar({
        suppressScrollX: true
      });
    }
    var righttnav = $("#chat-out").height();
    $('.rightside-navigation').perfectScrollbar({
      suppressScrollX: true
    });
    */

    /* FULL SCREEN */
    function toggleFullScreen() {
      if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
          document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
          document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    }
    $('.toggle-fullscreen').click(function() {
      toggleFullScreen();
    });

    /* DETECTA PANTALLA TACTIL PARA DESABILITAR EL SCROLLBAR */
    function is_touch_device() {
      try {
        document.createEvent("TouchEvent");
        return true;
      } catch (e) {
        return false;
      }
    }
    if (is_touch_device()) {
      $('#nav-mobile').css({
        overflow: 'auto'
      })
    }

     /* SIDENAVS */
    // $('.sidenav-trigger').on('hover', function(event) {
    //   alert('hover');
    // });

   
    /*$('.sidenav-trigger').sidenav(
      {edge: 'right'}
    );*/

    $('.sidenav').sidenav();

    function fullscreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||    // metodo alternativo
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {               // metodos actuales
      if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    } else {
      if (document.cancelFullScreen) {
        document.cancelFullScreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      }
    }
  }

  $('.select-anidado').bind('change', function (event) {
        var url = $(this).attr('data-url');
        var busqueda = $(this).val();
        //var id = $('#categoria option:selected').val();

        $.ajax({
            type: "POST",
            url: url,
            data: {busqueda:busqueda},
            /*cache:false,
            contentType:false,
            processData:false,*/
            beforeSend:function(){ 
                $('.progress').removeClass('hide');
            }
        })
        .done( function(respuesta){
            var json = $.parseJSON(respuesta);
            $('.'+json.ajax).empty();

            $.each(json.options, function(key, value) {
                $('.'+json.ajax).append('<option value="' + value.id + '">' + value.opcion + '</option>');
            }); 
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

    $('.password').click(function () {
        var visibility = $(this).attr('data-visibility');

        if (visibility == 'off') 
        {
            $(this).attr('data-visibility','true');
            $(this).html('visibility_off');
            $(this).siblings('.validate').attr('type','text');
        }
        else 
        {
            $(this).attr('data-visibility','off');
            $(this).html('visibility');
            $(this).siblings('.validate').attr('type','password');
        }
    });

  });
})(jQuery);

/*function cambiar_rif(id) {
  var select = $('#'+id).attr('id')+' option:selected';
  var cambiar = $('#'+id).attr('data-change');
  var anterior = $('#'+cambiar).val().substr(2);
  var rif = $('#'+select).text();
  var cadena = rif.trim().charAt(0)+'-';

  $('#'+cambiar).val(cadena+anterior);
  M.updateTextFields();
}*/