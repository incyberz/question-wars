<?php 
$nss = "<span class='nama_subject_selected' style='color:#29e9f0'>nama_subject_selected</span> $bm";
?>

<div id="kelengkapan_presensi" style="margin-top:25px;border: solid 1px #aaa;padding: 15px;border-radius: 10px; display: none;">
	<h4><button class="btn btn-success btn-sm backto_room_details" href="#room_details">Back to Room Details</button> | Kelengkapan Presensi <span id="nama_subject_selected" style="color: #ccf;"><?=$nss?></span></h4>
	
	<p>Silahkan Anda isi kelengkapan presensi agar mahasiswa dapat mengisi presensi!</p>
	<div id="detail_kelengkapan"> 

		<div class="form-group wadah">
			<label>Pengantar Pembelajaran untuk <?=$nss?></label>
			<div class="row">
				<div class="col-lg-9">
					<textarea class="form-control input_kelengkapan_presensi" rows="6" required="" id="pengantar_pembelajaran"></textarea>
					<small>50 s.d 500 karakter</small>
				</div>
				<div class="col-lg-3">
					<small>
						<strong>Contoh</strong>: Di pertemuan pertama kita akan berkenalan dengan konsep web dan internet. Untuk praktikum telah disediakan video tutorial HTML Dasar. Dan untuk membuktikan kemampuan kalian, GM sudah menyediakan challenge PHP Basic.
					</small>
					
				</div>
			</div>
		</div>

		<div class="form-group wadah">
			<label>Tags untuk sesi <?=$nss?>. Soal yang dibuat oleh mahasiswa harus mengandung minimal satu tag berikut:</label>
			<div class="row">
				<div class="col-lg-9">
					<textarea class="form-control input_kelengkapan_presensi" rows="6" required="" id="tags" placeholder="tag1, tag2, tag3, dst..."></textarea>
					<small id="tags_ket">Pisahkan pakai koma, digunakan untuk pembuatan soal yang dibuat oleh mahasiswa.</small>
					<div style="color:yellow; font-family: consolas;">
						Sorted tags: <span id="sorted_tags"></span>
					</div>
				</div>
				<div class="col-lg-3">
					<small>
						<strong>Contoh untuk Sesi P1 Pengantar Teknologi Web</strong> dengan tags: web, html, css, js, javascript, jquery, php, mysql, xampp, client, server, backend, frontend, app, apps, desktop, mobile, android, ios.
					</small>
					
				</div>
			</div>
		</div>


		<div class="form-group wadah">
			<label>Tujuan Pembelajaran <?=$nss?> <small>minimal 1</small></label>
			<div class="row">
				<div class="col-lg-9">
					<table width="100%">
						<tr>
							<td width="25px">1.</td>
							<td>
								<input type="text" id="tujuan1" class="form-control input_kelengkapan_presensi" required="" placeholder="Mempelajari tentang ..." maxlength="100">										
							</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>
								<input type="text" id="tujuan2" class="form-control input_kelengkapan_presensi" maxlength="100">										
							</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>
								<input type="text" id="tujuan3" class="form-control input_kelengkapan_presensi" maxlength="100">
								<small>max 100 karakter</small>										
							</td>
						</tr>
					</table>
				</div>
				<div class="col-lg-3">
					<small>
						<strong>Contoh</strong>: Tujuan Pembelajaran: 1. Memahami konsep website dan internet; 2. Membuat Desain Web Statis menggunakan HTML, CSS, dan Javascript.
					</small>
				</div>
			</div>
		</div>

		<div class="form-group wadah">
			<label>Link Bahan Ajar <?=$nss?> <small>(Google Drive, dll)</small></label>
			<input type="text" class="form-control input_kelengkapan_presensi" id="bahan_ajar" required="" maxlength="100">
			<small>Contoh: https://s.id/webdas-p1</small>
		</div>

		<div class="form-group wadah">
			<label>Link Video Materi <?=$nss?> <small>(Youtube Playlist, dll)</small></label>
			<input type="text" class="form-control input_kelengkapan_presensi" id="video_materi" required="" maxlength="100">
			<small>Contoh: https://youtube.com/?v=gh45an</small>
		</div>

		<div class="form-group">
			<label>Daftar Pustaka <?=$bm?> <small>(buku, internet, dll, minimal 1)</small></label>
			<table width="100%">
				<tr>
					<td width="25px">1.</td>
					<td>
						<input type="text" id="dapus1" class="form-control input_kelengkapan_presensi" required="" maxlength="100">										
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>
						<input type="text" id="dapus2" class="form-control input_kelengkapan_presensi" maxlength="100">										
					</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>
						<input type="text" id="dapus3" class="form-control input_kelengkapan_presensi" maxlength="100">
					</td>
				</tr>
			</table>
			<small>Max 100 karakter. Contoh: https://w3schools.com</small>
		</div>

		<button class="btn btn-primary btn-sm" id="btn_save_kelengkapan_presensi">Save Kelengkapan Presensi</button> 
		<button class="btn btn-success btn-sm backto_room_details" href="#room_details">Back to Room Details</button>

	</div>
	
