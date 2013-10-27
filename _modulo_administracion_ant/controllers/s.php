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
  public function listar_registros($parametros=array()){
    // llamado a la vista ... jjy

    $mensaje_error="";
    $mensaje_exito="";
    extract($parametros);  
    //consultamos los datos del usuario logiado con el fin de mostrar los usuarios acorde al nivel de disponibilidad CV
      $datos                            = datos_usuario_actual();
      $info                             = informacion_usuario($datos['codigo_usuario']);
      $parametros                       = array('nivel'=>$info['nivel_rol']);
      
      $datos['informacion_usuario']     = $info;
      $usuarios                         = $this->modelo_base_m->listar_usuario($parametros);
      foreach ($usuarios as $indice     => $valor) {
        $usuarios[$indice]['rol_usuario'] = ucfirst(strtolower($valor['rol_usuario']));
      }
      $datos['datos']                   = $usuarios;

      if($mensaje_error!=''){
      $datos['mensaje_error']=$mensaje_error;
    }
    if($mensaje_exito!=''){
      $datos['mensaje_exito']=$mensaje_exito;

    }
      
 
    $this->load->view( 'crud/listar_registros_v', $datos );
  }
  
  public function registro( $operacion = 'm', $id_registro = '',$parametros=array()){
    // las operaciones pueden ser 'm'= mostrar; 'n'= nuevo; 'e'= editar ...... jjy ... experimental
    // en este punto se deberían volver a validar los permisos para la acción solicitada .... jjy
    $mensaje_error="";
    $mensaje_exito="";
    extract($parametros);  


    // Consulta de informacion del usuario actualmente logiado para adaptar el contenido segun el nivel asociado a su rol CV
        $datos=datos_usuario_actual();
        $info=informacion_usuario($datos['codigo_usuario']);
        $valor=$info['nivel_rol'];  

        $codigo_sistema='SIST01';//ESTA VARIABLE DEBE ESTAR EN LAS CONFIGURACIONES DE ENTORNO GLOBAL

        $variables= array(
          'operacion'           => $operacion,
          'id_registro'         => $id_registro,
          'informacion_usuario' => $info,       
          'codigo_sistema'      => $codigo_sistema,    
          );

        if($operacion=='m' || $operacion=='e'){

        $informacion=$this->modelo_base_m->informacion_usuario($id_registro);
        $informacion_aux=array();//proceso para convertir el array multidimensional con la informacion inicial en array sencillo para cargar la informacion en los campos CV.
          foreach ($informacion as $value) {
            foreach ($value as $indice => $value1) {
              $informacion_aux[$indice]=$value1;
            }
          }
          $informacion=$informacion_aux; 
          $variables['informacion']=$informacion;
         
        }

        if($operacion=='error' || $operacion=='errore'){
          

          $codigo_rol=$this->input->post('codigo_rol');
          $codigo_estatus=$this->input->post('estatus');
          $codigo_usuario=$this->input->post('codigo_usuario');
          $variables['codigo_usuario']=$codigo_usuario;
          $variables['codigo_rol']=$codigo_rol;
          $variables['codigo_estatus']=$codigo_estatus;
          $variables['operacion']=$operacion;


        }

        if($mensaje_error!=''){
        $variables['mensaje_error']=$mensaje_error;
        }
        if($mensaje_exito!=''){
        $variables['mensaje_exito']=$mensaje_exito;

        }

     

        $this->load->view( 'crud/registro_v', $variables );
        }

  public function mostrar_dialogo_roles()
  {

    
    $datos=datos_usuario_actual();
    $info=informacion_usuario($datos['codigo_usuario']);
    $nivel=$info['nivel_rol'];

    $roles=$this->modelo_base_m->roles($nivel);  
    foreach ($roles as  $indice => $valor) {
        $roles[$indice]['nombre_rol']='<a class="item-grid"rel="'.ucfirst(strtolower($valor['nombre_rol'])).'" name="'.$valor['codigo_rol'].'" href="#">'.$valor['nombre_rol'].'</a>';
    }
 

    $codigo_sistema='SIST01';//ESTA VARIABLE DEBE ESTAR EN LAS CONFIGURACIONES DE ENTORNO GLOBAL  
    $parametros=array('codigo_sistema' => $codigo_sistema); 
    $permisos=$this->modelo_base_m->permisos($parametros);


    $modulo='';
    $aux='0';
    $resultado=array();
    $modulos=array();
        foreach ($permisos as $indice => $value) {
            if($modulo!=$value['modulo']){
              $modulo_aux=$value['codigo_modulo'];
             $modulos[$value['codigo_modulo']]=$value['modulo'];
              $aux='0';    
            }
              if($value['codigo_permiso']!=''){
                if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
                  $resultado[$modulo_aux][$value['codigo_permiso']]=$value['permiso'];        
              }else{
                 if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
                  $resultado[$modulo_aux][$value['codigo_permiso']]='VACIO';
              }
              $modulo=$value['modulo'];
              $aux++;    
          }

    $variables= array(          
      'informacion_usuario' => $info,
      'roles'               => $roles,      
      'codigo_sistema'      => $codigo_sistema,
      'permisos'            => $resultado,
      'modulos'             => $modulos,
      );

   

  $this->load->view('crud/dialogo_roles_v', $variables);
  }


