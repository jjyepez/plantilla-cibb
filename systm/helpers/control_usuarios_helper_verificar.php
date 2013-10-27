<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Control-Usuarios 1.0b - Sep 2013
 * Helper con los métodos que validan la permisología de los usuarios
 * 
 * @author jjyepez <jyepez@inn.gob.ve>
 *
 * @package Control de Usuarios 1.0
 * @version 1.0b
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/deed.es
 * 
 */

if( ! function_exists('formulario_acceso_usuarios') ) {
  
  function formulario_acceso_usuarios( $id, $parametros = array() ){
    //# @descripcion Verifica si NO hay una sesion activa para mostrar el formulario de acceso
    // parametros esperados
    $codigo_usuario = "";
    $mensaje = "";
    $tipo_mensaje = "";
    
    extract( $parametros );

    $codigo_usuario = $_SESSION['sesion']['codigo_usuario'];
    $cuh            = $_SESSION['sesion']['cuh'];

    // OJO ... esta función se debe crear correctamente ..... .. jjy
    $html_salida = "";
    $html_salida .= html_mensaje( '', $mensaje, $tipo_mensaje );
    $sesion_activa = sesion_activa( $codigo_usuario, $cuh );

    if ( ! $sesion_activa ){ // NO SE HA INICIADO SESION PARA ESTE USUARIO ..... jjy

      $parametros = array(
        'accion' => site_url() . 's/iniciar_sesion',
        'metodo' => 'POST',
      );
      $html_salida .= html_formulario_ini( $id, $parametros );

      $html_salida .= html_mensaje( '', $mensaje, $tipo_mensaje );

      $html_salida .= html_br( '50px' );
      $html_salida .= "<div class='alto-220 color-fondo-blanco-traslucido'>";
      $html_salida .= html_br('15px');
      $html_salida .= "<table class='alinear-centro'>";

      $html_salida .= "<tr><td>";

      $html_salida .= html_etiqueta( 'Ingrese sus datos para iniciar sesión', '', array ( 'clases_adicionales' => 'negrita' ) );
      $html_salida .= html_br( '15px' );

      $html_salida .= "</td></tr>";
      $html_salida .= "<tr><td>";

      $parametros = array(
        'valor_inicial' => $cuh,
      );
      $html_salida .= html_input( 'cuh', 'oculto', $parametros );

      $parametros = array(
        'etiqueta'                    => "Usuario:",
        'info_ayuda'                  => "Nombre de usuario suministrado por el administrador del sistema",
        'clases_adicionales_etiqueta' => 'ancho-100 alinear-izquierda',
        'clases'                      => 'ancho-150',
        'editable'                    => TRUE,
        'valor_inicial'               => 'usuario', //SOLO PARA PRUEBAS ........ OJO .... jjy
      );
      $html_salida .= html_input('nombre_usuario', 'texto', $parametros );

      $html_salida .= "</td></tr>";
      $html_salida .= "<tr><td>";

      $parametros = array(
        'etiqueta'                    => "Contraseña:",
        'info_ayuda'                  => "Contraseña de acceso suministrada por el administrador del sistema",
        'clases_adicionales_etiqueta' => 'ancho-100 alinear-izquierda',
        'clases'                      => 'ancho-150',
        'enlace_ENTER'                => "javascript:enviar_formulario('".$id."');",
        'valor_inicial'               => '123456', //SOLO PARA PRUEBAS ........ OJO .... jjy
      );
      $html_salida .= html_input('contrasena', 'password', $parametros );

      $html_salida .= "</td></tr>";
      $html_salida .= "<tr><td><hr class='ancho-300 centrado'>";
      $html_salida .= html_br( '7px' );
      $html_salida .= html_sangria( '75px' );
      $html_salida .= '<div class="ancho-150 seguido alinear-izquierda">';

      $parametros = array(
              'enlace'           => "javascript:enviar_formulario('".$id."');",
              'icono'            => 'icon-signin',
              'descripcion'      => 'Acceder',
              'clase_adicional'  => 'btn-primary',
            );
      $html_salida .= html_enlace_boton( 'b_acceder' , $parametros );

      $html_salida .= "</div></td></tr>";
      $html_salida .= "<tr><td>";
      $html_salida .= html_br( '7px' );
      $html_salida .= html_sangria( '75px' );
      $html_salida .= '<div class="ancho-150 seguido alinear-izquierda">';
      
      $parametros = array(
              'enlace'           => site_url().'s/olvide_contrasena',
              'texto'            => 'Olvidé mi contraseña.',
            );
      $html_salida .= html_enlace( 'e_olvide_contrasena' , $parametros );


      $html_salida .= "</div></td></tr>";

      $html_salida .= "</table></div>\n";

      $html_salida .= "<script type='text/javascript'>
                          function enviar_formulario( id_formulario ){
                            $( '#'+ id_formulario ).submit();
                          }
                       </script>\n";
      
      $html_salida .= html_formulario_fin();

    } else { // YA LA SESION FUE INICIADA Y ESTA ACTIVA ....... jjy

      $parametros = array(
        'valor_inicial' => $cuh,
      );
      $html_salida .= html_input( 'cuh', 'oculto', $parametros );

    }

    return $html_salida;
  }
}

