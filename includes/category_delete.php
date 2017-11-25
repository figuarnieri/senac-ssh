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

odbc_execute($category_sql, array($category_id));

if(odbc_fetch_row($product)){
	header("Location: ../product_list.php?&category_error=$category_id");
} else {
	header("Location: ../category_list.php?delete=1");
}
exit();
?>