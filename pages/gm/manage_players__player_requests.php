<!-- ============================================================ -->
<!-- PLAYER REQUESTS -->
<!-- ============================================================ -->
<div style="border:solid 1px #ddd; padding:10px">
	<p>Player Requests</p>
	<small>Player meminta dimasukan ke Room ini:</small>
	<style type="text/css">#tbrq td{border: solid 1px #aaa; padding: 8px;}</style>
	<table width="100%" id="tbrq">

		<?php
		$s = "SELECT a.*,b.nama_player from tb_request_player a join tb_player b on a.nickname=b.nickname where a.id_room = '$cid_room'";
		$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses data request");
		if(mysqli_num_rows($q)==0){
			echo "
			<tr>
				<td>
					No Requests
				</td>
			</tr>
			";
		}else{
			$i=0;
			while ($d=mysqli_fetch_assoc($q)) {
				$i++;
				$date_request = $d['date_request'];
				$nama_player = $d['nama_player'];
				$id_request_player = $d['id_request_player'];

				echo "
				<tr id='req_row__$id_request_player'>
					<td>
						$i
					</td>
					<td>
						$nama_player
					</td>
					<td>
						<small><i>$date_request</i></small>
					</td>
					<td align='right'>
						<button class='btn btn-primary btn-sm btn_approv' id='approv__$id_request_player'>Approv</button>
						<button class='btn btn-danger btn-sm btn_approv' id='reject__$id_request_player'>Reject</button>
					</td>
				</tr>


				";

			}
		}
		?>
	</table>
	<!-- ============================================================ -->
</div>
<hr>

<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_approv").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var aksi = rid[0];
			var id_request_player = rid[1];

			if(aksi=="reject"){
				var x = confirm("Yakin untuk MENGHAPUS request?"); if(!x) return;
			}

			var link_ajax = "ajax/ajax_request_player_approv_or_reject.php?aksi="+aksi+"&id_request_player="+id_request_player+'';

			$.ajax({
				url:link_ajax,
				success:function(a){
					var ra = a.split("__");
					if(parseInt(ra[0])==1){
						$("#req_row__"+id_request_player).fadeOut();
						alert(ra[1])
					}else{
						alert(a)
					}
				}
			})

		})
	})
</script>