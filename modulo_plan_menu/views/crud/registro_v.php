<?php $this->load->view('encabezado_comun_modulo_v') ?>

</head> <?php // se debe cerrar porque viene abierto desde encabezado-comun ... OJO !!! ... jjy ?>
<body>

<?php
  /**
  PREPARANDO EL COMPORTAMIENTO DE LA VISTA EN FUNCION DE LA OPERACION SOLICITADA .... jjy
  **/
  $titulo = "";
  $instrucciones = "";
  $editable = FALSE;

  //DATOS DE PRUEBA .... *** !!!
  $cantidad_proteina     = 25;
  $cantidad_grasa        = 15;
  $cantidad_carbohidrato = 55;
  $cantidad_simple       = 45;
  $cantidad_complejo     = 15;

  /**
  DATOS DEMOSTRATIVOS ..... deben ser traidos de las tablas ... jjy
  **/
  if( ! isset( $registro ) ){ // solo si NO SE RECIBE $registro!!! .... jjy
    $registro = array('id'=>0,'codigo_plan_menu'=>'','nombre_plan_menu'=>'PlanINNaño2013','fecha_registro'=>'20/Jul/2013','descripcion_plan'=>'PlandeMenúelaboradoparaelPlanVacacionaldelINNdelaño2013(25niños).','presupuesto_limite'=>0,'cantidad_dias'=>5,'dias_plan'=>array(),'tipo_comensales'=>'NiñosyNiñasentre5y12años','cantidad_comensales'=>25,'requerimiento_calorico_total'=>1500,'nombre_racion'=>'Normal','codigo_racion_plan'=>'RA0001','estatus_plan'=>'NUEVO','codigo_estatus_plan'=>'ES0001','tiempos_comida_plan'=> array(),'formula_institucional'=> array(), 'nombre_proveedor' => '', 'codigo_proveedor' => '',);
  }
  extract( $registro );

  // SE DETERMINA LA OPERACION A REALIZAR Y SE CONFIGURA LA VISTA ...... jjy
  // es recomendable volver a verificar los permisos del usuario antes de continuar ..... jjy ... OJO
  switch ( $operacion ){
    case 'n': // se intenta crear un registro NUEVO .... jjy
      $titulo        = "Registro Nuevo";
      $instrucciones = "Ingrese la información solicitada en cada caso y luego haga click sobre el botón Guardar.";
      $editable      = TRUE;

      // Se inicializan los datos del nuevo plan ...
      $registro = array(
        'id'                           => '',
        'codigo_plan_menu'             => '',
        'nombre_plan_menu'             => '',
        'fecha_registro'               => date('d/M/Y'),
        'descripcion_plan'             => '',
        'presupuesto_limite'           => 0,
        'cantidad_dias'                => 0,
        'dias_plan'                    => array(),
        'nombre_poblacion'             => '',
        'codigo_poblacion'             => '',
        'cantidad_comensales'          => 0,
        'requerimiento_calorico_total' => 0,
        'nombre_racion'                => '',
        'codigo_racion_plan'           => '',
        'estatus_plan'                 => 'NUEVO',
        'codigo_estatus_plan'          => 'ES0001',
        'tiempos_comida_plan'          => array(),
        'formula_institucional'        => array(),
        'nombre_proveedor'             => '',
        'codigo_proveedor'             => '',
      );
      extract( $registro );

      //DATOS DE PRUEBA .... *** !!!
      $cantidad_proteina     = 0;
      $cantidad_grasa        = 0;
      $cantidad_carbohidrato = 0;
      $cantidad_simple       = 0;
      $cantidad_complejo     = 0;
    break;

    case 'e': // se intenta EDITAR un registro con id = $id_registro .... jjy
      $titulo        = "Editando " . $nombre_plan_menu . " ($id_registro)";
      $instrucciones = "Guarde la información modificada sólo cuando esté seguro, ya que no podrá deshacer los cambios realizados.";
      $editable = TRUE;
    break;

    case 'm': // se intenta MOSTRAR un registro con id = $id_registro .... jjy
      $titulo        = "Mostrando " . $nombre_plan_menu . " ($id_registro)";
      $instrucciones = "Los campos no son editables en la operación Mostrar.";
    break;
  }

