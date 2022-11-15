<?php 
# ================================================
# SESSION SECURITY
# ================================================
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['admin_level'])) die(erjx(2));
if(!isset($_SESSION['id_room'])) die(erjx(3));

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['aksi'])) die(erjx(4)); $aksi = $_GET['aksi'];
if(trim($aksi)=="") die("Error @ajax. SQL Values Data #4 is empty.");
if(!isset($_GET['id_request_player'])) die(erjx(5)); $id_request_player = $_GET['id_request_player'];
if(trim($id_request_player)=="") die("Error @ajax. SQL Values Data #5 is empty.");



include "../config.php";
# ================================================
# APPROV OR REJECT
# ================================================
$is_approv_ok = 0;
if ($aksi=="approv") {
	$s = "SELECT a.* from tb_request_player a where a.id_request_player='$id_request_player'";
	$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses request player");
	$d = mysqli_fetch_assoc($q);
	$req_nickname = $d['nickname'];
	$req_id_room = $d['id_room'];

	$id_room_players = $req_id_room."_$req_nickname";
	$s = "INSERT INTO tb_room_player (id_room_players,nickname,id_room,inserted_by) 
	values ('$id_room_players','$req_nickname','$req_id_room','$nickname')";
	$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat assign request player");
	$is_approv_ok = 1;
}

$s = "DELETE FROM tb_request_player where id_request_player='$id_request_player'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat menghapus request player");

if($is_approv_ok){echo "1__Berhasil APPROVE request player";}else{
	echo "1__Berhasil MENGHAPUS request player";	
}
?>