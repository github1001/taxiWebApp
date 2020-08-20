<?php 

require_once ('../includes/config.php');
require_once ('../includes/database.class.php');
$db = new database($pdo);


if(isset($_POST['username']))
{
	$db->forgotpassword();

}

?>
				