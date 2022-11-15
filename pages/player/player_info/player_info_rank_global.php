<section class="player dashboard">
	<div class="container">
		<div class="row">

<div class="col-lg-6">

	<h4>Global Leaderboard</h4>
	<table class="table table-bordered table-hover" bgcolor="white">
		<thead>
			<th colspan="3" bgcolor="#00ffff" height="80px">
				<center><h4>The Best of <b><font color="brown"><?=$nama_room?></font></b></h4></center>
			</th>
		</thead>

		<?php 
		$img = "<img src='assets/img/icons/medal.png'>";
		$imgs = '';
		$sty = '';
		$stytd = " style='color:blue;font-weight:bold;background-color:yellow;border:solid 3px' ";
		
		$jumlah_looping=10;
		if($admin_level==2 or $admin_level==9)$jumlah_looping=$total_player;
		if($total_player<10)$jumlah_looping=$total_player;

		for ($i=1; $i <= $jumlah_looping ; $i++) { 
			$sup = "th";
			if($i==1) $sup = "st";
			if($i==2) $sup = "nd";
			if($i==3) $sup = "rd";

			if($i==1) $imgs = "$img $img $img";
			if($i==2) $imgs = "$img $img";
			if($i==3) $imgs = "$img";
			if($i>3) $imgs = '';

			$bg = "#fdfdfd";
			if($i==1) $bg = "pink";
			if($i==2) $bg = "lightblue";
			if($i==3) $bg = "#ccffcc";

			$sty = '';
			if(strtoupper($list_player[$i]) == strtoupper($cnama_player)) $sty = $stytd;

			echo "
			<tr bgcolor='$bg' align='center'>
			<td $sty>$i<sup>$sup</sup></td>
			<td $sty>$imgs ".$list_player[$i]."</td>
			<td $sty>".$list_point[$i]."</td>
			</tr>
			";						

		}


		?>

		<tr>
			<td class="tdlead" colspan=3>
				<small>What!? <span style="font-weight: bold;color: red">You not on the list?</span> Or you not the first!? Rise Up!!</small>
				<a href='#player_dashboard' class='btn btn-primary btn-block scrollto navdas' id="navdas__riseup">Rise Up My Rank !!</a>
			</td>
		</tr>					
	</table>
</div>


</div>
</div>
</section>



















<?php 
$ket_update = '';

