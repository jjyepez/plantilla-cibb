<?php global $config, $menus_izquierda_activos; ?>
<?php // NO DEBE HABER NINGUNA LINEA VACIA ANTES DE ESTA SECCION .... ojo ... header!  jjy

  $codigo_usuario = $_SESSION['sesion']['codigo_usuario']; // datos de la sesion!!!! ... jjy
  $cuh            = $_SESSION['sesion']['cuh'];
  
  $sesion_iniciada = FALSE; //fijo para poder avanzar ! ... jjy

  $html_redirect = ""; // en caso de vencerse  la sesion .... jjy

  if ( sesion_activa ( $codigo_usuario, $cuh ) ){ 
    $sesion_iniciada = TRUE; //fijo para poder avanzar ! ... jjy
  } 

?>
<?php 
	if( ! isset($config['sesion']['seccion_activa'] ) ){
		$config['sesion']['seccion_activa'] = "inicio";
	}
	$seccion_activa = $config['sesion']['seccion_activa'];
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8"/>
  <?=$html_redirect?>

  <link rel="stylesheet" type="text/css" href="<?=base_url()?>libs/bootstrap-3/css/bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>libs/font-awesome/css/font-awesome.min.css"> 
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>libs/font-awesome-4/css/font-awesome.min.css"> 

	<title><?=$config['aplicacion']['nombre_corto']?> - <?=$pestanas[$seccion_activa]?></title>
  
  <link rel="stylesheet" type="text/css" href="<?=base_url().'css/estilos.css'?>">

  <link rel="shortcut icon" href="<?=base_url()?>imgs/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?=base_url()?>imgs/favicon.ico" type="image/x-icon">    

	<script src="<?=base_url()?>libs/jquery/jquery.min.js"></script>

  <script>
  $(document).ready(function(){
    <?php 
      $html_fondos = "";
      if ( $config ['aplicacion']['mostrar_fondos_al_azar'] === TRUE ){

        $archivo_img_azar = base_url() . "imgs/fondo-".round(mt_rand(1,5));

        $html_fondos = "
          $('.barra-botones, .img-portada').css({
            'background':'none',
            'background-image':'url(" . $archivo_img_azar .".png)',
            'background-position':'".round(mt_rand(1,1280))."px ".round(mt_rand(1,800))."px',
            'background-size':'1280px 800px'
          });\n";

      } else {
        $html_fondos = "
          $('.barra-botones, .img-portada').css({
            'background':'none',
            'background-position':'center center',
            //'background-size':'1280px 800px'
          });
          $('.barra-botones').css({
            'background-image':'url(".base_url()."imgs/".$config['aplicacion']['imagen_fondo'].")'
          });
          $('.img-portada').css({
            'background-image':'url(".base_url()."imgs/".$config['aplicacion']['imagen_portada'].")'
          });\n";
      }
      echo $html_fondos;
    ?>
  });
  </script>

</head>

<body>

  <header style="z-index:5;">

<?php if ( $config['aplicacion']['mostrar_encabezado_gobierno'] ) { ?>

	<style>
    <?php // OJO ... hay que buscar un mejor lugar para estos estilos !!! .... jjy ********** ?>
    <?php 

      if( 
        ( 
          isset( $config['sesion']['modulo_activo'] ) 
          && isset( $menus_izquierda_activos[$config['sesion']['modulo_activo']] ) 
          && (
            (
              isset ( $menus_izquierda_activos[$config['sesion']['modulo_activo']][0] )
              && $menus_izquierda_activos[$config['sesion']['modulo_activo']][0] != 'sin-menu'
            ) OR (
              ! isset ( $menus_izquierda_activos[$config['sesion']['modulo_activo']][0] )
            )
          )
        ) OR (
          ! isset( $config['sesion']['modulo_activo'] )
        )
      ) { ?>
      .contenedor-principal {top: 140px;}
    <?php } else { ?>
      .contenedor-principal {top: 130px;}
    <?php } ?>
      .contenedor-encabezado{top: 55px;}
    <?php // OJO ... hay que buscar un mejor lugar para estos estilos !!! .... jjy ********** ?>
	</style>

  <div class="encabezado_gobierno">
		<div class="logo_gobierno seguido"></div>
		<div class="logo_especial seguido"></div>
	</div>	

<?php } ?>

  <div class="contenedor-encabezado">

		<div class="cintillo-sup">

			<div class="centrado ancho-maximo">

				<div class="titulo-cintillo flotado-izquierda"><?=$config['aplicacion']['nombre_corto']?> - beta <?=$config['aplicacion']['version_mayor']?>.<?=$config['aplicacion']['version_menor']?></div>

				<div class="flotado-derecha">

          <?php

            if ( sesion_activa ( $codigo_usuario, $cuh ) ){ 
            
              $info_usuario   = informacion_usuario( $codigo_usuario );
              
              $nombre_usuario = $info_usuario['nombres'];
              $rol_usuario = $info_usuario['rol_usuario'];

              $nombre_usuario_cintillo = "<span class='negrita'>" . ucwords( strtolower( $nombre_usuario ) ) . "</span>"
                                       . ' (' . ucwords( strtolower( $rol_usuario ) ).')';
              ?>

              <div style="display:inline-block"><i class="icon-user"></i>&nbsp;&nbsp;<?=$nombre_usuario_cintillo?></div>

              &nbsp;&nbsp;|&nbsp;&nbsp;

              <div style="display:inline-block"><a href="<?=base_url()?>s/cerrar_sesion"><i class="icon-signout"></i> Cerrar sesi&oacute;n</a></div>
          
          <?php } else { ?>
            
              <div style="display:inline-block"><a href="<?=base_url()?>"><i class="icon-signin"></i> Iniciar Sesi&oacute;n</a></div>
          
          <?php } ?>

				</div>

			</div>

		</div>

		<!--nav-->





