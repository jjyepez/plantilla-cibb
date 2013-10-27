<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//# @helper Componentes-OSTI 1.0.1b - Sep 2013
/**
 * Componentes-OSTI 1.0.1b - Sep 2013
 * Helper con los componentes html para la plantilla-osti 1.0.1b
 * 
 * @author jjyepez <jyepez@inn.gob.ve>
 *
 * @package componentes-osti
 * @version 1.0.1b
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/deed.es
 * 
 */

if( ! function_exists('html_input')) {

	function html_input ( $id, $tipo_elemento = "texto", $parametros = array() ) {
		//# @descripcion Componente que genera una salida HTML normalizada de diversos elementos tipo <INPUT>
		//# @parametro string $id El ID que se le asignará al elemento <INPUT> resultante
		//# @parametro string $tipo_elemento El tipo de elemento que generará el componente. Puede ser uno de los siguientes: >>//
			#   texto ... text
			#
			#   texto_funcion_especial ... texto_funciones_especiales ... combo
			#
			#   contador
			#
			#   contraseña ... clave ... password
			#
			#   fecha ... date
			#
			#   calendario
			#
			#   lista ... select
			#
			#   opcionmultiple
			#
			#   archivo ... file ... subirarchivo ... subir_archivo
			#
			#   imagen ... image ... img
			#
			#   texto_largo ... memo ... textolargo ... textarea
			#
			#   texto_enriquecido ... editor_html ... texto_wysiwyg ... wysiwyg
			#
			#   buleano ... boolean ... checkbox
			#
			#   oculto ... escondido ... hidden
			#<br>
		//<<<
		//# @nota El valor debe ser mayor que 0
		//# @parametro array $parametros Los diferentes parámetros que se esperan y sus valores por omisión >>//
			$solo_lectura         = FALSE;
			$editable             = TRUE;
			$etiqueta             = "";
			$etiqueta_con_for     = TRUE;
			$valor_inicial        = "";
			$clases               = "";
			$estilos              = "";
			$estilos_solo_lectura = "";
			$parametros_html      = "";
			$clases_adicionales   = "ancho-150";
			$texto_inicial        = "";
			$valor_inicial        = "";
			$info_ayuda           = "";
			$enlace_ENTER         = '';
			$items                =  array( "0" => "seleccione" ); // para compontes tipo lista o de opciones multiples ... jjy
		//<<<
		//se extraen las variables pasadas por parámetros .. ns
			extract($parametros);
		//se inicializan las variables .. ns
			$html_salida	      = "";
		//-----------------------------------------

		if ( $enlace_ENTER != "" ){
			$parametros_html .= ' onenter = "'.$enlace_ENTER.'" ';
		}
		if ( $solo_lectura ){
			$parametros_html    .= ' readonly = "readonly" ';
		}

		if (  $editable === FALSE 
			    && ! in_array( $tipo_elemento, 
							array( 
							 	'opcionmultiple', 
							 	'opciones_multiples', 
							 	'seleccionmultiple', 
							 	'checkbox', 
							 	'buleano', 
							 	'boolean' 
							) 
						) 
		) { 
			// si no es editabe y no es un checkbox! .... o sus derivados ! ... OJO verificar con radiobuttons! ... jjy
			$clases        = "solo_lectura";
			if(trim($estilos_solo_lectura)!=''){ $estilos = $estilos_solo_lectura; }
			$valor_inicial = ( trim ($valor_inicial) == "" )? "&nbsp;" : $valor_inicial;
			$html_salida   = "<div class='$clases $clases_adicionales' style='$estilos' $parametros_html >$valor_inicial</div><input id='$id' name='$id' type='hidden' value='$valor_inicial'>";

		} else {

			switch ($tipo_elemento) {
				case "texto":
				case "text":
					$html_salida = "<input id='$id' name='$id' type='text' class='$clases $clases_adicionales' style='$estilos' value='$valor_inicial' $parametros_html >";
					break;
				case "texto_funcion_especial":
				case "texto_funciones_especiales":
				case "combo":
					$n_fd = 0;
					$n_fi = 0;
					$html_funciones = "";
					foreach ( $funciones_especiales as $detalle_funcion ){
						$clase_icono_accion = "icono-accion-derecha";
						$id_funcion    = $detalle_funcion [0];
						$icono_funcion = $detalle_funcion [1];
						$enlace="";
						if ( isset( $detalle_funcion [2] ) ) { 
							extract ( $detalle_funcion [2] ); 
						}
						if ( $clase_icono_accion == "icono-accion-izquierda" ) {
							$margen_izquierdo = ( $n_fi * 20 ) . 'px';
							$n_fi++;
						} else {
							$margen_derecho = ( $n_fd * 20 ) . 'px';
							$n_fd++;
						}
						if ( trim( $enlace ) != "" ) { $html_funciones .= "<a id = '".$id_funcion."' name = '".$id_funcion."' href='$enlace' >"; }
						$html_funciones .= "<i class='".$icono_funcion." $clase_icono_accion' ";
						if ( $clase_icono_accion == "icono-accion-izquierda" &&  $n_fi > 0) {
							$html_funciones .= " style='margin-left: ".$margen_izquierdo."' ";
						} else if ( $clase_icono_accion == "icono-accion-derecha" &&  $n_fd > 0) {
							$html_funciones .= " style='margin-right: ".$margen_derecho."' ";
						}
						$html_funciones .= "></i>";

						if ( trim( $enlace ) != "" ) { $html_funciones .= "</a>"; }
						$html_funciones .= "\n";
					}
					$padding_derecho   = 4 + ( $n_fd * 20 ) . 'px';
					$padding_izquierdo = 4 + ( $n_fi * 20 ) . 'px';
					$estilos     .= " padding-right: " . $padding_derecho ."; ";
					$estilos     .= " padding-left: " . $padding_izquierdo . "; ";
					$html_salida  = "<div class='contenedor-input'>"
											 . "<input id='$id' name='$id' type='text' class='$clases $clases_adicionales' style='$estilos' value='$valor_inicial' $parametros_html >";
					$html_salida .= $html_funciones;
					$html_salida .= "</div>";
					break;
				case "contador":
					if(! isset($enlace_incrementar) )	$enlace_incrementar = "javascript:void(0)";
					if(! isset($enlace_disminuir) ) $enlace_disminuir     = "javascript:void(0)";
					$estilos .= "padding-right: 18px;";
					$html_funciones = "<div class='icono-accion-derecha contenedor-micro-iconos'>
																<a class='micro-boton-arriba' href='$enlace_incrementar' onclick='javascript:incrementar_contador( $(this), \"$id\" )'><i class='icon-chevron-up'></i></a><br>
																<a class='micro-boton-abajo' href='$enlace_disminuir' onclick='javascript:disminuir_contador( $(this), \"$id\" )'><i class='icon-chevron-down'></i></a></div>";
					$html_salida = "<div class='contenedor-input'>"
								 . "<input id='$id' name='$id' type='text' class='$clases $clases_adicionales' style='$estilos' value='$valor_inicial' $parametros_html >";
					$html_salida .= $html_funciones;
					$html_salida .= "</div>";
					break;
				case "contraseña":
				case "clave":
				case "password":
					$html_salida = "<input id='$id' name='$id' type='password' class='$clases' style='$estilos' value='$valor_inicial' $parametros_html >";
					break;
				case "fecha":
				case "date":
						$parametros['parametros_html'] = "placeholder='Día' maxlength='2'";
						$parametros['estilos'] = 'width:30px !important;margin-right:7px;';
					$html_salida =html_input($id.'_dia','texto',$parametros);
						$meses=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre",);
						$parametros['items']=$meses;
						$parametros['texto_inicial'] = "Mes ...";
						$parametros['estilos'] = 'width:100px !important;padding:2px;margin-right:7px;';
						$parametros['parametros_html'] = "placeholder='Mes'";
					$html_salida.=html_input($id.'_mes','lista',$parametros);
						$parametros['texto_inicial'] = "";
						$parametros['estilos'] = 'width:45px !important;';
						$parametros['parametros_html'] = "placeholder='Año' maxlength='4'";
					$html_salida.=html_input($id.'_ano','texto',$parametros);
					break;
				case "calendario":
					$parametros = array(
						'estilos'	=> $estilos,
						'editable'										=> $editable,
						'parametros_html'             => "placeholder = 'dd/mm/aaaa' $parametros_html ",
						'funciones_especiales'        => array(
								array( 'accion_' . $id, 'icon-calendar', array( 'enlace' => 'javascript:alert("calendario");' ) ),
							),
						);
					$html_salida = html_input( $id, 'texto_funcion_especial', $parametros );
					break;
				case "lista":
				case "select":
					$html_salida = "<select id='$id' name='$id' class='$clases $clases_adicionales' style='$estilos' $parametros_html >\n";
					if( trim( $valor_inicial ) === ""&& trim( $texto_inicial ) !== "" ) $valor_inicial = $texto_inicial;
					$html_salida.="<option value='"
						.(($valor_inicial!=="")?$valor_inicial:"")
						."'>";
					$html_salida.=(($texto_inicial!=="")?$texto_inicial:"");
					$html_salida.="</option>\n";
					foreach($items as $valor=>$texto){
						if(trim($valor)===""&&$texto=="") $valor=$texto;
						$html_salida.="\t<option value='$valor'>";
						$html_salida.=$texto;
						$html_salida.="</option>\n";
					}
					$html_salida.="</select>";
					break;
				case "opcionmultiple":
				case "seleccionmultiple":
				case "opciones_multiples":
					if ( ! isset( $parametros['clases_adicionales']) ) { $clases_adicionales = ''; }
					$clases .= " alinear-medio ";
					$html_salida="<div class='$clases '>\n";
					$i=0;
					foreach($items as $valor=>$texto){
						$i++;	
						$clases_adicionales = str_replace ('{@i}', $i, $clases_adicionales );

						if(trim($valor)==="") $valor=$texto;
						$html_salida.="<label style='vertical-align:top;white-space:nowrap;'>"
									 			."<input class='$clases $clases_adicionales' id='$id' name='$id' type='checkbox' value='$valor' style='margin:0px;margin-right:5px;' ";
						if ( isset( $valor_inicial[$valor] ) ) { $html_salida.= $valor_inicial[$valor]; } //CLEVER!!!!!! jjy
						if ( ! $editable ) { $html_salida.= ' readonly="readonly" disabled '; }
						$html_salida.= " >";
						$parametros['estilos'] = 'padding:0;vertical-align:top;margin-right: 7px;';
						$html_salida.=html_etiqueta($texto,'',$parametros).'</label>';
					}
					$html_salida.="</div>";
					break;
				case "opcionsimple":
				case "seleccionsimple":
				case "opciones_simples":
					//$parametros['clases'] = "";
					if ( ! isset( $parametros['clases_adicionales']) ) { $clases_adicionales = ''; }
					$clases .= " alinear-medio ";
					$html_salida="<div class='$clases'>\n";
					foreach($items as $valor=>$texto){
						if(trim($valor)==="") $valor=$texto;
						$html_salida.="<label style='vertical-align:top;white-space:nowrap;'>"
									 			."<input id='$id' name='$id' type='radio' value='$valor' style='margin:0px;margin-right:5px;' $parametros_html >";
						$parametros['estilos'] = 'padding:0;vertical-align:top;margin-right: 7px;';
						$html_salida.=html_etiqueta($texto,'',$parametros).'</label>';
					}
					$html_salida.="</div>";
					break;
				case "archivo":
				case "file":
				case "subirarchivo":
				case "subir_archivo":
					$html_salida="<input id='$id' name='$id' type='file' class='$clases' style='$estilos' $parametros_html >";
					break;
				case "imagen":
				case "image":
				case "img":
					$html_salida="<img src='$url_imagen' id='$id' name='$id' class='$clases' style='$estilos' $parametros_html >";
					break;
				case "texto_largo":
				case "memo":
				case "textolargo":
				case "textarea":
					$html_salida="<textarea id='$id' name='$id' type='password' class='$clases' style='$estilos' $parametros_html >$valor_inicial</textarea>";
					break;
				case "texto_enriquecido":
				case "editor_html":
				case "texto_wysiwyg":
				case "wysiwyg":
					if ( ! isset( $parametros['clases_adicionales']) ) { $clases_adicionales = ''; }
					//requiere!!! $html_includes = '<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>';
					$html_salida   = "<script>tinymce.init({selector:'#$id'});</script>";
					$html_salida  .= "<textarea id='$id' name='$id' type='password' class='$clases $clases_adicionales' style='$estilos' $parametros_html >$valor_inicial</textarea>";
					break;
				case "buleano":
				case "boolean":
				case "checkbox":
					if ( ! isset( $parametros['clases_adicionales']) ) { $clases_adicionales = ''; }
					$html_salida="<input id='$id' name='$id' type='checkbox' class='$clases $clases_adicionales' style='$estilos' value='$valor_inicial' $parametros_html ";
					if ( ! $editable ) { $html_salida.= ' readonly="readonly" disabled '; }
					$html_salida.=">";
					$tipo_elemento = 'checkbox';
					break;
				case "oculto":
				case "escondido":
				case "hidden":
					$html_salida="<input id='$id' name='$id' type='hidden' class='oculto $clases' style='$estilos' value='$valor_inicial' $parametros_html >";
					break;
				default:
					$clases="";
					$html_salida="<input id='$id' name='$id' type='$tipo_elemento' class='$clases' style='$estilos' $parametros_html >";
					break;
			}
		} // fin if de editable

		if ( trim( $etiqueta != "" ) ){
			$parametros = array();
			if ( isset( $clases_adicionales_etiqueta ) ) {
				$parametros = array( 'clases_adicionales' => $clases_adicionales_etiqueta );
			}
			$id_for = ( $etiqueta_con_for == TRUE ) ? $id : '';
			if( $tipo_elemento != 'checkbox' ) {
				$html_salida = html_etiqueta( $etiqueta, $id_for, $parametros ) . $html_salida;
			} else {
				$html_salida .= ' '.html_etiqueta( $etiqueta, $id_for, $parametros );
			}
		}
		if ( trim( $info_ayuda != "" ) ){
			$parametros   = array();
			$html_salida .= "&nbsp;&nbsp;<i title='$info_ayuda' class='icon-question-sign icono-info-ayuda'></i>";
		}
		return $html_salida." \n ";
		/*# @ejemplo
				<?php
					$parametros = array(
						'clases'  => 'negrita',
						'estilos' => 'color:red;',
					);
				?>
				<?=html_etiqueta( 'Campo:', 'id_campo', $parametros )?>
		#*/
		/*# @salida
				<label for='id_campo' class='negrita' style='color:red;'>Campo:</label>
		#*/

	}
}

