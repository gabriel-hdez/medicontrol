<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
    <div class="card"  >
	
	<div class="row titulo">
		<h4 class="left" ><?php echo $titulo;?></h4>
	</div>

    <form data-response="json" method="POST" action="<?php echo base_url('insumos/ajustes/guardar');?>">
        <div class="row">
                    
            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default" >
                    <?php foreach($instituciones as $item): ?>
                        <option value="<?php echo $item->id_institucion; ?>"  ><?php echo $item->institucion ?></option>
                    <?php endforeach; ?></select>
                <label for="id_institucion" class="active">INSTITUCION</label>
            </div>
        
            <div class="col s12 l4 input-field">
                <select name="id_insumo" id="id_insumo" class="select2 browser-default" >
                    <?php foreach($insumos as $item): ?>
                        <option value="<?php echo $item->id_insumo; ?>"  ><?php echo $item->codigo.' | '.$item->insumo; ?></option>
                    <?php endforeach; ?></select>
                <label for="id_insumo" class="active">INSUMO</label>
            </div>

            <div class="col s12 l4 input-field">
                <select name="tipo" id="tipo" class="select2 browser-default" >
                    <option value="e"  >ENTRADA</option>
                    <option value="s"  >SALIDA</option>
                </select>
                <label for="tipo" class="active">TIPO DE AJUSTE</label>
            </div>

            <div class="col s12 l4 input-field">
                <input id="cantidad" name="cantidad" type="text" class="validate decimal" placeholder="0.00">
                <label for="cantidad">CANTIDAD</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

             <div class="col s12 l4 input-field">
                <input id="fecha_vencimiento" name="fecha_vencimiento" type="text" class="validate datepicker" placeholder="<?php echo date('Y-m-d');?>" >
                <label for="fecha_vencimiento">FECHA DE VENCIMIENTO</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

            <div class="col s12 l4 input-field">
                <input id="descripcion" name="descripcion" type="text" class="validate" >
                <label for="descripcion">DESCRIPCION</label>
                <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
            </div>

        </div>
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue">GUARDAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('insumos/ajustes'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>

<?php $this->load->view('insumos/ajustes/js'); ?>

	

