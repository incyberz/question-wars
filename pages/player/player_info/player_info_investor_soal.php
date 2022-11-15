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
	FROM tmp_investor_soal WHERE last_updated>curdate() and id_room=26 limit 1
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
		SELECT z.nickname, z.nama_player, 

		(SELECT count(1) FROM tb_soal a 
			JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
		 	JOIN tb_room c on b.id_room=c.id_room 

		 	WHERE a.soal_creator=z.nickname 
		 	AND a.visibility_soal=1 
			AND c.id_room = $cid_room 
			AND b.nama_subject NOT LIKE '%materi umum%') as soal_count

		from tb_player z  
		join tb_kelas_det kd on z.nickname=kd.nickname 
		join tb_room_kelas rk on kd.kelas=rk.kelas 
			 
		WHERE status_aktif=1 
		and admin_level =1 
		and rk.id_room='$cid_room'  
		ORDER BY soal_count DESC
		LIMIT 50";

		$ket_update = 'Last update: a second ago.';
	}else{

		# ==============================================================
		# SQL SELECT-TMP
		# ==============================================================
		$s = "SELECT a.*,b.nama_player FROM tmp_investor_soal a 
		join tb_player b on a.nickname=b.nickname 
		WHERE id_room=$cid_room  
		ORDER BY rank LIMIT $limit_for_player";

		$ket_update = $last_second_update<60 ? "Last update: $last_second_update second ago." : 
		'Last update: '. intval($last_second_update/60) . ' minutes ago'; 
	}

	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

	$i=0;
	$rows = '';
	$sql_update = 'INSERT INTO tmp_investor_soal 
	(id_investor_soal, id_room, nickname, soal_count, last_updated,rank) VALUES ';
	while ($d=mysqli_fetch_assoc($q)) {
		$i++;
		if($harus_update){
			# ==============================================================
			# AKUMULASI INSERT INTO
			# ==============================================================
			$sql_update.= "('$cid_room"."_$i','$cid_room', '$d[nickname]', $d[soal_count], current_timestamp,$i),";
		}


		# ==============================================================
		# SHOW ROWS TABLE
		# ==============================================================
		$rows.= "
		<tr>
			<td>$i</td>
			<td><a href='about/?nickname=$d[nickname]' target='_blank'>$d[nama_player]</a></td>
			<td>$d[soal_count]</td>
		</tr>";
	}

	if($harus_update){
		# ==============================================================
		# DELETE DAHULU DATA TEMPORER
		# ==============================================================
		$s = "DELETE FROM tmp_investor_soal WHERE id_room='$cid_room'";
		$q = mysqli_query($cn,$s) or die('error player_investor_soal, truncate tmp_investor_soal. '.mysqli_error($cn));

		# ==============================================================
		# EXECUTE HASIL AKUMULASI INSERT INTO
		# ==============================================================
		$sql_update.='__';
		$sql_update = str_replace(',__', '', $sql_update);
		$q = mysqli_query($cn,$sql_update) or die("error player_investor_soal, inserts tmp_investor_soal. <hr>$sql_update<hr> ".mysqli_error($cn));
	}
}

// echo "<h1>harus_update:$harus_update ket_update:$ket_update </h1>";


?>

<style type="text/css">#tb_investor_soal { background: linear-gradient(#005500aa, #550055aa)} #tb_investor_soal td,#tb_investor_soal th { color: white; } #tb_investor_soal a {color: #dd0;} #tb_investor_soal a:hover {color: #ff0;}</style>

<h4>Investor Soal Terbanyak</h4>
<p>Berikut adalah player dengan Publish Soal terbanyak. Auto-update setiap jam. <?=$ket_update ?></p>

<table class='table' id="tb_investor_soal">
	<thead>
		<th>Rank</th>
		<th>Investor Soal Terbanyak</th>
		<th>Publish Soal</th>
	</thead>
	<?=$rows?>
</table>



</div>
</section>