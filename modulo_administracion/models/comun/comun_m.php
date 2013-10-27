<?php 
class Comun_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function consultar_localizacion($id_estado='',$id_municipio='',$id_parroquia=''){

        $db = $this->load->database('SGA',TRUE);
        $sql="SELECT 	      
               e.id_estado,e.descripcion AS des_estado,
               m.id_municipio,m.descripcion AS des_municipio,
               p.id_parroquia,p.descripcion AS des_parroquia
              FROM 
                localizacion.t_estados  AS e
              left join
                 localizacion.t_municipios AS m
              on
                m.id_estado = e.id_estado
              left join
                localizacion.t_parroquias AS p
              on
                p.id_municipio = m.id_municipio
              WHERE 
              e.id_estado = '$id_estado' 
              and m.id_municipio = '$id_municipio' 
              and p.id_parroquia ='$id_parroquia';";
           
        $localizacion=$db->query($sql);

        $db->close();
        return $localizacion->row_array();

    }

    public function info_usuario_segun_id($id_usuario='|', $usuario='|'){
        $db = $this->load->database('SGA',TRUE);
        $sql="select 
	            p.id_estado, 
	            p.id_municipio, 
	            p.id_parroquia, 
	            p.nombres, 
	            p.apellidos, 
	            p.cedula, 
	            p.id_persona, 
	            u.id_usuario, 
	            ru.id_rol, 
	            r.nombre_rol, r.nivel,
                p.telefono,
                p.correo
            FROM
	            seguridad.t_usuarios as u 
            JOIN
	            principal.personas AS p
            ON
	            p.cedula=CAST(u.usuario as integer)
            LEFT JOIN
	            seguridad.t_roles_usuarios as ru
            ON
	            ru.id_usuario = u.id_usuario
            LEFT JOIN
	            seguridad.t_roles as r
	            ON
	            r.id_rol=ru.id_rol
            WHERE
	            u.id_usuario='$id_usuario' or u.usuario='$usuario'";
           
        $data=$db->query($sql);

        $db->close();
        return $data->row_array();
    }
}
?>
