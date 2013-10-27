<?php
  global $menus_izquierda_activos;
  
  $mostrar_menu = FALSE;

  if ( array_key_exists( $seccion, $menus_izquierda_activos ) ) {

    $mostrar_menu = TRUE;

    $ancho_maximo = "ancho-cuerpo-con-menu-izquierdo ";
    $estilo_adicional = "";

    if ( isset ( $menus_izquierda_activos[$seccion][0] ) ) {

      if ( $menus_izquierda_activos [$seccion][0] != 'sin-menu' ) {

        $ancho_maximo .= 'ancho-con-'.$menus_izquierda_activos[$seccion][0];
        $estilo_adicional = "alto-97-porciento";
        
      } else {

        $mostrar_menu = FALSE;
        $ancho_maximo = "ancho-full ";
      }
    }

  } else {

    $ancho_maximo = "ancho-full ";

  }
?>
  <div class="flotado-derecha seguido <?=$ancho_maximo?>">

    <iframe id = "frame_modulo" name = "frame_modulo" 
        style = "position:absolute; left:0, top:0; bottom:0; height: 100%;"
        class="<?=$ancho_maximo?> <?=$estilo_adicional?>"
        frameborder = "0" 
        src = "<?=$url_modulo?>" >
    </iframe>

  </div>
