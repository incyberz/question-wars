<script type="text/javascript">
	$(document).ready(function(){

		
		$("#toggle_ket_jumlah_soal").click(function(){
			$('.ket_jumlah_soal').slideToggle();
		})

		$(".ket_jumlah_soal").click(function(){
			$('.ket_jumlah_soal').slideUp();
		})


		$("#keyword").keyup(function(){

			let keyword = $("#keyword").val();
			let keyword2 = $("#keyword2").val();

			if(keyword==keyword2) return;

			$(".filter").change();
			$("#keyword2").val(keyword);
		});

		$("#filter__id_room_subject").change(function(){

			let keyword = $("#keyword").val();
			let filter__id_room_subject = $("#filter__id_room_subject").val();
			let filter__visibility_soal = $("#filter__visibility_soal").val();
			let filter__status_soal = $("#filter__status_soal").val();

			let link_ajax = `ajax/ajax_get_list_questions.php
			?keyword=${keyword}
			&id_room_subject=${filter__id_room_subject}
			&visibility_soal=${filter__visibility_soal}
			&status_soal=${filter__status_soal}
			`;
			// alert(link_ajax);

			$.ajax({
				url:link_ajax,
				success:function(a){
					$("#list_questions").html(a);
				}
			})
		});


		$(".btn_add_soal").click(function(){

			// =======================================
			// VALIDASI MAX SOAL
			// =======================================
			let max_soal = 20; //zzz
			let total_soal_per_sesi = 19; //zzz
			let sesi_mk = $('#filter__id_room_subject').find(':selected').text();

			if(total_soal_per_sesi>=max_soal){
				alert(`Maaf, kuota soal pada sesi ${sesi_mk} sudah habis.\n\nTotal soal: ${total_soal_per_sesi}\nMax Soal: ${max_soal}\n\nSilahkan hapus sebagian soal pada sesi ini untuk membuat soal baru.`);
				return;
			}

			// =======================================
			// VALIDASI WAJIB ADA ID SESI MK
			// =======================================
			let id_room_subject = $('#filter__id_room_subject').val();
			if(id_room_subject == 'all'){
				alert('Silahkan pilih dahulu salah satu pilihan sesi_mk!');
				return;
			}

			let yakin = confirm(`Apakah kamu mau buat soal baru pada sesi ${sesi_mk}?`);
			if(!yakin) return;



			let soal_creator = $('#cnickname').val();
			let fd = new Date();
			let y = fd.getFullYear();
			let m = fd.getMonth()+1;
			let d = fd.getDate();
			let h = fd.getHours();
			let i = fd.getMinutes();
			let s = fd.getSeconds();
			let new_id_soal = `${soal_creator}_${y}${m}${d}${h}${i}${s}`;


			let fields = 'id_soal,     id_room_subject, soal_creator, kalimat_soal';
			let values = `'${new_id_soal}', '${id_room_subject}', '${soal_creator}', '[NEW SOAL CREATED - SILAHKAN UBAH KALIMAT SOAL]'`;

			let link_ajax = `ajax/ajax_global_insert.php
			?table=tb_soal
			&fields=${fields}
			&values=${values}
			`;
			// alert(link_ajax); return;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim() == 'sukses'){
						$('#keyword').val('NEW SOAL');
						$('#filter__status_soal').val('all').change();
						$('#filter__visibility_soal').val('all').change();
						$('#filter__id_room_subject').change();
					}else{
						alert(a);
					}
				}
			})

		});




		$("#filter__status_soal").change(function(){ $("#filter__id_room_subject").change(); })
		$("#filter__visibility_soal").change(function(){ $("#filter__id_room_subject").change(); })

		$("#filter__id_room_subject").change();
	})
</script>