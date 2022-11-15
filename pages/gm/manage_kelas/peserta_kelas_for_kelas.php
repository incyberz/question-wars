<div class="col-lg-6">
	<!-- ============================================================ -->
	<!-- PESERTA ROOM -->
	<!-- ============================================================ -->
	<?php 
	$s = "SELECT a.*,b.nickname,b.nama_player,b.global_point from tb_kelas_det a 
	join tb_player b on a.nickname=b.nickname 
	where a.kelas='$kelas' and b.admin_level=1
	order by b.nama_player 
	";

	echo "<pre>$s</pre>"; //zzz

	$q = mysqli_query($cn,$s) or die("Error @manage_players. ".mysqli_error($cn));
	$jumlah_peserta = mysqli_num_rows($q);
	?>
	<p>Peserta Kelas <?=$nama_room?> | <span class="badge badge-primary" id="jumlah_peserta" style="font-size:14pt"><?=$jumlah_peserta ?></span> <small><i>players</i></small></p>
	<table class="table table-bordered table-hover table-striped tbx" style="margin-top: 8px">
		<tr class="judul_tabel">
			<td>No</td>
			<td>Nickname</td>
			<td>Nama Peserta</td>
			<td>Aksi</td>
		</tr>
		<?php
		$isi_csv = "No,Nickname/NIM/NIS,Nama Player,Learning Points\n";

		if(mysqli_num_rows($q)==0){
			echo "<tr><td colspan=6 align=center class='red'>Belum ada data.</td></tr>";
		}else{
			$i = 0;
			while($d=mysqli_fetch_assoc($q)){
				$i++;
				$id_kelas_det = $d['id_kelas_det'];
				$znickname = $d['nickname'];
				$znama_player = ucwords(strtolower($d['nama_player']));

				$isi_csv.= "$i,$znickname,$znama_player\n";

				echo "
				<tr id='row2__$id_kelas_det'>
					<td style='text-align: center'>$i</td>
					<td>$znickname</td>
					<td>
						<a href='about/?nickname=$znickname' class='not_ready'>$znama_player</a>
					</td>
					<td>
						<button class='btn btn-danger btn-sm dropout' id='dropout__$id_kelas_det'>Dropout</button>
					</td>
				</tr>
				";
			}
		}

		$isi_csv.= "\n\nData from Question Wars Gamified Systems :: ".date("Y-m-d h:i:s");
		$nama_room_csv = str_replace(" ","_",strtolower($nama_room));
		$file_name = "docs/csv_kelas_$kelas.csv";


		$myfile = fopen($file_name, "w+") or die("Tidak bisa mengakses File. Mungkin file sedang dibuka oleh Aplikasi lain semisal Ms. Excel!");
		fwrite($myfile, "$isi_csv"); //zzz make free RAM here!
		fclose($myfile);


		?>
	</table>

	<a href="<?=$file_name ?>" class="btn btn-success btn-sm" style='color: white;'>Export Data Players</a>
	<hr>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".dropout").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var id_kelas_det = rid[1];
			var link_ajax = `ajax/ajax_global_delete.php?table=tb_kelas_det&acuan=id_kelas_det&acuan_val=${id_kelas_det}`;

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim()=='sukses'){
						$('#row2__'+id_kelas_det).fadeOut();
						$("#jumlah_peserta").text(parseInt($("#jumlah_peserta").text())-1);
					}else{
						alert(a);
					}
				}
			})
		})
	})
</script>