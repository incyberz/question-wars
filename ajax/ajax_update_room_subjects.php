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

if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['id_room_subject'])) die(erjx(4)); $id_room_subject = $_GET['id_room_subject'];
if(trim($id_room_subject)=="") die("Error @ajax. SQL Values Data #4 is empty.");

if(!isset($_GET['field'])) die(erjx(5)); $field = $_GET['field'];
if(trim($field)=="") die("Error @ajax. SQL Values Data #5 is empty.");

if(!isset($_GET['isi'])) die(erjx(6)); $isi = $_GET['isi'];
if(trim($isi)=="") die("Error @ajax. SQL Values Data #6 is empty.");



include "../config.php";
# ================================================
# GET MAX PRIORITY
# ================================================
$s = "UPDATE tb_room_subject SET $field='$isi' where id_room_subject=$id_room_subject";
if($field=="date_jadwal"){
	$isi2 = date("Y-m-d",strtotime($isi));
	$s = "UPDATE tb_room_subject SET date_jadwal='$isi', date_open='$isi2', date_close='$isi2' 
	where id_room_subject=$id_room_subject";
}
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengupdate room subject kolom: $field");

echo "1__";

?>