?>

  <h2 class = "titulo-seccion"><?=$titulo?></h2>
  <hr>
  
  <div class="barra-botones-modulo">

  <?php //************************* BARRA DE BOTONES ..... jjy ************************* ?>
  <?php
  
    $html_salida = ""; // buffer !!!

    $html_botones_barra = "";
    $parametros = array(
        'enlace'           => site_url().'/s/listar_registros',
        'tipo'             => 'boton_glyphicon',
        'clase_iconos'     => 'iconos_osti',
        'posicion_icono'   => '2 1',
        'descripcion'      => 'Volver',
        );
    $html_salida .= html_enlace_boton( 'b_volver' , $parametros );

    /**
    DEPNDIENDO DE LA OPERACION .... SE PREPARAN LOS BOTONES A MOSTRAR en la barra superior ............. !!!!!!! jjy
    **/
    switch ( $operacion ) {

      case "e": // editar
        $parametros = array(
            'enlace'           => site_url().'/s/registro/m/'.$id_registro,
            'icono'            => 'icon-undo',
            'descripcion'      => 'Cancelar',
            );
        $html_salida .= html_enlace_boton('b_cancelar', $parametros );

      case "n": // nuevo
        $parametros = array(
            'enlace'           => 'javascript:guardar_registro();',
            'icono'            => 'icon-save',
            'descripcion'      => 'Guardar',
            //'clase_adicional'  => 'btn-primary',
            );
        $html_salida .= html_enlace_boton('b_guardar', $parametros );
        break;

      case "m": // mostrar
        $parametros = array(
            'enlace'           => site_url().'/s/registro/e/'.$id_registro,
            'icono'            => 'icon-pencil',
            'descripcion'      => 'Editar',
            );
        $html_salida .= html_enlace_boton('b_editar', $parametros );

        $parametros = array(
            'enlace'           => 'javascript: eliminar();',
            'icono'            => 'icon-trash',
            'descripcion'      => 'Eliminar',
            );
        $html_salida .= html_enlace_boton('b_eliminar', $parametros );
        break;
    }
    $html_salida .= '<div class="flotado-derecha">';

    $parametros = array(
        'enlace'          => 'javascript:void(0);',
        'icono'           => 'icon-arrow-right',
        'descripcion'     => 'Siguiente Paso',
        'alinear_icono'   => 'derecha',
        'clase_adicional' => 'btn-primary disabled',
        );
    $siguiente_paso_hab = '';
    if ( $operacion == 'm' ){
      $parametros['enlace']          = 'javascript:paso_siguiente();';
      $parametros['clase_adicional'] = 'btn-primary';
    }
    $html_salida .= html_enlace_boton( 'b_paso_siguiente_p' , $parametros );
    //$html_salida .= html_paginacion( '' );

    $html_salida .= '</div>';

  ?>
  <?=$html_salida; // se imprime el buffer! .... jjy --- bueno "yque-buffer" :P ?>

  </div>
  <hr>

  <?php /**
   fin de la barra-botones-modulo  .... jjy ************************* 
  **/?>

  <?php //************************* Contenido del modulo ..... jjy ************************* ?>

  <div>
    
    <?=html_etiqueta( $instrucciones ) // se muestran las instrucciones del formulario .... jjy ?>

    <?php 
      /**
      AQUI INICIA EL FORMULARIO ****** jjy
      **/
      $parametros = array(
        'tabla_asociada' => 'cobi.t_planes_menu',
        'accion'         => site_url().'/s/guardar_registro',
        'metodo'         => 'POST',
      ); 
    ?>
    <?=html_formulario_ini( 'f_registro', $parametros )?>

    <?=html_br()?>

    <?php //********************* formulario simple ....... jjy ************************** ?>

    <?php /*
      EL FORMULARIO debe contener en lo posible toda la informacion necesaria para guardar los datos en las tablas respectivas ....
      para ello se usan PREFIJO como autoc__ ó campo__ .. o más aún esquema__nombre_tabla__nombre_campo ... etc! .... 
      los formularios siempre deberán tener dos campos ocultos claves al menos ....
          ** id
          ** autoc__codigo_de_registro (depende de cada tabla) ........
          jjy
    */ ?>

    <?php
      $parametros = array(
        'valor_inicial'               => $codigo_plan_menu,
        );
    ?>
    <?=html_input( 'autoc__codigo_plan_menu', 'oculto', $parametros )?>
    <?
      $parametros = array(
        'valor_inicial'               => $id_registro,
        );
    ?>
    <?=html_input( 'id', 'oculto', $parametros )?>

    <table>

      <tr>
        <td style="width:660px;">
          <?php
            $parametros = array(
              'etiqueta'                    => 'Nombre del Plan: ',
              'clases_adicionales_etiqueta' => 'ancho-150',
              'estilos'                     => 'width: 450px;',
              //'info_ayuda'                  => 'Debe colocar el nombre del Plan',
              'editable'                    => $editable,
              'valor_inicial'               => $nombre_plan_menu,
            );
          ?>
          <?=html_input( 'campo__nombre_plan_menu', 'texto', $parametros )?>
        </td>
        <td>
          <?php
            $parametros = array(
              'clases_adicionales_etiqueta' => 'ancho-120',
              'etiqueta'                    => 'Fecha de Registro: ',
              'estilos'                     => 'min-width:80px; width: 80px;',
              'valor_inicial'               => $fecha_registro,
              'editable'                    => FALSE, // forzar siempre no-editable ... jjy
            );
          ?>
          <?=html_input( 'campo__fecha_registro', 'calendario', $parametros )?>
        </td>
      </tr>

      <tr>
        <td>
          <?php
            $parametros = array(
              'etiqueta'                    => 'Descripción del Plan: ',
              'clases_adicionales_etiqueta' => 'ancho-150',
              'estilos'                     => 'width: 450px;',
              'valor_inicial'               => $descripcion_plan,
              'editable'                    => $editable,
            );
          ?>
          <?=html_input( 'campo__descripcion_plan', 'texto', $parametros )?>
        </td>
        <td>
          <?php
            $parametros = array(
              'etiqueta'                    => 'Estatus: ',
              'clases_adicionales_etiqueta' => 'ancho-120',
              'estilos'                     => 'width:80px;min-width:80px;',
              'valor_inicial'               => $estatus_plan,
              'editable'                    => FALSE, //$editable,

              'funciones_especiales' => array(
                array( 'dialogo_estatus_plan', 'icon-list-alt', array( 'enlace' => 'javascript:mostrar_dialogo_estatus_plan();' ) ),
              ),
            );
          ?>
          <?=html_input( 'nombre_estatus_plan', 'texto_funciones_especiales', $parametros )?>
          <?php
            $parametros = array(
              'valor_inicial' => $codigo_estatus_plan,
            );
          ?>
          <?=html_input( 'campo__codigo_estatus', 'oculto', $parametros )?>
        </td>
      </tr>

      <tr>
        <td>
          <?php
            $parametros = array(
              'etiqueta'                    => 'Presupuesto límite: ',
              'clases_adicionales_etiqueta' => 'ancho-150',
              'estilos'                     => 'min-width: 70px;width:70px;',
              'estilos_solo_lectura'        => 'min-width: 90px; width: 90px;',
              'valor_inicial'               => $presupuesto_limite,
              'editable'                    => $editable,

              'funciones_especiales' => array(
                array( 'calculadora_presupuesto', 'icon-th', array( 'enlace' => 'javascript:calculadora( "campo__presupuesto_limite" );' ) ),
              ),
            );
          ?>
          <?=html_input( 'campo__presupuesto_limite', 'texto_funcion_especial', $parametros )?>
          &nbsp; Bs.,

          <?=html_sangria('20px');?>

          <?php
            $parametros = array(
              'etiqueta'                    => 'Proveedor:&nbsp;&nbsp;',
              'clases_adicionales_etiqueta' => 'ancho-80 alinear-derecha',
              'estilos'                     => 'width: 185px;',
              'estilos_solo_lectura'        => 'width: 205px;',
              'valor_inicial'               => $nombre_proveedor,
              'editable'                    => $editable,
              'parametros_html'             => "readonly='readonly'",

              'funciones_especiales' => array(
                array( 'lista_proveedores', 'icon-list-alt', array( 'enlace' => 'javascript:mostrar_dialogo_proveedores();' ) ),
              ),
            );
          ?>
          <?=html_input( 'nombre_proveedor', 'texto_funcion_especial', $parametros )?>
          <?php
            $parametros = array(
              'valor_inicial' => $codigo_proveedor,
            );
          ?>
          <?=html_input( 'campo__codigo_proveedor', 'oculto', $parametros )?>
        </td>

      </tr>

      <tr>
        <td colspan='2'>
          <?php
          $parametros = array(
              'etiqueta'                    => 'Cantidad de días: ',
              'clases_adicionales_etiqueta' => 'ancho-150',
              'estilos'                     => 'min-width: 70px; width: 70px;',
              'estilos_solo_lectura'        => 'min-width: 90px; width: 90px;',
              'valor_inicial'               => $cantidad_dias,
              'editable'                    => $editable,

              /*'funciones_especiales' => array(
                array( 'calculadora_dias', 'icon-th', array( 'enlace' => 'javascript:calculadora( "campo__cantidad_dias" );' ) ),
              ),*/

            );
          ?>
          <?=html_input( 'campo__cantidad_dias', 'contador', $parametros )?>

          <?=html_sangria('15px')?>

          <?=html_etiqueta( 'Días de la semana:&nbsp;&nbsp;' )?>
        
          <?php
            // traidos de las tablas!!!! ... se preparan para usar ('codi'=>'valor' ...) --- jjy
            $dias_semana_x = array();
            foreach ( $dias_semana as $dia_semana ) {
              //abreviados .... jjy
              $dias_semana_x[ $dia_semana['codigo_dia'] ] = $dia_semana['descripcion'];
            }
            $dias_semana = $dias_semana_x; //se sustituye para ajustarse a la estructura esperada ... jjy

            //SE CREA EL ARRAGLO DE VALORES INICIALES para los componentes "opcionmultiple"!!!!! CLEVER!!!!!! ... jjy
            $valores_iniciales = array();
            foreach ($dias_plan as $info_dia_plan) {
              $valores_iniciales[$info_dia_plan['codigo_dia_semana']] = 'checked';
            }
            $parametros = array(
              'clases'        => 'seguido',
              'editable'      => $editable,
              'valor_inicial' => $valores_iniciales, // un arreglo !!!!!!!!!! para opcionmultiple!
              'items'         => $dias_semana,
            );
          ?>
          <?=html_input( 'cobi__t_dias_plan_menu__codigo_dia_semana[]', 'opcionmultiple', $parametros )?>
          <?php //prp($dias_plan); ?>
        </td>
      </tr>

      <tr>
        <td>
          <?php
            $parametros = array(
              'etiqueta'                    => 'Tipo de comensales: ',
              'clases_adicionales_etiqueta' => 'ancho-150',
              'estilos'                     => 'width: 430px;',
              'estilos_solo_lectura'        => 'min-width: 450px; width: 450px;',
              'valor_inicial'               => $nombre_poblacion,
              'editable'                    => $editable,
              'solo_lectura'                => true,

              'funciones_especiales' => array(
                array( 'dialogo_tipo_comensales', 'icon-list-alt', array( 'enlace' => 'javascript:mostrar_dialogo_tipos_comensales();' ) ),
              ),
            );
          ?>
          <?=html_input( 'nombre_poblacion', 'texto_funciones_especiales', $parametros )?>
          <?php
            $parametros = array(
              'valor_inicial' => $codigo_poblacion,
            );
          ?>
          <?=html_input( 'campo__codigo_poblacion', 'oculto', $parametros )?>
        </td>
        <td>
          <?php
          $parametros = array(
              'etiqueta'                    => 'Cant. comensales: ',
              'clases_adicionales_etiqueta' => 'ancho-120',
              'estilos'                     => 'min-width:80px; width:80px;',
              'estilos_solo_lectura'        => 'min-width: 100px; width: 100px;',
              'valor_inicial'               => $cantidad_comensales,
              'editable'                    => $editable,
            );
          ?>
          <?=html_input( 'campo__cantidad_comensales', 'contador', $parametros )?>
        </td>
      </tr>

      <tr>
        <td>
          <?php
          $parametros = array(
              'etiqueta'                    => 'RCT: ',
              'clases_adicionales_etiqueta' => 'ancho-150',
              'estilos'                     => 'min-width: 70px; width: 70px;',
              'estilos_solo_lectura'        => 'min-width: 90px; width: 90px;',
              'valor_inicial'               => $requerimiento_calorico_total,
              'editable'                    => $editable,
              );
          ?>
          <?=html_input( 'campo__requerimiento_calorico_total', 'contador', $parametros )?>&nbsp; Kcal,
          <div class="seguido">
            <?php
              $parametros = array(
                'etiqueta'                    => 'Tamaño de Ración:&nbsp;&nbsp;',
                'clases_adicionales_etiqueta' => 'ancho-150 alinear-derecha',
                'estilos'                     => 'width: 155px;',
                'valor_inicial'               => $nombre_racion,
                'editable'                    => FALSE, //$editable,

                'funciones_especiales' => array( // deshabilitado por el momento ... !!! editable=FALSE! .. jjy
                  array( 'dialogo_raciones', 'icon-list-alt', array( 'enlace' => 'javascript:mostrar_dialogo_raciones();' ) ),
                ),
              );
            ?>
            <?=html_input( 'nombre_racion', 'texto_funciones_especiales', $parametros )?>
            <?php
              $parametros = array(
                'valor_inicial' => $codigo_racion_plan,
              );
            ?>
            <?=html_input( 'codigo_racion_plan', 'oculto', $parametros )?>
          </div>

        </td>
      </tr>

      <tr>
        <td colspan='2'>
          <?php

            $pestanas = array(
              'tab_tdc'     =>'Tiempos de Comida',
              'tab_formula' =>'Fórmula Institucional',
            );
            $parametros = array(
              'pestanas'          => $pestanas,
              'clases-pestanas'   => "seguido", // ancho-120
              'estilo-pestanas'   => "font-size: 1em; min-width:80px;",
              'id_pestana_activa' => 'tab_tdc',
            );
          ?>
          <?=html_pestanas('tabs_tca',$parametros)?>  
          
          <?=html_br('10px')?>

          <div id="tab_tdc" name="tab_tdc" class="tab_activo" style="min-height:100px;">
          <?php // DEFINICION DEL TAB de tiempos de comida --- jjy ?>

            <table class="ancho-auto">
              <tr>
                <td>
                    
                  <table>
                    <tr>
                      <td>
                        <?=html_sangria('20px');?>
                        <?php

                          // traidos de las tablas!!!! ... jjy
                          $tiempos_comida_x = array();
                          foreach ( $tiempos_comida as $tiempo_comida ) {
                            $tiempos_comida_x[ $tiempo_comida['codigo_tiempo_comida'] ] = $tiempo_comida['descripcion'];
                          }
                          $tiempos_comida = $tiempos_comida_x; //se sustituye para ajustarse a la estructura esperada ... jjy

                          //SE CREA EL ARRAGLO DE VALORES INICIALES para los componentes "opcionmultiple"!!!!! CLEVER!!!!!! ... jjy
                          $valores_iniciales = array();
                          foreach ($tiempos_comida_plan as $info_tiempo_comida_plan) {
                            $valores_iniciales[$info_tiempo_comida_plan['codigo_tiempo_comida']] = 'checked';
                          }

                          $html_salida = "";
                          $n = 0;
                          foreach ($tiempos_comida as $codigo_tiempo => $tiempo_comida) {
                            $checked = '';
                            if( isset( $valores_iniciales[ $codigo_tiempo ] ) ){ // segun los datos guardados! ... jjy
                              $checked = $valores_iniciales[ $codigo_tiempo ];
                            }
                            $parametros = array(
                              'clases_adicionales_etiqueta' => 'ancho-70',
                              'etiqueta'                    => ucfirst( $tiempo_comida ),
                              'valor_inicial'               => $n .':' . $codigo_tiempo,
                              'editable'                    => $editable,
                              'parametros_html'             => $checked,
                              'etiqueta_con_for'            => FALSE,
                            );
                            $html_salida .= html_input( 'cobi__t_tiempos_plan_menu__codigo_tiempo_comida[]', 'checkbox', $parametros );

                            $valor_inicial = 0; // se debe traer de los datos cuando es mostrar / editar
                            $parametros = array(
                              'valor_inicial'      => $valor_inicial,
                              'enlace_incrementar' => 'javascript:recalcular_RCT($(this));',
                              'enlace_disminuir'   => 'javascript:recalcular_RCT($(this));',
                              'clases_adicionales' => 'valores_RCT porc_' . $n,
                              'estilos'            => 'min-width: 40px; width: 40px;',
                              'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                              'editable'           => $editable,
                            );
                            $html_salida .= html_input( 'porc_tiempos_de_comida[]', 'contador', $parametros ) . '&nbsp; %, &nbsp;&nbsp;';
                            
                            $parametros = array(
                              'valor_inicial'      => $valor_inicial,
                              'enlace_incrementar' => 'javascript:recalcular_RCT($(this));',
                              'enlace_disminuir'   => 'javascript:recalcular_RCT($(this));',
                              'clases_adicionales' => 'valores_RCT rct_' . $n,
                              'estilos'            => 'min-width: 40px; width: 40px;',
                              'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                              'editable'           => $editable,
                            );
                            $html_salida .= html_input( 'cobi__t_tiempos_plan_menu__rct_tiempo_comida[]', 'contador', $parametros ) . '&nbsp; Kcal';
                            $n++;
                            if ( $n % 2 == 0 ) {
                              $html_salida .= '</td></tr>';
                            } else {
                              $html_salida .= '</td><td class="ancho-40">&nbsp;<td/>';
                            }

                            if( $n < count($tiempos_comida) ){
                              if ( $n % 2 == 0 ) {
                                $html_salida .= '<tr><td>';
                              } else {
                                $html_salida .= '<td>';
                              }
                              $html_salida .= html_sangria('20px');
                            }
                          }
                        ?>
                        <?=$html_salida?>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>
          
          <?php // FIN TAB de tiempos de comida --- jjy ?>
          </div>


          <div id="tab_formula" name="tab_formula" class="invisible" style="padding-left:18px;min-height:100px;">
          <?php // DEFINICION DEL TAB de formula institucional --- jjy ?>
          <?php extract($registro['formula_institucional']); ?>
          <?php //prp($registro['formula_institucional']); ?>

            <table class="ancho-auto">
              <tr >
                <td><?=html_sangria('15px')?></td>
                <td>
                  <?php
                    $parametros = array(
                          'etiqueta'                    => 'Proteínas: ',
                          'clases_adicionales_etiqueta' => 'ancho-85',
                          'estilos'                     => 'min-width: 40px; width: 40px;',
                          'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                          'editable'                    => $editable,
                          'valor_inicial'               => $cantidad_proteina,
                        );
                  ?>
                  <?=html_input( 'cobi__t_formula_institucional_plan__cantidad_proteina', 'contador', $parametros ) . '&nbsp; %,&nbsp;&nbsp;'; ?>

                  <?php
                    $parametros = array(
                          'estilos'  => 'min-width: 40px; width: 40px;',
                          'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                          'editable' => $editable,
                        );
                  ?>
                  <?=html_input( 'kcal_proteina', 'contador', $parametros ) . '&nbsp; g &nbsp;&nbsp;'; ?>
                </td>

                <td class="ancho-40">&nbsp;</td>

                <td>
                  <?=html_sangria('15px')?>
                  <?php
                    $parametros = array(
                          'etiqueta'                    => 'CHO Complejos: ',
                          'clases_adicionales_etiqueta' => 'ancho-100',
                          'estilos'                     => 'min-width: 40px; width: 40px;',
                          'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                          'editable'                    => $editable,
                          'valor_inicial'               => $cantidad_complejo,
                        );
                  ?>
                  <?=html_input( 'cobi__t_formula_institucional_plan__cantidad_complejo', 'contador', $parametros ) . '&nbsp; %,&nbsp;&nbsp;'; ?>

                <?php
                    $parametros = array(
                          'estilos'              => 'min-width: 40px; width: 40px;',
                          'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                          'editable'             => $editable,
                        );
                  ?>
                  <?=html_input( 'kcal_complejo', 'contador', $parametros ) . '&nbsp; g &nbsp;&nbsp;'; ?>
                </td>
              </tr>

              <tr>
                <td><?=html_sangria('15px')?></td>
                <td>
                  <?php
                    $parametros = array(
                      'etiqueta'                    => 'Grasas: ',
                      'clases_adicionales_etiqueta' => 'ancho-85',
                      'estilos'                     => 'min-width: 40px; width: 40px;',
                      'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                      'editable'                    => $editable,
                      'valor_inicial'               => $cantidad_grasa,
                    );
                  ?>
                  <?=html_input( 'cobi__t_formula_institucional_plan__cantidad_grasa', 'contador', $parametros ) . '&nbsp; %,&nbsp;&nbsp;'; ?>

                  <?php
                    $parametros = array(
                      'estilos'              => 'min-width: 40px; width: 40px;',
                      'estilos_solo_lectura' => 'min-width: 60px; width: 60px;',
                      'editable'             => $editable,
                    );
                  ?>
                  <?=html_input( 'kcal_grasa', 'contador', $parametros ) . '&nbsp; g &nbsp;&nbsp;'; ?>
                </td>

                <td class="ancho-40">&nbsp;</td>

                <td>
                  <?=html_sangria('15px')?>
                  <?php
                    $parametros = array(
                      'etiqueta'                    => 'CHO Simples: ',
                      'clases_adicionales_etiqueta' => 'ancho-100',
                      'estilos'                     => 'min-width: 40px; width: 40px;',
                      'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                      'editable'                    => $editable,
                      'valor_inicial'               => $cantidad_simple,
                    );
                  ?>
                  <?=html_input( 'cobi__t_formula_institucional_plan__cantidad_simple', 'contador', $parametros ) . '&nbsp; %,&nbsp;&nbsp;'; ?>

                  <?php
                    $parametros = array(
                      'estilos'              => 'min-width: 40px; width: 40px;',
                      'estilos_solo_lectura' => 'min-width: 60px; width: 60px;',
                      'editable'             => $editable, //... es calculado
                    );
                  ?>
                  <?=html_input( 'kcal_simple', 'contador', $parametros ) . '&nbsp; g &nbsp;&nbsp;'; ?>
                </td>
              </tr>

              <tr>
                <td><?=html_sangria('15px')?></td>
                <td colspan = '2'>
                  <?php
                    $parametros = array(
                      'etiqueta'                    => 'CHO Totales: ',
                      'clases_adicionales_etiqueta' => 'ancho-85',
                      'estilos'                     => 'min-width: 40px; width: 40px;',
                      'estilos_solo_lectura'        => 'min-width: 60px; width: 60px;',
                      'editable'                    => $editable,
                      'valor_inicial'               => $cantidad_carbohidrato,
                    );
                  ?>
                  <?=html_input( 'cobi__t_formula_institucional_plan__cantidad_carbohidrato', 'contador', $parametros ) . '&nbsp; %,&nbsp;&nbsp;'; ?>

                  <?php
                    $parametros = array(
                      'estilos'              => 'min-width: 40px; width: 40px;',
                      'estilos_solo_lectura' => 'min-width: 60px; width: 60px;',
                      'editable'             => $editable,
                    );
                  ?>
                  <?=html_input( 'kcal_carbohidrato', 'contador', $parametros ) . '&nbsp; g &nbsp;&nbsp;'; ?>
                </td>
              </tr>

            </table>

            <?php //prp($registro); ?>

          <?php // FIN TAB de formula_institucional --- jjy ?>
          </div>

        </td>
      </tr>
    </table>

