<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	$db_connection=array();
	$db_connection["status"]=true;

	/*
	 * Funcion de conexión al servidor de base de datos.
	 * Parametros:
	 * Salidas:
	 *		$manejador: identificador de conexión con la base de datos.
	 */

	function db_connect() {
	global $conf;
	global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$manejador = mysqli_connect($conf['bdserver'],$conf['bduser'],$conf['bdpass']);
			if(!$manejador) {
				$db_connection["status"]=false;
				error_log("bd.php - db_connect(): Error in DB conection.");
			}
			db_choose($manejador);
			return $manejador;
		} else {
			$db_connection["status"]=false;
			$error = "bd.php - db_connect(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$db_selected = mysqli_select_db($manejador,$conf['bd']);
			if (!$db_selected) {
				$db_connection["status"]=false;
				error_log("bd.php - db_choose(): Error when choosing table.");
			}
		} else {
			$db_connection["status"]=false;
			$error = "bd.php - db_choose(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$result = mysqli_query($manejador,$query);
			if(!$result) {
				error_log("bd.php - db_exec(): The consult was not run. ".$query);
			}
			return $result;
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$result = mysqli_query($manejador,$query);
			if(!$result) {
				error_log("bd.php - db_query(): The consult was not run. ".$query);
			}
			return $result;
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$array = mysqli_fetch_array($result,$type);
			return $array;
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$num = mysqli_num_rows($result);
			return $num;
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			$res = mysqli_result($result,0,$field);
			return $res;
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
			error_log($error);
		}
	}

	/*
	 * Funcion que devuelve el ultimo id que se ha insertado
	 * Parametros:
	 * Salidas:
	 */
	function db_last_id() {
		global $conf;
		global $manejador;

		if($conf['bdtype'] == "mysql") {
			if($id = mysqli_insert_id($manejador)) {
				return $id;
			} else {
				error_log("bd.php - db_last_id(): Error when recovering last inserted id.");
			}
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysql_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			return mysqli_real_escape_string($manejador,addslashes($field));
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysqli_error();
			error_log($error);
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
		global $db_connection;

		if($conf['bdtype'] == "mysql") {
			if(!mysqli_close($manejador)) {
				error_log("bd.php - db_close(): Error when closing conection with BD.");
			}
		} else {
			$error = "bd.php - db_secure_field(): Data base type was not found. ".mysqli_error();
			error_log($error);
		}
	}


?>