if($nama_room==""){
	$rows = "
	<tr>
		<td colspan=3>
			<div class='alert alert-danger'>Kamu belum dimasukan ke dalam Program Studi. Silahkan hubungi GM!</div>
		</td>
	</tr>";
}elseif($total_player==0){
	$rows = "
	<tr>
		<td colspan=3>
			<div class='alert alert-danger'>Belum ada Player di Room ini.</div>
		</td>
	</tr>";
}else{
	$s = "SELECT 
	time_to_sec(timediff(now(),last_updated)) as last_second_update
	FROM tmp_rank_global WHERE last_updated>curdate() and id_room=26 limit 1
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
		$s = "SELECT a.nickname, b.nama_player, a.room_player_point 
		FROM tb_room_player a 
		join tb_player b ON a.nickname = b.nickname 
		WHERE b.status_aktif = 1 
		and a.id_room = $cid_room 
		and b.admin_level = 1 
		ORDER BY a.room_player_point DESC, b.nama_player 
		";

		$s = "SELECT a.nickname, b.nama_player, a.room_player_point 
		from tb_room_player a 
		join tb_player b ON a.nickname = b.nickname 
		WHERE b.status_aktif = 1 
		and a.id_room = $cid_room 
		and b.admin_level = 1 
		ORDER BY a.room_player_point DESC, b.nama_player 
		";


		$ket_update = 'Last update: a second ago.';
	}else{

		# ==============================================================
		# SQL SELECT-TMP
		# ==============================================================
		$s = "SELECT a.*,b.nama_player FROM tmp_rank_global a 
		join tb_player b on a.nickname=b.nickname 
		WHERE id_room=$cid_room  
		ORDER BY rank LIMIT $limit_for_player";

		$ket_update = $last_second_update<60 ? "Last update: $last_second_update second ago." : 
		'Last update: '. intval($last_second_update/60) . ' minutes ago'; 
	}

	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

	$i=0;
	$rows = '';
	$sql_update = 'INSERT INTO tmp_rank_global 
	(id_rank_global, id_room, nickname, room_player_point, last_updated,rank) VALUES ';
	while ($d=mysqli_fetch_assoc($q)) {
		$i++;
		if($d['room_player_point']=='') $d['room_player_point'] = 0;
		if($harus_update){
			# ==============================================================
			# AKUMULASI INSERT INTO
			# ==============================================================
			$sql_update.= "('$cid_room"."_$i','$cid_room', '$d[nickname]', $d[room_player_point], current_timestamp,$i),";
		}


		# ==============================================================
		# SHOW ROWS TABLE
		# ==============================================================
		$trophy = "<img src='assets/img/icons/trophy_$i.png' height='30px'";

		$sty_mine = $d['nickname']!=$cnickname ? '' : 'color:blue;font-weight:bold;border:solid 3px';


		$sup_rank = 'th';
		$bg_row = '';
		$icon = '&nbsp;';
		$class = '';

		if($i == 1) { 
			$sup_rank = 'st'; 
			$bg_row = 'linear-gradient(#FFCFFEA5,#FF7AFDA5)';
			$class = 'biru bold';
			$icon = $trophy; 
		}
		if($i == 2) { 
			$sup_rank = 'nd'; 
			$bg_row = 'linear-gradient(#B3EEFFa5,#4BD6FFa5)';
			$class = 'biru bold';
			$icon = $trophy; 
		}
		if($i == 3) { 
			$sup_rank = 'rd'; 
			$bg_row = 'linear-gradient(#B3FFBEa5,#50FE68a5)';
			$class = 'biru bold';
			$icon = $trophy; 
		}

		$rows.= "
		<tr style='background: $bg_row; $sty_mine' class='row_leaderboard'>
			<td>$i<sup>$sup_rank</sup></td>
			<td>$icon</td>
			<td><a href='about/?nickname=$d[nickname]' target='_blank' class='$class'>$d[nama_player]</a></td>
			<td>".number_format($d['room_player_point'])."</td>
		</tr>";
	}

	if($harus_update){
		# ==============================================================
		# DELETE DAHULU DATA TEMPORER
		# ==============================================================
		$s = "DELETE FROM tmp_rank_global WHERE id_room='$cid_room'";
		$q = mysqli_query($cn,$s) or die('error player_rank_global, truncate tmp_rank_global. '.mysqli_error($cn));

		# ==============================================================
		# EXECUTE HASIL AKUMULASI INSERT INTO
		# ==============================================================
		$sql_update.='__';
		$sql_update = str_replace(',__', '', $sql_update);
		$q = mysqli_query($cn,$sql_update) or die("error player_rank_global, inserts tmp_rank_global. <hr>$sql_update<hr> ".mysqli_error($cn));
	}
}
?>

<section class="player dashboard">
	<div class="container">

		<style type="text/css">#tb_rank_global { background: linear-gradient(#005500aa, #550055aa)} #tb_rank_global td,#tb_rank_global th { color: white; } #tb_rank_global a {color: #dd0;} #tb_rank_global a:hover {color: #ff0;}</style>

		<h4>The Best Rank Room <?=$nama_room ?></h4>
		<p>Rank Room akan mempengaruhi konversi <a href="?konversi_nilai">nilai akhir mata kuliah</a>.</p>

		<table class='table' id="tb_rank_global">
			<thead>
				<th>Rank</th>
				<th>&nbsp;</th>
				<th>The Best Player</th>
				<th>Learning Points</th>
			</thead>
			<?=$rows?>
			<tr>
				<td colspan=4>
					<small>Be the best in your class! Rise Up!!</small>
					<a href='?help' class='btn btn-primary btn-block'>Rise Up My Rank !!</a>
				</td>
			</tr>	
		</table>
		<small>Auto-update setiap jam. <?=$ket_update ?></small>
	</div>
</section>