if( ! function_exists('html_etiqueta')) {

	function html_etiqueta ( $texto = "", $for = "", $parametros = array() ) {
		/** 
		 * @author jjyepez <jyepez@inn.gob.ve>
		 */
		//# @descripcion Genera el código en HTML para una etiqueta
		//# @parametro string $texto Texto de la etiqueta
		//# @parametro string $for ID del componente html_input asociado
		//# @parametro array $parametros Los diferentes parámetros que se esperan y sus valores por omisión >>//
		$clases             = ""; // puede ser cualquier clase o conjunto de clases validas 
		$estilos            = "";
		$id                 = "";
		$clases_adicionales = "";  
		//<<
		// se extraen las variables pasadas por parámetros .. ns
		extract($parametros);
		//se inicializan las variables .. ns
		$html_salida				= "";
		//-----------------------------------------//

		$html_salida = "<label id='$id' name='$id' for='$for' class='$clases $clases_adicionales' style='$estilos'>$texto</label>";

		return $html_salida;
		/*# @ejemplo
				<?php
					$parametros = array(
						'clases'  => 'negrita',
						'estilos' => 'color:red;',
					);
				?>
				<?=html_etiqueta( 'Campo:', 'id_campo', $parametros )?>
		#*/
		/*# @salida
				<label for='id_campo' class='negrita' style='color:red;'>Campo:</label>
		#*/
	}
}