<?php //********************* fin formulario simple ....... jjy ************************* */ ?>
    <?=html_formulario_fin()?>
  </div>

<?php //*********************** mensaje de notificacion (exito, eliminado, etc) ******************/ ?>
<?php if( isset( $mensaje ) && $mensaje != "" ){ ?>
  <?=html_mensaje( '', $mensaje, $tipo_mensaje )?>
<?php } ?>

<?php //*********************** calculadora para componente-osti  .... jjy ******************/ ?>
<?=html_calculadora_simple( FALSE ) // REVISAR para implementar .... jjy ?>

<?php //********************* contenedor para mesajes de validacion ....... jjy ************************* */ ?>  
<div id="mensaje_validacion" name="mensaje_validacion" class="invisible mensaje mensaje-error">
  <span class="msj"></span><hr>
  <p class="sin-margenes"></p>
  <hr><span>Verifique e intente de nuevo</span>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#f_registro').on('submit', function(event){
      $('input[name="porc_tiempo_comida[]"]').removeClass('required campo_con_errores');
      $('input[name="cobi__t_tiempos_plan_menu__rct_tiempo_comida[]"]').removeClass('required campo_con_errores');

      $tiempos = $('input[name="cobi__t_tiempos_plan_menu__codigo_tiempo_comida[]"]');
      //$('input[name="cobi__t_tiempos_plan_menu__rct_tiempo_comida[]"]').rules('remove');
      //$('input[name="porc_tiempo_comida[]"]').rules('remove');
      for(i=0; i<$tiempos.length; i++){
        var tiempo_checked = $tiempos[i].checked;     
        if(tiempo_checked){
          $('.rct_'+i).attr('class', '{validate:{ required: true, min:1 }}');
          $('.porc_'+i).addClass('required');
        } else {
          $('.porc_'+i).removeClass('required');
          $('.rct_'+i).removeClass('required');
        }
      }

    });

    $('#f_registro').validate({ // debe estar fuera de $(document).ready()!!!!!!!! averiguar por qué ???? ... jjy
        rules: {
            campo__nombre_plan_menu: {
              required: true,
            },
            campo__fecha_registro: {
                date: true, required: true,
            },
            nombre_poblacion: {  
              required: true,  
            },
            campo__cantidad_comensales: {
                required: true, digits: true, min: 1,
            },
            campo__requerimiento_calorico_total: {
                required: true, digits: true, min: 1,
            },
            campo__cantidad_dias: {
                required: true, digits: true, min: 1,
            },
            'cobi__t_dias_plan_menu__codigo_dia_semana[]': { 
              required: true, minlength: 1,
            },
            'cobi__t_tiempos_plan_menu__codigo_tiempo_comida[]': { 
              required: true, minlength: 1,
            },
        },
        messages: {
            campo__nombre_plan_menu: {
                required: "Debe indicar el Nombre del Plan"
            },
            campo__fecha_registro: {
                required: "Debe indicar la fecha de registro",
                date: "Fecha de registro inválida"
            },
            nombre_poblacion: {
                required: "Debe indicar una población válida",
            },
            'cobi__t_dias_plan_menu__codigo_dia_semana[]': 'Debe seleccionar al menos 1 día',
            'cobi__t_tiempos_plan_menu__codigo_tiempo_comida[]': 'Debe seleccionar al menos 1 tiempo de comida',
            'cobi__t_tiempos_plan_menu__rct_tiempo_comida[]':'Error en los datos de RCT',
        },
    });
  });
