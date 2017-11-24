<?php
include_once 'includes/header.php';
$tipoPerfil = array(
	"A" => "Administrador",
	"E" => "Editor",
);
$usuarioAtivo = array(
	"1" => "Ativo",
	"0" => "Inativo",
);
$user_edit = isset($_GET['edit']) && !empty($_GET['edit']) && ($_GET['edit']!=='1') ? true : false;
$user_admin = $app_user['tipoPerfil']==='A' ? true : false;
$user_perfil = $_GET['edit']===$app_user['idUsuario'] ? true : false;
if($user_edit){
	$user_sql = odbc_exec($db, '
		SELECT idUsuario, loginUsuario, senhaUsuario, nomeUsuario, tipoPerfil, usuarioAtivo
		FROM Usuario
		WHERE idUsuario = '.$_GET['edit']
	);
	$user = odbc_fetch_array($user_sql);
}
?>
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/form.min.css">

<main class="main form wrap cf d-b">
	<div class="pc-col-20 t-col-20 cf d-b">
		<?php if($user_perfil){ ?>
			<span class="breadcrumb fl-l fa fa-user-circle">Meu Perfil</span>
		<?php } else { ?>
			<span class="breadcrumb fl-l fa fa-users">Usuários / <?php echo $user_edit ? 'Editar' : 'Cadastrar' ?></span>
		<?php } ?>
		<div class="fl-r cf va-m">
			<a href="javascript: history.back();" class="button button-small button-back">Voltar</a>
			<?php if($user_edit && $_SESSION['userId']!=='1' && $user_admin){ ?>
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
			<?php if(isset($_GET['save'])){ ?>
				<div class="pc-col-20 t-col-20">
					<div class="cf va-m list--save">
						<div class="pc-col-17 -pc-col-3"><div class="login--alert login--alert-success ta-c">Informações atualizadas com sucesso!</div></div>
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
					<div class="pc-col-17 t-col-20 login--field">
						<input class="form--input" type="password" name="Senha" id="Senha" maxlength="64" data-keypass>
						<i class="fa fa-eye d-n" data-showpass></i>
					</div>
				</div>
			<?php } ?>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Perfil">Perfil</label></div>
				<div class="pc-col-17 t-col-20">
					<?php if($user_admin){ ?>
						<select class="form--input" name="Perfil" id="Perfil">
							<option value="">Selecione</option>
							<?php foreach ($tipoPerfil as $key => $value) { ?>
								<option value="<?php echo $key; ?>" <?php echo $app_user['tipoPerfil']===$key ? 'selected' : ''?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
					<?php } else { ?>
						<div class="form--input form--input-disabled"><?php echo $tipoPerfil[$app_user['tipoPerfil']]?></div>
					<?php } ?>
				</div>
			</div>
			<div class="cf va-m">
				<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Status">Status</label></div>
				<div class="pc-col-17 t-col-20">
					<?php if($user_admin){ ?>
						<select class="form--input" type="text" name="Status" id="Status">
							<?php foreach ($usuarioAtivo as $key => $value) { ?>
								<option value="<?php echo $key; ?>" <?php echo $app_user['usuarioAtivo']==$key ? 'selected' : ''?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
					<?php } else { ?>
						<div class="form--input form--input-disabled"><?php echo $usuarioAtivo[$app_user['usuarioAtivo']]?></div>
					<?php } ?>
				</div>
			</div>
			<?php if($user_edit){ ?>
				<div class="d-n">
					<div class="cf va-m form--input-last">
						<div class="pc-col-3 ta-r t-col-20 t-ta-l"><label class="form--label" for="Senha">Nova Senha</label></div>
						<div class="pc-col-6 login--field">
							<input class="form--input" type="password" name="Senha" id="Senha" maxlength="64" data-keypass>
							<i class="fa fa-eye d-n" data-showpass></i>
						</div>
					</div>
				</div>
				<div class="cf va-m">
					<div class="-pc-col-3 pc-col-17 t-col-20">
						<button type="button" class="button button-small fa fa-key d-ib" data-passchange>Alterar Senha</button>
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