if ( ! function_exists( 'html_lista_datos' ) ){
	/**
	*	Esta función crea una lista-grid simple basada en html
	*/
	function html_lista_datos ( $id, $arreglo_datos, $parametros=array() ) {
		/// atencion ..... debe normalizarse esta funcion para extraer los parametros !!!!!! ..... jjy 
		$mostrar_paginacion = FALSE; // aun en etapa muy experimiental .... no usar!! ... jjy
		$mostrar_acciones   = TRUE; 
		$icono_puntero = '';
		$columnas = array();
		$enlace_mostrar  = 'javascript:alert("mostrar")';
		$enlace_imprimir = 'javascript:alert("imprimir")';
		$enlace_editar   = 'javascript:alert("editar")';
		$enlace_eliminar = 'javascript:alert("eliminar")';

		extract( $parametros );

		//se hace una conversion del arreglo por si viene como obj_result de postgres .. jjy
		if( ! is_array( $arreglo_datos ) ) $arreglo_datos = ( array ) $arreglo_datos;

		$html_salida ="";
		$html_salida = "<table id='$id' name='$id' class='html-lista'>";

		$n_registros = count( $arreglo_datos );
		$fila        = 0;
		$n_campos    = 0;

		if ( count( $columnas ) == 0 && count( $arreglo_datos ) > 0 ) {
			if ( count ( $arreglo_datos ) == 0 ) {
				$columnas = array('error' => 'No se hasn definido columnas a mostrar y el arreglo de datos está vacío');
			} else {
				//prp($arreglo_datos,1);
				foreach ( $arreglo_datos[0] as $campo => $valor ) {
					$columnas[$campo] = ucwords( str_replace( '_', ' ', $campo ) );
				}
			}
		}
		
		$html_salida.= "<tr class='cabecera_lista'>\n";
		$html_salida.= "<th class='columna-apuntador-lista'></th>\n";

		// se espera que en el arreglo $columnas venga cada nombre de campo de la tabla con su título asociado
		foreach( $columnas as $campo => $titulo ){

			$mostrar_col[$campo] = $titulo;

			//se muestran las cabeceras de las columnas .. jjy
			//sólo la primera vez
			$n_campos++;
			if(isset($mostrar_col[$campo])) {
				$titulo=$mostrar_col[$campo];
				$html_salida.= "<th";
				if ( $n_campos == 1 ) $html_salida .= " class = 'alinear-izquierda' ";
				$html_salida.=">".$titulo."</th>";
			}
		}
		if ( $mostrar_acciones === TRUE ){ // iconos de accion ....  jjy
			$html_salida .= "<td class='columna-acciones alinear-abajo'>";
									 //.  "<div class='flotado-derecha'>";
			$html_salida .= "</td>\n";
		}
		/* 
		******** OJO ...... ESTA PAGINACION MEJOR DEBERIA HACERSE EN UNA FILA AL FINAL DE LA LISTA .... EVALUAR .... jjy
		**
		if( $mostrar_paginacion === TRUE ){
			$html_salida .= html_paginacion();
		}*/					 

		$html_salida .= "<td class='invisible'></td>\n";
		$html_salida .= "</tr>\n";

		$html="";
		$mensaje="";
		$tipo_mensaje="";

		if( $n_registros > 0 ){

			foreach( $arreglo_datos as $reg ){ 
				/**
				AQUI INICIA EL RECORRIDO DE LOS REGISTROS PARA MOSTRAR LAS FILAS ........ jjy *** 
				**/
				$fila++;
				$id_registro = $fila;
				if ( isset( $reg['id'] ) ){
					$id_registro = $reg['id'];
				}

				$par_o_impar=(($fila%2)==0)?'par':'impar';
				$html_campos_hidden="";
				$html_salida.= "<tr class='fila-registro' rel='".$id_registro."'>";

				$n_campo = 0;
				$html_acciones = "";
				if ( $mostrar_acciones === TRUE ) {

					$enlace_accion['mostrar']  = $enlace_mostrar; // se reinician al valor original en cada vuelta de registro ... jjy
					$enlace_accion['eliminar'] = $enlace_eliminar;
					$enlace_accion['imprimir'] = $enlace_imprimir;
					$enlace_accion['editar']   = $enlace_editar;

					foreach( $reg as $campo_aux => $valor_aux ){
						$enlace_accion['mostrar']  = str_replace('{@'.$campo_aux.'}', $valor_aux, $enlace_accion['mostrar']);
						$enlace_accion['eliminar'] = str_replace('{@'.$campo_aux.'}', $valor_aux, $enlace_accion['eliminar']);
						$enlace_accion['imprimir'] = str_replace('{@'.$campo_aux.'}', $valor_aux, $enlace_accion['imprimir']);
						$enlace_accion['editar']   = str_replace('{@'.$campo_aux.'}', $valor_aux, $enlace_accion['editar']);
					}

					$html_acciones = "
						<td class='contenedor-iconos-accion ancho-60'>
					  <span class='contenedor-input'>&nbsp;";
					$p = 0;
					if ( array_search( 'imprimir', $iconos_accion ) != "" ) { $html_acciones .= "<a title='Imprimir este registro' id='icono_imprimir' 	name='icono_imprimir' href='".$enlace_accion['imprimir']."'><i style='left: {$p}px;' 	class='icono-accion-izquierda icon-print'></i></a>"; $p+=20;}
					if ( array_search( 'editar', $iconos_accion ) != "" ) {   $html_acciones .= "<a title='Editar' id='icono_editar' 		name='icono_editar' 	href='".$enlace_accion['editar']."'><i style='left: {$p}px;' class='icono-accion-izquierda icon-pencil'></i></a>"; $p+=20;}
					if ( array_search( 'eliminar', $iconos_accion ) != "" ) { $html_acciones .= "<a title='Eliminar' id='icono_eliminar' 	name='icono_eliminar' href='".$enlace_accion['eliminar']."'><i 	style='left: {$p}px;' class='icono-accion-izquierda icon-remove'></i></a>"; $p+=20;}
					
					$html_acciones .= "</span>\n</td>\n";
				}
				$html_salida .= "
					<td style='width:24px;' class='contenedor-iconos-accion'>
						<span class='contenedor-input'>&nbsp;";
							
				if ( $mostrar_acciones === TRUE ) { $html_salida .= "<a id='icono_mostrar' name='icono_mostrar' href='".$enlace_accion['mostrar']."'>"; }

				if ( trim($icono_puntero) != "" ){
					$html_salida .= "<img class='puntero_lista' src='".base_url()."/imgs/$icono_puntero'/>";
				} else {
					$html_salida .= "<i style='left: 0px;' class='icono-accion-izquierda icon-caret-right'></i>";
				}

				if ( $mostrar_acciones === TRUE ) { $html_salida .= "</a>"; }

				$html_salida .= "</span>\n</td>";

				/*
				!!!!! A PARITR DE ACA SE RECORREN UNO A UNO TODOS LOS CAMPOS=>VALORES DE CADA REGISTRO PARA ARMAR LAS COLUMNAS !!!! ... jjy
				*/
				foreach( $reg as $campo=>$valor ){

					if ( isset( $mostrar_col[$campo] ) ) {
						$n_campo++;

						$html_salida .= "\n<td ";
						if ( $mostrar_acciones === TRUE ) {
							$html_salida .= "onclick='javascript:document.location.href=\"".$enlace_accion['mostrar']."\";' ";
						}
						if ( $n_campo != 1 ) {
							$html_salida .= " class='alinear-centro' ";
						}
						$html_salida .= ">";
						if ( isset ( $campos[$campo] ) ) { //si viene con formato ... jjy
							$valor = str_replace( '{@valor}', $valor, $campos[$campo] );
						}
						$html_salida.= $valor;
						$html_salida.= "</td>";
					} else {
						$html_campos_hidden .= "<input id='{$campo}[]' name='{$campo}[]' type='hidden' class='ancho-full' value='{$valor}' rel='$fila' />\n";
					}
				}
				
				$html_campos_hidden.="<input id='nf' name='nf' type='hidden' rel='$fila'/>";
				$html_salida.= '<td class="invisible">'.$html_campos_hidden.'</td>';
				$html_salida.= $html_acciones;
				$html_salida.= "</tr>\n";
			}

		} else {

			$mensaje="La tabla está vacía actualmente.";
			$tipo_mensaje="advertencia";
			
		}
		$reg=array();
		if(isset($parametros['campos'])){
			foreach($parametros['campos'] as $campo=>$formato){
				if( !is_integer($campo) ) {
					$reg[$campo] = "";
				} else {
					$reg[$formato] = "";
				}
			}
		}
		if ( isset( $parametros['codigo_tabla'] ) ) {
			$reg['codigo_tabla']=$parametros['codigo_tabla'];
		}

		//se muestran una fila vacía al final para un nuevo registro .. jjy
		$html="";
		$html_salida.= "</table>\n";
		$html_salida.= $html;
		$html_salida.=html_mensaje('',$mensaje,$tipo_mensaje);

		$enlace_mostrar = "#"; $enlace_imprimir = "#"; $enlace_editar = "#"; $enlace_eliminar = "#";
		if ( isset ( $parametros['enlace_mostrar_registro'] ) ){ $enlace_mostrar = $parametros['enlace_mostrar_registro']; }
		if ( isset ( $parametros['enlace_imprimir_registro'] ) ){ $enlace_imprimir = $parametros['enlace_imprimir_registro']; }		
		if ( isset ( $parametros['enlace_editar_registro'] ) ){ $enlace_editar = $parametros['enlace_editar_registro']; }		
		if ( isset ( $parametros['enlace_eliminar_registro'] ) ){ $enlace_eliminar = $parametros['enlace_eliminar_registro']; }		
		$script = "
			<script>
				$(document).ready(function(){
					$('tr.fila-registro .contenedor-input').hide();
					$('tr.fila-registro').mouseover( function(){ $(this).find('.contenedor-input').show(); });
					$('tr.fila-registro').mouseout ( function(){ $(this).find('.contenedor-input').hide(); });
				});
			</script>";
		$html_salida.=$script;

		return $html_salida;
	}

}

