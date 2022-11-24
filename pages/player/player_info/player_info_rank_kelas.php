<?php
$ket_update = '';

if ($cadmin_level==2) {
    $rows = "
	<tr>
		<td colspan=4>
			<div class='alert alert-danger'>GM tidak perlu mengupdate data rank kelas.</div>
		</td>
	</tr>";
} elseif ($kelas=="") {
    $rows = "
	<tr>
		<td colspan=4>
			<div class='alert alert-danger'>Kamu belum dimasukan ke dalam Kelas Group. Silahkan hubungi GM!</div>
		</td>
	</tr>";
} elseif ($total_player==0) {
    $rows = "
	<tr>
		<td colspan=3>
			<div class='alert alert-danger'>Belum ada Player di Room ini.</div>
		</td>
	</tr>";
} else {
    $s = "SELECT 
	time_to_sec(timediff(now(),last_updated)) as last_second_update
	FROM tmp_rank_kelas WHERE last_updated>curdate() and id_room=26 and kelas='$kelas' limit 1
	";
    // die($s);
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

    $harus_update = 0;
    if (mysqli_num_rows($q)==1) {
        $d=mysqli_fetch_assoc($q);
        $last_second_update = $d['last_second_update'];
        if ($last_second_update>3600) {
            $harus_update=1;
        }
    } else {
        $harus_update=1;
    }

    if ($harus_update) {
        # ==============================================================
        # SQL REAL-SELECT
        # ==============================================================
        $s = "SELECT a.nickname, b.nama_player, a.room_player_point 
		FROM tb_room_player a 
		join tb_player b ON a.nickname = b.nickname 
		JOIN tb_kelas_det c ON b.nickname=c.nickname 
		WHERE b.status_aktif = 1 
		and a.id_room = $cid_room 
		and b.admin_level = 1 
		and c.kelas = '$kelas' 
		ORDER BY a.room_player_point DESC, b.nama_player 
		";

        $ket_update = 'Last update: a second ago.';
    } else {
        # ==============================================================
        # SQL SELECT-TMP
        # ==============================================================
        $s = "SELECT a.*,b.nama_player FROM tmp_rank_kelas a 
		join tb_player b on a.nickname=b.nickname 
		WHERE id_room=$cid_room 
		AND a.kelas='$kelas'  
		ORDER BY rank ";

        $ket_update = $last_second_update<60 ? "Last update: $last_second_update second ago." :
        'Last update: '. intval($last_second_update/60) . ' minutes ago';
    }

    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

    // echo "$s<hr>";

    $i=0;
    $rows = '';
    $sql_update = 'INSERT INTO tmp_rank_kelas 
	(id_rank_kelas, id_room, nickname, room_player_point, last_updated,rank,kelas) VALUES ';
    while ($d=mysqli_fetch_assoc($q)) {
        $i++;
        if ($d['room_player_point']=='') {
            $d['room_player_point'] = 0;
        }
        if ($harus_update) {
            # ==============================================================
            # AKUMULASI INSERT INTO
            # ==============================================================
            $sql_update.= "('$cid_room"."_$i','$cid_room', '$d[nickname]', $d[room_player_point], current_timestamp,$i,'$kelas'),";
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

        if ($i == 1) {
            $sup_rank = 'st';
            $bg_row = 'linear-gradient(#FFCFFEA5,#FF7AFDA5)';
            $class = 'biru bold';
            $icon = $trophy;
        }
        if ($i == 2) {
            $sup_rank = 'nd';
            $bg_row = 'linear-gradient(#B3EEFFa5,#4BD6FFa5)';
            $class = 'biru bold';
            $icon = $trophy;
        }
        if ($i == 3) {
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

    if ($harus_update) {
        # ==============================================================
        # DELETE DAHULU DATA TEMPORER
        # ==============================================================
        $s = "DELETE FROM tmp_rank_kelas WHERE id_room='$cid_room'";
        $q = mysqli_query($cn, $s) or die('error player_rank_kelas, truncate tmp_rank_kelas. '.mysqli_error($cn));

        # ==============================================================
        # EXECUTE HASIL AKUMULASI INSERT INTO
        # ==============================================================
        $sql_update.='__';
        $sql_update = str_replace(',__', '', $sql_update);
        // echo "$sql_update<hr>harus_update:$harus_update<hr> ";
        $q = mysqli_query($cn, $sql_update) or die("error player_rank_kelas, inserts tmp_rank_kelas. <hr>$sql_update<hr> ".mysqli_error($cn));
    }
}
?>

<section class="player dashboard">
	<div class="container">

		<style type="text/css">#tb_rank_kelas { background: linear-gradient(#005500aa, #550055aa)} #tb_rank_kelas td,#tb_rank_kelas th { color: white; } #tb_rank_kelas a {color: #dd0;} #tb_rank_kelas a:hover {color: #ff0;}</style>

		<h4>The Best Rank Kelas <?=$kelas?></h4>
		<p>Rank Kelas akan mempengaruhi konversi <a href="?konversi_nilai">nilai akhir mata kuliah</a>.</p>

		<table class='table' id="tb_rank_kelas">
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