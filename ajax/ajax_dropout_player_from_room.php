<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_GET['id_room_players'])) die(erjx(3));
if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];
$id_room_players = $_GET['id_room_players'];
if(trim($id_room_players)=="") die("Error @ajax. SQL Values Data is empty.");

include "../config.php";
# ================================================
# DROP OUT BEGIN
# ================================================
$s = "DELETE FROM tb_room_player where id_room_players = '$id_room_players' ";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat menghapus assign player. id: $id_room_players");

echo "1";
?>

