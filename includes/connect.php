<?php
$db_host = "figuarnieri.database.windows.net";
$db_name = "figuarnieri_pi";
$db_user = "figuarnieri";
$db_pass = "Fi@123!456";
$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";
if(!$db = odbc_connect($dsn, $db_user, $db_pass)){
    die("ERRO AO CONECTAR AO BANCO DE DADOS");
}
?>