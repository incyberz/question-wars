<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die(erjx('nickname'));
$cadmin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die(erjx('admin_level'));
// $cnama_player = isset($_SESSION['nama_player']) ? $_SESSION['nama_player'] : die(erjx('nama_player'));
// $cjenis_user = isset($_SESSION['jenis_user']) ? $_SESSION['jenis_user'] : die(erjx('jenis_user'));
$cid_room = isset($_SESSION['id_room']) ? $_SESSION['id_room'] : die(erjx('id_room'));

if($_SESSION['admin_level']<1) die("Error @ajax. Maaf, sepertinya Anda belum login.");

include "../config.php";
?>