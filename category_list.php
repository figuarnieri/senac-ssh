<?php include_once 'includes/header.php';
$category_sql = odbc_exec($db, '
	SELECT idCategoria, nomeCategoria
	FROM Categoria
	ORDER BY idCategoria DESC
');
?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">

<main class="main list wrap cf">
	<div class="pc-col-20 t-col-20">
		<span class="breadcrumb fl-l fa fa-list">Categoria / Listagem</span><span class="fl-l button-breadcrumb-wrap"><a href="category.php" class="button button-breadcrumb">Cadastrar</a></span>
	</div>
	<div class="pc-col-20">
		<?php if(isset($_GET['error'])){ ?>
			Você não pode deletera, por haver itens nesta categoria
		<?php } ?>
	</div>
	<div class="pc-col-20 t-col-20">
		<div class="list--content">
			<div class="list--pages ta-r">
				<div class="list--pagelist">
					<div class="list--pagebox"><input type="search" class="list--input d-b" placeholder="Filtrar Listagem"></div>
				</div>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr class="t-d-n">
					<th class="ta-c" width="50">
						<input type="checkbox" name="SelecioneTodos" id="SelecioneTodos" data-multichange="all">
						<label for="SelecioneTodos" class="fa fa-square-o"></label>
					</th>
					<th class="ta-l">Nome</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<?php while($category = odbc_fetch_array($category_sql)){ ?>
					<tr>
						<td class="ta-c t-d-n">
							<input type="checkbox" name="multicheck[]" id="id<?php echo $category['idCategoria']?>" value="<?php echo $category['idCategoria']?>">
							<label for="id<?php echo $category['idCategoria']?>" class="fa fa-square-o"></label>
						</td>
						<td t-pseudo-before="Nome: " class="t-d-b"><?php echo utf8_encode($category['nomeCategoria'])?></td>
						<td class="ta-c t-d-b list--icons">
							<a class="fa fa-pencil d-ib" href="category.php?edit=<?php echo $category['idCategoria']?>"></a>
							<a class="fa fa-trash d-ib" href="includes/category_delete.php?id=<?php echo $category['idCategoria']?>"></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>
<?php include_once 'includes/footer.php'; ?>