<script type="text/javascript">
	// ====================================================
	// SET KJ BENAR
	// ====================================================
	$(document).on("click",".btn_set_benar",function(){
		let tid = $(this).prop("id");
		let rid = tid.split('__');
		let kolom = rid[0];
		let kj = rid[1];
		let id_soal = rid[2];

		let isi = $(this).text();

		// console.log(`kolom: ${kolom}, id_soal: ${id_soal}, kj: ${kj}`);

		let link_ajax = `ajax/ajax_global_update.php
		?table=tb_soal
		&field=${kolom}
		&acuan=id_soal
		&field_val=${kj}
		&acuan_val=${id_soal}
		`;

		$.ajax({
			url:link_ajax,
			success:function(a){
				if(a.trim() == 'sukses'){
					$(`.btn_set_benar`).removeClass('btn_set_benar_true');
					$(`#${kolom}__${kj}__${id_soal}`).addClass('btn_set_benar_true');
					alert('Update Sukses. Kunci Jawaban set ke '+kj);

				}else{
					alert(a);
				}
			}
		})
	})
</script>