public function registro_rol()
{


    $datos=datos_usuario_actual();
    $info=informacion_usuario($datos['codigo_usuario']);
    $nivel=$info['nivel_rol'];

    $codigo_sistema='SIST01';//ESTA VARIABLE DEBE ESTAR EN LAS CONFIGURACIONES DE ENTORNO GLOBAL  
    $parametros=array('codigo_sistema' => $codigo_sistema); 
    $permisos=$this->modelo_base_m->permisos($parametros);


    $modulo='';
    $aux='0';
    $resultado=array();
    $modulos=array();
       foreach ($permisos as $indice => $value) {
            if($modulo!=$value['modulo']){
              $modulo_aux=$value['codigo_modulo'];
             $modulos[$value['codigo_modulo']]=$value['modulo'];
              $aux='0';    
            }
              if($value['codigo_permiso']!=''){
                if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
                  $resultado[$modulo_aux][$value['codigo_permiso']]=$value['permiso'];        
              }else{
                 if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
                  $resultado[$modulo_aux][$value['codigo_permiso']]='VACIO';
              }
              $modulo=$value['modulo'];
              $aux++;    
          }

    $variables= array(          
      'informacion_usuario' => $info,            
      'codigo_sistema'      => $codigo_sistema,
      'permisos'            => $resultado,
      'modulos'             => $modulos,
      );



$this->load->view('crud/registro_rol_v', $variables);


}


public function registrar_rol($operacion=''){

$aux='';
$aux1='';
//este for para saber que por lo menos selecciono un modulo y pasar a validar el otro campo
 foreach ($_POST as  $valor) {
  $aux1=substr($valor,0,2);
  if($aux1=='MD')$aux++;
  
 }

    if($aux >0){

      if($operacion)
        $validar = array(
                     array(
                           'field'   => 'nombre_rol',
                           'label'   => 'Nombre Rol',
                           'rules'   => 'required|callback_no_existe_rol'
                        ),
               
                   
                  );

          $this->form_validation->set_rules($validar); 

          if ($this->form_validation->run() == FALSE)
          {

              if($operacion=='roles'){
               $this->editar_rol('error');
              }else{
                $this->registro('error');
              }
          }
          else
          { 

            $datos=datos_usuario_actual();
            $info=informacion_usuario($datos['codigo_usuario']);
            $nivel=$info['nivel_rol'];
            $nivel=($nivel!=0)? $nivel-- : $nivel=1;         
            $datos=array();

            $datos['codigo_rol']=rand(1,9999);
            $datos['nombre_rol']=strtoupper($this->input->post('nombre_rol'));
            $datos['descripcion_rol']=strtoupper($this->input->post('descripcion_rol'));
            $datos['codigo_sistema']='SIST01';//Este valor tiene que venir por las variables globales de la plantilla
            $datos['nivel']=$nivel;
            $modulos=array();
            $permisos=array();
            $aux="";
      
           
            foreach ($_POST as $indice => $valor) {
              
             
               $aux=substr($indice,0,3);
             
              if($aux=='mod'){array_push($modulos, $valor);}
              if($aux=='per'){array_push($permisos, $valor);} 
              $aux="";
              # code...
            }
           $datos['modulos']=$modulos;
           $datos['permisos']=$permisos;

           
           if($this->modelo_base_m->registro_rol($datos)){
             $parametros=array('mensaje_exito'=>'Nuevo Rol Creado ');
             if($operacion=='roles'){//esta condicion es porque se puede registrar desde dos sitios diferentes desde el dialogo emergente o desde el modulo de roles como tal
               $this->listar_roles($parametros);
             }else{
                $this->registro('n','',$parametros);
              }
           }else{
             $parametros=array('mensaje_error'=>'Ocurrio un Error ');
             if($operacion=='roles'){
             $this->editar_rol('error','',$parametros);
             }else{
              $this->registro('error','',$parametros);
             }
           } 

          }

    }else{
      $parametros=array('mensaje_error'=>'Debe Seleccionar algun modulo ');
      if($operacion=='roles'){
             $this->editar_rol('error','',$parametros);
      }else{
      $this->registro('error','',$parametros);
      }
    } 

}



