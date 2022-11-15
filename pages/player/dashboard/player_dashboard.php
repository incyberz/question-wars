<?php
if($cadmin_level==1){
	$login_as = "Player";
	$judul_ldb1 = "Your Dashboard";
	$welcome_name = "$cnama_player";
	$your_rank = "Your $singkatan_room Rank : <span style='font-size: 28pt;color: blue'>$rank_player<sup>$player_rank_th</sup></span> of $total_player Players";
	$global_rank = "$player_global_rank<sup>$player_global_rank_cap</sup>	of $jumlah_player_global $login_as";
}elseif($cadmin_level==2 or $cadmin_level==9){
	$login_as = "GM";
	$judul_ldb1 = "GM Dashboard";
	$welcome_name = "GM: $cnama_player";
	$your_rank = "Your $singkatan_room Rank : <span style='font-size: 28pt;color: blue'>$gm_rank<sup>$gm_rank_th</sup></span> of $jumlah_gm GMs";
	$global_rank = "$gm_global_rank<sup>$gm_global_rank_cap</sup>	of $jumlah_gm_global $login_as";
}
?>


<style>
	.blok_dashboard a{
		color: #8ff;
		transition: .5s;
	}

	.blok_dashboard a:hover{
		letter-spacing: 1px;
		color: yellow;
	}

	.blok_progres{
		margin: 7px 0 15px 0;

	}

	.blok_rank{
		text-align: center;
		background: pink;
		padding: 10px 0;
		color: darkblue;
	}

	.row_dashboard{
		background: linear-gradient(#00ff0011, #ff00ff33);
		padding: 10px;
		cursor: pointer;
	}

	.row_dashboard:hover{
		background: linear-gradient(#00ff0033, #00ff0055);

	}

	.blok_rank, .row_dashboard{
		border: solid 1px #ccccff55;
	}
</style>

<section id="player_dashboard" class="player dashboard">
	<div class="container">

		<h2>Welcome back <?=$welcome_name?>!</h2>
		<hr>
		<?php //include "../daily_login.php"; ?>
		<?php //include "../notification_from_gm.php"; ?>

		<div class="row blok_menu_dashboard" id="blok_dashboard">
			<div class="col-lg-6">
				<div class="blok_dashboard">
					<h4><?=$judul_ldb1?></h4>
					
					<div class="blok_rank">
						<?=$your_rank?>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								Presensi:
							</div>
							<div class="col-8">
								<span class="help badge badge-danger"><?=$jumlah_presensi ?></span> of <span class="help badge badge-success"><?=$total_presensi_saat_ini ?></span> <a href="?presensi">sesi presensi</a>
								<div class="blok_progres">
									 <div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="70"
									  aria-valuemin="0" aria-valuemax="100" style="width:<?=$persen_presensi ?>%">
									    <?=$persen_presensi ?>%
									  </div>
									</div> 
								</div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								My Questions
							</div>
							<div class="col-8">
								<div><span class="help badge badge-success"><?=$jumlah_soal_publish ?></span> <a href="?myq">published</a></div>
								<div><span class="help badge badge-warning"><?=$jumlah_soal_new ?></span> <a href="?myq">new</a></div>
								<div><span class="help badge badge-warning"><?=$jumlah_soal_suspend ?></span> <a href="?myq">suspend</a></div>
								<div><span class="help badge badge-danger"><?=$jumlah_soal_banned ?></span> <a href="?myq">banned</a></div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								My Challenges
							</div>
							<div class="col-8">
								<div><span class="help badge badge-danger"><?=$jumlah_chal ?></span> of <span class="help badge badge-success"><?=$total_chal ?></span> <a href="?chal">challenges</a></div>
								<div class="blok_progres">
									 <div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="70"
									  aria-valuemin="0" aria-valuemax="100" style="width:<?=$persen_chal ?>%">
									    <?=$persen_chal ?>%
									  </div>
									</div> 
								</div>
								<div><span class="help badge badge-primary"><?=$jumlah_chal_unclaim ?></span> <a href="?chal">unclaim</a></div>
								<div><span class="help badge badge-info"><?=$jumlah_chal_claimed ?></span> claimed</div>
								<div><span class="help badge badge-info"><?=$jumlah_chal_unver ?></span> unverified</div>
								<div><span class="help badge badge-danger"><?=$jumlah_tugas ?></span> of <span class="help badge badge-success"><?=$total_tugas ?></span> tugas harian</div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								Other Activity
							</div>
							<div class="col-8">
								<div><span class="help badge badge-info"><?=$jumlah_play ?></span> play kuis</div>
								<div><span class="help badge badge-info"><?=$persen_akurasi ?>%</span> akurasi jawab benar</div>
								<div><span class="help badge badge-info"><?=$jumlah_reject ?></span> reject soal</div>
								<div><span class="help badge badge-info"><?=$jumlah_daily_login ?></span> daily logins</div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<a href="#player_dashboard" class="btn btn-primary btn-block scrollto navdas" id="navdas__riseup">Rise Up My Rank !!</a>
					</div>



				</div>


			</div>
		</div>




	</div>
</section>