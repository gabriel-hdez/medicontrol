<?php

/**
 * Validar Library v1.0.0
 * Librería creada por Gabriel Hernandez
 * Funciones para validaciones especificas
 * Fecha de Creacion: 02/08/2022
 */

class Validar {

	public function rango_fecha($valor, $desde, $hasta)
	{
		$desde = strtotime($desde);
		$hasta = strtotime($hasta);
		$valor = strtotime($valor);
		if (($valor >= $desde) && ($valor <= $hasta))
		   return true;
		return false;
	}
}