public function no_existe_rol($nombre_rol){
  if(empty($nombre_rol))return TRUE;

  $nombre_rol= strtoupper($nombre_rol);
 
  if($this->modelo_base_m->existe_nombre_rol($nombre_rol)){

    $this->form_validation->set_message('no_existe_rol',
      'Ya existe el nombre <b>Rol</b> ingresado');
    return FALSE;
  }else{
    return TRUE;
  }

}


  public function mostrar_permisos_rol($codigo_rol)
  {
    $codigo_sistema='SIST01';
    $parametros=array(
                'codigo_sistema'=> $codigo_sistema,
                'codigo_rol'    => $codigo_rol,
      );
    $modulos=$this->modelo_base_m->modulos_permisos_rol($parametros);

    $variables=array(

          'codigo_rol'=> $codigo_rol,
          'modulos'   => $modulos,
      );

  $this->load->view('crud/permiso_rol_v',$variables);
  }


  public function guardar_registro(){
    

 $validar = array(
               array(
                     'field'   => 'usuario',
                     'label'   => 'Usuario',
                     'rules'   => 'required|callback_no_existe_usuario'
                  ),
               array(
                     'field'   => 'correo',
                     'label'   => 'Correo',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'contrasena',
                     'label'   => 'Contraseña',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'repetir_contrasena',
                     'label'   => 'Repetir Contraseña',
                     'rules'   => 'required|matches[contrasena]'
                  ),
               array(
                     'field'   => 'estatus',
                     'label'   => 'Estatus',
                     'rules'   => 'required|callback_distinto_cero'
                  ),
               array(
                     'field'   => 'rol',
                     'label'   => 'Rol',
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'codigo_rol',
                     //,
                     //'rules'   => 'required'
                  ),
             
            );

$this->form_validation->set_rules($validar); 

    if ($this->form_validation->run() == FALSE)
    {

      $this->registro('error');
    }
    else
    {
     
        $codigo=rand(1,999        );
        $datos['codigo_usuario']     = $codigo;
        $datos['nombre_usuario']     = $this->input->post('usuario');
        $datos['contrasena']         = $this->input->post('contrasena');
        $datos['codigo_estatus']     = $this->input->post('estatus');  


        $datos['rol']            = array('codigo_rol' => $this->input->post('codigo_rol'),
                                        
                                        );

        $datos['persona']=array(
                        'codigo_persona'     => $codigo,
                        'correo_electronico' => $this->input->post('correo'),
                        'nombres'            => $this->input->post('usuario'),
                        'apellidos'          => $this->input->post('usuario'),
                        'cedula'             => '00000000',
                     );
          
        if($this->modelo_base_m->registro_usuario($datos)){

          $parametros=array('mensaje_exito' => 'Registro Exitoso', );
          $this->listar_registros($parametros);

        }else{
          $parametros=array('mensaje_error' => 'No se pudo Registrar', );
          $this->listar_registros($parametros);
        }
    }


  }





  public function editar_registro(){
    



$validar = array(
              array(
                     'field'   => 'usuario',
                     'label'   => 'Usuario',
                     'rules'   => 'required'                    
                  ),
               array(
                     'field'   => 'correo',
                     'label'   => 'Correo',
                     'rules'   => 'required'
                  ),
            
               array(
                     'field'   => 'estatus',
                     'label'   => 'Estatus',
                     'rules'   => 'required|callback_distinto_cero'
                  ),
               array(
                     'field'   => 'rol',
                     'label'   => 'Rol',
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'codigo_rol',                
                  ),
             
            );

$this->form_validation->set_rules($validar); 

    if ($this->form_validation->run() == FALSE)
    {

      $this->registro('errore');
    }else{

     
      //se preparan los datos de la siguiente forma para poder pasarles arreglos al active record de codeigniter
      //una vez llegado al modelo a las respectivas tablas aunque solo sea un solo campo mas adelante pudieran crecer los campos a actualizar CV
      $datos['codigo_usuario']=$this->input->post('codigo_usuario');
      $datos['usuario']=array(
                            'codigo_estatus'=>$this->input->post('estatus'),
                        );
      $datos['persona']=array(
                          'correo_electronico'=> $this->input->post('correo'),   
                        );
      $datos['rol']=array(
                        'codigo_rol'=> $this->input->post('codigo_rol'),
                    );

          
      if ($this->modelo_base_m->actualizar_registro($datos)) {
       
         $parametros=array('mensaje_exito' => 'Registro actualizado con exito', );
          $this->listar_registros($parametros);

        }else{
          $parametros=array('mensaje_error' => 'No se pudo Actulizar el registro', );
          $this->listar_registros($parametros);
        }

    }

  }






  public function eliminar_registro($id){
  
    if($this->modelo_base_m->eliminar_registro($id)){
      $parametros['mensaje_exito']="Usuario Eliminado con Exito";
      $this->listar_registros($parametros);
    }else{$parametros['mensaje_error']="El Usuario No Pudo ser Eliminado";
      $this->listar_registros($parametros);
    }
  }

  public function listar_modulos(){

    
    $codigo_sistema='SIST01';//ESTA VARIABLE DEBE ESTAR EN LAS CONFIGURACIONES DE ENTORNO GLOBAL   


      $prueba['modulos']=$this->modelo_base_m->modulos_sistema($codigo_sistema);



   $this->load->view( 'crud_modulos/listar_registros_modulos_v', $prueba );
  }


