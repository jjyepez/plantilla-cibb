<?php

    /**
    VERSION ALFA MUY TEMPRANA DEL SCRIPT PARA OPTIMIZACION Y MANEJO DE CSS DESDE PHP !!!!! .... jjy
    **/
    $css_original = "./estilos.css";
    // corrige clases duplicadas ........ y notifica ambiguedades !!! jjy 

/********************************************************************************************/


    $arr_salida = array();
    $f = file($css_original);

    $arr_clases = array();

    $n=0;
    foreach ($f as $l_clase) {

        $x_clase = explode( '{', str_replace('}', '', $l_clase ) );
        $clase = $x_clase[0];

        $arr_lista = explode(',' , $clase);
        $arr_clases[ $clase ] = isset ( $arr_clases[ $clase ] )? $arr_clases[ $clase ] + 1 : 1;
        $arr_atributos = explode(';', $x_clase[1]);
        foreach ( $arr_atributos as $i => $atributo ){
            $arr_atributos[ $i ] = trim( strtolower( $atributo ) );
        }

        foreach ($arr_lista as $elemento ) {
            $elemento = trim($elemento);
            if( $elemento != '') {
                $arr_elementos[ $elemento ]['n'] = isset ( $arr_elementos[ $elemento ]['n'] )? $arr_elementos[ $elemento ]['n'] + 1 : 1;
                $arr_elementos[ $elemento ]['atributos'][$n] = $arr_atributos;
            }
            $n++;
        }

    }

    foreach ($arr_elementos as $elemento => $contenido) {
        $chr_ini = substr( $elemento, 0, 1 );
        switch ( $chr_ini ) {
            case '@':
                $arr_salida['directivas'][$elemento] = $contenido['atributos'];
                break;
            case '.':
                $arr_salida['clases'][$elemento] = $contenido['atributos'];
                break;
            case '#':
                $arr_salida['ids'][$elemento] = $contenido['atributos'];
                break;
            default: //elementos html base
                if ( strpos( $elemento, ':') !== FALSE ) {
                    if ( strpos( $elemento, '[') !== FALSE 
                         &&
                         strpos( $elemento, '.') !== FALSE 
                         && strpos( $elemento, '#') !== FALSE 
                        ){
                        
                        
                    }
                }
                $arr_salida['html'][$elemento] = $contenido['atributos'];
                break;
        }
    }

    $salida = "";
    $arr_atributos_limpios = array();

    foreach ( $arr_salida as $grupo => $contenido_a ){
        $salida .= "\n/* **** ESTILOS - $grupo *** */\n";
        foreach ( $contenido_a as $elemento => $contenido_b ){
            
            $salida .= "$elemento ";
            
            if ( $grupo != 'directivas' ) $salida .= "{";
            $salida .= "\n";

            foreach ( $contenido_b as $contenido_c ){
                
                $atributos_limpios = "";

                foreach ( $contenido_c as $atributo ){

                    $atributo = trim ( $atributo );

                    if ( $atributo != "" ) {

                        $atributo_en_partes = explode (':', $atributo);
                        $id_atributo = $atributo_en_partes[0];
                        $valor_atributo = trim( $atributo_en_partes[1] );

                        if ( ! isset ( $arr_atributos_limpios [ $elemento ] ) ) { $arr_atributos_limpios [ $elemento ] = array(); $arr_atributos_ambiguos [ $elemento ] = array(); }
                        if ( ! isset ( $arr_atributos_limpios_id [ $elemento ] ) ) $arr_atributos_limpios_id [ $elemento ] = array();

                        if ( array_search ( $atributo, $arr_atributos_limpios [ $elemento ] ) === FALSE ){


                            if ( array_search ( $id_atributo, $arr_atributos_limpios_id [ $elemento ] ) === FALSE ){

                                $atributos_limpios .= "\t" . $atributo . "; \n";
                                $arr_atributos_limpios [ $elemento ][] = $atributo;

                            } else {

                                $atributos_limpios .= "\t" . $atributo . "; /* Ambiguedad detectada ... jjy */\n";
                                $arr_atributos_limpios [ $elemento ][] = $atributo;
                                $arr_atributos_ambiguos [ $elemento ][ count( $arr_atributos_limpios [ $elemento ] ) - 1 ] = "";

                            }
                            $arr_atributos_limpios_id [ $elemento ][] = $id_atributo;
                        }
                    }
                }
                $salida .= $atributos_limpios;
            }
            if ( $grupo != 'directivas' ) $salida .= "}\n";
            
        }

    }

    /* LINEA CRITICA ------- jjy */ Header ("Content-type: text/css; charset=utf-8");
    echo $salida;

    $salida_simplificada = array();
    foreach ( $arr_atributos_limpios as $elemento => $atributos ) {
    
      foreach ( $atributos as $atributo_individual ) {

        //echo $atributo_individual.";\n";
        $salida_extendida [ $elemento ][] = $atributo_individual;
        $salida_simplificada [ $atributo_individual ][] = $elemento;

      }
    
    }
     /* ?>
    <textarea style="display: inline-block; float:left;">
    <?php print_r( $salida_simplificada ); ?>
    </textarea>
    <textarea style="display: inline-block; float:left;">
    <?php print_r( $salida_extendida ); ?>
    </textarea>
<?php */
?>