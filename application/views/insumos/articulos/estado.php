<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('insumos/articulos/actualizar');?>">
        <input type="hidden" name="token" value="<?php echo $accion; ?>">
        <input type="hidden" name="id" value="<?php echo $insumo->id_insumo; ?>">

        <div class="row">
            <div class="col s12 l4 input-field">
                <input id="codigo" name="codigo" type="text" class="validate" placeholder="Cod-1" value="<?php echo $insumo->codigo; ?>" disabled>
                <label for="codigo">CODIGO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>            
            <div class="col s12 l4 input-field">
                <input id="insumo" name="insumo" type="text" class="validate" placeholder="Nombre del insumo" value="<?php echo $insumo->insumo; ?>" disabled>
                <label for="insumo">INSUMO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        
            <div class="col s12 l4 input-field">
                <select name="medida" id="medida" class="select2 browser-default" disabled>
                    <?php foreach($unidades_medida as $item): ?>
                        <option value="<?php echo $item->id_unidad_medida; ?>" <?php if($item->id_unidad_medida == $insumo->id_unidad_medida){echo 'selected';}?> ><?php echo $item->medida; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="medida" class="active">UNIDAD DE MEDIDA</label>
            </div>
            <div class="col s12"></div>

            <div class="col s12 l4 input-field">
                <input id="presentacion" name="presentacion" type="text" class="validate decimal" placeholder="500.00" value="<?php echo $insumo->presentacion; ?>" disabled>
                <label for="presentacion">PRESENTACION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

            <!-- <div class="col s12 l4 input-field">
                <input id="minimo" name="minimo" type="text" class="validate decimal" placeholder="1.00" value="<?php //echo $insumo->minimo; ?>" disabled>
                <label for="minimo">STOCK MINIMO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div> -->

            <div class="col s12 l4 input-field">
                <input id="descripcion" name="descripcion" type="text" class="validate"  value="<?php echo $insumo->descripcion; ?>" disabled>
                <label for="descripcion">DESCRIPCION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>
        </div>
        
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue"><?php echo $accion; ?></button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('insumos/articulos'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>	