if( ! function_exists( 'html_formulario_ini' ) ) {
	function html_formulario_ini( $id, $parametros = array() ){
		//# @descripcion Componente que genera una salida HTML normalizada de diversos elementos tipo <INPUT>
		//# @parametro string $id El ID que se le asignará al elemento <INPUT> resultante
		//# @parametro array $parametros Los diferentes parámetros que se esperan y sus valores por omisión >>//
			$destino        = '_self';
			$accion         = '';
			$enlace         = '';
			$metodo         = 'POST';
			$enctype        = '';
			$tabla_asociada = '';
		//<<<
		extract( $parametros );

		if ( trim( $enlace ) != "" && trim( $accion ) == "" ) $accion = $enlace;
		if ( trim( $accion ) != "" && trim( $enlace ) == "" ) $enlace = $accion;
		$html_salida = "<form "
				. " class = 'formulario' "
				. " id = '$id' name='$id' "
				. " target = '$destino' "
				. " action = '$enlace' "
				. " method = '$metodo' "
				. " enctype = '$enctype' "
				. ">\n";
		$html_salida .= html_input( 'tabla_asociada', 'oculto', array( 'valor_inicial' => $tabla_asociada ) );
		return $html_salida;
	}
}

if( ! function_exists( 'html_formulario_fin' ) ) {
	function html_formulario_fin( $parametros = array() ){
		$html_salida = "";
		$html_salida .= "</form>\n";
		return $html_salida;
	}
}
if ( ! function_exists( 'html_br' ) ) {
	function html_br ( $espacio_vertical = '5px' ) {
		return "<hr class='br-espacio-fijo sin-margenes' style='height:".$espacio_vertical." '>\n";
	}
}

if( ! function_exists('extraer_info_tabla')) {

	function extraer_info_tabla($tabla="",$parametros=array()) {

		//se instancia la clase Controller para poder extraer datos de la bd .. ns!
		$CI = & get_instance();
		//se inicializan variables .. ns
        $data_salida=array();
        //se extrae la informacion sobre los campos de la tabla .. ns
        if( ! table_exists($tabla)){
			$data_salida['campos']	=array();
        } else {
			$campos_arr            =$CI->db->field_data($tabla);	
			$data_salida['campos'] =$campos_arr;
	    }
	    //se cierra la conexion .. ns
        $CI->db->close();
        return $data_salida;
	}

	//version extendida basada n la tabla information_schema.columns de postgres .. ns
	function extraer_info_tabla_ext($tabla="",$parametros=array()) {

		//se instancia la clase Controller para poder extraer datos de la bd .. ns!
		$CI = & get_instance();
		//se inicializan variables .. ns
        $data_salida=array();
        //se extrae la informacion sobre los campos de la tabla .. ns
        $info_tabla=explode('.',$tabla);
        $CI->db->from('information_schema.columns');
        $esquema="public"; //por defecto .. ns
        if(isset($info_tabla[1])) {
        	$esquema=$info_tabla[0];
        	$tabla 	=$info_tabla[1];
        } else {
        	$tabla 	=$info_tabla[0];
        }
		$CI->db->where('table_schema',$esquema);
        $CI->db->where('table_name',$tabla);
        $CI->db->order_by('ordinal_position ASC');

        $rs=$CI->db->get();
        $campos_arr=$rs->result_array();
	        $data_salida['campos']  =$campos_arr;
        
	    //se cierra la conexion .. ns
        $CI->db->close();
        return $data_salida;
	}
}

if( ! function_exists('html_lista_segun_tabla')) {

	function html_lista_segun_tabla($id, $parametros=array()){ 

		//se instancia la clase Controller para poder extraer datos de la bd .. ns!
		$CI = & get_instance();
		//se inicializan variables .. ns
        $html_salida="";
		//Parámetros esperados ... jjy
		$clases="";
		$estilos="";
		$texto_por_defecto="-- Seleccione --";
		$valor_por_defecto="0";
		$texto_seleccionado="";
		$valor_seleccionado="";
		$datos['campos']=array();
		$datos['datos']=array();
		// los parametros correctos remplazaran a los inicializados en "" .. jjy
		extract($parametros);
		//
		valores_lista_segun_tabla($parametros);

        $html_salida="<select class='$clases' style='$estilos' id='$id' name='$id'>\n";
        	if($texto_por_defecto!=""){
		        $html_sub1="<option value='$valor_por_defecto' ";
		        if($valor_por_defecto==$valor_seleccionado){
		        	$html_sub1.=" selected='selected' ";
		        }
		        $html_sub2=">$texto_por_defecto</option>";
		        $html_salida.=$html_sub1.$html_sub2;
		    }

        foreach ($datos['datos'] as $reg) {
			foreach($reg as $campo=>$valor){
                if($campo==$campo_lista_valor){
                    $html_sub1="<option value='$valor' ";
					if($valor_seleccionado!="" && $valor==$valor_seleccionado){
			        	$html_sub1.=" selected='selected' ";
			        }
                }
		         //|| ($texto_seleccionado!="" && $valor==$texto_seleccionado))
                if($campo==$campo_lista_texto){
                	if($texto_seleccionado!="" && $valor==$texto_seleccionado){
		        		$html_sub1.=" selected='selected' ";
		        	}
                    $html_sub2=">$valor</option>\n";
                }
            }
            $html_salida.=$html_sub1.$html_sub2;
        }
        $html_salida.="</select>\n";

        return $html_salida;
	}
}

