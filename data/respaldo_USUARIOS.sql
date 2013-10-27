<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
// EL CONTENIDO DE ESTA VARIABLE DEBE SER EL RESPALDO ***PLAIN***** QUE GENERA PGADMIN3 ****SOLO SCHEME **** SIN DATOS!!! SIN  _COPY ...... CUIDADO! .... jjy
**/

$sql_creacion_tablas_seguridad =<<<EOSCRIPT

-- ************************ IMPORTANTE!!!!! 
-- * este script de RESPALDO ... debe generarse desde pgadmin 
-- * con formato "plain" y la opción "SCHEME ONLY" .... SIN DATOS!
-- * con TOOODO su contenido!!!! ... jjy
-- ************************ IMPORTANTE!!!!! 

--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.6
-- Dumped by pg_dump version 9.1.6
-- Started on 2013-09-07 20:16:08 VET

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 7 (class 2615 OID 16395)
-- Name: seguridad; Type: SCHEMA; Schema: -; Owner: postgres
--

-- ************************ CUIDADOOO!!!!! 
-- * la siguiente linea eliminara TOOODOOO EL ESQUEMA seguirdad
-- * con TOOODO su contenido!!!! ... jjy
-- ************************ CUIDADOOO!!!!! 

--DROP SCHEMA if exists seguridad CASCADE;

CREATE SCHEMA seguridad;

ALTER SCHEMA seguridad OWNER TO postgres;

SET search_path = seguridad, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 167 (class 1259 OID 16471)
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
-- TOC entry 166 (class 1259 OID 16469)
-- Dependencies: 7 167
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
-- TOC entry 2016 (class 0 OID 0)
-- Dependencies: 166
-- Name: t_modulos_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_modulos_id_seq OWNED BY t_modulos.id;


--
-- TOC entry 171 (class 1259 OID 16504)
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
-- TOC entry 170 (class 1259 OID 16502)
-- Dependencies: 171 7
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
-- TOC entry 2017 (class 0 OID 0)
-- Dependencies: 170
-- Name: t_permisos_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: usuario_base
--

ALTER SEQUENCE t_permisos_id_seq OWNED BY t_permisos.id;


--
-- TOC entry 165 (class 1259 OID 16461)
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
-- TOC entry 164 (class 1259 OID 16459)
-- Dependencies: 165 7
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
-- TOC entry 2018 (class 0 OID 0)
-- Dependencies: 164
-- Name: t_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: usuario_base
--

ALTER SEQUENCE t_roles_id_seq OWNED BY t_roles.id;


--
-- TOC entry 169 (class 1259 OID 16490)
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
-- TOC entry 168 (class 1259 OID 16488)
-- Dependencies: 7 169
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
-- TOC entry 2019 (class 0 OID 0)
-- Dependencies: 168
-- Name: t_sistemas_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_sistemas_id_seq OWNED BY t_sistemas.id;


--
-- TOC entry 163 (class 1259 OID 16451)
-- Dependencies: 7
-- Name: t_usuarios; Type: TABLE; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

CREATE TABLE t_usuarios (
    id integer NOT NULL,
    codigo_usuario character varying(6) NOT NULL,
    nombre_usuario character varying(100),
    contrasena character varying(20),
    correo_electronico character varying(255),
    codigo_persona character varying(6),
    codigo_estatus character varying(6)
);


ALTER TABLE seguridad.t_usuarios OWNER TO usuario_base;

--
-- TOC entry 162 (class 1259 OID 16449)
-- Dependencies: 163 7
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
-- TOC entry 2020 (class 0 OID 0)
-- Dependencies: 162
-- Name: t_usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: usuario_base
--

ALTER SEQUENCE t_usuarios_id_seq OWNED BY t_usuarios.id;


--
-- TOC entry 173 (class 1259 OID 16545)
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
-- TOC entry 176 (class 1259 OID 16583)
-- Dependencies: 173 7
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
-- TOC entry 2021 (class 0 OID 0)
-- Dependencies: 176
-- Name: t_usuarios_modulos_negados_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_modulos_negados_id_seq OWNED BY t_usuarios_modulos_negados.id;


