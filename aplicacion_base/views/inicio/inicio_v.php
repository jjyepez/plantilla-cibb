<section>
   <div class="section ancho-full centrado">

      <?php global $config; ?>
      <?php if ( $config['aplicacion']['mostrar_logo'] ){ ?>

         <div class="img-logo"></div>

      <?php } ?>
      <?php if ( $config['aplicacion']['mostrar_titulo'] ){ ?>

         <h1 class="titulo-portada"><?=$config['aplicacion']['nombre_completo']?></h1>

      <?php } ?>
      <?php if ( $config['aplicacion']['mostrar_portada'] ){ ?>
         
         <div class="img-portada">



         <?php // OJO ... SI LA PORTADA ESTA DESHABILITADA NO SE MOSTRARA EL FORMULARIO DE ACCESO ... considerar más adelante !!! . ...jjy ?>
         <?php
            $parametros = array(
               'mensaje'        => ( isset( $mensaje ) ? $mensaje : '' ),
               'tipo_mensaje'   => ( isset( $tipo_mensaje ) ? $tipo_mensaje : 'amarillo' ),
            );
         ?>
         <?=formulario_acceso_usuarios( 'f_acceso', $parametros )?>

         </div>

      <?php } ?>
      <?php if ( $config['aplicacion']['descripcion'] ){ ?>
         <br><hr>
   		<p>
            <?=$config['aplicacion']['descripcion']?>
   		</p>
      <?php } ?>

	</div>
</section>