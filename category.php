<?php
include_once 'includes/header.php';
$category_edit = isset($_GET['edit']) && !empty($_GET['edit']) ? true : false;
if($category_edit){
	$category_sql = odbc_exec($db, '
		SELECT *
		FROM Categoria
		WHERE idCategoria = '.$_GET['edit']);
		$user = odbc_fetch_array($category_sql);
		print_r($user);
}
?>
<link rel="stylesheet" href="dist/css/theme/pages/form.min.css">

<main class="main form wrap cf">
	<div class="pc-col-20 t-col-20">
		<span class="breadcrumb fl-l fa fa-list">Categoria / <?php echo $category_edit ? 'Editar' : 'Cadastro' ?></span>
		<?php if($category_edit){ ?>
			<a href="includes/category_delete.php?id=<?php echo $_GET['edit']; ?>" class="fa fa-trash fl-r ta-c"></a>
		<?php } ?>
	</div>
	<form class="pc-col-20 t-col-20" action="includes/category_save.php" method="post">
		<?php if($category_edit){ ?>
			<input type="hidden" name="id" value="<?php echo $user['idCategoria']?>">
		<?php } ?>
		<div class="form--box">
			<div class="cf va-m">
				<div class="pc-col-4 ta-r t-col-20 t-ta-l"><label class="form--label" for="Nome">Nome</label></div>
				<div class="pc-col-16 t-col-20"><input class="form--input" type="text" name="Nome" id="Nome" required="" value="<?php echo $category_edit ? utf8_encode($user['nomeCategoria']) : ''?>"></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r t-col-20 t-ta-l"><label class="form--label" for="Descricao">Descrição</label></div>
				<div class="pc-col-16 t-col-20"><input class="form--input" type="text" name="Descricao" id="Descricao" value="<?php echo $category_edit ? utf8_encode($user['descCategoria']) : ''?>"></div>
			</div>
			
			<div class="cf va-m">
				<div class="pc-col-20 ta-r">
					<button class="button" type="submit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</main>
<script>
	$('[data-passchange]').click(function(e){
		$(this).closest('.cf').slideUp(400).prev().slideDown(400);
	});
</script>
<?php include_once 'includes/footer.php'; ?>