if( ! function_exists('valores_lista_segun_tabla')) {

	function valores_lista_segun_tabla ($tabla,$parametros=array()){

		//se instancia la clase controller! .. ns
		$CI = & get_instance();
        //parametros esperados ... jjy
        $texto_por_defecto  ="";
        $valor_por_defecto  ="";
        $valor_seleccionado ="";
        $tabla_origen       =$tabla;
        $condicion_filtro   ="";
        $orden_salida       ="";
        $consulta_sql_origen="";
        $campo_lista_valor  ="id_o_codigo"; //pasar valor correcto .. ns
        $campo_lista_texto  ="descripcion"; //pasar valor correcto .. ns
        //se extraen los parámetros .. ns
        extract($parametros);
        //se prepara la extracción de los datos .. ns
        $CI->db->select($campo_lista_valor.','.$campo_lista_texto);
        $CI->db->from($tabla_origen);
        if(isset($condicion_filtro)&&$condicion_filtro!="") $CI->db->where($condicion_filtro);
        if(isset($orden_salida)&&$orden_salida!="") $CI->db->order_by($orden_salida);
        $rs = $CI->db->get();
        //
        $resultado['campos']=$rs->list_fields();
        $resultado['datos']=$rs->result();
        //
        $CI->db->close();
        return $resultado;
    }
}

if ( ! function_exists( 'html_campo_celda_con_etiqueta' ) ) {

	function html_campo_celda_con_etiqueta($id = '', $parametros = array()){

		$tipo 	  = "texto";
		$etiqueta = "etiqueta";
		$placeholder = '';
		extract($parametros);
		$salida = '';
		$salida = '<table width="100%"><tr>'
					.'<td><label style="white-space:nowrap;" for="'.$id.'">'.$etiqueta.'</label></td>'
					.'<td width="100%">';
		switch ($tipo){
			case "fecha":
				if ( $placeholder == '' ) $placeholder = 'dd/mm/aaaa';
				$html_campo = '<input placeholder="'.$placeholder.'" type="text" style="width:100%" id="'.$id.'" name="'.$id.'"/>';
			break;

			case "list-a_radios":
				//print_r($parametros);
				$html_campo = '<select>';
				foreach ($valores as $id => $datos) {
					//$html_campo .= '<input id="'.$id.'" name="'.$id.'" type="radio" value="'.$datos[1].'"><label for="'.$id.'">'.$datos[0]."</label>\n";
					$html_campo .= '<option value="'.$datos[1].'">'.$datos[0]."</option>\n";
				}
				$html_campo .= "</select>\n";
				//$html_campo = '<input placeholder="'.$placeholder.'" type="text" style="width:100%" id="'.$id.'" name="'.$id.'"/>';
			break;

			case "texto":
			default:
				$html_campo = '<input placeholder="'.$placeholder.'"" type="text" style="width:100%" id="'.$id.'" name="'.$id.'"/>';
			break;
		}
		$salida .= $html_campo;
		$salida .= '</td>'
				  .'</tr></table>';
		return $salida;

	}

}

if ( ! function_exists( 'html_tabla_formulario' ) ) {

	function html_tabla_formulario( $id = '', $parametros = array() ){

		extract( $parametros );
		$salida = '';

		$salida .= "<div id='$id' name '$id'>\n";
		$salida .= "<table width='100%'>\n";
		
		foreach ($filas as $fila) {
			$salida .= "<tr>\n";

			foreach ( $fila as $indice => $contenido ) {

				$tipo = 'texto';
				if ( is_array( $contenido ) && $indice != '_titulo' && $indice != '_span') {
					$tipo = $contenido [1];
					$contenido = $contenido [0];
				}

				switch ( $indice ) {
					case '_titulo': 
						$salida .= '<th ';
						if (isset ( $contenido['_span'] ) ) {
							$salida .= 'colspan="'.$contenido['_span'].'"';
						}
						$salida .= '>'.$contenido['_texto']."</th>\n";
					break;

					case '_span':
						$salida .= '<td ';
						foreach ( $contenido as $sub_indice => $sub_contenido ) {

							switch ( $sub_indice ) {
								case '_columnas':
									$salida .= 'colspan="'.$sub_contenido.'">';
									break;
								
								default:

									if ( is_array( $sub_contenido ) ) {

										$valores = array();
										
										$etiqueta = $sub_contenido[0];
										$tipo = $sub_contenido[1];
										if ( isset( $sub_contenido [2] ) ){
											$valores = $sub_contenido [2];
										}

										$sub_parametros = array( 'id'       => $indice,
																 'tipo' 	=> $tipo,
																 'etiqueta' => $etiqueta,
																 'valores'	=> $valores,
															); 
										$salida .= html_campo_celda_con_etiqueta( '', $sub_parametros );

									} else {

										$salida .= '<span>';
										$sub_parametros = array( 'id'       => $sub_indice,
																 'tipo' 	=> $tipo,
																 'etiqueta' => $sub_contenido ); 
										$salida .= html_campo_celda_con_etiqueta( '', $sub_parametros );
										$salida .= '</span>';
									}
									break;
							}
						}
						$salida .= "</td>\n";
					break;

					default:
					
						$salida .= '<td>';
						if ( is_array( $contenido ) ) {

							$etiqueta = $contenido[0];
							$tipo = $contenido[1];
							$valores = $contenido [2];

							$sub_parametros = array( 'id'       => $indice,
													 'tipo' 	=> $tipo,
													 'etiqueta' => $etiqueta,
													 'valores'	=> $valores,
												); 
							$salida .= html_campo_celda_con_etiqueta( '', $sub_parametros );

						} else {

							$sub_parametros = array( 'id'       => $indice,
													 'tipo' 	=> $tipo,
													 'etiqueta' => $contenido ); 
							$salida .= html_campo_celda_con_etiqueta( '', $sub_parametros );
						}
						$salida .= "</td>\n";
					break;
				}
			}
			$salida .= "</tr>\n";
		}
		$salida .= "</table>\n";
		$salida .= "</div>\n";
		
//		echo "<pre>", print_r($parametros);

		return $salida;
	}

}

if ( ! function_exists( 'html_enlace' ) ) {

	function html_enlace ($enlace = 'javascript:void(0);', $parametros = array() ) {
		$id               = '';
		$texto            = $enlace;
		$destino          = '_self';
		$tooltip          = '';
		$clase            = '';
		$clase_adicional  = '';
		$estilo_adicional ='';

		extract( $parametros );

		$html_salida = "";

		$html_salida  .= ""
									.  "<a id = '$id' name = '$id' "
									.  "	 href = '$enlace' "
									.  "	 target = '$destino' "
									.  "	 title = '$tooltip' "
									.  "	 class = '$clase $clase_adicional' "
									.  "	 style = '$estilo_adicional'>"
									.  $texto
									.  "</a>\n";

		return $html_salida;
	}
}

