<script type="text/javascript">
	$(document).on("click",".btn_cek_similar",function(){
		// alert('btn_cek_similar click');
		let tid = $(this).prop("id");
		let rid = tid.split('__');
		let aksi = rid[0];
		let id_soal = rid[1];

		let tags_soal = $('#current_tags_soal__'+id_soal).text();
		// $('#tags_soal__'+id_soal).text(); 
		if(tags_soal.length<3){
			alert('Tags soal belum ada.\n\nSilahkan perbaiki kalimat/opsi soal kamu dan harus mengandung minimal satu tags!');
			return;
		}

		let input_kal = $('#kalimat_soal__'+id_soal).text();

		let link_ajax = `jx/jx_soal_similarity_check.php?tags_soal=${tags_soal}&input_kal=${input_kal}&id_soal=${id_soal}`;

		$.ajax({
			url:link_ajax,
			success:function(a){
				$('#hasil_similarity__'+id_soal).html(a);
				$('#btn_cek_similar__'+id_soal).prop('disabled',true);
			}
		})
	})
</script>