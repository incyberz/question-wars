<style>
	#tb_prop_subroom td {
		padding: 2px 15px 2px 5px;
	}

	.pertanyaan{
		color: yellow;
		font-size: 20px;
		font-family: 'century gothic';
	}
</style>




<section id="presensi_feedback" class="player hideit">
	<div class="container">

		<h3>Feedback Pembelajaran :: <small><span id="td_nama_subject">{Nama Room Subjects}</span></small></h3>
		<a href="#presensi" class=" scrollto" id="btn_back_to_list_presensi">Back to List Presensi</a>				

		<div style="margin-top:25px;border: solid 1px #aaa;padding: 15px;border-radius: 10px;">
			<p>Isilah feedback untuk GM agar kualitas pembelajaran menjadi lebih baik!</p>

			<form method="post">
				<input type="hidden" id="id_room_subject_selected" name="id_room_subject_selected">

				<div style="border: solid 1px #aaa;padding: 10px;border-radius: 5px; background:linear-gradient(#111111,#114411); margin-bottom: 25px; font-size: small;">
					<div class="row">
						<div class="col-lg-6">
							<table width="" id="tb_prop_subroom">
								<tr><td>Tanggal Sekarang</td><td id="td_date_now">$date_now</td></tr>
								<tr><td>Tanggal Jadwal Kuliah</td><td id="td_date_jadwal">$date_jadwal</td></tr>
								<tr><td>Tanggal Pembukaan Presensi</td><td id="td_date_open">$date_open</td></tr>
								<tr><td>Tanggal Penutupan Presensi</td><td id="td_date_close">$date_close</td></tr>
							</table>
						</div>
						<div class="col-lg-6">
							<table width="" id="tb_prop_subroom">
								<tr><td>Soal yang kamu buat di sub-room</td><td><span id="td_jumlah_soal">?</span> questions</td></tr>
								<tr><td>Learning Point saat ini</td><td><span id="td_poin"><?=$global_point?></span> LP</td></tr>
								<tr><td>Room Rank</td><td><span id="td_rank"><?=$rank_player?></span> dari <?=$total_player?> players</td></tr>
								<tr><td colspan="2"><small><i>Data ini akan tersimpan saat kamu submit presensi</i></small></td></tr>
							</table>
						</div>
						
					</div>
				</div>

				

				<div class="wadah">
					<div class="form-group">
						<label class="pertanyaan">Apakah kamu ada kesulitan saat memakai QWars?</label>
						<div class="radio-toolbar">
							<div class="row">
								<div class="col-6">
									<input type="radio" name="is_kesulitan" id="is_kesulitan__1" class="is_kesulitan" required="" value="1">
									<label for="is_kesulitan__1">Ya, ada.</label>
								</div>
								<div class="col-6">
									<input type="radio" name="is_kesulitan" id="is_kesulitan__0" class="is_kesulitan" required="" value="0">
									<label for="is_kesulitan__0">Engga. Lancar-lancar saja!</label>
									<input class="debug" name="kesulitan_ket2" id="kesulitan_ket2">
								</div>
								<div class="col-12">
									Jika ya, pada hal apa?
									<input type="text" class="form-control" name="kesulitan_ket" id="kesulitan_ket" required="">
								</div>
							</div>							
						</div>
					</div>
				</div>

				<div class="form-group wadah">
					<!-- <label class="pertanyaan">Apakah kamu termotivasi untuk terus belajar dirumah saat gunain QWars?</label> -->
					<label class="pertanyaan">Saat ini masihkan kamu termotivasi dg adanya QWars?</label>
					<div class="radio-toolbar">
						<div class="row">
							<div class="col-lg-3">
								<input type="radio" name="is_termotivasi" id="is_termotivasi__1" required="" value="0">
								<label for="is_termotivasi__1">Engga</label>
							</div>
							<div class="col-lg-3">
								<input type="radio" name="is_termotivasi" id="is_termotivasi__2" required="" value="1">
								<label for="is_termotivasi__2">Dikit aja</label>
							</div>
							<div class="col-lg-3">
								<input type="radio" name="is_termotivasi" id="is_termotivasi__3" required="" value="2">
								<label for="is_termotivasi__3">Termotivasi</label>
							</div>
							<div class="col-lg-3">
								<input type="radio" name="is_termotivasi" id="is_termotivasi__4" required="" value="3">
								<label for="is_termotivasi__4">Sangat Bangetz</label>
							</div>
							
						</div>
						
					</div>
				</div>


				<!-- <div class="form-group wadah">
					<label class="pertanyaan">Saat sesi "<span id="td_nama_subject2">{Nama Room Subjects}</span>", kamu dapet ilmu apa?</label>
					<div class="row">
						<div class="col-lg-9">
							<textarea class="form-control" rows="6" required="" name="kesan_ilmu"></textarea>
						</div>
						<div class="col-lg-3">
							<small>
								<strong>Contoh</strong>:
								<ul>
									<li>Wahh... jadi tau cara ngoding HTML nih!</li>
									<li>Ilmu CSS nya mantaf!</li>
									<li>Aku bisa ngoding JS, hore!!</li>
									<li>Keren, aku jadi punya web online pribadi!</li>
								</ul>
							</small>
						</div>
					</div>
				</div> -->
				<input type="hidden" name="kesan_ilmu" value="-">

				<!-- <div class="form-group wadah">
					<label class="pertanyaan">Masukan | saran | kritik dari kamu tentang GM | QWars App?</label>
					<div class="row">
						<div class="col-lg-9">
							<textarea class="form-control" rows="6" required="" name="masukan_saran"></textarea>
						</div>
						<div class="col-lg-3">
							<small>
								<strong>Contoh</strong>:
								<ul>
									<li>Pak, gmn kalo ditambahin fitur chat antar player?</li>
									<li>Liat leaderboard bikin semangat nge-Push Rank :)</li>
									<li>Dosennya neranginnya ga jelas :(</li>
									<li>Pa, aplikasinya di Playstore-in donk!!</li>
								</ul>
							</small>
						</div>
					</div>
				</div> -->
				<input type="hidden" name="masukan_saran" value="-">



				<button class="btn btn-primary btn-sm scrollto" id="btn_submit_presensi" name="btn_submit_presensi">Submit Presensi</button> <a href="#presensi" class="btn btn-success btn-sm scrollto" id="btn_back_to_list_presensi">Back to List Presensi</a>			
			</form>
		</div>

	</div>
</section>





















<script type="text/javascript">
	$(document).ready(function(){
		$("#kesulitan_ket").keyup(function(){
			$("#kesulitan_ket2").val($("#kesulitan_ket").val());

		})

		$(".is_kesulitan").click(function(){
			var id = $(this).prop("id");
			if(id=="is_kesulitan__1"){
				$("#kesulitan_ket").prop("disabled",false); 
				$("#kesulitan_ket").val("");
				$("#kesulitan_ket2").val("");
				$("#kesulitan_ket").focus();

			}else{
				$("#kesulitan_ket").prop("disabled",true); 
				$("#kesulitan_ket").val("-");
				$("#kesulitan_ket2").val("-");
			}
		})
	})
</script>