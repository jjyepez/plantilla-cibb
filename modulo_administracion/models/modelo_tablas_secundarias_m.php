<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_tablas_secundarias_m extends CI_Model {

    function __construct(){
         parent::__construct();
    }
    
 


    public function listar_tablas($parametros = array())
    {
        $codigo_sistema="";
        extract($parametros);

        //select para verificar si hay una categoria asociada dentro del sistema a tablas segundarias para poder hacer el select a la vista
        //y tener una condicion de filtrado en dicha vista
        $this->db->select('codigo_tipo_tabla');
        $this->db->from('cobi.t_tipos_tablas');
        $this->db->where('descripcion ilike', 'tabla secundaria');
        $rs=$this->db->get();

            if($rs->num_rows()>0){
                $resultado=$rs->row_array();
                $codigo_tipo_tabla=$resultado['codigo_tipo_tabla'];
             
                $this->db->from('cobi.v_tablas_secundarias');
                $this->db->where('codigo_sistema', $codigo_sistema);
                $this->db->where('codigo_tipo_tabla', $codigo_tipo_tabla);
                $rs=$this->db->get();
                if($rs->num_rows()>0){
                    $resultado =$rs->result_array();
                
                }else{
                    $resultado=array();
                }   
            }else{
                $resultado=array();
            }

        return $resultado;

    }

    public function listar_registros_tablas($parametros = array())
    {
        $codigo_sistema="";
        $esquema="";
        $codigo_tabla_sistema="";

        extract($parametros);    
       
              
        $this->db->select('id_tabla');
        $this->db->from('cobi.v_tablas_secundarias');
        $this->db->where('codigo_sistema', $codigo_sistema);
        $this->db->where('codigo_tabla_sistema', $codigo_tabla_sistema);
        $rs=$this->db->get();
     
        if($rs->num_rows()>0){
            $resultado =$rs->row_array();

            $tabla=$esquema.'.'.$resultado['id_tabla'];

            $this->db->from($tabla);
            $this->db->order_by('id');
            $rs=$this->db->get();
            if($rs->num_rows()>0){
                $resultado=$rs->result_array();
            }else{
                $resultado=array();
            }
        
        }else{
            $resultado=array();
        }   
           

        return $resultado;

    }
  

}