<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2013-09-24 12:56:36 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 21
ERROR - 2013-09-24 12:56:36 --> Severity: Notice  --> Undefined index: nivel_rol /var/www/cobi/modulo_administracion/controllers/s.php 22
ERROR - 2013-09-24 12:56:36 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  el operador no existe: integer &gt;=
LINE 3: WHERE &quot;nivel_rol&quot; &gt;=
                          ^
HINT:  Ningún operador coincide con el nombre y el tipo de los argumentos. Puede desear agregar conversiones explícitas de tipos. /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 12:56:36 --> Query error: ERROR:  el operador no existe: integer >=
LINE 3: WHERE "nivel_rol" >=
                          ^
HINT:  Ningún operador coincide con el nombre y el tipo de los argumentos. Puede desear agregar conversiones explícitas de tipos.
ERROR - 2013-09-24 13:43:01 --> Severity: Notice  --> Undefined variable: codig_usuario /var/www/cobi/systm/helpers/control_usuarios_helper.php 260
ERROR - 2013-09-24 13:44:28 --> Severity: Notice  --> Undefined variable: codig_usuario /var/www/cobi/systm/helpers/control_usuarios_helper.php 260
ERROR - 2013-09-24 13:50:46 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE &quot;id&quot; = 'US0002'
                     ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 13:50:46 --> Query error: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE "id" = 'US0002'
                     ^
ERROR - 2013-09-24 13:52:33 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE &quot;id&quot; = 'US0002'
                     ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 13:52:33 --> Query error: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE "id" = 'US0002'
                     ^
ERROR - 2013-09-24 13:53:25 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE &quot;id&quot; =  'US0002'
                      ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 13:53:25 --> Query error: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE "id" =  'US0002'
                      ^
ERROR - 2013-09-24 13:54:15 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE &quot;id&quot; =  'US0002'
                      ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 13:54:15 --> Query error: ERROR:  la sintaxis de entrada no es válida para integer: «US0002»
LINE 3: WHERE "id" =  'US0002'
                      ^
ERROR - 2013-09-24 14:02:40 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 79
ERROR - 2013-09-24 14:02:40 --> Severity: Notice  --> Undefined index: codigo_rol /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 270
ERROR - 2013-09-24 14:03:09 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 80
ERROR - 2013-09-24 14:03:09 --> Severity: Notice  --> Undefined index: codigo_rol /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 270
ERROR - 2013-09-24 14:03:52 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 80
ERROR - 2013-09-24 14:03:52 --> Severity: Notice  --> Undefined index: codigo_rol /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 270
ERROR - 2013-09-24 14:04:09 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 80
ERROR - 2013-09-24 14:04:09 --> Severity: Notice  --> Undefined index: codigo_rol /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 270
ERROR - 2013-09-24 14:04:22 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 80
ERROR - 2013-09-24 14:04:22 --> Severity: Notice  --> Undefined index: codigo_rol /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 270
ERROR - 2013-09-24 15:00:10 --> Severity: Warning  --> extract() expects parameter 1 to be array, null given /var/www/cobi/modulo_administracion/models/modelo_base_m.php 86
ERROR - 2013-09-24 15:07:16 --> Severity: Warning  --> extract() expects parameter 1 to be array, string given /var/www/cobi/systm/helpers/control_usuarios_helper.php 259
ERROR - 2013-09-24 15:07:16 --> Severity: Warning  --> extract() expects parameter 1 to be array, string given /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 265
ERROR - 2013-09-24 15:07:16 --> Severity: Warning  --> extract() expects parameter 1 to be array, string given /var/www/cobi/systm/helpers/control_usuarios_helper.php 259
ERROR - 2013-09-24 15:07:16 --> Severity: Warning  --> extract() expects parameter 1 to be array, string given /var/www/cobi/aplicacion_base/models/seguridad/control_usuarios_m.php 265
ERROR - 2013-09-24 15:14:05 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  no existe la columna «codigo_usuario»
LINE 3: WHERE &quot;codigo_usuario&quot; =  'US0002'
              ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 15:14:05 --> Query error: ERROR:  no existe la columna «codigo_usuario»
LINE 3: WHERE "codigo_usuario" =  'US0002'
              ^
ERROR - 2013-09-24 15:38:20 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  no están implementadas las referencias entre bases de datos: «seguridad.seguridad.v_informacion_modulos_disponibles_usuarios»
LINE 2: FROM &quot;seguridad&quot;.&quot;seguridad&quot;.&quot;v_informacion_modulos_disponib...
             ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 15:38:20 --> Query error: ERROR:  no están implementadas las referencias entre bases de datos: «seguridad.seguridad.v_informacion_modulos_disponibles_usuarios»
