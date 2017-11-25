<?php
include_once 'includes/header.php';
$categoryDelete = isset($_GET['category_error']) ? $_GET['category_error'] : false;
if($categoryDelete){
	$category = utf8_encode( odbc_fetch_array( odbc_exec($db, "SELECT nomeCategoria FROM Categoria WHERE idCategoria=$categoryDelete") )['nomeCategoria'] );
	$error = "";
	$sql_where = "WHERE idCategoria=$categoryDelete ORDER BY idProduto DESC";
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
	<?php if($categoryDelete){ ?>
		<div class="pc-col-20 t-col-20 cf va-m">
			<span class="breadcrumb fa fa-users">Categoria / Listagem / <?php echo $category; ?></span><span class="button-breadcrumb-wrap"><a href="category_list.php" class="button button-breadcrumb">voltar</a></span>
		</div>
	<?php } else { ?>
		<div class="pc-col-20 t-col-20 cf va-m">
			<span class="breadcrumb fa fa-shopping-bag">Produto / Listagem</span><span class="button-breadcrumb-wrap"><a href="product.php" class="button button-breadcrumb">Cadastrar</a></span>
		</div>
	<?php } ?>

	<?php if($categoryDelete){ ?>
		<div class="pc-col-20 list--error">
			<div class="pc-col-20 t-col-20"><div class="login--alert login--alert-fixed ta-c">Para deleter a categoria <strong><?php echo $category; ?></strong>, remova os produtos abaixo desta categoria.</div></div>
		</div>
	<?php } ?>

	<?php if(isset($_GET['error'])){ ?>
		<div class="pc-col-20 t-col-20">
			<div class="cf va-m list--error">
				<div class="pc-col-20 t-col-20"><div class="login--alert ta-c"><?php echo $_GET['error']; ?></div></div>
			</div>
		</div>
	<?php } ?>
	<?php if(isset($_GET['delete'])){ ?>
		<div class="pc-col-20 t-col-20">
			<div class="cf va-m list--error">
				<div class="pc-col-20 t-col-20"><div class="login--alert ta-c">Item deletado com sucesso</div></div>
			</div>
		</div>
	<?php } ?>
	<?php if(isset($_GET['save'])){ ?>
		<div class="pc-col-20 t-col-20">
			<div class="cf va-m list--error">
				<div class="pc-col-20 t-col-20"><div class="login--alert login--alert-success ta-c">Produto cadastrado com sucesso!</div></div>
			</div>
		</div>
	<?php } ?>

	<div class="pc-col-20">
		<div class="list--content">
			<div class="list--pages ta-r">
				<div class="list--pagelist">
					<div class="list--pagebox"><input type="search" class="list--input d-b" placeholder="Filtrar Nome ou Preço" data-search-filter></div>
				</div>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr class="t-d-n">
					<th class="ta-l">Nome</th>
					<th class="ta-c">Imagem</th>
					<th class="ta-l">Preço</th>
					<th class="ta-c">Status</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<? while($product = odbc_fetch_array($product_sql)){ ?>
					<tr>
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
							<a class="fa fa-pencil d-ib" href="product.php?edit=<?php echo $product['idProduto']?>" data-tipfy="Editar"></a>
							<a class="fa fa-trash d-ib" href="includes/product_delete.php?id=<?php echo $product['idProduto']?>" data-tipfy="Deletar"></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>
<?php include_once 'includes/footer.php'; ?>