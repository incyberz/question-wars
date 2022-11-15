<section id="manage_peserta_kelas" class="gm">
	<div class="container">

		<h3>Manage Peserta Kelas</h3>


		<?php 
		$kelas = isset($_GET['kelas'])?$_GET['kelas']:die("kelas undefined.<hr>$btn_back"); 
		echo "<span class='debug' id='get_kelas'>$kelas</span>";

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

					<style>
						#hasil_ajax * { font-size: small; }
						
					</style>
					<div id="hasil_ajax"></div>
				</div>



				<?php include 'peserta_kelas_for_kelas.php'; ?>

			</div>

		<?php } ?>

	</div>
</section>




<script type="text/javascript">
	$(document).ready(function(){
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
			let kata_kunci = $(this).val();
			let kelas = $('#get_kelas').text();
			let link_ajax = `ajax/ajax_get_list_player_for_kelas.php?kata_kunci=${kata_kunci}&kelas=${kelas}`;
			let hasil_ajax_kosong = $("#hasil_ajax_kosong").html();

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
		let id = $(this).prop("id");
		let rid = id.split("__");
		let nickname = rid[1];

		let kelas = $('#get_kelas').text();


		let link_ajax = `ajax/ajax_assign_player_to_kelas.php?kelas=${kelas}&nim=${nickname}`;

		$.ajax({
			url:link_ajax,
			success:function(a){
				if(a.trim()=='sukses'){
					$('#row1__'+nickname).fadeOut();
					$("#jumlah_peserta").text(parseInt($("#jumlah_peserta").text())+1);
				}else{
					alert(a)
				}
			}
		})
	})
</script>