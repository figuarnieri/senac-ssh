<?php include_once 'includes/header.php';

$search = $_GET['Search'];
$product_sql = odbc_prepare($db, "
	SELECT idProduto, nomeProduto, precProduto, ativoProduto, qtdMinEstoque, imagem
	FROM Produto
	WHERE nomeProduto LIKE ?");

?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">

<main class="main list wrap cf">
	<div class="pc-col-20">
		<span class="breadcrumb fl-l fa fa-search">Busca / <strong><?php echo $search?></strong></span>
		<div class="fl-r"><?php if(odbc_execute($product_sql, array('%'.$search.'%'))){ echo 'Resultados: '.odbc_num_rows($product_sql); }?></div>
	</div>

	<div class="pc-col-20">
		<div class="list--content">
			<div class="list--pages ta-r">
				<div class="list--pagelist">
					<div class="list--pagebox"><input type="search" class="list--input d-b" placeholder="Filtrar Listagem"></div>
				</div>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr>
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
			<?php
			
			if(odbc_execute($product_sql, array('%'.$search.'%'))){
				while($product = odbc_fetch_array($product_sql)){
					?>
					<tr>
						<td class="ta-c">
							<input type="checkbox" name="multicheck[]" id="id<?php echo $product['idProduto']?>" value="<?php echo $product['idProduto']?>">
							<label for="id<?php echo $product['idProduto']?>" class="fa fa-square-o"></label>
						</td>
						<td><?php echo utf8_encode($product['nomeProduto'])?></td>
						<td>
							<div class="list--img img-center">
								<?php if(empty(base64_encode($product['imagem']))){ ?>
									<i class="fa fa-shopping-bag"></i>
								<?php } else { ?>
									<img width="100%" height="auto" class="" src="data:image/jpeg;base64,<?php echo base64_encode($product['imagem']) ?>" />
								<?php } ?>
							</div>
						</td>
						<td>R$ <?php echo number_format($product['precProduto'], 2, "," , ".")?></td>
						<td class="ta-c">
							<i class="fa <?php echo $product['ativoProduto'] ? 'fa-check-circle' : 'fa-times-circle'?>" data-user-status="<?php echo $product['ativoProduto']?>" data-tipfy="<?php echo $product['ativoProduto'] ? 'Ativo' : 'Inativo'?>" data-tipfy-side="left"></i>
						</td>
						<td class="ta-c">
							<a class="fa fa-pencil d-ib" href="product.php?edit=<?php echo $product['idProduto']?>"></a>
							<a class="fa fa-trash d-ib" href="includes/product_delete.php?id=<?php echo $product['idProduto']?>"></a>
						</td>
					</tr>
				<?php } ?>
			<?php } ?>


			</table>
		</div>
	</div>
</main>
<?php include_once 'includes/footer.php'; ?>