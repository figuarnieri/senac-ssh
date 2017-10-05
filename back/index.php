<?php
include('db/bancodedados.php');

$login = isset($_POST['login']) ? $_POST['login'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;

if(!empty($login) && !empty($senha)){

	$stmt = odbc_prepare($db, '	SELECT 	idUsuario, 
										nomeUsuario
								FROM Usuario
								WHERE loginUsuario = ?
								AND senhaUsuario = ?');
	odbc_execute($stmt, array($login, $senha));

	$usuario = odbc_fetch_array($stmt);

	if(!$usuario['idUsuario']){
		
		$msg = 'Login e/ou Senha Incorretos';

	}else{
		
		session_start();
		$_SESSION['idUsuario'] = $usuario['idUsuario'];
		$_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];
		
		header('Location: menu/');
		
	}
}

include('template.php');






?>