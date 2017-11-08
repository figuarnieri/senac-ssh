<?php
include_once 'includes/header.php';
$product_edit = isset($_GET['edit']) && !empty($_GET['edit']) ? true : false;
if($product_edit){
	$product_sql = odbc_exec($db, '
		SELECT idProduto, nomeProduto, descProduto, precProduto, descontoPromocao, idCategoria, ativoProduto, qtdMinEstoque, imagem
		FROM Produto
		WHERE idProduto = '.$_GET['edit']);
		$product = odbc_fetch_array($product_sql);
};

$category_sql = odbc_exec($db, '
	SELECT idCategoria, nomeCategoria
	FROM Categoria');
?>
<link rel="stylesheet" href="dist/css/theme/pages/form.min.css">

<main class="main form wrap cf">
	<div class="pc-col-20">
		<span class="breadcrumb fl-l fa fa-list">Produto / <?php echo $product_edit ? 'Editar' : 'Cadastro' ?></span>
		<span class="fl-l">
			<a href="product_list.php" class="button button-breadcrumb">Listagem</a>
		</span>
		<?php if($product_edit){ ?>
			<a href="includes/product_delete.php?id=<?php echo $_GET['edit']; ?>" class="fa fa-trash fl-r ta-c"></a>
		<?php } ?>
	</div>
	<form class="pc-col-20" action="includes/product_save.php" method="post" enctype="multipart/form-data">
		<?php if($product_edit){ ?>
			<input type="hidden" name="id" value="<?php echo $product['idProduto']?>">
		<?php } ?>
		<div class="form--box">
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Nome">Nome</label></div>
				<div class="pc-col-16"><input class="form--input" type="text" name="Nome" id="Nome" required="" value="<?php echo $product_edit ? utf8_encode($product['nomeProduto']) : ''?>"></div>
			</div>
			<div class="cf va-t">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Descricao">Descrição</label></div>
				<div class="pc-col-16"><textarea class="form--input" type="text" name="Descricao" id="Descricao"><?php echo $product_edit ? utf8_encode($product['descProduto']) : ''?></textarea></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Estoque">Estoque</label></div>
				<div class="pc-col-4"><input class="form--input" type="number" name="Estoque" id="Estoque" value="<?php echo $product_edit ? $product['qtdMinEstoque'] : ''?>" required=""></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Preco">Preço</label></div>
				<div class="pc-col-4"><input class="form--input" type="text" name="Preco" id="Preco" value="<?php echo ($product_edit) ? number_format($product['precProduto'], 2, "," , ".") : '' ?>" required="" data-mask="999.999.999.999,99" data-mask-reverse></div>
				<div class="pc-col-4 ta-r"><label class="form--label" for="Desconto">Desconto</label></div>
				<div class="pc-col-4"><input class="form--input" type="text" name="Desconto" id="Desconto" value="<?php echo ($product_edit) ? number_format($product['descontoPromocao'], 2, "," , ".") : '' ?>" required="" data-mask="999.999.999.999,99" data-mask-reverse></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Categoria">Categoria</label></div>
				<div class="pc-col-16">
					<select class="form--input" name="Categoria" id="Categoria" required="">
						<option value="">Selecione</option>
						<?php while ($category = odbc_fetch_array($category_sql)) { ?>
							<option value="<?php echo $category['idCategoria']; ?>" <?php echo $product_edit && $category['idCategoria']===$category['idCategoria'] ? 'selected' : ''?>><?php echo utf8_encode($category['nomeCategoria']); ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Status">Status</label></div>
				<div class="pc-col-16">
					<select class="form--input" name="Status" id="Status" required="">
						<?php
						$item = array(
							"1" => "Ativo",
							"0" => "Inativo",
						);
						foreach ($item as $key => $value) { ?>
							<option value="<?php echo $key; ?>" <?php echo $product_edit && $product['ativoProduto']==$key ? 'selected' : ''?>><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="cf va-t">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Imagem">Imagem</label></div>
				<div class="pc-col-4">
					<?php if($product_edit) { ?>
						<?php if(empty(base64_encode($product['imagem']))){ ?>
							<label class="form--thumb form--thumb-empty fa fa-shopping-bag d-ib ta-c" for="Imagem">
								<input type="file" name="Imagem" id="Imagem" accept="image/*">
							</label>
						<?php } else { ?>
							<label class="form--thumb d-ib ta-c" for="Imagem">
								<img width="100%" height="auto" class="img-responsive" src="data:image/jpeg;base64,<?php echo base64_encode($product['imagem']) ?>" />
								<input type="file" name="Imagem" id="Imagem" accept="image/*">
							</label>
						<?php } ?>
					<?php } else { ?>
						<label class="form--thumb form--thumb-empty fa fa-camera d-ib ta-c" for="Imagem">
							<input type="file" name="Imagem" id="Imagem" accept="image/*">
						</label>
					<?php } ?>
				</div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-20 ta-r">
					<button class="button" type="submit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</main>

<?php include_once 'includes/footer.php'; ?>