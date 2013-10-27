<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-combined.no-icons.min.css">
	<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">	
	<script src="./css/jquery.min.js"></script>
	<style type="text/css">
		table {border:0;border-bottom:1px dotted #ccc;border-right:0px solid #ccc;}
		table td {border:0;border-top:1px dotted #ccc;border-left:0px solid #ccc; padding: 2px 7px;}

		table td.contenedor-iconos-accion {margin: 0; padding: 0; vertical-align: top;}
		form {margin: 50px;}

		input {border: 1px solid #ccc; padding: 4px; margin: 0; border-radius: 2px;}
		.contenedor-input {display:inline-block; position:relative;}

		span .icono-accion-derecha {display:block; position:absolute; right:1px; top:1px; background-color:white;padding:6px 6px 5px 5px;}
		span .icono-accion-izquierda {display:block; position:absolute; left:1px; top:1px; background-color:white;padding:6px 6px 5px 5px;}
		td .icono-accion-derecha {display:block; position:absolute; right:1px; top:1px; background-color:white;padding:3px;}
		td .icono-accion-izquierda {display:block; position:absolute; left:1px; top:1px; background-color:white;padding:3px;}

		form .contenedor-input a {outline: 0; text-decoration: none; color: rgba(0,0,0,0.5);} /* opcional */
		form .contenedor-input a:hover {color: rgba(0,0,0,1);} /* opcional */

		.check {}
	</style>
	<script>
		$(document).ready(function(){
			$('tr .contenedor-input').hide();
			$('tr').mouseover( function(){ $(this).find('.contenedor-input').show(); });
			$('tr').mouseout ( function(){ $(this).find('.contenedor-input').hide(); });
			$('i.check, label.check').click(function(){
				$('i[rel="'+ $(this).attr('rel')+ '"]').toggleClass('icon-check-empty');
				$('i[rel="'+ $(this).attr('rel')+ '"]').toggleClass('icon-check');
			});
		})
	</script>
</head>
<body>
	<section>
		<form>
		<br>
		<span class="contenedor-input" style="width:62px;">&nbsp;
			<a href="javascript:voi(0);"><i style="left: 0px;" class="icono-accion-izquierda icon-print"></i></a>
			<a href="javascript:voi(0);"><i style="left: 20px;" class="icono-accion-izquierda icon-pencil"></i></a>
			<a href="javascript:voi(0);"><i style="left: 40px;" class="icono-accion-izquierda icon-remove"></i></a>
		</span>
		
		<hr>
		
		<table>
			<tr><td style="width:20px;" class="contenedor-iconos-accion">
				<span class="contenedor-input">&nbsp;
					<a href="javascript:voi(0);"><i style="left: 0px;" class="icono-accion-izquierda icon-leaf"></i></a>
				</span>
				</td>
				<td>Otro contenido cualquiera</td>
				<td style="width:62px;" class="contenedor-iconos-accion">
				<span class="contenedor-input">&nbsp;
					<a href="javascript:voi(0);"><i style="left: 0px;" class="icono-accion-izquierda icon-print"></i></a>
					<a href="javascript:voi(0);"><i style="left: 20px;" class="icono-accion-izquierda icon-pencil"></i></a>
					<a href="javascript:voi(0);"><i style="left: 40px;" class="icono-accion-izquierda icon-remove"></i></a>
				</span>
			</td></tr>
			<tr><td style="width:20px;" class="contenedor-iconos-accion">
				<span class="contenedor-input">&nbsp;
					<a href="javascript:voi(0);"><i style="left: 0px;" class="icono-accion-izquierda icon-leaf"></i></a>
				</span>
				</td>
				<td>Otro contenido cualquiera</td>
				<td style="width:62px;" class="contenedor-iconos-accion">
				<span class="contenedor-input">&nbsp;
					<a href="javascript:voi(0);"><i style="left: 0px;" class="icono-accion-izquierda icon-print"></i></a>
					<a href="javascript:voi(0);"><i style="left: 20px;" class="icono-accion-izquierda icon-pencil"></i></a>
					<a href="javascript:voi(0);"><i style="left: 40px;" class="icono-accion-izquierda icon-remove"></i></a>
				</span>
			</td></tr>
		</table>

		<hr>

		<span class="contenedor-input">
			<input class="" type="t-ext" style="padding-right:40px;">
			<a href="javascript:voi(0);"><i style="right: 20px;" class="icono-accion-derecha icon-remove"></i></a>
			<a href="javascript:voi(0);"><i class="icono-accion-derecha icon-info-sign"></i></a>
		</span>
		
		<hr>
		<span class="contenedor-input">
			<input placeholder="buscar" class="" type="t-ext" style="padding-right:27px;padding-left:24px;">
			<a href="javascript:voi(0);"><i class="icono-accion-derecha icon-keyboard"></i></a>
			<i class="icono-accion-izquierda icon-search"></i>
		</span>

		<a class="btn btn-small" href="#" style="outline:0;">
  			<i class="icon-upload-alt"></i> Subir archivo </a>
		
		<hr>
  		<div style="cursor:pointer; display:inline-block; width:15px;"><i rel="check-1" class="check icon-check-empty"></i></div> <label style="display:inline-block;" rel="check-1" class="check">Desayuno</label>
  		&nbsp;&nbsp;
  		<div style="cursor:pointer; display:inline-block; width:15px;"><i rel="check-2" class="check icon-check-empty"></i></div> <label style="display:inline-block;" rel="check-2" class="check">Almuerzo</label>

		</form>
	</section>
</body>
</html>
