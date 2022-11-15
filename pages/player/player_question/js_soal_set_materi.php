<script type="text/javascript">
	// ====================================================
	// SET MATERI KE
	// ====================================================
	$(document).on("change",".row_sesi_mk",function(){
		let tid = $(this).prop("id");
		let rid = tid.split('__');
		let kolom = rid[0];
		let id_soal = rid[1];

		let id_room_subject = $(this).val();
		let sesi_mk = $(this).find(':selected').text();

		console.log(`kolom: ${kolom}, 
			id_soal: ${id_soal}, 
			id_room_subject: ${id_room_subject}
			`);

		let link_ajax = `ajax/ajax_global_update.php
		?table=tb_soal
		&field=${kolom}
		&acuan=id_soal
		&field_val=${id_room_subject}
		&acuan_val=${id_soal}
		`;

		$.ajax({
			url:link_ajax,
			success:function(a){
				if(a.trim() == 'sukses'){
					alert(`Update Sukses. \n\nMateri di set ke "${sesi_mk}"\n\nSystem will be refreshed!`);
					location.reload();
				}else{
					alert(a);
				}
			}
		})
	})

</script>