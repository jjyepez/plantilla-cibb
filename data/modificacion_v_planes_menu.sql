DROP VIEW "cobi"."v_planes_menu";

CREATE VIEW "cobi"."v_planes_menu" AS 

SELECT 
	t_planes_menu.id, 
	t_planes_menu.codigo_plan_menu, 
	t_planes_menu.nombre_plan_menu, 
	((((date_part('day'::TEXT, t_planes_menu.fecha_registro) || '/'::TEXT) || date_part('month'::TEXT, t_planes_menu.fecha_registro)) || '/'::TEXT) || date_part('year'::TEXT, t_planes_menu.fecha_registro)) AS fecha_registro, 
	t_planes_menu.cantidad_comensales, 
	(t_planes_menu.requerimiento_calorico_total)::TEXT AS requerimiento_calorico_total, 
	t_planes_menu.descripcion_plan, 
	t_poblacion.codigo_poblacion, 
	t_planes_menu.presupuesto_limite, 
	t_poblacion.nombre AS nombre_poblacion, 
	t_planes_menu.cantidad_dias 
	
FROM 
	(cobi.t_planes_menu 
	LEFT JOIN 
	cobi.t_poblacion 
	ON (((t_poblacion.codigo_poblacion)::TEXT = (t_planes_menu.codigo_poblacion)::TEXT))
	);