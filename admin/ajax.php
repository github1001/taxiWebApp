<?php
ob_start();

require_once('../includes/config.php');
require_once('../includes/database.class.php');
$db= new database($pdo);

$db->updateStatus($_POST['val'],$_POST['id']);

?>