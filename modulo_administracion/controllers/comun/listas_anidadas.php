<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listas_anidadas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('comun/listas_anidadas_m');
    }

    public function index(){
        // vacío
    }

    public function lista($tabla, $campo_id, $campo_descripcion, $campo_dep='', $valor_dep='',$campo_orden=''){
	
        $res=$this->listas_anidadas_m->lista_valores($tabla,$campo_id,$campo_descripcion,$campo_dep,$valor_dep,$campo_orden);        
        echo $this->arreglo_jcombo($res);
    }

    public function arreglo_jcombo($arreglo){
        $salida='[';        
        foreach ($arreglo as $elemento){
            $elemento_x =  (array) $elemento;
            $salida.='[';       
            foreach ($elemento_x as $dato){
                $salida.='"'.$dato.'",';
            }
            $salida=substr($salida,0,-1);
            $salida.='],';
        }
        $salida=substr($salida,0,-1);
        $salida.=']';
        return $salida;
    }

}
