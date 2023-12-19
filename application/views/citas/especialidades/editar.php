<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="card"  >
    
    <div class="row titulo">
        <h4 class="left" ><?php echo $titulo;?></h4>
    </div>

    <form data-response="json" method="POST" action="<?php echo base_url('citas/especialidades/actualizar');?>">
        <input type="hidden" name="token" value="editar">
        <input type="hidden" name="id" value="<?php echo $disponibilidad->id_disponibilidad; ?>">

        <div class="row">
            <div class="col s12 l3 input-field">
                <select name="id_especialidad" id="id_especialidad" class="select2 browser-default select-especialidad" >
                    <option value="0" >Seleccione</option>
                    <?php foreach($especialidades as $item): ?>
                        <option value="<?php echo $item->id_especialidad; ?>" <?php if($item->id_especialidad == $disponibilidad->id_especialidad){echo 'selected';} ?> ><?php echo $item->especialidad; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_especialidad" class="active">ESPECIALIDAD</label>
            </div> 

            <div class="col s1 center">
                <a href="#modal" class="waves-effect waves-light btn blue-grey darken-2 btn-floating modal-trigger tooltipped" data-position="top" data-tooltip="Agregar especialidad" style="top:1.2rem;" >
                    <i class="material-icons">add</i>
                </a>
            </div>

            <div class="col s12 l4 input-field">
                <select name="id_institucion" id="id_institucion" class="select2 browser-default select-anidado" data-url="<?php echo base_url('citas/especialidades/personal/select-personal'); ?>" >
                    <option value="0" >Seleccione</option>
                    <?php foreach($instituciones as $item): ?>
                        <option value="<?php echo $item->id_institucion; ?>" <?php if($item->id_institucion == $disponibilidad->id_institucion){echo 'selected';} ?> ><?php echo $item->institucion; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_institucion" class="active">INSTITUCION</label>
            </div>
            <div class="col s12 l4 input-field">
                <select name="id_personal" id="id_personal" class="select2 browser-default select-personal" >
                    <option value="0" >Seleccione</option>
                    <?php foreach($personal as $item): ?>
                        <option value="<?php echo $item->id_personal; ?>" <?php if($item->id_personal == $disponibilidad->id_personal){echo 'selected';} ?> ><?php echo substr($item->tipo_persona, 0,1).'-'.$item->cedula.', '.$item->nombres.' '.$item->apellidos; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="id_personal" class="active">MEDICO ESPECIALISTA</label>
            </div>    
        </div>

        <div class="row titulo">
            <h5 class="center" >Horario de disponibilidad</h5>
        </div>
        <div class="row">
            <div class="col s12 l6 push-l3">
                <table class="highlight" cellspacing="0" >
                        <thead>
                            <tr>
                                <th class="center">
                                    <label>
                                        <input type="checkbox" id="checkboxPrincipal" >
                                        <span></span>
                                    </label>
                                </th>
                                <th class="left">DIA</th>
                                <th class="center">HORA INICIO</th>
                                <th class="center">HORA FINAL</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= 7; $i++): ?>
                        <tr>
                            <?php $diaSeleccionado = false; ?>
                            <?php foreach ($horarios as $horario): ?>
                                <?php if ($i == $horario->dia): ?>
                                    <?php $diaSeleccionado = true; ?>
                                    <td class="center">
                                        <label>
                                            <input type="checkbox" name="dia[]" id="<?php echo 'dia_'.$i;?>" value="<?php echo $i;?>" checked>
                                            <span></span>
                                        </label>
                                    </td>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if (!$diaSeleccionado): ?>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" name="dia[]" id="<?php echo 'dia_'.$i;?>" value="<?php echo $i;?>">
                                        <span></span>
                                    </label>
                                </td>
                            <?php endif; ?>

                            <?php foreach($dias as $dia): ?>
                                <?php if($dia->id_dia == $i): ?>
                                    <td class="left"><?php echo $dia->dia;?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php $horaInicioValue = $horaFinalValue = ''; ?>
                            <?php foreach ($horarios as $horario): ?>
                                <?php if ($i == $horario->dia): ?>
                                    <?php $horaInicioValue = $horario->hora_inicio; ?>
                                    <?php $horaFinalValue = $horario->hora_final; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <td class="center">
                                <input type="text" name="hora_inicio[]" id="<?php echo 'inicio_'.$i;?>" class="timepicker" placeholder="" <?php if ($diaSeleccionado): ?> value="<?php echo $horaInicioValue; ?>" <?php endif; if (!$diaSeleccionado): ?> disabled <?php endif; ?>>
                            </td>

                            <td class="center">
                                <input type="text" name="hora_final[]" id="<?php echo 'final_'.$i;?>" class="timepicker" placeholder="" <?php if ($diaSeleccionado): ?> value="<?php echo $horaFinalValue; ?>" <?php endif; if (!$diaSeleccionado): ?> disabled <?php endif; ?>>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
       
        <div class="row p-bottom-2">
            <div class="col s12 center">
                <button type="submit" class="waves-effect waves-light btn blue" >GUARDAR</button>
                <a  class="waves-effect waves-light btn-flat" href="<?php echo base_url('citas/especialidades'); ?>">REGRESAR</a>
            </div>
        </div>
    </form>

</div>  
<div id="modal" class="modal">
    <form data-response="json" id="formAgregarEspecialidad" method="POST" action="<?php echo base_url('citas/especialidades/agregar');?>">
        <input name="param" type="hidden" value="#id_especialidad">
        
        <div class="modal-content">
            <div class="row center">
                <h5>Agregar nueva especialidad</h5>
            </div>

            <div class="row">
                <div class="col s12 l4 input-field push-l4">
                    <input id="especialidad" name="especialidad" type="text" class="validate">
                    <label for="especialidad">ESPECIALIDAD</label>
                    <span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="waves-effect waves-light btn blue actualizar" >AGREGAR</button>
          <a class="modal-close waves-effect waves-light btn-flat">CERRAR</a>
        </div>
    </form>
</div>

<?php $this->load->view('citas/especialidades/js'); ?>

