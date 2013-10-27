--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.6
-- Dumped by pg_dump version 9.1.6
-- Started on 2013-09-09 00:48:59 VET

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 7 (class 2615 OID 17113)
-- Name: seguridad; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA seguridad;


ALTER SCHEMA seguridad OWNER TO postgres;

SET search_path = seguridad, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 184 (class 1259 OID 17255)
-- Dependencies: 7
-- Name: t_estatus_usuarios; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_estatus_usuarios (
    id integer NOT NULL,
    codigo_estatus_usuarios character varying(6) NOT NULL,
    nombre_estatus character varying(100) NOT NULL,
    descripcion_estatus character varying(255) NOT NULL
);


ALTER TABLE seguridad.t_estatus_usuarios OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 17253)
-- Dependencies: 184 7
-- Name: t_estatus_usuarios_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_estatus_usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_estatus_usuarios_id_seq OWNER TO postgres;

--
-- TOC entry 2079 (class 0 OID 0)
-- Dependencies: 183
-- Name: t_estatus_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_estatus_usuarios_id_seq OWNED BY t_estatus_usuarios.id;


--
-- TOC entry 179 (class 1259 OID 17200)
-- Dependencies: 7
-- Name: t_logs; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_logs (
    id integer NOT NULL,
    evento text,
    codigo_usuario character varying(6),
    momento character varying(100)
);


ALTER TABLE seguridad.t_logs OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 17198)
-- Dependencies: 7 179
-- Name: t_logs_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_logs_id_seq OWNER TO postgres;

--
-- TOC entry 2080 (class 0 OID 0)
-- Dependencies: 178
-- Name: t_logs_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_logs_id_seq OWNED BY t_logs.id;


--
-- TOC entry 162 (class 1259 OID 17114)
-- Dependencies: 7
-- Name: t_modulos; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_modulos (
    id integer NOT NULL,
    codigo_modulo character varying(6) NOT NULL,
    nombre_modulo character varying(100) NOT NULL,
    descripcion_modulo character varying(255),
    codigo_sistema character varying(6) NOT NULL
);


ALTER TABLE seguridad.t_modulos OWNER TO postgres;

--
-- TOC entry 163 (class 1259 OID 17117)
-- Dependencies: 162 7
-- Name: t_modulos_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_modulos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_modulos_id_seq OWNER TO postgres;

--
-- TOC entry 2081 (class 0 OID 0)
-- Dependencies: 163
-- Name: t_modulos_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_modulos_id_seq OWNED BY t_modulos.id;


--
-- TOC entry 164 (class 1259 OID 17119)
-- Dependencies: 7
-- Name: t_permisos; Type: TABLE; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

CREATE TABLE t_permisos (
    id integer NOT NULL,
    codigo_permiso character varying(6) NOT NULL,
    codigo_modulo character varying(6) NOT NULL,
    nombre_permiso character varying(100),
    descripcion_permiso character varying(255)
);


ALTER TABLE seguridad.t_permisos OWNER TO usuario_base;

--
-- TOC entry 165 (class 1259 OID 17122)
-- Dependencies: 164 7
-- Name: t_permisos_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: usuario_base
--

CREATE SEQUENCE t_permisos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_permisos_id_seq OWNER TO usuario_base;

--
-- TOC entry 2082 (class 0 OID 0)
-- Dependencies: 165
-- Name: t_permisos_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: usuario_base
--

ALTER SEQUENCE t_permisos_id_seq OWNED BY t_permisos.id;


--
-- TOC entry 188 (class 1259 OID 17275)
-- Dependencies: 7
-- Name: t_personas; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_personas (
    id integer NOT NULL,
    codigo_persona character varying(6) NOT NULL,
    nombres character varying(255) NOT NULL,
    apellidos character varying(255) NOT NULL,
    cedula character varying(10) NOT NULL,
    correo_electronico character varying(255) NOT NULL
);


ALTER TABLE seguridad.t_personas OWNER TO postgres;

--
-- TOC entry 2083 (class 0 OID 0)
-- Dependencies: 188
-- Name: TABLE t_personas; Type: COMMENT; Schema: seguridad; Owner: postgres
--

COMMENT ON TABLE t_personas IS 'ESTA TABLA FUE CREADA SOLO POR MOTIVOS DE PRUEBAS .... DEBE SER CREADA CORRECTAMENTE EN EL ESQUEMA CORRESPONDIENTE A SU RESPECTIVO SISTEMA .... jjy';


