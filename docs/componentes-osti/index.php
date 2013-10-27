<!DOCTYPE html>
<?php
    /**
    VERSION ALFA MUY TEMPRANA DEL SCRIPT PARA GENERAR DOCUMENTACION HTML DE LOS HELPERS DE FORMA AUTOMÁTICA !!!!! .... jjy
    **/
?>
<head>
  <meta charset='utf8'>
</head>
<body>
  <div id="content">
  
<?php
  //************************************************************************************** ... jjy - 2 sep 2013

  // script para generar la documentación del helper de Componentes-OSTI !! ... 
  // ubicación del php del helper que debe haber sido documentado con las convenciones de este script ...

  $archivo_componentes_helper = realpath('.') . "/../../systm/helpers/componentes_html_helper.php";
  $archivo_componentes_helper = realpath('.') . "/../../systm/helpers/control_usuarios_helper.php";

  // Identificadores válidos ....
  
  //#
  /*#
  #*/
  //# >>>//
         //<<<
  $identificadores = array( 
    array( '//#', ''        ),
    array( '/*#', '#*/'     ),
    array( '>//', '//<'     ),
    array( 'function', '}'  ),
    array( 'class', '}'     ),
  );
  $ldoc_individual_ini = $identificadores[0][0];
  
  $ldoc_bloque_ini     = $identificadores[1][0];
  $ldoc_bloque_fin     = $identificadores[1][1];

  $ldoc_grupo_ini      = $identificadores[2][0];
  $ldoc_grupo_fin      = $identificadores[2][1];

  $ldoc_funcion_ini    = $identificadores[3][0];
  $ldoc_clase_ini      = $identificadores[4][0];

  // tags válidos

  //# @descripcion
  //# @link
  //# @version
  //# @autor
  //# @fecha
  //# @licencia
  //# @parametro
  //# @ejemplo
  //# @salida

  //**************************************************************************************

  $f = file( $archivo_componentes_helper );
  
  $linea_anterior = "";
  $funcion_anterior = "_";
  $n = 0;

  $item_doc = array();

  foreach ( $f as $linea_orig ) {
    $n++;
    $linea                  = htmlentities( trim( str_replace( '(', ' (', $linea_orig ) ) );
    $fragmento_comentario   = substr( $linea, 0, 2 );
    $fragmento_inicial      = substr( $linea, 0, 3 );
    $fragmento_inicial_orig = substr( trim( $linea_orig ), 0, 3 );
    $fragmento_final        = substr( trim( $linea ), -3 );
    $fragmento_final_orig   = substr( trim( $linea_orig ), -3 );
    $tag = "";
    $sw_es_comentario = FALSE;

    if ( $fragmento_comentario == '/*' && $fragmento_inicial != $ldoc_bloque_ini ) { 
      $sw_es_comentario = TRUE; 
      $sw_es_comentario_largo = TRUE; 
    }
    if ( $fragmento_comentario == '//' && $fragmento_inicial != $ldoc_individual_ini && $fragmento_inicial != $ldoc_grupo_fin ) { 
      $sw_es_comentario = TRUE; 
      $sw_es_comentario_largo = FALSE; 
    }
    if ( strpos( $linea, '/*' ) !== FALSE && strpos( $linea, '*/' ) !== FALSE ){
      $linea = substr( $linea, strpos( $linea, '/*' ), strpos( $linea, '*/' ) - strpos( $linea, '/*' ) );
    }

    if ( $sw_es_comentario_largo && strpos( $linea, '*/' ) !== FALSE && $fragmento_inicial != $ldoc_bloque_fin ) { 
      $sw_es_comentario = FALSE; 
      $sw_es_comentario_largo = FALSE; 
      $linea = substr( $linea, - strpos( $linea, '*/' ) + 2 );
    }
    if ( $sw_es_comentario OR $sw_es_comentario_largo ) { $linea = ""; } // . $linea; }

    $fragmento_procedimiento = substr( str_replace( ' public ', '', ' '.$linea ), 1, 8 );
    if ( $fragmento_procedimiento == "function" ) { 
      $arr_aux = explode( ' ', $linea ); 
      $funcion = $arr_aux[1]; 
    }
    if ( $funcion != "" && $funcion_anterior != $funcion ) {
      $sintaxis = trim( str_replace( '{', '', str_replace(' function ', '', ' '.$linea ) ) );
      
      $item_doc [ $funcion ]['sintaxis'] = $sintaxis;

      $funcion_anterior = $funcion;
      $funcion = "";
    }
    if ( $fragmento_inicial == $ldoc_individual_ini OR 
         $fragmento_inicial == $ldoc_bloque_ini ) {

      $linea                                   = str_replace( $fragmento_inicial, ' ', $linea );
      $linea_aux                               = explode( ' ', trim( $linea ) );
      $tag                                     = str_replace('@', '', $linea_aux[0] );
      $contenido_tag                           = trim( str_replace( '@' . $tag, '', $linea ) );
      $item_doc[ $funcion_anterior ][ $tag ][] = $contenido_tag;
    }
    if ( $fragmento_inicial_orig == $ldoc_bloque_ini ){
      $tipo_bloque_doc = 2;
      $sw_bloque_doc = TRUE;
      $tag_bloque = $tag;
    }

    if ( $fragmento_final_orig == $ldoc_grupo_ini ){
      $tipo_bloque_doc = 1;
      $sw_bloque_doc = TRUE;
      $linea = substr($linea, 1, - 10 );
      $id_x = count ( $item_doc[ $funcion_anterior ][ $tag ] ) - 1;
      $item_doc[ $funcion_anterior ][ $tag ][ $id_x ] = array();
      $tag_bloque = $tag;
    }
    if ( $fragmento_inicial_orig == $ldoc_grupo_fin OR $fragmento_inicial_orig == $ldoc_bloque_fin ){
     $sw_bloque_doc = FALSE; 
    }
    if ( $sw_bloque_doc == TRUE ){
      
      $contenido_tag = trim( str_replace( '@' . $tag, '', $linea ) );

      $item_doc[ $funcion_anterior ][ $tag_bloque ][ $id_x ][] = $contenido_tag;
    }
    if ( ( $tag != "" ) ) {
      $funcion = "";
    }
  }

  foreach ( $item_doc as $funcion => $contenido_doc ) {
    $arr_html = array();
    $arr_html['titulo_funcion'] = "<h2>" . $funcion . "()</h2>\n";

    foreach ($contenido_doc as $tag => $contenido_tag) {

      if ( ! is_array( $contenido_tag) ) {

        $arr_html[$tag] = $contenido_tag . "<br>\n";

      } else {

        foreach ( $contenido_tag as $id => $valor ) {
          if ( ! is_array( $valor ) && trim( $valor ) != "" ) {
            $arr_html[$tag][] =  $valor .'<br>';
          } else {

            foreach ($valor as $var) {
              $arr_html[$tag][] = $var;
            }
          }
        }
      }

    }

    $html_salida .= $arr_html['titulo_funcion'];
    $html_salida .= $arr_html['descripcion'][0];
    $html_salida .= '<h4>Sintaxis</h4> <code>' . $arr_html['sintaxis'] . '</code>';
    $html_salida .= '<h4>Parametros</h4><code>';
    foreach ($arr_html['parametro'] as $id => $valor) {

      if (substr( $valor , 0 , 1) == '$' OR substr( $valor , 0 , 1) == '#'){
         $html_salida .= '<span style="color:#333;">';
        if ( substr( $valor , 0 , 1) == '#' ){
          $valor = str_replace('#','',$valor);
          $html_salida .= html_entity_decode( $valor ) . '<br>';
        } else {
          $valor = $valor .'<br>';
          $html_salida .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $valor ;
        }
        $html_salida .= '</span>';

      } else {

        $html_aux = explode( ' ', $valor );
        $html_salida  .= ' <i>' . $html_aux[0] . '</i>' 
                      .  ' <b>' . str_replace('$', '', $html_aux[1] ) . '</b>
                          <code style="color:black;">';
        array_shift( $html_aux ); 
        array_shift( $html_aux );
        $html_aux = implode( ' ', $html_aux );

        $html_salida .= ' ' . $html_aux . "</code>\n";
      
      }
    
    }
    $html_salida .=   "</code>\n";


    if ($arr_html['ejemplo'] != ""){
      $html_salida .= '<h4>Ejemplo</h4> <pre>';
      foreach ($arr_html['ejemplo'] as $id => $valor) {
        $html_salida .= $valor ."\n";
      }
      $html_salida .= '</pre>';
      $html_salida .= '<span>El ejemplo anterior produciría lo siguiente: </span> <code>';
    }



    foreach ($arr_html['salida'] as $id => $valor) {
      $html_salida .= $valor;
    }
    $html_salida .= '</code>';

    if ( isset( $arr_html['nota'] ) && $arr_html['nota'][0] != "" ) {    
      $html_salida .= '<p class="important"><b>NOTA:</b> ' . $arr_html['nota'][0] . '</p>';
    }

//echo '<pre>';
//print_r($arr_html);
  }