if ( ! function_exists( 'html_enlace_boton' ) ) {

	function html_enlace_boton ($id = '', $parametros = array() ) {
		$clase_iconos           = 'glyphicons';
		$descripcion            = '';
		$tipo                   = 'boton_icono';
		$icono                  = '';
		$enlace                 = "javascript:alert('definir enlace');";
		$destino                = '_self';
		$posicion_icono         = '';
		$tooltip                = '';
		$clase                  = '';
		$clase_adicional        = '';
		$clase_adicional_icono  = 'icon-large';
		$estilo_adicional       ='';
		$estilo_adicional_icono ='';
		$alinear_icono          = "";

		extract( $parametros );

		if ( trim( $tooltip == '' && trim ( $descripcion ) != '' ) ) $tooltip = $descripcion;
		if ( trim( $tooltip == '' ) ) $tooltip = $enlace;

		if ( trim( $posicion_icono !== '') ) {
			$coordenadas        = explode(' ', trim( $posicion_icono ) );
			$coordenadas_salida = $coordenadas;
			foreach ( $coordenadas as $i => $valor) {
				if ( strpos( $valor, 'px' ) === FALSE ) {
					$coordenadas_salida[$i] = (string) 
						( ( ( intval( $valor ) - 1 ) * 20 ) * (-1) ). 'px';
				}
			}
			$posicion_icono = implode( ' ', $coordenadas_salida );
		}

		$salida = '';

		if ( trim ( $descripcion ) !== '' ){
			$clase .= ' icono-con-texto';
		}

		if ( $tipo == 'boton_icono' && trim( $icono ) != '') {

			$salida = '<a class="btn sin-outline '.$clase_adicional.'" ' 
						. '" id="' . $id . '" name="' . $id . '" '
						.'style="'.$estilo_adicional.'" '
						.'href="'.$enlace.'" title="'.$tooltip.'" target="'.$destino.'">';
			$icono_boton = '<i class="'.$icono.' '.$clase_adicional_icono.'" style="'
						  .$estilo_adicional_icono.'"></i>';

			if ( trim ( $descripcion ) !== '' ){
				if ( trim ( $alinear_icono ) == 'derecha' ) {
					$salida .= $descripcion . '&nbsp;&nbsp;' . $icono_boton;
				} else {
					$salida .= $icono_boton . '&nbsp;&nbsp;' . $descripcion;
				}
			} else {
				$salida .= $icono_boton;
			}

			/*$salida .= '</div></a>';*/
			$salida .= '</a> ';

		} elseif ( $tipo == 'solo_icono' && trim( $icono ) != '') {

			$salida .= '<a style="'.$estilo_adicional.'" '
					. 'class="a-sin-borde seguido '.$clase.'" '
					. 'href="' 		. $enlace 	. '" '
					. 'target="' 	. $destino 	. '" '
					. 'title="' 	. $tooltip 	. '"'
					. '><div class = "' . $tipo . " " . $clase_adicional
					. '" id="' . $id . '" name="' . $id . '">'
					. '<div class="icono ' . $icono . '" '
					. 'style="background-position:' . $posicion_icono . ';">'
					. '</div>'
					. '</div></a> '."\n";

		} elseif ( $tipo == 'boton_glyphicon' && ( trim( $icono ) != '' OR $posicion_icono != '' ) ) {

			$salida = '<a class="btn sin-outline icono-con-texto'.$clase_adicional.'" ' 
							. 'style="'.$estilo_adicional.'" '
						  . 'href="'.$enlace.'" title="'.$tooltip.'" target="'.$destino.'">'
							. '<div class="icono '
							. $clase_iconos . ' ' 
							. $icono . '" '
							. 'style="background-position:' . $posicion_icono . ';">'
							. '</div>';

			if ( trim ( $descripcion ) !== '' ){
				$salida .= "&nbsp;<div class='descripcion-boton'>$descripcion</div>";
			}
			$salida .= '</div></a>&nbsp;';
		}

		return $salida;
	}
}


if ( ! function_exists( 'html_paginacion' ) ){

	//crea los links de paginacion según los parámetros dados ... aplica para cualquier vista ... jjy
	function html_paginacion ( $id = '', $parametros = array() ) {
		
		//valores por omisión ... jjy
		$enlace               = '#';
		$total_registros      = 10;
		$registros_por_pagina = 5;

		// extracción de parámetros para sobreescribir valores por omisión ... jjy
		extract ( $parametros );

		// validación de parámetros ... jjy
		$enlace = ( substr( trim( $enlace ), -1 ) == '/')
				  ? substr( trim( $enlace ), 0, -1)
				  : trim( $enlace );

		// variable de salida de la función ... jjy
		$salida = "";

		$CI =& get_instance();
		$CI->load->library('pagination');

		$config = array(
					'full_tag_open'  => '<div id="'.$id.'" name = "'.$id.'" class="paginacion seguido">',
					'base_url'       => $enlace,
					'total_rows'     => $total_registros,
					'per_page'       => $registros_por_pagina,
					// la página actual debe venir siempre como último parámetro de la uri ... jjy
					'uri_segment'    => count ( explode('/', str_replace ( site_url(), '', $enlace ) ) ),
					// el parametro anterior debe ser revisado y probado para muchos otros casos .... jjy
					'full_tag_close' => '</div>',
					'num_links'      => round ( $total_registros / $registros_por_pagina ),
					'next_link'			=> '',
					'prev_link'			=> '',
				);

		$CI->pagination->initialize($config); // aplica los parametros ... jjy
		
		$salida = $CI->pagination->create_links();

		$salida = "<div class='btn-group'>"
		. html_enlace_boton('pagina-anterior', array('icono'=>'icon-chevron-left', 'clase_adicional_icono' => 'icon-small', 'estilo_adicional' => 'padding:1px 5px;'))
		. html_enlace_boton('pagina-siguiente', array('icono'=>'icon-chevron-right', 'clase_adicional_icono' => 'icon-small', 'estilo_adicional' => 'padding:1px 5px;'))
		.  "</div>"
		. $salida;

		return $salida;
	}
}

