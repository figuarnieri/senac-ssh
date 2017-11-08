<?php
require_once 'connect.php';

$user_id = isset($_POST['id']) ? $_POST['id'] : '';
$user_login = utf8_decode($_POST['Login']);
$user_nome = utf8_decode($_POST['Nome']);
$user_tipo = $_POST['Perfil'];
$user_ativo = isset($_POST['Status']) ? intval($_POST['Status']) : 1;
$user_senha = utf8_decode($_POST['Senha']);

if(empty($user_id)){

	$user_sql_test = odbc_prepare($db, "
		SELECT loginUsuario, senhaUsuario
		FROM Usuario
		WHERE loginUsuario = ? AND senhaUsuario = ?
	");
	if(odbc_execute($user_sql_test, array($user_login, $user_senha))){

		if(!odbc_fetch_row($user_sql_test)){
			$user_sql = odbc_prepare($db, "
				INSERT INTO Usuario(loginUsuario, senhaUsuario, nomeUsuario, tipoPerfil, usuarioAtivo)
				VALUES(?, ?, ?, ?, ?)"
			);
			odbc_execute($user_sql, array($user_login, $user_senha, $user_nome, $user_tipo, $user_ativo));
		} else {
			header("Location: ../?error=2");
			exit();
		}
	}

} else {

	$user_sql = odbc_prepare($db, "
		UPDATE Usuario
		SET loginUsuario = ?, nomeUsuario = ?, tipoPerfil = ?, usuarioAtivo = ?
		WHERE idUsuario = ?"
	);
	odbc_execute($user_sql, array($user_login, $user_nome, $user_tipo, $user_ativo, $user_id));

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
if(empty($user_id)){
	header(empty($app_redirect) ? "Location: ../" : "Location: ../$app_redirect");
} else {
	header(empty($app_redirect) ? "Location: ../user_list.php" : "Location: ../$app_redirect");
}
?>