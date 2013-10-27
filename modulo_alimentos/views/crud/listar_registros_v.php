<?php $this->load->view('encabezado_comun_modulo_v') // no modificar esta linea .... jjy ?>
</head> <?php // se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>

<body>

	<h2 class = "titulo-seccion">Listar Alimentos</h2>
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
						'alinear_icono'	 	 => 'izquierda',
					);
		$html_salida .= html_enlace_boton('b_volver', $parametros );

	
		$parametros = array(
						'enlace'           => site_url().'/s/filtrar_registros',
						'icono'            => 'icon-filter',
						'descripcion'      => 'Filtrar',
						'alinear_icono'	 	 => 'izquierda',
					);
		$html_salida .= html_enlace_boton( 'b_filtrar' , $parametros );

		
	   $parametros = array(
						'enlace'           => site_url().'/s/quitar_registros',
						'tipo'             => 'boton_glyphicon',
						'clase_iconos'     => 'iconos_osti',
						'posicion_icono'   => '3 1',
						'descripcion'      => 'Quitar',
						'alinear_icono'	 	 => 'izquierda',
						);
		$html_salida .= html_enlace_boton( 'b_quitar' , $parametros );

			$parametros = array(
				'enlace'             => 'javascript:paso_siguiente();',
				'icono'              => 'icon-arrow-right',
				'clase_adicional' 	 => 'btn-primary',
				'alinear_icono'	 	 => 'derecha',
			  );
		
		$html_salida .= html_paginacion( '' ) . '</div>' ;
		


			

		

		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>
	

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>

		<div>
			
		
			<?=html_formulario_ini( 'f_demo' )?>

			<?=html_br()?>

			<?php
				// ********* ESTAS LINEAS SON SOLO PARA USO DEMOSTRATIVO DEL MANEJO DE LOS DATOS !!!!! .... jjy
				date_default_timezone_set('UTC');
				?>

<?php //********************* lista simple ....... jjy ************************** ?>

			<?php
				$parametros = array(
					'mostrar_paginacion'    => TRUE, // parametros para la paginacion ... EN DESARROLLO!! ... jjy
					'paginacion'            => array( 5, 1 ,'./'),
					'mostrar_acciones' 	=> TRUE,
					'iconos_accion'         => array( 'mostrar', 'imprimir', 'editar', 'eliminar' ), // opcionales ... jjy

					// se definen los enlaces de los botones de acción .... jjy
					'enlace_mostrar'  			=> site_url() 	. '/s/registro/m/{@codigo_alimento}',
					'enlace_editar'   			=> site_url() 	. '/s/registro/e/{@codigo_alimento}',
					'enlace_imprimir' 			=> site_url() 	. '/s/imprimir_registro/{@id}',
					'enlace_eliminar' 			=> 'javascript:eliminar({@id});',

					'columnas' => array( // se definen los títulos de la lista en base a los campos ... jjy

						'nombre_alimento'      		=> 'Alimento', 
						'categoria_alimento'   		=> 'Categoría', 
						'cantidad_caloria'              => 'Calorías',
						'cantidad_proteina'       	=> 'Proteínas',
						'cantidad_grasa' 		=> 'Grasas',
						'cantidad_carbohidrato_total' 	=> 'Carb.H.T.',
						

					),
				);
			?>
			<?=html_lista_datos( 'lista_datos', $informacion, $parametros ) ?>

<?php //********************* fin lista simple ....... jjy ************************** ?>

			<?=html_formulario_fin()?>

		</div>

	<br>













<script type="text/javascript">
	//la buena práctica dice que los scripts deben estar al final del documento mientras sea posible ... jjy 
	function eliminar( id ){
		alert(id);
		/*var r=confirm( 'Mensaje de confirmación para eliminar ' );
				if (r==true){
				 var pagina = "<?=site_url()?>/s/eliminar_registro/"+id;			  
			  	location.href=pagina;
			  	}*/
	}
</script>
<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea .... jjy ?>
