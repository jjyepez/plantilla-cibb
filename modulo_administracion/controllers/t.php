<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }
   
	public function index(){
    //metodo invocado por omision en el controlador ..... jjy
		
	}
  public function listar($operacion='g', $codigo_tabla_sistema=''){
    if($operacion=='g'){//para listar los registros de toda la tabla donde estan registradas las tablas del sistema
      $codigo_sistema='SIST01';
      $parametros=array('codigo_sistema' => $codigo_sistema,                      
                        );

      $datos['tablas']=$this->modelo_tablas_secundarias_m->listar_tablas($parametros);

      $this->load->view('tablas_secundarias/crud/listar_tablas_v',$datos);    
    }

    if($operacion=='e'){//e caso para listar los registros de una tabla en especifico
      $codigo_sistema='SIST01';//esta variable tiene que venir del entorno global
      $esquema='cobi';//esta variable tiene que venir del entorno global
      
      $parametros=array(
                        'codigo_sistema'       => $codigo_sistema,
                        'codigo_tabla_sistema' => $codigo_tabla_sistema,
                        'esquema'              => $esquema,
                         );

      $datos['registros']=$this->modelo_tablas_secundarias_m->listar_registros_tablas($parametros);
     
      $this->load->view('tablas_secundarias/crud_tablas/listar_registros_tabla_v', $datos);    
    }
    

  }


  public function mostrar_tabla_general($operacion='m', $codigo_tabla='',$parametros=array())
  {

    $variables=array(
                    'operacion' => $operacion,
                    );
   
   $this->load->view('tablas_secundarias/crud/registro_v',$variables);
  }

    public function registrar_tabla()
  {
    prp($_POST);
   
  }
  



  public function filtrar_registros(){
    echo "filtrar registro";
  }

  public function imprimir_registros(){
    echo "imprimir registro";
  }

  public function vista_preliminar_registro( $id ){
    echo "vista preliminar registro $id";
  }

  public function exportar_registros(){
    echo "exportar registros";
  }








  // *******************************************************************
}