?>

<h1>Documentación API de Componentes-OSTI v1.0b</h1>
<?='Ubicación:<font color="grey">'.realpath($archivo_componentes_helper).'</font>'?>
<?=$html_salida?>





</div>

<style type="text/css">
body {
 margin: 0;
 padding: 0;
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 font-size: 14px;
 color: #333;
 background-color: #fff;
}

a {
 color: #0134c5;
 background-color: transparent;
 text-decoration: none;
 font-weight: normal;
 outline-style: none;
}
a:visited {
 color: #0134c5;
 background-color: transparent;
 text-decoration: none;
 outline-style: none;
}
a:hover {
 color: #000;
 text-decoration: none;
 background-color: transparent;
 outline-style: none;
}

#breadcrumb {
 float: left;
 background-color: transparent;
 margin: 10px 0 0 42px;
 padding: 0;
 font-size: 10px;
 color: #666;
}
#breadcrumb_right {
 float: right;
 width: 175px;
 background-color: transparent;
 padding: 8px 8px 3px 0;
 text-align: right;
 font-size: 10px;
 color: #666;
}
#nav {
 background-color: #494949;
 margin: 0;
 padding: 0;
}
#nav2 {
 background: #fff url(images/nav_bg_darker.jpg) repeat-x left top;
 padding: 0 310px 0 0;
 margin: 0;
 text-align: right;
}
#nav_inner {
 background-color: transparent;
 padding: 8px 12px 0 20px;
 margin: 0;
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 font-size: 11px;
}

