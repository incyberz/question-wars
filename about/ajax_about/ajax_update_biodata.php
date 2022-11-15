<?php 
session_start();
$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die("Index nickname belum terdefinisi.");
$field = isset($_GET['field']) ? $_GET['field'] : die("Index field belum terdefinisi.");
$isi = isset($_GET['isi']) ? $_GET['isi'] : die("Index isi belum terdefinisi.");

include "../../config.php";
$s = "UPDATE tb_biodata SET $field = '$isi' WHERE nickname = '$cnickname'";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

if(substr($field, 0,5)=="hobby"){
	$hobby_ke = substr($field,5,1);
	$id_hobby = $cnickname."_hobby$hobby_ke";
	$s = "
	INSERT INTO tb_hobby (id_hobby,hobby,nickname) 
	VALUES ('$id_hobby','$isi','$cnickname') 
	ON DUPLICATE KEY UPDATE hobby='$isi'
	";

	// die($s);
	$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
}

echo "1__";
?>