<?php include_once 'includes/header.php'; ?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">

<main class="main list wrap cf">
	<div class="pc-col-20">
		<span class="breadcrumb fl-l fa fa-list">Categoria / Listagem</span><span class="fl-l"><a href="category.php" class="button button-breadcrumb">Cadastrar</a></span>
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
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<?php
				$category_sql = odbc_exec($db, '
					SELECT *
					FROM Categoria
				');
				while($category = odbc_fetch_array($category_sql)){ ?>
					<tr>
						<td class="ta-c"><input type="checkbox" name="id<?php echo $category['idCategoria']?>"></td>
						<td><?php echo utf8_encode($category['nomeCategoria'])?></td>
						<td class="ta-c">
							<a class="fa fa-pencil d-ib" href="category.php?edit=<?php echo $category['idCategoria']?>"></a>
							<a class="fa fa-trash d-ib" href="includes/category_delete.php?id=<?php echo $category['idCategoria']?>"></a>
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
</script>
<?php include_once 'includes/footer.php'; ?>