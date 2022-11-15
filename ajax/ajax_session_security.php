<?php 
if(!isset($_SESSION)) session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die(erjx('session_security: nickname'));
$admin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die(erjx('session_security: admin_level'));
$id_room = isset($_SESSION['id_room']) ? $_SESSION['id_room'] : die(erjx('session_security: id_room'));

if($_SESSION['admin_level']<1) die("Error @ajax_session_security. Maaf, sepertinya Anda belum login.");

$cnickname = $nickname;
$cadmin_level = $admin_level;
$cid_room = $id_room;

include "../config.php";
?>