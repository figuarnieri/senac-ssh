<?php
require_once 'connect.php';
$product_id = isset($_POST['id']) ? $_POST['id'] : '';
$product_nome = utf8_decode($_POST['Nome']);
$product_descricao = utf8_decode($_POST['Descricao']);
$product_estoque = $_POST['Estoque'];
$product_preco = str_replace(',', '.', str_replace('.', '', $_POST['Preco']));
$product_desconto = str_replace(',', '.', str_replace('.', '', $_POST['Desconto']));
$product_categoria = $_POST['Categoria'];
$product_status = $_POST['Status'];
$product_imagem_file = isset($_FILES['Imagem']) ? $_FILES['Imagem'] : false;
if($product_imagem_file){
	$product_imagem_open = fopen($product_imagem_file['tmp_name'], "r");
	$product_imagem = fread($product_imagem_open, filesize($product_imagem_file['tmp_name']));
} else {
	$product_imagem = '';
}
print_r($product_preco);print_r('<br>');
if(empty($product_id)){

	$product_sql = odbc_prepare($db, "
		INSERT INTO Produto(nomeProduto, descProduto, qtdMinEstoque, precProduto, descontoPromocao, idCategoria, ativoProduto, imagem)
		VALUES(?, ?, ?, ?, ?, ?, ?, ?)"
	);
	odbc_execute($product_sql, array($product_nome, $product_descricao, $product_estoque, $product_preco, $product_desconto, $product_categoria, $product_status, $product_imagem));

} else {

	$product_sql = odbc_prepare($db, "
		UPDATE Produto
		SET nomeProduto = ?, descProduto = ?, qtdMinEstoque = ?, precProduto = ?, descontoPromocao = ?, idCategoria = ?, ativoProduto = ?, imagem = ?
		WHERE idProduto = ?"
	);
	odbc_execute($product_sql, array($product_nome, $product_descricao, $product_estoque, $product_preco, $product_desconto, $product_categoria, $product_status, $product_imagem, $product_id));

}

header(empty($product_redirect) ? "Location: ../product_list.php" : "Location: ../$product_redirect");
?>