<section class="player dashboard">
	<div class="container">


<?php 
// include '../../../config.php';
// $cid_room = 26;
// $cadmin_level=2;

if($total_player==0){
	$rows = "
	<tr>
		<td colspan=3>
			<div class='alert alert-danger'>Belum ada Player di Room ini.</div>
		</td>
	</tr>";
}else{
	$s = "SELECT 
	time_to_sec(timediff(now(),last_updated)) as last_second_update
	FROM tmp_paling_rajin WHERE last_updated>curdate() and id_room=26 limit 1
	";
	// die($s);
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

	$limit_for_player = $cadmin_level==1?10:50;

	$harus_update = 0;
	if(mysqli_num_rows($q)==1){
		$d=mysqli_fetch_assoc($q);
		$last_second_update = $d['last_second_update'];
		if($last_second_update>3600){
			$harus_update=1;
		}
	}else{
		$harus_update=1;
	}

	if($harus_update){

		# ==============================================================
		# SQL REAL-SELECT
		# ==============================================================
		$s = "
		SELECT a.nickname, a.nama_player, 
		(SELECT count(1) from tb_soal_playedby z 
			JOIN tb_soal b on z.id_soal=b.id_soal 
			JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
			JOIN tb_room d on c.id_room=d.id_room 
			WHERE d.id_room='$cid_room' 
			and z.nickname=a.nickname ) as play_count

		from tb_player a  
		join tb_kelas_det kd on a.nickname=kd.nickname 
		join tb_room_kelas rk on kd.kelas=rk.kelas 
		 
		WHERE status_aktif=1 
		and admin_level =1 
		and rk.id_room='$cid_room'  
		ORDER BY play_count DESC
		LIMIT 50";

		$ket_update = 'Last update: a second ago.';
	}else{

		# ==============================================================
		# SQL SELECT-TMP
		# ==============================================================
		$s = "SELECT a.*,b.nama_player FROM tmp_paling_rajin a 
		join tb_player b on a.nickname=b.nickname 
		WHERE id_room=$cid_room  
		ORDER BY rank LIMIT $limit_for_player";

		$ket_update = $last_second_update<60 ? "Last update: $last_second_update second ago." : 
		'Last update: '. intval($last_second_update/60) . ' minutes ago'; 
	}

	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

	$i=0;
	$rows = '';
	$sql_update = 'INSERT INTO tmp_paling_rajin 
	(id_paling_rajin, id_room, nickname, play_count, last_updated,rank) VALUES ';
	while ($d=mysqli_fetch_assoc($q)) {
		$i++;
		if($harus_update){
			# ==============================================================
			# AKUMULASI INSERT INTO
			# ==============================================================
			$sql_update.= "('$cid_room"."_$i','$cid_room', '$d[nickname]', $d[play_count], current_timestamp,$i),";
		}


		# ==============================================================
		# SHOW ROWS TABLE
		# ==============================================================
		$rows.= "
		<tr>
			<td>$i</td>
			<td><a href='about/?nickname=$d[nickname]' target='_blank'>$d[nama_player]</a></td>
			<td>$d[play_count]</td>
		</tr>";
	}

	if($harus_update){
		# ==============================================================
		# DELETE DAHULU DATA TEMPORER
		# ==============================================================
		$s = "DELETE FROM tmp_paling_rajin WHERE id_room='$cid_room'";
		$q = mysqli_query($cn,$s) or die('error player_paling_rajin, truncate tmp_paling_rajin. '.mysqli_error($cn));

		# ==============================================================
		# EXECUTE HASIL AKUMULASI INSERT INTO
		# ==============================================================
		$sql_update.='__';
		$sql_update = str_replace(',__', '', $sql_update);
		$q = mysqli_query($cn,$sql_update) or die("error player_paling_rajin, inserts tmp_paling_rajin. <hr>$sql_update<hr> ".mysqli_error($cn));
	}
}

// echo "<h1>harus_update:$harus_update ket_update:$ket_update </h1>";


?>

<style type="text/css">#tb_paling_rajin { background: linear-gradient(#005500aa, #550055aa)} #tb_paling_rajin td,#tb_paling_rajin th { color: white; } #tb_paling_rajin a {color: #dd0;} #tb_paling_rajin a:hover {color: #ff0;}</style>

<h4>Player Paling Rajin</h4>
<p>Berikut adalah player yang paling rajin Play Kuis. Auto-update setiap jam. <?=$ket_update ?></p>

<table class='table' id="tb_paling_rajin">
	<thead>
		<th>Rank</th>
		<th>Player Paling Rajin</th>
		<th>Play Counts</th>
	</thead>
	<?=$rows?>
</table>



</div>
</section>