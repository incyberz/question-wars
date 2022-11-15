<script>
	
	function set_tampilan_awal(){
		$('.first_hide').hide();
		$('.first_show').show();

		$('.first_enabled').prop('disabled',false);
		$('.first_disabled').prop('disabled',true);

		$('#jawaban_terpilih').val('');
		$('#jawaban_seharusnya').val('');
		$('#alasan_reject').val('');
		$('#confirm_reject').val('');
		$('#mode_kuis').val(1);
		$('#user_rated').text('');

		$('.blok_opsi').removeClass('blok_opsi_aktif');
		$('.blok_opsi').removeClass('opsi_benar');
		$('.blok_opsi').removeClass('opsi_salah');
		$('.img_rate').removeClass('img_rated');

		// $('#aksi__jawab').prop('disabled',false);
		$('.blok_next_play').slideUp();
		$('.hasil_kuis').slideUp();
		$('.blok_hasil_reject').slideUp();
		$('.blok_rate_soal').slideUp();
		$('.ket_rate').slideUp();
		$('#sisa_waktu').slideDown();


		$('.blok_hasil_reject').text('blok_hasil_reject');
		$('.alasan_reject').prop('checked',false);

		$('#your_point').text('-');
		$('#creator_point').text('-');

	}

	function set_tampilan_benar(){
		jumlah_benar++;
   	// console.log(`function set_tampilan_benar() jumlah_benar: ${jumlah_benar}`);
		let u = Math.round(Math.random() * 5)+1;
		let audio = new Audio(`assets/audio/true${u}.mp3`);
		audio.play();

		$('.hasil_kuis').hide();
		$('#anda_benar').slideDown();
		$('#aksi__jawab').prop('disabled',true);

		let jawaban_terpilih = $('#jawaban_terpilih').val();
		$('#jawaban_seharusnya').val(jawaban_terpilih);
		$('#blok_opsi__'+jawaban_terpilih).addClass('opsi_benar');
	}

	function set_tampilan_salah(){
		let audio = new Audio('assets/audio/false1.mp3');
		audio.play();

		$('.hasil_kuis').hide();
		$('#anda_salah').slideDown();
		$('#aksi__jawab').prop('disabled',true);

		let jawaban_terpilih = $('#jawaban_terpilih').val();
		let jawaban_seharusnya = $('#jawaban_seharusnya').val().toLowerCase();
		$('#blok_opsi__'+jawaban_terpilih).addClass('opsi_salah');
		$('#blok_opsi__'+jawaban_seharusnya).addClass('opsi_benar');

		// ================================================
		// KILLED SHOW :: PLAYER DIBALIK
		// ================================================
		let id_soal = $('#id_soal').val();
		let player_right = $('#player_right__'+id_soal).text();
		$('#player_right__'+id_soal).text('You');
		$('#player_left__'+id_soal).text(player_right);
		$('#ck_row__'+id_soal).addClass('killed');

	}

	function set_tampilan_timed_out(){
		let audio = new Audio('assets/audio/false1.mp3');
		audio.play();

		$('.hasil_kuis').hide();
		$('#anda_timed_out').slideDown();
		$('#aksi__jawab').prop('disabled',true);

		// let jawaban_terpilih = $('#jawaban_terpilih').val();
		let jawaban_seharusnya = $('#jawaban_seharusnya').val().toLowerCase();
		// $('#blok_opsi__'+jawaban_terpilih).addClass('opsi_salah');
		$('#blok_opsi__'+jawaban_seharusnya).addClass('opsi_benar');

		// ================================================
		// PLAYER SUICIDE SHOW 
		// ================================================
		let id_soal = $('#id_soal').val();
		$('#player_right__'+id_soal).text('You');
		$('#ck_row__'+id_soal).addClass('suicide');

	}


</script>