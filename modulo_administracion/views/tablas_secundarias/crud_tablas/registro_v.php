<?php $this->load->view('encabezado_comun_modulo_v');  


//?>





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
			$titulo 			 = "Registrar Nuevo Modulo";
			$instrucciones = "Ingrese la información solicitada en cada caso y luego haga click sobre el botón Guardar.";
			$editable = TRUE;
		break;

		case 'e': // se intenta EDITAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Editar Registro ";
			$instrucciones = "Guarde la información modificada sólo cuando esté seguro, ya que no podrá deshacer los cambios realizados.";
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

		case 'm': // se intenta MOSTRAR un registro con id = $id_registro .... jjy
			$titulo 			 = "Mostrando Modulos de ".$modulos[$id_registro];
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
				<tr><td>
			<?=html_etiqueta( $instrucciones )?>
				<br>
				<?php if($operacion=='n' || $operacion=='error'){ ?>
	
				<?=html_etiqueta ('NOTA: Al registrar un nuevo modulo este sera deshabilitado para todos los roles dentro del sistema al igual que los permisos que se carguen')?>
					<?php }?> 
				<hr>
				</td></tr>		
	

			<?php if(isset($errores)){?>
			<tr><td>
				<?=html_mensaje( '', $errores, 'error' );?>
			
			</td></tr>
		<?php }?>

			</table>
			<br>

			<?php $parametros = array(
						'enlace'           => site_url().'/s/guardar_modulo',
					
					);

					if($operacion=='e'){
						$parametros = array(
						'enlace'           => site_url().'/s/actualizar_modulo',
					
					);
					}

					?>
			<?=html_formulario_ini( 'f_modulo', $parametros )?>

			<table>
				<tr>
					<td>
						<?php  $parametros = array(
												'etiqueta'                    => 'Nombre: ',
												'clases_adicionales_etiqueta' => 'ancho-120',
												'clases_adicionales'          => 'ancho-300',
												'editable'                    => $editable,
											); 
							if($operacion=='m' || $operacion=='e'){
								$parametros['valor_inicial']=$modulos[$id_registro];
							}
							if(form_error('modulo')){
															
								$parametros['valor_inicial']=set_value('modulo');
								
							}				
							?>
							


						<?=html_input( 'modulo', 'texto', $parametros )?>

						<?php if($operacion=='e'){
								$parametros=array(
												'valor_inicial' => $id_registro,										
											
											); ?>
							<?=html_input( 'codigo_modulo', 'oculto', $parametros )?>
						<?php }?>
						

					</td>
				</tr>
				<tr>
					<td>
						<?php  $parametros = array(
												'etiqueta'                    => 'Descripción: ',
												'clases_adicionales_etiqueta' => 'ancho-120 alinear-arriba',
												'clases_adicionales'          => 'ancho-300',
												'clases'                      => 'ancho-300',
												'editable'                    => $editable,
											); 
							if($operacion=='m'){
								//$parametros['editable']=TRUE;
								//$parametros['parametros_html']='readonly';
								$parametros['clases_adicionales'].=' alto-100';
								$parametros['estilos']='white-space: normal; overflow: auto;';
								$parametros['valor_inicial']=$modulos['descripcion_modulo'];
							}
							
							if($operacion=='e'){
								$parametros['valor_inicial']=$modulos['descripcion_modulo'];
							}
							if(form_error('descripcion_modulo')){
															
								$parametros['valor_inicial']=set_value('descripcion_modulo');
								
							}
											?>
							


						<?=html_input( 'descripcion_modulo', 'textarea', $parametros )?>
					</td>
				</tr>
				<tr>
					<td>
						<?php  $parametros = array(
												'etiqueta'                    => 'Id: ',
												'clases_adicionales_etiqueta' => 'ancho-120',
												'clases_adicionales'          => 'ancho-300',
												'info_ayuda'                  => 'Debe colocar un Id valido correspondiente a la carpeta del modulo que desea registrar por ejemplo (modulo_administracion)...',
												'editable'                    => $editable,
												'valor_inicial'               => 'modulo_ejemplo',
											); 
							if(form_error('id_modulo')){
															
								$parametros['valor_inicial']=set_value('id_modulo');
								
							}
							if($operacion=='m'){
								unset($parametros['info_ayuda']);
								$parametros['valor_inicial']=$modulos['id_modulo'];
							}
							if($operacion=='e'){
								$parametros['valor_inicial']=$modulos['id_modulo'];
							}


											?>
							


						<?=html_input( 'id_modulo', 'texto', $parametros )?>
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

			<?php if($operacion=='n' || $operacion=='error'|| $operacion=='e'){ 
				if($operacion=='e'){
				?>
			
			<br>
			<?php }?>
			<table id="tabla_permisos" >
				<tbody>
					<tr class='permisos-base'>
						<td>
							<?php  $parametros = array(
													'etiqueta'                    => 'Permiso: ',
													'clases_adicionales_etiqueta' => 'ancho-120 alinear-arriba',
													'clases_adicionales'          => 'ancho-300 alinear-arriba',
													'clases'					  => 'permisos-nuevos',												
													'editable'                    => $editable,
													
												); 
								
												?>

							<?=html_input( 'permiso', 'texto', $parametros )?>

					
							<?php 	$parametros = array(
											'enlace'          => 'javascript:agregar_permiso();',
											'icono'           => 'icon-plus-sign',	
											'clase_adicional' => 'alinear-arriba',									
											);
							?>
							       <?=html_enlace_boton( 'b_agregar_permiso' , $parametros )?>

							<?php 	$parametros = array(
											'enlace'          => 'javascript:quitar_permiso();',
											'icono'           => 'icon-remove-sign',	
											'clase_adicional' => 'alinear-arriba',											
											);
							?>
							       <?=html_enlace_boton( 'b_quitar_permiso' , $parametros )?>


						</td>
					</tr>
					<?php if(($operacion=='n' || $operacion=='error')|| ($operacion=='e' && empty($permisos))){?>

					<tr>
						<td>

							<?php  $parametros = array(
													'etiqueta'                    => 'Permiso: ',
													'clases_adicionales_etiqueta' => 'ancho-120 alinear-arriba',
													'clases_adicionales'          => 'ancho-300 alinear-arriba',	
													'clases'					  => 'permisos-nuevos',													
													'editable'                    => $editable,
													
												); 
								
												?>

							<?=html_input( 'permiso_', 'texto', $parametros )?>

							
							<?php 	$parametros = array(
											'enlace'          => 'javascript:agregar_permiso();',
											'icono'           => 'icon-plus-sign',	
											'clase_adicional' => 'alinear-arriba',											
											);
							?>
							       <?=html_enlace_boton( 'b_agregar_permiso' , $parametros )?>

							<?php 	$parametros = array(
											'enlace'          => 'javascript:quitar_permiso();',
											'icono'           => 'icon-remove-sign',
											'clase_adicional' => 'alinear-arriba',											
											);
							?>
							       <?=html_enlace_boton( 'b_quitar_permiso' , $parametros )?>


						</td>
					</tr>
					<?php } ?>
					<?php if($operacion=='e' && !empty($permisos)){
						?>
						<hr>
						<div class='ancho-75-porciento'>
							<?=html_etiqueta( 'Recuerde que al editar el nombre de algun permiso debio tomar las medidas necesarias para que el boton asociado a dicho permiso sea cambiado (NOTA: No se podrá borrar un permiso ya cargado)' )?>
							
						</div>
						<hr>

						<?php
	
					foreach ($permisos as $valor) {
						foreach ($valor as $indice => $valor1) {
														
								 $parametros = array(
													'etiqueta'                    => 'Permiso: ',
													'clases_adicionales_etiqueta' => 'ancho-120 alinear-arriba',
													'clases_adicionales'          => 'ancho-300 alinear-arriba',	
													'clases'					  => 'permisos-nuevos',													
													'editable'                    => $editable,
													'valor_inicial'               => $valor1,
													
												); 
								
												

							echo '<tr><td>',html_input( 'permiso_'.$indice, 'texto', $parametros );

						$parametros = array(
											'enlace'          => 'javascript:agregar_permiso();',
											'icono'           => 'icon-plus-sign',	
											'clase_adicional' => 'alinear-arriba',											
											);
						
							  echo html_enlace_boton( 'b_agregar_permiso' , $parametros );

							 	$parametros = array(
											'enlace'          => 'javascript:quitar_permiso();',
											'icono'           => 'icon-remove-sign',
											'clase_adicional' => 'alinear-arriba',											
											);
						
							       echo html_enlace_boton( 'b_quitar_permiso' , $parametros );

							
						echo '</tr></td>';
					
						}
					}
				}?>


				</tbody>
			</table>


			<?php }?>

			<?=html_br()?>