#nav_inner h3 {
 font-size: 12px;
 color: #fff;
 margin: 0;
 padding: 0;
}

#nav_inner .td_sep {
 background: transparent url(images/nav_separator_darker.jpg) repeat-y left top;
 width: 25%;
 padding: 0 0 0 20px;
}
#nav_inner .td {
 width: 25%;
}
#nav_inner p {
 color: #eee;
 background-color: transparent;
 padding:0;
 margin: 0 0 10px 0;
}
#nav_inner ul {
 list-style-image: url(images/arrow.gif);
 padding: 0 0 0 18px;
 margin: 8px 0 12px 0;
}
#nav_inner li {
 padding: 0;
 margin: 0 0 4px 0;
}

#nav_inner a {
 color: #eee;
 background-color: transparent;
 text-decoration: none;
 font-weight: normal;
 outline-style: none;
}

#nav_inner a:visited {
 color: #eee;
 background-color: transparent;
 text-decoration: none;
 outline-style: none;
}

#nav_inner a:hover {
 color: #ccc;
 text-decoration: none;
 background-color: transparent;
 outline-style: none;
}

#masthead {
 margin: 0 40px 0 35px;
 padding: 0 0 0 6px;
 border-bottom: 1px solid #999;
}

#masthead h1 {
background-color: transparent;
color: #e13300;
font-size: 18px;
font-weight: normal;
margin: 0;
padding: 0 0 6px 0;
}

#searchbox {
 background-color: transparent;
 padding: 6px 40px 0 0;
 text-align: right;
 font-size: 10px;
 color: #666;
}

#img_welcome {
 border-bottom: 1px solid #D0D0D0;
 margin: 0 40px 0 40px;
 padding: 0;
 text-align: center;
}

#content {
 margin: 20px 40px 0 40px;
 padding: 0;
}

#content p {
 margin: 12px 20px 12px 0;
}

#content h1 {
color: #e13300;
border-bottom: 1px solid #666;
background-color: transparent;
font-weight: normal;
font-size: 24px;
margin: 0 0 20px 0;
padding: 3px 0 7px 3px;
}

