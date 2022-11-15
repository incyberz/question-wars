<script type="text/javascript">

	var jumlah_benar = 0;
	var rpoin_akurasi = [100,122,150,185,227,279,343,422,519,637,783,962,1182,1453,1785,2193,2694,3310,4067,5000];

	var id_soals = $('#id_soals').text().split('____');
	let kalimat_soals = $('#kalimat_soals').text().split('____');
	let opsi_as = $('#opsi_as').text().split('____');
	let opsi_bs = $('#opsi_bs').text().split('____');
	let opsi_cs = $('#opsi_cs').text().split('____');
	let opsi_ds = $('#opsi_ds').text().split('____');
	let durasi_jawabs = $('#durasi_jawabs').text().split('____');

	let nama_creators = $('#nama_creators').text().split('____');
	let soal_creators = $('#soal_creators').text().split('____');
	let jumlah_rejecters = $('#jumlah_rejecters').text().split('____');
	let jumlah_dijawab_benars = $('#jumlah_dijawab_benars').text().split('____');
	let jumlah_dijawab_salahs = $('#jumlah_dijawab_salahs').text().split('____');
	let status_soals = $('#status_soals').text().split('____');

	var nama_subject = $('#nama_subject').text();

	var id_soal = '';
	var kalimat_soal = '';
	var opsi_a = '';
	var opsi_b = '';
	var opsi_c = '';
	var opsi_d = '';
	var durasi_jawab = '';
	var soal_creator = '';
	var nama_creator = '';
	var jumlah_rejecter = '';
	var jumlah_dijawab_benar = '';
	var jumlah_dijawab_salah = '';
	var status_soal = '';


	function set_posisi_soal_ke(i){
		// console.log(`function set_posisi_soal_ke(${i})`);
		let h = i-1;
		id_soal = id_soals[h];
		kalimat_soal = kalimat_soals[h];
		opsi_a = opsi_as[h];
		opsi_b = opsi_bs[h];
		opsi_c = opsi_cs[h];
		opsi_d = opsi_ds[h];
		durasi_jawab = durasi_jawabs[h];

		nama_creator = nama_creators[h];
		soal_creator = soal_creators[h];
		jumlah_rejecter = jumlah_rejecters[h];
		jumlah_dijawab_benar = jumlah_dijawab_benars[h];
		jumlah_dijawab_salah = jumlah_dijawab_salahs[h];
		status_soal = status_soals[h];







		// =============================================
		// ADD KUIS_PLAYED_BY
		// =============================================
		let cnickname = $('#cnickname').val();
		let fields = 'id_playedby,nickname,id_soal';
		let values = `'${id_soal}_by_${cnickname}','${cnickname}','${id_soal}'`;
		let link_ajax = `jx/ajax_global_insert.php?table=tb_soal_playedby&fields=${fields}&values=${values}`;
		$.ajax({
			url:link_ajax,
			success: function(a){
				if(a.trim()=='sukses'){
					// alert('Presave soal sukses.');


					// =============================================
					// TAMPILKAN SOAL
					// =============================================
					$('#id_soal').val(id_soal);
					$('#kalimat_soal').text(kalimat_soal);
					$('#opsi_a').text(opsi_a);
					$('#opsi_b').text(opsi_b);
					$('#opsi_c').text(opsi_c);
					$('#opsi_d').text(opsi_d);
					$('#durasi_jawab').val(durasi_jawab);
					// alert(`durasi_jawab:${durasi_jawab}`); return; //30


					$('#nama_creator').text(nama_creator);
					$('#link_about_creator').prop('href','about/?nickname='+soal_creator);
					// $('.profil_soal_creator').prop('src',`uploads/${folder_uploads_creator}/_publik_profile.jpg`);
					$('.profil_soal_creator').hide();
					$('#profil__'+id_soal).fadeIn();

					$('#jumlah_rejecter').text(jumlah_rejecter);
					$('#jumlah_dijawab_benar').text(jumlah_dijawab_benar);
					$('#jumlah_dijawab_salah').text(jumlah_dijawab_salah);
					$('#status_soal').text(status_soal);



					// =============================================
					// TAMPILKAN STATUS SOAL SHOW
					// =============================================
					let status_soal_show = '<span class="help badge badge-warning" id="status_soal_show_unverified">Unverified</span>';
					if(status_soal==1) status_soal_show = '<span class="help badge badge-info" id="status_soal_show_verified">Verified by system</span>';
					if(status_soal==2) status_soal_show = '<span class="help badge badge-success" id="status_soal_show_verified">Decided by GM</span>';
					if(status_soal==3) status_soal_show = '<span class="help badge badge-success" id="status_soal_show_verified">Promoted by GM</span>';
					if(status_soal==4) status_soal_show = '<span class="help badge badge-success" id="status_soal_show_verified">Crowned by GM</span>';


					$('#status_soal_show').html(status_soal_show);


				}else{
					// alert('Presave soal played by gagal.\n\n'+a);
					return;
				}
			}
		})
	}



	function set_opsi_click(){

		if($('#sisa_waktu').text() == '0') return;

		$('#aksi__jawab').prop('disabled',false);
		$('#mode_kuis').val(2);
	}



	function auto_verified_soal(){
		let jumlah_dijawab_benar = parseInt($('#jumlah_dijawab_benar').text());
		let jumlah_dijawab_salah = parseInt($('#jumlah_dijawab_salah').text());
		let jumlah_rejecter = parseInt($('#jumlah_rejecter').text());
		let id_soal = $('#id_soal').val();

		let play_count = jumlah_dijawab_benar+jumlah_dijawab_salah;
		let minimal_penjawab = 50; /// zzz debug
		let minimal_penjawab2 = 100; /// zzz debug
		let minimal_penjawab3 = 175; /// zzz debug
		let minimal_penjawab4 = 300; /// zzz debug
		let minimal_penjawab5 = 500; /// zzz debug


		if((jumlah_rejecter==0 && play_count>=minimal_penjawab) 
			|| (jumlah_rejecter==1 && play_count>=minimal_penjawab2)
			|| (jumlah_rejecter==2 && play_count>=minimal_penjawab3)
			|| (jumlah_rejecter==3 && play_count>=minimal_penjawab4)
			|| (jumlah_rejecter==4 && play_count>=minimal_penjawab5)
			){
			// =============================================
			// DO AUTO VERIFIED SOAL
			// =============================================
			let link_ajax = `jx/jx_auto_verified_soal.php?id_soal=${id_soal}`;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim()=='sukses'){
						console.log('sukses auto_verified_soal: '+a);

					}else{
						console.log('[ON DEBUGGING]\n\nProgrammer sedang debugging. Abaikan pesan ini!\n\n Ajax auto_verified_soal() reply error: \n\n'+a);
					}
				}
			})


		}else{
			// console.log(`DEBUGGING: play_count:${play_count} jumlah_dijawab_benar:${jumlah_dijawab_benar}  jumlah_dijawab_salah:${jumlah_dijawab_salah}  jumlah_rejecter:${jumlah_rejecter} `)
		}
	}





</script>