</script>

<script type="text/javascript">
  function paso_siguiente(){
    document.location.href = "<?=site_url()?>/s/plan_interactivo/<?=$id_registro?>";
  }
  function mostrar_dialogo_tipos_comensales(){
    url_ajax = "<?=site_url()?>/s/mostrar_lista_tipos_comensales";
    id_dialogo = "contenedor_dialogo";
    mostrar_dialogo( url_ajax, id_dialogo );
  }
  function mostrar_dialogo_proveedores(){
    url_ajax = "<?=site_url()?>/s/mostrar_lista_proveedores";
    id_dialogo = "contenedor_dialogo";
    mostrar_dialogo( url_ajax, id_dialogo );
  }
  function seleccionar_item( id_tipo_dialogo, codigo, nombre, valor_aux1, valor_aux2, valor_aux3 ){

    //SIRVE PARA TODODS LOS INPUTS DE Funcion Especial que llaman al dialogo de velo_blanco!!!! ....... se diferencia la respuesta segun el switch .... !! jjy
    var id_input_focus = '';

    switch( id_tipo_dialogo ){

      case "tipo_comensales": //este se refiere al input de tipos de comensales
        $('#campo__codigo_poblacion').val(codigo);
        $('#nombre_racion').siblings('div.solo_lectura').html(valor_aux2);
        $('#nombre_poblacion').val(nombre);
        $('#campo__requerimiento_calorico_total').val(valor_aux1);
        var fi = (valor_aux3).split('|'); // formula institucional
        $('#cobi__t_formula_institucional_plan__cantidad_proteina').val(fi[0]);
        $('#cobi__t_formula_institucional_plan__cantidad_grasa').val(fi[1]);
        $('#cobi__t_formula_institucional_plan__cantidad_carbohidrato').val(fi[2]);
        $('#cobi__t_formula_institucional_plan__cantidad_complejo').val(fi[3]);
        $('#cobi__t_formula_institucional_plan__cantidad_simple').val(fi[4]);
        recalcular_RCT('%');
        id_input_focus = 'nombre_poblacion';
        break;

      case "proveedores": //este se refiere al input de proveedores
        $('#campo__codigo_proveedor').val(codigo);
        $('#nombre_proveedor').val(nombre);
        id_input_focus = 'nombre_proveedor';
        break;
    }
    cerrar_velo();
    if(id_input_focus!='') $('#' + id_input_focus).focus();
  }
  function eliminar(){
    if ( confirm('Confirme la eliminación del Plan Actual') ){
      document.location.href = '<?=site_url().'/s/registro/x/'.$id_registro ?>';
    }
  }
  recalcular_RCT('%');
</script>

<?php $this->load->view('pie_comun_modulo_v') // no modificar esta linea ... ..jy ?>