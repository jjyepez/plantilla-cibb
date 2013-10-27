<?php
  $arr_aux = explode('/', $_SERVER['REQUEST_URI'] );
  $id_modulo = $arr_aux[ count( $arr_aux ) -1 ];
?>


<li target ="frame_modulo"><a href="<?=site_url().'s/cm/modulo_administracion'?>">Configuraciones Generales</a></li>

<li><a  target ="frame_modulo" href="<?=site_url().'modulo_administracion.php/s/listar' ?>">Usuarios del sistema</a></li>

<li><a target ="frame_modulo"  href="<?=site_url().'modulo_administracion.php/t/listar'?>">Tablas Secundarias</a></li>

<li  target ="frame_modulo"><a href="<?=site_url().'s/cm/modulo_administracion'?>">Tablas de Apoyo</a></li>



