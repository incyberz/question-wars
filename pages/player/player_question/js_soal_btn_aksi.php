<script type="text/javascript">
	// ====================================================
	// BUTTON AKSI
	// ====================================================
	$(document).on("click",".btn_aksi",function(){
		let tid = $(this).prop("id");
		let rid = tid.split('__');
		let aksi = rid[0];
		let id_soal = rid[1];

		let play_count = parseInt($('#play_count__'+id_soal).text());
		let reject_count = parseInt($('#reject_count__'+id_soal).text());

		if(aksi=='delete'){
			if(play_count>0){
				alert(`Soal tidak dapat dihapus karena sudah dijawab oleh ${play_count} players`);
				return;
			}

			if(reject_count>0){
				alert(`Soal tidak dapat dihapus karena sudah direject oleh ${reject_count} players`);
				return;
			}

			let y = confirm('Yakin untuk menghapus soal ini?\n\nPerhatian!! Tidak ada fitur Undo-Delete.');
			if(!y) return;

			let link_ajax = `ajax/ajax_global_delete.php
			?table=tb_soal
			&acuan=id_soal
			&acuan_val=${id_soal}
			`;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim() == 'sukses'){
						$('#row_soal__'+id_soal).slideUp();

					}else{
						alert(a);
					}
				}
			})

		}else if(aksi=='publish' || aksi=='suspend'){

			if($('#hasil_similarity__'+id_soal).text()=='???'){
				alert('Silahkan cek dahulu similarity!');
				return;
			}

			if($('#hasil_similarity__'+id_soal).text().trim().length>3){
				alert(`Nilai Similarity soal kamu terlalu besar.\n\nSilahkan perbaiki kalimat soal atau opsinya agar soal kamu tidak sama dengan soal kawan kamu! Hal ini untuk mencegah duplikasi soal atau soal-soal yang terlalu mirip.`);
				return;
			}

			// ====================================================
			// PUBLISH
			// ====================================================
			// SYARAT PUBLISH:
			// 1. KJ IS NOT NULL
			// 2. SIMILARITY < 50%
			// ====================================================
			if(aksi=='publish'){
				let yakin = confirm('Yakin untuk Publish Soal?\n\nSetelah dipublish soal akan dapat dijawab oleh kawanmu dan menghasilkan Earned Point (EP) untuk kamu. \n\nAkan tetapi kamu tidak bisa lagi mengubahnya.');
				if(!yakin) return;
			}

			if(aksi=='suspend'){
				let yakin = confirm('Yakin untuk Suspend Soal?\n\nSuspend soal membuat soal hidden atau tidak dapat dijawab oleh kawanmu karena memang tidak tampil di Available Questions. \n\nMungkin kamu ingin menggantinya dengan yang lebih bagus!?');
				if(!yakin) return;
			}


			let visibility_soal = aksi=='publish' ? 1 : -1;

			let link_ajax = `ajax/ajax_update_visibility_soal.php
			?id_soal=${id_soal}
			&visibility_soal=${visibility_soal}
			`;

			$.ajax({
				url:link_ajax,
				success: function(a){
					if(a.trim()=='sukses'){
						location.reload();
					}else{
						alert(a);
					}
				}
			})

			// alert('AKSI PUBLISH/SUSPEND');

			// ====================================================
			// SUSPEND
			// ====================================================


		}else if(aksi=='copy'){

			// ====================================================
			// COPY
			// ====================================================

			alert('Fitur copy soal belum tersedia.\n\nFitur ini tanpa validasi duplikat checker hanya akan membuat soal-soal yang terlalu mirip.');

		}
	})

</script>