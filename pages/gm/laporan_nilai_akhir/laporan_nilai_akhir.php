<?php include "pages/player/presensi_var.php"; ?>

<section id="laporan_nilai_akhir" class="gm">
	<div class="container">
		<p>Laporan Nilai Akhir</p>

		<?php 
		$s = "SELECT * from tb_room_subject where id_room = $cid_room order by no_subject";

		//die($s);
		$q = mysqli_query($cn,$s) or die("Error @presensi. ".mysqli_error($cn));
		if(mysqli_num_rows($q)==0){
			die("No Data.");
		}elseif(mysqli_num_rows($q)==1){
			die("<div class='alert alert-danger'>Wahh... sepertinya Anda belum menyiapkan Presensi.
				<br><br>Silahkan Anda Manage this Room, lalu:
				<br>~ Klik tombol 'Tambah Room Subjects'
				<br>~ Ketik nama Room Subjects > OK
				<br>~ Lengkapi Kelengkapan Tanggalnya
				<br>~ Lengkapi Kelengkapan Presensinya
				<hr>
				<a href='?manageroom&cid_room=$cid_room' class='btn btn-primary btn-sm'>Manage Rooms</a>
				</div>");
		}
		?>

		<div class="wadah" style="margin-bottom: 5px;">
			<!-- =================================================== -->
			<!-- FILTERING KELAS -->
			<!-- =================================================== -->
			Kelas 
			<select id="id_room_kelas" class="filter">
				<option value="0">--Pilih--</option>
				<?php 
				$s = "SELECT * from tb_room_kelas where id_room=$cid_room order by kelas";
				//die($s);
				$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses list id_room_kelas");
				if (mysqli_num_rows($q)>0) {
					while ($d=mysqli_fetch_assoc($q)) {
						$id_room_kelas = $d['id_room_kelas'];
						$kelas = $d['kelas'];
						echo "<option value='$id_room_kelas'>$kelas</option>";
					}
				}
				?>
				<option value="all">--All--</option>
			</select>


			<!-- =================================================== -->
			<!-- FILTERING PRODI -->
			<!-- =================================================== -->
			&nbsp;&nbsp;&nbsp;
			Prodi 
			<select id="prodi" class="filter">
				<option value="all">--All--</option>
				<?php 
				$s = "SELECT * from tb_prodi order by jenjang, prodi";
				$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses list prodi");
				if (mysqli_num_rows($q)>0) {
					while ($d=mysqli_fetch_assoc($q)) {
						$prodi = $d['prodi'];
						$jenjang = $d['jenjang'];
						echo "<option value='$prodi'>$jenjang-$prodi</option>";
					}
				}
				?>
			</select>

			<!-- =================================================== -->
			<!-- FILTERING SESI -->
			<!-- =================================================== -->
			&nbsp;&nbsp;&nbsp;
			Sesi 
			<select id="id_room_subject_filter" class="filter">

				<?php 
				$date_now = date("Y-m-d");
				$s = "SELECT * from tb_room_subject  
				where nama_subject not like '%materi umum%' 
				and id_room='$cid_room' 
				and date_open is not null 
				and date_close is not null 
				and date_jadwal is not null 
				and date_open <= '$date_now'

				order by no_subject";
				// die($s);

				$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses room subject");
				if (mysqli_num_rows($q)>0) {
					$sesi_ke = 0;
					while ($d=mysqli_fetch_assoc($q)) {
						$nama_subject = $d['nama_subject'];
						$id_room_subject = $d['id_room_subject'];
						$sesi_ke++;
						$val = $sesi_ke."__$id_room_subject";
						echo "<option value='$val'>$nama_subject</option>";
					}
				}
				?>
				<option value="0__all">--All Pertemuan--</option>
			</select>
		</div>

		<div id="hasil_ajax"></div>

	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$(".filter").change(function(){

			var id_room_kelas = $("#id_room_kelas").val();
			var prodi = $("#prodi").val();
			var sesi_filter = $("#id_room_subject_filter").val();
			var z = sesi_filter.split("__");
			var sesi_ke = z[0];
			var id_room_subject_filter = z[1];
			var link_ajax = "ajax/ajax_presensi_rekap.php?id_room_kelas="+id_room_kelas+"&prodi="+prodi+"&id_room_subject_filter="+id_room_subject_filter+"&sesi_ke="+sesi_ke;

			$.ajax({
				url:link_ajax,
				success:function(a){
					$("#hasil_ajax").html(a)
				}
			})
		})


		$("#id_room_kelas").change();
		
	})

	$(document).on("click",".img_wa_disabled",function(){
		var id = $(this).prop("id");
		alert("Maaf, tidak bisa mengirim pesan karena player ini belum punya nomor WA");
	})


</script>