public function registro_modulo($operacion='m', $codigo_modulo='')
{


   if($operacion=='n'){


     $variables    = array(
          'operacion'   => $operacion,
          'id_registro' => $codigo_modulo,
         
          );
   }

   if($operacion=='m'){
    $codigo_sistema='SIST01';

          $parametros=array('codigo_modulo' => $codigo_modulo,
                            'codigo_sistema'=> $codigo_sistema,
                        );        
          $permisos=$this->modelo_base_m->permisos($parametros);


          $modulo='';
          $aux='0';
          $resultado=array();
          $modulos=array();
          foreach ($permisos as $indice => $value) {
            if($modulo!=$value['modulo']){
              $modulo_aux=$value['codigo_modulo'];
             $modulos[$value['codigo_modulo']]=$value['modulo'];
              $aux='0';    
            }
              if($value['codigo_permiso']!=''){
                if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
                  $resultado[$modulo_aux][$value['codigo_permiso']]=$value['permiso'];        
              }else{
                 if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
                  $resultado[$modulo_aux][$value['codigo_permiso']]='VACIO';
              }
              $modulo=$value['modulo'];
              $aux++;    
          }

      
          $variables    = array(
          'operacion'   => $operacion,
          'id_registro' => $codigo_modulo,
          'permisos'    => $resultado,
          'modulos'      => $modulos,
          );
    }


  
   $this->load->view( 'crud_modulos/registro_modulo_v',$variables);
}




public function no_existe_usuario($usuario){

  if(empty($usuario)) return TRUE;

  if($this->modelo_base_m->existe_usuario($usuario)){

    $this->form_validation->set_message('no_existe_usuario',
      'Ya existe el <b>Usuario</b> ingresado');
   
    return FALSE;  
  }else{

    return TRUE;

  }

}

