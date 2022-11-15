<script type="text/javascript">
	$(document).ready(function(){
		$('.img_rate').mouseenter(function(){
			let tid = $(this).prop('id');
			let rid = tid.split('__');
			let rate_no = rid[1];
			let user_rated = $('#user_rated').text();
			if(parseInt(user_rated)>0) return;

			$('.img_rate').removeClass('img_rated');
			for(let i=1; i<=rate_no;i++){
				$('#img_rate__'+i).addClass('img_rated');
			}
		})

		$('.img_rate').click(function(){
			let tid = $(this).prop('id');
			let rid = tid.split('__');
			let rate_no = rid[1];

			$('.img_rate').removeClass('img_rated');
			for(let i=1; i<=rate_no;i++){
				$('#img_rate__'+i).addClass('img_rated');
			}


			let id_soal = $('#id_soal').val();
			let cnickname = $('#cnickname').val();
			let id_playedby = `${id_soal}_by_${cnickname}`;

			let link_ajax = `jx/ajax_global_update.php
			?table=tb_soal_playedby
			&field=user_rated
			&field_val=${rate_no}
			&acuan=id_playedby
			&acuan_val=${id_playedby}
			`;

			$.ajax({
				url: link_ajax,
				success: function(a){
					if(a.trim()=='sukses'){
						// alert('rate sukses');


						$('#user_rated').text(rate_no);

						$('.ket_rate').slideUp();
						$('#ket_rate__'+rate_no).slideDown();

						let audio = new Audio(`assets/audio/true3.mp3`);
						audio.play();


					}else{
						alert('Error ajax update user_rated. '+a);
					}
				}
			})

			
		})
	})
</script>

