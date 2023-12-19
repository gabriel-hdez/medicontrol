<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<style>
		.row a{ font-size:1.5rem; }		
	</style>

	<div class="col s12 l3">
		<div class="card blue z-depth-1 center" style="min-height:270px;">
		  <div class="card-content">
		    	<i class="material-icons white-text" style="font-size:7rem;">folder_shared</i>
			  	<div class="row">
		          	<a class="white-text" href="#">HISTORIAS CLÍNICAS</a>
			  	</div>
	       </div>
		</div>
	</div>

	<div class="col s12 l3">
		<div class="card purple z-depth-1 center" style="min-height:270px;">
		  <div class="card-content">
		    	<i class="material-icons white-text" style="font-size:7rem;">event</i>
			  	<div class="row">
		          	<a class="white-text" <?php if(stripos($_SESSION['permiso']['citas_solicitar'], 'c') !== FALSE): ?> href="<?php echo base_url('citas/solicitar'); ?>" <?php endif;?> >CITAS EN ESPECIALIDADES</a>
			  	</div>
	       </div>
		</div>
	</div>

	<div class="col s12 l3">
		<div class="card orange z-depth-1 center" style="min-height:270px;">
		  <div class="card-content">
		    	<i class="material-icons white-text" style="font-size:7rem;">airline_seat_flat</i>
			  	<div class="row">
		          	<a class="white-text" href="#">PLANIFICACIÓN DE CIRUGÍAS</a>
			  	</div>
	       </div>
		</div>
	</div>

	<div class="col s12 l3">
		<div class="card teal z-depth-1 center" style="min-height:270px;">
		  <div class="card-content">
		    	<i class="material-icons white-text" style="font-size:7rem;">add_box</i>
			  	<div class="row">
		          	<a class="white-text" <?php if(stripos($_SESSION['permiso']['insumos_ajustes'], 'c') !== FALSE): ?> href="<?php echo base_url('insumos/ajustes'); ?>" <?php endif;?> >GESTIÓN DE INSUMOS</a>
			  	</div>
	       </div>
		</div>
	</div>


</div>


