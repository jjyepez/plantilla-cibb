<?php $this->load->view('encabezado_comun_modulo_v'); // no modificar esta linea .... jjy ?>
</head> 
<?php //se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>

<body>



	<h2 class = "titulo-seccion">Modulos del Sistema</h2>
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
						'enlace'           => site_url().'/s/listar_registros',
						'tipo'             => 'boton_glyphicon',
						'clase_iconos'   	 => 'iconos_osti',
						'posicion_icono'   => '2 1',
						'descripcion'      => 'Volver',
					);
		$html_salida .= html_enlace_boton( 'b_volver' , $parametros );

		$parametros = array(
						'enlace'           => site_url().'/s/registro_modulo/n',
						'icono'            => 'icon-file',
						'descripcion'      => 'Nuevo',
					);
		$html_salida .= html_enlace_boton('b_nuevo', $parametros );

		
	
	
		/*$parametros = array(
						'enlace'           => site_url().'/s/filtrar_registros',
						'icono'            => 'icon-filter',
						'descripcion'      => 'Filtrar',
					);
		$html_salida .= html_enlace_boton( 'b_filtrar' , $parametros );*/
		
		/**
		 A continuacion se pregunta por un permiso para un boton .... jjy
		**/

		/**
		 Fin del permiso para boton .... jjy
		**/


		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>
	<hr>

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>

		<div>
			
			<?=html_etiqueta('Lista de modulos disponibles dentro del sistema')?>

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
					'mostrar_paginacion' => TRUE, // parametros para la paginacion ... EN DESARROLLO!! ... jjy
					'paginacion'         => array( 5, 1 ,'./'),
					'mostrar_acciones'   => TRUE,
					'iconos_accion'      => array( 'mostrar', 'imprimir', 'editar', 'eliminar' ), // opcionales ... jjy

					// se definen los enlaces de los botones de acción .... jjy
					'enlace_mostrar'  => site_url() 	. '/s/registro_modulo/m/{@codigo_modulo}',
					'enlace_editar'   => site_url() 	. '/s/registro_modulo/e/{@codigo_modulo}',
					'enlace_imprimir' => site_url() 	. '/s/imprimir_registro/{@id}',
					'enlace_eliminar' => 'javascript:eliminar("{@codigo_modulo}");',

					'columnas' => array( // se definen los títulos de la lista en base a los campos ... jjy

						'nombre_modulo'     => 'Modulos', // para ordenar ---- &nbsp;&nbsp;<i class="icon-caret-down"></i>',


					),
				);
				//if() $parametros['iconos_accion']´
			?>
			<div class="ancho-50-porciento">
			<?=html_lista_datos( 'lista_datos', $modulos, $parametros ) ?>
			</div>

<?php //********************* fin lista simple ....... jjy ************************** ?>

			<?=html_formulario_fin()?>

		</div>

	<br>










<script type="text/javascript">
	//la buena práctica dice que los scripts deben estar al final del documento mientras sea posible ... jjy 
	function eliminar( codigo_modulo ){
			var r=confirm( 'Mensaje de confirmación para eliminar ' );
				if (r==true){
				 var pagina = "<?=site_url()?>/s/eliminar_modulo/"+codigo_modulo;			  
			  	location.href=pagina;
			  	}
	}


</script>
<style>

.ancho-50-porciento{
	width: 50%;
}
</style>

<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea .... jjy ?>