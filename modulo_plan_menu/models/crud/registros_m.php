<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registros_m extends CI_Model {

  function __construct(){
       parent::__construct();
       $this->load->database();
  }
  public function lista_planes_menu(){
    $salida = array();
    $tabla = 'cobi.v_planes_menu';
    $rs = $this->db->get( $tabla );
    $salida = $rs->result_array();
    return $salida;
  }
  public function eliminar_registro( $id_registro, $parametros ){
    $tabla_asociada      = '';
    $id                  = '';
    $condicion_adicional = '';

    extract( $parametros );    

    $salida = '';

    $sql = "DELETE from $tabla_asociada WHERE id = $id_registro;";
    $rs = $this->db->query( $sql );
    $salida = $rs;

    return $salida;
  }
  public function guardar_registro( $parametros ){
    $tabla_asociada      = '';
    $id                  = '';
    $condicion_adicional = array();

    $salida = array();

    extract( $parametros );

    if( trim( $tabla_asociada ) == '' ){

      $salida['mensaje'] = "No se definió el formulario correctamente (tabla_asociada)!";

    } else {

      foreach ( $parametros as $id_campo => $valor ) {
        // se excluyen los campos de control
        $prefijo = substr( trim( $id_campo ), 0, 7 );
        if( $prefijo == 'campo__' ) {
          // se asignan los valores a los campos que serán actualizados o insertados! ... jjy
          $id_campo_x = substr( $id_campo, 7 );
          $this->db->set( $id_campo_x, $valor );
        }
        if( trim( $id ) == '' && $prefijo == 'autoc__' ) {
          $id_autoc = substr( $id_campo, 7 );
          $this->db->set( $id_autoc, mt_rand(1000, 9999) ); // colocar valor aleatorio!!!! ... jjy
        }
      }
      if( trim( $id ) == '' ){
          $rs = $this->db->insert( $tabla_asociada );
          $id = $this->db->insert_id();
          $this->db->where('id', $id);
          $this->db->update( $tabla_asociada, array( $id_autoc => autocodigo( $tabla_asociada, $id ) ) );
        } else {
          $this->db->where('id', $id);
          if( count( $condicion_adicional ) > 0 ) {
            //se incorporan las condiciones adicionales
            $this->db->where( $condicion_adicional );
          }
          $rs = $this->db->update( $tabla_asociada );
          //prp( $this->db->last_query() );
      }
      $salida['id'] = $id;
      $salida['rs'] = $rs;
    }
    return $salida;
  }
  public function datos_tabla_secundaria( $tabla, $condiciones = array() ){
    /*$salida = array(
      array('id'=>0),
      array('a'=>'1111'),
      array('b'=>'2222'),
    );*/
    $this->db->order_by( 'id' );
    $rs = $this->db->get($tabla);
    $salida = $rs->result_array();
    return $salida;
  }
  public function extraer_registro_segun_id( $tabla, $id_registro ){
    $salida = array();

    $this->db->where( 'id', $id_registro );
    $rs = $this->db->get( $tabla );

    $salida = $rs->row_array();
    return $salida;
  }
  public function extraer_registros_segun_condicion( $tabla, $condiciones = array() ){
    $salida = array();

    if ( count( $condiciones ) > 0 ) {
      $this->db->where( $condiciones );
    }
    $rs = $this->db->get( $tabla );

    $salida = $rs->result_array();
    return $salida;
  }
  public function codigo_segun_id ( $tabla, $campo_codigo, $id_registro ){
    $reg = $this->extraer_registro_segun_id( $tabla, $id_registro );
    return $reg[$campo_codigo];
  }
  public function proximo_codigo_segun_tabla( $tabla_asociada, $campo_id = 'id', $campo_codigo = '' ){
    $salida = "";
    $id = $this->db->insert_id( $tabla_asociada );
    $proximo_codigo = autocodigo( $tabla_asociada, $id );
    $salida = $proximo_codigo;
    return $salida;
  }
  public function eliminar_registros_segun_condicion( $tabla_asociada, $condiciones ){
    $salida = '';

    $sql = "DELETE from $tabla_asociada WHERE $condiciones ";
    $rs = $this->db->query( $sql );
    $salida = $rs;

    return $salida;
  }

}