if ( ! function_exists( 'datos_usuario_actual' ) ) {
  function datos_usuario_actual(){

    $salida = array();
    
    if ( isset( $_SESSION['sesion'] ) 
      && isset( $_SESSION['sesion']['codigo_usuario'] ) 
      && trim( $_SESSION['sesion']['codigo_usuario'] ) != "" 
      ) {

        $salida['codigo_usuario'] = $_SESSION['sesion']['codigo_usuario'];
        $salida['cuh']            = $_SESSION['sesion']['cuh'];

    } else {

      $salida = array( 'ERROR' => 'No se ha iniciado la sesión' );

    }
    return $salida;
  }
}

if( ! function_exists( 'informacion_usuario' ) ) {
  
  function informacion_usuario( $codigo_usuario, $parametros = array() ){
    $CI =& get_instance();
    $CI->load->model( '../../aplicacion_base/models/seguridad/control_usuarios_m' );

    //# @descripcion Devuelve la información de la tabla t_usuarios asociado al usuario indicado.
    $nombre_usuario = "";

    extract( $parametros ); unset( $parametros );

    /**
    // OJO ... esta función se debe crear correctamente ..... .. jjy
    **/
    $info_usuario = $CI->control_usuarios_m->informacion_usuario( array( 'codigo_usuario' => $codigo_usuario ) );

    return $info_usuario;
  }

}

if( ! function_exists('validar_usuario_contrasena') ) {

  function validar_usuario_contrasena( $nombre_usuario, $contrasena ){
    //# @descripcion Permite verificar si el usuario y contraseña suministrados son válidos y correctos para acceder al sistema
    
    $rsp = comprobar_tablas_usuarios( FALSE );

    if ( $rsp !== "OK" ){
      die('Error al validar datos usuario: ' . $rsp );
    }
    /**
    // OJO ... esta función se debe crear correctamente ..... .. jjy
    **/
    $salida = FALSE;
    if ( $nombre_usuario == 'usuario' && $contrasena == '123456' ) { 
      $salida['rsp'] = 'OK'; 
      $salida['codigo_usuario'] = 'US0001';
    } else {
      $salida['rsp'] = 'ERROR'; 
      $salida['mensaje'] = 'El Usuario o la contraseña no son válidos.';
    }
    return $salida;
  }

}

if( ! function_exists( 'sesion_activa' ) ) {

  function sesion_activa( $codigo_usuario, $cuh = "" ) {
    global $config;

    $CI =& get_instance();
    $CI->load->model( 'seguridad/control_usuarios_m' );

    //# @descripcion Permite comprobar en todo momento si la sesión que inició el usuario aún está activa 
    /**  
    // OJO ... esta función se debe crear correctamente ..... .. jjy
    **/
    $salida = FALSE;

    $parametros = array(
      'tiempo_vencido' => $config['aplicacion']['tiempo_sesion'], // 30 segundos !!!!! solo para pruebas
    );
    $rsp = $CI->control_usuarios_m->sesion_iniciada( $codigo_usuario, $cuh, $parametros);
    if ( $rsp == 'OK' ){
      $CI->control_usuarios_m->actualizar_momento_sesion( $codigo_usuario, $cuh, fecha_hora_local("Y-m-d H:i:s") );
      $salida = TRUE;
    } else {
      $_SESSION['sesion'] = array( 'codigo_usuario' => '', 'cuh' => '' );
    }

    return $salida;
  }

}

if( ! function_exists( 'usuario_habilitado_para' ) ) {

  function usuario_habilitado_para( $parametros ){
    //# @descripcion Permite verificar si el usuario indicado está habilitado para: Sistema: SIS, Modulo: MOD, Funcionalidad: FUN, TODOS: *
  
    //Instancia de Controller
    $CI       =& get_instance();
    $CI->load->model( '../../aplicacion_base/models/seguridad/control_usuarios_m' );

    // los parametros esperados son:
    //# @parametro array $parametros segun lista >>//
    $codigo_sistema       = "";
    $codigo_modulo        = "";
    $codigo_permiso       = "";
    $codigo_rol           = "";
    //<<
    extract( datos_usuario_actual() ); // se extraen los datos de usuario antes de los parametros por si se deben sobrescribir .... jjy
    extract( informacion_usuario( $codigo_usuario ) );
    extract( $parametros );

    if ( trim( $codigo_permiso ) != "" && trim ( $codigo_modulo ) == "" ) {
      $arr_codigos = explode('.', $codigo_permiso );
      $codigo_modulo = trim( $arr_codigos[0] );
      $codigo_permiso = trim( $arr_codigos[1] );

      $parametros = array(
        'codigo_modulo'  => $codigo_modulo,
        'codigo_permiso' => $codigo_permiso,
      );
    }
    $rsp = $CI->control_usuarios_m->usuario_habilitado_para( $codigo_usuario, $parametros );
    
    return $rsp;
  }

}