</div>









<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_save_kelengkapan_presensi").click(function(){
			var pengantar_pembelajaran = $("#pengantar_pembelajaran").val();
			var tags = $("#tags").val();
			var sorted_tags = $("#sorted_tags").text();
			var tujuan1 = $("#tujuan1").val();
			var tujuan2 = $("#tujuan2").val();
			var tujuan3 = $("#tujuan3").val();
			var bahan_ajar = $("#bahan_ajar").val();
			var video_materi = $("#video_materi").val();
			var dapus1 = $("#dapus1").val();
			var dapus2 = $("#dapus2").val();
			var dapus3 = $("#dapus3").val();

			if(sorted_tags!='')	tags = sorted_tags;
			
			var id_room_subject = $("#id_room_subject_selected").val();

			if(pengantar_pembelajaran.length<50) {
				alert("Pengantar pembelajaran kurang dari 50 karakter. Silahkan tambahkan!");
				$("#pengantar_pembelajaran").focus();
				return;
			}

			if(($('#tags').val().match(/,/g) || []).length<10){
				alert("Minimal 10 tags di sesi ini. Silahkan tambahkan tags!");
				$("#tags").focus();
				return;
			}

			if(tujuan1.length<20) {
				alert("Tujuan pembelajaran ke-1 kurang dari 20 karakter. Silahkan tambahkan!");
				$("#tujuan1").focus();
				return;
			}

			if(tujuan2.length!=0 && tujuan2.length<20) {
				alert("Tujuan pembelajaran ke-2 kurang dari 20 karakter. Silahkan tambahkan atau dikosongkan!");
				$("#tujuan2").focus();
				return;
			}

			if(tujuan3.length!=0 && tujuan3.length<20) {
				alert("Tujuan pembelajaran ke-3 kurang dari 20 karakter. Silahkan tambahkan atau dikosongkan!");
				$("#tujuan3").focus();
				return;
			}

			if(bahan_ajar.length<20) {
				alert("Link bahan ajar kurang dari 20 karakter. Silahkan tambahkan!");
				$("#bahan_ajar").focus();
				return;
			}

			if(video_materi.length<20) {
				alert("Link video materi kurang dari 20 karakter. Silahkan tambahkan!");
				$("#video_materi").focus();
				return;
			}

			if(dapus1.length<20) {
				alert("Daftar Pustaka ke-1 kurang dari 20 karakter. Silahkan tambahkan!");
				$("#dapus1").focus();
				return;
			}

			if(dapus2.length!=0 && dapus2.length<20) {
				alert("Daftar Pustaka ke-2 kurang dari 20 karakter. Silahkan tambahkan atau dikosongkan!");
				$("#dapus2").focus();
				return;
			}

			if(dapus3.length!=0 && dapus3.length<20) {
				alert("Daftar Pustaka ke-3 kurang dari 20 karakter. Silahkan tambahkan atau dikosongkan!");
				$("#dapus3").focus();
				return;
			}

			var link_ajax = "ajax/ajax_update_kelengkapan_presensi.php"
			+"?id_room_subject="+id_room_subject
			+"&pengantar_pembelajaran="+pengantar_pembelajaran
			+"&tags="+tags
			+"&tujuan1="+tujuan1
			+"&tujuan2="+tujuan2
			+"&tujuan3="+tujuan3
			+"&bahan_ajar="+bahan_ajar
			+"&video_materi="+video_materi
			+"&dapus1="+dapus1
			+"&dapus2="+dapus2
			+"&dapus3="+dapus3;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a=="1__"){
						$("#gk__"+id_room_subject).html("<span class='badge badge-success'>Ready</span>");
						$(".backto_room_details").click();
						alert ("Kelengkapan presensi untuk "+$("#nama_subject__"+id_room_subject).text()+ " sudah siap.");

					}else{
						alert(a)
					}
				}
			})
		})


		$('#tags').keyup(function(){
			let tags = $(this).val();
			let nama_subject_selected = $('#nama_subject_selected').text();

			let jumlah_tags = (tags.match(/,/g) || []).length;
			if(jumlah_tags<10){
				$('#sorted_tags').text(`Tulislah minimal 10 tags untuk sesi ${nama_subject_selected} !`);
				return;
			}

			let tags_sorted = '';
			var rtags = tags.split(',');
			var z = [];
			for(let i=0; i < rtags.length;i++){
				rtags[i] = rtags[i].trim();
				// alert(rtags[i]);
			}

			//  x.map(s => s.trim());
			// rtags.map(s => s.trim());

			rtags.sort();

			$('#sorted_tags').text(rtags.join(', '));
		});


		// $('#tags').focusout(function(){
		// 	$(this).val($('#sorted_tags').text().trim());
		// })

	})
</script>