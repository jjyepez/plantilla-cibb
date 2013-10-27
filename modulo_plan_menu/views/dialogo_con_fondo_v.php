	<h2 class="titulo-seccion normal seguido">Recetas disponibles (Entrada Caliente)</h2>
	
	<div class="cerrar-velo-blanco flotado-derecha">
		<a href="javascript:cerrar_velo();"><i class="icon-share icon-flip-horizontal"></i></a>
	</div>
	
	<hr>
	
	<div class="barra-botones-modulo">
		<?php
			$parametros = array(
						'enlace'           => '#',
						'icono'   => 'icon-file',
						'descripcion'      => 'Nuevo',
					);
		?>
		<?=html_enlace_boton( 'b_volver' , $parametros );?>
	</div>
	<hr>
	<?php 
		$instrucciones = 'Seleccione algunas de las recetas disponibles de la siguiente lista.'; 
	?>
	<?=html_etiqueta( $instrucciones )?>
	
	<?=html_br('5px')?>
	
	<div class="contenedor-grid alto-100">
		<?php
			date_default_timezone_set('UTC');
			$datos = array( // se deben disponer los datos en un arreglo o en un objeto de resultado de codeigniter ..... jjy
				array(
					'id'                   => 0,
					'nombre_receta'     => "Hervido de Res",
					'costo_receta'     => "35,00 Bs.",
				),
				array(
					'id'                   => 1,
					'nombre_receta'     => "Consome de Atún",
					'costo_receta'     => "37,00 Bs.",
				),
				array(
					'id'                   => 2,
					'nombre_receta'     => "Hervido de Gallina",
					'costo_receta'     => "30,00 Bs.",
				),
			);
		?>
		<?=html_grid_simple('grid_1', $datos); ?>
	</div>