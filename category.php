<?php
include_once 'includes/header.php';
$category_edit = isset($_GET['edit']) && !empty($_GET['edit']) ? true : false;
if($category_edit){
	$category_sql = odbc_exec($db, '
		SELECT *
		FROM Categoria
		WHERE idCategoria = '.$_GET['edit']);
		$user = odbc_fetch_array($category_sql);
		//print_r($user);
}
?>
<link rel="stylesheet" href="dist/css/theme/pages/form.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">

<main class="main form wrap cf d-b">
	<div class="pc-col-20 t-col-20 cf d-b">
		<span class="breadcrumb fl-l fa fa-table">Categoria / <?php echo $category_edit ? 'Editar' : 'Cadastrar' ?></span>
		<div class="fl-r cf va-m">
			<a href="javascript: history.back();" class="button button-small button-back">Voltar</a>
			<?php if($category_edit){ ?>
				<a href="includes/category_delete.php?id=<?php echo $_GET['edit']; ?>" class="fa fa-trash ta-c"></a>
			<?php } ?>
		</div>
	</div>
	<form class="pc-col-20 t-col-20" action="includes/category_save.php" method="post">
		<?php if($category_edit){ ?>
			<input type="hidden" name="id" value="<?php echo $user['idCategoria']?>">
		<?php } ?>
		<div class="form--box">
			<?php if(isset($_GET['save'])){ ?>
				<div class="pc-col-20 t-col-20">
					<div class="cf va-m list--error">
						<div class="pc-col-17 -pc-col-3"><div class="login--alert login--alert-success ta-c">Informações atualizadas com sucesso!</div></div>
					</div>
				</div>
			<?php } ?>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Nome">Nome</label></div>
				<div class="pc-col-17 t-col-20"><input class="form--input" type="text" name="Nome" id="Nome" required="" value="<?php echo $category_edit ? utf8_encode($user['nomeCategoria']) : ''?>" maxlength="50"></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Descricao">Descrição</label></div>
				<div class="pc-col-17 t-col-20"><input class="form--input" type="text" name="Descricao" id="Descricao" value="<?php echo $category_edit ? utf8_encode($user['descCategoria']) : ''?>" maxlength="100"></div>
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
