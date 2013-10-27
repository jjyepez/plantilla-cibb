<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_base_m extends CI_Model {

    function __construct(){
         parent::__construct();
    }
    
 

    public function informacion_usuario($value='')
    {  
        $this->db->select  ( 'id,codigo_persona,codigo_usuario,nombre_usuario,codigo_rol,rol_usuario,correo_electronico,codigo_estatus,estatus_usuario,rol_usuario' );
        $this->db->from('seguridad.v_informacion_usuarios');
        $this->db->where('codigo_usuario', $value);        
        $rs=$this->db->get();
        $resultado =$rs->result_array();

        return $resultado;
    }
    public function listar_usuario($parametros = array())
    {
        extract($parametros);

        $this->db->select  ( 'id,codigo_usuario,nombre_usuario,rol_usuario,correo_electronico,estatus_usuario' );
        $this->db->from('seguridad.v_informacion_usuarios');
        $this->db->where('nivel_rol >', $nivel);
        $this->db->where('codigo_sistema', $codigo_sistema);
        $this->db->order_by('nivel_rol');      
        $rs=$this->db->get();
        $resultado =$rs->result_array();

        return $resultado;
    }

    public function roles($nivel='')
    { 
        $codigo_sistema='SIST01';//esta variable debe provenir del entorno global
       
        $this->db->select  ( 'id,codigo_rol,nombre_rol,descripcion_rol');
        $this->db->from('seguridad.t_roles');
        $this->db->where('nivel >', $nivel);
        $this->db->where('codigo_sistema', $codigo_sistema);
        if($nivel!=0)$this->db->where_not_in('nombre_rol ', 'GENERAL');
        $this->db->order_by('nivel', 'asc');
        $rs=$this->db->get();
        $resultado =$rs->result_array();

        return $resultado;
    }

    public function permisos($parametros)
    {    
        $codigo_sistema="";
        $codigo_modulo="";
        extract($parametros);
        
        $this->db->select('*');
        $this->db->from('seguridad.v_informacion_modulos_permisos');
        if($codigo_sistema!="" && $codigo_modulo==""){
        $this->db->where('codigo_sistema',$codigo_sistema);
        }
        elseif($codigo_modulo!="" && $codigo_sistema==""){
        $this->db->where('codigo_modulo',$codigo_modulo); 
        }else{
         $this->db->where('codigo_modulo',$codigo_modulo); 
         $this->db->where('codigo_sistema',$codigo_sistema); 
        }
        $rs=$this->db->get();
        $resultado =$rs->result_array();

        return $resultado;
       
    }

    public function modulos_sistema($value='')
    {
      
        $this->db->select('id,codigo_modulo,nombre_modulo');
        $this->db->from('seguridad.t_modulos');
        $this->db->where('codigo_sistema',$value);       
        $rs=$this->db->get();
        $resultado =$rs->result_array();
     
        return $resultado;
    }

    public function permisos_modulo($codigo_modulo='')
    {
        
        $this->db->select('codigo_permiso,nombre_permiso');
        $this->db->from('seguridad.t_permisos');
        $this->db->where('codigo_modulo',$codigo_modulo);         

        $rs=$this->db->get();
        $resultado =$rs->result_array();
       
        return $resultado;
    }

    public function modulos_permisos_rol($parametros)
    {

        $codigo_rol="";
        $codigo_sistema="";
        extract($parametros);

        $this->db->select('codigo_modulo_negado');
        $this->db->from('seguridad.v_modulos_negados_roles');
        $this->db->where('codigo_rol', $codigo_rol);
        $this->db->where('codigo_modulo_negado is not null');
        
        $rs=$this->db->get();

        if($rs->num_rows > 0){
            $resultado=$rs->result_array();
            $modulos_negados=array();
            foreach ($resultado as  $valor) {
                foreach ($valor as $valor1) {
                    array_push($modulos_negados, $valor1);                
                }
            }


            $this->db->select('codigo_modulo,nombre_modulo');
            $this->db->from('seguridad.t_modulos');
            $this->db->where_not_in('codigo_modulo', $modulos_negados);
            $this->db->where('codigo_sistema', $codigo_sistema);

            $rs=$this->db->get();

            $aux=$rs->result_array();
            $salida['modulos']=$rs->result_array();
            $codigo_modulo=array();

            foreach ($aux as  $valor) {    //necesitamos guardar el codigo modulo del que dispone el usuario para solo seleccionar modulos del sistema que se esta usando         
                array_push($codigo_modulo, $valor['codigo_modulo']);            

            }
    
            
     

        }else{
                $this->db->select('codigo_modulo,nombre_modulo');
                $this->db->from('seguridad.t_modulos');
                $this->db->where('codigo_sistema', $codigo_sistema);
                $rs=$this->db->get();
                $aux=$rs->result_array();
                $salida['modulos']=$rs->result_array();

                $codigo_modulo=array();

                foreach ($aux as  $valor) {//necesitamos guardar el codigo modulo del que dispone el usuario para solo seleccionar modulos del sistema que se esta usando         
                    array_push($codigo_modulo, $valor['codigo_modulo']);             
                }

 
        }


                $this->db->select('codigo_permiso_negado');
                $this->db->from('seguridad.v_permisos_negados_roles');
                $this->db->where('codigo_rol', $codigo_rol);
                $this->db->where('codigo_permiso_negado is not null');


                $rs=$this->db->get();


                if($rs->num_rows > 0){
                    $resultado2=$rs->result_array();
                    $permisos_negados=array();


                    foreach ($resultado2 as  $valor) {
                        foreach ($valor as $valor1) {
                            array_push($permisos_negados, $valor1);                
                        }
                    }

                    $this->db->select('codigo_modulo,codigo_permiso,nombre_permiso');
                    $this->db->from('seguridad.t_permisos');
                    $this->db->where_not_in('codigo_permiso', $permisos_negados);
                    $this->db->where_in('codigo_modulo',$codigo_modulo);

                    $rs=$this->db->get();
                    $salida['permisos']=$rs->result_array();


                }else{
                    $this->db->select('codigo_modulo,codigo_permiso,nombre_permiso');
                    $this->db->from('seguridad.t_permisos'); 
                    $this->db->where_in('codigo_modulo', $codigo_modulo);               
                    $rs=$this->db->get();
                    $salida['permisos']=$rs->result_array();

                }

              

        return $salida;


    }

    public function existe_usuario($usuario='')
    {

        $this->db->from('seguridad.t_usuarios');
        $this->db->where('nombre_usuario ilike', $usuario);
        $rs=$this->db->get();

        if($rs->num_rows() > 0){
              
            return TRUE;
        }else{            
            return FALSE;

        }

    
    }

    public function existe_nombre_rol($nombre_rol='')
    {

        $this->db->from('seguridad.t_roles');
        $this->db->where('nombre_rol ilike', $nombre_rol);
        $rs=$this->db->get();       
        if($rs->num_rows() > 0){
              
            return TRUE;
        }else{            
            return FALSE;

        }
        
    }

    public function registro_rol($datos=array())
    {
   
        $codigo_sistema=$datos['codigo_sistema'];
        $modulos=$datos['modulos'];
        $permisos=$datos['permisos'];
        unset($datos['modulos']);
        unset($datos['permisos']);

        if($this->db->insert('seguridad.t_roles', $datos)){
            $id_rol=$this->db->insert_id();
            $codigo_rol='RU'.sprintf("%04s", $id_rol);
            $rol=array( 'codigo_rol' => $codigo_rol,
                        );         
            $this->db->where('id', $id_rol); 
            $this->db->update('seguridad.t_roles', $rol);


            $this->db->select('codigo_modulo');
            $this->db->from('seguridad.t_modulos');
            $this->db->where('codigo_sistema', $codigo_sistema);
            $this->db->where_not_in('codigo_modulo', $modulos);

            $rs=$this->db->get();


            if($rs->num_rows()>0){
                $resultado=$rs->result_array();
                
                foreach ($resultado as  $valor) {
                    $parametros=array( 
                                'codigo_rol'    => $codigo_rol,
                                'codigo_modulo_negado' => $valor['codigo_modulo'],
                        );
                    $this->db->insert('seguridad.t_usuarios_modulos_negados', $parametros);
                }

            }
        
            $this->db->select('codigo_permiso,codigo_modulo');
            $this->db->from('seguridad.t_permisos');            
            if(!empty($permisos)){
                $this->db->where_not_in('codigo_permiso', $permisos);
            }
            $this->db->where_in('codigo_modulo', $modulos);

            $rs=$this->db->get();

             if($rs->num_rows()>0){
                $resultado=$rs->result_array();
               // prp($resultado,1);
                foreach ($resultado as  $valor) {
                    $parametros=array( 
                                'codigo_rol'             => $codigo_rol,
                                'codigo_permiso_negado'  => $valor['codigo_permiso'],
                                'codigo_modulo'          => $valor['codigo_modulo']

                        );
                    $this->db->insert('seguridad.t_usuarios_permisos_negados', $parametros);
                }

            }

            return TRUE;
        }else{
            return FALSE;
        }
        //if()
    }

    public function actualizar_rol($datos=array())
    {
        

        $codigo_sistema=$datos['codigo_sistema'];
        $codigo_rol=$datos['codigo_rol'];
        $modulos=$datos['modulos'];
        $permisos=$datos['permisos'];
        unset($datos['modulos']);
        unset($datos['permisos']);
        unset($datos['codigo_sistema']);
        unset($datos['codigo_rol']);

       
        $this->db->where('codigo_rol', $codigo_rol);
        $this->db->delete('seguridad.t_usuarios_modulos_negados');       
            
        $this->db->where('codigo_rol', $codigo_rol);
        $this->db->delete('seguridad.t_usuarios_permisos_negados');


        $this->db->where('codigo_rol', $codigo_rol); 
        $this->db->update('seguridad.t_roles', $datos);




            $this->db->select('codigo_modulo');
            $this->db->from('seguridad.t_modulos');
            $this->db->where('codigo_sistema', $codigo_sistema);
            $this->db->where_not_in('codigo_modulo', $modulos);

            $rs=$this->db->get();


            if($rs->num_rows()>0){
                $resultado=$rs->result_array();
              
                foreach ($resultado as  $valor) {
                    $parametros=array( 
                                'codigo_rol'    => $codigo_rol,
                                'codigo_modulo_negado' => $valor['codigo_modulo'],
                        );
                    $this->db->insert('seguridad.t_usuarios_modulos_negados', $parametros);
                }

            }
            
            $this->db->select('codigo_permiso,codigo_modulo');
            $this->db->from('seguridad.t_permisos');            
            if(!empty($permisos)){
                $this->db->where_not_in('codigo_permiso', $permisos);
            }
            $this->db->where_in('codigo_modulo', $modulos);

            $rs=$this->db->get();

             if($rs->num_rows()>0){
                $resultado=$rs->result_array();
               
                foreach ($resultado as  $valor) {
                    $parametros=array( 
                                'codigo_rol'             => $codigo_rol,
                                'codigo_permiso_negado'  => $valor['codigo_permiso'],
                                'codigo_modulo'          => $valor['codigo_modulo']

                        );
                    $this->db->insert('seguridad.t_usuarios_permisos_negados', $parametros);
                }
            }

        return TRUE;

    }


    public function registro_usuario($parametros=array())
    {
        if($parametros=='')return FALSE;
   



        $rol_usuario=$parametros['rol'];
        $persona=$parametros['persona'];
        unset($parametros['rol']);
        unset($parametros['persona']);
  

        
        if($this->db->insert('seguridad.t_personas', $persona)){
            $id=$this->db->insert_id();
            $codigo='PE'.sprintf("%04s", $id );
            $persona=array( 'codigo_persona' => $codigo,
                        );         
            $this->db->where('id', $id); 
            $this->db->update('seguridad.t_personas', $persona);
            $parametros['codigo_persona']=$codigo;

            if($this->db->insert('seguridad.t_usuarios', $parametros)){
                $id=$this->db->insert_id();
                $codigo='US'.sprintf("%04s", $id );
                $usuario=array( 'codigo_usuario' => $codigo,
                            );         
                $this->db->where('id', $id); 
                $this->db->update('seguridad.t_usuarios', $usuario);
                
                $rol_usuario['codigo_usuario']=$codigo;               

                if($this->db->insert('seguridad.t_usuarios_roles',$rol_usuario)){
                    return TRUE;
                }else{
                   return FALSE;
                }
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }

       
    }

    function eliminar_registro($id)
    {

        $this->db->select('codigo_usuario,codigo_persona');
        $this->db->from('seguridad.t_usuarios');
        $this->db->where('id', $id);

        $rs=$this->db->get();
       
        if($rs->num_rows() > 0){
            $resultado=$rs->row_array();
           
            $this->db->where('codigo_usuario', $resultado['codigo_usuario']);
            $this->db->delete('seguridad.t_usuarios_roles');
            $this->db->where('codigo_persona', $resultado['codigo_persona']);
            $this->db->delete('seguridad.t_personas');
            $this->db->where('codigo_usuario', $resultado['codigo_usuario']);
            $this->db->delete('seguridad.t_usuarios');
            return TRUE;

        }else{            
            return FALSE;

        }

    }

public function actualizar_registro($datos)
{
     if(empty($datos))return FALSE;

     extract($datos);

    $this->db->select('codigo_persona');
    $this->db->from('seguridad.t_usuarios');
    $this->db->where('codigo_usuario', $codigo_usuario);

    $rs=$this->db->get();
       
        if($rs->num_rows() > 0){
            $resultado=$rs->row_array();

            $this->db->where('codigo_persona', $resultado['codigo_persona']); 
            $this->db->update('seguridad.t_personas', $persona);

            $this->db->where('codigo_usuario', $codigo_usuario); 
            $this->db->update('seguridad.t_usuarios', $usuario);

            $this->db->where('codigo_usuario',$codigo_usuario ); 
            $this->db->update('seguridad.t_usuarios_roles', $rol);
            return TRUE;
        }else{
            return FALSE;
        }

}

public function informacion_rol($codigo_rol)
{
    $this->db->from('seguridad.t_roles');
    $this->db->where('codigo_rol', $codigo_rol);

    $rs=$this->db->get();

    if($rs->num_rows()>0){

        $resultado=$rs->row_array();
    }else{
        $resultado="";
    }

    return $resultado;
}

public function eliminar_rol($parametros=array())
{   $codigo_sistema="";
    $codigo_rol="";
    extract($parametros);

    //consultamos el rol que se quiere eliminar para saber si se quiere borrar el rol general 
    //los dos sistemas deberian tener un usuario general ya que si se quiere borrar un rol
    //se deberia asignar un rol basico al usuario que tenga el rol que se desea borrar
    $this->db->select('codigo_rol,nombre_rol');
    $this->db->from('seguridad.t_roles');
    $this->db->where('codigo_rol', $codigo_rol);
    $this->db->where('codigo_sistema', $codigo_sistema);
    $rs=$this->db->get();

    $resultado=$rs->row_array();


    if($resultado['nombre_rol']!='GENERAL'){
    //si se obtiene un rol que no es general se procede a consultar el codigo del rol 
    //que tiene en el sistema el rol con nombre general para asociarlos a los usuarios que se le eliminara el rol
        $this->db->select('codigo_rol');
        $this->db->from('seguridad.t_roles');
        $this->db->where('nombre_rol ilike', 'GENERAL');
        $this->db->where('codigo_sistema', $codigo_sistema);
        $rs=$this->db->get();
            if($rs->num_rows()>0){
               
                $codigo_rol_general=$rs->row_array();
                $codigo_rol_general=$codigo_rol_general['codigo_rol'];
                //procedemos a seleccionar todos los usuarios con el rol a borrar
                $this->db->select('codigo_usuario');
                $this->db->from('seguridad.t_usuarios_roles');
                $this->db->where('codigo_rol', $codigo_rol);   
                $rs=$this->db->get();
                if($rs->num_rows()>0){
                    $resultado=$rs->result_array();

                    foreach ($resultado as $valor) {
                        $usuarios[]=$valor['codigo_usuario'];
                    }
                    $actualizar=array('codigo_rol'=>$codigo_rol_general);

                    $this->db->where_in('codigo_usuario', $usuarios);
                    $this->db->update('seguridad.t_usuarios_roles', $actualizar);
                }
                //procedemos a borrar todos los modulos y apermisos asociados al rol que vamos a borrar
                $tablas=array('seguridad.t_usuarios_modulos_negados','seguridad.t_usuarios_permisos_negados','seguridad.t_roles'
                    );
                $this->db->where('codigo_rol', $codigo_rol);
                $this->db->delete($tablas);

                $salida=array(
                            'mensaje_exito' => 'El Rol a sido Borrado con Exito!!',
                           
                              );
            }else{
                //este caso es para cuando no existe rol General dentro de un sistema no dejara borrar el rol
               $salida=array(
                            'mensaje_error' => 'El Rol No Puede Borrarse',
                            
                              ); 
            }


     
    }else{
        //este caso es para cuando se intenta borrar el rol General
        $salida=array(
                            'mensaje_error' => 'Este Rol No Puede Ser Borrado',
                           
                              ); 
    }
    

    return $salida;
}


public function registrar_modulo($datos=array())
{
    $codigo_sistema=$datos['codigo_sistema'];
    if(isset($datos['permisos'])){
        $permisos=$datos['permisos'];
        unset($datos['permisos']);
    }
  
    $this->db->insert('seguridad.t_modulos', $datos);
    $id=$this->db->insert_id();
   
    $codigo_modulo='MD'.sprintf("%04s", $id );
    $modulo=array( 'codigo_modulo' => $codigo_modulo,
                );         
    $this->db->where('id', $id); 
    $this->db->update('seguridad.t_modulos', $modulo);

    $this->db->select('codigo_rol');
    $this->db->from('seguridad.t_roles');
    $this->db->where('nivel !=', 0);
    $this->db->where('codigo_sistema', $codigo_sistema);
    $rs=$this->db->get();

        if($rs->num_rows>0){
            $resultado=$rs->result_array();
            foreach ($resultado as $valor) {
                $roles[]=$valor['codigo_rol'];
          
            }

            foreach ($roles as $valor) {
               
                    $modulo_negado=array('codigo_modulo_negado' => $codigo_modulo,
                                             'codigo_rol' => $valor,
                                             
                                        );
                    $this->db->insert('seguridad.t_usuarios_modulos_negados', $modulo_negado); 
               
            }

        }

        if(isset($permisos)){
            foreach ($permisos as $valor) {
                $permisos_insert=array(
                                'codigo_permiso' => rand(0,9999),
                                'codigo_modulo'  => $codigo_modulo,
                                'nombre_permiso' => $valor,
                        );

                $this->db->insert('seguridad.t_permisos', $permisos_insert);
                $id=$this->db->insert_id();
          
                $codigo_permiso='PR'.sprintf("%04s", $id );
                $permisos_update=array( 'codigo_permiso' => $codigo_permiso,
                            );         
                $this->db->where('id', $id); 
                $this->db->update('seguridad.t_permisos', $permisos_update);
                $nuevos_permisos[]=$codigo_permiso; 
                
            }

            foreach ($nuevos_permisos as $valor) {
                        foreach ($roles as $valor1) {
                        $permisos_negado=array('codigo_permiso_negado' => $valor,
                                                 'codigo_rol' => $valor1,
                                                 'codigo_modulo' => $codigo_modulo,
                                            );
                        $this->db->insert('seguridad.t_usuarios_permisos_negados', $permisos_negado); 
                    }
                }
                
            }

        

        $salida=array('mensaje_exito'=>'El modulo ha sido registrado con exito',);
  

return $salida;

}

public function actualizar_modulo($datos=array())
{   
    $codigo_sistema=$datos['codigo_sistema'];
    $codigo_modulo=$datos['codigo_modulo'];

    if(isset($datos['permisos_editar']))$permisos_editar=$datos['permisos_editar'];
    if(isset($datos['permisos_nuevos']))$permisos_nuevos=$datos['permisos_nuevos'];
   

    

        if(isset($permisos_editar)){
            foreach ($permisos_editar as $indice => $valor) {
                $permisos_no_eliminados[]=$indice;
            }
             
            /*$this->db->where('codigo_modulo',$codigo_modulo);
            $this->db->where_not_in('codigo_permiso',$permisos_no_eliminados);
            $this->db->delete('seguridad.t_permisos');*/
            
            foreach ($permisos_editar as $indice => $valor) {
                $permisos_update=array('nombre_permiso'=>$valor,);
                $this->db->where('codigo_permiso', $indice); 
                $this->db->update('seguridad.t_permisos', $permisos_update);
            }
        }

        
        if(isset($permisos_nuevos)){
            
            foreach ($permisos_nuevos as  $valor) {
                $permiso_registrar=array(
                                  'codigo_permiso'=>rand(0,9999),
                                  'codigo_modulo' =>$codigo_modulo,
                                  'nombre_permiso'=>$valor,

                                    );
                
                $this->db->insert('seguridad.t_permisos', $permiso_registrar);
                $id=$this->db->insert_id();
               
                $codigo_permiso='PR'.sprintf("%04s", $id );
                $permiso_registrado=array( 'codigo_permiso' => $codigo_permiso,
                            );  
                    
                $this->db->where('id', $id); 
                $this->db->update('seguridad.t_permisos', $permiso_registrado);
                $nuevos_permisos[]=$codigo_permiso;   
            }

            $this->db->select('codigo_rol');
            $this->db->from('seguridad.t_roles');
            $this->db->where('nivel !=', 0);
            $this->db->where('codigo_sistema', $codigo_sistema);
            $rs=$this->db->get();

            if($rs->num_rows>0){
                $resultado=$rs->result_array();
                foreach ($resultado as $valor) {
                    $roles[]=$valor['codigo_rol'];
                  
                }
                foreach ($nuevos_permisos as $valor) {
                    foreach ($roles as $valor1) {
                    
                        $permisos_negado=array('codigo_permiso_negado' => $valor,
                                                 'codigo_rol' => $valor1,
                                                 'codigo_modulo' => $codigo_modulo,
                                            );
                        $this->db->insert('seguridad.t_usuarios_permisos_negados', $permisos_negado); 
                    }
                }
                
            }


            
        }

         $salida=array('mensaje_exito'=>'El modulo ha sido Actualizado con exito',);


    return $salida;
}

public function eliminar_modulo($parametros=array())
{
    extract($parametros);

    $this->db->select('codigo_modulo_negado');
    $this->db->from('seguridad.t_usuarios_modulos_negados');
    $this->db->where('codigo_modulo_negado', $codigo_modulo);
    $rs=$this->db->get();
    if($rs->num_rows()==0){
        $this->db->select('codigo_permiso_negado');
        $this->db->from('seguridad.t_usuarios_permisos_negados');
        $this->db->where('codigo_modulo', $codigo_modulo);
        $rs=$this->db->get();
        if($rs->num_rows()==0){
            $this->db->where('codigo_modulo', $codigo_modulo);
            $this->db->where('codigo_sistema', $codigo_sistema);
            $this->db->delete('seguridad.t_modulos');

             $salida=array('mensaje_exito'=>'El modulo fue eliminado con exito',);
        }else{
        $salida=array('mensaje_error'=>'El modulo no se puede eliminar un permiso esta siendo usado para controlar el acceso de una funcionalidad',);
       }
    }else{
       $salida=array('mensaje_error'=>'El modulo no se puede eliminar esta siendo usado para controlar el acceso de un rol',); 
    
    }

    return $salida;
}

}