if ( ! function_exists( 'crear_usuario ') ) {
  function crear_usuario ( $datos ){
    $id = NULL;
    $codigo_usuario = "US" . mt_srand() * 1000;
    $nombre_usuario = "usuario";
    $contrasena = "123456";
    $correo_electronico = "";
    $codigo_persona = NULL;
    $codigo_clasificacion = NULL;
    $codigo_estatus = "ST0001"; // Nuevo

    extract( $datos );

    //Instabcia de Controller
    $CI       =& get_instance();
    $CI->load->model( 'seguridad/control_usuarios_m');

    $datos_usuario = array(
      'id'                   => $id,
      'codigo_usuario'       => $codigo_usuario,
      'nombre_usuario'       => $nombre_usuario,
      'contrasena'           => $contrasena, /// OJO: Cambiar por ... md5( $contrasena ), ... jjy
      'correo_electronico'   => $correo_electronico,
      'codigo_persona'       => $codigo_persona,
      'codigo_clasificacion' => $codigo_clasificacion,
      'codigo_estatus'       => $codigo_estatus,
    );

    $rsp = $CI->control_usuarios->crear_usuario( $datos_usuario ); 

  }
}

if ( ! function_exists( 'comprobar_tablas_usuarios ') ) {
  function comprobar_tablas_usuarios ( $crear_si_no_existen = TRUE, $parametros = array() ){
    $crearlas_si_no_existen      = TRUE;
    // si el siguiente parametro es TRUE se ejecutará el SCRIPT de respaldo sin datos que esta en /data .. script_tablas_seguridad.sql.php
    
    $crear_desde_script_respaldo = TRUE; // tiene PRIORIDAD sobre los demás parametros!!!! .... jjy
    /** 
      C U I D A D O !!!  ... SOLO PARA USO DE RESTRINGIDO ... !!!!!   ... jjy
    **/

    extract( $parametros );

    $salida = "";

    //Instancia de Controller
    $CI       =& get_instance();
    $CI->load->model( 'seguridad/control_usuarios_m' );

    if ( $crear_desde_script_respaldo === TRUE ) { // se recupera respaldo de todo el esquema seguridad .... jjy CUIDADO!
      /** 
        C U I D A D O !!!  ... SOLO PARA USO DE RESTRINGIDO ... !!!!!   ... jjy
      **/
      $parametros = array(
        'crear_desde_script_respaldo' => TRUE,
      );
      $rsp = $CI->control_usuarios_m->crear_tablas_usuarios ( '', $parametros );
      if( $rsp != 'OK' && $rsp != "YA EXISTE ESQUEMA seguridad" ) {
        die ( "Error inesperado al crear las tablas de usuarios ... (" . $rsp . ")" );
      } else {
        $rsp = "OK";
      }

    } else { // se verifica tabla a tabla ... jjy

      $tablas = array(
        'seguridad.t_usuarios',
        'seguridad.t_roles',
        'seguridad.t_modulos',
        'seguridad.t_permisos',
        'seguridad.t_usuarios_roles',
        'seguridad.t_usuarios_modulos',
        'seguridad.t_usuarios_permisos',
      );
      
      // se recorren y verifican las tablas una a una ...
      foreach( $tablas as $tabla ){

        if ( ! table_exists( $tabla ) ) {
          $rsp = $CI->control_usuarios_m->crear_tablas_usuarios ( $tabla );
          if( $rsp != 'OK' ) {
            die ( "Error inesperado al crear la tabla $tabla ... (" . $rsp . ")" );
          }
        }

      }
    } // fin tabla a tabla ... jjy
    $salida = $rsp;

    return $salida;

  }
}

function cerrar_sesion_usuario( $codigo_usuario, $cuh ){
  // se eliminan las variables de sesión y el registro de la tabla t_sesiones_usuarios
  $CI =& get_instance();
  $CI->load->model( 'seguridad/control_usuarios_m' );

  $salida = "";

  $CI->control_usuarios_m->eliminar_sesion_usuario( $codigo_usuario, $cuh );

  $_SESSION['sesion'] = array( 'codigo_usuario' => '', 'cuh' => '' ); // se reinician las variables de session;

  $salida = 'OK';
  return $salida;
}

function codigo_modulo_segun_id( $id_modulo ){
  // OJO ESTE METODO DEBE DEFINIRSE CORRECTAMENTE ..... jjy en base a las tablas
  return "MD0001";
}

function codigo_permiso_segun_id( $id_componente ){
  // OJO ESTE METODO DEBE DEFINIRSE CORRECTAMENTE ..... jjy en base a las tablas
  return "PR0001";
}
