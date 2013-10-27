<?php
global $config, $menus_izquierda_activos; // definicion de menús de la izquierda  .... jjy
if ( array_key_exists( $seccion, $menus_izquierda_activos ) ) {
	$tipo_menu = 'menu-izquierda';
	$estilo_menu = "panel-1 ancho-minimo-150 ancho-menu-izquierdo flotado-izquierda fijo";
	if ( isset( $menus_izquierda_activos [$seccion][0] ) ){
		$tipo_menu = $menus_izquierda_activos [$seccion][0];
		$estilo_menu = $tipo_menu;
	}
/** 
SOLO CONTINUA ADELANTE GENERANDO EL MENU, SI LA SECCION HA SIDO DEFINIDA ARRIBA ... jjy
**/
?>

<div class="<?=$estilo_menu?>">
	
	<ul class="<?=$tipo_menu?>">

	<?php 
		/**
			El menú secundario debe haber sido creado y definido correctamente
			en el archivo la carpeta /views/comun/menu_izquierda_v.php 
			del modulo correpondiente ... jjy
		**/

		$vista_menu_izquirda_base =  $config['sesion']['modulo_activo'] . '/views/menu_izquierda_v';
		$url_menu_izquirda_base = realpath('.') . '/' . $vista_menu_izquirda_base . '.php';
		
		if (file_exists($url_menu_izquirda_base) !== 1) {
		
			$this->load->view( '../../' . $vista_menu_izquirda_base);
		
		} 
	?>
	</ul>
</div>

<?php } /**
	FIN MENU
**/ ?>