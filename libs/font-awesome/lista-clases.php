<!DOCTYPE html>
<html>
<head>
	<style>
		body {font-family: sans-serif; font-size: 14px;}		
		input[type ='text'] {padding: 5px;}
		table      					{width:100%;}
		td         					{width: 33.33%;vertical-align: top;}
		.oculto {display:none;}
	</style>
	<script src="./css/jquery.min.js"></script>
</head>
<body>
	<h3>Clases Disponibles en la aplicacion</h3>
<form>
Filtrar: <input id="q" name="q" type="text" value=<?=@trim($_GET['q'])?>><input type="submit" value="Filtrar"> <input onclick='javascript:alert(document.getElementBiId("q").Value;' type="button" value="Recargar"><br>
Buscar en 
<span>
	<input type='radio' id='c' name='c' value='nc'>Nombres de clases 
	<input type='radio' id='c' name='c' value='ac'>Atributos de clases 
	<input type='radio' id='c' name='c' value='am'>Ambos 
</span> 
</form>
<?php
	$raiz = 'http://'.str_replace( $_SERVER['DOCUMENT_ROOT'], $_SERVER['SERVER_NAME'], realpath("../..") ).'/';
	$archivos = array( 
											$raiz . "css/estilos.css",
											$raiz . "css/fuentes_libres.css",
											$raiz . "libs/font-awesome/css/font-awesome.css",
											$raiz . "libs/font-awesome/css/bootstrap-combined.no-icons.min.css",
	);
	foreach ( $archivos as $css_original ) {

		$arr_salida = array();
		$arr_lista  = array();
		$arr_clases  = array();
		$arr_elementos  = array();

		$f = file($css_original);

		$f = implode ('', $f);
		$f = explode ('}', $f);

		$arr_clases = array();

		$n=0;
		foreach ($f as $l_clase) {

			$x_clase = explode( '{', str_replace('}', '', $l_clase ) );
			$clase = $x_clase[0];

			$arr_lista = explode(',' , $clase);
			$arr_clases[ $clase ] = isset ( $arr_clases[ $clase ] )? $arr_clases[ $clase ] + 1 : 1;
			$arr_atributos = explode(';', $x_clase[1]);
			foreach ( $arr_atributos as $i => $atributo ){
				$arr_atributos[ $i ] = trim( strtolower( $atributo ) );
			}

			foreach ($arr_lista as $elemento ) {
				$elemento = trim($elemento);
				if( $elemento != '') {
					$arr_elementos[ $elemento ]['n'] = isset ( $arr_elementos[ $elemento ]['n'] )? $arr_elementos[ $elemento ]['n'] + 1 : 1;
					$arr_elementos[ $elemento ]['atributos'][$n] = $arr_atributos;
				}
				$n++;
			}

		}
	?>
	<hr>
	<span style="color:#999;">Clases disponibles en<br><b><?=$css_original?></b></span>

	<div style="font-size: 12px;">
		<table><tr>
	<?php
		$columnas = 3;
		$c = 1; $n=0;
		ksort($arr_elementos);
		foreach ($arr_elementos as $elemento => $contenido) {

			$html_contenido = "";
			if ( str_replace( array("/", "@", "{") , "" , $elemento ) === $elemento ) {

				if ( isset( $_GET['q'] ) && $_GET['q'] != "" ) {

					if ( strstr( $elemento, $_GET['q']) != "" ) {
						$html_contenido .= "$elemento";
					}

				} else {
					$html_contenido .= "$elemento";
				}

			}
			if ( ($c) % $columnas  == 0 ) {
				echo "</tr><tr>";
				$c = 1;
			}
			if ( trim( $html_contenido ) != "" ) {

				echo '<td><a rel="'.$n.'" href="javascript:void(0);">' . $html_contenido . '</a>
				<pre name="div'.$n.'" id="div'.$n.'">';
				sort($contenido['atributos']);
				foreach ( $contenido['atributos'][0] as $atributo ){
					if ( trim( $atributo ) != "" ) {
						echo "\t".$atributo . ';</br>';
					}
				}
				$n++;
				echo '</pre></td>';
				$c++;
			}

		} ?>
		</tr></table>
	</div>
	<?php } ?>
<br><br><br><br>
<script type="text/javascript">
	$(document).ready(function(){
		$('a').click(function(){
			//alert(('div'+$(this).attr('rel')));
			//$('div'+$(this).attr('rel') ).removeClass('oculto');
		});
	});
</script>
</body>
</html>