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
	<link rel="icon" href="<?php echo base_url('app/assets/img/medicontrol/mc.png');?>" sizes="50x50">
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
	
  <div class="section no-pad-bot parallax-container" id="index-banner">
	    <div class="container parallax">
  			<img src="<?php echo base_url('app/assets/img/medicontrol/background.png');?>" alt="<?php echo APP_FULLNAME; ?>" >
	    </div>
	    
	    <div class="container">
	    	<div class="card z-depth-4" style="background-color: rgba(255,255,255, 0.7);">
	    		<div class="card-content">
			      
			      <img class="center-block" src="<?php echo base_url('app/assets/img/medicontrol/medicontrol.png');?>" width="25%" alt="<?php echo APP_FULLNAME; ?>" >

						<div class="height" >			
							<div class="row">

					      <div class="row container">
							    <div class="col s12">
							      <ul class="tabs">
							        <li class="tab col s4 disabled"><a >IDENTIFICAR USUARIO</a></li>
							        <li class="tab col s4"><a class="active" >PREGUNTA DE SEGURIDAD</a></li>
							        <li class="tab col s4 disabled"><a >CAMBIAR CONTRASEÑA</a></li>
							      </ul>
							    </div>

							    <div id="test2" class="col s12">

					        	<form data-response="json" method="POST" action="<?php echo base_url('seguridad/clave/respuesta'); ?>">
							        <div class="row" style="margin-top: 2rem;">
							        	<div class="input-field col s12 m8 push-m2">
					        				<i class="material-icons prefix blue-grey-text text-darken-3">person</i>
								          <input id="pregunta" name="pregunta" type="text"  style="background: transparent !important;" value="<?php echo $_SESSION['usuario']['pregunta']; ?>" readonly>
								          <label for="pregunta">PREGUNTA</label>
								          <span class="helper-text" data-success="¡Se ve bien!"></span>
								        </div>
								    </div>
								    <div class="row">
								        <div class="input-field col s12 m8 push-m2">
								        	<i class="material-icons prefix blue-grey-text text-darken-3 password" data-visibility="off">visibility</i>
								          <input id="respuesta" name="respuesta" type="password" class="validate" style="background: transparent !important;">
								          <label for="respuesta">RESPUESTA</label>
								          <span class="helper-text" data-success="¡Se ve bien!"></span>
								        </div>
								    </div>
								    <div class="row">
								        <div class="col s12 center">
								        	<button type="submit" class="waves-effect waves-light btn blue btn-large ">RESPONDER</button>
								        	<a class="waves-effect waves-light btn-flat" href="<?php echo base_url('seguridad/clave');?>"><?php echo 'No soy '.$_SESSION['usuario']['usuario']?></a>
								        </div>
							        </div>        
					        	</form>
								  </div>
								</div>							    
							</div>
						</div>
					</div>
	    	</div>
	    </div> 
	</div>

   <footer class="page-footer blue-grey darken-4">
    <div class="footer-copyright">
      <div class="container">
      	<div class="row">
	      	<div class="col s6">
	      		<p class="grey-text text-lighten-4"><?php echo 'Todos los derechos reservados '.' © '.date('Y');?></p>
	      	</div>
	      	<div class="col s6"> 
	   		      <p class="right">Página renderizada en <strong id="rendered"></strong> segundos</p>
	         </div>
      	</div>
      </div>
    </div>
  </footer>
	<script>
		$(document).ready(function(){
		    $('.tabs').tabs();
		    M.toast({html: "<?php  echo 'Confirma que eres '.$_SESSION['usuario']['correo']?>"})
		});
	</script>	
  </body>
</html>
	