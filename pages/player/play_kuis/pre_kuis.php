<section id="pre_kuis" class="player">
	<div class="container">
		<div class="blok_kuis">
			<?php
            $hints_for_gm = '';

			include 'kuis_styles.php';
			?>
			<div id="blok_not_ready_to_play" class="hideita text-center">
				<h3 class="text-center">Beat Your Friend's Questions</h3>
				<br>

				<?php

			    # ================================================
			    # GET UNPLAYED QUESTIONS
			    # ================================================
			    $s = "
				SELECT a.id_room_subject, a.nama_subject,  
				(
					SELECT count(1) from tb_soal s 
					join tb_room_subject rs on s.id_room_subject = rs.id_room_subject 

					left join tb_soal_playedby sp 
					on s.id_soal = sp.id_soal and sp.nickname = '$cnickname' 

					WHERE rs.id_room = '$cid_room' 
					and s.soal_creator != '$cnickname' 
					and sp.id_soal is null 
					and s.is_banned is null 
					and s.visibility_soal=1 
					and rs.id_room_subject=a.id_room_subject 
					) as jumlah_unplayed_room				

				FROM tb_room_subject a 
				WHERE a.id_room = '$cid_room' 
				AND a.nama_subject NOT LIKE '%materi umum%'
				";

			// die($s);

			$q = mysqli_query($cn, $s) or die("Error pre_kuis. ".mysqli_error($cn));
			$opt = '';
			$is_available = 0;
			while ($d = mysqli_fetch_assoc($q)) {
			    $id_room_subject = $d['id_room_subject'];
			    $nama_subject = $d['nama_subject'];
			    $jumlah_unplayed_room = $d['jumlah_unplayed_room'];

			    if ($jumlah_unplayed_room>=20) {
			        $opt .= "<option value='$id_room_subject'>$nama_subject</option>";
			        $is_available=1;
			    }
			}



			$disabled_ready_to_play = " disabled ";
			$btn_ready_to_play_ket_hide_style = '';
			$sty_soal_habis = '';
			$sty_soal_available = "display:none";

			if ($is_available) {
			    $disabled_ready_to_play = '';
			    $btn_ready_to_play_ket_hide_style = "hideit";
			    $sty_soal_habis = "display:none";
			    $sty_soal_available = '';
			}
			?>
				<div id="pengantar_soal_habis" style="<?=$sty_soal_habis?>">
					<p>Ooppsss...</p>
					<img id='img_play_kuis' src='assets/img/soal_habis.png' height='150px' style='margin: 15px'>
				</div>
				<div id="pengantar_soal_available" style="<?=$sty_soal_available?>">
					<p>Read carefully your friend's question then You can:</p>
					<img id='img_play_kuis' src='assets/img/answer_or_reject.png' height='150px' style='margin: 15px'>
				</div>
				<?=$hints_for_gm?>

				<!-- ====================================== -->
				<!-- SELECT SESI -->
				<!-- ====================================== -->
				<div style='margin: 10px 0'>
					<?php
			        $status_room=1; //zzz debug

			if ($status_room==1) {
			    echo "
						<select class='form-control input-sm' id='id_room_subject' $disabled_ready_to_play>
						<option value='0'>--Pilih Sesi MK--</option>
						$opt
						</select>";
			} else {
			    echo '<div class="alert alert-danger">Maaf, tidak bisa Play Kuis karena Room ini sudah berakhir.</div>';
			}
			?>
					<p class="ket_select" class="hideit">Sebanyak 20 soal pada sesi ini akan di-load untuk Paket Soal kamu. Pastikan koneksi internet lancar dan jangan melakukan refresh saat mengerjakan soal!</p>
					<!-- <p class="alert alert-danger" style="color:red">Mohon maaf kawan-kawan!! Untuk saat ini Fitur Play Kuis belum bisa dimainkan, karena dibanned oleh rumah-web dg alasan too many request, nantikan fitur Play Kuis Offline per Paket Soal!</p> -->
					<button id="btn_ready_to_play" class="btn-primary btn-block tombol" disabled="" style="margin-top:10px">Ready to Play!</button>
					<p class="ket_select"><span class="red">Perhatian!</span> Soal yang telah ter-reload tidak dapat dikerjakan ulang!</p>


				</div>



				<!-- =================================================== -->
				<!-- TIDAK ADA SOAL  -->
				<!-- =================================================== -->
				<small id="btn_ready_to_play_ket" class="<?=$btn_ready_to_play_ket_hide_style?>">
					Wah maaf, <span style="color: yellom; font-weight: bold">soal kawanmu belum bisa dimainkan</span>. Minimal 20 soal kawanmu pada tiap sesi kuliah agar kamu bisa Play Kuis. <br>
					<a href="?myq" class="btn btn-primary btn-sm" style="margin: 0 10px">Buat Soal</a>
				</small>
			</div>
		</div>
	</div>
</section>


<script>
	$(document).ready(function(){

		$('#id_room_subject').change(function(){
			if($(this).val()=='0'){
				$('#btn_ready_to_play').prop('disabled',true);
				$('.ket_select').slideUp();
			}else{
				$('#btn_ready_to_play').prop('disabled',false);
				$('.ket_select').slideDown();
			}
		})

		$('#btn_ready_to_play').click(function(){
			let id_room_subject = $('#id_room_subject').val();
			if(id_room_subject != '0'){


				location.replace(`?play_kuis&id_room_subject=${id_room_subject}`);
			}
		})
	})
</script>