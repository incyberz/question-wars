<?php 
// die("1");
include "../config.php";

$nickname = strtolower(trim($_GET['nickname']));
$password = $_GET['password'];

$nickname = filter_var($nickname);
$password = filter_var($password);

$s = "SELECT admin_level from tb_player where nickname = '$nickname' and password = '$password'";
$q = mysqli_query($cn,$s) or die("Error #ajax_login, SQL: $s");
// echo "$s";
if(mysqli_num_rows($q)==1){
	$d = mysqli_fetch_assoc($q);
	if(!isset($_SESSION))session_start();
	// $_SESSION['nickname'] = $nickname;
	// $_SESSION['admlv'] = $d['admin_level'];
	echo 1;
}
if($q and mysqli_num_rows($q)!=1)echo 0;
?>