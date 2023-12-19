<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('insumos/ajustes/actualizar');?>">
        <input type="hidden" name="token" value="<?php echo $accion; ?>">
        <input type="hidden" name="id" value="<?php echo $ajuste->id_ajuste; ?>">

        <div class="row">
                    
            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default" disable >
                    <?php foreach($instituciones as $item): ?>
                        <option value="<?php echo $item->id_institucion; ?>" <?php if($item->id_institucion == $ajuste->id_institucion){echo 'selected';}?> ><?php echo $item->institucion ?></option>
                    <?php endforeach; ?></select>
                <label for="id_institucion" class="active">INSTITUCION</label>
            </div>
        
            <div class="col s12 l4 input-field">
                <select name="id_insumo" id="id_insumo" class="select2 browser-default" disabled >
                    <?php foreach($insumos as $item): ?>
                        <option value="<?php echo $item->id_insumo; ?>" <?php if($item->id_insumo == $ajuste->id_insumo){echo 'selected';}?>  ><?php echo $item->codigo.' | '.$item->insumo; ?></option>
                    <?php endforeach; ?></select>
                <label for="id_insumo" class="active">INSUMO</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="tipo" id="tipo" class="select2 browser-default" disabled >
                    <option value="e" <?php if($ajuste->tipo == 'e'){echo 'selected';}?> >ENTRADA</option>
                    <option value="s" <?php if($ajuste->tipo == 's'){echo 'selected';}?> >SALIDA</option>
                </select>
                <label for="tipo" class="active">TIPO DE AJUSTE</label>
            </div>

            <div class="col s12 l4 input-field">
                <input id="cantidad" name="cantidad" type="text" class="validate decimal" placeholder="0.00" value="<?php echo $ajuste->cantidad; ?>" disabled >
                <label for="cantidad">CANTIDAD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

             <div class="col s12 l4 input-field">
                <input id="fecha_vencimiento" name="fecha_vencimiento" type="text" class="validate datepicker" placeholder="<?php echo date('Y-m-d');?>" value="<?php echo $ajuste->fecha_vencimiento; ?>" disabled >
                <label for="fecha_vencimiento">FECHA DE VENCIMIENTO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

            <div class="col s12 l4 input-field">
                <input id="descripcion" name="descripcion" type="text" class="validate" value="<?php echo $ajuste->descripcion; ?>" disabled >
                <label for="descripcion">DESCRIPCION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

        </div>
        
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue"><?php echo $accion; ?></button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('insumos/ajustes'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>	

