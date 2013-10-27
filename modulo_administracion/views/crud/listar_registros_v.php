<?php $this->load->view('encabezado_comun_modulo_v'); // no modificar esta linea .... jjy ?>
</head> 
<?php //se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>

<body>


	<h2 class = "titulo-seccion">Usuarios del Sistema</h2> 
	<?php if(isset($mensaje_error)){ ?>
		<?php /* <h3 class="mensaje-error"><?=$mensaje_error?></h3> <?php }if(isset($mensaje_exito)){?> <h3 class="mensaje-exito"> <?=$mensaje_exito?></h3> */ ?>
		<?=html_mensaje( '', $mensaje_error, 'error' );?>
	<?php }?>
	<?php if(isset($mensaje_exito)){ ?>
		<?php /* <h3 class="mensaje-error"><?=$mensaje_error?></h3> <?php }if(isset($mensaje_exito)){?> <h3 class="mensaje-exito"> <?=$mensaje_exito?></h3> */ ?>
		<?=html_mensaje( '', $mensaje_exito, 'exito' );?>
	<?php }?>
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



		$parametros = array(
							'enlace'           => site_url().'/s/listar_roles',
							'icono'            => 'icon-user',
							'descripcion'      => 'Roles',
						);
		$html_salida .= html_enlace_boton( 'b_roles' , $parametros );


		$codigo_modulo  = codigo_modulo_segun_id( $config['modulo']['id'] );
		$codigo_permiso = codigo_permiso_segun_id( 'b_modulos' );
		$parametros = array( 'codigo_modulo'  =>  $codigo_modulo, 'codigo_permiso' => $codigo_permiso, /* tambien sirve 'codigo_permiso' => 'MD0001.PR0001',*/ );
		if ( usuario_habilitado_para( $parametros ) != 'NEGADO' ){
			$parametros = array(
							'enlace'           => site_url().'/s/listar_modulos',
							'icono'            => 'icon-cogs',
							'descripcion'      => 'Modulos',
						);
			$html_salida .= html_enlace_boton( 'b_modulos' , $parametros );
		}

			

		/*$parametros = array(
						'enlace'           => site_url().'/s/filtrar_registros',
						'icono'            => 'icon-filter',
						'descripcion'      => 'Filtrar',
					);
		$html_salida .= html_enlace_boton( 'b_filtrar' , $parametros );*/
		
		/**
		 A continuacion se pregunta por un permiso para un boton .... jjy
		**/



		/*$codigo_modulo  = codigo_modulo_segun_id( $config['modulo']['id'] );
		$codigo_permiso = codigo_permiso_segun_id( 'b_exportar' );
		$parametros = array( 'codigo_modulo'  =>  $codigo_modulo, 'codigo_permiso' => $codigo_permiso, /* tambien sirve 'codigo_permiso' => 'MD0001.PR0001',*/ //);

		/*if ( usuario_habilitado_para( $parametros ) != 'NEGADO' ){
			$parametros = array(
							'enlace'           => site_url().'/s/exportar_registros',
							'icono'            => 'icon-suitcase',
							'descripcion'      => 'Exportar',
						);
			$html_salida .= html_enlace_boton( 'b_exportar' , $parametros );
		}*/

			




		/**
		 Fin del permiso para boton .... jjy
		**/


		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>
	<hr>

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>

		<div>
			
			<?=html_etiqueta('Lista de usuarios registrados dentro del sistema')?>

			<?=html_formulario_ini( 'f_demo' )?>

			<?=html_br()?>


			<?php
			
				// ********* ESTAS LINEAS SON SOLO PARA USO DEMOSTRATIVO DEL MANEJO DE LOS DATOS !!!!! .... jjy
				date_default_timezone_set('UTC');
				 // ********* ESTAS LINEAS SON SOLO PARA USO DEMOSTRATIVO DEL MANEJO DE LOS DATOS !!!!! .... jjy
			?>

<?php //********************* lista simple ....... jjy ************************** ?>

			<?php
				$parametros = array(
					'mostrar_paginacion' => FALSE, // parametros para la paginacion ... EN DESARROLLO!! ... jjy
					'paginacion'         => array( 5, 1 ,'./'),
					'mostrar_acciones'   => TRUE,
					//'iconos_accion'      => array( 'mostrar', 'imprimir', 'editar', 'eliminar' ), // opcionales ... jjy

					// se definen los enlaces de los botones de acción .... jjy
					'enlace_mostrar'  => site_url() 	. '/s/registro/m/{@codigo_usuario}',
					'enlace_editar'   => site_url() 	. '/s/registro/e/{@codigo_usuario}',
					'enlace_imprimir' => site_url() 	. '/s/imprimir_registro/{@id}',
					'enlace_eliminar' => 'javascript:eliminar({@id});',

					'columnas' => array( // se definen los títulos de la lista en base a los campos ... jjy

						'nombre_usuario'     => 'Usuario', // para ordenar ---- &nbsp;&nbsp;<i class="icon-caret-down"></i>',
						'rol_usuario'        => 'Rol',
						'correo_electronico' => 'Correo Electronico',
						'estatus_usuario'    => 'Estatus',


					),
				);
		//prp($parametros);
		$codigo_modulo  = codigo_modulo_segun_id( $config['modulo']['id'] );
		$codigo_permiso = codigo_permiso_segun_nombre( 'icono_editar' );

	
		$parametros_habilitado = array( 'codigo_modulo'  =>  $codigo_modulo, 'codigo_permiso' => $codigo_permiso, /* tambien sirve 'codigo_permiso' => 'MD0001.PR0001',*/);
		if ( usuario_habilitado_para( $parametros_habilitado ) != 'NEGADO' ){
			$parametros['iconos_accion']=array( 'mostrar', 'imprimir', 'editar', 'eliminar' );
		}else{
			$parametros['iconos_accion']=array( 'mostrar', 'imprimir', 'eliminar' );
		}

		//prp($parametros,1);
			?>
			<?=html_lista_datos( 'lista_datos', $datos, $parametros ) ?>

<?php //********************* fin lista simple ....... jjy ************************** ?>

			<?=html_formulario_fin()?>

		</div>

	<br>










<script type="text/javascript">
	//la buena práctica dice que los scripts deben estar al final del documento mientras sea posible ... jjy 
	function eliminar( id ){
		var r=confirm( 'Mensaje de confirmación para eliminar ' );
				if (r==true){
				 var pagina = "<?=site_url()?>/s/eliminar_registro/"+id;			  
			  	location.href=pagina;
			  	}
	}
</script>
<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea .... jjy ?>