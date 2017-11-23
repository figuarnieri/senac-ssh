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
	header('Location: ../product_list.php?&category_id='.$category_id);
} else {

}

exit();


odbc_execute($category_sql, array($category_id));

header('Location: ../category_list.php');
?>