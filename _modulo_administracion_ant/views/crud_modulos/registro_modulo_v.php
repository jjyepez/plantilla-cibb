<?php $this->load->view('encabezado_comun_modulo_v');  


//?>

 <script src="<?=base_url()?>libs/jquery/jquery.jCombo.min.js"></script>  
	<script type="text/javascript">

	
	</script>




</head> <?php // se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>
<body>

<?php
	/**
	PREPARANDO EL COMPORTAMIENTO DE LA VISTA EN FUNCION DE LA OPERACION SOLICITADA .... jjy
	**/ 

	$titulo = "";
	$instrucciones = "";
	$editable = FALSE;
	// SE DETERMINA LA OPERACION A REALIZAR Y SE CONFIGURA LA VISTA ...... jjy
	// es recomendable volver a verificar los permisos del usuario antes de continuar ..... jjy ... OJO
	switch ( $operacion ){
		case 'n': // se intenta crear un registro NUEVO .... jjy
			$titulo 			 = "Registro Nuevo";
			$instrucciones = "Ingrese la información solicitada en cada caso y luego haga click sobre el botón Guardar.";
			$editable = TRUE;
		break;

		case 'e': // se intenta EDITAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Editar Registro ";
			$instrucciones = "Guarde la información modificada sólo cuando esté seguro, ya que no podrá deshacer los cambios realizados.";
			$editable = TRUE;

		break;

		case 'm': // se intenta MOSTRAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Mostrando Modulos de ".$modulos[$id_registro];
			$instrucciones = "Los campos no son editables en la operación Mostrar.";

		break;
		
		


	
	}

?>

	<h2 class = "titulo-seccion"><?=$titulo?></h2>
	<hr>
	
	<div class="barra-botones-modulo">

	<?php //************************* BARRA DE BOTONES ..... jjy ************************* ?>
	<?php
	
		$html_salida = ""; // buffer !!!

		$parametros = array(
						'enlace'           => site_url().'/s/listar_modulos',
						'tipo'             => 'boton_glyphicon',
						'clase_iconos'   	 => 'iconos_osti',
						'posicion_icono'   => '2 1',
						'descripcion'      => 'Volver',
					);
		$html_salida .= html_enlace_boton( 'b_volver' , $parametros );

		if($operacion!='m'){
		$parametros = array(
						'enlace'           => 'javascript:guardar();',
						'icono'            => 'icon-save',
						'descripcion'      => 'Guardar',
						//'clase_adicional'  => 'btn-primary',
					);
		$html_salida .= html_enlace_boton('b_guardar', $parametros );}

		/*$parametros = array(
						'enlace'           => 'javascript:exportar();',
						'icono'            => 'icon-suitcase',
						'descripcion'      => 'Exportar',
					);
		$html_salida .= html_enlace_boton( 'b_exportar' , $parametros );*/

		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>
	<hr>

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>

		<div>
			<table>
				<tr><td>
			<?=html_etiqueta( $instrucciones )?>
				</td></tr>		
			</table>

			<br>

			<?php $parametros = array(
						'enlace'           => site_url().'/s/guardar_registro',
					
					);

				

					?>
			<?=html_formulario_ini( 'f_demo', $parametros )?>

			<table>
				<tr>
					<td>
						<?php  $parametros = array(
												'etiqueta'                    => 'Modulo: ',
												'clases_adicionales_etiqueta' => 'ancho-80',
												'clases_adicionales'          => 'ancho-300',
												'editable'                    => $editable,
											); 
							if($operacion=='m'){
								$parametros['valor_inicial']=$modulos[$id_registro];
							}
											?>
							


						<?=html_input( 'modulo', 'texto', $parametros )?>

					</td>
				</tr>
				<tr>
					<td>
						<br>
					</td>
				</tr>

				<?php if($operacion=='m'){
					foreach ($permisos as $valor) {
						foreach ($valor as $indice => $valor1) {
								 $parametros = array(
												'etiqueta'                    => 'Permisos: ',
												'clases_adicionales_etiqueta' => 'ancho-80',
												'clases_adicionales'          => 'ancho-300',
												'editable'                    => $editable,
												'valor_inicial'               => $valor1,
											); 
							
							echo '<tr><td>',html_input('permisos','texto',$parametros),'</tr></td>';
						}
					}
				}?>

			</table>
			<?=html_br()?>
<hr>
<?php 	//********************* formulario simple ....... jjy ************************** ?>

			






<?php //********************* fin formulario simple ....... jjy ************************* */ ?>
			
				

			<?=html_formulario_fin()?>

		</div>

	<br>



<div class="velo-blanco invisible">
	<div id="dialogo" class="invisible">asda sdasd asda</div>
</div>

<style>
 
 .lista-overflow{
		width: 100%;
		height:80px;
		overflow: auto;
		border: 1px solid #DDDDDD;
	} 

  .td-ancho{
  	width:10%;
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
		width: 600px;
		height: 350px;
		border: 1px solid #ccc;
		margin: 0 auto;
		/*top: 50%;*/
		margin-top: 50px;
		border-radius: 7px;
		box-shadow: 3px 3px 20px rgba(0,0,0,0.25);
		padding: 10px;
	}
	.mensaje-error{
		width: 272px; 
	}
</style>

<script>
	function guardar () {
		alert('Desarrollo');//$('#f_demo').submit();
	}



	function mostrar_dialogo(){
		$('.velo-blanco').removeClass('invisible');
		$.ajax({
			url: "<?=site_url()?>/s/mostrar_dialogo_roles/n",
			context: document.body
		})
		.done( function( data ){

			document.getElementById('dialogo').innerHTML = data;
			$('#dialogo').removeClass('invisible');
			$('#b_volver').addClass('invisible');
			
			$('.item-grid').click(function(){
				seleccionar_rol( $(this).attr('rel') );
				seleccionar_codigo_rol( $(this).attr('name') );
				cerrar_velo();
			});


			$("#b_nuevo").click(function (){
				$(".div-emergente").removeClass("invisible");
				$(".grid_roles").addClass("invisible");
				$('#b_volver').removeClass('invisible');
			
			});

			$("#b_volver").click(function (){
				$(".div-emergente").addClass("invisible");
				$(".grid_roles").removeClass("invisible");
				$('#b_volver').addClass('invisible');
			
			});

		});
	}
	function cerrar_velo(){
		$('.velo-blanco').addClass('invisible');	
	}
	function seleccionar_rol( rol ){		
		$('#rol').val(rol);
	}
	function seleccionar_codigo_rol( codigo_rol ){	
		$('#codigo_rol').val(codigo_rol);
	}


</script>





<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>

