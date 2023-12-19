<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
	<head>
		<!-- 	METAETIQUETAS		-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="description" content="<?php echo APP_NAME;?>">
		<meta name="keywords" content="<?php echo APP_NAME;?>, sistema, notas, estudiantes">
		<!-- 	CSS		-->
		<link rel="stylesheet" href="<?php echo base_url('app/assets/css/materialize.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('app/assets/css/custom.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('app/assets/css/select2/select2.css');?>">
		<?php echo $this->resources->css();?>
		<!-- 	JS		-->
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/jquery-3.3.1.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/select2/select2.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/materialize.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/auto-numeric.min.js');?>"></script>
		<script defer type="text/javascript" src="<?php echo base_url('app/assets/js/main/jquery.mask.min.js');?>"></script>
		<script defer type="text/javascript" src="<?php echo base_url('app/assets/js/main/init.js');?>"></script>
		<?php if( isset($validacion) ){ ?>
			<script type="text/javascript" src="<?php echo base_url('app/assets/js/ajax/'.$validacion.'.js');?>"></script>
		<?php }else{ ?>
			<script type="text/javascript" src="<?php echo base_url('app/assets/js/ajax/forms.js');?>"></script>
		<?php } ?>
		<?php echo $this->resources->js();?>
		<!-- 	TITLE		-->
		<link rel="icon" href="<?php echo base_url('app/assets/img/medicontrol/mc.png');?>" sizes="50x50">
		<title><?php echo APP_FULLNAME; if(isset($titulo)){echo ' - '.$titulo;}; ?></title>
	</head>
	<body <?php //if($_SESSION['login']['tema'] == FALSE ){ echo 'id="theme-black"'; } ?>  >

		<!-- 	PRELOADERS		-->
		<div id="loader-wrapper" style="z-index: 999999;">
			 <div id="loader"></div>
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
		</div>
		<div id="indeterminate" class="progress teal hide">
			<div class="indeterminate teal darken-3"></div>
		</div>