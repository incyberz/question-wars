<div id="blok_play">
	<div class="debug blok_debug">
		<input id="list_unplayed_questions" value="<?=$list_unplayed_questions?>">
		rows_point<input size="4" id="rows_point" placeholder="rows_point">
		<input size="1" id="jawaban_terpilih" placeholder="jawaban_terpilih">
		seharusnya<input size="1" id="jawaban_seharusnya" placeholder="jawaban_seharusnya">
		id_soal<input size="5" id="id_soal" placeholder="id_soal">
		id_room_subject<input size="5" id="id_room_subject" value="<?=$id_room_subject?>">
		no_soal<input size="5" id="no_soal" value="0">
		durasi_jawab<input size="5" id="durasi_jawab">
		alasan_reject<input size="5" id="alasan_reject">
		confirm_reject<input size="5" id="confirm_reject">
		mode_kuis<input size="5" id="mode_kuis" value="1">1=read, 2=click-opsi 3=klik-benar
	</div>
	<div class="blok_tampil_soal">
		<div class="header_soal">
			<div class="header_soal_left">
				<?=$profiles?>
			</div>
			<div class="header_soal_right">
				<div class="blok_room_subject">Kuis <span class="nama_subject"><?=$nama_subject?></span></div>
				<!-- ======================================= -->
				<!-- PROGRESS BAR 20 SOAL -->
				<!-- ======================================= -->
				<div class="blok_progres_kuis">
					<div id="progress__1" class="filled"></div>
					<div id="progress__2"></div>
					<div id="progress__3"></div>
					<div id="progress__4"></div>
					<div id="progress__5"></div>
					<div id="progress__6"></div>
					<div id="progress__7"></div>
					<div id="progress__8"></div>
					<div id="progress__9"></div>
					<div id="progress__10"></div>
					<div id="progress__11"></div>
					<div id="progress__12"></div>
					<div id="progress__13"></div>
					<div id="progress__14"></div>
					<div id="progress__15"></div>
					<div id="progress__16"></div>
					<div id="progress__17"></div>
					<div id="progress__18"></div>
					<div id="progress__19"></div>
					<div id="progress__20"></div>
				</div>
			
				<!-- ======================================= -->
				<!-- INFO SOAL -->
				<!-- ======================================= -->
				<div class="blok_soal_info">
					<div class="blok_soal_by">
						by: 
						<a id="link_about_creator" href="#" target="_blank">
							<span id="nama_creator">nama_creator</span>
						</a>
					</div>
					<div class="blok_badge_soal">
						<!-- <?=$img_medal ?> -->
						<span class="badge badge_soal badge-success" id="jumlah_dijawab_benar">0</span> 
						<span class="badge badge_soal badge-warning" id="jumlah_dijawab_salah">0</span> 
						<span class="badge badge_soal badge-danger" id="jumlah_rejecter">0</span> 
					</div>
				</div>
			</div>
		</div>



		<div class="body_soal">


			<!-- ======================================= -->
			<!-- STATUS SOAL DAN KALIMAT SOAL -->
			<!-- ======================================= -->
			<div id="status_soal" class="debug">status_soal</div>
			<div id="status_soal_show">status_soal_show</div>
			<div id="kalimat_soal">kalimat_soal</div>




			<!-- ======================================= -->
			<!-- OPSI SOAL -->
			<!-- ======================================= -->
			<div class="blok_opsies">
				<div class="blok_opsi" id="blok_opsi__a">
					<div>a</div>
					<div id="opsi_a">opsi_a</div>
				</div>
				<div class="blok_opsi" id="blok_opsi__b">
					<div>b</div>
					<div id="opsi_b">opsi_b</div>
				</div>
				<div class="blok_opsi" id="blok_opsi__c">
					<div>c</div>
					<div id="opsi_c">opsi_c</div>
				</div>
				<div class="blok_opsi" id="blok_opsi__d">
					<div>d</div>
					<div id="opsi_d">opsi_d</div>
				</div>
			</div>
		</div>




		<!-- ======================================= -->
		<!-- TIMER COUNTDOWN -->
		<!-- ======================================= -->
		<div id="sisa_waktu">
			5
		</div>

		<!-- ======================================= -->
		<!-- ANDA BENAR -->
		<!-- ======================================= -->
		<div class="hasil_kuis" id="anda_benar">
			Anda Benar
		</div>

		<!-- ======================================= -->
		<!-- ANDA SALAH -->
		<!-- ======================================= -->
		<div class="hasil_kuis" id="anda_salah">
			Anda Salah
		</div>

		<!-- ======================================= -->
		<!-- ANDA TIMED OUT -->
		<!-- ======================================= -->
		<div class="hasil_kuis" id="anda_timed_out">
			Anda Timed Out
		</div>

		<!-- ======================================= -->
		<!-- EARNED POINTS -->
		<!-- ======================================= -->
		<style>
			#blok_earned_points{
				margin-bottom: 10px;
			}
			#blok_earned_points #your_point_box{
				width: 50%;
				text-align: right;
				padding-right: 10px;
				border-right: solid 1px #ccc;
				font-size: small;
			}
			#blok_earned_points #creator_point_box{
				width: 50%;
				padding-left: 10px;
				font-size: small;
			}
		</style>
		<div class="hasil_kuis" id="blok_earned_points">
			<div class="row">
				<div class="col-6" id="your_point_box">
					Your point: <span id="your_point"></span> LP
				</div>
				<div class="col-6" id="creator_point_box">
					Creator point: <span id="creator_point"></span> LP
				</div>
			</div>
		</div>



		


		<!-- ========================================= -->
		<!-- MANAGE HASIL KUIS -->
		<!-- ========================================= -->
		<div>
			<div class="row">


				


				<!-- ========================================= -->
				<!-- REJECT ATAU JAWAB -->
				<!-- ========================================= -->
				<div class="col-6">
					<button class="btn btn-danger btn-block btn_aksi first_enabled" id="aksi__reject">Reject</button>				
				</div>
				<div class="col-6">
					<button class="btn btn-success btn-block btn_aksi first_disabled" id="aksi__jawab">Jawab</button>				
				</div>


				<!-- ========================================= -->
				<!-- ALASAN REJECT -->
				<!-- ========================================= -->
				<div class="col-12 blok_alasan_reject">
					<!-- <p>Alasan Reject:</p> -->
					<small>Rejecter akan menerima 20LP + 20%EP saat sudah ada 5 orang yang mereject soal tersebut.</small>
					<div class="radio-toolbar">
						<div class="row">
							<?=$alasan_rejects?>
							<div class="col-12 hideit blok_confirm_reject">
								<button class="btn btn-danger btn-block btn_aksi" id="aksi__confirm_reject">Confirm Reject</button>
							</div>
						</div>
					</div>
					<small><span style="color: red"><b>Perhatian!</b></span> Jika Anda me-reject soal yang benar, maka Anda akan mendapatkan poin negatif.</small>
				</div>
				


				


				<!-- ========================================= -->
				<!-- HASIL REJECT -->
				<!-- ========================================= -->
				<div class="col-12 blok_hasil_reject">blok_hasil_reject</div>

				



				
				<!-- ========================================= -->
				<!-- NEXT PLAY -->
				<!-- ========================================= -->
				<div class="col-12 blok_next_play">
					<button class="btn btn-primary btn-block btn_aksi" id="aksi__next_play">Next Play</button>
				</div>

				

				<!-- ========================================= -->
				<!-- RATE DESIGN -->
				<!-- ========================================= -->
				<div class="col-12">
					<div class="blok_rate_soal">
						<div class="row">
							<div class="col-1"><span id="user_rated" class="debug"></span></div>
							<?php for ($i=1; $i <= 5 ; $i++) echo "
							<div class='col-2'>
								<img class='img_rate' id='img_rate__$i' src='assets/img/icons/stars.png'>
							</div>
							"; ?>
						</div>
						<?php for ($i=0; $i <5 ; $i++) echo "
						<div class='ket_rate' id='ket_rate__".($i+1)."'>$rket_rate[$i]</div>
						";?>
						
						
					</div>
				</div>



			</div>
		</div>
	</div>
</div>