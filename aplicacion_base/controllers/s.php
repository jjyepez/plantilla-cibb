<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class S extends CI_Controller {
	var $tabs;
  
  public function __construct() {
		parent::__construct();
      /**
      Definición de Módulos del Sistema ... jjy ***
      **/

      // Se definen los t{itulos de las pestañas que han sido creadas en base a los directorios "modulo_* " ... jjy
      $modulos ['modulo_plan_menu']      = 'Planes de Menú';
      $modulos ['modulo_alimentos']      = 'Alimentos';
      $modulos ['modulo_recetas']        = 'Recetas';
      $modulos ['modulo_proveedores']    = 'Proveedores';
      $modulos ['modulo_administracion'] = 'Administración del Sistema';
  
      /**  
      	Definición de las pestañas del menú de navegación principal .... jjy ***********
      **/
      $directorio = opendir( realpath( '.' ) ); //ruta actual
      while ( $id = readdir( $directorio ) ) {
          if ( is_dir( $id ) && substr( trim( strtolower( $id ) ) , 0, 7) === 'modulo_' ) {
              if ( ! isset( $modulos [$id] ) ) {
                  $modulos [ $id ] = ucwords( str_replace( '_', ' ', $id ) );
              }
          }
      }
      $this->tabs = array(  // los que no son modulos .. sino links internos
      	'pestanas' => array(
      					'inicio'            =>'Inicio',
      				),
      	//.. para enlaces específicos ... jjy
      	'url_enlaces' => array( // los que no son modulos .. sino links internos
      					'inicio'            => site_url().'s/inicio',
      				),
      ); 

      global $menus_izquierda_activos; // definicion de menús de la izquierda  .... jjy
      $menus_izquierda_activos =  array( // se definen solo los modulos de menu-secundario-superior ó sin-menu
        'modulo_administracion'   => array( 'menu-secundario-superior' ), //'menu-secundario-superior' modo alternativo del menu! ... jjy
        'modulo_plan_menu'    => array( 'sin-menu' ), //'menu-secundario-superior' modo alternativo del menu! ... jjy
	      'modulo_alimentos'    => array( 'sin-menu' ),
        // -----------------------------------------
        'modulo_recetas'    => array( 'sin-menu' ),
        'modulo_proveedores'    => array( 'sin-menu' ),
      );
      // se incorporan los módulos a la definición de pestañas .. jjy
      foreach( $modulos as $id_modulo => $titulo_pestana ) {
         $this->tabs['pestanas']    += array( $id_modulo => $titulo_pestana );
         $this->tabs['url_enlaces'] += array( $id_modulo => site_url().'s/cm/'.$id_modulo );
         if ( ! isset( $menus_izquierda_activos[$id_modulo] ) ) {
            $menus_izquierda_activos[$id_modulo] = array();
         }
      }
      // ****** Fin de la definición de pestañas .... jjy *********************
   }

	public function index(){
		$this->cs("inicio");
	}

	public function cs( $seccion = "inicio", $parametros = array() ){
		global $config;
		$config['sesion']['seccion_activa'] = $seccion;

		$accion=( isset($parametros['accion']) && $parametros['accion']!="" )
                ?'_'.$parametros['accion']
                :"";
		$parametros['seccion'] = $seccion;
	
		$this->load->view( 'comun/encabezado_html_v', $this->tabs );
			$this->load->view('comun/menu_izquierda_v',$parametros);
			$this->load->view('/'.$seccion.'/'.$seccion.$accion.'_v',$parametros);
		$this->load->view('comun/pie_html_v');
	}

	public function inicio(){
		$this->cs ("inicio");	
	}

  public function cm ($id_modulo=""){  //cargar módulo ... jjy

    $url_modulo="javascript:alert('E!');"; // alerta de error ... 
    global $config;
    $config['sesion']['seccion_activa']	= $id_modulo;
    $config['sesion']['modulo_activo']	= $id_modulo;
    
    $url_modulo=base_url()."{$id_modulo}.php";
    $data['url_modulo']=$url_modulo;

  	$parametros['seccion'] = $config['sesion']['seccion_activa'];

  	$this->load->view( 'comun/encabezado_html_v', $this->tabs );

  		$this->load->view( 'comun/menu_izquierda_v',$parametros );
      $this->load->view( 'modulo/modulo_v',$data );
      
  	$this->load->view( 'comun/pie_html_v' );

  }

  public function iniciar_sesion(){
    $this->load->model( 'seguridad/control_usuarios_m' );

    extract( $this->input->post() ); // se extraen los valores que vienen por POST

    $resultado = validar_usuario_contrasena( $nombre_usuario, $contrasena );

    $variables = array();

    if( $resultado['rsp'] === 'OK' ){
      $variables ['mensaje']     = 'Has iniciado sesión exitosamente';
      $variables['tipo_mensaje'] = "verde";
      $codigo_usuario            = $resultado ['codigo_usuario'];
      unset ( $resultado );

      $resultado = $this->control_usuarios_m->iniciar_sesion( $codigo_usuario ); // inicia la sesion

      // REVISAR Y DEFINIR BIEN EL USO DE LAS VARIABLES DE SESSION !!!!! .. jjy  .... evitar COOKIES!!
      $_SESSION['sesion']['codigo_usuario'] = $codigo_usuario;
      $_SESSION['sesion']['cuh']            = $resultado['cuh'];

    } else {

      $variables ['mensaje']      = $resultado ['mensaje'];
      $variables ['tipo_mensaje'] = 'error';

    }

    $this->cs ("inicio", $variables ); 
  }

  public function cerrar_sesion( $causa = "" ){
    $codigo_usuario = $_SESSION['sesion']['codigo_usuario'];
    $cuh            = $_SESSION['sesion']['cuh'];

    cerrar_sesion_usuario ( $codigo_usuario, $cuh );
    $variables['mensaje'] = "Has abandonado la sesión.";

    if ( trim( $causa ) == 'exp' ){
      $variables['mensaje'] = "El tiempo de la sesión ha expirado.";
    }

    $this->cs ("inicio", $variables); 
  }

}
