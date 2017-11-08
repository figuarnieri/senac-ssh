<?php
$auth_permission = array(
	  '/kanino/web/index.php'
	, '/pi/web/index.php'
	, '/index.php'
	, '/user_save.php'
	, '/pi/web/user_save.php'
	, '/kanino/web/user_save.php'
);
if(!isset($_SESSION['userId']) && !in_array($_SERVER['SCRIPT_NAME'], $auth_permission)){
    header('Location: ./?redirect_url='.urlencode($_SERVER['REQUEST_URI']));
} else {
	$app_redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '';
}
?>