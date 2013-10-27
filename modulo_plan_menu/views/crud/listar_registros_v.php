<?php $this->load->view('encabezado_comun_modulo_v') // no modificar esta linea .... jjy ?>
</head> <?php // se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>

<body>

	<h2 class = "titulo-seccion">Lista de Planes de Menú</h2>
	<hr>
	
	<div class="barra-botones-modulo">

	<?php //************************* BARRA DE BOTONES ..... jjy ************************* ?>
	<?php
		global $config;
		
		$html_salida = ""; // buffer !!!

		$parametros = array(
						'enlace'           => site_url().'/s/registro/n',
						'icono'            => 'icon-file',
						'descripcion'      => 'Nuevo',
					);
		$html_salida .= html_enlace_boton('b_volver', $parametros );
	
		/*$parametros = array(
						'enlace'           => site_url().'/s/filtrar_registros',
						'icono'            => 'icon-filter',
						'descripcion'      => 'Filtrar',
					);
		$html_salida .= html_enlace_boton( 'b_filtrar' , $parametros );*/

		/**
		 A continuacion se pregunta por un permiso para un boton .... jjy
		**/

		$codigo_modulo  = codigo_modulo_segun_id( $config['modulo']['id'] );
		$codigo_permiso = codigo_permiso_segun_nombre( 'b_exportar' );
		$parametros = array( 'codigo_permiso' => $codigo_permiso.'.b_exportar', /* tambien sirve 'codigo_permiso' => 'MD0001.PR0001',*/ );

		if ( usuario_habilitado_para( $parametros ) != 'NEGADO' ){
			$parametros = array(
							'enlace'           => "javascript: alert('funcionalidad en desarrollo');", //site_url().'/s/exportar_registros',
							'icono'            => 'icon-suitcase',
							'descripcion'      => 'Exportar',
						);
			$html_salida .= html_enlace_boton( 'b_exportar' , $parametros );
		}
		/**
		 Fin del permiso para boton .... jjy
		**/


		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>
	<hr>

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>

		<div>
			
			<?=html_etiqueta( 'A continuación se listan los Planes de Menú generados hasta la fecha.' )?>

			<?=html_formulario_ini( 'f_demo' )?>

			<?=html_br()?>

			<?php
				if ( ! isset( $datos ) ){
					// ********* ESTAS LINEAS SON SOLO PARA USO DEMOSTRATIVO DEL MANEJO DE LOS DATOS !!!!! .... jjy
					date_default_timezone_set('UTC');

					for( $i = 1; $i <= 10; $i++ ){
						$año = mt_rand(2000,2013);
						$datos[] = // se deben disponer los datos en un arreglo o en un objeto de resultado de codeigniter ..... jjy
							array(
								'id'               => $i,
								'codigo_plan_menu' =>'000'. $i,
								'nombre_plan_menu' => "Plan de menú demostrativo año " . $año,
								'fecha_registro'   => date("d/M/") . $año,
								'cantidad_comensales'     => mt_rand(50,250),
								'requerimiento_calorico_total'          => mt_rand(1500,2500),
								//'costo_plan'       => number_format( (integer) mt_rand(1000,15000) ) . ' Bs.',
							); // ********* ESTAS LINEAS SON SOLO PARA USO DEMOSTRATIVO DEL MANEJO DE LOS DATOS !!!!! .... jjy
					}
				}
			?>

<?php //********************* lista simple ....... jjy ************************** ?>

			<?php
				$parametros = array(
					'mostrar_paginacion'    => FALSE, // parametros para la paginacion ... EN DESARROLLO!! ... jjy
					'icono_puntero'         => 'puntero_2.png', // opcionales ... jjy					
					'paginacion'            => array( 5, 1 ,'./'),
					'mostrar_acciones' 			=> TRUE,
					'iconos_accion'         => array( 'mostrar', 'imprimir', 'editar', 'eliminar' ), // opcionales ... jjy

					// se definen los enlaces de los botones de acción .... jjy
					'enlace_mostrar'  			=> site_url() 	. '/s/registro/m/{@id}',
					'enlace_editar'   			=> site_url() 	. '/s/registro/e/{@id}',
					'enlace_imprimir' 			=> 'javascript:imprimir({@id});',
					'enlace_eliminar' 			=> 'javascript:eliminar({@id});',

					'columnas' => array( // se definen los títulos de la lista en base a los campos ... jjy

						'nombre_plan_menu'             => 'Nombre del Plan', // para ordenar ---- &nbsp;&nbsp;<i class="icon-caret-down"></i>',
						'fecha_registro'               => 'Fecha de Registro',
						'cantidad_comensales'          => 'Cant. Comensales',
						'requerimiento_calorico_total' => 'RCT / día',
						'estatus_plan'                 => 'Estatus',

						//'costo_plan'						 => 'Costo Total Plan',
					),
				);
			?>
			<?=html_lista_datos( 'lista_datos', $datos, $parametros ) ?>

<?php //********************* fin lista simple ....... jjy ************************** ?>

			<?=html_formulario_fin()?>

		</div>

	<br>






<?php if( isset ( $mensaje ) ){ ?>
	<?=html_mensaje( '', $mensaje, $tipo_mensaje );?>
<?php } ?>

<script type="text/javascript">
	//la buena práctica dice que los scripts deben estar al final del documento mientras sea posible ... jjy 
	function eliminar( id ){
		var rsp = confirm( 'Mensaje de confirmación para eliminar ' + id );
		if ( rsp ) {
			document.location.href="<?=site_url()?>/s/eliminar_registro/"+id;
		}
	}
	function imprimir( id ){
		var rsp = confirm( 'Mensaje de confirmación la impresión ' + id );
		if ( rsp ) {
			alert('funcionalidad en desarrollo');
		}
	}
</script>
<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea .... jjy ?>