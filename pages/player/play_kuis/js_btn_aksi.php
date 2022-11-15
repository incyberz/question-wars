<script>
	// =========================================
	// TAHAPAN KUIS
	// =========================================
	// A. PREPARING TO ANSWER 20 SOAL: READY | NOT
	// B. READY
	//    1.  TAMPILAN AWAL
	//    2.1 USER KLIK OPSI JAWAB
	//    2.2 USER KLIK TOMBOL JAWAB >> KELUAR HASIL
	//    3.  ACCEPT POINTS >> NEXT PLAY
	// 
	// 
	//    3.1 USER KLIK REJECT
	//    3.2 USER KLIK ALASAN
	//    3.3 KONFIRMASI REJECT >> NEXT PLAY
	// 
	// =========================================

	$(document).ready(function(){
		// =========================================
		// AKSI-AKSI BUTTON
		// =========================================
		$('.btn_aksi').click(function(){
			let tid = $(this).prop('id');
			let rid = tid.split('__');
			let aksi = rid[1];
			let capt = $(this).text();

			// alert(`aksi: ${aksi} is ready!`);


			// =========================================
			// REJECT SOAL
			// =========================================
			if(aksi=='reject'){
				$('.blok_alasan_reject').slideToggle();
				$('#aksi__jawab').slideToggle();
				if($('#mode_kuis').val()==3){
					$('.blok_next_play').slideToggle();
					$('.blok_rate_soal').slideToggle();
				}
				let new_capt = capt=='Reject' ? 'Cancel Reject' : 'Reject';
				$(this).text(new_capt);
			}



			// =========================================
			// KONFIRMASI REJECT
			// =========================================
			if(aksi=='confirm_reject'){

				let alasan_reject = $('#alasan_reject').val();
				// alert(alasan_reject);
				if(alasan_reject==''){
					alert('Alasan reject belum terpilih.')
					return;
				}


				// =========================================
				// REJECT SAVE-TO-DB 
				// =========================================
				let id_soal = $('#id_soal').val();
				let id_alasan = $('#alasan_reject').val();

				let link_ajax = `jx/jx_reject_soal_kuis.php
				?id_soal=${id_soal}
				&id_alasan=${id_alasan}
				`;
				// alert(link_ajax);
				$.ajax({
					url:link_ajax,
					success:function(z){
						// alert(z);
						let rz = z.split(',');
						let a=rz[0];
						let player_point = parseInt(rz[1]);
						let creator_point = parseInt(rz[2]);
						let jumlah_rejecter = parseInt(rz[3]);
						let reject_point = parseInt(rz[4]);

						if(a.trim()=='sukses'){
							// alert(`reply sukses:: player_point:${player_point} creator_point:${creator_point} jumlah_rejecter:${jumlah_rejecter}`);


							// =========================================
							// ROLLBACK EARNED POINTS 
							// =========================================
							// $('#blok_earned_points').slideUp();

							reject_info = `<div>Reject sukses!</div><small>Your point ${player_point} rollbacked | Creator point ${creator_point} rollbacked.</small>`;

							if(jumlah_rejecter>=5){
								reject_info += `<div>Soal sudah terkena banned.</div><div>Reject poin buat kamu: ${reject_point} LP (20% EP Creator)</div> `;
							}else{
								reject_info += `<div>Dibutuhkan ${5-jumlah_rejecter} rejecter lagi agar soal terkena banned.</div>`;
							}

							let my_point = parseInt($('#room_player_point_atheader').text());
							my_point -= player_point;
							my_point += reject_point;
							$('#room_player_point_atheader').text(my_point);


							$('.blok_hasil_reject').html(reject_info);



							$('.blok_alasan_reject').slideUp();
							$('.blok_rate_soal').slideUp();
							$('#aksi__jawab').slideDown();
							$('#aksi__reject').text('Reject');
							$('.blok_hasil_reject').slideDown();
							$('#aksi__reject').prop('disabled',true);
							$('#aksi__jawab').prop('disabled',true);
							$('#confirm_reject').val(1);
							// $('#aksi__next_play').slideDown();
							$('.blok_next_play').slideDown();
							console.log('$(#aksi__next_play).slideDown();')

							let audio = new Audio(`assets/audio/reject.mp3`);
							audio.play();

						}else{
							alert('error reject soal. '+z);
						} // END IF
					} // END SUCCESS AJAX
				}) // END AJAX
			}
			// END CONFIRM REJECT
			// =========================================


			// =========================================
			// JAWAB SOAL
			// =========================================
			if(aksi=='jawab'){

				cek_jawaban();

			}




			// =========================================
			// NEXT PLAY
			// =========================================
			if(aksi=='next_play'){
				// let yakin = confirm('Ready to')
				let audio = new Audio(`assets/audio/toggle.mp3`);
				audio.play();

				let user_rated = $('#user_rated').text();
				let confirm_reject = parseInt($('#confirm_reject').val());
				let status_soal = parseInt($('#status_soal').text());

				// if(user_rated=='' && confirm_reject==''){
				// 	alert('Mohon berikan penilaian dahulu pada soal ini!');
				// 	return;
				// }else{
				// 	next_soal();
				// }

				if(!confirm_reject && status_soal==0) auto_verified_soal();
				next_soal();
			}
		})


		$('.alasan_reject').click(function(){

			let tid = $(this).prop('id');
			let rid = tid.split("__");
			let alasan_reject = rid[1];
			$('#alasan_reject').val(alasan_reject);
			console.log('alasan_reject.click alasan_reject:alasan_reject')

			$('.blok_confirm_reject').slideDown();
			
		})

	})
</script>