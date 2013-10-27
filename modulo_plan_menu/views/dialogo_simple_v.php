	<h2 class="titulo-seccion normal seguido"><?=$titulo_dialogo?></h2>
	
	<div class="cerrar-velo-blanco flotado-derecha">
		<a href="javascript:cerrar_velo();"><i class="icon-share icon-flip-horizontal"></i></a>
	</div>
	
	<hr>
	
	<?php 
	/**
	 DESHABILITADO POR EL MOMENTO0
	**/
	/*
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
	*/?>

	<?=html_etiqueta( $instrucciones )?>

	<?=html_br('7px')?>

	<div class="contenedor-grid alto-245">

		<?php
			if ( ! isset($datos) ){
				$datos = array( // se deben disponer los datos en un arreglo o en un objeto de resultado de codeigniter ..... jjy
					// DATOS SOLO PARA EFECTO DEMOSTRATIVO ..................... !!!!!!!
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
				);
			}
			$parametros = array(
				'columnas' => $columnas,
				'formato_columnas' => $formato_columnas,
			);
		?>
		<?=html_grid_simple( 'grid_' . $id_dialogo , $datos, $parametros ); ?>

	</div>
















	
	<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>