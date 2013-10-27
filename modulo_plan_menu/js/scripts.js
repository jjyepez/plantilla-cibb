/**
  scripts propios de este módulo ... jjy .
**/
$(document).ready(function(){
 
});

function guardar_registro(){
  $('#f_registro').submit();
}

function recalcular_RCT( en_base_a  ){
  var RCT = Number($('#campo__requerimiento_calorico_total').val());

switch ( en_base_a ){

    case "kc":
  var kcal_proteina     = Number('0'+$('#kcal_proteina').val());
  var kcal_grasa        = Number('0'+$('#kcal_grasa').val());
  var kcal_carbohidrato = Number('0'+$('#kcal_carbohidrato').val());
  var kcal_complejo     = Number('0'+$('#kcal_complejo').val());
  var kcal_simple       = Number('0'+$('#kcal_simple').val());

      porc_proteina     = kcal_proteina * 100 / RCT;
      porc_grasa        = kcal_grasa * 100 / RCT;
      porc_carbohidrato = kcal_carbohidrato * 100 / RCT;
      porc_complejo     = kcal_complejo * 100 / RCT;
      porc_simple       = kcal_simple * 100 / RCT;
  
      $('#cobi__t_formula_institucional_plan__cantidad_proteina').val(porc_proteina.toFixed(1));
      $('#cobi__t_formula_institucional_plan__cantidad_grasa').val(porc_grasa.toFixed(1));
      $('#cobi__t_formula_institucional_plan__cantidad_carbohidrato').val(porc_carbohidrato.toFixed(1));
      $('#cobi__t_formula_institucional_plan__cantidad_complejo').val(porc_complejo.toFixed(1));
      $('#cobi__t_formula_institucional_plan__cantidad_simple').val(porc_simple.toFixed(1));
    break;

    case "%":

  var porc_proteina     = Number('0'+$('#cobi__t_formula_institucional_plan__cantidad_proteina').val());
  var porc_grasa        = Number('0'+$('#cobi__t_formula_institucional_plan__cantidad_grasa').val());
  var porc_carbohidrato = Number('0'+$('#cobi__t_formula_institucional_plan__cantidad_carbohidrato').val());
  var porc_complejo     = Number('0'+$('#cobi__t_formula_institucional_plan__cantidad_complejo').val());
  var porc_simple       = Number('0'+$('#cobi__t_formula_institucional_plan__cantidad_simple').val());

      kcal_proteina     = porc_proteina * RCT / 100;
      kcal_grasa        = porc_grasa * RCT / 100;
      kcal_carbohidrato = porc_carbohidrato * RCT / 100;;
      kcal_complejo     = porc_complejo * RCT / 100;;
      kcal_simple       = porc_simple * RCT / 100;;

      $('#kcal_proteina').val(kcal_proteina.toFixed(1));
      $('#kcal_grasa').val(kcal_grasa.toFixed(1));
      $('#kcal_carbohidrato').val(kcal_carbohidrato.toFixed(1));
      $('#kcal_complejo').val(kcal_complejo.toFixed(1));
      $('#kcal_simple').val(kcal_simple.toFixed(1));
    break;
  }
}

function calculadora( id_obj_input ){
  if( $('.calculadora-simple').hasClass('invisible') ){
    var m_orig = $('#'+id_obj_input).val();
    $('.calculadora-simple #i').val( ( m_orig == 0 ) ? '' : m_orig );

    var obj_input = $('#'+id_obj_input)[0];

    var top  = $(obj_input).offset().top + $(obj_input).outerHeight() - 1;
    var left = $(obj_input).offset().left;
    
    $('.calculadora-simple').css({'top' : top, 'left': left});

    $('.calculadora-simple #txt_destino').val( id_obj_input );
    $('.calculadora-simple').removeClass('invisible');
  } else {
    $('.calculadora-simple').addClass('invisible');
  }
}