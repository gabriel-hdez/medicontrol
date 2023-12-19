<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <nav class= "gradient-semi-dark no-imprimir" >
        <div class="nav-wrapper container">

        <a href="#" data-target="mobile-demo" class="sidenav-trigger sidenav-close menu titulo-navbar hide-on-medium-and-up" onclick="$('header, main, footer, section').css({'padding-left':'0'}); $('.menu').css({'left':'0'}); $('.brand-logo').css({'margin-left':'0'});">
          <i class="material-icons">menu</i>
        </a>
        <a href="<?php echo base_url('inicio/bienvenido');?>" class="brand-logo center titulo-navbar" data-target="mobile-demo">
          <?php echo APP_FULLNAME;?>
        </a>
            <ul class="right avatar-dropdown">
              <li class="avatar-navbar row">
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown-usuario"><?php echo $_SESSION['login']['correo']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
              </li>
            </ul>

            <ul id='dropdown-usuario' class='dropdown-content'>
            <li class="avatar-option" >
                
              <img alt="usuario" class="tema-usuario circle" src="<?php echo base_url('app/assets/img/avatars/usuario-negro.png');?>" >
              <p class="avatar-name center grey-text"><?php echo $_SESSION['login']['correo']; ?></p>
            </li>
          
            <li><a href="<?php echo base_url('inicio/usuario_editar'); ?>"><i class="material-icons">mode_edit</i> Editar mis datos</a></li>
           
            <li><a href="<?php echo base_url('inicio/logout'); ?>"><i class="material-icons">power_settings_new</i> Cerrar sesión</a></li>
          </ul>

        </div>
    </nav>

      <ul class="sidenav grey darken-3 no-imprimir" id="mobile-demo">
      <!--<ul class="sidenav sidenav-fixed" id="mobile-demo">
         <li><a href="#" data-target="mobile-demo" class="sidenav-trigger"> Inicio</a></li> -->
        <ul class="collapsible">
          <li style="height: 250px;">
            <a href="<?php echo base_url('inicio/bienvenido');?>" style="height: 250px; border: none;">
              <img style="width: 200px; padding: 1rem 0rem;" class="center-block" src="<?php echo base_url('app/assets/img/medicontrol/medicontrol.png'); ?>">
            </a>
          </li>
          <?php 
            $data['data'] = array(
            'select' => '*', 
            'table'  => 'submenu',
            'join'  =>  array(
              'menu' => 'menu.id_menu = submenu.id_menu',   
            ),
            'where' => 'submenu.href <> ""',
            'order' => 'menu.orden ASC, submenu.submenu ASC',
            'return' => 'result',
          );
          $submenu = $this->crud->read($data['data']);

          foreach($submenu as $opcion){
            if(isset($_SESSION['permiso'][$opcion->privilegio]) && $_SESSION['permiso'][$opcion->privilegio] != NULL ){
              
              if( stripos($_SESSION['permiso'][$opcion->privilegio], 'r') !== FALSE){
                $menu[$opcion->menu][$opcion->submenu] =  $opcion->href ;
              }elseif(stripos($_SESSION['permiso'][$opcion->privilegio], 'c') !== FALSE){ 
                /*if($opcion->submenu == 'Postulacion')
                {
                  $menu[$opcion->menu][$opcion->submenu] =  $opcion->href ;
                }
                else
                {*/
                  $menu[$opcion->menu][$opcion->submenu] = $opcion->href.'/nuevo';
                //}
              }
            }
          }
            
            foreach ($menu as $key => $value): 
            ?> 
            <li class="desplegar">
              <div class="collapsible-header"><?php echo $key; ?></div>
              <ul class="collapsible-body">
                <?php foreach ($value as $k => $v): ?>
                <li>
                  <a href="<?php echo base_url().$v; ?>"><?php echo $k; ?></a>
                </li>
                <?php endforeach;?>
              </ul>
            </li>
        <?php endforeach;?>

          <li>
            <a class="collapsible-header" href="<?php echo base_url('inicio/logout'); ?>"> Cerrar sesión</a>
            <!-- <ul class="collapsible-body">
            </ul> -->
          </li>
      </ul>
    </ul>
    <section class="container height"  >
      
      <form data-response="json" id="perfiles" method="POST" action="<?php echo base_url('inicio/permisos'); ?>"  class="no-imprimir">
        <div class="row"> 
          <?php if( count($_SESSION['login']['perfiles']) > 1 ): ?>
          <div class="col s12 l6 input-field">
              <select name="select_perfil" id="select_perfil" class="select2 browser-default" onchange=" M.toast({ html: 'Es necesario recargar el sistema para aplicar los cambios' ,displayLength:3000, completeCallback: function(){ $('#perfiles').submit(); }}); " >
                  <?php foreach($_SESSION['login']['perfiles'] as $key => $value): ?>
                      <option value="<?php echo $key; ?>"  ><?php echo $value; ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
        <?php endif; ?>
          <p  id="fecha_hora" class="right"></p>
        </div>
      </form>