--
-- TOC entry 187 (class 1259 OID 17273)
-- Dependencies: 188 7
-- Name: t_personas_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_personas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_personas_id_seq OWNER TO postgres;

--
-- TOC entry 2084 (class 0 OID 0)
-- Dependencies: 187
-- Name: t_personas_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_personas_id_seq OWNED BY t_personas.id;


--
-- TOC entry 166 (class 1259 OID 17124)
-- Dependencies: 7
-- Name: t_roles; Type: TABLE; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

CREATE TABLE t_roles (
    id integer NOT NULL,
    codigo_rol character varying(6) NOT NULL,
    nombre_rol character varying(100),
    descripcion_rol character varying(255)
);


ALTER TABLE seguridad.t_roles OWNER TO usuario_base;

--
-- TOC entry 167 (class 1259 OID 17127)
-- Dependencies: 166 7
-- Name: t_roles_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: usuario_base
--

CREATE SEQUENCE t_roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_roles_id_seq OWNER TO usuario_base;

--
-- TOC entry 2085 (class 0 OID 0)
-- Dependencies: 167
-- Name: t_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: usuario_base
--

ALTER SEQUENCE t_roles_id_seq OWNED BY t_roles.id;


--
-- TOC entry 182 (class 1259 OID 17230)
-- Dependencies: 2023 7
-- Name: t_sesiones_usuarios; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_sesiones_usuarios (
    id integer NOT NULL,
    codigo_usuario character varying(6) NOT NULL,
    hash_sesion character varying(255) NOT NULL,
    codigo_estatus character varying(6) NOT NULL,
    momento timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE seguridad.t_sesiones_usuarios OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 17228)
-- Dependencies: 7 182
-- Name: t_sesiones_usuarios_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_sesiones_usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_sesiones_usuarios_id_seq OWNER TO postgres;

--
-- TOC entry 2086 (class 0 OID 0)
-- Dependencies: 181
-- Name: t_sesiones_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_sesiones_usuarios_id_seq OWNED BY t_sesiones_usuarios.id;


--
-- TOC entry 168 (class 1259 OID 17129)
-- Dependencies: 7
-- Name: t_sistemas; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_sistemas (
    id integer NOT NULL,
    codigo_sistema character varying(6) NOT NULL,
    nombre_sistema character varying(100) NOT NULL,
    descripcion_sistema character varying(255)
);


ALTER TABLE seguridad.t_sistemas OWNER TO postgres;

--
-- TOC entry 169 (class 1259 OID 17132)
-- Dependencies: 7 168
-- Name: t_sistemas_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_sistemas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_sistemas_id_seq OWNER TO postgres;

--
-- TOC entry 2087 (class 0 OID 0)
-- Dependencies: 169
-- Name: t_sistemas_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_sistemas_id_seq OWNED BY t_sistemas.id;


--
-- TOC entry 170 (class 1259 OID 17134)
-- Dependencies: 7
-- Name: t_usuarios; Type: TABLE; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

CREATE TABLE t_usuarios (
    id integer NOT NULL,
    codigo_usuario character varying(6) NOT NULL,
    nombre_usuario character varying(100),
    contrasena character varying(20),
    codigo_persona character varying(6),
    codigo_estatus character varying(6)
);


ALTER TABLE seguridad.t_usuarios OWNER TO usuario_base;

--
-- TOC entry 171 (class 1259 OID 17137)
-- Dependencies: 170 7
-- Name: t_usuarios_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: usuario_base
--

CREATE SEQUENCE t_usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_usuarios_id_seq OWNER TO usuario_base;

--
-- TOC entry 2088 (class 0 OID 0)
-- Dependencies: 171
-- Name: t_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: usuario_base
--

ALTER SEQUENCE t_usuarios_id_seq OWNED BY t_usuarios.id;


--
-- TOC entry 172 (class 1259 OID 17139)
-- Dependencies: 7
-- Name: t_usuarios_modulos_negados; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_usuarios_modulos_negados (
    codigo_rol character varying(6) NOT NULL,
    codigo_modulo_negado character varying(6) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE seguridad.t_usuarios_modulos_negados OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 17142)
-- Dependencies: 172 7
-- Name: t_usuarios_modulos_negados_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_usuarios_modulos_negados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_usuarios_modulos_negados_id_seq OWNER TO postgres;

--
-- TOC entry 2089 (class 0 OID 0)
-- Dependencies: 173
-- Name: t_usuarios_modulos_negados_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_modulos_negados_id_seq OWNED BY t_usuarios_modulos_negados.id;


