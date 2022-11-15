<?php 
include 'jx_session_security.php';

$id_soal = isset($_GET['id_soal']) ? $_GET['id_soal'] : die(erjx('id_soal'));
// $id_room_subject = isset($_GET['id_room_subject']) ? $_GET['id_room_subject'] : die(erjx('id_room_subject'));
$id_alasan = isset($_GET['id_alasan']) ? $_GET['id_alasan'] : die(erjx('id_alasan'));

if($id_soal=='') die('jx_reject_soal_kuis. Index id_soal masih kosong.');
if($id_alasan=='') die('jx_reject_soal_kuis. Index id_alasan masih kosong.');

$jumlah_rejecter=0;
$rrejecter=[];
$ralasan_reject=[];

$s = "SELECT a.nickname, b.alasan_reject  
from tb_soal_rejectby a 
join tb_alasan_reject b on a.id_alasan=b.id_alasan 
where a.id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die('error hitung rejecter. '. mysqli_error($cn));
$jumlah_rejecter = mysqli_num_rows($q);

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$rrejecter[$i] = $d['nickname'];
	$ralasan_reject[$i] = $d['alasan_reject'];
	$i++;
}


# ======================================
# ADD YOU TO REJECTER
# ======================================
$s = "INSERT into tb_soal_rejectby 
(id_soal, nickname, id_alasan) values 
('$id_soal', '$cnickname', $id_alasan)";
// die($s);
$q = mysqli_query($cn,$s) or die("error insert as rejecter. ". mysqli_error($cn));




# ======================================
# GET DATA POINT FROM SOAL PLAYEDBY
# ======================================
$player_point=0;
$creator_point=0;

$ex_id_soal = explode('_',$id_soal);
$soal_creator = $ex_id_soal[0];


$s = "SELECT * from tb_soal_playedby WHERE id_soal='$id_soal' and nickname='$cnickname'";
$q = mysqli_query($cn,$s) or die('error get data soal_playedby. '. mysqli_error($cn));
if(mysqli_num_rows($q)){
	# ======================================
	# ROLLBACK POINT
	# ======================================
	$d=mysqli_fetch_assoc($q);
	$player_point = $d['player_point'];
	$creator_point = $d['creator_point'];

	// die("player_point:$player_point creator_point:$creator_point");

	if($player_point>0){
		# ======================================
		# ROLLBACK PLAYER POINT
		# ======================================
		$s2 = "UPDATE tb_player set global_point = global_point - $player_point where nickname='$cnickname'";
		$q2 = mysqli_query($cn, $s2) or die('error update rollback global_point. '.mysqli_error($cn));
		
		# ======================================
		# ROLLBACK ROOM PLAYER POINT
		# ======================================
		$s2 = "UPDATE tb_room_player set room_player_point = room_player_point - $player_point where nickname='$cnickname' and id_room='$cid_room'";
		$q2 = mysqli_query($cn, $s2) or die('error update rollback room_point. '.mysqli_error($cn));
	}

	if($creator_point>0){
		# ======================================
		# ROLLBACK CREATOR POINT
		# ======================================
		$s2 = "UPDATE tb_player set global_point = global_point - $creator_point where nickname='$soal_creator'";
		$q2 = mysqli_query($cn, $s2) or die('error update rollback creator global_point. '.mysqli_error($cn));
		
		# ======================================
		# ROLLBACK ROOM CREATOR POINT
		# ======================================
		$s2 = "UPDATE tb_room_player set room_player_point = room_player_point - $creator_point where nickname='$soal_creator' and id_room='$cid_room'";
		$q2 = mysqli_query($cn, $s2) or die('error update rollback creator room_point. '.mysqli_error($cn));
	}


	# ======================================
	# DELETE SOAL PLAYEDBY
	# ======================================
	$s = "DELETE from tb_soal_playedby WHERE id_soal='$id_soal' and nickname='$cnickname'";
	$q = mysqli_query($cn,$s) or die('error delete soal_playedby. '. mysqli_error($cn));


}


# ======================================
# ADD YOU AS REJECTERS
# ======================================
$rrejecter[$jumlah_rejecter] = $cnickname;
$ralasan_reject[$jumlah_rejecter] = $id_alasan;
$jumlah_rejecter++;



$ep_rejecter=0;
if($jumlah_rejecter>=5){
	# ======================================
	# DO BANNED SOAL + EXTRACT EP
	# ======================================
	$s = "SELECT earned_points from tb_soal where id_soal='$id_soal'";
	$q = mysqli_query($cn,$s) or die('error select earned_points. '.mysqli_error($cn));
	if(mysqli_num_rows($q)!=1) die("Soal tidak ditemukan pada database. id_soal:$id_soal");
	$d = mysqli_fetch_assoc($q);
	$earned_points = intval($d['earned_points']);


	# ======================================
	# SET BANNED AND SET EP ZERO
	# ======================================
	$s = "UPDATE tb_soal SET 
	status_soal = -1,
	earned_points = 0,
	alasan_reject = '$id_alasan'  
	WHERE id_soal='$id_soal'
	";
	$q = mysqli_query($cn,$s) or die('error set banned + ep negatif. '.mysqli_error($cn));


	# ======================================
	# BAGIKAN EP KE REJECTERS
	# ======================================
	$ep_rejecter = intval($earned_points/5);
	if($ep_rejecter>0){
		for ($i=0; $i < 5; $i++) { 
			# ======================================
			# UPDATE POINT REJECTERS
			# ======================================
			$s = "UPDATE tb_soal_rejectby SET reject_point=$ep_rejecter WHERE nickname='$rrejecter[$i]' AND id_soal='$id_soal'";
			$q = mysqli_query($cn,$s) or die('error bagikan point rejecter. '.mysqli_error($cn));


			# ======================================
			# UPDATE ROOM POINT OF REJECTERS
			# ======================================
			$s = "UPDATE tb_room_player SET room_player_point= room_player_point + $ep_rejecter WHERE nickname='$rrejecter[$i]' AND id_room='$cid_room'";
			$q = mysqli_query($cn,$s) or die('error update room_point_player by point rejecter. '.mysqli_error($cn));

		}


	}
}



echo "sukses,$player_point,$creator_point,$jumlah_rejecter,$ep_rejecter";
// sukses, player_point, creator_point, jumlah_rejecter

?>