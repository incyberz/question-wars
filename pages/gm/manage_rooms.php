<?php die("Fitur ini telah dinonaktifkan."); ?>
<section id="manage_room" class="gm">
	<div class="container">

		<h3>Room List</h3>

		<div class="row">
			<div class="col-md-12">


				<!-- <input type="hidden" class="form-control" name="cid_room" id="cid_room" value="21"> -->
				<!-- <input type="hidden" class="form-control" name="microtime" id="microtime" value="abi_201225045956">  -->
				<!-- zzz -->

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Kepemilikan</label>
							<select class="form-control" disabled="">
								<option>Room Saya</option>
								<option>Bukan Room Saya</option>
								<option>All Rooms</option>
							</select>
						</div>

					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Room Status</label>
							<select class="form-control" disabled="">
								<option>Active</option>
								<option>Not Active</option>
								<option>All Status</option>
							</select>
						</div>

					</div>
				</div>


				<style type="text/css">.tbx {font-size: 10pt;}</style>
				<style type="text/css">.tbx th{color: white; background-color: #d77; text-align: center;}</style>
				<style type="text/css">.tbx td{padding: 3px 6px; text-align: center;}</style>
				<table class="table table-bordered table-hover table-striped tbx" style="margin-top: 8px">
					<thead>
						<th>No</th>
						<th>Nama Room</th>
						<th>Tanggal Buat</th>
						<th>Peserta</th>
						<th>GM</th>
						<th>Ortu</th>
						<th>Status</th>
						<th>Aksi</th>
					</thead>
					<?php

					$s = "SELECT a.*, c.nama_room, c.room_created from tb_room_player a 
					join tb_player b on a.nickname=b.nickname 
					join tb_room c on a.id_room=c.id_room 
					where a.nickname='$nickname' and b.admin_level=$admin_level
					order by c.room_created desc
					";
					$q = mysqli_query($cn,$s) or die("Error @manage_rooms. ".mysqli_error($cn));

					$i = 0;
					while($d=mysqli_fetch_assoc($q)){
						$i++;
						$zid_room = ucwords(strtolower($d['cid_room']));
						$znama_room = ucwords(strtolower($d['nama_room']));
						$zroom_created = $d['room_created'];

						$ss = "SELECT 1 from tb_room_player a 
						join tb_player b on a.nickname=b.nickname 
						where a.id_room='$zid_room'
						";

						$sss = "$ss and b.admin_level=1";
						$qq = mysqli_query($cn,$sss) or die("Error @manage_rooms. ".mysqli_error($cn));
						$croom_jumlah_player = mysqli_num_rows($qq);

						$sss = "$ss and b.admin_level=2";
						$qq = mysqli_query($cn,$sss) or die("Error @manage_rooms. ".mysqli_error($cn));
						$croom_jumlah_gm = mysqli_num_rows($qq);

						$sss = "$ss and b.admin_level=3";
						$qq = mysqli_query($cn,$sss) or die("Error @manage_rooms. ".mysqli_error($cn));
						$croom_jumlah_ortu = mysqli_num_rows($qq);




						echo "

						<tr>
						<td>
						$i
						</td>
						<td>
						<a href='?manageroom&cid_room=$zid_room'>$znama_room</a>
						</td>
						<td>
						$zroom_created
						</td>
						<td>
							$croom_jumlah_player
						</td>
						<td>
							$croom_jumlah_gm
						</td>
						<td>
							$croom_jumlah_ortu
						</td>
						<td>
						Aktif
						</td>
						<td>
						<a href='?delroom&cid_room=$zid_room'>Del</a>
						</td>
						</tr>


						";

					}





					?>
				</table>





				<div class="form-group">
					<a href="?addroom" class="btn btn-primary">Tambah Room</a>
				</div>		  
			</div>
		</div>
	</div>
</section>