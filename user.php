<?php
include_once 'includes/header.php';
$user_edit = isset($_GET['edit']) && !empty($_GET['edit']) && ($_GET['edit']!=='1') ? true : false;
if($user_edit){
	$user_sql = odbc_exec($db, '
		SELECT *
		FROM Usuario
		WHERE idUsuario = '.$_GET['edit']
	);
	$user = odbc_fetch_array($user_sql);
}
$app_user = odbc_exec($db, "
    SELECT idUsuario
    FROM Usuario
    WHERE idUsuario = ".$_SESSION['userId']
);

?>
<link rel="stylesheet" href="dist/css/theme/pages/form.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">

<main class="main form wrap cf d-b">
	<div class="pc-col-20 t-col-20 cf d-b">
		<span class="breadcrumb fl-l fa fa-users">Usuários / <?php echo $user_edit ? 'Editar' : 'Cadastrar' ?></span>
		<div class="fl-r cf va-m">
			<a href="javascript: history.back();" class="button button-small button-back">Voltar</a>
			<?php if($user_edit){ ?>
				<a href="includes/user_delete.php?id=<?php echo $_GET['edit']; ?>" class="fa fa-trash ta-c"></a>
			<?php } ?>
		</div>
	</div>

	<form class="pc-col-20 t-col-20" action="includes/user_save.php" method="post">
		<?php if($user_edit){ ?>
			<input type="hidden" name="id" value="<?php echo $user['idUsuario']?>">
		<?php } ?>
		<div class="form--box">
			<?php if(isset($_GET['error'])){ ?>
				<div class="pc-col-20 t-col-20">
					<div class="cf va-m list--error">
						<div class="pc-col-17 -pc-col-3"><div class="login--alert ta-c"><?php echo $_GET['error']; ?></div></div>
					</div>
				</div>
			<?php } ?>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Nome">Nome</label></div>
				<div class="pc-col-17 t-col-20"><input class="form--input" type="text" name="Nome" id="Nome" required="" value="<?php echo $user_edit ? utf8_encode($user['nomeUsuario']) : ''?>" maxlength="50"></div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Login">Login</label></div>
				<div class="pc-col-17 t-col-20"><input class="form--input" type="email" name="Login" id="Login" required="" value="<?php echo $user_edit ? utf8_encode($user['loginUsuario']) : ''?>" maxlength="100"></div>
			</div>
			<?php if(!$user_edit){ ?>
				<div class="cf va-m">
					<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Senha">Senha</label></div>
					<div class="pc-col-17 t-col-20"><input class="form--input" type="password" name="Senha" id="Senha" maxlength="64"></div>
				</div>
			<?php } ?>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Perfil">Perfil</label></div>
				<div class="pc-col-17 t-col-20">
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
						<?php if(odbc_fetch_array($app_user)['idUsuario']==="1"){ ?>
							<option value="M" <?php echo $user_edit && $user['tipoPerfil']==='M' ? 'selected' : ''?>>Master</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Status">Status</label></div>
				<div class="pc-col-17 t-col-20">
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
					<div class="cf va-m form--input-last">
						<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Senha">Nova Senha</label></div>
						<div class="pc-col-6"><input class="form--input" type="password" name="Senha" id="Senha" maxlength="64"></div>
					</div>
				</div>
				<div class="cf va-m">
					<div class="-pc-col-3 pc-col-17 t-col-20">
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

<?php include_once 'includes/footer.php'; ?>
