<?php
$auth_permission = array('/kanino/web/index.php', '/pi/web/index.php','/index.php');
if(!isset($_SESSION['userId']) && !in_array($_SERVER['SCRIPT_NAME'], $auth_permission)){
    header('Location: ./?redirect_url='.urlencode($_SERVER['REQUEST_URI']));
}
?>