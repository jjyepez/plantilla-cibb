<?php $this->load->view('encabezado_comun_modulo_v') ?>
</head> <?php // se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>
<body>

<?php
	$titulo = "";
	$instrucciones = "";
	$editable = FALSE;
	

	switch ( $operacion ){
		case 'n': // se intenta crear un registro NUEVO .... jjy
			$titulo 			 = "Registro de Alimentos". $id_registro;;
			$instrucciones = "Indique los datos asociados al Alimento.";
			$editable = TRUE;
		break;

		case 'e': // se intenta EDITAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Editar Registro " . $id_registro;
			$instrucciones = "Guarde la información modificada sólo cuando esté seguro, ya que no podrá deshacer los cambios realizados.";
			$editable = TRUE;
		break;

		case 'm': // se intenta MOSTRAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Mostrando Registro " . $id_registro;
			$instrucciones = "Los campos no son editables en la operación Mostrar.";
		break;
	}

?>

	<h2 class = "titulo-seccion"><?=$titulo?></h2>
	<hr></hr
	
	<div class="barra-botones-modulo">

		<?php
				$html_salida = ""; 

		$parametros = array(
				'enlace'           => site_url().'/s/listar_registros',
				'tipo'             => 'boton_glyphicon',
				'clase_iconos'     => 'iconos_osti',
				'posicion_icono'   => '2 1',
				'descripcion'      => 'Volver',
			  );
		$html_salida .= html_enlace_boton( 'b_volver' , $parametros );

			 if($operacion=='n' || $operacion=='e') {
			$parametros = array(
							'enlace'           => 'javascript:guardar();',
							'icono'            => 'icon-save',
							'descripcion'      => 'Guardar',
							'clase_adicional'  => 'btn-primary',
						);
		$html_salida .= html_enlace_boton('b_guardar', $parametros );
		}
		
			$html_salida .= '<div class="flotado-derecha">';

	

		echo $html_salida; 
		?>

	</div>
	
	<hr>

	<?php //************************* Contenido del modulo ..... jjy ************************* ?>
	<?=html_etiqueta( $instrucciones )?>
				<?php 
					if ($operacion=='n'){
							$parametros=array(

								'enlace' =>  site_url().'/s/insertar_alimentos',
							);

						}
				?>
			<?=html_formulario_ini( 'formulario', $parametros )?>

			<?=html_br()?>