#content h2 {
 background-color: transparent;
 border-bottom: 1px solid #999;
 color: #000;
 font-size: 18px;
 font-weight: bold;
 margin: 28px 0 16px 0;
 padding: 5px 0 6px 0;
}

#content h3 {
 background-color: transparent;
 color: #333;
 font-size: 16px;
 font-weight: bold;
 margin: 16px 0 15px 0;
 padding: 0 0 0 0;
}

#content h4 {
 background-color: transparent;
 color: #444;
 font-size: 14px;
 font-weight: bold;
 margin: 22px 0 0 0;
 padding: 0 0 0 0;
}

#content img {
 margin: auto;
 padding: 0;
}

#content code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

#content pre {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

#content .path {
 background-color: #EBF3EC;
 border: 1px solid #99BC99;
 color: #005702;
 text-align: center;
 margin: 0 0 14px 0;
 padding: 5px 10px 5px 8px;
}

#content dfn {
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 color: #00620C;
 font-weight: bold;
 font-style: normal;
}
#content var {
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 color: #8F5B00;
 font-weight: bold;
 font-style: normal;
}
#content samp {
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 color: #480091;
 font-weight: bold;
 font-style: normal;
}
#content kbd {
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 color: #A70000;
 font-weight: bold;
 font-style: normal;
}

#content ul {
 list-style-image: url(images/arrow.gif);
 margin: 10px 0 12px 0;
}

li.reactor {
 list-style-image: url(images/reactor-bullet.png);
}
#content li {
 margin-bottom: 9px;
}

#content li p {
 margin-left: 0;
 margin-right: 0;
}

#content .tableborder {
 border: 1px solid #999;
}
#content th {
 font-weight: bold;
 text-align: left;
 font-size: 12px;
 background-color: #666;
 color: #fff;
 padding: 4px;
}

#content .td {
 font-weight: normal;
 font-size: 12px;
 padding: 6px;
 background-color: #f3f3f3;
}

#content .tdpackage {
 font-weight: normal;
 font-size: 12px;
}

#content .important {
 background: #FBE6F2;
 border: 1px solid #D893A1;
 color: #333;
 margin: 10px 0 5px 0;
 padding: 10px;
}

#content .important p {
 margin: 6px 0 8px 0;
 padding: 0;
}

#content .important .leftpad {
 margin: 6px 0 8px 0;
 padding-left: 20px;
}

#content .critical {
 background: #FBE6F2;
 border: 1px solid #E68F8F;
 color: #333;
 margin: 10px 0 5px 0;
 padding: 10px;
}

#content .critical p {
 margin: 5px 0 6px 0;
 padding: 0;
}


#footer {
background-color: transparent;
font-size: 10px;
padding: 16px 0 15px 0;
margin: 20px 0 0 0;
text-align: center;
}

#footer p {
 font-size: 10px;
 color: #999;
 text-align: center;
}
#footer address {
 font-style: normal;
}

.center {
 text-align: center;
}

img {
 padding:0;
 border: 0;
 margin: 0;
}

.nopad {
 padding:0;
 border: 0;
 margin: 0;
}


form {
 margin: 0;
 padding: 0;
}

.input {
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 font-size: 11px;
 color: #333;
 border: 1px solid #B3B4BD;
 width: 100%;
 font-size: 11px;
 height: 1.5em;
 padding: 0;
 margin: 0;
}

.textarea {
 font-family: Lucida Grande, Verdana, Geneva, Sans-serif;
 font-size: 14px;
 color: #143270;
 background-color: #f9f9f9;
 border: 1px solid #B3B4BD;
 width: 100%;
 padding: 6px;
 margin: 0;
}

.select {
 background-color: #fff;
 font-size:  11px;
 font-weight: normal;
 color: #333;
 padding: 0;
 margin: 0 0 3px 0;
}

.checkbox {
 background-color: transparent;
 padding: 0;
 border: 0;
}

.submit {
 background-color: #000;
 color: #fff;
 font-weight: normal;
 font-size: 10px;
 border: 1px solid #fff;
 margin: 0;
 padding: 1px 5px 2px 5px;
}
  </style>
</body>
</html>




