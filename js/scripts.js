// scripts comunes a todos los módulos ..... ! ... jjy
/**
  A CONTINUACION FUNCIONES DEPENDIENTES DE JQUERY ! ...... jjy
**/
$(document).ready(function(){
  //para crear el efecto readonly en los checkbox! ... !!! para los componentes osti! ... jjy
  $(':checkbox[readonly=readonly]').click(function(){
    return false;        
  });

  $('input.requerido').parent('.contenedor-input').append(function(){
      return '<div class="marca-input-requerido" title="dato requerido"></div>';
  });
  $('.formulario input').focus(function(){
    $(this).select();
  });
  $('input.requerido').keyup(function(){
    if($(this).val()==""){
      $(this).siblings('.marca-input-requerido').removeClass('invisible');
    } else {
      $(this).siblings('.marca-input-requerido').addClass('invisible');
    }
  });

  // funciones relacionadas con el desplazamiento entre campos mediante la tecla enter .... jjy
  $('input, select, textarea').on('focus', function(){
    $(this).parent().parent().addClass('celda-seleccionada');
    $(this).select();
  });
  $('input, select, textarea').on('blur', function(){
    $(this).parent().parent().removeClass('celda-seleccionada');
  });
  /*$('input, select, textarea').on('keyup',function(e){
    var keyCode = e.keyCode || e.which;
      if ( e.ctrlKey ) {
        $('.teclas-ctrl').fadeOut(75);
      } else if ( e.altKey ) {
        $('.teclas-alt').fadeOut(75);
      }
  });*/
  var indice = 1;
  $('input, select, textarea, a.btn').not('.oculto').each( function(){
    if (this.type != "hidden") {
      $(this).attr( 'tabindex' , indice );
      indice++;
    }
  });
  $('input, select, textarea').not('.oculto').on('keydown',function(e){

    var keyCode = e.keyCode || e.which;
    if ( e.shiftKey ) {
      return keyCode;
    }
    /*if ( e.ctrlKey ) {
      $('.teclas-ctrl').fadeIn(75);
    } else if ( e.altKey ) {
      $('.teclas-alt').fadeIn(75);
    }*/
    if( keyCode === 13 || keyCode === 39 || keyCode === 40 || keyCode === 37 || keyCode === 38 ) {

        if( keyCode === 13 || keyCode === 39 || keyCode === 40 ) {
          e.preventDefault();
          $selector = $('input, select, textarea, a.btn').not('.oculto');
          $obj = $selector[$('input, select, textarea, a.btn').not('.oculto').index(this)+1];
          try {
            $obj.focus();
          } catch(e){
            //
          }
        } else if( keyCode === 38 ) { //|| keyCode === 37 
          e.preventDefault();
          $selector = $('input, select, textarea, a.btn').not('.oculto');
          $obj = $selector[$('input, select, textarea, a.btn').not('.oculto').index(this)-1];
          try {
            $obj.focus();
          } catch(e){
            //
          }
        }
        var enlace_enter = $(this).attr('onenter');
        if( keyCode === 13 && enlace_enter != "" && enlace_enter != undefined ){
          document.location.href = enlace_enter;
        }
    }
  });
  $('input, select, textarea').not('.oculto').first().focus();

});

function incrementar_contador( $obj_contador ){
  $input = $obj_contador.parent().siblings('input[type="text"]');
  var valor = Number( $input.val() );
    valor++;
  $input.val( valor ); //.focus(); ??? se ve glitching!
}

function disminuir_contador( $obj_contador ){
  $input = $obj_contador.parent().siblings('input[type="text"]');
  var valor = Number( $input.val() );
    valor--;
  $input.val( valor ); //.focus(); ??? se ve glitching!
}

if (jQuery.validator) {

  /************** PROBANDO INTEGRACION DE JS GENERICO ************************/
  jQuery.extend( jQuery.validator.messages, {
      required: "El campo es requerido.",
      remote: "Corrija el error.",
      email: "Ingrese una dirección de correo-e válida",
      url: "Ingrese una URL válida.",
      date: "Ingrese una fecha válida.",
      dateISO: "Ingrese una fecha (ISO) válida.",
      number: "Ingrese un número válido.",
      digits: "Ingrese sólo dígitos.",
      creditcard: "Ingrese un número de TDC válido.",
      equalTo: "Ingrese el mismo valor.",
      accept: "Ingrese valores con extensiones válidas.",
      maxlength: jQuery.validator.format("Ingrese más de {0} caracteres."),
      minlength: jQuery.validator.format("Ingrese al menos {0} caracteres."),
      rangelength: jQuery.validator.format("Ingrese un valor con una longitud entre {0} y {1}."),
      range: jQuery.validator.format("Ingrese un valor entre {0} y {1}."),
      max: jQuery.validator.format("Ingrese un valor mayor o igual a {0}."),
      min: jQuery.validator.format("Ingrese un valor mayor o igual a {0}.")
  });

  jQuery.validator.addMethod(
    "esta_en_lista", 
    function(value, lista) {
      //var states = ['PA', "CA"] // of course you will need to add more
      var in_array = $.inArray(value.toUpperCase(), lista);
      if (in_array == -1) {
          return false;
      }else{
          return true;
      }
    }, 
    "El valor no es valido (según lista)"
  );
  
  jQuery.validator.setDefaults({
    focusCleanup: true,
    focusInvalid: false,
    errorClass: "campo_con_errores",
    onkeyup: false,
    onfocusout: false,
    errorContainer: '#mensaje_validacion',
    errorLabelContainer: '#mensaje_validacion p',
    wrapper: "div",
    invalidHandler: function(event, validator) {
      // 'this' refers to the form
      var errors = validator.numberOfInvalids();
      if (errors) {
        var message = errors == 1
          ? 'Existe 1 error en los datos suministrados.'
          : 'Existen ' + errors + ' errores en los datos suministrados.';
        $("div.mensaje .msj").html(message);
        $("div.mensaje").removeClass('invisible');
        setTimeout('desvanecer_mensaje()', 3000);
      } else {
        $("div.mensaje").addClass('invisible');
      }
    }
  });

}

function desvanecer_mensaje(){
  $(".mensaje").fadeOut("fast");
  //$(".mensaje").addClass('invisible');
}
function mostrar_dialogo ( url_ajax, id_contenedor_dialogo ) {
  $('.velo-blanco').removeClass('invisible');
  $.ajax({
    url: url_ajax,
    context: document.body
  }).done (
    function( data ){
      document.getElementById( id_contenedor_dialogo ).innerHTML = data;
      $('#' + id_contenedor_dialogo).removeClass('invisible');
    }
  );
}
function cerrar_velo(){
  $('.velo-blanco').addClass('invisible');
}