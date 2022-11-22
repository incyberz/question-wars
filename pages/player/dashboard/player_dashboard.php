<?php




$player_rank_th = "th";
if ($rank_player % 10 == 1) {
    $player_rank_th = "st";
}
if ($rank_player % 10 == 2) {
    $player_rank_th = "nd";
}
if ($rank_player % 10 == 3) {
    $player_rank_th = "rd";
}



if ($cadmin_level==1) {
    $login_as = "Player";
    $judul_ldb1 = "Your Dashboard";
    $welcome_name = "$cnama_player";
    $your_rank = "Your $singkatan_room Rank : <span style='font-size: 28pt;color: blue'>$rank_player<sup>$player_rank_th</sup></span> of $total_player Players";
} elseif ($cadmin_level==2 or $cadmin_level==9) {
    $login_as = "GM";
    $judul_ldb1 = "GM Dashboard";
    $welcome_name = "GM: $cnama_player";
    $your_rank = "Your $singkatan_room Rank : <span style='font-size: 28pt;color: blue'>1<sup>st</sup></span> of 1 GMs";
}


# ================================================
# OUTPUT PERSEN
# ================================================
$my_persen_presensi = $total_presensi_saat_ini==0 ? 0 : round($my_presensi/$total_presensi_saat_ini*100, 0);
$my_persen_chal = $my_chal_count==0 ? 0 : round($my_chal_count/$my_chal_count*100, 0);
$my_persen_akurasi = $my_play_count==0 ? 0 : round($my_play_count_benar/$my_play_count*100, 0);





?>



<section id="player_dashboard" class="player dashboard">
	<div class="container">

		<h2>Welcome back <?=$welcome_name?>!</h2>
		<hr>
		<?php //include "../daily_login.php";?>
		<?php //include "../notification_from_gm.php";?>

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
								<span class="help badge badge-danger"><?=$my_presensi ?></span> of <span class="help badge badge-success"><?=$total_presensi_saat_ini ?></span> <a href="?presensi">sesi presensi</a>
								<div class="blok_progres">
									 <div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="70"
									  aria-valuemin="0" aria-valuemax="100" style="width:<?=$my_persen_presensi ?>%">
									    <?=$my_persen_presensi ?>%
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
								<div><span class="help badge badge-success"><?=$my_soal_publish ?></span> <a href="?myq">published</a></div>
								<div><span class="help badge badge-warning"><?=$my_soal_new ?></span> <a href="?myq">new</a></div>
								<div><span class="help badge badge-warning"><?=$my_soal_suspend ?></span> <a href="?myq">suspend</a></div>
								<div><span class="help badge badge-danger"><?=$my_soal_banned ?></span> <a href="?myq">banned</a></div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								Play Quiz
							</div>
							<div class="col-8">
								<!-- akurasi jawab benar
								<div class="blok_progres">
									 <div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="70"
									  aria-valuemin="0" aria-valuemax="100" style="width:<?=$my_persen_akurasi ?>%">
									    <?=$my_persen_akurasi ?>%
									  </div>
									</div> 
								</div> -->
								<div><span class="help badge badge-info"><?=$my_play_count ?></span> play kuis</div>
								<div><span class="help badge badge-info"><span id='my_persen_akurasi'><?=$my_persen_akurasi ?></span>%</span> akurasi jawab benar</div>
								<div><span class="help badge badge-info"><?=$my_reject_count ?></span> reject soal</div>
							</div>
						</div>
					</div>


					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								My Challenges
							</div>
							<div class="col-8">
								<div><span class="help badge badge-danger"><?=$my_chal_count ?></span> of <span class="help badge badge-success"><?=$total_chal ?></span> <a href="?chal">challenges</a></div>
								<div class="blok_progres">
									 <div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="70"
									  aria-valuemin="0" aria-valuemax="100" style="width:<?=$my_persen_chal ?>%">
									    <?=$my_persen_chal ?>%
									  </div>
									</div> 
								</div>
								<div><span class="help badge badge-primary"><?=$my_chal_count_unclaim ?></span> <a href="?chal">unclaim</a></div>
								<div><span class="help badge badge-info"><?=$my_chal_count_claimed ?></span> claimed</div>
								<div><span class="help badge badge-info"><?=$my_chal_count_unver ?></span> unverified</div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-4">
								Other Activity
							</div>
							<div class="col-8">
								<div><span class="help badge badge-info"><?=$my_daily_login_count ?></span> daily logins</div>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<div class="row">
							<div class="col-12 text-center">
								<small>
								<?php
                                if ($selisih_detik<60) {
                                    $selisih_show = "$selisih_detik sec";
                                } else {
                                    $selisih_show = intval($selisih_detik/60).' min '.($selisih_detik%60).' sec';
                                }
                                echo "Last update in $selisih_show. Update every hour.";
?>
								</small>
							</div>
						</div>
					</div>

					<div class="row_dashboard">
						<a href="?help" class="btn btn-primary btn-block scrollto navdas" id="navdas__riseup">Tingkatkan Rank !!</a>
					</div>



				</div>


			</div>
		</div>



		


	</div>
</section>