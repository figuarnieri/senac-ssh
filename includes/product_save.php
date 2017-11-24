<?php
require_once 'connect.php';
$product_id = isset($_POST['id']) ? $_POST['id'] : '';
$product_nome = utf8_decode($_POST['Nome']);
$product_descricao = utf8_decode($_POST['Descricao']);
$product_estoque = intval($_POST['Estoque']);
$product_preco = str_replace(',', '.', str_replace('.', '', $_POST['Preco']));
$product_desconto = str_replace(',', '.', str_replace('.', '', $_POST['Desconto']));
$product_categoria = intval($_POST['Categoria']);
$product_status = $_POST['Status'];
$product_imagem_file = !empty($_FILES['Imagem']) ? $_FILES['Imagem'] : false;
$user_id = intval($_POST['idUser']);

if($product_imagem_file['size']){
	$product_imagem_open = fopen($product_imagem_file['tmp_name'], "r");
	$product_imagem = fread($product_imagem_open, filesize($product_imagem_file['tmp_name']));
} else {
	$product_imagem = '';
}

if(empty($product_id)){
	$product_sql = odbc_prepare($db, "
		INSERT INTO Produto(idUsuario, nomeProduto, descProduto, qtdMinEstoque, precProduto, descontoPromocao, idCategoria, ativoProduto, imagem)
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)"
	);
	odbc_execute($product_sql, array($user_id, $product_nome, $product_descricao, $product_estoque, $product_preco, $product_desconto, $product_categoria, $product_status, $product_imagem));
	header("Location: ../product_list.php?save=1");
	exit();
} else {

	if($product_imagem_file['size']){
		$product_img = odbc_prepare($db, "
			UPDATE Produto
			SET imagem = ?
			WHERE idProduto = ?"
		);
		odbc_execute($product_img, array($product_imagem, $product_id));
		$error = preg_replace('/.+\]/' , '', odbc_errormsg($db));
		print_r($error);
		if($error){
			header("Location: ../product.php?edit=$product_id&error=$error");
			exit();
		}
	} else {
		$product_sql = odbc_prepare($db, "
			UPDATE Produto
			SET idUsuario = ?, nomeProduto = ?, descProduto = ?, qtdMinEstoque = ?, precProduto = ?, descontoPromocao = ?, idCategoria = ?, ativoProduto = ?
			WHERE idProduto = ?"
		);
		odbc_execute($product_sql, array($user_id, $product_nome, $product_descricao, $product_estoque, $product_preco, $product_desconto, $product_categoria, $product_status, $product_id));
	}
	header("Location: ../product.php?edit=$product_id&save=1");
	exit();

}
?>