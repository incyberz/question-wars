<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_SESSION['admin_level'])) die(erjx(3));
if(!isset($_GET['id_soal'])) die(erjx(3));

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];
$id_soal = $_GET['id_soal'];
if(trim($id_soal)=="") die("Error @ajax. SQL Values Data is empty.");


$id_playedby = "$id_soal"."_by_$nickname";

include "../config.php"; 


$s = "SELECT  

a.soal_creator,
a.tipe_soal,
a.level_soal,
a.kalimat_soal,

a.opsi_pg1,
a.opsi_pg2,
a.opsi_pg3,
a.opsi_pg4,
a.opsi_pg5,

a.benar_count,
a.salah_count,
a.is_approved_by_gm,
a.earned_points,
a.gm_point,
a.gm_comment,
a.count_reject,
a.count_report,
a.last_answered,
a.durasi_jawab,
b.nama_player 


from tb_soal a 
join tb_player b on a.soal_creator=b.nickname 
where a.id_soal='$id_soal'";

$q = mysqli_query($cn,$s) or die("Error @ajax. Error query. ". mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("Error @ajax. SQL string error. $s");

$jml_kolom = mysqli_num_fields($q);

$d = mysqli_fetch_array($q);

$output="1_,_@";
for($i=0; $i < $jml_kolom; $i++) { 
	// $output = $output."_,_".htmlspecialchars_decode($d[$i]);
	// $output = $output."_,_".$field[$i]."===".$d[$i];
	$output = $output."_,_".htmlspecialchars_decode(stripslashes($d[$i])); 
}

$output = str_replace("@_,_", "", $output);
//$output = str_replace("_", "", $output);

// INSERT TB_PLAYED BY AGAR DIUPDATE SAAT PLAYER SUBMIT JAWABAN
$s = "INSERT into tb_soal_playedby (id_playedby, nickname, id_soal) values (
'$id_playedby','$nickname','$id_soal')";
$q = mysqli_query($cn,$s) or die("Error @ajax get question data: Soal telah dijawab sebelumnya.");

echo $output;
?>