--
-- TOC entry 175 (class 1259 OID 16568)
-- Dependencies: 7
-- Name: t_usuarios_permisos_negados; Type: TABLE; Schema: seguridad; Owner: postgres; Tablespace: 
--

CREATE TABLE t_usuarios_permisos_negados (
    codigo_permiso_negado character varying(6) NOT NULL,
    codigo_rol character varying(6) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE seguridad.t_usuarios_permisos_negados OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 16594)
-- Dependencies: 175 7
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
-- TOC entry 2022 (class 0 OID 0)
-- Dependencies: 177
-- Name: t_usuarios_permisos_negados_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_permisos_negados_id_seq OWNED BY t_usuarios_permisos_negados.id;


--
-- TOC entry 172 (class 1259 OID 16514)
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
-- TOC entry 174 (class 1259 OID 16552)
-- Dependencies: 172 7
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
-- TOC entry 2023 (class 0 OID 0)
-- Dependencies: 174
-- Name: t_usuarios_sistemas_negados_id_seq; Type: SEQUENCE OWNED BY; Schema: seguridad; Owner: postgres
--

ALTER SEQUENCE t_usuarios_sistemas_negados_id_seq OWNED BY t_usuarios_sistemas_negados.id;


--
-- TOC entry 1974 (class 2604 OID 16474)
-- Dependencies: 166 167 167
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_modulos ALTER COLUMN id SET DEFAULT nextval('t_modulos_id_seq'::regclass);


--
-- TOC entry 1976 (class 2604 OID 16507)
-- Dependencies: 171 170 171
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: usuario_base
--

ALTER TABLE ONLY t_permisos ALTER COLUMN id SET DEFAULT nextval('t_permisos_id_seq'::regclass);


--
-- TOC entry 1973 (class 2604 OID 16464)
-- Dependencies: 164 165 165
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: usuario_base
--

ALTER TABLE ONLY t_roles ALTER COLUMN id SET DEFAULT nextval('t_roles_id_seq'::regclass);


--
-- TOC entry 1975 (class 2604 OID 16493)
-- Dependencies: 168 169 169
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_sistemas ALTER COLUMN id SET DEFAULT nextval('t_sistemas_id_seq'::regclass);


--
-- TOC entry 1972 (class 2604 OID 16454)
-- Dependencies: 162 163 163
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: usuario_base
--

ALTER TABLE ONLY t_usuarios ALTER COLUMN id SET DEFAULT nextval('t_usuarios_id_seq'::regclass);


--
-- TOC entry 1978 (class 2604 OID 16585)
-- Dependencies: 176 173
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_modulos_negados ALTER COLUMN id SET DEFAULT nextval('t_usuarios_modulos_negados_id_seq'::regclass);


--
-- TOC entry 1979 (class 2604 OID 16596)
-- Dependencies: 177 175
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_permisos_negados ALTER COLUMN id SET DEFAULT nextval('t_usuarios_permisos_negados_id_seq'::regclass);


--
-- TOC entry 1977 (class 2604 OID 16554)
-- Dependencies: 174 172
-- Name: id; Type: DEFAULT; Schema: seguridad; Owner: postgres
--

ALTER TABLE ONLY t_usuarios_sistemas_negados ALTER COLUMN id SET DEFAULT nextval('t_usuarios_sistemas_negados_id_seq'::regclass);


--
-- TOC entry 1989 (class 2606 OID 16476)
-- Dependencies: 167 167 2013
-- Name: t_modulos_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_modulos
    ADD CONSTRAINT t_modulos_pkey PRIMARY KEY (codigo_modulo);


--
-- TOC entry 1997 (class 2606 OID 16511)
-- Dependencies: 171 171 2013
-- Name: t_permisos_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_permisos
    ADD CONSTRAINT t_permisos_id_key UNIQUE (id);


