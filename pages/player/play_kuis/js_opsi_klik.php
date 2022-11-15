<script type="text/javascript">
	$(document).ready(function(){
		// =========================================
		// OPSI SOAL CLICKED
		// =========================================
		$('.blok_opsi').click(function(){
			if($('#mode_kuis').val()=='3') return;
			if($('#confirm_reject').val()=='1') return;
			$('.blok_opsi').removeClass('blok_opsi_aktif');
			$(this).addClass('blok_opsi_aktif');

			let tid = $(this).prop('id');
			let rid = tid.split('__');
			let jawaban_terpilih = rid[1];

			$('#jawaban_terpilih').val(jawaban_terpilih);

			set_opsi_click();
		})
	})
</script>