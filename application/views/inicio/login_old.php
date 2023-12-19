<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<!-- 	METAETIQUETAS		-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="description" content="<?php echo APP_FULLNAME;?>">
	<meta name="keywords" content="<?php echo APP_FULLNAME;?>, medicina control">
	<!-- 	CSS		-->
	<link rel="stylesheet" href="<?php echo base_url('app/assets/css/materialize.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('app/assets/css/style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('app/assets/css/select2/select2.css');?>">
	<?php echo $this->resources->css();?>
	<!-- 	JS		-->
	<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/jquery-3.3.1.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/select2/select2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/materialize.min.js');?>"></script>
	<script defer type="text/javascript" src="<?php echo base_url('app/assets/js/main/jquery.mask.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/init.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('app/assets/js/ajax/forms.js');?>"></script>
	<?php echo $this->resources->js();?>
	<!-- 	TITLE		-->
	<link rel="icon" href="<?php echo base_url('app/assets/img/ms/logo-color.png');?>" sizes="50x50">
	<title><?php echo APP_FULLNAME;?></title>
</head>
<body>
	<div id="loader-wrapper" style="z-index: 999999;">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<div id="indeterminate" class="progress teal hide">
		<div class="indeterminate teal darken-3"></div>
	</div>

	<div id="login" class="modal " >
	    <div class="modal-content" >
	        <h4 class="modal-close close-icon material-icons">clear</h4>

	        <!-- <div class="header center">
	        	<img src="<?php //echo base_url('app/assets/img/ms/logo-negro.png'); ?>" class="superponer" width="150rem">
	        </div> -->
	        <div class="row center">
	         <h3 class="header col s12 superponer"><?php echo APP_FULLNAME; ?></h3>
	        </div>

	        <form data-response="json" id="inicio" method="POST" action="<?php echo base_url('inicio/login'); ?>">
	        	<div class="row">
		        	<div class="input-field col s12 m6 l4 push-m3 push-l4">
			          <input id="usuario" name="usuario" type="text" class="validate" style="background: transparent !important;">
			          <label for="usuario">USUARIO</label>
			          <span class="helper-text" data-success="¡Se ve bien!"></span>
			        </div>
			    </div>
			    <div class="row">
			        <div class="input-field col s12 m6 l4 push-m3 push-l4">
			        	<i class="material-icons prefix password" data-visibility="off">visibility</i>
			          <input id="clave" name="clave" type="password" class="validate" style="background: transparent !important;">
			          <label for="clave">CONTRASEÑA</label>
			          <span class="helper-text" data-success="¡Se ve bien!"></span>
			        </div>
		        </div>
	            <div class="row">
	                <div class="col s12 center">
	                    <button type="submit" class="waves-effect waves-light btn btn-large" >INICIAR SESIÓN</button>
	                </div>
	                <div class="col s12 center">
	                    <a class="waves-effect waves-light btn-flat btn-large modal-close" href="<?php echo base_url('seguridad/clave');?>">RECUPERAR DATOS</a>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>

	<!-- <nav class="transparent z-depth-0" role="navigation" style="position: absolute; width: 100%;">
	    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo white-text"><?php //echo APP_FULLNAME; ?></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a class="white-text" href="#">Iniciar sesión</a></li>
	      </ul>

	      <ul id="nav-mobile" class="sidenav">
	        <li><a href="#">Iniciar sesión</a></li>
	      </ul>
	      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
	    </div>
	</nav> -->  

  <div class="section no-pad-bot parallax-container" id="index-banner">
	    <div class="container parallax">
  			<img src="<?php echo base_url('app/assets/img/medicontrol/background.png');?>" alt="<?php echo APP_FULLNAME; ?>" >
	    </div>
	    
	    <div class="container">
	      <h1 class="header center teal-text text-lighten-1 text-3d"><?php echo APP_FULLNAME; ?></h1>
	      <div class="row center">
	        <h5 class="header col s12 light text-shadow"><?php echo APP_DESCRIPTION; ?></h5>
	      </div>
	      <div class="row center">
	        <a href="#login" class="btn-large waves-effect waves-light teal hoverable modal-trigger">Solicitar cita</a>
	        <a href="#login" class="btn-large waves-effect waves-light grey hoverable modal-trigger">Iniciar sesión</a>
	      </div>
	      <br><br>
	    </div>
	</div>


  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12 m4">
          <div class="card hoverable icon-block" style="padding: 5rem;">
            <h2 class="center light-blue-text" style="font-size: 6rem;"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Rapida atencion</h5>
            <p class="light center" style="font-size: 1.3rem;">Solicitud online de citas en especialidades medicas desde la comodidad de tu hogar</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="card hoverable icon-block" style="padding: 5rem;">
            <h2 class="center light-blue-text" style="font-size: 6rem;"><i class="material-icons">group</i></h2>
            <h5 class="center">Mejor experiencia</h5>

            <p class="light center" style="font-size: 1.3rem;">Conectividad entre pacientes y medicos, supervision de hospitalizacion y tratamiento, planificacion de cirugias</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="card hoverable icon-block" style="padding: 5rem;">
            <h2 class="center light-blue-text" style="font-size: 6rem;"><i class="material-icons">folder_shared</i></h2>
            <h5 class="center">Historia clinica</h5>
            <p class="light center" style="font-size: 1.3rem;">Seguimiento de historia clinica de pacientes, resultados de laboratorio y mas</p>
          </div>
        </div>
      </div>
    </div>
    <br><br>
  </div>

  <div class="section no-pad-bot parallax-container" id="index-banner">
	    <div class="container parallax">
  			<img src="<?php echo base_url('app/assets/img/medicontrol/background-2.png');?>" alt="<?php echo APP_FULLNAME; ?>" >
	    </div>
	    
	    <div class="container">
	      <!-- <h1 class="header center teal-text text-3d"><?php //echo APP_FULLNAME; ?></h1> -->
	      <div class="row center">
	        <h5 class="header col s12 light text-shadow">Consulta tus resultados de laboratorio</h5>
	      </div>
	      <div class="row center">
	        <a href="#login" class="btn-large waves-effect waves-light teal hoverable modal-trigger">Consultar</a>
	      </div>
	      <br><br>
	    </div>
	</div>

  <footer class="page-footer blue-grey">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text"><?php echo APP_FULLNAME; ?></h5>
          <!-- <p class="grey-text text-lighten-4"><?php //echo APP_DESCRIPTION; ?></p> -->
          <p class="grey-text text-lighten-4"><?php echo 'Todos los derechos reservados '.' © '.date('Y');?></p>
        </div>
        <!-- <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div> -->

      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      	<div class="right"> 
   		      Página renderizada en <strong id="rendered"></strong> segundos
         </div>
      </div>
    </div>
  </footer>

	<script>
		$('.parallax').parallax();
	</script>

  </body>
</html>


