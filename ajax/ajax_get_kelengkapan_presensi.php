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
# GET NAMA KOLOM KELENGKAPAN PRESENSI
# ================================================
$s = "DESCRIBE tb_kelengkapan_presensi";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mendeskripsikan data kelengkapan presensi. ".mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$fields[$i] = $d['Field'];
	$i++;
}

# ================================================
# GET KELENGKAPAN PRESENSI
# ================================================
$s = "SELECT * FROM tb_kelengkapan_presensi where id_room_subject='$id_room_subject'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses kelengkapan presensi. id_room_subject: $id_room_subject. ".mysqli_error($cn));

$jumlah_rows = mysqli_num_rows($q);
if($jumlah_rows>1) die("Redudansi kelengkapan presensi. Jumlah rows: $jumlah_rows");
if($jumlah_rows==0) die("0__");

$d = mysqli_fetch_assoc($q);
$output = "__";
for ($i=0; $i < count($fields) ; $i++) { 
	$output.= ";;;;".$fields[$i]."====".$d[$fields[$i]];
}
$output = str_replace("__;;;;","",$output);

echo "1__$output";

?>