--
-- TOC entry 174 (class 1259 OID 17144)
-- Dependencies: 7
-- Name: t_usuarios_permisos_negados; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_usuarios_permisos_negados (
    codigo_permiso_negado character varying(6) NOT NULL,
    codigo_rol character varying(6) NOT NULL,
    id integer NOT NULL,
    codigo_modulo character varying(6) NOT NULL
);


ALTER TABLE seguridad.t_usuarios_permisos_negados OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 17147)
-- Dependencies: 7 174
-- Name: t_usuarios_permisos_negados_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_usuarios_permisos_negados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_usuarios_permisos_negados_id_seq OWNER TO postgres;

--
-- TOC entry 2090 (class 0 OID 0)
-- Dependencies: 175
-- Name: t_usuarios_permisos_negados_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_permisos_negados_id_seq OWNED BY t_usuarios_permisos_negados.id;


--
-- TOC entry 186 (class 1259 OID 17265)
-- Dependencies: 7
-- Name: t_usuarios_roles; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_usuarios_roles (
    id integer NOT NULL,
    codigo_rol character varying(6) NOT NULL,
    codigo_usuario character varying(6) NOT NULL
);


ALTER TABLE seguridad.t_usuarios_roles OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 17263)
-- Dependencies: 186 7
-- Name: t_usuarios_roles_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_usuarios_roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_usuarios_roles_id_seq OWNER TO postgres;

--
-- TOC entry 2091 (class 0 OID 0)
-- Dependencies: 185
-- Name: t_usuarios_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_roles_id_seq OWNED BY t_usuarios_roles.id;


--
-- TOC entry 176 (class 1259 OID 17149)
-- Dependencies: 7
-- Name: t_usuarios_sistemas_negados; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_usuarios_sistemas_negados (
    codigo_usuario character varying(6) NOT NULL,
    codigo_sistema_negado character varying NOT NULL,
    id integer NOT NULL
);


ALTER TABLE seguridad.t_usuarios_sistemas_negados OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 17155)
-- Dependencies: 176 7
-- Name: t_usuarios_sistemas_negados_id_seq; Type: SEQUENCE; Schema: seguridad; Owner: postgres
--

CREATE SEQUENCE t_usuarios_sistemas_negados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE seguridad.t_usuarios_sistemas_negados_id_seq OWNER TO postgres;

--
-- TOC entry 2092 (class 0 OID 0)
-- Dependencies: 177
-- Name: t_usuarios_sistemas_negados_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_sistemas_negados_id_seq OWNED BY t_usuarios_sistemas_negados.id;


--
-- TOC entry 189 (class 1259 OID 17287)
-- Dependencies: 2012 7
-- Name: v_informacion_usuarios; Type: VIEW; Schema: seguridad; Owner: postgres
--

CREATE VIEW v_informacion_usuarios AS
    SELECT u.id, u.codigo_usuario, u.nombre_usuario, u.contrasena, u.codigo_persona, u.codigo_estatus, ur.codigo_rol, p.cedula, p.nombres, p.apellidos, p.correo_electronico, su.nombre_estatus AS estatus_usuario, ru.nombre_rol AS rol_usuario FROM ((((t_usuarios u LEFT JOIN t_personas p ON (((p.codigo_persona)::text = (u.codigo_persona)::text))) LEFT JOIN t_estatus_usuarios su ON (((su.codigo_estatus_usuarios)::text = (u.codigo_estatus)::text))) LEFT JOIN t_usuarios_roles ur ON (((ur.codigo_usuario)::text = (u.codigo_usuario)::text))) LEFT JOIN t_roles ru ON (((ru.codigo_rol)::text = (ur.codigo_rol)::text)));


ALTER TABLE seguridad.v_informacion_usuarios OWNER TO postgres;

--
-- TOC entry 2024 (class 2604 OID 17258)
-- Dependencies: 184 183 184
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_estatus_usuarios ALTER COLUMN id SET DEFAULT nextval('t_estatus_usuarios_id_seq'::regclass);


--
-- TOC entry 2021 (class 2604 OID 17203)
-- Dependencies: 179 178 179
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_logs ALTER COLUMN id SET DEFAULT nextval('t_logs_id_seq'::regclass);


--
-- TOC entry 2013 (class 2604 OID 17157)
-- Dependencies: 163 162
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_modulos ALTER COLUMN id SET DEFAULT nextval('t_modulos_id_seq'::regclass);


