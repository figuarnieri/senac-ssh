<?php
include_once 'includes/header.php';
$categoryDelete = isset($_GET['category_id']) && isset($_GET['products']);
if($categoryDelete){
	$categoryId = $_GET['category_id'];
	$category = utf8_encode( odbc_fetch_array( odbc_exec($db, "SELECT nomeCategoria FROM Categoria WHERE idCategoria=$categoryId") )['nomeCategoria'] );
	$error = "Para deleter a categoria <strong>$category</strong>, remova os produtos abaixo desta categoria.";
	$sql_where = "WHERE idCategoria=$categoryId";
} else {
	$sql_where = 'ORDER BY idProduto DESC';
}
$product_sql = odbc_exec($db, '
	SELECT idProduto, nomeProduto, precProduto, ativoProduto, qtdMinEstoque, imagem
	FROM Produto
	'.$sql_where);
?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">

<main class="main list wrap">
	<div class="pc-col-20 t-col-20 cf va-m">
		<span class="breadcrumb fa fa-users">Produto / Listagem</span><span class="button-breadcrumb-wrap"><a href="product.php" class="button button-breadcrumb">Cadastrar</a></span>
	</div>
	<?php if($categoryDelete){ ?>
		<div class="pc-col-20 list--error">
			<div class="pc-col-16 -pc-col-2"><div class="login--alert login--alert-fixed ta-c"><?php echo $error; ?></div></div>
		</div>
	<?php } ?>
	<div class="pc-col-20">
		<div class="list--content">
			<div class="list--pages ta-r">
				<div class="fl-l list--tools d-n">
					<form action="" method="post">
						<select class="list--input" name="MultiChange" id="MultiChange" data-selectchange>
							<option value="">Alterar</option>
							<option value="Inativar">Inativar</option>
							<option value="Ativar">Ativar</option>
							<option value="Deletar">Deletar</option>
						</select>
					</form>
				</div>
				<div class="list--pagelist">
					<div class="list--pagebox"><input type="search" class="list--input d-b" placeholder="Filtrar Nome ou Preço" data-search-filter></div>
				</div>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr class="t-d-n">
					<th class="ta-c" width="50">
						<input type="checkbox" name="SelecioneTodos" id="SelecioneTodos" data-multichange="all">
						<label for="SelecioneTodos" class="fa fa-square-o"></label>
					</th>
					<th class="ta-l">Nome</th>
					<th class="ta-c">Imagem</th>
					<th class="ta-l">Preço</th>
					<th class="ta-c">Produto Ativo</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<? while($product = odbc_fetch_array($product_sql)){ ?>
					<tr>
						<td class="ta-c t-d-n">
							<input type="checkbox" name="multicheck[]" id="id<?php echo $product['idProduto']?>" value="<?php echo $product['idProduto']?>">
							<label for="id<?php echo $product['idProduto']?>" class="fa fa-square-o"></label>
						</td>
						<td t-pseudo-before="Produto: " class="t-d-b"><?php echo utf8_encode($product['nomeProduto'])?></td>
						<td class="t-d-n">
							<div class="list--img img-center">
								<?php if(empty(base64_encode($product['imagem']))){ ?>
									<i class="fa fa-shopping-bag"></i>
								<?php } else { ?>
									<img width="100%" height="auto" class="" src="data:image/jpeg;base64,<?php echo base64_encode($product['imagem']) ?>" />
								<?php } ?>
							</div>
						</td>
						<td t-pseudo-before="Preço: " class="t-d-b">R$ <?php echo number_format($product['precProduto'], 2, "," , ".")?></td>
						<td t-pseudo-before="Status: <?php echo $product['ativoProduto'] ? 'Ativo' : 'Inativo'?> " class="ta-c t-d-b t-ta-l">
							<i class="fa <?php echo $product['ativoProduto'] ? 'fa-check-circle' : 'fa-times-circle'?>" data-user-status="<?php echo $product['ativoProduto']?>" data-tipfy="<?php echo $product['ativoProduto'] ? 'Ativo' : 'Inativo'?>" data-tipfy-side="left"></i>
						</td>
						<td class="ta-c t-d-b list--icons">
							<a class="fa fa-pencil d-ib" href="product.php?edit=<?php echo $product['idProduto']?>"></a>
							<a class="fa fa-trash d-ib" href="includes/product_delete.php?id=<?php echo $product['idProduto']?>"></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>
<?php include_once 'includes/footer.php'; ?>