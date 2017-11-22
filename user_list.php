<?php include_once 'includes/header.php'; ?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">

<main class="main list wrap cf">
	<div class="pc-col-20 t-col-20">
		<span class="breadcrumb fl-l fa fa-user-circle">Usuários / Listagem</span><span class="fl-l button-breadcrumb-wrap"><a href="user.php" class="button button-breadcrumb">Cadastrar</a></span>
	</div>
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
					<th class="ta-l">Login</th>
					<th class="ta-c">Status</th>
					<th class="ta-c" width="150">Ações</th>
				</tr>
				<?php
				$app_id = $_SESSION['userId'];
				$user_sql = odbc_exec($db, "
					SELECT *
					FROM Usuario
					WHERE idUsuario != $app_id AND idUsuario != 1
					ORDER BY idUsuario DESC
				");
				while($user = odbc_fetch_array($user_sql)){ ?>
					<tr>
						<td class="ta-c t-d-n">
							<input type="checkbox" name="multicheck[]" id="id<?php echo $user['idUsuario']?>" value="<?php echo $user['idUsuario']?>">
							<label for="id<?php echo $user['idUsuario']?>" class="fa fa-square-o"></label>
						</td>
						<td t-pseudo-before="Nome: " class="t-d-b"><?php echo $user['nomeUsuario']?></td>
						<td t-pseudo-before="Login: " class="t-d-b"><?php echo $user['loginUsuario']?></td>
						<td t-pseudo-before="Status: <?php echo $user['usuarioAtivo'] ? 'Ativo' : 'Inativo'?> " class="ta-c t-d-b t-ta-l">
							<i class="fa <?php echo $user['usuarioAtivo'] ? 'fa-check-circle' : 'fa-times-circle'?>" data-user-status="<?php echo $user['idUsuario']?>" data-tipfy="<?php echo $user['usuarioAtivo'] ? 'Ativo' : 'Inativo'?>" data-tipfy-side="left"></i>
						</td>
						<td class="ta-c t-d-b list--icons">
							<a class="fa fa-pencil d-ib" href="user.php?edit=<?php echo $user['idUsuario']?>"></a>
							<a class="fa fa-trash d-ib" href="includes/user_delete.php?id=<?php echo $user['idUsuario']?>"></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>

<?php include_once 'includes/footer.php'; ?>