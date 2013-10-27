<?php
/**
 * Plantilla-OSTI 1.0.2b - Sep 2013
 * Estructura basada en CodeIgniter para la creación de aplicaciones en el INN-CCS-VE
 * 
 * @author jjyepez - jyepez@inn.gob.ve
 *
 * @package plantilla-osti
 * @version 1.0.2b
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/deed.es
 * 
 */
/* ****************************************************
| Datos sobre la aplicación ...
|
/* ****************************************************/

session_start();

global $config;

$script = $_SERVER['PHP_SELF'];
$base_url = str_replace( '/index.php', '/', $script );

$config ['aplicacion'] = array(

  'plantilla_osti'  => 'v.1.1.2b',
  'id'              => 'SIST01',
  'nombre_completo' => 'Sistema de Apoyo a la Generación de Planes de Menú (v0.1b)',
  'nombre_corto'    => 'SiGesA (CoBi)',
  'version_mayor'   => '0',
  'version_menor'   => '1',
  
  'mostrar_encabezado_gobierno' => TRUE,
  
  'descripcion'     => 'Sistema de Apoyo a la Generación de Planes de Menú para la Dirección de Redes de Alimentación del INN.',
  'mostrar_logo'    => FALSE,
  'mostrar_titulo'  => TRUE,
  'mostrar_portada' => TRUE,
  
  'mostrar_fondos_al_azar' => TRUE,
  'tiempo_sesion'   => "3600", // 5 minutos (60 * 5)

  'entorno'         => 'DESARROLLO', //// 'PRODUCCION'

  'enlaces_apoyo' => array(
      //Solo visibles en entorno de DESARROLLO .... jjy
      array('Iconos FontAwesome',       $base_url . 'libs/font-awesome/lista-iconos.php'),
      array('Glyphicons e Iconos OSTI', $base_url . 'libs/font-awesome/lista-glyphicons.php'),
      array('Clases CSS disponibles',   $base_url . 'libs/font-awesome/lista-clases.php'),
      array('Helper Componentes OSTI',    $base_url . 'docs/autodoc.php?hlpr=componentes_html'),
      array('Helper Control de Usuarios', $base_url . 'docs/autodoc.php?hlpr=control_usuarios'),
      array('Helper Funciones Comunes', $base_url . 'docs/autodoc.php?hlpr=funciones_comunes'),
      array('Ayuda CodeIgniter',        $base_url . 'docs/CodeIgniter/user_guide'),
      array('Google','//www.google.com'),
      array('PHP.net','//www.php.net'),
      array('w3school','//www.w3school.com'),
      array('HTML5','//www.html5please.com'),
  ),
  
  'imagen_portada' => 'fondo-5.png',
  'imagen_fondo' => 'fondo-5.png',
);

if ( ! isset ( $_SESSION ['sesion'] ) ) {
  $_SESSION = array( 'sesion' => array(
      'codigo_usuario' => "",
      'cuh'            => "",
    ),
  );
}
?>
