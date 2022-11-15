<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_SESSION['admin_level'])) die(erjx(3));
$nickname = $_SESSION['nickname'];
$id_room = $_SESSION['id_room'];
$admin_level = $_SESSION['admin_level'];

if(!isset($_GET['jenis_btn'])) die(erjx(7)); $jenis_btn = $_GET['jenis_btn'];
if(!isset($_GET['id_soal'])) die(erjx(6)); $id_soal = $_GET['id_soal'];

if(trim($id_soal)=="") die("Error @ajax. SQL Values Data is empty.");


include "../config.php";
switch($jenis_btn){
	case 'btn_banned': $set = " is_banned=1 "; break;
	case 'btn_suspend': $set = " is_approved_by_gm=0 "; break;
	case 'btn_approved': $set = " is_approved_by_gm=1 "; break;
	case 'btn_promoted': $set = " is_approved_by_gm=2 "; break;
}
$s = " UPDATE tb_soal SET $set where id_soal='$id_soal'"; 
$q = mysqli_query($cn,$s) or die("Error @ajax. SQL error: $s. ".mysqli_error($cn));

echo "1__";
?>

