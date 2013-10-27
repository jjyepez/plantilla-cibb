<h2 class="titulo-seccion normal seguido">Roles Usuarios</h2>
	
	<div class="cerrar-velo-blanco flotado-derecha">
		<a href="javascript:cerrar_velo();"><i class="icon-share icon-flip-horizontal"></i></a>
	</div>
	
	<hr>
	
	<div class="barra-botones-modulo">
		
				
		<?php
			$parametros = array(
						'enlace'           => '#',
						'icono'   => 'icon-reply',
						'descripcion'      => 'Volver',
					);
		?>
		<?=html_enlace_boton( 'b_volver' , $parametros );?>

		<?php
			$parametros = array(
						'enlace'           => '#',
						'icono'   => 'icon-file',
						'descripcion'      => 'Nuevo Rol',
					);
		?>
		<?=html_enlace_boton( 'b_nuevo' , $parametros );?>

		<?php
			$parametros = array(
						'enlace'           => '#',
						'icono'   => 'icon-save',
						'descripcion'      => 'Guardar Rol',
					);
		?>
		<?=html_enlace_boton( 'b_guardar_rol' , $parametros );?>

	</div>
	<hr>
	<div class=" div-instrucciones">
	<?php 

		$instrucciones = 'Seleccione un rol de la lista disponible'; 
	?>
	<?=html_etiqueta( $instrucciones )?>
	</div>


	
	<?=html_br('5px')?>

<div class=" div-instrucciones">

	</div>

	<?php $parametros= array('enlace' => site_url().'/s/registrar_rol' , ); ?>


	<?=html_formulario_ini( 'f_rol', $parametros )?>
	<?=html_br('5px')?>



			<div class="invisible div-nombrerol">
			<?php
			$instrucciones = 'Creancion de un nuevo rol dentro del Sistema.'; 
				?>	
				<?=html_etiqueta( $instrucciones )?>
				<?=html_br('7px')?>

				<?php $parametros = array(
									'etiqueta'                    => 'Nombre del Rol: ',
									'clases_adicionales_etiqueta' => 'ancho-150',
									'clases_adicionales'          => 'ancho-300',
									'editable'                    => 'TRUE',
								);	
								?>	


				<?=html_input( 'nombre_rol', 'texto', $parametros )?>
				<br>
				<?php $parametros = array(
									'etiqueta'                    => 'Descripción Rol: ',
									'clases_adicionales_etiqueta' => 'alinear-arriba ancho-150',
									'clases_adicionales'          => 'ancho-300',
									'editable'                    => 'TRUE',
								);	
								?>	


				<?=html_input( 'descripcion_rol', 'textarea', $parametros )?>




			</div>





				<?php  $colspan = ($informacion_usuario['nivel_rol']==0  ) ? 3 : 2 ; ?>
				<div class="invisible div-emergente">
				<table colspan="<?=$colspan?>" cellspacing="15">
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
										echo '<tr><td><a class="item-nuevo-rol-modulo"rel='.$indice.' value='.$valor.' href="#">',html_input('modulo_nuevo_'.$indice,'buleano',$parametros),' '.$valor.'</a></td></tr>';
										
										}
									?>
								
							</table>
							</div>
						</td>


						<td class="td-ancho">
						<?php $parametros=array('id'=>'etiqueta-permiso-rol');?>	
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
													echo '<tr class="item-nuevo-rol-permiso invisible"rel="'.$indice.'"><td>',html_input('permiso_nuevo_'.$indice1,'buleano',$parametros),html_etiqueta($valor1),'</td></tr>';
												}else{
												echo '<tr class="item-nuevo-rol-permiso invisible"rel="'.$indice.'"><td>',html_etiqueta('No Tiene Permisos Cargados'),'</td></tr>';
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
		
		<?=html_formulario_fin()?>

<?php 


//prp($informacion_usuario);

	$parametros = array(
		'columnas' => array(
			
			'nombre_rol' => "Rol de Usuario",
		),
	);

	?>
	<div class="grid_roles">
	<?=html_grid_simple('grid_1', $roles, $parametros );?>
	</div>







