<?php
require_once 'connect.php';

$category_id = $_POST['id'];
$category_nome = utf8_decode($_POST['Nome']);
$category_descript = utf8_decode($_POST['Descricao']);

if(empty($category_id)){

	$category_sql = odbc_prepare($db, "
		INSERT INTO Categoria(nomeCategoria, descCategoria)
		VALUES(?, ?)"
	);
	odbc_execute($category_sql, array("$category_nome", "$category_descript"));

} else {

	$category_sql = odbc_prepare($db, "
		UPDATE Categoria
		SET nomeCategoria = '$category_nome', descCategoria = '$category_descript'
		WHERE idCategoria = ?"
	);
	odbc_execute($category_sql, array($category_id));

}
header('Location: ../category_list.php');
?>