<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_base_m extends CI_Model {

    function __construct(){
         parent::__construct();
    }
    
 
public function listar_alimentos(){
	$this->db->select('id, codigo_alimento, codigo_clasificacion_alimento, nombre_alimento, categoria_alimento,  cantidad_caloria, cantidad_proteina, cantidad_grasa, cantidad_carbohidrato_disponible, cantidad_carbohidrato_total');
	$this->db->from('cobi.v_lista_alimentos');

        $datos = $this->db->get();

        $datos = $datos->result_array();
        //print_r($datos);die;
        return $datos;
}


//mostrar 
public function informacion_alimentos($id_registro){
	$this->db->select('id, codigo_alimento, codigo_clasificacion_alimento, nombre_alimento, categoria_alimento,  cantidad_caloria, cantidad_proteina, cantidad_grasa, cantidad_carbohidrato_disponible, cantidad_carbohidrato_total, codigo_unidad_medida_venta, factor_desecho, codigo_color, equivalente_gramo_venta');
	$this->db->from('cobi.v_lista_alimentos');
	$this->db->where('codigo_alimento',$id_registro);
        $datos = $this->db->get();

        $datos = $datos->result_array();
        //print_r($datos);die;
        return $datos;
}



public function micronutrientes_alimentos($id_registro){
	$this->db->select('id, codigo_alimento, codigo_micronutriente_alimento, codigo_micronutriente, descripcion, cantidad_micronutriente, descripcion_unidad_de_medida');
	$this->db->from('cobi.v_micronutriente_alimento');
	$this->db->where('codigo_alimento',$id_registro);
        $datos = $this->db->get();

        $datos = $datos->result_array();
        //print_r($datos);die;
        return $datos;


}

public function insertar_alimentos($datos=array()){
    
    extract($datos);

    $this->db->insert('cobi.t_alimentos',$alimentos);
    $id= $this->db->insert_id();
    $codigo_alimento='al'.sprintf("%04s",$id);

    $arrayparametros = array('codigo_alimento' => $codigo_alimento,);

    $this->db->where('id',$id);
    $this->db->update('cobi.t_alimentos',$arrayparametros);

    

    $detalle['codigo_alimento']=$codigo_alimento;
    $this->db->insert('cobi.t_detalle_alimento',$detalle);
    $id= $this->db->insert_id();
    $codigo_detalle='dta'.sprintf("%04s",$id);

    $arrayparametros = array('codigo_detalle_alimento' => $codigo_detalle,);

    $this->db->where('id',$id);
    $this->db->update('cobi.t_detalle_alimento',$arrayparametros);



    $tca['codigo_alimento']=$codigo_alimento;
    $this->db->insert('cobi.t_composicion_alimentos',$tca);
    $id=$this->db->insert_id();
    $codigo_tca='coa'.sprintf("%04s",$id);

    $arrayparametros = array('codigo_composicion_alimento'=>$codigo_tca,);

    $this->db->where('id',$id);
    $this->db->update('cobi.t_composicion_alimentos',$arrayparametros);







    return true;




 




}









}





































