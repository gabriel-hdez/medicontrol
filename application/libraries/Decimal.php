<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Decimal v1.0.0
 * Librería creada por Gabriel HErnandez
 * Setea valores decimales y grupo de miles a decimales que se puedan guardar en BD
 * Fecha de Creacion: 30/06/2021
 */

class Decimal {

	/**
	 * Quotes to Entities
	 *
	 * Converts single and double quotes to entities
	 *
	 * @param	string
	 * @return	string
	 */
	function normalize($str)
	{
		return str_replace(array(","), array(""), $str);
	}
}