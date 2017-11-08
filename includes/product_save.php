<?php
require_once 'connect.php';

$product_id = $_POST['id'];
$product_nome = utf8_decode($_POST['Nome']);
$product_descricao = utf8_decode($_POST['Descricao']);
$product_estoque = $_POST['Estoque'];
$product_preco = $_POST['Preco'];
$product_desconto = $_POST['Desconto'];
$product_categoria = $_POST['Categoria'];
$product_status = $_POST['Status'];
$product_imagem_file = $_FILES['Imagem'];
$product_imagem_open = fopen($product_imagem_file['tmp_name'], "r");
$product_imagem = fread($product_imagem_open, filesize($product_imagem_file['tmp_name']));
	//exit();
?>

<?php

if(empty($product_id)){

	$product_sql = odbc_prepare($db, "
		INSERT INTO Produto(nomeProduto, descProduto, qtdMinEstoque, precProduto, descontoPromocao, idCategoria, ativoProduto, imagem)
		VALUES(?, ?, ?, ?, ?, ?, ?, ?)"
	);

	$param = array($product_nome, $product_descricao, $product_estoque, $product_preco, $product_desconto, $product_categoria, $product_status, $product_imagem);
	print_r($param);
	odbc_execute($product_sql, $param);

} else {

	$product_sql = odbc_prepare($db, "
		UPDATE Produto
		SET loginProduto = ?, nomeProduto = ?, tipoPerfil = ?, ProdutoAtivo = ?
		WHERE idProduto = ?"
	);
	odbc_execute($product_sql, array($product_login, $product_nome, $product_tipo, $product_ativo, $product_id));

	/*SQL APENAS PARA ATUALIZAR SENHA*/
	if(!empty($product_senha)){
		$product_sql_senha = odbc_prepare($db, "
			UPDATE Produto
			SET senhaProduto = '$product_senha'
			WHERE idProduto = ?"
		);
		odbc_execute($product_sql_senha, array($product_id));
	}

}

header(empty($product_redirect) ? "Location: ../product_list.php" : "Location: ../$product_redirect");
?>