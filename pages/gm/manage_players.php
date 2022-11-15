<style type="text/css">
	.tbx th{color: white; background-color: #d77; text-align: center;}
	.tbx td{padding: 5px 7px; font-size: 10pt;}
	#manage_player td{vertical-align: middle;}
</style>

<section id="manage_player" class="gm">
	<div class="container">

		<h3>Manage Players</h3>
		<p><small>Silahkan Anda Filter lalu klik Add to Room atau gunakan fitur Import CSV.</small></p>

		<?php
		# ============================================================
		# UPLOAD PROCESS
		# ============================================================
		if(isset($_POST['btn_import_csv']) and $_FILES['input_csv_file']['size']!=0){
			$fname = $_FILES['input_csv_file']['name'];
			$ekst = strtolower(substr($fname, strlen($fname)-4,4));
			
			if($ekst!=".csv"){$ermsg = "File type harus file .csv";}else{
				# ============================================================
				# READ CSV FILE
				# ============================================================
				$tmp_name = $_FILES['input_csv_file']['tmp_name'];
				$file = fopen($tmp_name, 'r');
				$baris='';
				$btn_disabled = '';
				$jml_baris = 0;
				$values_sql = "__";

				while (($line = fgetcsv($file)) !== FALSE) {
					$jml_kolom = count($line);
					$cek = "<span class='merah tebal'>Error</span>. <small>Jumlah kolom terdeteksi = $jml_kolom (diizinkan hanya 3 kolom)</small>"; 
					$aksi = "-";
					if($jml_kolom==3) {$cek = "<span class='ijo'>OK</span>"; $aksi = "Insert/Update";}

					$no = strip_tags(trim(strtolower($line[0])));
					$nim = strip_tags(trim($line[1]));
					$nama = strip_tags(trim($line[2]));


					if(substr($no,0,5)!="kolom" and $no!="no" and $no!="(dst)"){
						$jml_baris++;
						$values_sql.= ";$nim,$nama";
						$baris.="<tr><td align=center>$no</td><td>$nim</td><td>$nama</td><td>$aksi</td><td>$cek</td></tr>";
						if($jml_kolom!=3) {$btn_disabled = "disabled"; break;}
					}
				}
				$values_sql = str_replace("__;","",$values_sql);
				fclose($file);
				?>

				<div class="row">
					<div class="col-lg-6">
						<table class="table table-bordered table-hover table-striped tbx" style="margin-top: 8px">
							<thead>
								<th>No</th>
								<th style="padding:0 5px">Nickname <br><small>( NIM / NIS )</small></th>
								<th>Nama Peserta</th>
								<th>Aksi</th>
								<th>Column Check</th>
								<?=$baris?>
							</thead>
						</table>
						
						<div>
							<input type="hidden" id="values_sql" value="<?=$values_sql?>">
							<button class='btn btn-primary btn-sm' id="btn_insert_semua_data" <?=$btn_disabled?>>Insert/Update <?=$jml_baris ?> Data</button>
						</div>


					</div>
				</div>

				<?php
			}
		}else{
			?>


			<!-- ============================================================ -->
			<!-- ALL PLAYER -->
			<!-- ============================================================ -->
			<div class="row">
				<div class="col-lg-6">
					<table>
						<tr>
							<td>Filter:&nbsp;&nbsp;</td>
							<td>
								<input type="text" class="tengah" maxlength="10" id="kata_kunci" size="10"> &nbsp;&nbsp;<span class="badge badge-primary" id="jumlah_rows">0</span> <small>rows found</small>
							</td>
						</tr>
					</table>

					<div id="hasil_ajax_kosong" class="hideit">
						<hr>
						Silahkan ketik dahulu pada kolom filter minimal 3 huruf!
						<br>
						<small>Anda dapat memasukan kata kunci NIM, NIS, nickname, atau Nama Player.</small>
						<hr>
					</div>

					<div id="hasil_ajax"></div>
					<hr>



					<!-- ============================================================ -->
					<!-- IMPORT FROM EXCEL -->
					<!-- ============================================================ -->
					<div style="border:solid 1px #ddd; padding:10px">
						<p>Import dari Data Excel</p>
						<small>
							<ul>
								<li>Download dahulu Format <a href="docs/template_csv_import_players_qwars.csv">Template Import Player</a></li>
								<li>Insert atau copas data NIM + Nama dari Ms Excel, Save!</li>
								<li>Max 200 baris data per Import</li>
								<li>Klik Browse, pilih file CSV Anda</li>
								<li>Klik Import CSV</li>
								<li>Klik Konfirmasi Import CSV</li>
							</ul>
						</small>
						<div style="border: solid 1px #ccc; padding: 10px; border-radius: 10px; background-image: linear-gradient(#444,#111);">
							<form method="post" action="?manageplayers" enctype="multipart/form-data">
								<table width="100%">
									<tr>
										<td>
											<input type="file" name="input_csv_file" accept=".csv">
										</td>
										<td align="right">
											<button class="btn btn-success btn-sm" name="btn_import_csv">Import CSV</button><br>
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
					<hr>


					<?php //include "manage_players__player_requests.php"; ?>

					<div class="wadah">
						<label>Tambah Player</label>
						<div class="row">
							<div class="col-3">
								<input id="input_nim" class="form-control" placeholder="NIM" minlength="8" maxlength="8">
							</div>
							<div class="col-6">
								<input id="input_nama_player" class="form-control" placeholder="Nama Player" minlength="3" maxlength="30">
							</div>
							<div class="col-3">
								<button id="btn_add_player" class="btn btn-primary">Add Player</button>
							</div>
						</div>
						<small>New Players:
							<ul id="hasil_add_player"></ul>
						</small>
						
					</div>

				</div>




				<?php include "manage_players__peserta_room.php"; ?>
			</div>

		<?php } ?>
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function(){

		$('#btn_add_player').click(function(){
			let nim = $('#input_nim').val();
			let nama_player = $('#input_nama_player').val();

			if(nim.length!=8){
				alert('NIM harus 8 digit.');
				$('#input_nim').focus();
				return;
			}

			if(nama_player.length<3 || nama_player.length>30){
				alert('Nama mahasiswa antara 3 s.d 30 huruf.');
				$('#input_nama_player').focus();
				return;
			}


			var x = confirm(`Tambah Player dan Assign to Room? \n\nNama: ${nama_player}\nNIM: ${nim} `);
			if(!x) return;

			var link_ajax = `ajax/ajax_add_and_assign_player_to_room.php?nim=${nim}&nama_player=${nama_player}`;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim()=='sukses'){
						$('#input_nim').val('');
						$('#input_nama_player').val('');
						$('#hasil_add_player').append(`<li>NIM: ${nim}, Nama: ${nama_player}</li>`);
					}else{
						alert(a)
					}
				}
			})

		})


		$("#btn_insert_semua_data").click(function(){
			var cid_room = $("#cid_room").val();
			var nickname = $("#nickname").val();
			var values_sql = $("#values_sql").val();

			var link_ajax = "ajax/ajax_insert_all_peserta.php"
			+"?cid_room="+cid_room
			+"&nickname="+nickname
			+"&values_sql="+values_sql
			;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a=="1__"){
						alert("Insert/Update sukses.");
						window.location = "?manageplayers";
					}else{
						alert(a)
					}
				}
			})
		})

		$("#kata_kunci").keyup(function(){
			var kata_kunci = $(this).val();
			var link_ajax = "ajax/ajax_get_list_player.php?kata_kunci="+kata_kunci;
			var hasil_ajax_kosong = $("#hasil_ajax_kosong").html();

			$("#jumlah_rows").text("?");
			if(kata_kunci.length<3){$("#hasil_ajax").html(hasil_ajax_kosong);return;}

			$.ajax({
				url:link_ajax,
				success:function(a){
					var ra = a.split("___");
					if(ra[0]=="1"){
						$("#jumlah_rows").text(ra[1]);
						$("#hasil_ajax").html(ra[2]);
					}else{
						$("#hasil_ajax").html(a);
					}
				}
			})

		});

		$("#kata_kunci").keyup();
	})

	$(document).on("click",".addplayer",function(){
		var id = $(this).prop("id");
		var rid = id.split("__");
		var nim = rid[1];

		var x = confirm("Tambah nickname: '"+nim+"' ke dalam room?");
		if(!x) return;

		$("#"+id).prop("disabled",true);

		var link_ajax = "ajax/ajax_assign_player_to_room.php?nim="+nim;

		$.ajax({
			url:link_ajax,
			success:function(a){
				var ra = a.split("__");
				if(parseInt(ra[0])==1){
					alert(ra[1]);
					$("#jumlah_peserta").text(parseInt($("#jumlah_peserta").text())+1);
				}else{
					alert("Error, ajax reply: "+a);
				}
			}
		})
	})
</script>