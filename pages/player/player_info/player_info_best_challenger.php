<section class="player dashboard">
	<div class="container">


<?php
// include '../../../config.php';
// $cid_room = 26;
// $cadmin_level=2;

if ($total_player==0) {
    $rows = "
	<tr>
		<td colspan=3>
			<div class='alert alert-danger'>Belum ada Player di Room ini.</div>
		</td>
	</tr>";
} else {
    $s = "SELECT 
	time_to_sec(timediff(now(),last_updated)) as last_second_update
	FROM tmp_best_chal WHERE last_updated>curdate() and id_room=26 limit 1
	";
    // die($s);
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

    $limit_for_player = $cadmin_level==1 ? 10 : 50;

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
        $s = "
			SELECT z.nickname, z.nama_player, 
			(SELECT sum(score_for_player) from tb_chal_beatenby a 
				join tb_chal b on a.id_chal=b.id_chal 
				WHERE b.id_room='$cid_room' 
				and b.chal_visibility=1 
				and a.beaten_by=z.nickname
			  ) as sum_chal

			from tb_player z  
			join tb_kelas_det kd on z.nickname=kd.nickname 
			join tb_room_kelas rk on kd.kelas=rk.kelas 
			 
			WHERE status_aktif=1 
			and admin_level =1 
			and rk.id_room='$cid_room'  
			ORDER BY sum_chal DESC
			LIMIT 50";

        $ket_update = 'Last update: a second ago.';
    } else {
        # ==============================================================
        # SQL SELECT-TMP
        # ==============================================================
        $s = "SELECT a.*,b.nama_player FROM tmp_best_chal a 
		join tb_player b on a.nickname=b.nickname 
		WHERE id_room=$cid_room  
		ORDER BY rank LIMIT $limit_for_player";

        $ket_update = $last_second_update<60 ? "Last update: $last_second_update second ago." :
        'Last update: '. intval($last_second_update/60) . ' minutes ago';
    }

    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

    $i=0;
    $rows = '';
    $sql_update = 'INSERT INTO tmp_best_chal 
	(id_best_chal, id_room, nickname, sum_chal, last_updated,rank) VALUES ';
    while ($d=mysqli_fetch_assoc($q)) {
        $i++;
        if ($d['sum_chal']=='') {
            $d['sum_chal'] = 0;
        }
        if ($harus_update) {
            # ==============================================================
            # AKUMULASI INSERT INTO
            # ==============================================================
            $sql_update.= "('$cid_room"."_$i','$cid_room', '$d[nickname]', $d[sum_chal], current_timestamp,$i),";
        }


        # ==============================================================
        # SHOW ROWS TABLE
        # ==============================================================
        $rows.= "
		<tr>
			<td>$i</td>
			<td><a href='about/?nickname=$d[nickname]' target='_blank'>$d[nama_player]</a></td>
			<td>$d[sum_chal]</td>
		</tr>";
    }

    if ($harus_update) {
        # ==============================================================
        # DELETE DAHULU DATA TEMPORER
        # ==============================================================
        $s = "DELETE FROM tmp_best_chal WHERE id_room='$cid_room'";
        $q = mysqli_query($cn, $s) or die('error player_best_chal, truncate tmp_best_chal. '.mysqli_error($cn));

        # ==============================================================
        # EXECUTE HASIL AKUMULASI INSERT INTO
        # ==============================================================
        $sql_update.='__';
        $sql_update = str_replace(',__', '', $sql_update);
        $q = mysqli_query($cn, $sql_update) or die("error player_best_chal, inserts tmp_best_chal. <hr>$sql_update<hr> ".mysqli_error($cn));
    }
}

// echo "<h1>harus_update:$harus_update ket_update:$ket_update </h1>";


?>

<style type="text/css">#tb_best_chal { background: linear-gradient(#005500aa, #550055aa)} #tb_best_chal td,#tb_best_chal th { color: white; } #tb_best_chal a {color: #dd0;} #tb_best_chal a:hover {color: #ff0;}</style>

<h4>Best Praktikum Challenger</h4>
<p>Berikut adalah Best Challenger dengan Rewards Praktikum terbesar. Auto-update setiap jam. <?=$ket_update ?></p>

<table class='table' id="tb_best_chal">
	<thead>
		<th>Rank</th>
		<th>Best Challenger</th>
		<th>Point Praktikum</th>
	</thead>
	<?=$rows?>
</table>



</div>
</section>