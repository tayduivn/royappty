<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
<<<<<<< HEAD
* Last Edit: 23-06-2014
* Version: 0.91
=======
* Last Edit: 17-07-2014
* Version: 1.02
>>>>>>> FETCH_HEAD
=======
* Last Edit: 17-07-2014
* Version: 1.02
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
*
*********************************************************/

/*
 * Funcion de conexión al servidor de base de datos.
 * Parametros:
 * Salidas:
 *		$manejador: identificador de conexión con la base de datos.
 */
function db_connect() {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$manejador = mysqli_connect($conf['bdserver'],$conf['bduser'],$conf['bdpass']);
		if(!$manejador) {
			throw new Exception("bd.php - db_connect(): Error in DB conection.");
		}
		db_choose($manejador);
		return $manejador;
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_connect(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_connect(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion para seleccionar la base de datos.
 * Parametros:
 *		$manejador: identificador de conexión con la base de datos.
 * Salidas:
 */
function db_choose($manejador) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$db_selected = mysqli_select_db($manejador,$conf['bd']);
		if (!$db_selected) {
			throw new Exception("bd.php - db_choose(): Error when choosing table.");
		}
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_choose(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_choose(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion de ejecucion de comandos SQL (INSERT, UPDATE...). ¡¡¡NO SELECT!!!
 * Parametros:
 *		$query: cadena con la operacion a realizar sobre la base de datos.
 *		$manejador: identificador de conexión con la base de datos.
 * Salidas:
 *		$result: identificador de consulta o resultset.
 */
function db_exec($query,$manejador) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$result = mysqli_query($manejador,$query);
		if(!$result) {
			throw new Exception("bd.php - db_exec(): The consult was not run. ".$query);
		}
		return $result;
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion de consulta de base de datos (solo SELECT)
 * Parametros:
 *		$query: cadena con la consulta a realizar sobre la base de datos.
 *		$manejador: identificador de conexión con la base de datos.
 * Salidas:
 *		$result: identificador de consulta o resultset.
 */
function db_query($query,$manejador) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$result = mysqli_query($manejador,$query);
		if(!$result) {
			throw new Exception("bd.php - db_query(): The consult was not run. ".$query);
		}
		return $result;
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion que devuelve una fila del resulset pasado en forma de array asociativo
 * Parametros:
 *		$result: identificador de consulta o resultset.
 * Salidas:
 *		$array: array asociativo y por referencia con los datos de una fila de la consulta.
 */
function db_fetch($result, $type=MYSQLI_BOTH) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$array = mysqli_fetch_array($result,$type);
		return $array;
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion que devuelve el numero de resultados del resulset
 * Parametros:
 *		$result: identificador de consulta o resultset.
 * Salidas:
 *		$num: numero de filas en el resultado de la consulta.
 */
function db_count($result) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$num = mysqli_num_rows($result);
		return $num;
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion que devuelve el numero de resultados del resulset
 * Parametros:
 *		$result: identificador de consulta o resultset.
 *		$field: numero de campo de la consulta.
 * Salidas:
 *		$res: cadena con el contenido del campo especificado.
 */
function db_result($result,$field) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$res = mysqli_result($result,0,$field);
		return $res;
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion que devuelve el ultimo id que se ha insertado
 * Parametros:
 * Salidas:
 */
function db_last_id($manejador) {
	global $conf;
	global $manejador;
<<<<<<< HEAD

=======
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
	if($conf['bdtype'] == "mysql") {
		if($id = mysqli_insert_id($manejador)) {
			return $id;
		} else {
			throw new Exception("bd.php - db_last_id(): Error when recovering last inserted id.");
		}
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion que trata la informacion a utilizar en la base de datos para evitar vulnerabilidades
 * Parametros:
 *		$field: datos a tratar.
 *		$manejador: identificador de conexión con la base de datos.
 * Salidas:
 */
function db_secure_field($field,$manejador) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		return mysqli_real_escape_string($manejador,addslashes($field));
	} else {
<<<<<<< HEAD
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysqli_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}

/*
 * Funcion de desconexion de base de datos
 * Parametros:
 *		$manejador: identificador de conexión con la base de datos.
 * Salidas:
 */
function db_close($manejador) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		if(!mysqli_close($manejador)) {
<<<<<<< HEAD
			throw new Exception("bd.php - db_close(): Error al cerrar la conexion con la BD.");
		}
	} else {
		$error = "bd.php - db_secure_field(): Tipo de Base de Datos no encontrado. ".mysqli_error();
=======
			throw new Exception("bd.php - db_close(): Error when closing conection with BD.");
		}
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysqli_error();
>>>>>>> c9d28823938990b64f3b97cb39807fa5b60f4800
		throw new Exception($error);
	}
}


?>
