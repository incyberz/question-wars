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

if(!isset($_GET['pengantar_pembelajaran'])) die(erjx(5)); $pengantar_pembelajaran = $_GET['pengantar_pembelajaran'];
if(trim($pengantar_pembelajaran)=="") die("Error @ajax. SQL Values Data #5 is empty.");

if(!isset($_GET['tags'])) die(erjx(6)); $tags = $_GET['tags'];
if(trim($tags)=="") die("Error @ajax. SQL Values Data #tags is empty.");

if(!isset($_GET['tujuan1'])) die(erjx(6)); $tujuan1 = $_GET['tujuan1'];
if(trim($tujuan1)=="") die("Error @ajax. SQL Values Data #6 is empty.");

if(!isset($_GET['tujuan2'])) die(erjx(7)); $tujuan2 = $_GET['tujuan2'];

if(!isset($_GET['tujuan3'])) die(erjx(8)); $tujuan3 = $_GET['tujuan3'];

if(!isset($_GET['bahan_ajar'])) die(erjx(9)); $bahan_ajar = $_GET['bahan_ajar'];
if(trim($bahan_ajar)=="") die("Error @ajax. SQL Values Data #6 is empty.");

if(!isset($_GET['video_materi'])) die(erjx(10)); $video_materi = $_GET['video_materi'];
if(trim($video_materi)=="") die("Error @ajax. SQL Values Data #4 is empty.");

if(!isset($_GET['dapus1'])) die(erjx(11)); $dapus1 = $_GET['dapus1'];
if(trim($dapus1)=="") die("Error @ajax. SQL Values Data #5 is empty.");

if(!isset($_GET['dapus2'])) die(erjx(12)); $dapus2 = $_GET['dapus2'];

if(!isset($_GET['dapus3'])) die(erjx(13)); $dapus3 = $_GET['dapus3'];




include "../config.php";
# ================================================
# GET MAX PRIORITY
# ================================================
$s = "SELECT 1 FROM tb_kelengkapan_presensi where id_room_subject='$id_room_subject'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengecek exists id_room_subject");

$id_room_subject = "'$id_room_subject'";
$pengantar_pembelajaran = "'$pengantar_pembelajaran'";
$tags = "'$tags'";
$tujuan1 = "'$tujuan1'";
$tujuan2 = "'$tujuan2'";
$tujuan3 = "'$tujuan3'";
$bahan_ajar = "'$bahan_ajar'";
$video_materi = "'$video_materi'";
$dapus1 = "'$dapus1'";
$dapus2 = "'$dapus2'";
$dapus3 = "'$dapus3'";

if(strlen($pengantar_pembelajaran)<50) die("Field pengantar_pembelajaran kurang dari 50 karakter");
if(strlen($tujuan1)<20) die("Field tujuan1 kurang dari 20 karakter");
if(strlen($bahan_ajar)<20) die("Field bahan_ajar kurang dari 20 karakter");
if(strlen($video_materi)<20) die("Field video_materi kurang dari 20 karakter");
if(strlen($dapus1)<20) die("Field dapus1 kurang dari 20 karakter");

if($tujuan2=="''") $tujuan2 = "NULL"; 
if($tujuan3=="''") $tujuan3 = "NULL"; 
if($dapus2=="''") $dapus2 = "NULL"; 
if($dapus3=="''") $dapus3 = "NULL"; 



if(mysqli_num_rows($q)==0){
	$s = "INSERT INTO tb_kelengkapan_presensi (
	id_room_subject,
	pengantar_pembelajaran,
	tags,
	tujuan1,
	tujuan2,
	tujuan3,
	bahan_ajar,
	video_materi,
	dapus1,
	dapus2,
	dapus3
	) values (
	$id_room_subject,
	$pengantar_pembelajaran,
	$tags,
	$tujuan1,
	$tujuan2,
	$tujuan3,
	$bahan_ajar,
	$video_materi,
	$dapus1,
	$dapus2,
	$dapus3
	)";
}else{
	$s = "UPDATE tb_kelengkapan_presensi SET 
	pengantar_pembelajaran=$pengantar_pembelajaran,
	tags=$tags,
	tujuan1=$tujuan1, 
	tujuan2=$tujuan2, 
	tujuan3=$tujuan3, 
	bahan_ajar=$bahan_ajar, 
	video_materi=$video_materi, 
	dapus1=$dapus1,
	dapus2=$dapus2, 
	dapus3=$dapus3 
	where id_room_subject=$id_room_subject";
}


$q = mysqli_query($cn,$s) or die("Error @ajax. ".mysqli_error($cn));
echo "1__";

?>