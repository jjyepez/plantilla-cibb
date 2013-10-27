<?php

class Listas_anidadas_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function lista_valores($tabla, $campo_id, $campo_descripcion, $campo_dep='', $valor_dep='',$campo_orden='') {
		$campo_dep=str_replace('.df.',' <>',$campo_dep);
		$campo_dep=str_replace('.ig.',' =',$campo_dep);
		$campo_dep=str_replace('.my.',' >',$campo_dep);
		$campo_dep=str_replace('.mn.',' <',$campo_dep);
		$campo_dep=str_replace('.myi.',' >=',$campo_dep);
		$campo_dep=str_replace('.mni.',' <=',$campo_dep);

        $this->db->select("$campo_id, $campo_descripcion");

        $this->db->from($tabla);

        if ($campo_orden != '-' && trim($campo_orden) != '') {
            $this->db->order_by($campo_orden,'ASC');
        } else {
            if ($campo_descripcion != "") {
                $this->db->order_by($campo_descripcion,'ASC');
            }
        }
        if($campo_dep != '-' && trim($campo_dep) != ''){
          if($valor_dep != '-' && trim($valor_dep) != ''){
            $this->db->where($campo_dep, $valor_dep);
          } else {
            $this->db->limit(1);
          }
        }

        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        } else {
            $obj->id='-1';
            $obj->des=$campo_descripcion;
            return array($obj);
        }
    }
}

?>
