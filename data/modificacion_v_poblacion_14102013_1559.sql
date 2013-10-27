DROP VIEW IF EXISTS cobi.v_poblacion;

CREATE VIEW cobi.v_poblacion AS

SELECT 
	cobi.t_poblacion.id,
	cobi.t_poblacion.codigo_poblacion,
	cobi.t_poblacion.nombre,
	cobi.t_poblacion.descripcion,
	cobi.t_poblacion.requerimiento_calorico,
	cobi.t_raciones.codigo_racion,
	cobi.t_raciones.nombre_racion
FROM 
	cobi.t_poblacion
LEFT JOIN
	cobi.t_raciones
	ON cobi.t_raciones.codigo_racion = cobi.t_poblacion.codigo_racion

;