--
-- TOC entry 2014 (class 2604 OID 17158)
-- Dependencies: 165 164
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: usuario_base
--

ALTER TABLE ONLY t_permisos ALTER COLUMN id SET DEFAULT nextval('t_permisos_id_seq'::regclass);


--
-- TOC entry 2026 (class 2604 OID 17278)
-- Dependencies: 187 188 188
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_personas ALTER COLUMN id SET DEFAULT nextval('t_personas_id_seq'::regclass);


--
-- TOC entry 2015 (class 2604 OID 17159)
-- Dependencies: 167 166
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: usuario_base
--

ALTER TABLE ONLY t_roles ALTER COLUMN id SET DEFAULT nextval('t_roles_id_seq'::regclass);


--
-- TOC entry 2022 (class 2604 OID 17233)
-- Dependencies: 182 181 182
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_sesiones_usuarios ALTER COLUMN id SET DEFAULT nextval('t_sesiones_usuarios_id_seq'::regclass);


--
-- TOC entry 2016 (class 2604 OID 17160)
-- Dependencies: 169 168
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_sistemas ALTER COLUMN id SET DEFAULT nextval('t_sistemas_id_seq'::regclass);


--
-- TOC entry 2017 (class 2604 OID 17161)
-- Dependencies: 171 170
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: usuario_base
--

ALTER TABLE ONLY t_usuarios ALTER COLUMN id SET DEFAULT nextval('t_usuarios_id_seq'::regclass);


--
-- TOC entry 2018 (class 2604 OID 17162)
-- Dependencies: 173 172
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_modulos_negados ALTER COLUMN id SET DEFAULT nextval('t_usuarios_modulos_negados_id_seq'::regclass);


--
-- TOC entry 2019 (class 2604 OID 17163)
-- Dependencies: 175 174
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_permisos_negados ALTER COLUMN id SET DEFAULT nextval('t_usuarios_permisos_negados_id_seq'::regclass);


--
-- TOC entry 2025 (class 2604 OID 17268)
-- Dependencies: 185 186 186
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_roles ALTER COLUMN id SET DEFAULT nextval('t_usuarios_roles_id_seq'::regclass);


--
-- TOC entry 2020 (class 2604 OID 17164)
-- Dependencies: 177 176
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_sistemas_negados ALTER COLUMN id SET DEFAULT nextval('t_usuarios_sistemas_negados_id_seq'::regclass);


--
-- TOC entry 2064 (class 2606 OID 17260)
-- Dependencies: 184 184 2076
-- Name: t_estatus_usuarios_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_estatus_usuarios
    ADD CONSTRAINT t_estatus_usuarios_pkey PRIMARY KEY (codigo_estatus_usuarios);


--
-- TOC entry 2060 (class 2606 OID 17208)
-- Dependencies: 179 179 2076
-- Name: t_logs_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_logs
    ADD CONSTRAINT t_logs_pkey PRIMARY KEY (id);


--
-- TOC entry 2028 (class 2606 OID 17166)
-- Dependencies: 162 162 2076
-- Name: t_modulos_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_modulos
    ADD CONSTRAINT t_modulos_pkey PRIMARY KEY (codigo_modulo);


--
-- TOC entry 2032 (class 2606 OID 17168)
-- Dependencies: 164 164 2076
-- Name: t_permisos_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_permisos
    ADD CONSTRAINT t_permisos_id_key UNIQUE (id);


--
-- TOC entry 2034 (class 2606 OID 17170)
-- Dependencies: 164 164 2076
-- Name: t_permisos_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_permisos
    ADD CONSTRAINT t_permisos_pkey PRIMARY KEY (codigo_permiso);


--
-- TOC entry 2071 (class 2606 OID 17286)
-- Dependencies: 188 188 2076
-- Name: t_personas_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_personas
    ADD CONSTRAINT t_personas_pkey PRIMARY KEY (codigo_persona);


--
-- TOC entry 2036 (class 2606 OID 17172)
-- Dependencies: 166 166 2076
-- Name: t_roles_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_roles
    ADD CONSTRAINT t_roles_id_key UNIQUE (id);


--
-- TOC entry 2038 (class 2606 OID 17174)
-- Dependencies: 166 166 2076
-- Name: t_roles_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_roles
    ADD CONSTRAINT t_roles_pkey PRIMARY KEY (codigo_rol);


