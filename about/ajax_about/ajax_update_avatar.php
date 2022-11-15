<?php 
session_start();
$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die("Index nickname belum terdefinisi.");
// $field = isset($_GET['field']) ? $_GET['field'] : die("Index field belum terdefinisi.");
$isi = isset($_GET['isi']) ? $_GET['isi'] : die("Index isi belum terdefinisi.");
$isi = $isi=="" ? "NULL" : "'$isi'";

include "../../config.php";
$s = "UPDATE tb_player SET avatar_id = $isi WHERE nickname = '$cnickname'";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

echo "1__";
?>