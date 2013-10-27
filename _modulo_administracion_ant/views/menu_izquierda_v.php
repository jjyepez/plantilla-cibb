<?php
  $arr_aux = explode('/', $_SERVER['REQUEST_URI'] );
  $id_modulo = $arr_aux[ count( $arr_aux ) -1 ];
?>


<li class="activo" ><a href="<?=site_url().''?>">Configuraciones Generales</a></li>

<li><a href="<?=site_url().'s/cm/modulo_administracion' ?>">Usuarios del sistema</a></li>

<li><a href="<?=site_url().''?>">Tablas Secundarias</a></li>

<li><a href="<?=site_url().''?>">Tablas de Apoyo</a></li>


