<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model('crud/registros_m');
  }
	public function index(){
		$this->listar_registros();
	}
	public function portada_modulo() {
		redirect(site_url().'/controller_base_c/metodo_demo', 'location');
	}
  public function mostrar_lista_tipos_comensales(){
    $tabla = 'cobi.v_poblacion'; //VISTA no tabla .... jjy para poder traer los nombres de raciones
    $datos = $this->registros_m->datos_tabla_secundaria( $tabla );

    $parametros = array(
      'id_dialogo'     => 'tipo_comensales',
      'titulo_dialogo' => 'Tipos de Comensales',
      'instrucciones'  => 'Seleccione el tipo de comensales según la lista siguiente.',
      'columnas'       => array(
          'nombre'                 => 'Tipo de Comensal',
          'descripcion'            => 'Descripción',
          'requerimiento_calorico' => 'RCT',
          'nombre_racion'          => 'Ración',
      ),
      'formato_columnas'  => array(
          'nombre'                 => '<a href="javascript:seleccionar_item( \'tipo_comensales\', \'{@codigo_poblacion}\',\'{@nombre}\',\'{@requerimiento_calorico}\',\'{@nombre_racion}\',\'{@fi_cantidad_proteinas}|{@fi_cantidad_grasas}|{@fi_cantidad_carbohidratos}|{@fi_cantidad_carbohidratos_complejos}|{@fi_cantidad_carbohidratos_complejos}\');">{@nombre}</a>',
          'requerimiento_calorico' => '{@requerimiento_calorico} Kcal',
      ),
      'datos'       => $datos,
    );
    $this->load->view('dialogo_simple_v.php', $parametros );
  }
  public function mostrar_lista_proveedores(){
    $tabla = 'cobi.v_proveedores'; //VISTA no tabla .... jjy para poder traer los nombres de raciones
    $datos = $this->registros_m->datos_tabla_secundaria( $tabla );

    $parametros = array(
      'id_dialogo'     => 'proveedores',
      'titulo_dialogo' => 'Proveedores',
      'instrucciones'  => 'Seleccione el proveedor según la lista siguiente.',
      'columnas'       => array(
          'nombre_razon_social'                 => 'Nombre del Proveedor',
          'rif'       => 'RIF',
          'direccion' => 'Dirección',
          'telefono'  => 'Teléfono',
      ),
      'formato_columnas'  => array(
          'nombre_razon_social'                 => '<a href="javascript:seleccionar_item( \'proveedores\', \'{@codigo_proveedor}\', \'{@nombre_razon_social}\');">{@nombre_razon_social}</a>',
      ),
      'datos'       => $datos,
    );
    $this->load->view('dialogo_simple_v.php', $parametros );
  }
	public function mostrar_dialogo(){
    $parametros = array();
		$this->load->view('dialogo_con_fondo_v.php', $parametros );
	}
  public function eliminar_registro( $id_registro ){
    $tabla_asociada = 'cobi.t_planes_menu';
    $parametros = array(
      'tabla_asociada' => $tabla_asociada,
    );
    $codigo_plan = $this->registros_m->codigo_segun_id( $tabla_asociada, 'codigo_plan_menu', $id_registro );
    $condicion = " codigo_plan_menu = '$codigo_plan' ";

    $tabla = 'cobi.t_dias_plan_menu';
    $this->registros_m->eliminar_registros_segun_condicion( $tabla, $condicion );

    $tabla = 'cobi.t_tiempos_plan_menu';
    $this->registros_m->eliminar_registros_segun_condicion( $tabla, $condicion );

    $tabla = 'cobi.t_formula_institucional_plan';
    $this->registros_m->eliminar_registros_segun_condicion( $tabla, $condicion );

    
    $this->registros_m->eliminar_registro( $id_registro, $parametros );

    $parametros = array(
      'mensaje' => 'El registro fue elimiando con éxito.',
      'tipo_mensaje' => 'verde',
    );
    $this->listar_registros( $parametros );
  }
  public function guardar_registro(){
    // el formulario debe traer TODO lo necesario para realizar el guardado del registro!!!! ... jjy
    $tabla_plan = 'cobi.t_planes_menu';
    $data_formulario = $this->input->post();
    $info_valido = $this->validar_registro( $data_formulario, 'plan_menu' );
    
    if ( $info_valido[0] == "OK" ){

      // se guarda el registro basico de planes_menu!!!! en funcion de los campos sencillos y los datos del formulario .... jjy !!!!!
      $rslt = $this->registros_m->guardar_registro( $data_formulario );
      // se obtiene el nuevo codigo del plan agregado !!! ... jjy
      $id_registro = $rslt['id'];
      $codigo_plan = $this->registros_m->codigo_segun_id( $tabla_plan, 'codigo_plan_menu', $id_registro );
      //prp($data_formulario);

      //se recorren de nuevo TODOS los campos para buscar valores especiales que se guarden en otras tablas, etc. .... jjy
      foreach( $data_formulario as $id_campo => $valor ){

        $esquema_bd = "";
        $tabla_asociada = "";
        $prefijo = substr( $id_campo, 0, 7 );

        //se identifica si NO es un campo normal con prefijos simples y ademas un ARREGLO
        if ( ! in_array( $prefijo, array('campo__', 'autoc__') ) && strpos( $id_campo, '__') !== false ){
          $partes_campo = explode('__',$id_campo);
          $esquema_bd = $partes_campo[0];
          $tabla_asociada = $esquema_bd.'.'.$partes_campo[1];
          $id_campo = 'campo__'.$partes_campo[2];
        }

        $data_a_guardar = array(); // se reinicializa
        //bloque para guardar datos secundarios dias_semana_plan!!!!!!!!!!!!!!! ... jjy
        if ( is_array( $valor ) &&  $id_campo == 'campo__codigo_dia_semana' )  {
          // debe existir!! tabla_asociada !!! ... jjy
          $data_a_guardar['tabla_asociada'] = $tabla_asociada;
          $data_a_guardar['campo__codigo_plan_menu'] = $codigo_plan;
          $data_a_guardar['autoc__codigo_dia_plan'] = '';

          //se eliminan los registros anteriores de t_dias_plan_menu antes de guardar los nuevos registros .... jjy
          $condiciones_eliminar = " codigo_plan_menu = '$codigo_plan' ";
          $rslt = $this->registros_m->eliminar_registros_segun_condicion( $tabla_asociada, $condiciones_eliminar );

          foreach ($valor as $id_item => $valor_item) {
            //prp($id_registro . '@'.$codigo_plan.' * '. $esquema_bd.'.'.$tabla_asociada.' - '.$id_campo . ':'.$id_item. ' - '.$valor_item); 
            $data_a_guardar[$id_campo] = $valor_item;
            $rslt = $this->registros_m->guardar_registro( $data_a_guardar );
          }
        }

        $data_a_guardar = array(); // se reinicializa
        //bloque para guardar datos secundarios tiempos_comida_plan!!!!!!!!!!!!!!! ... jjy
        if ( is_array( $valor ) &&  $id_campo == 'campo__codigo_tiempo_comida' ) {
          //se eliminan los registros anteriores de t_dias_plan_menu antes de guardar los nuevos registros .... jjy
          $condiciones_eliminar = " codigo_plan_menu = '$codigo_plan' ";
          $rslt = $this->registros_m->eliminar_registros_segun_condicion( $tabla_asociada, $condiciones_eliminar );

          // debe existir!! tabla_asociada !!! ... jjy
          $data_a_guardar['tabla_asociada'] = $tabla_asociada;
          $data_a_guardar['campo__codigo_plan_menu'] = $codigo_plan;
          $data_a_guardar['autoc__codigo_tiempo_plan_menu'] = '';

          foreach ($valor as $id_item => $valor_item) {
            $aux_valor = explode(':', $valor_item);

            $id_relacion_item = $aux_valor[0]; //para relacion con otros campos ... Kcal, %, g .... etc
            if ( isset ( $aux_valor[1] ) ){
              $valor_item = $aux_valor[1];
            }

            //prp($id_registro . '@' . $codigo_plan.' * '. $esquema_bd.'.'.$tabla_asociada.' - '.$id_campo . ':'.$id_item. ' - '.$valor_item); 
            $data_a_guardar[$id_campo] = $valor_item;
            $rslt = $this->registros_m->guardar_registro( $data_a_guardar );

            $id_tiempo_comida[ ( string ) $id_relacion_item ] = $rslt['id'];
            $codigo_tiempo[ ( string ) $id_relacion_item ]    = $valor_item;

          }
        }

        $data_a_guardar = array(); // se reinicializa
        //bloque para guardar datos secundarios tiempos_comida_plan!!!!!!!!!!!!!!! ... jjy
        if ( is_array( $valor ) &&  $id_campo == 'campo__rct_tiempo_comida' ) {
          //NO se eliminan los registros anteriores de t_dias_plan_menu porque se guardaran valores complementarios .... jjy

          // debe existir!! tabla_asociada !!! ... jjy
          $data_a_guardar['tabla_asociada'] = $tabla_asociada;
          $data_a_guardar['campo__codigo_plan_menu'] = $codigo_plan;
          //$data_a_guardar['id'] = $id_tiempo_comida;

          //prp( $codigo_tiempo );

          //$id_relacion_item = 'n/a';
          foreach ($valor as $id_item => $valor_item) {
            /*$aux_valor = explode(':', $valor_item);

            if ( isset ( $aux_valor[1] ) ){
              $valor_item = $aux_valor[1];
              $id_relacion_item = $aux_valor[0]; //para relacion con otros campos ... Kcal, %, g .... etc
            }*/
            if ( isset( $codigo_tiempo[ $id_item ] ) ){

              // para actualizar el registro con el rct para el mismo tiempo de comida !!! ... jjy
              $data_a_guardar['id'] = $id_tiempo_comida[ $id_item ];
              $data_a_guardar['condicion_adicional'] = array( 'codigo_tiempo_comida' => $codigo_tiempo[ $id_item ] );

              //prp($data_a_guardar['condicion_adicional']);
              //prp($id_registro . '@' . $codigo_plan.' * '. $esquema_bd.'.'.$tabla_asociada.' - '.$id_campo . ':'.$id_item. ' - '.$valor_item); 

              $data_a_guardar[$id_campo] = $valor_item;
              $rslt = $this->registros_m->guardar_registro( $data_a_guardar );

            }
          }
        }

        $data_a_guardar = array(); // se reinicializa
        //bloque para guardar datos secundarios tiempos_comida_plan!!!!!!!!!!!!!!! ... jjy
        if ( $tabla_asociada == $esquema_bd.'.t_formula_institucional_plan' ) {
          //se eliminan los registros anteriores de t_dias_plan_menu antes de guardar los nuevos registros .... jjy
          $condiciones_eliminar = " codigo_plan_menu = '$codigo_plan' ";
          $rslt = $this->registros_m->eliminar_registros_segun_condicion( $tabla_asociada, $condiciones_eliminar );

          // debe existir!! tabla_asociada !!! ... jjy
          $data_a_guardar['tabla_asociada'] = $tabla_asociada;
          $data_a_guardar['campo__codigo_plan_menu'] = $codigo_plan;
          $data_a_guardar['autoc__codigo_formula_institucional_plan'] = '';

/**
 POR AQUI .... FALTA MOSTRAR ..... PROTEINA .... Y LUEGO RECALCULAR EN BASE A %!!!!!!! .... TAMBIEN FALTA LA DISTRIBUCION POR TIEMPOS
**/






          //prp($id_registro . '@' . $codigo_plan.' * '. $esquema_bd.'.'.$tabla_asociada.' - '.$id_campo . ':'.$id_item. ' - '.$valor_item); 
          $data_a_guardar[$id_campo] = $valor_item;
          $rslt = $this->registros_m->guardar_registro( $data_a_guardar );

          $id_tiempo_comida[ ( string ) $id_relacion_item ] = $rslt['id'];
          $codigo_tiempo[ ( string ) $id_relacion_item ]    = $valor_item;

        }

      }

      //se muestra el registro recien guardado ... jjy
      $parametros = array(
        'mensaje'      => 'El plan ha sido guardado exitosamente.',
        'tipo_mensaje' => 'verde',
      );
      $this->registro( 'm', $id_registro, $parametros );

    } else {
      
      $this->registro( 'n', '', $data_formulario );            
    }
  }
  public function validar_registro( $data_formulario, $id_entidad = "" ){
    $salida = array(
      0 => 'OK',
      'mensaje' => "",
    );
    return $salida;
  }
	public function listar_registros( $parametros = array() ){
    $mensaje = '';
    $tipo_mensaje = '';
    extract( $parametros );

    $datos = $this->registros_m->lista_planes_menu();
    $parametros['datos'] = $datos;
    
		$this->load->view( 'crud/listar_registros_v.php', $parametros );
	}
	
  /** 
  ESTE METODO CONTROLA TODO EL MANEJO DE REGISTRO DE PLAN DE MENU ..... ...jjy
  **/
  public function registro( $operacion = 'm', $id_registro = '', $parametros = array() ){
    // las operaciones pueden ser 'x'= eliminar; m'= mostrar; 'n'= nuevo; 'e'= editar ...... jjy ... experimental

    // en este punto se deberían volver a validar los permisos para la acción solicitada .... jjy
    $mensaje = '';
    $tipo_mensaje = '';
    
    extract( $parametros );

    //se preparan los parametros que se pasaran a la vista registro_v .... !!!
    $tabla = 'cobi.v_planes_menu';
    $parametros = array(
      'operacion'      => $operacion,
      'id_registro'    => $id_registro,
      'tiempos_comida' => $this->registros_m->datos_tabla_secundaria( 'cobi.t_tiempos_comida' ),
      'mensaje'        => '',
    );
    //Informacion secundaria y de apoyo al registro ---- dias de semana, tiempos de comida, formula_institucional, etc ... !
    $dias_semana           = $this->registros_m->datos_tabla_secundaria( 'cobi.t_dias' );        

    if( $operacion == 'x' ){ // x=eliminar

      // ACCION SOLO ELIMINAR ... se debe validar nuevamente si el usuario tiene permiso para esto!!!!! ... jjy ojo!
      $this->eliminar_registro( $id_registro );

    } else if( $operacion != 'n' ){ 
      // diferente de x=eliminar y de n=nuevo --->>> ( m=mostrar, e=editar )

      //SE DEFINEN LAS CONDICIONES QUE PERMITIRAN ASOCIAR A LAS TABLAS SECUNDARIAS Y DE APOYO CON el registro principal! .... IMPORTANTE! ---- jjy
      $codigo_plan_menu = $this->registros_m->codigo_segun_id( 'cobi.t_planes_menu', 'codigo_plan_menu', $id_registro );
      $condiciones      = array( 'codigo_plan_menu' => $codigo_plan_menu );

      //Informacion basica del registro ---- plan de menu en este caso ... !
      $registro = $this->registros_m->extraer_registro_segun_id( $tabla, $id_registro );
        //Informacion secundaria y de apoyo al registro ---- dias de semana, tiempos de comida, formula_institucional, etc ... !
        $dias_plan             = $this->registros_m->extraer_registros_segun_condicion( 'cobi.t_dias_plan_menu'   , $condiciones );
        $tiempos_comida_plan   = $this->registros_m->extraer_registros_segun_condicion( 'cobi.t_tiempos_plan_menu', $condiciones );
        $formula_institucional = $this->registros_m->extraer_registros_segun_condicion( 'cobi.t_formula_institucional_plan', $condiciones );

      $formula_institucional['cantidad_proteina']     = 25;
      $formula_institucional['cantidad_grasa']        = 15;
      $formula_institucional['cantidad_carbohidrato'] = 55;
      $formula_institucional['cantidad_simple']       = 45;
      $formula_institucional['cantidad_complejo']     = 15;

      //se preparan los datos de tablas secundarias y de apoyo para ser pasados a la vista !!!
      $parametros['registro']                          = $registro;
      $parametros['registro']['dias_plan']             = $dias_plan;
      $parametros['registro']['tiempos_comida_plan']   = $tiempos_comida_plan;
      $parametros['registro']['formula_institucional'] = $formula_institucional;

    }

    //se preparan los mensaje si fueran necesarios .... jjy!!
    $parametros['registro']['dias_semana'] = $dias_semana;
    $parametros['mensaje']                 = $mensaje;
    $parametros['tipo_mensaje']            = $tipo_mensaje;

    if ( $operacion != 'x' ) {
      //solo en caso de NO estar eliminando el registro se carla la vista registro_v ... caso contrario se regresa el control a listar_registros! ... jjy
      $this->load->view( 'crud/registro_v', $parametros );

    }
  }

  public function plan_interactivo( $id_plan = "" ){
    $parametros['id_plan_menu'] = $id_plan;
    $this->load->view( 'plan_interactivo_v', $parametros );
  }

}