--
-- TOC entry 1999 (class 2606 OID 16509)
-- Dependencies: 171 171 2013
-- Name: t_permisos_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_permisos
    ADD CONSTRAINT t_permisos_pkey PRIMARY KEY (codigo_permiso);


--
-- TOC entry 1985 (class 2606 OID 16468)
-- Dependencies: 165 165 2013
-- Name: t_roles_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_roles
    ADD CONSTRAINT t_roles_id_key UNIQUE (id);


--
-- TOC entry 1987 (class 2606 OID 16466)
-- Dependencies: 165 165 2013
-- Name: t_roles_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_roles
    ADD CONSTRAINT t_roles_pkey PRIMARY KEY (codigo_rol);


--
-- TOC entry 1993 (class 2606 OID 16495)
-- Dependencies: 169 169 2013
-- Name: t_sistemas_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_sistemas
    ADD CONSTRAINT t_sistemas_pkey PRIMARY KEY (codigo_sistema);


--
-- TOC entry 1981 (class 2606 OID 16458)
-- Dependencies: 163 163 2013
-- Name: t_usuarios_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_usuarios
    ADD CONSTRAINT t_usuarios_id_key UNIQUE (id);


--
-- TOC entry 2005 (class 2606 OID 16587)
-- Dependencies: 173 173 2013
-- Name: t_usuarios_modulos_negados_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_modulos_negados
    ADD CONSTRAINT t_usuarios_modulos_negados_id_key UNIQUE (id);


--
-- TOC entry 2009 (class 2606 OID 16598)
-- Dependencies: 175 175 2013
-- Name: t_usuarios_permisos_negados_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_permisos_negados
    ADD CONSTRAINT t_usuarios_permisos_negados_id_key UNIQUE (id);


--
-- TOC entry 1983 (class 2606 OID 16456)
-- Dependencies: 163 163 2013
-- Name: t_usuarios_pkey; Type: CONSTRAINT; Schema: seguridad; Owner: usuario_base; Tablespace: 
--

ALTER TABLE ONLY t_usuarios
    ADD CONSTRAINT t_usuarios_pkey PRIMARY KEY (codigo_usuario);


--
-- TOC entry 2001 (class 2606 OID 16556)
-- Dependencies: 172 172 2013
-- Name: t_usuarios_sistemas_negados_id_key; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_sistemas_negados
    ADD CONSTRAINT t_usuarios_sistemas_negados_id_key UNIQUE (id);


--
-- TOC entry 1991 (class 2606 OID 16501)
-- Dependencies: 167 167 2013
-- Name: unique_id_modulos; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_modulos
    ADD CONSTRAINT unique_id_modulos UNIQUE (id);


--
-- TOC entry 2007 (class 2606 OID 16593)
-- Dependencies: 173 173 2013
-- Name: unique_id_modulos_negados; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_modulos_negados
    ADD CONSTRAINT unique_id_modulos_negados UNIQUE (id);


--
-- TOC entry 2011 (class 2606 OID 16604)
-- Dependencies: 175 175 2013
-- Name: unique_id_permisos_negados; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_permisos_negados
    ADD CONSTRAINT unique_id_permisos_negados UNIQUE (id);


--
-- TOC entry 1995 (class 2606 OID 16497)
-- Dependencies: 169 169 2013
-- Name: unique_id_sistemas; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_sistemas
    ADD CONSTRAINT unique_id_sistemas UNIQUE (id);


--
-- TOC entry 2003 (class 2606 OID 16565)
-- Dependencies: 172 172 2013
-- Name: unique_id_sistemas_negados; Type: CONSTRAINT; Schema: seguridad; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY t_usuarios_sistemas_negados
    ADD CONSTRAINT unique_id_sistemas_negados UNIQUE (id);


-- Completed on 2013-09-07 20:16:08 VET

--
-- PostgreSQL database dump complete
--


EOSCRIPT;

?>