<div class="col-lg-6">
	<!-- ============================================================ -->
	<!-- PESERTA ROOM -->
	<!-- ============================================================ -->
	<?php 
	$s = "SELECT a.*,b.nickname,b.nama_player,b.global_point from tb_room_player a 
	join tb_player b on a.nickname=b.nickname 
	where a.id_room=$cid_room and b.admin_level=1
	order by a.room_player_point desc, b.nama_player 

	";
	$q = mysqli_query($cn,$s) or die("Error @manage_players. ".mysqli_error($cn));
	$jumlah_peserta = mysqli_num_rows($q);
	?>
	<p>Peserta Room <?=$nama_room?> | <span class="badge badge-primary" id="jumlah_peserta" style="font-size:14pt"><?=$jumlah_peserta ?></span> <small><i>players</i></small></p>
	<table class="table table-bordered table-hover table-striped tbx" style="margin-top: 8px">
		<thead>
			<th>No</th>
			<th>Nickname</th>
			<th>Nama Peserta</th>
			<th>LP</th>
			<th>Log As</th>
			<th>Aksi</th>
		</thead>
		<?php
		$isi_csv = "No,Nickname/NIM/NIS,Nama Player,Learning Points\n";

		if(mysqli_num_rows($q)==0){
			echo "<tr><td colspan=6 align=center class='red'>Belum ada data.</td></tr>";
		}else{
			$i = 0;
			while($d=mysqli_fetch_assoc($q)){
				$i++;
				$id_room_players = $d['id_room_players'];
				$znickname = $d['nickname'];
				$znama_player = ucwords(strtolower($d['nama_player']));
				$zroom_player_point = $d['room_player_point'];

				$isi_csv.= "$i,$znickname,$znama_player,$zroom_player_point\n";

				echo "
				<tr>
					<td style='text-align: center'>$i</td>
					<td>$znickname</td>
					<td>
						<a href='about/?nickname=$znickname' class='not_ready'>$znama_player</a>
					</td>
					<td>$zroom_player_point</td>
					<td zzz>
						<a href='?logas&nickname=$znickname' class='btn btn-success btn-sm logas' id='logas__$id_room_players' onclick='return confirm(\"Yakin untuk Login As?\")'>LA</a>

					</td>
					<td>

						<button class='btn btn-danger btn-sm dropout' id='dropout__$id_room_players'>DO</button>
					</td>
				</tr>
				";
			}
		}

		$isi_csv.= "\n\nData from Question Wars Gamified Systems :: ".date("Y-m-d h:i:s");
		$nama_room_csv = str_replace(" ","_",strtolower($nama_room));
		$file_name = "docs/csv_room_$cid_room"."_$nama_room_csv.csv";


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
			var id_room_players = rid[1];
			var link_ajax = "ajax/ajax_dropout_player_from_room.php?id_room_players="+id_room_players;

			var x = confirm("Yakin untuk mengeluarkan player dari room?");
			if(!x) return;

			$.ajax({
				url:link_ajax,
				success:function(z){
					console.log(z);
					if(parseInt(z)==1){
						location.reload();
					}else{
						alert("Error. Ajax reply: "+z);
					}
				}
			})
		})
	})
</script>