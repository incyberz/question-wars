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

include "../config.php";
# ================================================
# DELETE ROOM SUBJECT
# ================================================
$s = "DELETE FROM tb_room_subject where id_room_subject=$id_room_subject";
$q = mysqli_query($cn,$s) or die("Hapus gagal. ".mysqli_error($cn));


echo "1__";

?>