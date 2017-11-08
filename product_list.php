<?php include_once 'includes/header.php'; ?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">

<main class="main list wrap cf">
	<div class="pc-col-20">
		<span class="breadcrumb fl-l fa fa-shopping-bag">Produto / Listagem</span><span class="fl-l"><a href="product.php" class="button button-breadcrumb">Cadastrar</a></span>
	</div>
	<div class="pc-col-20">
		<div class="list--content">
			<div class="list--pages ta-r">
				<ul class="list--pagelist">
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b"><i class="fa fa-chevron-left"></i></a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">1</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">2</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">3</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">4</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">5</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b"><i class="fa fa-chevron-right"></i></a></li>
				</ul>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr>
					<th class="ta-c"><input type="checkbox" name="SelecioneTodos" id="SelecioneTodos"></th>
					<th class="ta-l">Nome</th>
					<th class="ta-c">Imagem</th>
					<th class="ta-l">Preço</th>
					<th class="ta-c">Desconto</th>
					<th class="ta-c">Estoque</th>
					<th class="ta-c">Produto Ativo</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
			<?php
			$product_sql = odbc_exec($db, '
				SELECT idProduto, nomeProduto, precProduto, descontoPromocao, idCategoria, ativoProduto, qtdMinEstoque, imagem
				FROM Produto
			');
			while($product = odbc_fetch_array($product_sql)){ ?>
				<tr>
					<td class="ta-c"><input type="checkbox" name="id<?php echo $product['idProduto']?>"></td>
					<td><?php echo utf8_encode($product['nomeProduto'])?></td>
					<td>
						<div class="list--img">
							<img width="100%" height="auto" class="img-responsive" src="data:image/jpeg;base64,<?php echo base64_encode($product['imagem']) ?>" />
						</div>
					</td>
					<td>R$ <?php echo number_format($product['precProduto'], 2, "," , ".")?></td>
					<td class="ta-c">R$ <?php echo number_format($product['descontoPromocao'], 2, "," , ".") ?></td>
					<td class="ta-c"><?php echo $product['qtdMinEstoque'] ?></td>
					<td class="ta-c">
						<i class="fa <?php echo $product['ativoProduto'] ? 'fa-check-circle' : 'fa-times-circle'?>" data-user-status="<?php echo $product['ativoProduto']?>" data-tipfy="<?php echo $product['ativoProduto'] ? 'Ativo' : 'Inativo'?>" data-tipfy-side="left"></i>
					</td>
					<td class="ta-c">
						<a class="fa fa-pencil d-ib" href="product.php?edit=<?php echo $product['idProduto']?>"></a>
						<a class="fa fa-trash d-ib" href="includes/product_delete.php?id=<?php echo $product['idProduto']?>"></a>
					</td>
				</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</main>
<script>
	$('[data-passchange]').click(function(e){
		$(this).closest('.cf').slideUp(400).prev().slideDown(400);
	});

	$('[data-multichange="all"]').change(function(e){
		if($(this).is(':checked')){
			$('.list--table td [type="checkbox"]').each(function(f,g){
				if(!$(g).is(':checked')){
					$(g).trigger('click');
				}
			});
		} else {
			$('.list--table td [type="checkbox"]').each(function(f,g){
				if($(g).is(':checked')){
					$(g).trigger('click');
				}
			});
		}
	});
	$('.list--table td [type="checkbox"]').change(function(e){
		if($('.list--table td [type="checkbox"]:not(:checked)').length === $('.list--table td [type="checkbox"]').length){
			$('.list--tools').slideUp(200);
		} else {
			$('.list--tools').slideDown(200);
		}
	});
	$('[data-selectchange]').change(function(e) {
		$(this).closest('form').trigger('submit');
	});
	new Tipfy('[data-tipfy]');
	$('[data-user-status]').click(function(e){
		if($(this).hasClass('fa-check-circle')){
			$(this).removeClass('fa-check-circle').addClass('fa-times-circle').attr({'data-tipfy':'Inativo'});
		} else {
			$(this).addClass('fa-check-circle').removeClass('fa-times-circle').attr({'data-tipfy':'Ativo'});
		}
		$('.tipfy--wrap').remove();
	});
</script>
<?php include_once 'includes/footer.php'; ?>