<!--div class="navbar navbar-default">
  <div class="container ancho-maximo">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="./" class="navbar-brand">Bootstrap</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="./getting-started">Getting started</a>
        </li>
        <li>
          <a href="./css">CSS</a>
        </li>
        <li>
          <a href="./components">Components</a>
        </li>
        <li>
          <a href="./javascript">JavaScript</a>
        </li>
        <li>
          <a href="./customize">Customize</a>
        </li>
      </ul>
    </nav>
  </div>
</div-->





<div class="navbar navbar-inverse navbar-static-top hidden-print">
  <div class="container ancho-maximo">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-reorder fa-lg"></i>
      </button>
      <a class="navbar-brand" href="../"><i class="fa fa-flag"></i> Font Awesome</a>
    </div>

    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="hidden-sm "><a href="../">Home</a></li>
        <li class="hidden-sm">
          <a href="../whats-new/">What's New</a>
        </li>
        <li class="hidden-xs hidden-md hidden-lg">
          <a href="../whats-new/">New</a>
        </li>
        <li><a href="../get-started/">Get Started</a></li>
        <li class="dropdown-split-left active"><a href="../icons/">Icons</a></li>
        <li class="dropdown dropdown-split-right hidden-xs active">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu pull-right">
            <li><a href="../icons/"><i class="fa fa-flag fa-fw"></i>&nbsp; Icons</a></li>
            <li class="divider"></li>
            <li><a href="../icons/#new"><i class="fa fa-rub fa-fw"></i>&nbsp; New Icons in 4.0</a></li>
            <li><a href="../icons/#web-application"><i class="fa fa-camera-retro fa-fw"></i>&nbsp; Web Application Icons</a></li>
            <li><a href="../icons/#form-control"><i class="fa fa-check-square fa-fw"></i>&nbsp; Form Control Icons</a></li>
            <li><a href="../icons/#currency"><i class="fa fa-won fa-fw"></i>&nbsp; Currency Icons</a></li>
            <li><a href="../icons/#text-editor"><i class="fa fa-file-text-o fa-fw"></i>&nbsp; Text Editor Icons</a></li>
            <li><a href="../icons/#directional"><i class="fa fa-hand-o-right fa-fw"></i>&nbsp; Directional Icons</a></li>
            <li><a href="../icons/#video-player"><i class="fa fa-play-circle fa-fw"></i>&nbsp; Video Player Icons</a></li>
            <li><a href="../icons/#brand"><i class="fa fa-github fa-fw"></i>&nbsp; Brand Icons</a></li>
            <li><a href="../icons/#medical"><i class="fa fa-medkit fa-fw"></i>&nbsp; Medical Icons</a></li>
          </ul>
        </li>
        <li class="dropdown-split-left"><a href="../examples/">Examples</a></li>
        <li class="dropdown dropdown-split-right hidden-xs">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu pull-right">
            <li><a href="../examples/">Examples</a></li>
            <li class="divider"></li>
            <li><a href="../examples/#inline">Inline Icons</a></li>
            <li><a href="../examples/#larger">Larger Icons</a></li>
            <li><a href="../examples/#fixed-width">Fixed Width Icons</a></li>
            <li><a href="../examples/#list">List Icons</a></li>
            <li><a href="../examples/#bordered-pulled">Bordered &amp; Pulled Icons</a></li>
            <li><a href="../examples/#spinning">Spinning Icons</a></li>
            <li><a href="../examples/#rotated-flipped">Rotated &amp; Flipped Icons</a></li>
            <li><a href="../examples/#stacked">Stacked Icons</a></li>
            <li><a href="../examples/#bootstrap">Bootstrap 3 Examples</a></li>
            <li><a href="../examples/#custom">Custom CSS</a></li>
          </ul>
        </li>
        <li><a href="../community/">Community</a></li>
        <li><a href="../license/">License</a></li>
      </ul>
      <!--ul class="nav navbar-nav navbar-right">
        <li><a href="http://blog.fontawesome.io">Blog</a></li>
      </ul-->
    </div>

  </div>
