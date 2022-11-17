<div class="wadah" style="margin-bottom:20px"> 
	<div style="margin-bottom:20px;text-align:center;"><h4>Top Challenger</h4></div>

	<style type="text/css">.top_challenger{border: solid 1px #888;padding: 10px;text-align: center; background: linear-gradient(#732973,#300830);}</style>
	<div class="row" style="margin: 0">
		




		<?php

		$s = "SELECT a.*,b.nama_player,
		(select nama_player from tb_player WHERE nickname=approved_by) as approved_by_name 
		from tb_chal_beatenby a 
		join tb_player b on a.beaten_by=b.nickname 
		where a.id_chal = $id_chal 
		and a.approved_by is not null 
		and a.date_approved is not null 
		order by a.score_for_player desc, date_claimed desc
		limit 3
		";
		// die($s);
		$q = mysqli_query($cn,$s) or die("Error @chal_details. ".mysqli_error($cn));
		if(mysqli_num_rows($q)==0){
			echo "<tr><td colspan=5>Belum ada yang mengerjakan</td></tr>";
		}else{
			$i=0;
			while($d=mysqli_fetch_assoc($q)){
				$i++;
				$nama_beater = ucwords(strtolower($d['nama_player']));
				$score_for_player = $d['score_for_player'];
				$proof_link = $d['proof_link'];
				$gm_comment = $d['gm_comment'];


				echo "
				<div class='col-lg-4 top_challenger'>
				<img src='assets/img/icons/rank_$i.png' height='100px'>
				<h4 class='text-center' style='margin:0; padding:0; color:#bffcff'>$nama_beater</h4>
				$score_for_player LP
				<br>
				<a href='$proof_link' target='_blank'>Link</a>
				<br>
				<small>$gm_comment</small>
				</div>
				";


			}
		}
		?>
	</div>
</div>