<?php
include_once 'includes/header.php';

$app_id = $_SESSION['userId'];
$user_sql = odbc_exec($db, "
	SELECT *
	FROM Usuario
	WHERE idUsuario != $app_id AND idUsuario != 1
	ORDER BY idUsuario DESC
");
?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">

<main class="main list wrap">
	<div class="pc-col-20 t-col-20 cf va-m">
		<span class="breadcrumb fa fa-users">Usuários / Listagem</span><span class="button-breadcrumb-wrap"><a href="user.php" class="button button-breadcrumb">Cadastrar</a></span>
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
				<div class="pc-col-20 t-col-20"><div class="login--alert login--alert-success ta-c">Usuário cadastrado com sucesso!</div></div>
			</div>
		</div>
	<?php } ?>


	<div class="pc-col-20 t-col-20">
		<div class="list--content">
			<div class="list--pages cf d-b">
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
				<div class="list--pagebox fl-r"><input type="search" class="list--input d-b" placeholder="Filtrar Nome ou Login" data-search-filter></div>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr class="t-d-n">
					<th class="ta-c" width="50">
						<input type="checkbox" name="SelecioneTodos" id="SelecioneTodos" data-multichange="all">
						<label for="SelecioneTodos" class="fa fa-square-o"></label>
					</th>
					<th class="ta-l">Nome</th>
					<th class="ta-l">Login</th>
					<th class="ta-c">Status</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<?php while($user = odbc_fetch_array($user_sql)){ ?>
					<tr>
						<td class="ta-c t-d-n">
							<input type="checkbox" name="multicheck[]" id="id<?php echo $user['idUsuario']?>" value="<?php echo $user['idUsuario']?>">
							<label for="id<?php echo $user['idUsuario']?>" class="fa fa-square-o"></label>
						</td>
						<td t-pseudo-before="Nome: " class="t-d-b"><?php echo utf8_encode($user['nomeUsuario'])?></td>
						<td t-pseudo-before="Login: " class="t-d-b"><?php echo utf8_encode($user['loginUsuario'])?></td>
						<td t-pseudo-before="Status: <?php echo $user['usuarioAtivo'] ? 'Ativo' : 'Inativo'?> " class="ta-c t-d-b t-ta-l">
							<i class="fa <?php echo $user['usuarioAtivo'] ? 'fa-check-circle' : 'fa-times-circle'?>" data-user-status="<?php echo $user['idUsuario']?>" data-tipfy="<?php echo $user['usuarioAtivo'] ? 'Ativo' : 'Inativo'?>" data-tipfy-side="left"></i>
						</td>
						<td class="ta-c t-d-b list--icons">
						<?php if(odbc_fetch_array($app_user)['tipoPerfil']==='A'){ ?>
							<a class="fa fa-pencil d-ib" href="user.php?edit=<?php echo $user['idUsuario']?>" data-tipfy="Editar"></a>
							<a class="fa fa-trash d-ib" href="includes/user_delete.php?id=<?php echo $user['idUsuario']?>" data-tipfy="Deletar"></a>
						<?php } else { ?>
							<a class="fa fa-eye d-ib" href="user.php?edit=<?php echo $user['idUsuario']?>" data-tipfy="Visualizar"></a>
						<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>

<?php include_once 'includes/footer.php'; ?>