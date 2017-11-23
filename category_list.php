<?php include_once 'includes/header.php';
$category_sql = odbc_exec($db, '
	SELECT idCategoria, nomeCategoria
	FROM Categoria
	ORDER BY idCategoria DESC
');
?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">

<main class="main list wrap cf d-b">
	<div class="pc-col-20 t-col-20 cf va-m">
		<span class="breadcrumb fa fa-table">Categoria / Listagem</span><span class="button-breadcrumb-wrap"><a href="category.php" class="button button-breadcrumb">Cadastrar</a></span>
	</div>
	<?php if(isset($_GET['error'])){ ?>
		<div class="pc-col-20 t-col-20">
			<div class="cf va-m list--error">
				<div class="pc-col-16 -pc-col-2"><div class="login--alert ta-c"><?php echo $_GET['error']; ?></div></div>
			</div>
		</div>
	<?php } ?>
	<div class="pc-col-20 t-col-20">
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
					<div class="list--pagebox"><input type="search" class="list--input d-b" placeholder="Filtrar Categoria" data-search-filter></div>
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
						<td t-pseudo-before="Categoria: " class="t-d-b"><?php echo utf8_encode($category['nomeCategoria'])?></td>
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