<?php //********************* formulario simple ....... ************************** ?>


		<table >
			<tr>
				<td colspan="2">
					<?php
					$parametros = array(
					'etiqueta' 				     => 'Categoría del Alimento: ',
					'clases_adicionales'		  => 'requerido',
					'clases_adicionales_etiqueta' => 'ancho-150',
					'estilos' 	=> 'width: 400px;',
					'editable' =>$editable,
					'info_ayuda'	  => 'Debe colocar la  Categoría del Alimento',
					'funciones_especiales'   => array(
								 array( 'accion_dialogo_1', 'icon-list-alt',
								 array( 'enlace' => 'javascript:alert("especial_1");' ) ),
									),
										
								);
					if ($operacion =='m'||$operacion=='e' ){ 
					$parametros['valor_inicial'] =$informacion_alimento['categoria_alimento'];
}


					?>
					<?=html_input( 'categoria_alimento', 'texto_funciones_especiales', $parametros )?>

				</td>
			
				
				<td>
					<?php
						$parametros = array(
								'etiqueta'   		          => 'Código del Alimento: ',
								'estilos' 					  => 'width: 120px;',
								'clases_adicionales_etiqueta' => 'ancho-130',
								'editable'					  => FALSE,
								);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['codigo_alimento'];
}

					?>
					<?=html_input( 'codigo_alimento', 'texto', $parametros )?>
				</td>

	
			</tr>

			<tr>
			</tr>


			<tr>
				
				<td colspan="2">
					<?php
						$parametros = array(
								'etiqueta'   		              => 'Nombre del Alimento: ',
								'clases_adicionales_etiqueta' 	  => 'ancho-150',
								'clases_adicionales'		  	  => 'requerido',
								'estilos' 					   	  => 'width: 420px;',
								'info_ayuda'				      => 'Debe colocar el nombre del Alimento',
								'editable'						  => $editable,
								);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['nombre_alimento'];
					}


					?>
					<?=html_input( 'nombre_alimento', 'texto', $parametros )?>
				</td>

				<td>
					<?php
						$parametros = array(
								'etiqueta' 					  => 'Color del Alimento: ',
								'clases_adicionales_etiqueta' => 'ancho-130',
								'estilos' 					  => 'width: 60px;',
								'editable'					  => $editable,
								'funciones_especiales'        => array(
										array( 'accion_dialogo_1', 'icon-list-alt',
								 		array( 'enlace' => 'javascript:alert("especial_1");' ) ),
								),
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['codigo_color'];
					}


					?>
					<?=html_input( 'color_alimento', 'texto_funciones_especiales', $parametros )?>
				</td>
			</tr>

			<tr>
			</tr>

			<tr >
						
				<td colspan="3">

					<?php
						$parametros = array(
								'clases_adicionales'		  => 'requerido',
								'estilos' 					  => 'width: 10px;',
							//	'editable'					  => $editable,

											);
					?>

					<?=html_input( '', 'checkbox', $parametros )?>	

					<?php 

						$parametros =Array(
								'etiqueta' 						=> 'Es un derivado de:',
								'clases_adicionales'		  	=> 'requerido',
								'clases_adicionales_etiqueta' 	=> 'ancho-130',
								'estilos' 						=> 'width: 740px;',
								'editable' 						=>$editable,
								'funciones_especiales'       	=> array(
												array( 'accion_dialogo_1', 'icon-list-alt',
										 		array( 'enlace' => 'javascript:alert("especial_1");' ) ),
										),
							);
					
					?>

					<?=html_input('derivado','texto_funciones_especiales',$parametros)?>

				</td>

			</tr>

			<tr>
			</tr>


			<tr>
				<td>
					<?php
						$parametros = array(
										'etiqueta'  					=> 'Unidad de Medida Venta: ',
										'clases_adicionales' 			=> '',
										'estilos' 	=> 'width: 120px;',
										'clases_adicionales_etiqueta' 	=> 'ancho-150',
										'editable'	=> $editable,
										'funciones_especiales'        	=> array(
												array( 'accion_dialogo_1', 'icon-list-alt', array( 'enlace' => 'javascript:alert("especial_1");' ) ),
										),
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['codigo_unidad_medida_venta'];
					}


					?>
					<?=html_input( 'codigo_2', 'texto_funciones_especiales', $parametros )?>
				</td>

				<td>
					<?php
						$parametros = array(
										'etiqueta'  				  => 'Equivalente en gramos: ',
										'clases_adicionales_etiqueta' => 'ancho-150',
										'estilos' 					  => 'width: 120px;',
										'editable'					  => $editable,
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['equivalente_gramo_venta'];
					}
					?>
					<?=html_input( 'codigo_n', 'texto', $parametros )?>
					<?=html_etiqueta( 'g')?>
				</td>

				<td>
					<?php
						$parametros = array(
										'etiqueta'  				  => 'Factor de Desecho: ',
										'clases_adicionales_etiqueta' => 'ancho-130',
										'estilos' 					  => 'width: 120px;',
										'editable'					  => $editable,
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['factor_desecho'];
					}
					?>
					<?=html_input( 'factor_desecho', 'texto', $parametros )?>
				</td>

			</tr>
		
		</table>

					<?=html_br()?>

		<?php //********************* pestanas ************************** ?>

					<?php

						$pestanas = array(
					      	'TCA'		 	  =>'Tabla de Composición',
					      	'precios'		  =>'Precios proveedores',
					    );
					    $url_enlaces = array( 
					      	'inicio'    	  => '#',
					    ); 
						$parametros = array(
			              'pestanas'          => $pestanas,
			              'enlaces'           => $url_enlaces,
			              'clases-pestanas'   => "seguido", // ancho-120
			              'estilo-pestanas'   => "font-size: 1em; min-width:80px;",
			              'id_pestana_activa' => 'inicio',
			            );
						
					?>
					<?=html_pestanas('tabs_tca',$parametros)?>			
				
					<?=html_br()?>
		<table >

					<?=html_etiqueta( 'Indique los datos asociados al alimento (en base a 100g)')?>
					<?=html_br()?>
				<hr>

		<tr >
				<td>
					<?php
						$parametros = array(
										'etiqueta'   		            => 'Calorías: ',
										'clases_adicionales_etiqueta' 	=> 'ancho-200',
										'estilos' 						=> 'width: 70px;',
										'editable'						=> $editable,									
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['cantidad_caloria'];
					}
					?>
					<?=html_input( 'cantidad_caloria', 'texto', $parametros )?>
					<?=html_etiqueta( 'calorías')?>						           
				</td>
	<td  rowspan="6">
		<div aling='top'>

      <table class='html-lista'>


					<?=html_etiqueta( 'Micronutrientes y otros componentes')?>	
					<br>		
	
				<?php
