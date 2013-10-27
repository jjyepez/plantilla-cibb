<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comun_m extends CI_Model {

	public function __construct(){
		parent::__construct();
		$bd=$this->load->database();
	}

	public function valores_lista_segun_tabla ($parametros = array()){
		//parametros esperados ... jjy
		$texto_por_defecto  ="";
		$valor_por_defecto  ="";
		$valor_seleccionado ="";
		$tabla_origen       ="";
		$condicion_filtro   ="";
		$orden_salida       ="";
		$consulta_sql_origen="";
		$campo_lista_valor  ="";
		$campo_lista_texto  ="";

		extract( $parametros ); unset( $parametros );

		$resultado = array();

		$this->db->select($campo_lista_valor.','.$campo_lista_texto);
		$this->db->from($tabla_origen);
		$this->db->where($condicion_filtro);
		$this->db->order_by($orden_salida);
		$rs = $this->db->get();

		$resultado['campos']=$rs->list_fields();
		$resultado['datos']=$rs->result();
		
		$this->db->close();

		return $resultado;
	}

	public function codigo_segun_nombre( $parametros = array() ){
		// parametros esperados ... jjy
		$tabla = "";
		$nombre = "";
		// se espera que el campo codigo lleve 
		$campo_codigo = str_replace( ' t_', 'codigo_', ' ' . trim( $tabla ) );
		$campo_nombre = str_replace( ' t_', 'nombre_', ' ' . trim( $tabla ) );

		extract( $parametros ); unset( $parametros );

		$resultado = array(); //salida

		$parametros = array(
			'tabla'            => $tabla,
			'campos_devueltos' => array( $campo_codigo ),
			'condiciones'      => array( $campo_nombre . " = '" . $nombre . "'"),
			'limite'					 => 1,
			'orden'					 	 => $campo_codigo,
		);

		$resultado = extraer_datos( $parametros );

		prp( $resultado, 1 );
	}

	public function extraer_datos( $parametros ){
		$tabla            = "";
		$campos_devueltos = "*";
		$condiciones      = "";
		$limite           = 1;
		$orden            = "";
		
		extract ( $parametros ); unset( $parametros );

		$resultado = array();

		$this->db->select( $campos_devueltos );
		$this->db->from( $tabla );
		$this->db->where( $condiciones );
		$this->db->order_by( $orden );
		$rs = $this->db->get();

		$resultado['campos'] = $rs->list_fields();
		$resultado['datos']  = $rs->result();
		
		$this->db->close();

		return $resultado;
	}

}
	
?>
