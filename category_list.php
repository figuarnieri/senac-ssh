<?php include_once 'includes/header.php';
$category_sql = odbc_exec($db, '
	SELECT idCategoria, nomeCategoria
	FROM Categoria
	ORDER BY idCategoria DESC
');
$user_admin = $app_user['tipoPerfil']==='A' ? true : false;
?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">

<main class="main list wrap cf d-b">
	<div class="pc-col-20 t-col-20 cf va-m">
		<span class="breadcrumb fa fa-table">Categoria / Listagem</span>
		<?php if($user_admin){ ?>
			<span class="button-breadcrumb-wrap"><a href="category.php" class="button button-breadcrumb">Cadastrar</a></span>
		<?php } ?>
	</div>
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
				<div class="pc-col-20 t-col-20"><div class="login--alert login--alert-success ta-c">Categoria cadastrada com sucesso!</div></div>
			</div>
		</div>
	<?php } ?>
	<div class="pc-col-20 t-col-20">
		<div class="list--content">
			<div class="list--pages ta-r">
				<div class="list--pagelist">
					<div class="list--pagebox"><input type="search" class="list--input d-b" placeholder="Filtrar Categoria" data-search-filter></div>
				</div>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr class="t-d-n">
					<th class="ta-l">Nome</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<?php while($category = odbc_fetch_array($category_sql)){ ?>
					<tr>
						<td t-pseudo-before="Categoria: " class="t-d-b"><?php echo utf8_encode($category['nomeCategoria'])?></td>
						<td class="ta-c t-d-b list--icons">
							<a class="fa fa-pencil d-ib" href="category.php?edit=<?php echo $category['idCategoria']?>" data-tipfy="Editar"></a>
							<a class="fa fa-trash d-ib" href="includes/category_delete.php?id=<?php echo $category['idCategoria']?>" data-tipfy="Deletar" data-confirm></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>
<?php include_once 'includes/footer.php'; ?>