</div>








			<!--div class="barra-botones">

				<ul class="botones-barra">
					
					<?php
            $codigo_usuario = $_SESSION['sesion']['codigo_usuario'];
            $cuh = $_SESSION['sesion']['cuh'];
            $deshabilitar_otras = ! sesion_activa( $codigo_usuario, $cuh );

            if ( $codigo_usuario != "" ){
            
              foreach ($pestanas as $id_modulo=>$titulo_modulo) {

                $codigo_modulo = codigo_modulo_segun_id ( $id_modulo );             


                if ( $codigo_modulo != "" ){
                  $parametros = array(
                    'codigo_modulo' => $codigo_modulo,
                    'codigo_usuario' => $codigo_usuario,
                  );
                  $modulo_habilitado = usuario_habilitado_para( $parametros );
                  if ( $modulo_habilitado == "NEGADO" ){
                    unset($pestanas[ $id_modulo ]);
                  }
                }
              }

            }

						$parametros = array(
              'pestanas'          => $pestanas,
              'enlaces'           => $url_enlaces,
              'clases-pestanas'   => "seguido", // ancho-120
              'estilo-pestanas'   => "font-size: 1em; min-width:100px;",
              'id_pestana_activa' => $seccion_activa,
              'deshabilitar_otras'=> $deshabilitar_otras,
            );
					?>
					<?=html_pestanas('',$parametros)?>

				</ul>

			</div-->

		<!--/nav-->

	</div>

  </header>

  <?php /**

    HERRAMIENTAS SOLO PARA EL ENTORNO DE DESARROLLO ...... jjy
  
  ***/ ?>
  <?php if ( $config ['aplicacion']['entorno'] === 'DESARROLLO' ){ 
      $ancho_pestana = 165;
      ?>
      <style>
        #DES_herramientas_desarrolador {
          position: fixed;
          right:-<?=$ancho_pestana+25?>px;
          top: 85px;
          z-index: 9999999;
          width: <?=$ancho_pestana+50+20?>px;
        }
        #DES_herramientas_desarrolador #pestana_herramientas {
          border-radius: 12px 0 0 12px;
          position: absolute;
          top: 0;
          left: 0;
          width: 50px;
          height: 50px;
        }
        #DES_herramientas_desarrolador #contenido_herramientas {
          position: absolute;
          top: 0;
          right:0;
          width: <?=$ancho_pestana?>px;
          height: auto;
          padding: 10px;
          border-radius: 0 0 0 10px;
        }
        #DES_herramientas_desarrolador ul {
          list-style-type: none;
          padding-left: 0;
          margin: 0;
          list-style-position: inside;
        }
        #DES_herramientas_desarrolador a {
          color: white;
        }
        #DES_herramientas_desarrolador .color-fondo-negro{
          background-color: rgba(0,0,0,0.8);
          box-shadow: 0px 2px 5px rgba(0,0,0,0.75);
        }
        #DES_herramientas_desarrolador h3 {
          margin-top: -5px;
          margin-bottom: -5px;
        }
      </style>

      <script>
        $(document).ready(function(){
          $('#DES_herramientas_desarrolador a').attr({target:'_blank', color:'red !important'});

          $('#DES_herramientas_desarrolador').mouseover(function(){
            if( ! $('#DES_herramientas_desarrolador').hasClass("DES_mostrado") ) {
              $('#DES_herramientas_desarrolador').animate({right: "0px" }, {queue: false}).addClass("DES_mostrado");
            }
          });
          $('#DES_herramientas_desarrolador').mouseout(function(){
            if( $('#DES_herramientas_desarrolador').hasClass("DES_mostrado") ) {
              $('#DES_herramientas_desarrolador').animate({right: '-<?=$ancho_pestana+25?>px'}, {queue: false}).removeClass("DES_mostrado");
            }
          });
        });
      </script>
      <div id="DES_herramientas_desarrolador" class="color-blanco">
        <div id="pestana_herramientas" class="color-fondo-negro">
          <div class="icon-stack icon-2x" style="margin-left:-3px;">
            <i class="icon-check-empty icon-stack-base color-amarillo"></i>
            <i class="icon-magic"></i>
          </div>
        </div>
        <div id="contenido_herramientas" class="color-blanco color-fondo-negro letra-condensada">
          <h3>Plantilla - OSTI</h3>
          <small class="color-amarillo">Enlaces de apoyo</small>
          <ul>
          <?php
            foreach ( $config['aplicacion']['enlaces_apoyo'] as $info_enlace ) {
              echo "<li>- <a href='".$info_enlace[1]."'>".$info_enlace[0]."</a></li>\n";
            }
          ?>
          </ul>
        </div>
      </div>

  <?php } 
  /**
    FIN DE HERRAMIENTAS DE DESARROLLO ........ BUSCAR UN MEJOR LUGAR PARA COLOCAR ESTAS LINEAS ..... jjy
  **/?>

	<div class="contenedor-principal">
