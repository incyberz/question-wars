<?php include "pages/player/presensi_var.php"; ?>

<style type="text/css">
	#tb_jumlah_presensi{
		width: 100%; font-size: 10pt;
	}

	#tb_jumlah_presensi td{
		border: solid 1px #555;
		padding: 5px;
	}
	#tb_jumlah_presensi tr:hover{
		background-color: #005;
	}
	.tr_judul{
		font-weight:bold; background-color:#00a; text-align:center;
	}
</style>

<script type="text/javascript" src="assets/js/chart.js"></script>
<section id="feedback_presensi" class="gm">
	<div class="container">

		<h3>Feedback Presensi</h3>


		<div class="wadah" style="margin-bottom: 5px;">

			<?php 

			$s = "SELECT * from tb_room_subject where id_room='$cid_room' and nama_subject not like '%materi umum%'  order by no_subject";
			// die($s);
			$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses data room subjects");
			if (mysqli_num_rows($q)==0) {
				echo "Room ini belum mempunyai Room Subjects.";
			}else{

				$percent_width = 18;
				$rows = "
				<table width='100%' id='tb_jumlah_presensi'>
					<tr class='tr_judul'>
						<td>No</td>
						<td>Room Subject / Learning Path</td>
						<td width='30%'>Presensi</td>
						<td width='40%'>Motivations Meter</td>
					</tr>
				";

				$jumlah_yg_present_cum = 0;
				$jumlah_player_cum = 0;
				$is_kesulitan_cum = 0;
				$is_termotivasi_cum[0] = 0;
				$is_termotivasi_cum[1] = 0;
				$is_termotivasi_cum[2] = 0;
				$is_termotivasi_cum[3] = 0;

				while ($d=mysqli_fetch_assoc($q)) {
					$id_room_subject = $d['id_room_subject'];
					$no_subject = $d['no_subject'];
					$nama_subject = $d['nama_subject'];

					$ss = "SELECT is_kesulitan,is_termotivasi,kesulitan_ket 
					from tb_presensi where id_room_subject=$id_room_subject";
					$qq = mysqli_query($cn,$ss) or die("Tidak dapat mengakses data claim presensi");

					$jumlah_yg_present = mysqli_num_rows($qq);

					# =================================================
					# HITUNG IS_KESULITAN DAN TERMOTIVASI
					# =================================================
					$is_kesulitan_cum_persesi = 0;
					$is_termotivasi_cum_persesi[0] = 0;
					$is_termotivasi_cum_persesi[1] = 0;
					$is_termotivasi_cum_persesi[2] = 0;
					$is_termotivasi_cum_persesi[3] = 0;

					if($jumlah_yg_present>0){
						while($dd = mysqli_fetch_assoc($qq)){
							$is_kesulitan = $dd['is_kesulitan'];						
							$kesulitan_ket = $dd['kesulitan_ket'];						
							$is_termotivasi = $dd['is_termotivasi'];

							if($is_kesulitan and strlen($kesulitan_ket)>10) $is_kesulitan_cum_persesi++;				

							if($is_termotivasi==0) $is_termotivasi_cum_persesi[0]++;				
							if($is_termotivasi==1) $is_termotivasi_cum_persesi[1]++;				
							if($is_termotivasi==2) $is_termotivasi_cum_persesi[2]++;				
							if($is_termotivasi==3) $is_termotivasi_cum_persesi[3]++;		

							// if($is_termotivasi==0) die("$is_termotivasi zzz".$is_termotivasi_cum_persesi[2]);		

						}

						$is_kesulitan_cum += $is_kesulitan_cum_persesi;
						$is_termotivasi_cum[0] += $is_termotivasi_cum_persesi[0];
						$is_termotivasi_cum[1] += $is_termotivasi_cum_persesi[1];
						$is_termotivasi_cum[2] += $is_termotivasi_cum_persesi[2];
						$is_termotivasi_cum[3] += $is_termotivasi_cum_persesi[3];

					}

					# =================================================
					# HITUNG PERSENTASE
					# =================================================
					$persen_yg_present = round($jumlah_yg_present/$total_player*100);

					$jumlah_yg_present_show = "Present $jumlah_yg_present of $total_player Players";
					if($jumlah_yg_present==0) {
						$jumlah_yg_present_show = "-";

						$persen_yg_termotivasi_persesi[0] = 0;
						$persen_yg_termotivasi_persesi[1] = 0;
						$persen_yg_termotivasi_persesi[2] = 0;
						$persen_yg_termotivasi_persesi[3] = 0;

					}else{
						$jumlah_yg_present_cum += $jumlah_yg_present;
						$jumlah_player_cum += $total_player;

						$persen_yg_termotivasi_persesi[0] = round($is_termotivasi_cum_persesi[0]/$jumlah_yg_present*100);
						$persen_yg_termotivasi_persesi[1] = round($is_termotivasi_cum_persesi[1]/$jumlah_yg_present*100);
						$persen_yg_termotivasi_persesi[2] = round($is_termotivasi_cum_persesi[2]/$jumlah_yg_present*100);
						$persen_yg_termotivasi_persesi[3] = 100-$persen_yg_termotivasi_persesi[0]-$persen_yg_termotivasi_persesi[1]-$persen_yg_termotivasi_persesi[2];

					}
					
					$persen_yg_kesulitan = 0;
					if($jumlah_yg_present!=0)$persen_yg_kesulitan = round($is_kesulitan_cum_persesi/$jumlah_yg_present*100);


					# =================================================
					# HITUNG PERSENTASE
					# =================================================
					$persen_grafik = "-";
					$persen_kesulitan = "-";
					$persen_termotivasi[0] = "-";
					$persen_termotivasi[1] = "-";
					$persen_termotivasi[2] = "-";
					$persen_termotivasi[3] = "-";

					$warna_presensi = "f0a";

					if($persen_yg_present!=0){
						$persen_grafik = "<br>
						<table width='100%' style='font-size:8pt'>
							<tr>
								<td width='$persen_yg_present%' style='background-color:#2c5; text-align:center; color:#008'>
									 $persen_yg_present%
								</td>
								<td style='background-color:#500'>&nbsp;</td>
							</tr>
						</table>
						";
					}

					if($persen_yg_kesulitan!=0){
						$persen_kesulitan = "<br>Kesulitan Player<br>
						<table width='100%' style='font-size:8pt'>
							<tr>
								<td width='$persen_yg_kesulitan%' style='background-color:#afa; text-align:center; color:#008'>
									 $persen_yg_kesulitan%
								</td>
								<td style='background-color:#500'>&nbsp;</td>
							</tr>
						</table>
						";
					}else{
						if($jumlah_yg_present!=0) $persen_kesulitan = "<br>Kesulitan Player: 0%<br>&nbsp;";
					}

					$text_color = ["f55","ffa","8f8","2f2"];
					$caption = ["Tidak","Kurang","Termotivasi","Sangat"];
					for ($i=0; $i < 4; $i++) { 
						$persen_termotivasi[$i] = "
						<table width='100%' style='font-size:8pt'>
							<tr>
								<td width='25%' style='color:#$text_color[$i]'>$caption[$i]</td>
								<td style='background-color:#500' width='*'>0%</td>
							</tr>
						</table>
						";
						if($persen_yg_termotivasi_persesi[$i]!=0){
							$persen_termotivasi[$i] = "
							<table width='100%' style='font-size:8pt'>
								<tr>
									<td width='25%' style='color:#$text_color[$i]'>$caption[$i]</td>
									<td width='$persen_yg_termotivasi_persesi[$i]%' style='background-color:#$text_color[$i]; text-align:center; color:#008'>
										 $persen_yg_termotivasi_persesi[$i]%
									</td>
									<td style='background-color:#500' width='*'>&nbsp;</td>
								</tr>
							</table>
							";
						}else{
							if($jumlah_yg_present==0) $persen_termotivasi[$i] = "-";
						}
					}



					$rows.= "
					<tr>
						<td align=center valign=top>$no_subject</td>
						<td valign=top>$nama_subject</td>
						<td>
							$jumlah_yg_present_show
							$persen_grafik
							$persen_kesulitan
						</td>
						<td>
							$persen_termotivasi[0]
							$persen_termotivasi[1]
							$persen_termotivasi[2]
							$persen_termotivasi[3]
						</td>

					</tr>";

				}

				# =========================================================
				# AVERAGE CUMMULATIVE
				# =========================================================
				$persen_yg_present_cum = $jumlah_player_cum==0?0: round($jumlah_yg_present_cum/$jumlah_player_cum*100);
				$persen_yg_kesulitan_cum = $jumlah_yg_present_cum==0?0: round($is_kesulitan_cum/$jumlah_yg_present_cum*100);

				$persen_yg_termotivasi_cum[0] = $jumlah_yg_present_cum==0?0: round($is_termotivasi_cum[0]/$jumlah_yg_present_cum*100);
				$persen_yg_termotivasi_cum[1] = $jumlah_yg_present_cum==0?0: round($is_termotivasi_cum[1]/$jumlah_yg_present_cum*100);
				$persen_yg_termotivasi_cum[2] = $jumlah_yg_present_cum==0?0: round($is_termotivasi_cum[2]/$jumlah_yg_present_cum*100);
				$persen_yg_termotivasi_cum[3] = 100-$persen_yg_termotivasi_cum[0]-$persen_yg_termotivasi_cum[1]-$persen_yg_termotivasi_cum[2];


				$zzz = [1,5,74,20];
				$rows.= "
				<tr class='tr_judula'>
					<td align=center colspan=2>Average Presensi</td>
					<td>
						<table width='100%' style='margin-bottom:8px'>
							<tr>
								<td width='$persen_yg_present_cum%' style='background-color:#afa; text-align:center; color:#008'>
									 $persen_yg_present_cum%
								</td>
								<td style='background-color:#500'>&nbsp;</td>
							</tr>
						</table>
						<small>Merasa kesulitan: $is_kesulitan_cum of $jumlah_yg_present_cum players</small>

						<table width='100%' style='font-size:8pt'>
							<tr>
								<td width='$persen_yg_kesulitan_cum%' style='background-color:#afa; text-align:center; color:#008'>
									 $persen_yg_kesulitan_cum%
								</td>
								<td style='background-color:#500'>&nbsp;</td>
							</tr>
						</table>

					</td>
					<td>
						<table width='100%'>
							<tr>
								<td width='$persen_yg_termotivasi_cum[0]%' style='background-color:#$text_color[0]; text-align:center; color:#008'>
									<small>$caption[0]</small>
									<br>
									<small>$is_termotivasi_cum[0]</small>
									<br>
									$persen_yg_termotivasi_cum[0]% 
								</td>
								<td width='$persen_yg_termotivasi_cum[1]%' style='background-color:#$text_color[1]; text-align:center; color:#008'>
									<small>$caption[1]</small>
									<br>
									<small>$is_termotivasi_cum[1]</small>
									<br>
									$persen_yg_termotivasi_cum[1]%
								</td>
								<td width='$persen_yg_termotivasi_cum[2]%' style='background-color:#$text_color[2]; text-align:center; color:#008'>
									<small>$caption[2]</small>
									<br>
									<small>$is_termotivasi_cum[2]</small>
									<br>
									$persen_yg_termotivasi_cum[2]%
								</td>
								<td width='$persen_yg_termotivasi_cum[3]%' style='background-color:#$text_color[3]; text-align:center; color:#008'>
									<small>$caption[3]</small>
									<br>
									<small>$is_termotivasi_cum[3]</small>
									<br>
									$persen_yg_termotivasi_cum[3]%
								</td>
							</tr>
						</table>
					</td>

				</tr>";





				$rows.= "</table>";

				echo "$rows";
			}



			$sf_nm = ["aaa","bbb","ccc","ddd","eee","fff"];
			$sf_val = [12,34,12,54,22,4];
			 ?>

		</div>

		<div id="hasil_ajax"></div>

	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		
	})

	$(document).on("click",".img_wa_disabled",function(){
		var id = $(this).prop("id");
		alert("Maaf, tidak bisa mengirim pesan karena player ini belum punya nomor WA");
	})


</script>