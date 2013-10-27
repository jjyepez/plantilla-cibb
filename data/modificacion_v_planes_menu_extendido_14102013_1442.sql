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
	t_planes_menu.cantidad_dias,
	t_estatus.descripcion AS estatus_plan,
	t_estatus.codigo_estatus AS codigo_estatus_plan,
	t_raciones.nombre_racion AS nombre_racion,
	t_raciones.codigo_racion AS codigo_racion_plan
FROM 
	(cobi.t_planes_menu 
	LEFT JOIN 
	cobi.t_poblacion 
	ON (((t_poblacion.codigo_poblacion)::TEXT = (t_planes_menu.codigo_poblacion)::TEXT))
	)
	LEFT JOIN
	cobi.t_estatus
	ON cobi.t_estatus.codigo_estatus = cobi.t_planes_menu.codigo_estatus
	
	LEFT JOIN
	cobi.t_raciones
	ON cobi.t_raciones.codigo_racion = cobi.t_poblacion.codigo_racion
	;