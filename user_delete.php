<?php
session_start();
require_once 'connect.php';

$user_id = $_GET['id'];
$user_delete = $_GET['delete'];

$user_sql = odbc_prepare($db, "
	DELETE FROM Usuario
	WHERE idUsuario = ?"
);
odbc_execute($user_sql, array($user_id));

if(empty($user_delete)){
	header('Location: ../user_list.php');
} else {
	session_destroy();
	header('Location: ../');
}
?>