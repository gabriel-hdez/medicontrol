<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
  <head>
    <style>
        .center{
          text-align: center;
        }
        .titulo{
          font-size: 9px;
          font-weight: bold;
        }
        .tabla{
          width: 100%;
        }
        .linea>td, .linea>th{
          border: 1px solid #000;
        }
        .gris{
          background-color: #CCC;
        }
        th,td{
          line-height: 18px;
          vertical-align: top;        
        }
        p{
          font-size: 11px;
        }
        .parrafo{
          line-height: 25pt;
          text-align: justify;
        }
      </style>
  </head>      
   <body>
       <h2 class="center">MEDICONTROL</h2>     
       <h3 class="center">REPORTE DE INVENTARIO</h3>     

        <table class="tabla" >
            <thead>
              <tr class="linea">
                    <th class="titulo center gris">INSTITUCION</th>
                    <th class="titulo center gris">CODIGO</th>
                    <th class="titulo center gris">INSUMO</th>
                    <th class="titulo center gris">PRESENTACION</th>
                    <th class="titulo center gris">DESCRIPCION</th>
                    <th class="titulo center gris">EXISTENCIA</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $idInstitucion = $_SESSION['login']['id_institucion_actual'];

                $sql = 'SELECT b.institucion, i.codigo, i.insumo, u.medida, u.notacion, i.descripcion, i.presentacion,  
                        COALESCE(SUM(CASE WHEN a.tipo = "e" THEN a.cantidad ELSE 0 END), 0) -
                        COALESCE(SUM(CASE WHEN a.tipo = "s" THEN a.cantidad ELSE 0 END), 0) AS existencia
                        FROM insumos i
                        LEFT JOIN ajustes a ON i.id_insumo = a.id_insumo
                        LEFT JOIN instituciones b ON a.id_institucion = b.id_institucion
                        LEFT JOIN unidades_medida u ON u.id_unidad_medida = i.id_unidad_medida
                        WHERE a.estado = "1"';

                if ($idInstitucion != 0) 
                {
                    $sql .= ' AND a.id_institucion = '.$idInstitucion;
                }
                $sql .= ' GROUP BY a.id_institucion, i.id_insumo, i.insumo';
                $data['sql'] = array('sql' => $sql, );

                $insumos = $this->crud->query_sql($data['sql']);

                for($i=0; $i < count($insumos); $i++): 
                ?>
                  <tr class="linea">
                        <td class="center"><?php echo $insumos[$i]->institucion;?></td>
                        <td class="center"><?php echo $insumos[$i]->codigo;?></td>
                        <td class="center"><?php echo $insumos[$i]->insumo;?></td>
                        <td class="center"><?php echo $insumos[$i]->presentacion.' '.$insumos[$i]->notacion;?></td>
                        <td class="center"><?php echo $insumos[$i]->descripcion;?></td>
                        <td class="center"><?php echo $insumos[$i]->existencia;?></td>
                  </tr>
                <?php endfor; ?>
               
            </tbody>
        </table>

   </body>     
</html>