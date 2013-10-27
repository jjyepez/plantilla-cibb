<?php

/* ****************************************************
| Datos sobre la aplicación ...
|
/* ****************************************************/

session_start();
global $config;

$script_modulo = $_SERVER['SCRIPT_FILENAME'];
$id_modulo = substr( str_replace( realpath('.') . '/', '', $script_modulo ), 0, -4);

$config['modulo']=array(
    'id'              => $id_modulo,    
    'nombre_completo' => 'Aquí se debe colocar el nombre completo del modulo',
    'nombre_corto'    => 'NombreCortoMod',
    'descripcion'     => 'En esta variable de configuración debe indicarse o definirse la descripción del módulo, si fuera el caso de que no existe la información en la base de datos.',
    'version_mayor'   => 'N',
    'version_menor'   => 'n',
);

/**
  Esta variable fue mudada acá desde config.php -- para automatizar su definición en base a otra variable de configuración ... jjy
**/
$config['index_page'] = $config['modulo']['id'].'.php';

?>