public function distinto_cero($valor){

  if(empty($valor)){ 
     $this->form_validation->set_message('distinto_cero',
      'Debe seleccionar un Valor de la lista %s');
    return FALSE;
    }
  if($valor!='0'){
     
    return TRUE;
  }else{
     $this->form_validation->set_message('distinto_cero',
      'Debe seleccionar un Valor de la lista %s');
    return FALSE;
  }


}





  public function listar_roles($parametros=array())
  {
     $mensaje_error="";
    $mensaje_exito="";
    extract($parametros);  

    $datos=datos_usuario_actual();
    $info=informacion_usuario($datos['codigo_usuario']);
    $nivel=$info['nivel_rol'];

    $roles=$this->modelo_base_m->roles($nivel);      
  
    $variables=array(
                'roles'         => $roles,
                'mensaje_error' => $mensaje_error,
                'mensaje_exito' => $mensaje_exito,
      );

    $this->load->view('crud_roles/listar_registros_roles_v',$variables);
    

  }

  public function editar_rol($operacion='m', $codigo_rol="",$parametros=array())
  {  
    $mensaje_error="";
    $mensaje_exito="";
    extract($parametros);  

    $datos=datos_usuario_actual();
    $info=informacion_usuario($datos['codigo_usuario']);  
    $codigo_sistema='SIST01';
    $parametros=array(
                'codigo_sistema'=> $codigo_sistema,
                
      );
    if($codigo_rol!=""){
      $parametros['codigo_rol']=$codigo_rol;
       $informacion_rol=$this->modelo_base_m->informacion_rol($codigo_rol);
    }
 
    $permisos=$this->modelo_base_m->permisos($parametros);

    $modulo='';
    $aux='0';
    $resultado=array();
    $modulos=array();


    foreach ($permisos as $indice => $value) {
      if($modulo!=$value['modulo']){
        $modulo_aux=$value['codigo_modulo'];
       $modulos[$value['codigo_modulo']]=$value['modulo'];
        $aux='0';    
      }
        if($value['codigo_permiso']!=''){
          if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
            $resultado[$modulo_aux][$value['codigo_permiso']]=$value['permiso'];        
        }else{
           if(!isset($resultado[$modulo_aux]))$resultado[$modulo_aux]=array();
            $resultado[$modulo_aux][$value['codigo_permiso']]='VACIO';
        }
        $modulo=$value['modulo'];
        $aux++;    
    }
  


    $variables=array(
          'informacion_usuario' => $info,
          'operacion'           => $operacion,
          'codigo_rol'          => $codigo_rol,
          'modulos'             => $modulos,
          'permisos'            => $resultado,
          'codigo_sistema'      => $codigo_sistema,
          'mensaje_error'       => $mensaje_error,
          'mensaje_exito'       => $mensaje_exito,
          
      );

    if($operacion=='e'){
    $modulos_rol=$this->modelo_base_m->modulos_permisos_rol($parametros);
    extract($modulos_rol);
    $modulos_rol=$modulos;
    $permisos_rol=$permisos;
    $modulos_rol=compact('modulos_rol','permisos_rol');//aqui unimos en un arreglo la informacion de los modulos y permisos del rol que se quiere consultar
      $variables['modulos_rol']=$modulos_rol;
      $variables['informacion_rol']= $informacion_rol;
    }

  $this->load->view('crud_roles/registro_roles_v',$variables);

  }



public function actualizar_rol(){

$aux='';
$aux1='';
//este  for para saber que por lo menos selecciono un modulo y pasar a validar el otro campo
 foreach ($_POST as  $valor) {
  $aux1=substr($valor,0,2);
  if($aux1=='MD')$aux++;
  
 }
 
    if($aux >0){

    
        $validar = array(
                     array(
                           'field'   => 'nombre_rol',
                           'label'   => 'Nombre Rol',
                           'rules'   => 'required'
                        ),
               
                   
                  );

          $this->form_validation->set_rules($validar); 

          if ($this->form_validation->run() == FALSE)
          {


            $this->registro('error');
          }
          else
          { 

            $codigo_sistema='SIST01';  
            $datos['codigo_sistema']=$codigo_sistema;     
            $datos['nombre_rol']=strtoupper($this->input->post('nombre_rol'));
            $datos['descripcion_rol']=strtoupper($this->input->post('descripcion_rol'));
            $datos['codigo_rol']=$this->input->post('codigo_rol');       
            $modulos=array();
            $permisos=array();
            $aux="";      
           
            foreach ($_POST as $indice => $valor) {
              $aux=substr($indice,0,3);
             
              if($aux=='mod'){array_push($modulos, $valor);}
              if($aux=='per'){array_push($permisos, $valor);} 
              $aux="";
              # code...
            }
           $datos['modulos']=$modulos;
           $datos['permisos']=$permisos;

           
           if($this->modelo_base_m->actualizar_rol($datos)){
             $parametros=array('mensaje_exito'=>'Rol Actualizado con Exito!! ');
              $this->listar_roles($parametros);
           }else{
             $parametros=array('mensaje_error'=>'Ocurrio un error');
             $this->editar_rol('error','',$parametros);
           } 

          }

    }else{
      $parametros=array('mensaje_error'=>'Debe Seleccionar algun modulo ');
      $this->registro('error','',$parametros);
    } 

}


public function eliminar_rol($codigo_rol)
{
  $codigo_sistema='SIST01';
  $parametros=array(
                    'codigo_rol'     => $codigo_rol,
                    'codigo_sistema' => $codigo_sistema
                    );
  
  $salida=$this->modelo_base_m->eliminar_rol($parametros);

  $this->listar_roles($salida);

}










  public function filtrar_registros(){
    echo "filtrar registro";
  }

  public function vista_preliminar_registro( $id ){
    echo "vista preliminar registro $id";
  }

  public function exportar_registros(){
    echo "exportar registros";
  }








  // *******************************************************************
}