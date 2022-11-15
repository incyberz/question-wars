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
if(!isset($_GET['kelas'])) die(erjx(4));
$kelas = $_GET['kelas'];
if(trim($kelas)=="") die("Error @ajax. SQL Values Data is empty.");



include "../config.php";
# ================================================
# DO DROP KELAS FROM ROOM
# ================================================
$s = "DELETE FROM tb_room_kelas WHERE id_room='$id_room' AND kelas='$kelas'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat assign kelas to room. id_room:$id_room\n\n". mysqli_error($cn));

echo "sukses";

?>