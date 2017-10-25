<?php
require_once 'connect.php';

$category_id = $_GET['id'];

$category_sql = odbc_prepare($db, "
	DELETE FROM Categoria
	WHERE idCategoria = ?"
);
odbc_execute($category_sql, array($category_id));

header('Location: ../category_list.php');
?>