<?php include_once 'includes/header.php'; ?>
<link rel="stylesheet" href="dist/css/theme/pages/list.min.css">

<main class="main list wrap cf">
	<div class="pc-col-20">
		<span class="breadcrumb fl-l fa fa-user-circle">Usuários / Listagem</span><span class="fl-l"><a href="user.php" class="button button-breadcrumb">Cadastrar</a></span>
	</div>
	<div class="pc-col-20">
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
				<ul class="list--pagelist">
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b"><i class="fa fa-chevron-left"></i></a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">1</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">2</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">3</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">4</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b">5</a></li>
					<li class="list--pagebox"><a href="#" class="list--pagelink d-b"><i class="fa fa-chevron-right"></i></a></li>
				</ul>
			</div>
			<table class="list--table" cellpadding="0" cellspacing="0">
				<tr>
					<th class="ta-c">
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
				");
				while($user = odbc_fetch_array($user_sql)){ ?>
					<tr>
						<td class="ta-c">
							<input type="checkbox" name="multicheck[]" id="id<?php echo $user['idUsuario']?>" value="<?php echo $user['idUsuario']?>">
							<label for="id<?php echo $user['idUsuario']?>" class="fa fa-square-o"></label>
						</td>
						<td><?php echo $user['nomeUsuario']?></td>
						<td><?php echo $user['loginUsuario']?></td>
						<td class="ta-c">
							<i class="fa <?php echo $user['usuarioAtivo'] ? 'fa-check-circle' : 'fa-times-circle'?>" data-user-status="<?php echo $user['idUsuario']?>" data-tipfy="<?php echo $user['usuarioAtivo'] ? 'Ativo' : 'Inativo'?>" data-tipfy-side="left"></i>
						</td>
						<td class="ta-c">
							<a class="fa fa-pencil d-ib" href="user.php?edit=<?php echo $user['idUsuario']?>"></a>
							<a class="fa fa-trash d-ib" href="includes/user_delete.php?id=<?php echo $user['idUsuario']?>"></a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</main>
<script>
	$('[data-multichange="all"]').change(function(e){
		if($(this).is(':checked')){
			$('.list--table td [type="checkbox"]').each(function(f,g){
				if(!$(g).is(':checked')){
					$(g).trigger('click');
				}
			});
		} else {
			$('.list--table td [type="checkbox"]').each(function(f,g){
				if($(g).is(':checked')){
					$(g).trigger('click');
				}
			});
		}
	});
	$('.list--table td [type="checkbox"]').change(function(e){
		if($('.list--table td [type="checkbox"]:not(:checked)').length === $('.list--table td [type="checkbox"]').length){
			$('.list--tools').slideUp(200);
		} else {
			$('.list--tools').slideDown(200);
		}
	});
	$('[data-selectchange]').change(function(e) {
		$(this).closest('form').trigger('submit');
	});
	new Tipfy('[data-tipfy]');
	$('[data-user-status]').click(function(e){
		if($(this).hasClass('fa-check-circle')){
			$(this).removeClass('fa-check-circle').addClass('fa-times-circle').attr({'data-tipfy':'Inativo'});
		} else {
			$(this).addClass('fa-check-circle').removeClass('fa-times-circle').attr({'data-tipfy':'Ativo'});
		}
		$('.tipfy--wrap').remove();
	});
</script>
<?php include_once 'includes/footer.php'; ?>