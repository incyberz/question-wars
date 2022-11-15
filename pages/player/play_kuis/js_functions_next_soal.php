<script>
	function next_soal(){
		// console.log('function next_soal()');

		let cno_soal = parseInt($('#no_soal').val());

		set_tampilan_awal();

		if(cno_soal==20){ 
			// =========================================
			// SOAL HABIS
			// =========================================
			// Show Paket Soal Hasil
			// 
			// =========================================
			//                HASIL KUIS
			// =========================================
			// You --> Ahmad
			// You --> Budi
			// You <-- Charlie
			// You --> Deni
			// You <-- Erwin
			// You <-- Fajar
			// =========================================
			// Accuracy: 78%	Poin Akurasi: 1354 LP
			// =========================================
			// 				    CLAIM POIN AKURASI
			// =========================================
			let poin_akurasi = rpoin_akurasi[jumlah_benar-1];
			if(jumlah_benar==0) poin_akurasi=0;
			$('#poin_akurasi').text(poin_akurasi);

			let akurasi_kuis = jumlah_benar/.2;
			$('#akurasi_kuis').text(`${akurasi_kuis}%`);
			$('#akurasi_kuis').prop('style',`width:${akurasi_kuis}%`);


			$('.blok_kuis').slideUp();
			$('.blok_hasil_kuis').slideDown();

			let audio = new Audio('assets/audio/tada2.mp3');
			audio.play();


			console.log('soal habis')
			return;



		}else{
			// =========================================
			// SOAL MASIH ADA
			// =========================================
			cno_soal++;
			let durasi_jawab = $('#durasi_jawab').val()=='' ? 30 : $('#durasi_jawab').val();
			// alert(`durasi_jawab: ${durasi_jawab}`); return;
			set_posisi_soal_ke(cno_soal);
			// alert(cno_soal);
			$('#no_soal').val(cno_soal);
			$('#sisa_waktu').text(durasi_jawab);

			const timer = setInterval(function(){
				let sisa_waktu = parseInt($('#sisa_waktu').text());

				// =========================================
				// BATALKAN TIMER JIKA USER SUDAH MENJAWAB
				// ATAU SISA WAKTU NaN
				// =========================================
				let mode_kuis = $('#mode_kuis').val();
				let jawaban_terpilih = $('#jawaban_terpilih').val();
				let jawaban_seharusnya = $('#jawaban_seharusnya').val();
				let confirm_reject = parseInt($('#confirm_reject').val());

				if((jawaban_terpilih==jawaban_seharusnya && jawaban_terpilih!='') || 
					confirm_reject || (jawaban_seharusnya!='' && mode_kuis=='3')
					|| isNaN($('#sisa_waktu').text())){
					clearInterval(timer);
					$('#sisa_waktu').text('0');
					return;
				}

				


				// console.log(`setInterval berikutnya sisa_waktu: ${sisa_waktu}`);

				if(sisa_waktu == 0){
					clearInterval(timer);
					cek_jawaban();
					// console.log(`cek_jawaban at timer sisa_waktu 0`);

				}else{
					sisa_waktu--;
					// console.log(`setInterval sisa_waktu--: ${sisa_waktu}`);
					$('#sisa_waktu').text(sisa_waktu);
				}
			},1000);

		}

		$('#progress__'+cno_soal).addClass('filled');

	}

</script>