if ( ! function_exists( 'html_grid_simple' ) ){

	//crea un grid simple basado en html .. jjy
	function html_grid_simple ( $id, $arreglo_datos, $parametros=array() ) {
		$mostrar_paginacion = FALSE;
		$columnas           = array();
		$formato_columnas   = array(); //
		$codigo_tabla       = "";
		$editable           = FALSE;
		$nuevo_registro     = FALSE;
		$mostrar_acciones   = FALSE;

		extract( $parametros );

		//se hace una conversion del arreglo por si viene como obj_result de postgres .. jjy
		if(!is_array($arreglo_datos)) $arreglo_datos=(array) $arreglo_datos;

		$html_salida   = "";
		$html_acciones = "";
		$html_salida   = "<table id='$id' name='$id' class='html-grid'>";

		$n_registros =count($arreglo_datos);
		$fila        =0;
		$n_campos    =0;

		if ( count ( $columnas ) == 0 && count( $arreglo_datos ) > 0 ) {
			if ( count ( $arreglo_datos ) == 0 ) {
				$columnas = array('error' => 'No se hasn definido columnas a mostrar y el arreglo de datos está vacío');
			} else {

				foreach ( $arreglo_datos[0] as $campo => $valor ) {
					$columnas[$campo] = $campo;
				}
			}
		}

		if( count( $columnas ) > 0 ){

			$html_salida.= "<tr>";
			$html_salida.= "<th></th>\n";
			foreach( $columnas as $campo => $titulo ){
				$mostrar_col[$campo]=$titulo;

				//se muestran las cabeceras de las columnas .. jjy
				//sólo la primera vez
				$n_campos++;
				if(isset($mostrar_col[$campo])) {
					$titulo=$mostrar_col[$campo];
					$html_salida.= "<th>".$titulo."</th>";
				}
			}
			$html_salida.= "<td class='invisible'></td>\n";
			$html_salida.= "<th style='width:0px;'></th>\n";
			$html_salida.= "</tr>\n";
		}

		$html="";
		$mensaje="";
		$tipo_mensaje="";

		if($n_registros>0){

			foreach($arreglo_datos as $reg){
				$fila++;

				$par_o_impar=(($fila%2)==0)?'par':'impar';
				$registro_editable=($editable==true)?'registro_editable':'';
				$html_campos_hidden="";
				$html_salida.= "<tr class='fila-registro seleccionable {$par_o_impar} {$registro_editable}'>";
				$html_salida.= '<td class="alinear-abajo sin-padding"></td>';
				foreach($reg as $campo=>$valor){
					if(isset($mostrar_col[$campo])) {
						$html_salida.= "\n<td>";
						if($editable) {
							$html_salida.= "<input class='{$par_o_impar} celda_grid' id='{$campo}[]' name='{$campo}[]' type='text' class='{$par_o_impar} ancho-full' value='$valor' title='$valor' rel='$fila'/>";
						} else {
							if ( isset ( $campos[$campo] ) ) { //si viene con formato
								$valor = str_replace( '{@valor}', $valor, $campos[$campo] );
							}
							if ( isset ( $formato_columnas[$campo] ) ) { //si viene con formato
								$valor = $formato_columnas[$campo];
								foreach($reg as $campo_x => $valor_x){
									$valor = str_replace( '{@'.$campo_x.'}', $valor_x, $valor);
								}
							}
							$html_salida.= $valor;
						}
						$html_salida.= "</td>";
					} else {
						$html_campos_hidden.= "<input id='{$campo}[]' name='{$campo}[]' type='hidden' class='ancho-full' value='{$valor}' rel='$fila' />\n";
					}
				}
				if ( $mostrar_acciones == TRUE ){
					$html_acciones="<i class='icon-plus-sign-alt'> <i class='icon-remove'> ";
				}

				$html_campos_hidden.="<input class='registro_editado' id='registro_editado[]' name='registro_editado[]' type='hidden' rel='$fila'/>";
				$html_salida.= '<td class="invisible">'.$html_campos_hidden.'</td>';
				$html_salida.= '<td class="alinear-centro" style=" width="15px"; padding:0px !important;">'.$html_acciones.'</td>';//REVISAR!!!
				$html_salida.= "</tr>\n";
			}

		} else {

			$mensaje="La tabla está vacia actualmente.";
			$tipo_mensaje="advertencia";
		}
		$reg=array();
		if(isset($campos)){
			foreach($campos as $campo=>$formato){
				if( !is_integer($campo) ) {
					$reg[$campo] = "";
				} else {
					$reg[$formato] = "";
				}
			}
		}
		$reg['codigo_tabla'] = $codigo_tabla;

		//se muestran una fila vacía al final para un nuevo registro .. jjy
		$html="";
		if($nuevo_registro){
			$html_campos_hidden="";
			$html= 	'<script>';
			$html.= "var reg_nuevo={$fila};";
			$html.= 'var tr_nuevo="';
			$html.=	"<tr class='registro_nuevo'><td></td>";

			foreach($reg as $campo=>$valor){
				$valor_campo_defecto="";
				$hay_campo_nuevo=isset($parametros[$campo.'_nuevo']);
				if($hay_campo_nuevo){
					$valor_campo_defecto=$parametros[$campo.'_nuevo'];
				} else {
					if(!isset($mostrar_col[$campo])){
						$valor_campo_defecto=$valor;
					}
				}
				if(isset($mostrar_col[$campo])) {
					$html.= "<td>"
						   ."<input class='celda_grid' id='{$campo}[]' name='{$campo}[]' type='text' class='ancho-full' value='{$valor_campo_defecto}'  rel='$fila'/>"
						   ."</td>";
				} else {
					$html_campos_hidden.= "<input id='{$campo}[]' name='{$campo}[]' type='hidden' class='ancho-full' value='{$valor_campo_defecto}'  rel='$fila'/>";

				}
			}
			$html_campos_hidden.="<input class='registro_editado' id='registro_editado[]' name='registro_editado[]' type='hidden' rel='$fila'/>";
			$html.= "<td class='invisible'>$html_campos_hidden</td>";
			$html.= "<td></td>";
			$html.= '</tr>";';
			$html.="\n</script>\n";
		}	

		$html_salida.= "</table>\n";
		$html_salida.= $html;
		$html_salida.=html_mensaje('',$mensaje,$tipo_mensaje);

		if($nuevo_registro){
			$html_salida.= "<a href='javascript:void(0);' class='link_registro_nuevo_grid' rel='$id'>Agregar registro nuevo</a>";
			$html_salida.= "&nbsp;<a href='javascript:void(0);' class='link_guardar_registro' rel='$id'>Guardar cambios</a>";
			$html_salida.= "&nbsp;<a href='javascript:void(0);' class='link_cancelar_edicion' rel='$id'>Cancelar</a>";
			$script="
				<script>
					$(document).ready(function(){
						$('#'+$(this).attr('rel')+' tr:even td input').addClass('par');
						$('.link_guardar_registro , .link_cancelar_edicion').hide();
						$('.link_cancelar_edicion').click(function(){
							$('#'+$(this).attr('rel')+' tr:last').remove();
							$('.link_guardar_registro[rel=\"'+$(this).attr('rel')+'\"], .link_cancelar_edicion[rel=\"'+$(this).attr('rel')+'\"]').hide();
							$('.link_registro_nuevo_grid[rel=\"'+$(this).attr('rel')+'\"]').show();
							reg_nuevo--;
						});
						$('.link_registro_nuevo_grid').click(function(){
							reg_nuevo++;
							$('#'+$(this).attr('rel')).append(tr_nuevo);
							$('#'+$(this).attr('rel')+' tr:last input').attr('rel',reg_nuevo);
							$('#'+$(this).attr('rel')+' tr:even td input').addClass('par');
							$(this).hide();
							$('.link_guardar_registro[rel=\"'+$(this).attr('rel')+'\"], .link_cancelar_edicion[rel=\"'+$(this).attr('rel')+'\"]').show();

							$('.celda_grid').change(function(){
								$('.registro_editado[rel=\"'+$(this).attr('rel')+'\"]').val('SI');
							});
						});
						$('.link_guardar_registro').click(function(){
							{$parametros['funcion_guardar']}();
						});
						$('.celda_grid').change(function(){
							$('.registro_editado[rel=\"'+$(this).attr('rel')+'\"]').val('SI');
						});
					});
				</script>";
			$html_salida.= $script;
		}

		return $html_salida;
	}

}

if(!function_exists('html_mensaje')){

	function html_mensaje($id="",$mensaje="", $tipo="amarillo", $parametros=array()){
		$salida="";
		if($mensaje!=""){
			$salida='
			<div id="'.$id.'" name="'.$id.'" class="mensaje mensaje-'.$tipo.'">
				'.$mensaje.'
			</div>
			<script>
				setTimeout("desvanecer_mensaje()",3000);
				function desvanecer_mensaje(){$(".mensaje").fadeOut("fast");}
			</script>';
		}
		return $salida;
	}
}

