<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//# @helper Funciones Comunes 1.0b - Sep 2013
/**
 * Funciones-Comunes 1.0b - Sep 2013
 * Helper con funciones comunes varias
 * 
 * @author jjyepez <jyepez@inn.gob.ve>
 *
 * @package Funciones Comunes 1.0
 * @version 1.0b
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/deed.es
 * 
 */

if( ! function_exists('prp')) {
	function prp( $arg=array(), $die = FALSE ) {

		echo "\n<pre>\n";
		if( ! is_array($arg)) {
			if( ! is_object($arg)) {
				echo $arg;
			} else {
				print_r((array) $arg);
			}
		} else {
			print_r($arg);
		}
		echo "</pre>\n";
		if ($die) die('<pre><br>ejecuci&oacute;n terminada ...</pre>');
	}
}

if( ! function_exists( 'table_exists' )) {
	function table_exists($table="schema.table_name"){

		$frgmts =explode('.',$table);
		$schema =trim(strtolower((isset($frgmts[1]))?"LOWER(table_schema) like '%".$frgmts[0]."%' and ":" "));
		$table  =trim(strtolower((isset($frgmts[1]))?$frgmts[1]:$frgmts[0]));
		$CI     = & get_instance();
		$sql    ="SELECT count(*) as n FROM information_schema.tables WHERE $schema LOWER(table_name) = '$table' limit 1;";
		$rs     =$CI->db->query($sql);
		$rsx    =$rs->row_array();
		$salida =($rsx['n']=="1");
		return $salida;
	}
}

if( ! function_exists('reordenar_campos_segun_array')) {
	function reordenar_campos_segun_array($arreglo_campos, $arreglo_orden){
		
		$arr_salida=array();
		$arr_ordenado=array();
		$arr_quitar=array();
		$arr_quedaron_sin_orden=array();
		foreach($arreglo_orden as $id_campo => $contenido){
			foreach($arreglo_campos as $id => $info_campo){
				$info_campo=(array) $info_campo;
				if($info_campo['name']==$id_campo){
					array_push($arr_ordenado,$info_campo);
					$arr_quitar[]=$id;
					break;
				}
			}
		}
		foreach($arreglo_campos as $id => $info_campo){
			$info_campo=(array) $info_campo;
			if(array_search($id,$arr_quitar)===false){
				array_push($arr_quedaron_sin_orden,$info_campo);
			}
		}
		$arr_salida=array_merge($arr_ordenado,$arr_quedaron_sin_orden);

		return $arr_salida;
	}
}

if( ! function_exists( 'formato_ceros' ) ) {
	function formato_ceros( $numero, $ceros = 4 ){
		$salida = "";

		$cad_ceros = str_repeat( '0', $ceros );
		$salida = substr_replace( $cad_ceros, $numero , strlen( $cad_ceros ) - strlen( trim( (string) $numero ) ) );

		return $salida;
	}
}

if( ! function_exists( 'autocodigo' ) ) {
	function autocodigo( $tabla, $id ){
		$salida = "";

		$prefijo_tabla = "";
		//se separa el esquema
		$parte1 = explode( '.', $tabla );
		$tabla_sola = isset( $parte1[1] )? $parte1[1] : $tabla;

		$parte2 = explode( '_', $tabla_sola );
		array_shift( $parte2 );

		$prefijo_tabla = substr( $parte2[0], 0, 2);
		if ( count( $parte2 ) > 1 ){
			$prefijo_tabla  = substr( $parte2[0], 0, 1);
			$prefijo_tabla .= substr( $parte2[1], 0, 1);
		}
		$autocodigo = strtoupper( $prefijo_tabla ) . formato_ceros( $id, 4 );
		$salida = $autocodigo;

		return $salida;
	}
}

if( ! function_exists( 'fecha_hora_local' ) ){
	function fecha_hora_local( $formato = "" ){
		$salida = gmdate ("U") - ( 4.5 * 3600 ); // Para fecha hora de venezuela .... GMT -4:30
		if ( $formato != "" ){
			$salida = date( $formato, $salida );
		}
		return $salida;
	}
}

if( ! function_exists( 'html_sangria' ) ){
	function html_sangria( $espacio = "50px" ){
		return "<span class='br-espacio-fijo seguido' style='width:".$espacio." '>&nbsp;</span>\n";		
	}
}
