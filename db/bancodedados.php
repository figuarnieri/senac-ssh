<?php
	// Banco Interno
	/*$db_host = "kanino.database.windows.net";
	$db_name = "kaninos";
	$db_user = "db_danlucindo";
	$db_pass = "#Db_1533";
	$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

	if(!$db = odbc_connect($dsn, $db_user, $db_pass)){

		echo "ERRO AO CONECTAR AO BANCO DE DADOS";
		exit();
	}*/

	// Banco Senac
	$db_host = "kanino-pi.database.windows.net";
	$db_name = "Kanino";
	$db_user = "TSI";
	$db_pass = "SistemasInternet123";
	$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

	if(!$db = odbc_connect($dsn, $db_user, $db_pass)){

		echo "ERRO AO CONECTAR AO BANCO DE DADOS";
		exit();
	}
?>