if (!function_exists('html_pestanas')){

	function html_pestanas($id="", $parametros=array()){
		$deshabilitar_otras = FALSE;
		$html_salida     = "";
		$clases          = (isset($parametros['clases-pestanas']) && $parametros['clases-pestanas']!="")?$parametros['clases-pestanas']:"";
		$estilos         = (isset($parametros['estilo-pestanas']) && $parametros['estilo-pestanas']!="")?$parametros['estilo-pestanas']:"";
		$estilo_general  = (isset($parametros['estilo-general']) && $parametros['estilo-general']!="")?$parametros['estilo-general']:"";
		
		extract( $parametros );

		$seccion_activa  = $parametros['id_pestana_activa'];

		foreach($parametros['pestanas'] as $seccion => $titulo){
			eval('$tab_'.$seccion.' = "";');
		}
		eval('$tab_'.$seccion_activa.' = "activo";');

		$html_salida.='<div id="'.$id.'" name="'.$id.'" class="contenedor-pestanas">
				<ul class="pestanas ancho-full" style="'.$estilo_general.'">
					&nbsp;';
					
					$estilo_id_tab = "";
					foreach ( $parametros['pestanas'] as $id_tab => $titulo_tab ) {
						
						eval ( '$estilo_id_tab = $tab_'.$id_tab.';' );

						$html_salida.='<li class="tab '.$clases.' '.$estilo_id_tab.'" style=" '.$estilos.' ">';
						
						if ( ! $deshabilitar_otras === TRUE OR $id_tab == 'inicio' ){
							$html_salida.='<a href="';
							$html_salida.=( ( isset ( $parametros ['enlaces'][$id_tab] ) ) 
									? $parametros ['enlaces'][$id_tab] 
									: "javascript:void(0);"
							);
							$html_salida.='" rel="'.$id_tab.'">';
						}

						$html_salida .= $titulo_tab;
						
						if ( ! $deshabilitar_otras === TRUE OR $id_tab == 'inicio' ){
							$html_salida .= '</a>';
						}

						$html_salida .= "</li>\n";
					}
		$html_salida.='</ul></div>';

		$html_salida .=	"\n
			<script>
				$(document).ready(function(){
					$('.pestanas li.tab a').click(function(){
						$('.pestanas li.activo').removeClass('activo');
						$(this).parent().addClass('activo');

						$('div.tab_activo').addClass('invisible').removeClass('tab_activo');
						$('div#'+$(this).attr('rel')).removeClass('invisible');
						$('div#'+$(this).attr('rel')).addClass('tab_activo');
					});
				});
			</script>
			\n";
		return $html_salida;
	}
}

if(!function_exists('html_lista_segun_tabla')){
	
	function html_lista_segun_tabla($id, $parametros=array()){
		//Parámetros esperados ... jjy
		$clases="";
		$estilos="";
		$texto_por_defecto="-- Seleccione --";
		$valor_por_defecto="0";
		$texto_seleccionado="";
		$valor_seleccionado="";

		// los parametros correctos remplazaran a los inicializados en "" .. jjy
		extract($parametros);

		$CI =& get_instance();
		$CI->load->model('comun/comun_m');

		$datos=$CI->comun_m->valores_lista_segun_tabla($parametros);

        $html_salida="<select class='$clases' style='$estilos' id='$id' name='$id'>\n";
        	if($texto_por_defecto!=""){
		        $html_sub1="<option value='$valor_por_defecto' ";
		        if($valor_por_defecto==$valor_seleccionado){
		        	$html_sub1.=" selected='selected' ";
		        }
		        $html_sub2=">$texto_por_defecto</option>";
		        $html_salida.=$html_sub1.$html_sub2;
		    }

        foreach ($datos['datos'] as $reg) {
			foreach($reg as $campo=>$valor){
                if($campo==$campo_lista_valor){
                    $html_sub1="<option value='$valor' ";
					if($valor_seleccionado!="" && $valor==$valor_seleccionado){
			        	$html_sub1.=" selected='selected' ";
			        }
                }
		         //|| ($texto_seleccionado!="" && $valor==$texto_seleccionado))
                if($campo==$campo_lista_texto){
                	if($texto_seleccionado!="" && $valor==$texto_seleccionado){
		        		$html_sub1.=" selected='selected' ";
		        	}
                    $html_sub2=">$valor</option>\n";
                }
            }
            $html_salida.=$html_sub1.$html_sub2;
        }
        $html_salida.="</select>\n";

        return $html_salida;
	}
}

if( ! function_exists('html_calculadora_simple')){
	// más simple .... IMPOSIBLE! ... fuente: http://www.javascriptkit.com/script/cut18.shtml ... adaptación: jjy
	function html_calculadora_simple( $visible = TRUE ){
		$clase_visible = ( $visible ) ? '' : 'invisible';
		$html =<<< fin
			<!-- CALCULADORA SIMPLE .. de apoyo al componente que use la funcion especial de calculadora ... !! ... jjy -->
			<!-- ----------------------------------- -->
			<style type="text/css">
				.calculadora-simple { border: 1px solid #ccc; position:absolute; z-index: 100; padding:5px; background-color: white !important;box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.25);}
				.calculadora-simple input#i { width: 100px; }
				.calculadora-simple .b_num { width: 25px; cursor: pointer; }
				.calculadora-simple .b_num.b_ok_calc { width: 52px; }
				.calculadora-simple table, .calculadora-simple table td {	border: 0; background-color: white !important; }
				.calculadora-simple table td { align: center !important; }
			</style>
			<script type="text/javascript">
				function c_a(c)   { v = $('#i').val(); if(c!='.' || (c=='.' && ( v.indexOf('.')==-1) || v.substr(-1)!='.') ){ $('#i').val(v+c); } } 
				function rt_calc(){ $('#'+$('.calculadora-simple #txt_destino').val() ).val( c.i.value ); x_calc(); }
				function x_calc() { $('.calculadora-simple').addClass('invisible'); }
			</script>
			<!-- ----------------------------------- -->
			<div class="calculadora-simple
					 $clase_visible 
			">
			  <form name="c" id="c">
			  <table border=4>
				  <tr>
					  <td align="center">
						  <input placeholder="0.00" type="text" id="i" name="i">
					  </td>
					  </tr>
					  <tr>
					  <td align="center">
						  <button type="button" class='b_num' rel="1" onclick="c_a('1')">1</button>
							<button type="button" class='b_num' rel="2" onclick="c_a('2')">2</button>
							<button type="button" class='b_num' rel="3" onclick="c_a('3')">3</button>
							<button type="button" class='b_num' rel="+" onclick="c_a(' + ')">+</button>
							<br>
							<button type="button" class='b_num' rel="4" onclick="c_a('4')">4</button>
							<button type="button" class='b_num' rel="5" onclick="c_a('5')">5</button>
							<button type="button" class='b_num' rel="6" onclick="c_a('6')">6</button>
							<button type="button" class='b_num' rel="-" onclick="c_a(' - ')">-</button>
							<br>
							<button type="button" class='b_num' rel="7" onclick="c_a('7')">7</button>
							<button type="button" class='b_num' rel="8" onclick="c_a('8')">8</button>
							<button type="button" class='b_num' rel="9" onclick="c_a('9')">9</button>
							<button type="button" class='b_num' rel="x" onclick="c_a(' * ')">x</button>
							<br>
							<button type="button" class='b_num' rel="." onclick="c_a('.')">.</button>
							<button type="button" class='b_num' rel="0" onclick="c_a('0')">0</button>
							<button type="button" class='b_num' rel="=" onclick="$('#i').val( (eval($('#i').val())).toFixed(2) )">=</button>
							<button type="button" class='b_num' rel="/" onclick="c_a(' / ')">/</button>
						  <br>
						  <button type="button" class='b_num' rel="c" onclick="$('#i').val('')">c</button>
							<button type="button" class='b_num b_ok_calc' rel="ok" onclick="rt_calc()">ok</button>
							<button type="button" class='b_num' onclick="x_calc()"><i class="icon-share icon-flip-horizontal"></i></button>
						  <br>
						  <input type="hidden" name="txt_destino" id="txt_destino" value=""/>
					  </td>
				  </tr>
			  </table>
			  </form>
			</div>
			<!-- ----------------------------------- -->
fin;
		return $html;
	}
}












/* End of file componentes_html_helper.php */
/* Location: ./aplicacion_base/helpers/componentes_html_helper.php */
