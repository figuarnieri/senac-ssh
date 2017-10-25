<?php
include_once 'includes/header.php';
$user_edit = isset($_GET['edit']) && !empty($_GET['edit']) ? true : false;
if($user_edit){
	$user_sql = odbc_exec($db, '
		SELECT *
		FROM Usuario
		WHERE idUsuario = '.$_GET['edit']);
		$user = odbc_fetch_array($user_sql);
		print_r($user);
}
?>
<link rel="stylesheet" href="dist/css/theme/pages/form.min.css">

<main class="main form wrap cf">
	<div class="pc-col-20">
		<span class="breadcrumb fl-l fa fa-user-circle">Usuários / <?php echo $user_edit ? 'Editar' : 'Cadastro' ?></span>
		<?php if($user_edit){ ?>
			<a href="includes/user_delete.php?id=<?php echo $_GET['edit']; ?>" class="fa fa-trash fl-r ta-c"></a>
		<?php } ?>
	</div>
	<form class="pc-col-20" action="includes/user_save.php" method="post">
		<?php if($user_edit){ ?>
			<input type="hidden" name="id" value="<?php echo $user['idUsuario']?>">
		<?php } ?>
		<div class="form--box">
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Nome">Nome</label></div>
				<div class="pc-col-16"><input class="form--input" type="text" name="Nome" id="Nome" required="" value="<?php echo $user_edit ? $user['nomeUsuario'] : ''?>"></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Login">Login</label></div>
				<div class="pc-col-16"><input class="form--input" type="email" name="Login" id="Login" required="" value="<?php echo $user_edit ? $user['loginUsuario'] : ''?>"></div>
			</div>
			<?php if(!$user_edit){ ?>
				<div class="cf va-m">
					<div class="pc-col-4 ta-r"><label class="form--label" for="Senha">Senha</label></div>
					<div class="pc-col-16"><input class="form--input" type="password" name="Senha" id="Senha"></div>
				</div>
			<?php } ?>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Perfil">Perfil</label></div>
				<div class="pc-col-16">
					<select class="form--input" type="text" name="Perfil" id="Perfil">
						<option value="">Selecione</option>
						<?php
						$item = array(
							"A" => "Administrador",
							"E" => "Editor",
						);
						foreach ($item as $key => $value) { ?>
							<option value="<?php echo $key; ?>" <?php echo $user_edit && $user['tipoPerfil']===$key ? 'selected' : ''?>><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-4 ta-r"><label class="form--label" for="Status">Status</label></div>
				<div class="pc-col-16">
					<select class="form--input" type="text" name="Status" id="Status">
						<?php
						$item = array(
							"1" => "Ativo",
							"0" => "Inativo",
						);
						foreach ($item as $key => $value) { ?>
							<option value="<?php echo $key; ?>" <?php echo $user_edit && $user['usuarioAtivo']==$key ? 'selected' : ''?>><?php echo $value; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<?php if($user_edit){ ?>
				<div class="d-n">
					<div class="cf va-m">
						<div class="pc-col-4 ta-r"><label class="form--label" for="Senha">Nova Senha</label></div>
						<div class="pc-col-6"><input class="form--input" type="password" name="Senha" id="Senha"></div>
					</div>
				</div>
				<div class="cf va-m">
					<div class="-pc-col-4 pc-col-16">
						<a class="button button-small fa fa-key d-ib" href="#" data-passchange>Alterar Senha</a>
					</div>
				</div>
			<?php } ?>

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