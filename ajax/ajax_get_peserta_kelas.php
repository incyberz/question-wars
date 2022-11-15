<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_GET['kata_kunci'])) die(erjx(3));
if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];
$kata_kunci = $_GET['kata_kunci'];
if(trim($kata_kunci)=="") die("Error @ajax. SQL Values Data is empty.");

include "../config.php";
# ================================================
# GET DATA PLAYER
# ================================================
$s = "SELECT nickname,nama_player from tb_player where admin_level=1 and (nickname like '%$kata_kunci%' or nama_player like '%$kata_kunci%') order by nama_player";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses data player. keyword: $kata_kunci");
$jumlah_rows = mysqli_num_rows($q);

$hasil = "
<table class='table table-bordered table-hover table-striped tbx' style='margin-top: 8px'>
	<thead>
		<th>No</th>
		<th style='padding:0 5px'>Nickname <br><small>( NIM / NIS )</small></th>
		<th>Nama Peserta</th>
		<th>Status</th>
		<th>Aksi</th>
	</thead>
";
if($jumlah_rows==0) die("$hasil <tr><td colspan=5 class='merah center'>No Data dengan keyword: $kata_kunci</td></tr></table>");

$s.= " limit 5";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses data player with limit. keyword: $kata_kunci");

$i=0;
while($d=mysqli_fetch_assoc($q)){
	$znickname = $d['nickname'];
	$znama_player = ucwords(strtolower($d['nama_player']));

	$disable_add = '';
	$ss = "SELECT 1 from tb_room_player where nickname='$znickname' and id_room=$id_room";
	$qq = mysqli_query($cn,$ss) or die("Tidak bisa mengakses data room player");
	if(mysqli_num_rows($qq)==1) $disable_add = "disabled";

	$i++;
	$hasil.= "
	<tr>
		<td style='text-align: center'>$i</td>
		<td>$znickname</td>
		<td>
			<a href='about/?nickname=$znickname' class='not_ready'>$znama_player</a>
		</td>
		<td zzz>Aktif</td>
		<td>
			<button class='btn btn-success btn-sm addplayer' id='addplayer__$znickname' $disable_add>Add to Room</button>
		</td>
	</tr>
	";
}

$hasil.= "</table>";

echo "1___$jumlah_rows"."___$hasil";

?>