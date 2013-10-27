<?php $this->load->view('encabezado_comun_modulo_v');  

$codigo_estatus = ($operacion=='e') ? $informacion['codigo_estatus'] : $codigo_estatus=($operacion=='error'|| $operacion=='errore') ?  $codigo_estatus :  0   ;

//?>

 <script src="<?=base_url()?>libs/jquery/jquery.jCombo.min.js"></script>  
	<script type="text/javascript">

		     $(document).ready(function() {				
				var url_base_lista="<?=site_url()?>/comun/listas_anidadas/lista/";
				
           	$("#estatus").jCombo(url_base_lista+"seguridad.t_estatus_usuarios/codigo_estatus_usuarios/nombre_estatus/-/-/", { 
						initial_text: "-- seleccione un estatus --",
						selected_value: "<?=$codigo_estatus?>"								

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
			$titulo 			 = "Mostrando Registro ";
			$instrucciones = "Los campos no son editables en la operación Mostrar.";

		break;
		
		case 'error': // para manejar la vista cuando se tiene un error con un registro nuevo CV
			$titulo 			 = "Error ";
			$instrucciones = " Verifique la información ingresada.<br>";
			$editable = TRUE;	

			if(form_error('usuario')  or 
			   form_error('correo') or    
			   form_error('contrasena') or 
			   form_error('repetir_contrasena') or 
			   form_error('estatus')or
			   form_error('rol')
			   ){
					$errores  ="";
					$errores .='<div>';
					$errores .= form_error('usuario') ? form_error('usuario') : '';
					$errores .= form_error('correo') ? form_error('correo'): '';
					$errores .= form_error('contrasena') ? form_error('contrasena'): '';
					$errores .= form_error('repetir_contrasena') ? form_error('repetir_contrasena'): '';
					$errores .= form_error('estatus') ? form_error('estatus'): '';	
					$errores .= form_error('rol') ? form_error('rol'): '';
					$errores .='</div>';
					
				}

				if(form_error('nombre_rol')or
					form_error('descripcion_rol')){				
					$errores  ="";
					$errores .= form_error('nombre_rol') ? form_error('nombre_rol'): '';
					$errores .= form_error('descripcion_rol') ? form_error('descripcion_rol'): '';
					$errores .='</div>';
				}


			$parametros_error=array('clases' => 'mensaje-error centrado', );
		
				
		break;

			case 'errore': // para manejar la vista cuando se tiene un error editando un registro CV
			$titulo 			 = "Error ";
			$instrucciones = " Verifique la información ingresada.<br>";
			$editable = TRUE;	

			if(form_error('usuario')  or 
			   form_error('correo') or 			   
			   form_error('estatus')or
			    form_error('rol') or
			    form_error('nombre_rol')
			   ){
					$errores  ="";
					$errores .='<div>';
					$errores .= form_error('usuario') ? form_error('usuario') : '';
					$errores .= form_error('correo') ? form_error('correo'): '';
					$errores .= form_error('estatus') ? form_error('estatus'): '';					
					$errores .= form_error('rol') ? form_error('rol'): '';					
					$errores .='</div>';
					
				}



			$parametros_error=array('clases' => 'mensaje-error centrado', );

				
		break;

	
	}

?>


	<h2 class = "titulo-seccion"><?=$titulo?></h2> 
	<?php if(isset($mensaje_error)){ ?> <h3 class="mensaje-error"><?=$mensaje_error?></h3> <?php }if(isset($mensaje_exito)){?> <h3 class="mensaje-exito"> <?=$mensaje_exito?></h3> <?php }?>
	
	<hr>
	
	<div class="barra-botones-modulo">

	<?php //************************* BARRA DE BOTONES ..... jjy ************************* ?>
	<?php
	
		$html_salida = ""; // buffer !!!

		$parametros = array(
						'enlace'           => site_url().'/s/listar_registros',
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
				</td></tr>
			

				<?php if(($operacion=='error' || $operacion=='errore') && isset($errores)){?>
				<tr><td>
				<?=html_etiqueta( $errores,'',$parametros_error )?>
				</td></tr>

				<?php }?>
			</table>

			<?php $parametros = array(
						'enlace'           => site_url().'/s/guardar_registro',
					
					);

				if($operacion=='e'|| $operacion=='errore'){
					$parametros= array('enlace' => site_url().'/s/editar_registro' , );
				}

					?>
			<?=html_formulario_ini( 'f_registro', $parametros )?>

			<?=html_br()?>
<hr>
<?php 	//********************* formulario simple ....... jjy ************************** ?>

				<table>
					<tr>
						<td>
							<?php					
								$parametros = array(
												'etiqueta'                    => 'Nombre Usuario: ',
												'clases_adicionales_etiqueta' => 'ancho-150',
												'clases_adicionales'          => 'ancho-300',
												'info_ayuda'                  => 'Debe colocar el Usuario que usara para el acceso al sistema ...',
												'editable'                    => $editable,
												);
								if(isset($informacion)){
									$parametros['valor_inicial']=$informacion['nombre_usuario'];
								}
								if($operacion=='e' || $operacion=='errore'){
									unset($parametros['info_ayuda']);
									$parametros['editable']= FALSE;
								}
								if($operacion=='error' || $operacion=='errore'){
															
									$parametros['valor_inicial']=set_value('usuario');
								
								}

							?>
							<?=html_input( 'usuario', 'texto', $parametros )?>
						

						</td>					
					</tr>
					
					<tr>
						<td>
							<?php
								$parametros = array(
												'etiqueta'                    => 'Correo Electronico: ',
												'clases_adicionales_etiqueta' => 'ancho-150',
												'clases_adicionales'          => 'ancho-300',
												'editable'                    => $editable,
											);
									if(isset($informacion)){
									$parametros['valor_inicial']=$informacion['correo_electronico'];									
									}
								if($operacion=='error' || $operacion=='errore' ){								
									$parametros['valor_inicial']=set_value('correo');
							
								}



								?>
							<?=html_input( 'correo', 'texto', $parametros )?>
						</td>					
					</tr>
					
					<tr>
						<td>
							<?php
								if($operacion=='n' || $operacion=='error'){
									$parametros = array(
												'etiqueta'                    => 'Contraseña: ',
												'clases_adicionales_etiqueta' => 'ancho-150',
												'editable'                    => $editable,
												);
									if($operacion=='error'){								
										$parametros['valor_inicial']=set_value('contrasena');
							
								}	

								?>
								 <?=html_input( 'contrasena', 'password', $parametros );?>
								 
								 <?php }?>
						&nbsp;&nbsp; 
							<?php 
								if($operacion=='n' || $operacion=='error'){
									$parametros = array(
												'etiqueta'                    => 'Repetir Contraseña: ',
												'clases_adicionales_etiqueta' => 'ancho-140',
												'editable'                    => $editable,
												);
									if($operacion=='error'){								
										$parametros['valor_inicial']=set_value('repetir_contrasena');
							
									}	
								?>

										<?=html_input( 'repetir_contrasena', 'password', $parametros );?>
							<?php }?>

						</td>
											
					</tr>

					<tr>
						<td>
							<?php
								$parametros = array(
												'etiqueta'                    => 'Estatus: ',
												'clases_adicionales_etiqueta' => 'ancho-150',
												'editable'                    => $editable,
												);
								
								if(isset($informacion)){
									$parametros['valor_inicial']=$informacion['estatus_usuario'];									
								
								}
							
								?>
							<?=html_input( 'estatus', 'select', $parametros )?>						

						</td>					
					</tr>
				</table>
				&nbsp;&nbsp; &nbsp;&nbsp; 
				<table collspan="2">
					<tr>					
						<td>
							  <?php 		
				  				$parametros = array(
										'etiqueta'                    => 'Rol: ',
										//'clases_adicionales_etiqueta' => 'ancho-150',										
										'parametros_html'			  => 'readonly',
										//'estilos' => 'width: 100px;',						
										'editable'            => $editable,

										'funciones_especiales' => array(
											array( 'accion_dialogo_rol', 'icon-list-alt', array( 'enlace' => 'javascript:mostrar_dialogo();' ) ),
										),
									  );
				  				if($operacion=='m' || $operacion=='e'){
				  					$parametros['valor_inicial']=ucfirst(strtolower($informacion['rol_usuario']));
				  				}		
				  				if($operacion=='error' || $operacion=='errore'){
				  					$parametros['valor_inicial']=set_value('rol');
				  				?>
							

								<?php
								}
							  ?>
							  <?=html_input( 'rol', 'texto_funcion_especial', $parametros )?>

							  	<?php if($operacion=='error' || $operacion=='errore' ){

				  						$parametros=array('valor_inicial' => $codigo_rol, );

				  				?>
							  		<?=html_input( 'codigo_rol', 'oculto',$parametros)?>

							  	<?php $parametros=array('valor_inicial' => $codigo_usuario, ); ?>

							  		<?=html_input( 'codigo_usuario', 'oculto', $parametros)?>

								<?php }elseif($operacion=='n'){ ?> 
								 <?=html_input( 'codigo_rol', 'oculto')?>
							
								<?php }?>

								<?php  if($operacion=='e' ){
										
										$parametros=array('valor_inicial' => $informacion['codigo_rol'], );
										?>
									<?=html_input( 'codigo_rol', 'oculto', $parametros)?>

								<?php 	$parametros=array('valor_inicial' => $informacion['codigo_usuario'], );
										?>
									<?=html_input( 'codigo_usuario', 'oculto', $parametros)?>						
									
								<?php }?>

					
						<td id="permiso-rol" class="invisible">								
						</td>
					</tr>
					

				</table>






<?php //********************* fin formulario simple ....... jjy ************************* */ ?>
				<br>
				

			<?=html_formulario_fin()?>

		</div>

	<br>


<div class="velo-blanco invisible">
	<div id="dialogo" class="invisible">Dialogo Roles</div>
</div>



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
</style>
<?php 
//esto lo usaremos para poder agregar la clase al dialogo emergente segun el rol 
//ya que depediendo del rol podemos necesitar agrandar el div emergente
$datos=datos_usuario_actual(); 
$datos=informacion_usuario($datos['codigo_usuario']); 
$nivel=$datos['nivel_rol']; 


?>
<script>



	function guardar () {
		$('#f_registro').submit();
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
			$('#b_guardar_rol').addClass('invisible');
			var nivel='<?=$nivel?>';
			if(nivel == 0){
			$('#dialogo').css({width: "700px" });		
			}
	
			
			$('.item-grid').click(function(){
				seleccionar_rol( $(this).attr('rel') );
				seleccionar_codigo_rol( $(this).attr('name') );				
				cerrar_velo();
				mostrar_rol($(this).attr('name') );


			});

			$("#b_nuevo").click(function (){
				$(".div-emergente").removeClass("invisible");
				$(".div-nombrerol").removeClass("invisible");
				$(".div-instrucciones").addClass("invisible");
				$(".grid_roles").addClass("invisible");
				$('#b_volver').removeClass('invisible');
				$('#b_nuevo').addClass('invisible');
				$('#b_guardar_rol').removeClass('invisible');
			
			});

			$("#b_volver").click(function (){
				$(".div-emergente").addClass("invisible");
				$(".div-nombrerol").addClass("invisible");
				$(".div-instrucciones").removeClass("invisible");
				$(".grid_roles").removeClass("invisible");
				$('#b_volver').addClass('invisible');
				$('#etiqueta-permiso-rol').text('Permisos Modulo');
				$('#b_nuevo').removeClass('invisible');
				$('#b_guardar_rol').addClass('invisible');
			
			});

			$('.item-nuevo-rol-modulo').click(function(){
					var codigo_permiso= $(this).attr('rel');
					var modulo = $(this).attr('value');
				

					
				$('.item-nuevo-rol-permiso').addClass('invisible');	
				$('.item-nuevo-rol-permiso[rel='+codigo_permiso+']').removeClass('invisible');
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



			$('#b_guardar_rol').click(function(){
				$('#f_rol').submit(); 	
			});


		});
	}


	

	
	function cerrar_velo(){
		$('.velo-blanco').addClass('invisible');
		$('#permiso-rol').removeClass('invisible');
	}
	function seleccionar_rol( rol ){		
		$('#rol').val(rol);
	}
	function seleccionar_codigo_rol( codigo_rol ){	
		$('#codigo_rol').val(codigo_rol);
	}
	function mostrar_rol (codigo_rol) {
			$.ajax({
						url: "<?=site_url()?>/s/mostrar_permisos_rol/"+codigo_rol,
						context: document.body

					}).done (  
						function( data ){
						document.getElementById('permiso-rol').innerHTML = data;
							$('.permiso-rol').removeClass('invisible');


							$('.item-modulos').click(function(){
								     desahabilitar( $(this).attr('rel') );										
									


									});
								$('.item-modulos').click(function(){
										
										var modulo = $(this).attr('value');					
									
									$('#etiqueta-modulo').text('Permisos Modulo '+modulo+'');
								
								

								});

							function desahabilitar (codigo_permiso) {
									$('.item-permisos').addClass('invisible');
									$('.item-permisos[rel='+codigo_permiso+']').removeClass('invisible');
							}


						}
					);


			
	}



</script>





<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>

