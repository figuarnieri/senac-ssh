<?php
session_start();
require_once 'connect.php';

$product_id = $_GET['id'];

$product_sql = odbc_prepare($db, "
	DELETE FROM Produto
	WHERE idProduto = ?"
);
odbc_execute($product_sql, array($product_id));

header("Location: ../product_list.php?delete=1");
exit();
?>