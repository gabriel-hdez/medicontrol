<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('insumos/articulos/guardar');?>">
        <div class="row">
                    
            <!-- <div class="col s12 l4 input-field">
                <input id="codigo" name="codigo" type="text" class="validate" placeholder="Cod-1">
                <label for="codigo">CODIGO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div> -->            
            <div class="col s12 l4 input-field">
                <input id="insumo" name="insumo" type="text" class="validate" placeholder="Nombre del insumo">
                <label for="insumo">INSUMO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        
            <div class="col s12 l4 input-field">
                <select name="id_unidad_medida" id="id_unidad_medida" class="select2 browser-default" >
                    <?php foreach($unidades_medida as $item): ?>
                        <option value="<?php echo $item->id_unidad_medida; ?>"  ><?php echo $item->medida; ?></option>
                    <?php endforeach; ?></select>
                <label for="id_unidad_medida" class="active">UNIDAD DE MEDIDA</label>
            </div>

            <div class="col s12 l4 input-field">
                <input id="presentacion" name="presentacion" type="text" class="validate decimal" placeholder="500.00">
                <label for="presentacion">PRESENTACION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        

           <!--  <div class="col s12 l4 input-field">
                <input id="minimo" name="minimo" type="text" class="validate decimal" placeholder="1.00">
                <label for="minimo">STOCK MINIMO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div> -->

            <div class="col s12 l4 input-field">
                <input id="descripcion" name="descripcion" type="text" class="validate" >
                <label for="descripcion">DESCRIPCION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

        </div>
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue">GUARDAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('insumos/articulos'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>	

