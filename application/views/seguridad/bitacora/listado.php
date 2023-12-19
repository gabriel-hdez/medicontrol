<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
    <div class="card"  >
    	<div class="row titulo">
    		<h4 class="left" ><?php echo $titulo;?></h4>
    	</div>

    	<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
    		<thead>
            	<tr>
                	<!-- <th class="center">NRO</th> -->
                    <th class="center">FECHA</th>
                    <th class="center">BITÁCORA</th>
                	<th class="center">RESPONSABLE</th>
              	</tr>
            </thead>
            <tbody>
                <?php foreach ($bitacora as $item): ?>
            	<tr>
            		<!-- <td class="center"><?php //echo $item->id_bitacora;?></td> -->
                    <td class="center"><?php echo $item->fecha;?></td>
                    <td class="center"><?php echo $item->bitacora;?></td>
                    <td class="center"><?php echo $item->correo;?></td>
            	</tr>
                <?php endforeach; ?>
               
            </tbody>
    	</table>
    </div>
<!--   carga libreria datatables  -->
<?php $this->load->view('template/datatables'); ?>