LINE 2: FROM "seguridad"."seguridad"."v_informacion_modulos_disponib...
             ^
ERROR - 2013-09-24 15:40:06 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  no están implementadas las referencias entre bases de datos: «seguridad.seguridad.v_informacion_modulos_disponibles_usuarios»
LINE 2: FROM &quot;seguridad&quot;.&quot;seguridad&quot;.&quot;v_informacion_modulos_disponib...
             ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 15:40:06 --> Query error: ERROR:  no están implementadas las referencias entre bases de datos: «seguridad.seguridad.v_informacion_modulos_disponibles_usuarios»
LINE 2: FROM "seguridad"."seguridad"."v_informacion_modulos_disponib...
             ^
ERROR - 2013-09-24 15:40:36 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  no existe la columna «codigo_modulo»
LINE 4: AND &quot;codigo_modulo&quot; =  'MD0002'
            ^ /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 15:40:36 --> Query error: ERROR:  no existe la columna «codigo_modulo»
LINE 4: AND "codigo_modulo" =  'MD0002'
            ^
ERROR - 2013-09-24 15:44:43 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 15:44:43 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 15:48:25 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 15:48:25 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 15:59:12 --> Severity: Notice  --> Undefined variable: valor1 /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 15:59:12 --> Severity: Notice  --> Undefined variable: valor1 /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 16:24:00 --> Severity: Notice  --> Undefined variable: moodulos_vista /var/www/cobi/modulo_administracion/controllers/s.php 97
ERROR - 2013-09-24 16:24:00 --> Severity: Warning  --> Invalid argument supplied for foreach() /var/www/cobi/modulo_administracion/views/crud/registro_v.php 227
ERROR - 2013-09-24 16:28:09 --> Severity: Notice  --> Undefined variable: moodulos_vista /var/www/cobi/modulo_administracion/controllers/s.php 98
ERROR - 2013-09-24 16:28:09 --> Severity: Warning  --> Invalid argument supplied for foreach() /var/www/cobi/modulo_administracion/views/crud/registro_v.php 227
ERROR - 2013-09-24 18:41:46 --> Severity: Notice  --> Undefined index: codigo_usuario /var/www/cobi/modulo_administracion/controllers/s.php 21
ERROR - 2013-09-24 18:41:46 --> Severity: Notice  --> Undefined index: nivel_rol /var/www/cobi/modulo_administracion/controllers/s.php 22
ERROR - 2013-09-24 18:41:46 --> Severity: Warning  --> pg_query(): Query failed: ERROR:  el operador no existe: integer &gt;=
LINE 3: WHERE &quot;nivel_rol&quot; &gt;=
                          ^
HINT:  Ningún operador coincide con el nombre y el tipo de los argumentos. Puede desear agregar conversiones explícitas de tipos. /var/www/cobi/systm/database/drivers/postgre/postgre_driver.php 176
ERROR - 2013-09-24 18:41:46 --> Query error: ERROR:  el operador no existe: integer >=
LINE 3: WHERE "nivel_rol" >=
                          ^
HINT:  Ningún operador coincide con el nombre y el tipo de los argumentos. Puede desear agregar conversiones explícitas de tipos.
ERROR - 2013-09-24 18:47:55 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 18:47:55 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 18:47:55 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 18:47:55 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 18:59:27 --> Severity: Warning  --> array_push() expects parameter 1 to be array, null given /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 18:59:27 --> Severity: Warning  --> array_push() expects parameter 1 to be array, null given /var/www/cobi/modulo_administracion/controllers/s.php 95
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:03 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:15 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:01:55 --> Severity: Notice  --> Array to string conversion /var/www/cobi/modulo_administracion/controllers/s.php 106
ERROR - 2013-09-24 19:33:31 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:31 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:31 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:31 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:47 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:47 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:47 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:33:47 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:34:02 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:34:02 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:34:02 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:34:02 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:39:07 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:39:07 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:39:07 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:39:07 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:43:00 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:44:11 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:44:11 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:44:11 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:44:11 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:45:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:45:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:45:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:45:35 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:16 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:16 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:16 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:16 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:39 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:39 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:39 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:46:39 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:47:44 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:47:44 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:47:44 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:47:44 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:50:23 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:50:23 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:50:23 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 19:50:23 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 20:13:32 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 20:13:32 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 20:13:32 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 20:13:32 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 269
ERROR - 2013-09-24 20:28:38 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:28:38 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:28:38 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:28:38 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:36:28 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:36:28 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:36:28 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:36:28 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:37:29 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:37:29 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:37:29 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
ERROR - 2013-09-24 20:37:29 --> Severity: Notice  --> Undefined offset: 1 /var/www/cobi/systm/helpers/control_usuarios_helper.php 270