--
-- TOC entry 2040 (class 2606 OID 17176)
-- Dependencies: 168 168 2076
-- Name: t_sistemas_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_sistemas
    ADD CONSTRAINT t_sistemas_pkey PRIMARY KEY (codigo_sistema);


--
-- TOC entry 2044 (class 2606 OID 17178)
-- Dependencies: 170 170 2076
-- Name: t_usuarios_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_usuarios
    ADD CONSTRAINT t_usuarios_id_key UNIQUE (id);


--
-- TOC entry 2048 (class 2606 OID 17180)
-- Dependencies: 172 172 2076
-- Name: t_usuarios_modulos_negados_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_modulos_negados
    ADD CONSTRAINT t_usuarios_modulos_negados_id_key UNIQUE (id);


--
-- TOC entry 2052 (class 2606 OID 17182)
-- Dependencies: 174 174 2076
-- Name: t_usuarios_permisos_negados_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_permisos_negados
    ADD CONSTRAINT t_usuarios_permisos_negados_id_key UNIQUE (id);


--
-- TOC entry 2046 (class 2606 OID 17184)
-- Dependencies: 170 170 2076
-- Name: t_usuarios_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_usuarios
    ADD CONSTRAINT t_usuarios_pkey PRIMARY KEY (codigo_usuario);


--
-- TOC entry 2056 (class 2606 OID 17186)
-- Dependencies: 176 176 2076
-- Name: t_usuarios_sistemas_negados_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_sistemas_negados
    ADD CONSTRAINT t_usuarios_sistemas_negados_id_key UNIQUE (id);


--
-- TOC entry 2066 (class 2606 OID 17262)
-- Dependencies: 184 184 2076
-- Name: unique_id_estatus_usuarios; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_estatus_usuarios
    ADD CONSTRAINT unique_id_estatus_usuarios UNIQUE (id);


--
-- TOC entry 2030 (class 2606 OID 17188)
-- Dependencies: 162 162 2076
-- Name: unique_id_modulos; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_modulos
    ADD CONSTRAINT unique_id_modulos UNIQUE (id);


--
-- TOC entry 2050 (class 2606 OID 17190)
-- Dependencies: 172 172 2076
-- Name: unique_id_modulos_negados; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_modulos_negados
    ADD CONSTRAINT unique_id_modulos_negados UNIQUE (id);


--
-- TOC entry 2054 (class 2606 OID 17192)
-- Dependencies: 174 174 2076
-- Name: unique_id_permisos_negados; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_permisos_negados
    ADD CONSTRAINT unique_id_permisos_negados UNIQUE (id);


--
-- TOC entry 2062 (class 2606 OID 17235)
-- Dependencies: 182 182 2076
-- Name: unique_id_sesiones; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_sesiones_usuarios
    ADD CONSTRAINT unique_id_sesiones UNIQUE (id);


--
-- TOC entry 2042 (class 2606 OID 17194)
-- Dependencies: 168 168 2076
-- Name: unique_id_sistemas; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_sistemas
    ADD CONSTRAINT unique_id_sistemas UNIQUE (id);


--
-- TOC entry 2058 (class 2606 OID 17196)
-- Dependencies: 176 176 2076
-- Name: unique_id_sistemas_negados; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_sistemas_negados
    ADD CONSTRAINT unique_id_sistemas_negados UNIQUE (id);


--
-- TOC entry 2073 (class 2606 OID 17280)
-- Dependencies: 188 188 2076
-- Name: unique_id_t_personas; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_personas
    ADD CONSTRAINT unique_id_t_personas UNIQUE (id);


--
-- TOC entry 2068 (class 2606 OID 17272)
-- Dependencies: 186 186 2076
-- Name: unique_id_usuarios_roles; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_roles
    ADD CONSTRAINT unique_id_usuarios_roles UNIQUE (id);


--
-- TOC entry 2069 (class 1259 OID 17284)
-- Dependencies: 188 2076
-- Name: index_cedula; Type: INDEX; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE INDEX index_cedula ON t_personas USING btree (cedula);


--
-- TOC entry 2074 (class 2606 OID 17209)
-- Dependencies: 2045 170 179 2076
-- Name: t_logs_codigo_usuario_fkey; Type: FK CONSTRAINT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_logs
    ADD CONSTRAINT t_logs_codigo_usuario_fkey FOREIGN KEY (codigo_usuario) REFERENCES t_usuarios(codigo_usuario);


-- Completed on 2013-09-09 00:49:00 VET

--
-- PostgreSQL database dump complete
--

