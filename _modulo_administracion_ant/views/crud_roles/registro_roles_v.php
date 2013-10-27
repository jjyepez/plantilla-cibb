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
			$titulo 			 = "Editar Rol";
			$instrucciones = "Modifique los campos a continuación segun sus necesidades";
			$editable = TRUE;
			extract($modulos_rol);
		break;

		case 'm': // se intenta MOSTRAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Mostrando Modulos de ".$modulos[$id_registro];
			$instrucciones = "Los campos no son editables en la operación Mostrar.";

		break;

		case 'error': // para manejar la vista cuando se tiene un error con un registro nuevo CV
		$titulo 			 = "Error ";
		$instrucciones = " Verifique la información ingresada.<br>";
		$editable = TRUE;	

		if(form_error('nombre_rol')){				
					$errores  ="";
					$errores .='<div>';
					$errores .= form_error('nombre_rol') ? form_error('nombre_rol'): '';
					$errores .='</div>';
				}


			$parametros_error=array('clases' => 'mensaje-error centrado', );

		break;	
	}

?>

	<h2 class = "titulo-seccion"><?=$titulo?></h2>
		<?php if(isset($mensaje_error)){ ?>
		<?php /* <h3 class="mensaje-error"><?=$mensaje_error?></h3> <?php }if(isset($mensaje_exito)){?> <h3 class="mensaje-exito"> <?=$mensaje_exito?></h3> */ ?>
		<?=html_mensaje( '', $mensaje_error, 'error' );?>
	<?php }?>
	<?php if(isset($mensaje_exito)){ ?>
		<?php /* <h3 class="mensaje-error"><?=$mensaje_error?></h3> <?php }if(isset($mensaje_exito)){?> <h3 class="mensaje-exito"> <?=$mensaje_exito?></h3> */ ?>
		<?=html_mensaje( '', $mensaje_exito, 'exito' );?>
	<?php }?>
		<?php if(isset($errores)){ ?>
		<?php /* <h3 class="mensaje-error"><?=$mensaje_error?></h3> <?php }if(isset($mensaje_exito)){?> <h3 class="mensaje-exito"> <?=$mensaje_exito?></h3> */ ?>
		<?=html_mensaje( '', $errores, 'error' );?>
	<?php }?>



	<hr>
	
	<div class="barra-botones-roles">

	<?php //************************* BARRA DE BOTONES ..... jjy ************************* ?>
	<?php
	
		$html_salida = ""; // buffer !!!

		$parametros = array(
						'enlace'           => site_url().'/s/listar_roles',
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
	<hr>
			<br>

			<?php 
				if($operacion=='e'){
				$parametros = array(
						'enlace'           => site_url().'/s/actualizar_rol',
					
					);
				}

				if($operacion=='n' || $operacion=='error'){
				$parametros = array(
						'enlace'           => site_url().'/s/registrar_rol/roles',
					
					);
				}
				

					?>
			<?=html_formulario_ini( 'f_registro_rol', $parametros )?>

			

			<table>
				<tr>
					<td>
						<?php	
								if($operacion=='e'){
									$parametros = array(
																				
												'valor_inicial' => $informacion_rol['codigo_rol'],
												);
									?>
										<?=html_input( 'codigo_rol', 'oculto', $parametros )?>
								<?php

								}


								$parametros = array(
												'etiqueta'                    => 'Nombre Rol: ',
												'clases_adicionales_etiqueta' => 'ancho-150',
												'clases_adicionales'          => 'ancho-300',												
												'editable'                    => $editable,
												);
								if($operacion=='e'){
									$parametros['valor_inicial']   = $informacion_rol['nombre_rol'];
									$parametros['editable'] =FALSE;
								}
							?>
							<?=html_input( 'nombre_rol', 'texto', $parametros )?>
						
					</td>
				</tr>
				<tr>
					<td>
						<?php					
								$parametros = array(
												'etiqueta'                    => 'Descripción Rol: ',
												'clases_adicionales_etiqueta' => 'ancho-150 alinear-arriba',
												'clases_adicionales'          => 'ancho-300',
												'clases'					  => 'ancho-300',												
												'editable'                    => $editable,
												);
								if($operacion=='e'){
									$parametros['valor_inicial']=$informacion_rol['descripcion_rol'];
								}
							?>
							<?=html_input( 'descripcion_rol', 'textarea', $parametros )?>

					</td>
				</tr>
			</table>


				<?php  $colspan = ($informacion_usuario['nivel_rol']==0  ) ? 3 : 2 ; ?>
				<div>
				<table colspan="<?=$colspan?>" cellspacing="15" class="ancho-400">
					<tr>

						<?php if($informacion_usuario['nivel_rol']==0){ ?>
						<td class="td-ancho">							
						<?=html_etiqueta( 'Sistemas:' )?>
							<div class="lista-overflow">
							<table >
								<tr>
									<td>
										<?=$codigo_sistema?>
									</td>
							    </tr>
							</table>
							</div>
						</td>		
							
						<?php }?>
					
						<td class="td-ancho"> 
						
						<?=html_etiqueta( 'Modulos:' )?>
							<div class="lista-overflow">
							<table>
							<?php   
										
										foreach ($modulos as $indice => $valor) {
												$parametros = array(
															'valor_inicial'   => $indice,
															'clases'          =>'modulo_seleccion'
															);
											if($operacion=='e'){
												foreach ($modulos_rol as $valor_modulo_rol) {
													
													if($valor_modulo_rol['codigo_modulo']==$indice){
														$parametros['parametros_html']='CHECKED';
													}
									              
												}
											}
										
										echo '<tr><td><a class="item-rol-modulo"rel='.$indice.' value='.$valor.' href="#">',html_input('modulo_nuevo_'.$indice,'buleano',$parametros),' '.$valor.'</a></td></tr>';
										$parametros=array();
										}
									?>
								
							</table>
							</div>
						</td>


						<td class="td-ancho">
						<?php 	$parametros=array('id'=>'etiqueta-permiso-rol');?>	
						<?=html_etiqueta( 'Permisos:','',$parametros )?>
							<div class="lista-overflow">
							<table>
							<?php 									
										foreach ($permisos as  $indice =>$valor) {
											foreach ($valor as  $indice1 =>$valor1) {
												if($valor1!='VACIO'){
													$parametros = array(
																	'valor_inicial'   => $indice1,
																	//'parametros_html' =>'CHECKED',
																	'clases' =>'permiso_'.$indice,
																	);
													if($operacion=='e'){
														foreach ($permisos_rol as $valor_permiso_rol) {
															if($valor_permiso_rol['codigo_permiso']==$indice1){
																$parametros['parametros_html']='CHECKED';
															}
										              	
														}
													}
													
													echo '<tr class="item-rol-permiso invisible"rel="'.$indice.'"><td>',html_input('permiso_nuevo_'.$indice1,'buleano',$parametros),html_etiqueta($valor1),'</td></tr>';
												}else{
												echo '<tr class="item-rol-permiso invisible"rel="'.$indice.'"><td>',html_etiqueta('No Tiene Permisos Cargados'),'</td></tr>';
												}
											}
										}
								
									?>
							</table>
							</div>
						</td>
					</tr>
				</table>
			</div>



			<?=html_br()?>
<hr>


			






<?php //********************* fin formulario simple ....... jjy ************************* */ ?>
			
				

			<?=html_formulario_fin()?>

		</div>

	<br>

<style>
 
 .lista-overflow{
		width: 200px;
		height:80px;
		overflow: auto;
		border: 1px solid #DDDDDD;
	} 

  .td-ancho{
  	width:10%;
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

	.ancho-50-porciento{
	width: 100%;
	max-width: 50% !important;
	}	
</style>	

<script>

function guardar(){
	$('#f_registro_rol').submit();
}



$('.item-rol-modulo').click(function(){
					var codigo_permiso= $(this).attr('rel');
					var modulo = $(this).attr('value');
				

					
				$('.item-rol-permiso').addClass('invisible');	
				$('.item-rol-permiso[rel='+codigo_permiso+']').removeClass('invisible');
				$('#etiqueta-permiso-rol').text('Permisos Modulo '+modulo+'');
			
			

			});

$('.modulo_seleccion').click(function(){
				
					var codigo_modulo= $(this).attr('value');
					
				if($('#modulo_nuevo_'+codigo_modulo+':checkbox').is(':checked')){
					$('.permiso_'+codigo_modulo+':checkbox').prop('checked',true);
				}else{				
				$('input.permiso_'+codigo_modulo+':checkbox').prop('checked',false);		
			   }
		

			});




</script>



<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>

