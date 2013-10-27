<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_usuarios_m extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function crear_tablas_usuarios ( $tabla, $parametros = array() ) {
		$crear_desde_script_respaldo = FALSE; // este parametro tiene Prioridad sobre la creacion TABLA a TABLA !!!! ... jjy

		extract( $parametros );

		$rsp = "";
		$sql = "";

		if ( $crear_desde_script_respaldo === TRUE ) { // se crearan todas las tablas en base al script de respaldo que se encuentra en /data .. script_tablas_seguridad.sql.php ... jjy
			
			if ( table_exists( 'seguridad.t_usuarios') ){

				$sql = "--";
				$rsp = "YA EXISTE ESQUEMA seguridad";

			} else { 

				$sql_creacion_tablas_seguridad           = "";
				$archivo_script_respaldo_tablas_usuarios = realpath( '.' ) . "/data/" . 'script_tablas_seguridad.sql.php';

				require_once ( $archivo_script_respaldo_tablas_usuarios ); // se incluye el archivo sql que debe haber sido previamente preparado como PHP! ... jjy

				$sql_depurado = explode( "\n", $sql_creacion_tablas_seguridad );
				$sql_final    = "";
				foreach ( $sql_depurado as $linea ) {

					if ( substr( trim( $linea ), 0, 2 ) != '--' ) {
						$sql_final .= $linea;
					}
				}
				$sql = $sql_final; // sin lineas de comentarios!!!  .... jjy
			}

		} else { // se creaan las tablas una a una en base al parametro $tabla .... jjy

			$sql_crear_tabla = "";

			// ESTE METODO DEBE COMPLETARSE CON LOS SCRIPTS QUE CREAN CADA TABLA !!!! ..... CUIDADO, sequence! .. jjy

			switch ( $tabla ){
				case "seguridad.t_usuarios":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_sistemas":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_roles":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_modulos":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_permisos":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_usuarios_sistemas_negados":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_usuarios_roles":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_usuarios_modulos_negados":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_usuarios_permisos_negados":
					$sql_crear_tabla = "
					";
				break;

				case "seguridad.t_estatus":
					$sql_crear_tabla = "
					";
				break;
			}
			$sql = $sql_crear_tabla;

		} // fin IF ... script respaldo completo o tabla a tabla ..... jjy

		if ( trim( $sql ) != "" && trim( $rsp == "" ) ) {
			$this->db->query( $sql );
			$rsp = "OK"; //// TODO SALIO BIEN.... jjy
		} else {
			if ( trim( $sql ) == "" ){
				$rsp = "Script CREATE TABLE vacio.";
			}
		}
		// ESTE METODO DEBE COMPLETARSE CON LOS SCRIPTS QUE CREAN CADA TABLA !!!! ..... CUIDADO, sequence! .. jjy
	  return $rsp;

	}

	public function iniciar_sesion( $codigo_usuario ){
		$momento = date( "d-m-Y H:i:s", fecha_hora_local() );
		$ip = $_SERVER['REMOTE_ADDR'];
		$hash = MD5( $ip . $momento ); //( $ip . $momento . $codigo_usuario ); // Hash de la sesion iniciada (pudiera usarse para manejo de cookies más adelante)
		$codigo_estatus = 'SS0001'; //codigo_estatus_segun_nombre('OK');

		$campos = array(
			'codigo_usuario' => $codigo_usuario,
			'hash_sesion'		 => $hash,
			'codigo_estatus' => $codigo_estatus,
			'momento'				 => $momento,
		);
		$tabla = "seguridad.t_sesiones_usuarios";
		$this->db->insert( $tabla, $campos );

		$salida['rsp'] = 'OK';
		$salida['cuh'] = $hash; // control_usuario_hash de sesion! ... jjy

		$_SESSION['sesion']['codigo_usuario'] = $codigo_usuario;

		return $salida;
		//$codigo_estatus = dato_tabla_apoyo( 'descripcion', '');
	}

	public function sesion_iniciada( $codigo_usuario, $cuh, $parametros = array() ){
		$depurar_sesiones_vencidas = TRUE;
		$tiempo_vencido = 30; // 4 horas

		extract( $parametros );

		//$cuh  es  el valor del HASH para control de usuario ... es el identificador MD5 para una sesion valida ... jjy
		$salida = FALSE;

		$this->db->from( 'seguridad.t_sesiones_usuarios' );
		$condiciones = array(
			'codigo_usuario' => $codigo_usuario,
			'hash_sesion'    => $cuh,
		);
		$this->db->where( $condiciones );
		$rs = $this->db->get();

		if ( $rs->num_rows() > 0 ){

			$salida = TRUE;

			if ( $depurar_sesiones_vencidas ){
				//depurar sesiones vencidas segun segundos ....
				$this->db->from( 'seguridad.t_sesiones_usuarios' );
				$momento = date( "d-m-Y H:i:s", fecha_hora_local() - $tiempo_vencido );
				$condiciones = array(
					'codigo_usuario' => $codigo_usuario,
					'momento < ' => $momento,
				);
				$this->db->where( $condiciones );
				$rs = $this->db->delete();
			}
		}

		return $salida;
	}

	public function codigo_estatus_segun_nombre ( $nombre_estatus ) {
		// DEFINIR Y PROGRAMAR ESTE METODO CORRECTAMENTE ...... jjy
		$salida = "ES0001";

		$parametros = array(
			'tabla'        => 'comun.t_estatus_sesion',
			'campo_codigo' => 'codigo_estatus',
		);

		//return codigo_segun_nombre();
		return $salida;

	}

	public function informacion_usuario( $parametros = array() ){
    //# @descripcion Devuelve la información de la tabla t_usuarios asociado al usuario indicado.
    $nombre_usuario = "";
    $codigo_usuario = "";

		extract( $parametros ); unset( $parametros );

		$salida = array();

		$this->db->from( 'seguridad.v_informacion_usuarios' );
		$condiciones = array(
			'codigo_usuario' => $codigo_usuario,
		);
		$this->db->where( $condiciones );
		$condiciones = array(
			'nombre_usuario' => $codigo_usuario,
		);
		$this->db->or_where( $condiciones );
		$rs = $this->db->get();

		//prp( $this->db->last_query() );

		if ( $rs->num_rows() > 0 ){
			$salida = $rs->row_array();
		} else {
			$salida = array('nombre_usuario' => 'ERROR: No existe.');
		}

		return $salida;
	}

	public function eliminar_sesion_usuario( $codigo_usuario, $cuh ){
		$salida = "";
	 	$this->db->from( 'seguridad.t_sesiones_usuarios' );
	  $condiciones = array(
	    'codigo_usuario' => $codigo_usuario,
	    'hash_sesion'    => $cuh,
	  );
	  $this->db->where( $condiciones );
	  
	  if ( $this->db->delete() ){
	  	$salida = 'OK';
	  }
	  return $salida;
	}

	public function actualizar_momento_sesion ( $codigo_usuario, $cuh, $momento ){
		$salida = "";
	 	$this->db->from( 'seguridad.t_sesiones_usuarios' );
	 	$this->db->set('momento', $momento );
	  $condiciones = array(
	    'codigo_usuario' => $codigo_usuario,
	    'hash_sesion'    => $cuh,
	  );
	  $this->db->where( $condiciones );
	  
	  if ( $this->db->update() ){
	  	$salida = 'OK';
	  }
	  return $salida;
	}

	public function usuario_habilitado_para ( $codigo_usuario, $parametros = array() ){ 
		$salida = "";

		//validar_sesion_activa(); /// VERIFICAR Y UBICAR MENJOR PARA QUE NO SE CAIGA EL SISTEMA AL perder la sesion ... jjy 

    // los parametros esperados son:
    //# @parametro array $parametros segun lista >>//
		$codigo_sistema = "";
		$codigo_modulo  = "";
		$codigo_permiso = "";
		$codigo_rol     = ""; // informacion para verificar los demas permisos ....
    //<<
    extract( $parametros ); unset( $parametros );
    $informacion_usuario = informacion_usuario( $codigo_usuario ); //informacion del usuario

		//prp($informacion_usuario);

		if ( trim( $codigo_rol ) == "" ) { // extraer el rol segun el codigo_usuario
				$codigo_rol = $informacion_usuario['codigo_rol'];
				if ( trim( $codigo_rol ) == "" ) { die('no tiene rol definido'); }
    }
    if ( trim( $codigo_sistema ) != "" ) { // validar acceso a un sistema
    	$tabla = "seguridad.t_usuarios_sistemas_negados";
    	$this->db->from( $tabla );
    	$condiciones = array(
				'codigo_usuario' => $codigo_usuario,
				'rol_usuario'    => $rol,
    	);
    	$this->db->where( $condiciones );
    	$rs = $this->db->get();

    
    }
    if ( trim( $codigo_permiso ) != "" ) { // validar acceso a un sistema
    	$tabla = "seguridad.t_usuarios_permisos_negados";
    	$this->db->from( $tabla );
    	$condiciones = array(
				'codigo_rol' => $codigo_rol,
				'codigo_modulo' => $codigo_modulo,
				'codigo_permiso_negado' => $codigo_permiso,
    	);
    	$this->db->where( $condiciones );
    	$rs = $this->db->get();

    	if ( $rs->num_rows() > 0 ){
    		$salida = "NEGADO";
    	}

    } else if ( trim( $codigo_modulo ) != "" ) { // validar acceso a un modulo
    	$tabla = "seguridad.t_usuarios_modulos_negados";
    	$this->db->from( $tabla );
    	$condiciones = array(
				'codigo_rol' => $codigo_rol,
				'codigo_modulo_negado' => $codigo_modulo,
    	);
    	$this->db->where( $condiciones );
    	$rs = $this->db->get();
		if ( $rs->num_rows() > 0 ){
    	$salida="NEGADO";
    	}else{
    	$salida="HABILITADO";
    	}

    }
		$this->db->close();

	  return $salida;
	}

	public function informacion_modulo( $parametros = array() ){
		// valores por omision
		$id_modulo     = "";
		$codigo_modulo = "";
		// se extraen los parametros 
		extract( $parametros );

		$salida = "";

		$tabla = "seguridad.t_modulos";
		$this->db->from( $tabla );

		if ( trim( $codigo_modulo ) != "" ) {
			$this->db->where('codigo_modulo', $codigo_modulo );
		}
		if ( trim( $id_modulo ) != "" ) {
			$this->db->where('id_modulo', $id_modulo );
		}
		$rs = $this->db->get();

		if ( $rs->num_rows() > 0 ) {
			$salida = $rs->row_array();
		}

		return $salida;
	}	

	public function informacion_permiso( $parametros = array() ){
		// valores por omision
		$id_permiso     = "";
		$nombre_permiso = "";
		$codigo_permiso = "";
		// se extraen los parametros 
		extract( $parametros );

		$salida = "";

		$tabla = "seguridad.t_permisos";
		$this->db->from( $tabla );

		if ( trim( $codigo_permiso ) != "" ) {
			$this->db->where('codigo_permiso', $codigo_permiso );
		}
		if ( trim( $id_permiso ) != "" ) {
			$this->db->where('id', $id_permiso );
		}
		if ( trim( $nombre_permiso ) != "" ) {
			$this->db->where('nombre_permiso', $nombre_permiso );
		}
		$rs = $this->db->get();

		if ( $rs->num_rows() > 0 ) {
			$salida = $rs->row_array();
		}

		return $salida;
	}	

	public function sesion_activa(){
		return ( isset ( $_SESSION['cuh'] ) && trim( $_SESSION['cuh'] ) !== "" );
	}

	public function validar_sesion_activa(){
		if ( ! sesion_activa() ){
			redirect( base_url(), 'location' );
			die();
		}
	}

}

?>