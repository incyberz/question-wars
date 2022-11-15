<?php 
# ================================================
# SESSION SECURITY
# ================================================
include 'ajax_session_security.php';
if($cadmin_level<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['kelas'])) die(erjx(4));
$kelas = $_GET['kelas'];
if(trim($kelas)=="") die("Error @ajax. SQL Values Data is empty.");



include "../config.php";
# ================================================
# DO ASSIGN PLAYERS TO ROOM
# ================================================
$status_in_class = "S01";

$s = "SELECT * from tb_kelas_det WHERE kelas='$kelas' and status_in_class='$status_in_class'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses data kelas: $kelas. ".mysqli_error($cn));
while($d=mysqli_fetch_assoc($q)){

	$znickname = $d['nickname'];

	$id_room_players = $id_room."_$znickname";
	$ss = "INSERT into tb_room_player (
	id_room_players,
	nickname,
	id_room,
	inserted_by
	) values (
	'$id_room_players',
	'$znickname',
	'$id_room',
	'$nickname'
	)";
	$qq = mysqli_query($cn,$ss);// or die("Error @ajax. Tidak dapat assign player to room. Nickname: $znickname; id_room:$id_room. ".mysqli_error($cn));

}

$id_room_kelas = $id_room."__$kelas";
$s = "INSERT into tb_room_kelas (
id_room_kelas,   id_room,   kelas ) values (
'$id_room_kelas','$id_room','$kelas'
)";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat assign kelas to room. id_room:$id_room\n\n". mysqli_error($cn));





echo "1__Sukses assign player: '$kelas' to room-id: $id_room. \n\nTekan refresh (F5) untuk melihat perubahan pada Daftar Peserta Room";

?>