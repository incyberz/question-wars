<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_GET['values_sql'])) die(erjx(3));
if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];
$values_sql = $_GET['values_sql'];
if(trim($values_sql)=="") die("Error @ajax. SQL Values Data is empty.");

include "../config.php";
# ================================================
# CSV PROCESS BEGIN
# ================================================
$rvalues = explode(";",$values_sql);

for ($i=0; $i < count($rvalues) ; $i++) { 
	$baris = explode(",",$rvalues[$i]);
	$nim = $baris[0]; 
	$nama = $baris[1];

	# =======================================================
	# DO CEK IF EXIST PLAYER
	# =======================================================
	$s = "SELECT nama_player from tb_player where nickname='$nim'";
	$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengecek data player");
	if(mysqli_num_rows($q)==0){
		# ================================================
		# DO INSERT PLAYER
		# ================================================
		$s = "INSERT into tb_player (nickname,password,nama_player) values('$nim','$nim','$nama')";
		$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat insert new player $s ".mysqli_error($cn));

	}else{
		# ================================================
		# IS NAMA PLAYER = NEW NAMA PLAYER
		# ================================================
		$d = mysqli_fetch_assoc($q);
		$nama_player = $d['nama_player'];
		if($nama!=$nama_player){
			# ================================================
			# DO UPDATE PLAYER
			# ================================================
			$s = "UPDATE tb_player set nama_player='$nama' where nickname='$nim'";
			$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengupdate nama_player. $s".mysqli_error($cn));
		}
	}

	# ================================================
	# DO CEK IF EXIST NIM IN ROOM PLAYERS
	# ================================================
	$s = "SELECT b.nama_player from tb_room_player a 
	join tb_player b on a.nickname=b.nickname 
	where a.nickname='$nim' and a.id_room=$id_room";
	$q = mysqli_query($cn,$s) or die("Error @ajax. Nickname checking error.");
	if(mysqli_num_rows($q)==1){
		# ================================================
		# PLAYER IS ALREADY ASSIGN
		# ================================================

	}else{
		# ================================================
		# DO ASSIGN PLAYERS TO ROOM
		# ================================================
		$id_room_players = $id_room."_$nim";
		$s = "INSERT into tb_room_player (
		id_room_players,
		nickname,
		id_room,
		inserted_by
		) values (
		'$id_room_players',
		'$nim',
		'$id_room',
		'$nickname'
		)";
		$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat assign player to room. Nickname: $nim; id_room:$id_room");

	}


}

echo "1__";
?>