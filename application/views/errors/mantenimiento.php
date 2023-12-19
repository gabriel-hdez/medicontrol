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
	<meta name="description" content="<?php echo APP_NAME;?>, Fumigación integral, compra y venta de productos: insecticidas, fetilizantes y roenticidas.">
	<meta name="keywords" content="<?php echo APP_NAME;?>, sistema, soporte, equipos">
	<!-- 	CSS		-->
	<link rel="stylesheet" href="<?php echo base_url('app/assets/css/materialize.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('app/assets/css/custom.css');?>">
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
	<title><?php echo APP_NAME;?></title>
</head>
<body>
  

	<div id="index-banner" class="parallax-container">
		<!-- <div class="gradient" style="position: absolute; width: 100%; min-height: 100vh; z-index: 0;"></div> -->
		<div class="section no-pad-bot ">
			<div class="container ">
				<h1 class="header center">
					<img style="width: 300px; display: block; margin: auto;" class="superponer breathing" src="<?php echo base_url('app/assets/img/medicontrol/mc.png');?>" >
				</h1>
				<div class="row center">
					<h1 class="header col s12 black-text superponer"><?php echo APP_FULLNAME; ?></h1>
				</div>
				<div class="row center">
					<h3 class="black-text"><?php echo $titulo; ?></h3>
					<a href="<?php echo base_url('inicio/bienvenido'); ?>" class="btn-large waves-effect waves-light blue darken-2">VOLVER AL INICIO</a>
				</div>
			</div>
		</div>
	</div>

  </body>
</html>


