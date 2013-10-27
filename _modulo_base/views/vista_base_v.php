<?php 
	$this->load->view('encabezado_comun_modulo_v') 
	// continual en el bloque <head> ... ..jy ?>
<?php /**
	A PARTIR DE AQUI INICIA EL CONTENIDO EXCLUSIVO DE ESTA VISTA ... jjy 
**/?>

	<script type="text/javascript">
		// algun código aqui ..... jjy
	</script>

</head>
<?php //************************************* </head><body> ********************************* ?>
<body>
	<h2 class = "titulo-seccion">T&iacute;tulo</h2>
	<hr>

		<?php
			$parametros = array(
							'enlace'		 => site_url().'',
							'destino'		 => '_self',
							'tipo'           => 'boton_icono',
							'icono'          => 'icon-save icon-large ',
							'tooltip'        => 'Guardar',
							'estilo_adicional'=>'btn-primary',
						);
		?>
		<?=html_enlace_boton( 'bt_buscar', $parametros )?>

		<?php
			$parametros = array(
							'enlace'		 => 'http://google.com',
							'destino'		 => '_self',
							'tipo'           => 'boton_icono',
							'icono'          => 'icon-reply icon-large',
							'tooltip'		 => 'Volver'
						);
		?>
		<?=html_enlace_boton( 'bt_buscar', $parametros )?>

		&nbsp;Este es un texto de ejemplo

		<div class="btn-group flotado-derecha">

			<?php
				$parametros = array(
								'enlace'		 => 'http://google.com',
								'destino'		 => '_self',
								'tipo'           => 'boton_icono',
								'icono'          => 'icon-chevron-left',
								'tooltip'		 => 'Ir al anterior'
							);
			?>
			<?=html_enlace_boton( 'bt_buscar', $parametros )?>

			<?php
				$parametros = array(
								'enlace'		 => 'http://google.com',
								'destino'		 => '_self',
								'tipo'           => 'boton_icono',
								'icono'          => 'icon-chevron-right',
								'tooltip'		 => 'Ir al anterior'
							);
			?>
			<?=html_enlace_boton( 'bt_buscar', $parametros )?>

		</div>

		<hr>

		<div>
			
			<h3>Contenido del módulo</h3>
			<hr>

			<form>
				<?=html_etiqueta('Fecha de Registro:','fecha',array('clases_adicionales'=>'seguido ancho-120'))?>
				<?=html_input('fecha','fecha',array('editable'=>TRUE))?>
				<a href="#"><i class="sin-outline icon-info-sign"></i></a>
			</form>

		</div>




















<?php /**
	HASTA AQUI LLEGA EL CONTENIDO EXCLUSIVO DE ESTA VISTA ... jjy
**/?>
<?php 
	$this->load->view('pie_comun_modulo_v') 
	// finaliza los bloques </body> y </head> ... ..jy 
?>