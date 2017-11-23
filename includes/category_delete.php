<?php
require_once 'connect.php';

$category_id = $_GET['id'];
$category_sql = odbc_prepare($db, "
	DELETE FROM Categoria
	WHERE idCategoria = ?"
);

$product = odbc_exec($db, "
	SELECT idProduto FROM Produto
	WHERE idCategoria = $category_id"
);

if(odbc_fetch_row($product)){
	header('Location: ../category_list.php?error=1');
	exit();
	print_r(array_values($num));
} else {

}

exit();


odbc_execute($category_sql, array($category_id));

header('Location: ../category_list.php');
?>