<?php  //********************* fin formulario simple ....... jjy ************************* */ ?>
			
				

			<?=html_formulario_fin()?>

		</div>




<style>
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
	.mensaje-error{
		width: 272px; 
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
	function guardar () {
		$('#f_modulo').submit();
	}	

	function agregar_permiso(){

	
		$("#tabla_permisos tbody tr:eq(0)").clone().removeClass('permisos-base').appendTo("#tabla_permisos tbody");
		var cantidad_input=$("#tabla_permisos input").length;
		cantidad_input=cantidad_input-1;
		 $("#tabla_permisos input:last").attr('name','permiso_'+cantidad_input);
		//$("#tabla_permisos textarea:last").attr('name','descripcion_permiso_'+cantidad_input); //esto se usa para generar las descripciones del permiso para los modulos de forma dinamica
	}

	function quitar_permiso(){
		<?php if($operacion=='e' && isset($permisos)){
			$numeros=count($permisos, COUNT_RECURSIVE);
		?>
		var operacion='<?=$operacion?>';
		var numeros ='<?=$numeros?>';
		<?php
			}
		?>
		var operacion='<?=$operacion?>';
				
	 var trs=$("#tabla_permisos tr").length; 
	 
	 	if(operacion!='e'){
	 		
			 if(trs>2) { // Eliminamos la ultima columna 
			 	$("#tabla_permisos tr:last").remove(); 
			 }
		
		 }
		  if(trs>numeros) { // Eliminamos la ultima columna 
			 	$("#tabla_permisos tr:last").remove(); 
			 }
		

	}



	
</script>





<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>

