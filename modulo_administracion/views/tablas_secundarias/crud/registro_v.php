<?php $this->load->view('encabezado_comun_modulo_v');  


//?>
<script src="<?=base_url()?>libs/jquery/jquery.jCombo.min.js"></script>  
	<script type="text/javascript">

		     $(document).ready(function() {				
				var url_base_lista="<?=site_url()?>/comun/listas_anidadas/lista/";
				
           	$("#tipo_tabla").jCombo(url_base_lista+"cobi.t_tipos_tablas/codigo_tipo_tabla/descripcion/-/-/", { 
						initial_text: "-- seleccione tipo de tabla --"
													

				});	
           });


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
			$titulo 			 = "Registrar Nueva Tabla";
			$instrucciones = "Ingrese la información solicitada en cada caso y luego haga click sobre el botón Guardar.";
			$editable = TRUE;
		break;

		case 'e': // se intenta EDITAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Editar Registro ";
			$instrucciones = "Guarde la información modificada sólo cuando esté seguro, ya que no podrá deshacer los cambios realizados.";
			$editable = TRUE;		

		break;

		case 'm': // se intenta MOSTRAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Mostrando tabla";
			$instrucciones = "Los campos no son editables en la operación Mostrar.";

		break;
		
		case 'error': // para manejar la vista cuando se tiene un error editando un registro CV
			$titulo 			 = "Error ";
			$instrucciones = " Verifique la información ingresada.<br>";
			$editable = TRUE;	

			if(form_error('modulo')  or 
			   form_error('descripcion_modulo') or 			   
			   form_error('id_modulo')
			    
			   ){
					$errores  ="";
					$errores .='<div>';
					$errores .= form_error('modulo') ? form_error('modulo') : '';
					$errores .= form_error('descripcion_modulo') ? form_error('descripcion_modulo'): '';
					$errores .= form_error('id_modulo') ? form_error('id_modulo'): '';									
					$errores .='</div>';
					
				}

		

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
						'enlace'           => site_url().'/t/listar',
						'tipo'             => 'boton_glyphicon',
						'clase_iconos'   	 => 'iconos_osti',
						'posicion_icono'   => '2 1',
						'descripcion'      => 'Volver',
					);
		$html_salida .= html_enlace_boton( 'b_volver' , $parametros );

		
		$parametros = array(
						'enlace'           => site_url().'/t/registrar_tabla',
						'icono'            => 'icon-save',
						'descripcion'      => 'Guardar',
						//'clase_adicional'  => 'btn-primary',
					);
		$html_salida .= html_enlace_boton('b_guardar', $parametros );

		$parametros = array(
						'enlace'           => 'javascript:exportar();',
						'icono'            => 'icon-suitcase',
						'descripcion'      => 'Exportar',
					);
		$html_salida .= html_enlace_boton( 'b_exportar' , $parametros );

		echo $html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P
	?>

	</div><?php // fin de la barra-botones-modulo  .... jjy ************************* ?>
	<hr>

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>

		<div>
			<table>
				<tr>
					<td>
					<?=html_etiqueta( $instrucciones )?>				
					</td>
				</tr>
			<?php if(isset($errores)){?>
				<tr>
					<td>
				<?=html_mensaje( '', $errores, 'error' );?>
					</td>
				</tr>
			<?php }?>
			</table>
			<br>
			<?php $parametros = array(
						    'accion'         => site_url().'/t/registrar_tabla',
        					'metodo'         => 'POST',
					
								);

					?>
			<?=html_formulario_ini( 'f_tabla', $parametros )?>

			<table>
				<tr>
					<td>
						<?php  $parametros = array(
												'etiqueta'                    => 'Nombre de la tabla: ',
												'clases_adicionales_etiqueta' => 'ancho-120',
												'clases_adicionales'          => 'ancho-300',
												'editable'                    => $editable,
											); 
							
							?>
							


						<?=html_input( 'nombre_tabla', 'texto', $parametros )?>

					
					</td>
				</tr>
				<tr>
					<td>
						<?php  $parametros = array(
												'etiqueta'                    => 'Tipo de tabla: ',
												'clases_adicionales_etiqueta' => 'ancho-120',
												'clases_adicionales'          => 'ancho-180',
												'editable'                    => $editable,
											); 
							
							?>
							


						<?=html_input( 'tipo_tabla', 'select', $parametros )?>
					
					</td>
				</tr>
			</table>
			

			<?=html_br()?>






<?php  //********************* fin formulario simple ....... jjy ************************* */ ?>
			
				

			<?=html_formulario_fin()?>

		</div>

<div id="mensaje_validacion" name="mensaje_validacion" class="invisible mensaje mensaje-error">
  <span class="msj"></span><hr>
  <p class="sin-margenes"></p>
  <hr><span>Verifique e intente de nuevo</span>
</div>



<style>

#mensaje_validacion {
  top: 10px;
}
 .permisos-base{ 
 	display: none; 
 }
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
	
	.ancho-50-porciento{
	width: 100%;
	max-width: 50% !important;
	}	
	.ancho-75-porciento{
	width: 100%;
	max-width: 75% !important;
	}
</style>

<script>
	

	 $('#f_tabla').validate({ // debe estar fuera de $(document).ready()!!!!!!!! averiguar por qué ???? ... jjy
      rules: {
          nombre_tabla: {
            required: true,
          },
          tipo_tabla: {
             required: true,
          },
        
      },
      messages: {
          nombre_tabla: {
              required: "Debe indicar el Nombre de la Tabla"
          },
          tipo_tabla: {
              required: "Debe indicar la fecha de registro"
            
          }
      
        },
  }); 



	
</script>





<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>

