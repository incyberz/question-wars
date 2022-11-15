<script type="text/javascript">
	$(document).on("click",".editable",function(){
		let tid = $(this).prop("id");
		let rid = tid.split('__');
		let kolom = rid[0];
		let id_soal = rid[1];

		let isi = $(this).text();


		let isi2 = prompt("New value:", isi);
		if(!isi2) return;
		isi2 = isi2.trim();
		isi2 = filter_tag(isi2);

		$('#hasil_similarity__'+id_soal).text('???');
		$('#btn_cek_similar__'+id_soal).prop('disabled',false);


		if(isi2 == '' || isi2 == isi) return;

		let tak_boleh_berisi = [
		'benar semua',
		'salah semua',
		'semua benar',
		'semua salah',
		'tidak ada jawaban',
		'semua jawaban benar',
		'semua jawaban salah',
		' a benar',
		' b benar',
		' c benar',
		' d benar',
		' a salah',
		' b salah',
		' c salah',
		' d salah'
		];
		for(let i=0;i<tak_boleh_berisi.length;i++){
			if(isi2.toLowerCase().search(tak_boleh_berisi[i])>=0 && kolom.substring(0,7)=='opsi_pg'){ 
				alert(`Opsi tidak boleh "${tak_boleh_berisi[i]}".`); 
				return; 
			}
		}
		

		if(isi2.length<3 && kolom != 'kalimat_soal'){ alert('Untuk opsi jawaban minimal 3 huruf.'); return; }
		if(isi2.length<50 && kolom == 'kalimat_soal'){ alert('Untuk kalimat_soal minimal 50 huruf.'); return; }

		// console.log(`kolom: ${kolom}, id_soal: ${id_soal}, isi2: ${isi2}`);


		// ====================================================
		// CHECK DOUBLE OPTIONS
		// ====================================================
		let opsi_lains = [];
		let opsi_pg1 = $('#opsi_pg1__'+id_soal).text().trim().toLowerCase();
		let opsi_pg2 = $('#opsi_pg2__'+id_soal).text().trim().toLowerCase();
		let opsi_pg3 = $('#opsi_pg3__'+id_soal).text().trim().toLowerCase();
		let opsi_pg4 = $('#opsi_pg4__'+id_soal).text().trim().toLowerCase();
		if(kolom!='kalimat_soal'){
			switch(kolom){
				case 'opsi_pg1': opsi_lains = [opsi_pg2,opsi_pg3,opsi_pg4]; break;
				case 'opsi_pg2': opsi_lains = [opsi_pg1,opsi_pg3,opsi_pg4]; break;
				case 'opsi_pg3': opsi_lains = [opsi_pg2,opsi_pg1,opsi_pg4]; break;
				case 'opsi_pg4': opsi_lains = [opsi_pg2,opsi_pg3,opsi_pg1]; break;
				default: { alert(`kolom: ${kolom} cannot be accepted.`); return; }
			}
		}
		if (opsi_lains.includes(isi2.toLowerCase())) {
			alert(`Opsi "${isi2}" sudah ada.\n\nSilahkan pakai opsi lainnya!`);
			return;
		}

























		// ====================================================
		// AJAX GLOBAL UPDATE
		// ====================================================
		let link_ajax = `ajax/ajax_global_update.php
		?table=tb_soal
		&field=${kolom}
		&acuan=id_soal
		&field_val=${isi2}
		&acuan_val=${id_soal}
		`;

		$.ajax({
			url:link_ajax,
			success:function(a){
				if(a.trim() == 'sukses'){
					$(`#${kolom}__${id_soal}`).text(isi2);


					// ====================================================
					// HITUNG TAGS
					// ====================================================
					let tags = $('#tags__'+id_soal).text().toLowerCase();
					let rtags = tags.split(', ');

					let kalimat_soal = $('#kalimat_soal__'+id_soal).text().trim().toLowerCase();
					if(kolom=='kalimat_soal') kalimat_soal = isi2;
					if(kolom=='opsi_pg1') opsi_pg1 = isi2;
					if(kolom=='opsi_pg2') opsi_pg2 = isi2;
					if(kolom=='opsi_pg3') opsi_pg3 = isi2;
					if(kolom=='opsi_pg4') opsi_pg4 = isi2;
					
					let all_kalimat = `${kalimat_soal} ${opsi_pg1} ${opsi_pg2} ${opsi_pg3} ${opsi_pg4} `;
					let my_tags = '';

					for(let i=0; i<rtags.length;i++){
						if(all_kalimat.toLowerCase().search(rtags[i])>=0){
							if(my_tags==''){
								my_tags += rtags[i];
							}else{
								my_tags += `, ${rtags[i]}`;
							}
							// alert(my_tags);
						}
					}

					$('#current_tags_soal__'+id_soal).text(my_tags);




				}else{
					alert(a);
				}
			}
		})
	})

</script>