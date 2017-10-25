<?php
require_once 'connect.php';

$user_id = $_POST['id'];
$user_login = utf8_decode($_POST['Login']);
$user_nome = utf8_decode($_POST['Nome']);
$user_tipo = $_POST['Perfil'];
$user_ativo = intval($_POST['Status']);
$user_senha = utf8_decode($_POST['Senha']);
$user_redirect = $_POST['redirect'];

if(empty($user_id)){

	$user_sql = odbc_prepare($db, "
		INSERT INTO Usuario(loginUsuario, senhaUsuario, nomeUsuario, tipoPerfil, usuarioAtivo)
		VALUES(?, ?, ?, ?, ?)"
	);
	odbc_execute($user_sql, array("$user_login", "$user_senha", "$user_nome", "$user_tipo", $user_ativo));

} else {

	$user_sql = odbc_prepare($db, "
		UPDATE Usuario
		SET loginUsuario = '$user_login', nomeUsuario = '$user_nome', tipoPerfil = '$user_tipo', usuarioAtivo = $user_ativo
		WHERE idUsuario = ?"
	);
	odbc_execute($user_sql, array($user_id));

	/*SQL APENAS PARA ATUALIZAR SENHA*/
	if(!empty($user_senha)){
		$user_sql_senha = odbc_prepare($db, "
			UPDATE Usuario
			SET senhaUsuario = '$user_senha'
			WHERE idUsuario = ?"
		);
		odbc_execute($user_sql_senha, array($user_id));
	}

}

header(empty($user_redirect) ? "Location: ../user_list.php" : "Location: ../$user_redirect");
?>