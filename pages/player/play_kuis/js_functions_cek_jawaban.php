<script type="text/javascript">
	
	function cek_jawaban(){


		$('#mode_kuis').val(3);

		let jawaban_terpilih = $('#jawaban_terpilih').val();
		let id_room_subject = $('#id_room_subject').val();
		let id_soal = $('#id_soal').val();
		let sisa_waktu = 0; // zzz debug
		let rows_point = 0; // zzz debug

		let link_ajax = `jx/jx_cek_jawaban_kuis.php
		?id_soal=${id_soal}
		&jawaban=${jawaban_terpilih}
		&id_room_subject=${id_room_subject}
		&sisa_waktu=${sisa_waktu}
		&rows_point=${rows_point}
		`;
		// console.log(`function cek_jawaban() link_ajax: ${link_ajax}`);

		$.ajax({
			url: link_ajax,
			success: function(z){
				let rz = z.split(',');
				a = rz[0].trim(); // sukses / failed
				b = rz[1].trim(); // benar / salah / timed_out



				if(a=='sukses'){
					if(b=='benar'){
						set_tampilan_benar();

					}else if(b=='salah'){
						let ra = b.split('__');
						$('#jawaban_seharusnya').val(rz[2]);
						// alert('salah')
						set_tampilan_salah();
					}else if(b=='timed_out'){
						let ra = b.split('__');
						$('#jawaban_seharusnya').val(rz[2]);
						// alert('salah')
						set_tampilan_timed_out();

					}

					$('#blok_earned_points').slideDown();

					// sukses,$is_benarz,$jawaban_db,$player_point,$creator_point,$rows_point,$new_room_player_point,$new_my_point";
					// 0  		 1          2           3             4              5           6                      7
					
					$('#your_point').text(rz[3]);
					$('#creator_point').text(rz[4]);

					let my_point = parseInt($('#room_player_point_atheader').text());
					my_point += parseInt(rz[3]);
					$('#room_player_point_atheader').text(my_point);


					$('#sisa_waktu').text('0');
					$('#sisa_waktu').slideUp();
					$('.blok_rate_soal').slideDown();
					$('.blok_next_play').slideDown();


				}else{
					alert(`ajax-reply error: ${z}`);

					return;
				}


			}
		})
	}

</script>