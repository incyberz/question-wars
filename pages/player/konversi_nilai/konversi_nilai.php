<style>
	.nilai_kamu{
		border-top: solid 1px #ccc;
		border-bottom: solid 1px #ccc;
		padding: 5px 0;
		font-size: small;
	}
	.yang_dinilai{
		font: bold 12pt 'century gothic', 'sans-serif;';
		color: darkblue;
		margin-bottom: 5px;
	}
</style>

<section id="konversi_nilai" class="player">
	<div class="container">
		<h3 class="text-center">Daftar Presensi dan Nilai Ujian</h3>



		<?php 

		# =================================================
		# DEBUG VARIABEL
		# =================================================
		$min_buat_soal = 3; // per minggu
		$min_daily_login = 3; // per minggu

		$tanggal_p9 = '2022-10-21'; //zzz debug
		if($cid_room==35) $tanggal_p9 = '2022-12-13'; //zzz debug
		// $rank_player_in_prodi = 21;
		// $jumlah_player_in_kelas = 6;
		// $jumlah_presensi = 7;
		// $jumlah_soal_publish = 140;
		// $jumlah_play = 1400;
		// $jumlah_chal = 14;
		// $jumlah_daily_login = 14;
		// $uts_baak = 100;
		// $uas_baak = 100;


		if($jumlah_player_in_kelas<10){
			if($jumlah_player_in_prodi<10){
				$total_peserta = $total_player;
				$rank_peserta = $rank_player;
			}else{
				$total_peserta = $jumlah_player_in_prodi;
				$rank_peserta = $rank_player_in_prodi;
			}
		}else{
			$total_peserta = $jumlah_player_in_kelas;
			$rank_peserta = $rank_player_in_kelas;
		}

		$persen_teratas = 0.2; //dapat nilai 100

		$jumlah_peserta_terbaik = round($total_peserta*$persen_teratas,0);
		if($jumlah_peserta_terbaik>20){
			$jumlah_peserta_terbaik=20;
			$total_peserta = 100;
		}

		$selisih_poin_konversi = ($total_peserta-$jumlah_peserta_terbaik)==0?0:50/($total_peserta-$jumlah_peserta_terbaik);

		if($rank_peserta == ''){
			$hasil_konversi_rank = 0;
		}elseif($rank_peserta <= $jumlah_peserta_terbaik){
			$hasil_konversi_rank = 100;
		}else{
			$hasil_konversi_rank = 100 - intval($selisih_poin_konversi*($rank_peserta-$jumlah_peserta_terbaik));
			if($hasil_konversi_rank<10) $hasil_konversi_rank = 10;
		}


		// echo "
		// <hr>
		// <br> total_player: $total_player
		// <br> jumlah_player_in_prodi: $jumlah_player_in_prodi
		// <br> jumlah_player_in_kelas: $jumlah_player_in_kelas
		// <br>
		// <br> rank_player: $rank_player
		// <br> rank_player_in_kelas: $rank_player_in_kelas
		// <br> rank_player_in_prodi: $rank_player_in_prodi
		// <br>
		// <br> rank_peserta: $rank_peserta
		// <br> total_peserta: $total_peserta
		// <br> jumlah_peserta_terbaik: $jumlah_peserta_terbaik
		// <br> hasil_konversi_rank: $hasil_konversi_rank
		// <br>
		// <br> selisih_poin_konversi: $selisih_poin_konversi
		// <hr> 
		// ";

		$is_pekan_uas = strtotime($tanggal_p9)>strtotime($tanggal_skg) ? 0 : 1;
		$selisih_hari = $is_pekan_uas ? 0 : intval((strtotime($tanggal_p9)-strtotime($tanggal_skg))/(60*60*24));

		$pekan_show = $is_pekan_uas ? "Saat ini Pertemuan ke-$total_presensi_saat_ini dan sudah memasuki Pekan UAS." : "Saat ini Pertemuan ke-$total_presensi_saat_ini dan masih pekan UTS. Pekan UAS (P09) dalam $selisih_hari hari lagi.";

		$rbobot = $is_pekan_uas ? explode(',', '10,10,10,10,10,10,10,10,20') : explode(',', '10,10,10,10,10,10,10,0,30');

		function set_link($a,$b){
			return "<a href='?$a' class='link_zoom'>$b <img class='img_zoom' src='assets/img/icons/goto.png' height='25px' /></a>";
		}

		$yang_dinilai = [
			set_link('presensi', 'Presensi QWars'),
			'Daily Login',
			set_link('myq', 'Invest Soal'),
			set_link('kuis', 'Play Kuis'),
			set_link('chal', 'Chalenge Wajib'),
			set_link('chal', 'Chalenge Point'),
			'UTS-BAAK',
			'UAS-BAAK',
			set_link('rank_kelas', 'Rank Kelas')
		];

		$rerata_chal_point = intval($total_chal_point/$total_player);
		$max_chal_point = 100; //zzz debug
		if($cid_room==26) $max_chal_point = 2535000; //zzz debug
		if($cid_room==35) $max_chal_point = 210000; //zzz debug

		$kkm_chal_point_v2 = intval(0.5*($max_chal_point-$rerata_chal_point) + $rerata_chal_point);

		$rerata_play_kuis = $total_aktif_player==0?0:round($total_play_kuis/$total_aktif_player,0);
		//echo "debugging: total_play_kuis:$total_play_kuis total_aktif_player:$total_aktif_player  rerata_play_kuis:$rerata_play_kuis ";


		$presensi_qwars = $jumlah_presensi;
		$daily_login = $jumlah_daily_login;
		$invest_soal = $jumlah_soal_publish;
		$play_kuis = $jumlah_play;
		$chalenge_wajib = $jumlah_chal;
		$chal_point = intval($my_chal_point);
		$uts_baak = $uts_baak;
		$uas_baak = $uas_baak;
		$rank_kelas = $rank_peserta;

		$kkm_presensi_qwars = $total_presensi_saat_ini; 
		$kkm_daily_login = $kkm_presensi_qwars * $min_daily_login;
		$kkm_invest_soal = $kkm_presensi_qwars * $min_buat_soal;
		$kkm_play_kuis = "$rerata_play_kuis (rata-rata Play Kuis)";
		$kkm_chal_wajib = $kkm_presensi_qwars;
		$kkm_chal_point = "$kkm_chal_point_v2 ~ Max: $max_chal_point";
		$kkm_uts_baak = 100;
		$kkm_uas_baak = 100;
		$kkm_rank = "$jumlah_peserta_terbaik rank terbaik";

		if($kkm_chal_point==0) $kkm_chal_point=1;
		if($kkm_presensi_qwars==0) $kkm_presensi_qwars=1;
		if($kkm_daily_login==0) $kkm_daily_login=1;
		if($kkm_invest_soal==0) $kkm_invest_soal=1;
		if($kkm_chal_wajib==0) $kkm_chal_wajib=1;

		$nilai_kamu = [$presensi_qwars, $daily_login, $invest_soal, $play_kuis, $chalenge_wajib, $chal_point, $uts_baak, $uas_baak, $rank_kelas];

		$kkm = [$kkm_presensi_qwars, $kkm_daily_login, $kkm_invest_soal, $kkm_play_kuis, $kkm_chal_wajib, $kkm_chal_point, $kkm_uts_baak, $kkm_uas_baak, $kkm_rank];


		$hasil_konversi_presensi_qwars = round($presensi_qwars/$kkm_presensi_qwars*100,0);
		$hasil_konversi_daily_login = round($daily_login/$kkm_daily_login*100,0);
		$hasil_konversi_invest_soal = round($invest_soal/$kkm_invest_soal*100,0);
		$hasil_konversi_play_kuis = $rerata_play_kuis==0?0:round($play_kuis/$rerata_play_kuis*100,0);
		$hasil_konversi_chal_wajib = round($chalenge_wajib/$kkm_chal_wajib*100,0);
		$hasil_konversi_chal_point = round($chal_point/$kkm_chal_point_v2*100,0);
		$hasil_konversi_uts_baak = $uts_baak;
		$hasil_konversi_uas_baak = $uas_baak * $is_pekan_uas;




		if($hasil_konversi_presensi_qwars>100) $hasil_konversi_presensi_qwars=100;
		if($hasil_konversi_daily_login>100) $hasil_konversi_daily_login=100;
		if($hasil_konversi_invest_soal>100) $hasil_konversi_invest_soal=100;
		if($hasil_konversi_play_kuis>100) $hasil_konversi_play_kuis=100;
		if($hasil_konversi_chal_wajib>100) $hasil_konversi_chal_wajib=100;
		if($hasil_konversi_chal_point>100) $hasil_konversi_chal_point=100;


		$hasil_konversi = [$hasil_konversi_presensi_qwars, $hasil_konversi_daily_login, $hasil_konversi_invest_soal, $hasil_konversi_play_kuis, $hasil_konversi_chal_wajib, $hasil_konversi_chal_point, $hasil_konversi_uts_baak, $hasil_konversi_uas_baak, $hasil_konversi_rank];

		$nilai_akhir=0;
		for ($i=0; $i < count($yang_dinilai); $i++){
			$icon[$i] = 'warning';
			$bg_row[$i] = '#FFC2C2,#FC8888';
			if($hasil_konversi[$i]==100){$icon[$i]='check_green';$bg_row[$i]='#DDFFE2,#86FF97';}else 
			if($hasil_konversi[$i]>=85){$icon[$i]='check_pink';$bg_row[$i]='#FFFFFF,#95F5FB';}else 
			if($hasil_konversi[$i]>=70){$icon[$i]='check_brown';$bg_row[$i]='#FFFff5,#F6D93B';}
			$nilai_akhir+=$hasil_konversi[$i];
		}
		$nilai_akhir = round($nilai_akhir/(count($yang_dinilai)-1+$is_pekan_uas),2);

		if($nilai_akhir>=85){
			$nilai_hm='A';
			$congra='Selamat!! Estimasi Kamu mendapat nilai:';
			$warna_nilai_akhir = '#D3FFDA';
			$bg_nilai_akhir = 'success';
		}else if($nilai_akhir>=70){
			$nilai_hm='B';
			$congra='Selamat!! Estimasi Kamu mendapat nilai:';
			$warna_nilai_akhir = '#3BFF93';
			$bg_nilai_akhir = 'success';
		}else if($nilai_akhir>=60){
			$nilai_hm='C';
			$congra='Estimasi Kamu mendapat nilai:';
			$warna_nilai_akhir = '#FEEC87';
			$bg_nilai_akhir = 'warning';
		}else if($nilai_akhir>=40){
			$nilai_hm='D';
			$congra='Estimasi Nilai kamu:';
			$warna_nilai_akhir = '#f88';
			$bg_nilai_akhir = 'danger';
		}else{
			$nilai_hm='E';
			$congra='Estimasi Nilai kamu:';
			$warna_nilai_akhir = '#f88';
			$bg_nilai_akhir = 'danger';
		}








	 	?>

	 	<div style="border:solid 1px #aaa; border-radius: 10px; padding: 10px; margin-bottom:10px; text-align: center; background:linear-gradient(#5a5,#333);">
	 		<?=$pekan_show ?>
	 		<!-- <span style="font-size:16pt">Pertemuan ke-6: <span id="nama_subject_skg">P06 Single Page Application</span></span> -->
	 		
	 	</div>

	 	<div style="border:solid 1px #aaa; border-radius: 10px; padding: 15px; margin-bottom: 10px">
	 		<h4 class="text-center">Halo <?=$cnama_player ?>!</h4>
	 		<p class="text-center">
	 			<?=$congra?><br>
	 			<span style="font-size:80px; font-weight: bold;color: <?=$warna_nilai_akhir ?>;"><?=$nilai_hm?></span><br>
	 			<span class="badge badge-<?=$bg_nilai_akhir?>" style="font-size:20px;margin-top: 10px;"><?=$nilai_akhir?></span>			</p>
	 	</div>
	
	 	<style>.icon_konversi{ box-shadows: 0 0 3px black; }</style>
	 	<table class="table table-bordered table-hover table-striped">
	 		<tr>
	 			<td>No</td>
	 			<td width="60%">Penilaian</td>
	 			<td>Bobot</td>
	 			<td>Hasil Konversi</td>
	 		</tr>

	 		<?php for ($i=0; $i < count($yang_dinilai) ; $i++){
	 			$j = $i+1;
	 			switch($j){
	 				case 1: $nilai_kamu_show = "Kamu sudah $nilai_kamu[$i]x presensi"; break;
	 				case 2: $nilai_kamu_show = "Kamu sudah $nilai_kamu[$i]x daily login. Jika kamu login setiap hari maka daily login akan terus bertambah."; break;
	 				case 3: $nilai_kamu_show = "Kamu punya $nilai_kamu[$i] published soal. Tiap peserta wajib buat minimal $min_buat_soal soal x $total_presensi_saat_ini pertemuan."; break;
	 				case 4: $nilai_kamu_show = "Kamu sudah $nilai_kamu[$i] kali menjawab soal. Ketuntasan minimal berdasarkan rata-rata Play Kuis seluruh Player Aktif."; break;
	 				case 5: $nilai_kamu_show = "Kamu mengerjakan $nilai_kamu[$i] challenge. Jika total challenge kurang dari $kkm_chal_wajib, maka mintalah kepada dosen kamu untuk menambahkannya!"; break;
	 				case 6: $nilai_kamu_show = "Challenge Point kamu: $nilai_kamu[$i] LP.  Ketuntasan minimal adalah kuartil-3 dari Challenge Point Terbesar."; break;
	 				case 7: $nilai_kamu_show = "Nilai UTS BAAK: $nilai_kamu[$i]"; break;
	 				case 8: $nilai_kamu_show = "Nilai UAS BAAK: $nilai_kamu[$i]"; break;
	 				case 9: 
	 					$nilai_kamu_show = "Kamu berada di urutan ke-$nilai_kamu[$i]"; 
	 					if($nilai_kamu[$i]=='') $nilai_kamu_show = "Kamu tanpa peringkat. Segera lapor ke GM!"; 
	 					break;
	 				default: die("Switch yang dinilai undefined.");
	 			}
	 			echo "
	 			<tr style='background: linear-gradient($bg_row[$i])'>
	 				<td>$j</td>
	 				<td>
	 					<div class='yang_dinilai'>$yang_dinilai[$i]</div>
	 					<div class='nilai_kamu'>$nilai_kamu_show</div>
	 					<small>KKM: $kkm[$i]</small>
	 				</td>
	 				<td>$rbobot[$i]%</td>
	 				<td>$hasil_konversi[$i] <img class='icon_konversi' src='assets/img/icons/$icon[$i].png' height='25px'></td>
	 			</tr>

	 			";
	 		}
	 		?>

	 	</table>

	 	<div class="hideit">
	 		<form action="pdf/report_card.php" method="post" target="_blank">
	 			<input type="hiddena" name="last_id_room_subject" value="45">
	 			<button class="btn btn-primary">Print Report Card</button>
	 		</form>
	 	</div>

	 	<style>#konversi_nilai table { background: linear-gradient(#ccffffaa,#ffffccdd); }</style>






	</div>
</section>





