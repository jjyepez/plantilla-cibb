<?php 
extract($modulos);
?>


<table cellspacing="15">
	<tr>
		<td class="td-ancho">
			<?php $parametros=array('id'=>'etiqueta-permiso');?>	
			<?=html_etiqueta( 'Modulos:','',$parametros )?>
			<div class="lista-overflow">
				<table>
					<?php 
				
				foreach ($modulos as $valor) {	
					echo '<tr><td><a class="item-modulos"rel="'.$valor['codigo_modulo'].'" value="'.$valor['nombre_modulo'].'" href="#">	'.$valor['nombre_modulo'].'</a></td></tr>';
				
				}
				?>
		
				</table>
			</div>
		</td>

		<td class="td-ancho">	
		<?php $parametros=array('id'=>'etiqueta-modulo');?>	
		<?=html_etiqueta( 'Permios Modulo','',$parametros )?>
			<div class="lista-overflow">
				<table>
					<?php 

				foreach ($permisos as $valor) {	
					echo '<tr><td class="item-permisos invisible"rel="'.$valor['codigo_modulo'].'"  href="#">	'.$valor['nombre_permiso'].'</td></tr>';
				
				}
				?>
		
				</table>
			</div>
		</td>


	<tr>
	</table>

<?php




