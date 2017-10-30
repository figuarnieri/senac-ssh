<?php

if(isset($_POST['Login'])) $login = $_POST['Login'];
if(isset($_POST['Senha'])) $senha = $_POST['Senha'];

if(!empty($login) || !empty($senha)){
	$sql = odbc_prepare($db, "
		SELECT *
		FROM Usuario
		WHERE loginUsuario = ?
		AND senhaUsuario = ?
	");
	if(odbc_execute($sql, array($login, $senha))){
		$user = odbc_fetch_array($sql);
		if(!empty($user['idUsuario'])){
			$_SESSION['userId'] = $user['idUsuario'];
			header('Location: '. (isset($_POST['redirect_url']) ? $_POST['redirect_url'] : './') );
		}
	};
}
?>
<link rel="stylesheet" href="dist/css/theme/pages/login.min.css">
<main class="wrap cf login">
	<div class="pc-col-9">
		<div class="login--info ta-c">
			Seja Bem-vindo ao sistema gerenciador de arquivos da loja <strong class="login--info-strong">Kanino Pet Shop</strong>
			<svg class="login--svg d-b" version="1.1" xmlns="http://www.w3.org/2000/svg" width="360" height="360" viewBox="0 0 367 367">
				<path class="st0" d="M182.2,0c101.7,0,182.9,81.6,182.9,183.8c0,100.2-82.3,181.3-184,181.2C80.9,365,0,282.7,0,181 C0,81.7,82.3,0,182.2,0z M353,182.5c0-93.6-76.2-170.3-169.2-170.4C88.9,12,12.1,87.8,12.1,181.6c0,94.7,75.8,171.4,169.7,171.4 C276.7,353,353,277,353,182.5z"/>
				<path class="st1" d="M353,182.5C353,277,276.7,353,181.8,353c-93.9,0-169.8-76.7-169.7-171.4C12.1,87.8,88.9,12,183.7,12.1 C276.8,12.2,353,88.9,353,182.5z M250.2,241.1c4.8-7.6,8.1-15.4,9.4-23.9c0.4-2.7,1.8-2.2,3.5-1.4c4.8,2.1,9.9,2.7,15.1,3.2 c21.2,1.9,37.5-9.9,41.2-30c2.7-14.7-1.5-27.6-10.9-39c-7.1-8.7-15.7-15.9-24.3-22.9c-11.9-9.7-19.8-21.8-24.8-36.1 c-2.8-8.2-4.9-16.6-8.6-24.4c-4.4-9.3-11.8-12.1-20.9-7.8c-2.3,1.1-3.2,0.2-4.5-1.2c-6.3-6.8-14.2-10.8-23.1-13.1 c-10.2-2.5-20.5-2.5-30.8-1.3c-12.3,1.4-23.2,6-31.6,15.4c-1.9,2.1-3,0.8-4.6,0c-7.5-3.8-15.1-1.7-19.4,5.5c-1.8,3-3.2,6.2-4.4,9.5 c-3.1,8.1-5.9,16.3-8.9,24.4c-5.2,14.3-13.3,26.4-25.7,35.4c-4.8,3.5-9.4,7.4-13.9,11.4c-9.5,8.4-17,18.1-17.8,31.3 c-1.2,19.2,6.4,38.2,29.8,42.3c10.8,1.9,21.4,0.7,31.4-4.5c1.6,8.8,4.1,16.9,8.7,24.2c1.9,2.9,0.4,3.2-2,3.5 c-5.8,0.7-11.5,1.9-17.1,3.6c-5.1,1.5-8.4,4.7-10.1,9.5c-4.2,12.2-5.1,24.7-2.2,37.4c0.9,4.1,3.2,7.1,6.9,9.3 c10.5,6.3,21.6,11,33.4,14.2c29.4,7.9,59.2,8.6,89.2,5.6c22-2.2,43.1-7.9,62.4-19.3c4.4-2.6,7-6,7.9-10.8 c2.4-12.2,1.6-24.1-2.3-35.9c-1.7-5-4.9-8.2-10.1-9.3C264.4,244.2,257.6,242.7,250.2,241.1z"/>
				<path class="st0" d="M250.2,241.1c7.4,1.6,14.2,3.1,21,4.6c5.2,1.1,8.5,4.3,10.1,9.3c3.9,11.8,4.7,23.7,2.3,35.9 c-1,4.8-3.6,8.3-7.9,10.8c-19.3,11.4-40.4,17.1-62.4,19.3c-30,3-59.9,2.3-89.2-5.6c-11.8-3.2-22.9-7.9-33.4-14.2 c-3.7-2.2-6-5.2-6.9-9.3c-2.8-12.7-2-25.1,2.2-37.4c1.7-4.8,5-8,10.1-9.5c5.6-1.6,11.3-2.9,17.1-3.6c2.4-0.3,3.9-0.6,2-3.5 c-4.6-7.3-7-15.4-8.7-24.2c-10,5.2-20.6,6.4-31.4,4.5c-23.5-4.1-31-23.2-29.8-42.3c0.8-13.2,8.3-22.9,17.8-31.3 c4.5-4,9.1-7.9,13.9-11.4c12.4-9,20.5-21.2,25.7-35.4c3-8.1,5.8-16.3,8.9-24.4c1.2-3.3,2.7-6.5,4.4-9.5c4.3-7.2,11.9-9.2,19.4-5.5 c1.5,0.8,2.7,2.1,4.6,0c8.4-9.4,19.3-13.9,31.6-15.4c10.3-1.2,20.6-1.2,30.8,1.3c8.9,2.2,16.8,6.3,23.1,13.1 c1.3,1.4,2.2,2.3,4.5,1.2c9.1-4.4,16.5-1.5,20.9,7.8c3.7,7.8,5.8,16.3,8.6,24.4c5,14.3,12.9,26.5,24.8,36.1 c8.6,7,17.2,14.2,24.3,22.9c9.4,11.4,13.5,24.3,10.9,39c-3.7,20.1-20,31.9-41.2,30c-5.1-0.5-10.3-1.1-15.1-3.2 c-1.7-0.7-3.1-1.3-3.5,1.4C258.3,225.7,255,233.5,250.2,241.1z M125.8,149.3c-3.8,2.8-6.5,6-8.4,10c-5,10.7-8,21.9-8.6,33.6 c-1.4,28.4,10.5,53.6,41.4,63.7c22.8,7.4,45.6,7,68.1-1.2c20.2-7.3,32.9-21.6,36.9-42.9c3.2-17,0.6-33.5-6.1-49.3 c-2.7-6.4-5-13.2-12.5-16.1c2.3-1.5,3.9,1.2,5.9-0.2c-0.2-0.8-0.2-1.6-0.5-2.4c-6.2-21.7-9.5-43.9-11.4-66.3 c-1-12.4-6.6-20.6-18.3-24.7c-18-6.4-36.3-6.2-54.5-1.8c-14.3,3.5-23.1,11.7-23.9,27.7c-0.7,15.6-3.3,31.1-6.6,46.4 c-1.7,7.9-3.8,15.7-5.7,23.4C123.2,149.7,124,148,125.8,149.3z M80.1,211.6c7.5,0.2,14.4-1.6,21.2-4.8c3.1-1.5,4.4-3.3,4.3-6.9 c-0.3-11.3,1.4-22.4,6.2-32.5c10.2-21.8,14.3-45.1,17.9-68.6c1.5-9.8,1.5-19.9,3.9-29.6c1.1-4.6,0.5-5.6-4.1-5.8 c-2.9-0.1-5.1,0.9-7.2,2.8c-4.4,3.9-6.5,9.2-8.6,14.5c-3.4,8.8-5.8,18.1-9.7,26.7c-7.6,16.9-21.6,28.5-35.4,40 c-8.1,6.8-15.8,13.6-18.3,24.6c-2.7,11.7-3,22.9,6.4,32C63.1,210.3,71.5,211.5,80.1,211.6z M284.5,211.6c1.5,0,3,0.1,4.5,0 c13.3-0.6,23.5-7.4,26.1-18.5c3.7-15.2,0-28.7-11.5-39.6c-5.4-5.1-11.2-9.9-16.8-14.8c-14.5-12.9-26.3-27.6-31.8-46.7 c-2.2-7.6-5-15.2-9.4-22c-2.6-4-5.7-7-10.9-6.4c-2.5,0.2-3.6,1.2-3,3.9c3.2,13.3,3.3,27,5.6,40.4c3.1,17.7,6,35.4,13.3,52 c5.6,12.6,9.9,25.4,9.9,39.3c0,5.6,2.9,8.5,8.2,10C274.1,210.4,279.1,212,284.5,211.6z M107.8,291.2c0.6,1.5,1.3,2.5,1.3,3.5 c0.3,6.7,5.2,8.6,10.4,10.3c1.3,0.4,2.7,0.8,3.7-0.4c1-1.3,0.3-2.5-0.5-3.6c-1.6-2.4-2-5.3-2.9-7.9c-1.2-3.7-0.9-6.3,4-5.7 c1.7,0.2,3.4-0.2,2.5-2.3c-1.2-2.9-4.2-3.6-6.9-4.4c-1.9-0.6-3.9-1-4.7,1.9c-0.4,1.6-2.2,1.6-3.4,1.1c-1.5-0.7-0.5-2-0.1-3 c1.1-2.6,2.1-5.2,3.4-7.8c1-1.9,1.4-3.7-1.3-4.1c-3.9-0.5-8.1-2.9-11.8,0.6c-0.1,0.1,0,0.6,0.1,0.9c2.5,8.4-2.6,14.3-7.2,19.8 c-2.3,2.7-1.6,3.5,0.4,4.8c1.5,1,3.2,1.7,4.9,2.3c5.4,2.1,6.1,1.6,6.9-4.1C106.8,292.7,107.3,292.2,107.8,291.2z M174.4,305.2 c0-1.6-0.1-2.3,0-2.9c0.2-1.9-0.2-4.5,2.6-4.5c2.7,0,2.8,2.5,2.8,4.5c0,2.8,0.3,5.7-1.2,8.3c-0.7,1.2-0.6,2.4,0.7,2.9 c3.7,1.5,7.5,1,11.2-0.1c1.1-0.3,1.7-1.5,1.1-2.4c-2.6-3.6-1.5-7.7-2-11.6c-1-8.3-6.1-10.7-13.1-5.9c-1.1,0.8-1.4,1.4-2.4-0.4 c-1.4-2.6-11.2-0.9-12.3,1.9c-0.2,0.4-0.2,1.1,0,1.4c3.8,4.7,2.5,9.4,0.2,14.2c-0.6,1.2-0.1,2.2,0.7,2.5c3.6,1.7,7.6,1.6,11.2,0.2 c3.6-1.4,0.3-4,0.5-6C174.6,306.3,174.4,305.3,174.4,305.2z M227.5,288.5c-2.9-3.1-11.6-0.5-12.8,3.5c-0.2,0.7-0.2,1.4,0.4,1.8 c4.6,3.5,4.8,8.2,3.8,13.2c-0.3,1.2,0.1,1.9,1.1,2.4c2.1,1.1,10.2-1,11.7-2.9c0.9-1.2,0.5-2.1-0.3-3c-2.1-2.4-2.3-5.4-3-8.3 c-0.3-1.5-0.5-3.1,1.4-3.7c2-0.6,3.2,0.6,3.8,2.3c1,3,2,5.9,1.2,9.1c-0.3,1.3-0.4,2.5,1.2,2.7c4,0.5,7.5-0.8,10.9-2.8 c1.1-0.7,1.5-2.1,0.5-3c-2.9-2.3-3-5.8-4.1-8.8c-1.2-3.5-2.2-7.2-6.6-7.9C232.3,282.5,229.3,284.5,227.5,288.5z M264,272.7 c-7-0.1-14.3,6.4-14.5,13.1c-0.2,6.3,4.3,11.5,10.4,11.7c7.5,0.3,15.6-6.9,15.6-13.9C275.5,278,270.1,272.8,264,272.7z M140.4,297.4 c-6.3-0.1-10,2.4-9.8,6.6c0.1,3.5,4.2,6.9,8.2,6.2c3.1-0.5,5.4-0.7,8.1,1.5c2.1,1.7,4.8,0.4,6.9-1.2c0.9-0.6,2.3-1.8,1.3-2.8 c-2.5-2.4-1.2-4.9-0.8-7.4c0.7-4,1.1-8-3.3-10.6c-4.1-2.4-12.2-2.3-15.3,0.2c-1.4,1.1-1.9,2.4-1.1,3.9c0.8,1.4,2.2,1.4,3.5,0.9 c1.2-0.5,2.2-1.4,3.3-2.2c1-0.7,2-1.5,3.1-0.4c0.9,0.9,1,2.1,0.6,3.3c-0.3,1.1-0.7,2.3-2.3,2.1C142,297.4,141.2,297.4,140.4,297.4z  M203.1,312.7c3.1-0.3,6.7,0,8.9-2.4c2.4-2.7-2.1-3.5-2.2-5.7c0-0.8-0.2-1.6-0.3-2.5c-0.4-3.3-0.8-6.6-1.2-9.9 c-0.2-1.4-0.2-3.3-2.5-2.9c-3.3,0.6-6.5,1.6-9.1,3.7c-1.4,1.1-1.5,2.2,0.1,3.6c3.3,2.8,3.2,6.9,2.4,10.5 C197.9,312.5,197.9,312.8,203.1,312.7z M199,288.5c2.7-1.1,7-0.6,7.6-5.2c0.3-2.1-1.9-2.8-3.5-2.5c-3.4,0.6-7.4,0.9-8.3,5 C194.3,288,196.6,288.5,199,288.5z"/>
				<path class="st2" d="M125.8,149.3c-1.9-1.3-2.7,0.4-4.1,0c1.9-7.8,4-15.5,5.7-23.4c3.3-15.3,5.9-30.8,6.6-46.4 c0.8-16.1,9.6-24.3,23.9-27.7c18.2-4.4,36.5-4.5,54.5,1.8c11.7,4.1,17.2,12.3,18.3,24.7c1.8,22.4,5.1,44.6,11.4,66.3 c0.2,0.8,0.3,1.6,0.5,2.4c-2,1.4-3.5-1.3-5.9,0.2c7.5,2.9,9.8,9.7,12.5,16.1c6.8,15.9,9.3,32.3,6.1,49.3 c-4,21.3-16.7,35.6-36.9,42.9c-22.5,8.1-45.3,8.5-68.1,1.2c-30.9-10-42.8-35.2-41.4-63.7c0.6-11.7,3.5-22.9,8.6-33.6 C119.4,155.2,122,152.1,125.8,149.3z M175.6,234.5c1.7,5.3,3.4,10.6,5.1,15.9c0.9-5.5,1.1-10.7-2.3-15.3c4,0.3,7.5-1.2,10.9-2.9 c13.4-6.6,21.6-17.8,27.1-31.3c3.2-7.8,2.4-9.6-5.6-12.4c-22.4-7.9-44.4-5.8-66.4,1.9c-3.7,1.3-3,3.9-2.5,6.5 C146.3,215.6,157.8,227.8,175.6,234.5z M159.6,61.1c-2,0.2-4,0.2-5.9,0.7c-4.5,1.1-8.5,3.2-9.9,8.1c-0.6,2.1-0.7,5.2,2.9,3.6 c5.8-2.7,11.3-1.6,17.1-0.5c1,0.2,2.1,1.1,2.8-0.7C169.1,66.2,166,61.1,159.6,61.1z M197.4,66.5c0.1,6.9,0.1,6.9,6,5.8 c4.6-0.8,9.2-1.3,13.6,0.9c3.1,1.5,4-0.2,3.5-2.9c-0.5-3-2.5-5-5-6.5c-3.8-2.3-8.1-2.5-12.5-2.6C198.6,61.1,196.3,62.4,197.4,66.5z  M139,120.3c13.5-9.3,18.5,2.7,25.9,10.5c-2.5-12.4-8.3-19.7-21.9-18.3c1.6-1.7,2.4-2.6,3.8-4.1C140.5,110.4,138.1,114.4,139,120.3z  M203.1,129.5c2.4-0.1,2.6-2.3,3.6-3.6c2.7-3.4,5.8-6.4,9.8-8.3c4.5-2.1,8.5-1.2,11.9,3.6c0.3-8.8-2.1-12.4-7.4-12.1 c1.2,1.3,3.5,1.5,3.4,3.9C212.9,110.9,206.4,115.9,203.1,129.5z"/>
				<path class="st3" d="M80.1,211.6c-8.6-0.2-17.1-1.3-23.6-7.6c-9.4-9.1-9.1-20.3-6.4-32c2.5-11,10.2-17.8,18.3-24.6 c13.8-11.6,27.8-23.1,35.4-40c3.9-8.6,6.3-17.9,9.7-26.7c2-5.2,4.2-10.5,8.6-14.5c2.1-1.9,4.4-2.9,7.2-2.8c4.7,0.2,5.3,1.2,4.1,5.8 c-2.4,9.7-2.4,19.7-3.9,29.6c-3.5,23.5-7.6,46.8-17.9,68.6c-4.8,10.2-6.5,21.3-6.2,32.5c0.1,3.6-1.2,5.3-4.3,6.9 C94.6,210.1,87.6,211.9,80.1,211.6z"/>
				<path class="st3" d="M284.5,211.6c-5.4,0.4-10.5-1.2-15.6-2.6c-5.4-1.5-8.3-4.4-8.2-10c0-13.9-4.3-26.7-9.9-39.3 c-7.3-16.5-10.2-34.3-13.3-52c-2.4-13.4-2.5-27.1-5.6-40.4c-0.7-2.7,0.5-3.6,3-3.9c5.2-0.5,8.4,2.4,10.9,6.4 c4.4,6.8,7.2,14.3,9.4,22c5.5,19.1,17.2,33.8,31.8,46.7c5.6,5,11.4,9.7,16.8,14.8c11.5,10.9,15.1,24.4,11.5,39.6 c-2.7,11.1-12.8,17.9-26.1,18.5C287.5,211.6,286,211.6,284.5,211.6z"/>
				<path class="st4" d="M107.8,291.2c-0.6,1-1.1,1.5-1.1,2.1c-0.8,5.8-1.5,6.2-6.9,4.1c-1.7-0.7-3.5-1.3-4.9-2.3 c-1.9-1.3-2.7-2.1-0.4-4.8c4.6-5.5,9.7-11.5,7.2-19.8c-0.1-0.3-0.2-0.8-0.1-0.9c3.7-3.5,7.8-1.1,11.8-0.6c2.7,0.3,2.3,2.1,1.3,4.1 c-1.3,2.5-2.3,5.2-3.4,7.8c-0.4,1-1.4,2.3,0.1,3c1.2,0.5,2.9,0.6,3.4-1.1c0.8-2.9,2.9-2.5,4.7-1.9c2.7,0.8,5.7,1.5,6.9,4.4 c0.8,2.1-0.8,2.5-2.5,2.3c-4.9-0.6-5.3,2-4,5.7c0.9,2.7,1.2,5.5,2.9,7.9c0.8,1.1,1.6,2.3,0.5,3.6c-1,1.2-2.4,0.9-3.7,0.4 c-5.2-1.7-10.1-3.6-10.4-10.3C109.1,293.7,108.4,292.7,107.8,291.2z"/>
				<path class="st4" d="M174.4,305.2c0,0.1,0.2,1.1,0.1,2.1c-0.2,2,3.1,4.6-0.5,6c-3.6,1.4-7.5,1.4-11.2-0.2c-0.8-0.4-1.3-1.3-0.7-2.5 c2.4-4.7,3.6-9.5-0.2-14.2c-0.2-0.3-0.2-1,0-1.4c1.1-2.8,10.9-4.5,12.3-1.9c1,1.8,1.3,1.1,2.4,0.4c7-4.8,12.1-2.3,13.1,5.9 c0.5,3.9-0.6,8,2,11.6c0.6,0.9-0.1,2.1-1.1,2.4c-3.7,1.1-7.5,1.6-11.2,0.1c-1.3-0.5-1.4-1.8-0.7-2.9c1.5-2.6,1.2-5.5,1.2-8.3 c0-2-0.1-4.5-2.8-4.5c-2.9,0-2.4,2.6-2.6,4.5C174.3,303,174.4,303.6,174.4,305.2z"/>
				<path class="st4" d="M227.5,288.5c1.8-3.9,4.8-6,9.1-5.4c4.4,0.6,5.4,4.4,6.6,7.9c1.1,3.1,1.2,6.5,4.1,8.8c1.1,0.9,0.7,2.3-0.5,3 c-3.3,2-6.9,3.3-10.9,2.8c-1.6-0.2-1.5-1.4-1.2-2.7c0.8-3.2-0.2-6.2-1.2-9.1c-0.6-1.7-1.8-2.9-3.8-2.3c-1.9,0.6-1.7,2.2-1.4,3.7 c0.7,2.9,0.9,5.9,3,8.3c0.9,1,1.3,1.8,0.3,3c-1.5,1.9-9.6,4-11.7,2.9c-1-0.5-1.3-1.2-1.1-2.4c1-5,0.8-9.8-3.8-13.2 c-0.6-0.4-0.6-1.1-0.4-1.8C215.9,288,224.6,285.4,227.5,288.5z"/>
				<path class="st4" d="M264,272.7c6,0.1,11.4,5.3,11.4,10.9c0,7-8.1,14.2-15.6,13.9c-6-0.2-10.6-5.4-10.4-11.7 C249.8,279.1,257,272.5,264,272.7z M259.7,279.5c-1.2,0.2-2.2,1.1-1.7,2.3c1.1,3.3,2.8,6.3,6,8.2c1.2,0.7,2.2,0.3,2.7-1.1 C267.5,286.5,262.3,279.4,259.7,279.5z"/>
				<path class="st4" d="M140.4,297.4c0.8,0,1.7,0.1,2.5,0.2c1.6,0.2,2-0.9,2.3-2.1c0.4-1.2,0.3-2.4-0.6-3.3c-1.1-1.1-2.1-0.3-3.1,0.4 c-1.1,0.8-2.1,1.6-3.3,2.2c-1.3,0.6-2.7,0.5-3.5-0.9c-0.8-1.5-0.3-2.8,1.1-3.9c3.1-2.5,11.3-2.5,15.3-0.2c4.4,2.6,3.9,6.5,3.3,10.6 c-0.4,2.5-1.7,5,0.8,7.4c1,1-0.4,2.1-1.3,2.8c-2.1,1.6-4.8,3-6.9,1.2c-2.7-2.3-5.1-2-8.1-1.5c-4.1,0.7-8.1-2.7-8.2-6.2 C130.4,299.8,134,297.3,140.4,297.4z M142,305.7c1.7-0.4,1.7-1.8,1.9-3.1c0.1-0.9-0.4-1.7-1.4-1.5c-1.5,0.2-2.3,1.2-2.3,2.7 C140.2,305,140.8,305.7,142,305.7z"/>
				<path class="st4" d="M203.1,312.7c-5.2,0.2-5.2-0.2-4-5.6c0.8-3.6,0.9-7.7-2.4-10.5c-1.6-1.4-1.5-2.5-0.1-3.6 c2.7-2.1,5.9-3.1,9.1-3.7c2.3-0.4,2.3,1.5,2.5,2.9c0.5,3.3,0.8,6.6,1.2,9.9c0.1,0.8,0.3,1.6,0.3,2.5c0.1,2.2,4.7,3,2.2,5.7 C209.7,312.7,206.2,312.4,203.1,312.7z"/>
				<path class="st4" d="M199,288.5c-2.4,0-4.7-0.5-4.2-2.8c0.9-4.1,4.9-4.4,8.3-5c1.6-0.3,3.8,0.4,3.5,2.5 C206,287.9,201.7,287.5,199,288.5z"/>
				<path class="st0" d="M175.6,234.5c-17.7-6.7-29.3-19-33.6-37.7c-0.6-2.5-1.3-5.1,2.5-6.5c22-7.7,44-9.8,66.4-1.9 c8,2.9,8.8,4.6,5.6,12.4c-5.5,13.5-13.7,24.7-27.1,31.3c-3.4,1.7-7,3.2-10.9,2.9C177.6,234.2,176.6,234.4,175.6,234.5z"/>
				<path class="st0" d="M159.6,61.1c6.4,0,9.5,5.1,6.9,11.1c-0.8,1.8-1.8,0.9-2.8,0.7c-5.7-1.1-11.3-2.1-17.1,0.5 c-3.5,1.6-3.5-1.5-2.9-3.6c1.4-4.8,5.4-6.9,9.9-8.1C155.5,61.3,157.6,61.3,159.6,61.1z"/>
				<path class="st0" d="M197.4,66.5c-1.1-4.1,1.3-5.4,5.7-5.3c4.4,0.1,8.6,0.3,12.5,2.6c2.5,1.5,4.5,3.5,5,6.5c0.5,2.8-0.4,4.5-3.5,2.9 c-4.5-2.2-9-1.8-13.6-0.9C197.4,73.5,197.4,73.4,197.4,66.5z"/>
				<path class="st0" d="M139,120.3c-0.9-5.9,1.5-9.9,7.8-11.8c-1.4,1.5-2.2,2.4-3.8,4.1c13.7-1.4,19.4,5.8,21.9,18.3 C157.5,123,152.6,111,139,120.3z"/>
				<path class="st0" d="M203.1,129.5c3.3-13.6,9.8-18.6,21.3-16.6c0.1-2.4-2.2-2.6-3.4-3.9c5.3-0.3,7.7,3.3,7.4,12.1 c-3.4-4.7-7.4-5.7-11.9-3.6c-4,1.9-7,4.9-9.8,8.3C205.7,127.2,205.4,129.4,203.1,129.5z"/>
				<path class="st3" d="M175.6,234.5c1-0.1,2.1-0.4,2.8,0.6c3.4,4.5,3.1,9.8,2.3,15.3C179,245.1,177.3,239.8,175.6,234.5z"/>
				<path class="st0" d="M259.7,279.5c2.6-0.1,7.8,7,7,9.4c-0.5,1.4-1.6,1.7-2.7,1.1c-3.2-1.8-4.8-4.9-6-8.2 C257.5,280.6,258.5,279.7,259.7,279.5z"/>
				<path class="st0" d="M142,305.7c-1.2-0.1-1.8-0.8-1.8-1.9c0-1.5,0.8-2.5,2.3-2.7c1-0.1,1.5,0.7,1.4,1.5 C143.7,303.9,143.7,305.4,142,305.7z"/>
			</svg>
		</div>
	</div>
	<div class="pc-col-9 -pc-col-2">
		<div class="login--form">
			<div class="login--tabs">
				<a class="login--area login--area-active" data-login="#formLogin">Login</a> ou <a class="login--area" data-login="#formCadastro">Cadastro</a>
			</div>
			<?php if(isset($_POST['Login'])) { ?>
				<div class="login--alert ta-c">Seu login ou senha está inválido!</div>
			<?php } ?>
			<form id="formLogin" action="./" method="post" data-validity-success="Acesso liberado" data-validity-complete="setTimeout(()=>{location.reload();},1000)">
				<?php if(isset($_GET['redirect_url'])) { ?>
					<input type="hidden" name="redirect_url" value="<?php echo $_GET['redirect_url']?>">
				<?php } ?>
				<label for="Login" class="login--label d-b">Login</label>
				<input required="" class="login--input" type="text" name="Login" id="Login" placeholder="Ex.: login@email.com" value="<?php if(isset($_POST['Login'])) echo $_POST['Login']; ?>">
				<div class="login--field">
					<label for="Senha" class="login--label d-b">Senha</label>
					<input required="" class="login--input" type="password" name="Senha" id="Senha" value="" data-keypass>
					<i class="fa fa-eye d-n" data-showpass></i>
				</div>
				<div class="cf d-b">
					<div class="fl-l">
						<a class="login--passlost" data-login="#formLostPassword">Esqueci minha senha</a>
					</div>
					<div class="fl-r">
						<button class="login--button">Acessar</button>
					</div>
				</div>
			</form>
			<form class="d-n" id="formCadastro" action="includes/user_save.php" method="post">
				<label for="Nome" class="login--label d-b">Nome</label>
				<input class="login--input" type="text" name="Nome" id="Nome" placeholder="Ex.: Fulano da Silva">
				<label for="Login" class="login--label d-b">Login</label>
				<input class="login--input" type="email" name="Login" id="Login" placeholder="Ex.: login@email.com">
				<label for="Senha" class="login--label d-b">Senha</label>
				<input class="login--input" type="password" name="Senha" id="Senha" value="123">
				<label for="Perfil" class="login--label d-b">Perfil</label>
				<select class="login--input" name="Perfil" id="Perfil">
					<option value="">Selecione</option>
					<?php
					$item = array(
						"A" => "Administrador",
						"E" => "Editor",
					);
					foreach ($item as $key => $value) { ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php } ?>
				</select>
				<div class="cf d-b">
					<div class="fl-r">
						<button class="login--button">Cadastrar</button>
					</div>
				</div>
			</form>
			<form class="d-n" id="formLostPassword" action="./" method="post">
				<label for="Login" class="login--label d-b">E-mail Cadastrado</label>
				<input class="login--input" type="text" name="Login" id="Login" placeholder="Ex.: login@email.com" value="">
				<div class="cf d-b">
					<div class="fl-l">
						<a class="login--passlost" data-login="#formLogin">Fazer login</a>
					</div>
					<div class="fl-r">
						<button class="login--button">Resgatar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>
<script>
	$('[data-login]').click(function(e){
		e.preventDefault();
		var btnText = $(this).text()
		if($(this).hasClass('login--area-active')) return;
		$('[data-login]').each(function(f, g){
			$($(g).data('login')).hide(600);
			$(this).removeClass('login--area-active');
		});
		if(btnText.toLowerCase() === 'cadastro'){
			$($(this).data('login')).show(600);
			$(this).addClass('login--area-active');
		} else {
			$($(this).data('login')).show(600);
			$('.login--tabs .login--area:first-child').addClass('login--area-active');
		}
	});
	$('[data-showpass]').mousedown(function(){
		$(this).addClass('fa-eye-slash').removeClass('fa-eye');
		$(this).prev().attr('type','text');
	}).mouseup(function(){
		$(this).addClass('fa-eye').removeClass('fa-eye-slash');
		$(this).prev().attr('type','password');
	});
	$('[data-keypass]').keyup(function(){
		if($(this).val()!==''){
			$(this).next().removeClass('d-n');
		} else {
			$(this).next().addClass('d-n');
		}
	});
	new Validity('form');
</script>