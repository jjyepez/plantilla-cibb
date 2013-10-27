<?php $this->load->view('encabezado_comun_modulo_v') ?>
<!--<style>
	.dia-plan {
		background-color: #eee;
	}
	.icono-lista-tiempo {
		position: relative;
		top: 0;
	}
	.velo-blanco{
		position: absolute;
		left:0;
		right:0;
		top:0;
		bottom: 0;
		background-color: rgba(255,255,255,0.75);
	}
	.cerrar-velo-blanco{
		position: relative;
		top: 0;
	}
	#dialogo {
		background-color: #fff;
		position: relative;
		width: 50%;
		height: 350px;
		border: 1px solid #ccc;
		margin: 0 auto;
		/*top: 50%;*/
		margin-top: 50px;
		border-radius: 7px;
		box-shadow: 3px 3px 20px rgba(0,0,0,0.25);
		padding: 10px;
	}
</style>-->
</head> <?php // se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>
<body>

	<h2 class="titulo-seccion">Nuevo Plan de Menú <?=$id_plan_menu?></h2>
	<hr>

	<div class="barra-botones-modulo">

	<?php //************************* BARRA DE BOTONES ..... jjy ************************* ?>
	<?php
		$html_salida = ""; // buffer !!!

		$parametros = array(
						'enlace'           => site_url().'/s/listar_registros',
						'tipo'             => 'boton_glyphicon',
						'clase_iconos'   	 => 'iconos_osti',
						'posicion_icono'   => '2 1',
						'descripcion'      => 'Volver',
					);
		$html_salida .= html_enlace_boton( 'b_volver' , $parametros );

		$parametros = array(
						'enlace'           => site_url().'/s/guardar_registro',
						'icono'            => 'icon-save',
						'descripcion'      => 'Guardar',
						//'clase_adicional'  => 'btn-primary',
					);
		$html_salida .= html_enlace_boton('b_guardar', $parametros );

		$parametros = array(
						'enlace'           => 'javascript:alert("vista preliminar");',
						'icono'            => 'icon-search',
						'descripcion'      => 'Vista Preliminar',
					);
		$html_salida .= html_enlace_boton( 'b_exportar' , $parametros );

		$html_salida .= '<div class="flotado-derecha">';

		$parametros = array(
				'enlace'             => 'javascript:paso_siguiente();',
				'icono'              => 'icon-arrow-right',
				'descripcion'        => 'Siguiente Paso',
				'clase_adicional' 	 => 'btn-primary',
				'alinear_icono'	 	 => 'derecha',
			  );
		$html_salida .= html_enlace_boton( 'b_paso_siguiente_p' , $parametros );
		
		$html_salida .= html_paginacion( '' ) . '</div>';

		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>

	<hr>
<?php
	/**
		DATOS PARA PRUEBAS ......... *********
	**/
	$n_dias = 3;
	$n_dias_mostrado = 0;
	$dias 	 = array('lunes', 'martes', 'miércoles', 'jueves', 'viernes');
	$tiempos = array('desayuno', 'almuerzo', 'cena' );
	$distribucion_menu = array( 'Entrada Caliente', 'Acompañante', 'Ensalada', 'Jugo', 'Fruta', 'Untable' );

 ?>
<?=html_formulario_ini('f')?>
<div class="scroll-overflow">
<table class = "tabla-interactiva">	
<?php while ($n_dias_mostrado < $n_dias ) { ?>
	<tr>
		<td class="dia-plan celda-maximizar alinear-centro"><i class="icon-fullscreen"></i></td>
		<?php foreach ( $dias as $dias_comida => $nombre_dia ) { ?>
			<th class="dia-plan"><?=ucfirst( $nombre_dia )?></th>
		<?php } ?>
	</tr>
	<?php foreach ( $tiempos as $tiempo_comida => $nombre_tiempo ) { ?>
		<tr>
			<td class="celda-nombre-tiempo">
				<!--div class="icono-lista-tiempo"><i class="icon-list"></i></div -->
				<div class="rotado ajuste-nombre-tiempo"><?=ucfirst( $nombre_tiempo )?></div>
			</td>
				<?php foreach ( $dias as $dias_comida => $nombre_dia ) { ?>
					<td class="cuadro-tiempo-comida alinear-arriba">
					<?php
						$azar = round( mt_rand( 0, 1 ) );
						for( $z=1;$z<=$azar;$z++){ ?>
						<div class="opcion-menu">
							<div class="rotado ajuste-texto-opcion">
								<a href="javascript:alert(9);">Opción <?=$z?></a>
							</div>
						</div>
						<? } ?>
						<div class="opcion-menu-mostrado">
							<table class="tabla-simplificada">
								<tr>
									<th>
										<i class="icon-info-sign flotado-izquierda"></i>
										<div class="flotado-izquierda ancho-100">Opción <?=$z?></div>
										<i class="icon-plus-sign-alt seguido flotado-derecha"></i>
									</th>
								</tr>
								<?php
									$azar = round( mt_rand( 0, 2 ) );
									for( $z = 0; $z <= $azar; $z++ ){ ?>
										<tr>
											<td>
												<div class="flotado-izquierda">
													<?=$distribucion_menu[$z]?>
												</div>
												<a href="javascript:mostrar_dialogo_menues();"><i class="icon-list-alt flotado-derecha"></i></a>
											</td>
										</tr>
									<?php } ?>
							</table>
						</div>
					</td>
				<?php $n_dias_mostrado ++ ;	} ?>
			<?php } ?>
		</tr>
	<?php } ?>
</table>
<?=html_formulario_fin()?>
</div>
































<!--div class="velo-blanco invisible">
	<div id="dialogo" class="invisible">asda sdasd asda</div>
</div-->
<script>
	function mostrar_dialogo_menues(){
		url_ajax = '<?=site_url() . "/s/mostrar_dialogo"?>';
		id_dialogo = "contenedor_dialogo";
    mostrar_dialogo( url_ajax, id_dialogo );
	}
</script>
<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jjy ?>
