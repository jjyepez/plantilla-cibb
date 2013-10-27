<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S extends CI_Controller {

      public function __construct() {
          parent::__construct();
      }
   
    	public function index(){
        //metodo invocado por omision en el controlador ..... jjy
    		$this->listar_registros();
    	}

  // métodos de control principal CRUD !!!!! ..... jjy *****************
      public function listar_registros(){

    	$datos ['informacion']=$this->modelo_base_m->listar_alimentos();

    	//prp($datos,1);

        // llamado a la vista ... jjy
        $this->load->view( 'crud/listar_registros_v',$datos );
      }

  
  public function registro( $operacion = 'm', $id_registro = '' ){
    // las operaciones pueden ser 'm'= mostrar; 'n'= nuevo; 'e'= editar ...... jjy ... experimental
    // en este punto se deberían volver a validar los permisos para la acción solicitada .... jjy
	
 if ($operacion=='m'||$operacion=='e') {
   # code...
 
	$datos ['informacion']=$this->modelo_base_m->listar_alimentos();

	$informacion_alimento=$this->modelo_base_m->informacion_alimentos($id_registro);

	$micronutrientes_alimento=$this->modelo_base_m->micronutrientes_alimentos($id_registro);
foreach($informacion_alimento as $valor){
foreach($valor as $indice=>$valor1){

$informacion[$indice]=$valor1;
}
} 
    $variables= array(
      'operacion'           => $operacion,
      'id_registro'         => $id_registro,
      'informacion_alimento' => $informacion,    
      'micronutrientes_alimento' => $micronutrientes_alimento, 

      );
    }
    if ($operacion=='n') {
      # code...
   
      $variables= array(
      'operacion'           => $operacion,
      'id_registro'         => $id_registro,
      
      );
       }
   $this->load->view( 'crud/registro_v', $variables );

   
  }




  public function insertar_alimentos() {

        $post= $_POST;
        $id='';
        $informacion = array();
        foreach ($post as $indice => $value) {
           
        }

         $datos['alimentos'] = array(
         'codigo_alimento'=>$codigo_alimento=rand(1,999),
         'nombre_alimento' =>  $this->input->post('nombre_alimento') , 
         
        );

         $datos['detalle'] = array(
         'codigo_detalle_alimento'=>$codigo_detalle_alimento=rand(1,999),
         'equivalente_gramo_venta' =>  $this->input->post('equivalente_gramo_venta') ,
         'factor_desecho' =>  $this->input->post('factor_desecho') ,

        );

         $datos['tca'] = array(
          'codigo_composicion_alimento'=>$codigo_composicion_alimento=rand(1,999),
          'cantidad_caloria'=> $this->input->post('cantidad_caloria'),
          'cantidad_proteina'=>$this->input->post('cantidad_proteina'),
          'cantidad_grasa'=>$this->input->post('cantidad_grasa'),
          'cantidad_carbohidrato_disponible' =>$this->input->post('cantidad_carbohidrato_disponible'),
          'cantidad_carbohidrato_total' =>$this->input->post('cantidad_carbohidrato_total'),

          );


        
 //prp($datos,1);
    


        /* $datos_micronutrientes  = array(
             'codigo_alimento'=>$codigo_alimento=rand(1,999),
             'nombre_alimento' =>  $this->input->post('nombre_alimento') , 
             
            );
        


        $arrayinformacion = array('alimentos' =>$datos , 
                            'micronutrientes' =>$datos_micronutrientes,

        );*/






        if ( $this->modelo_base_m->insertar_alimentos($datos)) {
          
        $this->listar_registros();
       // $datos ['informacion']=$this->modelo_base_m->insertar_alimentos($id,$datos);
    

     }
      } 



  public function eliminar_registro( $id ){
    echo "eliminar registro $id";
  }

  public function imprimir_registro($id_registro ){
    echo "imprimir registro $id";
  }

  public function filtrar_registros(){
    echo "filtrar registro";
  }

  public function vista_preliminar_registro( $id_registro ){
    echo "vista preliminar registro $id";
  }

  public function exportar_registros(){
    echo "exportar registros";
  }
  // *******************************************************************
}
