<?php

/*
 * Funcion de conexión al servidor de base de datos.
 * Parametros:
 * Salidas:
 *		$manejador: identificador de conexión con la base de datos.
 */
function db_connect() {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$manejador = @mysql_connect($conf['bdserver'].":".$conf['bdport'],$conf['bduser'],$conf['bdpass']);
		if(!$manejador) {
			throw new Exception("bd.php - db_connect(): Error in DB conection.");
		}
		db_choose($manejador);
		return $manejador;
	} else {
		$error = "bd.php - db_connect(): Data base type was not found. ".mysql_error();
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
		$db_selected = @mysql_select_db($conf['bd'],$manejador);
		if (!$db_selected) {
			throw new Exception("bd.php - db_choose(): Error when choosing table.");
		}
	} else {
		$error = "bd.php - db_choose(): Data base type was not found. ".mysql_error();
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
		$result = mysql_query($query,$manejador);
		if(!$result) {
			throw new Exception("bd.php - db_exec(): The consult was not run. ".$query);
		}
		return $result;
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
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
		$result = mysql_query($query,$manejador);
		if(!$result) {
			throw new Exception("bd.php - db_query(): The consult was not run. ".$query);
		}
		return $result;
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
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
function db_fetch($result, $type=MYSQL_ASSOC) {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		$array = mysql_fetch_array($result,$type);
		return $array;
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
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
		$num = mysql_num_rows($result);
		return $num;
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
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
		$res = mysql_result($result,0,$field);
		return $res;
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
		throw new Exception($error);
	}
}

/*
 * Funcion que devuelve el ultimo id que se ha insertado
 * Parametros:
 * Salidas:
 */
function db_last_id() {
	global $conf;

	if($conf['bdtype'] == "mysql") {
		if($id = mysql_insert_id()) {
			return $id;
		} else {
			throw new Exception("bd.php - db_last_id(): Error recovering last inserted id.");
		}
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
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
		return mysql_real_escape_string(addslashes($field),$manejador);
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
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
		if(!mysql_close($manejador)) {
			throw new Exception("bd.php - db_close(): Error when closing DB conection.");
		}
	} else {
		$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
		throw new Exception($error);
	}
}


?>
