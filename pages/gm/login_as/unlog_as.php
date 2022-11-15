<?php 
$logas_nickname = isset($_SESSION['logas_nickname']) ? $_SESSION['logas_nickname'] : '';
//if($cadmin_level!=1) die('Maaf, error session level.');




if($logas_nickname!=''){
	unset($_SESSION['logas_nickname']);

	$_SESSION['nickname'] = $logas_nickname;
	$_SESSION['admin_level'] = 2;
	echo "<script>location.replace('index.php?manageplayers')</script>";
	exit();	
}else{
	echo "<script>location.replace('index.php')</script>";
	die('logas_nickname is empty.');
}
?>