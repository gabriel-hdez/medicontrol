<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['data'] = array(
    'select' => '*', 
    'table'  => 'submenu',
    'join'  =>  array(
        'menu' => 'menu.id_menu = submenu.id_menu',   
    ),
    //'where' => 'submenu.href <> ""',
    'order' => 'menu.orden ASC, submenu.submenu ASC',
    'return' => 'result',
);
$submenu = $this->crud->read($data['data']);

foreach($submenu as $opcion){ 
    $menu[$opcion->menu][$opcion->submenu][$opcion->privilegio] = $opcion->crud ; 
}

?>
<div class="row">
    <h4>Privilegios de usuario</h4>
    <ul class="collapsible">
        <li class="desplegar active">
            <div class="collapsible-header"><h5 class="center black-text">LEYENDA</h5></div>
            <div class="collapsible-body">
                <table class="display highlight" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th class="center">MODULO</th>
                            <th class="center">PERMITIDO</th>
                            <th class="center">NO PERMITIDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Modulo de ejemplo</td>
                            <td class="center">
                                <label>
                                    <input type="checkbox" checked disabled >
                                    <span></span>
                                </label>
                            </td>
                            <td class="center">
                                <label>
                                    <input type="checkbox" disabled>
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table> 
            </div>
        </li>
    </ul>

    <?php foreach ($menu as $key => $value): ?>
    <ul class="collapsible">
        <li class="desplegar active">
            <div class="collapsible-header"><h5 class="center black-text"><?php echo strtoupper($key); ?></h5></div>
            <div class="collapsible-body">
                <table class="display highlight" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th class="center">MODULO</th>
                            <th class="center">CONTROL TOTAL</th>
                            <th class="center">AGREGAR</th>
                            <th class="center">LEER</th>
                            <th class="center">EDITAR</th>
                            <th class="center">ELIMINAR</th>
                            <th class="center">APROBACIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($value as $clave => $valor): ?>
                        <tr>
                            <td><?php echo $clave; ?></td>

                            <?php foreach ($valor as $k => $v): ?>
                                <td class="center">
                                    <label>
                                        <input type="checkbox"  value="t" data-modulo="<?php echo $k; ?>" <?php if($_SESSION['token'] == 'Activar' || $_SESSION['token'] == 'Desactivar'){ echo 'disabled'; } ?> >
                                        <span></span>
                                    </label>
                                </td>
                                <td class="center">
                                    <?php if(stripos($v, 'c') !== FALSE): ?>
                                    <label>
                                        <input type="checkbox" name="<?php echo $k.'[]'; ?>" value="c" id="<?php echo $k.'_c'; ?>" <?php if(isset($privilegio)){ if( stripos($privilegio->$k, 'c') !== FALSE){ echo 'checked="checked"';} } if($_SESSION['token'] == 'Activar' || $_SESSION['token'] == 'Desactivar'){ echo 'disabled'; } ?>>
                                        <span></span>
                                    </label>
                                    <?php endif; ?>
                                </td>   

                                <td class="center">
                                    <?php if(stripos($v, 'r') !== FALSE): ?>
                                    <label>
                                        <input type="checkbox" name="<?php echo $k.'[]'; ?>" value="r" id="<?php echo $k.'_r'; ?>" <?php if(isset($privilegio)){ if( stripos($privilegio->$k, 'r') !== FALSE){ echo 'checked="checked"';} } if($_SESSION['token'] == 'Activar' || $_SESSION['token'] == 'Desactivar'){ echo 'disabled'; } ?>>
                                        <span></span>
                                    </label>
                                    <?php endif; ?>
                                </td>
                                <td class="center">
                                    <?php if(stripos($v, 'u') !== FALSE): ?>
                                    <label>
                                        <input type="checkbox" name="<?php echo $k.'[]'; ?>" value="u" id="<?php echo $k.'_u'; ?>" <?php if(isset($privilegio)){ if( stripos($privilegio->$k, 'u') !== FALSE){ echo 'checked="checked"';} } if($_SESSION['token'] == 'Activar' || $_SESSION['token'] == 'Desactivar'){ echo 'disabled'; } ?>>
                                        <span></span>
                                    </label>
                                    <?php endif; ?>
                                </td>
                                <td class="center">
                                    <?php if(stripos($v, 'd') !== FALSE): ?>
                                    <label>
                                        <input type="checkbox" name="<?php echo $k.'[]'; ?>" value="d" id="<?php echo $k.'_d'; ?>" <?php if(isset($privilegio)){ if( stripos($privilegio->$k, 'd') !== FALSE){ echo 'checked="checked"';} } if($_SESSION['token'] == 'Activar' || $_SESSION['token'] == 'Desactivar'){ echo 'disabled'; } ?>>
                                        <span></span>
                                    </label>
                                    <?php endif; ?>
                                </td>
                                <td class="center">
                                    <?php if(stripos($v, 'a') !== FALSE): ?>
                                    <label>
                                        <input type="checkbox" name="<?php echo $k.'[]'; ?>" value="a" id="<?php echo $k.'_a'; ?>" <?php if(isset($privilegio)){ if( stripos($privilegio->$k, 'd') !== FALSE){ echo 'checked="checked"';} } if($_SESSION['token'] == 'Activar' || $_SESSION['token'] == 'Desactivar'){ echo 'disabled'; } ?>>
                                        <span></span>
                                    </label>
                                    <?php endif; ?>
                                </td>

                            <?php endforeach ?>

                        </tr>
                        <?php endforeach; ?>                       
                    </tbody>
                </table> 
            </div>
        </li>
    </ul>
    <?php endforeach; ?>
    
    
</div>
        
<script>
    (function($){
        $(function(){
            
            $('input[type=checkbox]').change(function() {
                                  
                var accion = $(this).val();
                
                if(accion == 't')
                {
                    var modulo = $(this).attr('data-modulo');
                    if ( $(this).prop('checked') )
                    {
                        $('#'+modulo+'_s').prop('checked',true);
                        $('#'+modulo+'_c').prop('checked',true);
                        $('#'+modulo+'_r').prop('checked',true);
                        $('#'+modulo+'_u').prop('checked',true);
                        $('#'+modulo+'_d').prop('checked',true);
                        $('#'+modulo+'_a').prop('checked',true);
                    }
                    else
                    {
                        $('#'+modulo+'_s').prop('checked',false);
                        $('#'+modulo+'_c').prop('checked',false);
                        $('#'+modulo+'_r').prop('checked',false);
                        $('#'+modulo+'_u').prop('checked',false);
                        $('#'+modulo+'_d').prop('checked',false);
                        $('#'+modulo+'_a').prop('checked',false);
                    }
                }
                else
                {
                    var input = $(this).attr('name');
                    var modulo = input.slice(0,-2);  
                    /*if (accion == 'c') 
                    {
                        $('#'+modulo+'_r').prop('checked',true);
                    }*/
                    if (accion == 'u') 
                    {
                        $('#'+modulo+'_r').prop('checked',true);
                    }
                    if (accion == 'd') 
                    {
                        $('#'+modulo+'_r').prop('checked',true);
                    }
                    if(accion == 'r')
                    {
                        $('#'+modulo+'_u').prop('checked',false);
                        $('#'+modulo+'_d').prop('checked',false);
                    }
                }               
            });
        });
    })(jQuery);
</script>