//prp($micronutrientes_alimento);
				if ($operacion=='n') {

					
					echo'<tr> <td>';
					
					$parametros = array(
							'clases_adicionales_etiqueta' => 'ancho-150',
							'estilos' 					  => 'width: 100px;',
							'editable' 					  =>$editable,
							'funciones_especiales'        => array(
									array( 'accion_dialogo_1', 'icon-list-alt',
							 		array( 'enlace' => 'javascript:alert("especial_1");' ) ),
												),
											);
					if ($operacion=='m'||$operacion=='e') {
						$parametros['valor_inicial']=$valor['descripcion'];
						# code...
					}
					
					echo html_input( 'descripcion_micronutriente', 'texto_funciones_especiales', $parametros );
					
			echo'</td><td>';
					
					$parametros = array(
							'clases_adicionales_etiqueta'	 => 'ancho-150',
							'estilos' 					     => 'width: 100px;',
							'editable'						 => $editable,
						);
					if ($operacion=='m'||$operacion=='e') {
						$parametros['valor_inicial']=$valor['cantidad_micronutriente'];
						# code...
					}
					
			echo html_input( 'cantidad_micronutriente', 'texto', $parametros );					
			
			echo'</td><td>';

			$parametros = array(
						'clases_adicionales_etiqueta' => 'ancho-150',
						'estilos' 	=> 'width: 100px;',
						'editable'		=> $editable,	
				);
				if ($operacion=='m'||$operacion=='e') {
						$parametros['valor_inicial']=$valor['descripcion_unidad_de_medida'];
						# code...
					}

					
			echo html_input( 'descripcion_unidad_de_medida', 'select', $parametros );



			echo'</td><td>';

					$parametros = array(
							'clases_adicionales_etiqueta' 	=> 'ancho-150',
							'estilos' 						=> 'width: 100px;',
							'editable' 						=>$editable,
							'funciones_especiales'        	=> array(
									array( 'accion_dialogo_1', 'icon-plus-sign', 
										array( 'enlace' => 'javascript:alert("especial_1");' ) ),
									array( 'accion_dialogo_1', 'icon-remove', 
										array( 'enlace' => 'javascript:alert("especial_1");' ) ),

												),
											);
					
					echo html_input( 'categoria_alimento', 'texto_funciones_especiales', $parametros );		
			echo '</td></tr>';
			echo'<table>';

					# code...
				}
				if($operacion=='m'||$operacion=='e'){



					foreach ($micronutrientes_alimento as $valor) {
						# code...
					
											
			echo'<tr> <td>';
					
					$parametros = array(
							'clases_adicionales_etiqueta' => 'ancho-150',
							'estilos' 					  => 'width: 100px;',
							'editable' 					  =>$editable,
							'funciones_especiales'        => array(
									array( 'accion_dialogo_1', 'icon-list-alt',
							 		array( 'enlace' => 'javascript:alert("especial_1");' ) ),
												),
											);
					if ($operacion=='m'||$operacion=='e') {
						$parametros['valor_inicial']=$valor['descripcion'];
						# code...
					}
					
					echo html_input( 'descripcion_micronutriente', 'texto_funciones_especiales', $parametros );
					
			echo'</td><td>';
					
					$parametros = array(
							'clases_adicionales_etiqueta'	 => 'ancho-150',
							'estilos' 					     => 'width: 100px;',
							'editable'						 => $editable,
						);
					if ($operacion=='m'||$operacion=='e') {
						$parametros['valor_inicial']=$valor['cantidad_micronutriente'];
						# code...
					}
					
					echo html_input( 'cantidad_micronutriente', 'texto', $parametros );					
			
			echo'</td><td>';


			if($operacion!='m'||$operacion=='e') {
				# code...
			
					
					$parametros = array(
								'clases_adicionales_etiqueta' => 'ancho-150',
								'estilos' 	=> 'width: 100px;',
								'editable'										=> $editable,
								);

							
					
					echo html_input( 'descripcion_unidad_de_medida', 'select', $parametros );

			echo'</td><td>';

					$parametros = array(
							'clases_adicionales_etiqueta' 	=> 'ancho-150',
							'estilos' 						=> 'width: 100px;',
							'editable' 						=>$editable,
							'funciones_especiales'        	=> array(
									array( 'accion_dialogo_1', 'icon-plus-sign', 
										array( 'enlace' => 'javascript:alert("especial_1");' ) ),
									array( 'accion_dialogo_1', 'icon-remove', 
										array( 'enlace' => 'javascript:alert("especial_1");' ) ),

												),
											);
					
					echo html_input( 'categoria_alimento', 'texto_funciones_especiales', $parametros );		
			echo '</td></tr>';
			}	
				}	
			}
					?>
		</table>
	</div>




	</td>
		</tr>		
			<tr >
				<td>
					<?php
						$parametros = array(
										'etiqueta'   		              => 'Proteínas: ',
										'clases_adicionales_etiqueta'     => 'ancho-200',
										'estilos' 					      => 'width: 70px;',
										'editable'						  => $editable,
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['cantidad_proteina'];
					}
					?>
					<?=html_input( 'cantidad_proteina', 'texto', $parametros )?>
					<?=html_etiqueta( 'gramos')?>
				</td>
			</tr >
			<tr>
				<td>
					<?php
						$parametros = array(
										'etiqueta'   		          => 'Grasas: ',
										'clases_adicionales_etiqueta' => 'ancho-200',
										'estilos' 					  => 'width: 70px;',
										'editable'					  => $editable,
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['cantidad_grasa'];
					}
					?>
					<?=html_input( 'cantidad_grasa', 'texto', $parametros )?>
					<?=html_etiqueta( 'gramos')?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						$parametros = array(
										'etiqueta'   		              => 'Carbohidratos Disponibles: ',
										'clases_adicionales_etiqueta' => 'ancho-200',
										'estilos' 	=> 'width: 70px;',
										'editable'										=> $editable,
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['cantidad_carbohidrato_disponible'];
					}
					?>
					<?=html_input( 'cantidad_carbohidrato_disponible', 'texto', $parametros )?>
					<?=html_etiqueta( 'gramos')?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
						$parametros = array(
										'etiqueta'   		          => 'Carbohidratos Totales: ',
										'clases_adicionales_etiqueta' => 'ancho-200',
										'estilos' 			   		  => 'width: 70px;',
										'editable'				      => $editable,
									);
					if ($operacion =='m'||$operacion=='e'){ 
					$parametros['valor_inicial'] =$informacion_alimento['cantidad_carbohidrato_total'];
					}
					?>
					<?=html_input( 'cantidad_carbohidrato_total', 'texto', $parametros )?>
					<?=html_etiqueta( 'gramos')?>
				</td>
			   	
			</tr>
	
		</table>



			

<?php //********************* fin formulario simple ....... jjy ************************* */ ?>
				

		<?=html_formulario_fin ( $parametros = array () )?>

	</div>

		<?=html_br()?>


		<script>

		function guardar(){
			$('#formulario').submit();
		}



		</script>


<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>
