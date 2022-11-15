<?php
$rows = '';
$rows2 = '';

$s = "SELECT a.*, 
(select count(1) as z from tb_kelas_det c WHERE c.kelas=a.kelas) as jumlah_player_in_kelas 
FROM tb_kelas a 
left join tb_room_kelas b on a.kelas=b.kelas and b.id_room='$cid_room'
WHERE b.kelas is null";
// die($s);
$q = mysqli_query($cn,$s) or die("Error @manage_kelas. Tidak dapat mengakses data kelas. ".mysqli_error($cn));
$jumlah_kelas = mysqli_num_rows($q);
if($jumlah_kelas==0){
	$rows.= "<tr><td colspan=4>Belum ada data kelas</td></tr>";
}else{
	$i=0;
	while ($d = mysqli_fetch_assoc($q)) {
		$i++;
		$kelas = $d['kelas'];
		$semester = $d['semester'];
		$prodi = $d['prodi'];
		$jenis_kelas = $d['jenis_kelas'];
		$jenis_jalur = $d['jenis_jalur'];
		$jumlah_player_in_kelas = $d['jumlah_player_in_kelas'];

		$jenis_jalur_show = "$jenis_jalur";
		$jenis_kelas_show = "Pagi"; if(trim(strtoupper($jenis_kelas))=="S") $jenis_kelas_show = "Sore";


		$kelas_ket = "
		<div style='font-size:small'>
			$prodi - $jenis_jalur_show $jenis_kelas_show smt-$semester
		</div>
		";

		$rows.= "
		<tr id='row_kelas__$kelas'>
			<td>$i</td>
			<td align=left id='kelas__$kelas'>
				<a href='?detail_kelas&kelas=$kelas'>$kelas</a>
			</td>
			<td id='jumlah_player_in_class__$kelas'>
				$jumlah_player_in_kelas | <a href='?manage_peserta_kelas&kelas=$kelas'>Manage</a>
			</td>
			<td>
				<button class='btn btn-primary btn-sm btn_aksi' id='assign__$kelas'>Assign</button>
				<button class='btn btn-danger btn-sm btn_aksi' id='delete__$kelas'>Del</button>
			</td>
		</tr>
		";

	}
}


$s = "SELECT a.*,
(select count(1) as z from tb_kelas_det c WHERE c.kelas=a.kelas) as jumlah_player_in_kelas 
from tb_room_kelas a 
join tb_kelas b on a.kelas=b.kelas 
where a.id_room = '$cid_room' 
order by b.prodi, b.jenis_jalur";
$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mengakses data kelas.");
$jumlah_kelas = mysqli_num_rows($q);
if($jumlah_kelas==0){
	$rows2.= "<tr><td colspan=3>Belum ada data kelas</td></tr>";
}else{
	$i=0;
	while ($d = mysqli_fetch_assoc($q)) {
		$i++;
		$kelas = $d['kelas'];
		// $semester = $d['semester'];
		// $prodi = $d['prodi'];
		// $jenis_kelas = $d['jenis_kelas'];
		// $jenis_jalur = $d['jenis_jalur'];
		$jumlah_player_in_kelas = $d['jumlah_player_in_kelas'];

		$jenis_jalur_show = "$jenis_jalur";
		$jenis_kelas_show = "Pagi"; if(trim(strtoupper($jenis_kelas))=="S") $jenis_kelas_show = "Sore";


		$kelas_ket = "
		<div style='font-size:small'>
			$prodi - $jenis_jalur_show $jenis_kelas_show smt-$semester
		</div>
		";

		$rows2.= "
		<tr id='row2_kelas__$kelas'>
			<td>$i</td>
			<td align=left>
				$kelas
			</td>
			<td id='jumlah_player_in_class__$kelas'>
				$jumlah_player_in_kelas | <a href='?manage_peserta_kelas&kelas=$kelas'>Manage</a>
			</td>

			<td>
				<button class='btn btn-danger btn-sm btn_aksi' id='drop__$kelas'>Drop Out</button>
			</td>
		</tr>
		";

	}
}


?>

<section id="tambah_room" class="gm">
	<div class="container">

		<h3>Manage Kelas</h3>

		<style type="text/css">
			.tb_kelas{
				font-size: 10pt;
				text-align: center;
				color: white;
			}
			.tb_kelas td,th{
				border: solid 1px #aaa;
				padding: 7px !important;
			}
			.tb_kelas th{
				background: linear-gradient(#050,#020);
			}
		</style>

		<div class="row">
			<div class="col-lg-6">
				<table width="100%">
					<tr>
						<td>
							<h5>Daftar Kelas</h5>
						</td>
						<td align="right">
							<button class="btn btn-success btn-sm btn_aksi" id="tambah__atas">Tambah</button>
						</td>
					</tr>
				</table>
				
				<table class="table tb_kelas" >
					<thead>
						<th>No</th>
						<th>Kelas</th>
						<th>Players</th><th>Aksi</th>
					</thead>
					<?=$rows?>
				</table>
				<button class="btn btn-success btn-sm btn_aksi" id="tambah__bawah">Tambah</button>

			</div>

			<div class="col-lg-6">
				<h5>Kelas Terdaftar</h5>
				<table class="table table-bordered tb_kelas">
					<thead>
						<th>No</th>
						<th>Kelas pada Room ini</th>
						<th>Aksi</th>
					</thead>
					<?=$rows2?>
				</table>
			</div>
		</div>




	</div>
</section>








<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_aksi").click(function(){
			let id = $(this).prop("id");
			let rid = id.split("__");
			let aksi = rid[0];
			let kelas = rid[1];
			let jumlah_player_in_kelas = $("#jumlah_player_in_class__"+kelas).text().trim();

			// let c = confirm("Apakah Anda akan memasukan sebanyak:\n~ "+jumlah_player_in_kelas+" player \n~ kelas: "+kelas+" ?"); if(!c) return;

			if(aksi == 'assign'){
				let link_ajax = "ajax/ajax_assign_kelas_to_room.php?kelas="+kelas;

				$.ajax({
					url:link_ajax,
					success:function(a){
						let ra = a.split("__");
						if(parseInt(ra[0])==1){
							// alert(ra[1]);
							$('#row_kelas__'+kelas).fadeOut();
						}else{
							alert("Error, ajax reply: "+a);
						}
					}
				})
			}



			if(aksi == 'drop'){
				let link_ajax = "ajax/ajax_drop_kelas_from_room.php?kelas="+kelas;

				$.ajax({
					url:link_ajax,
					success:function(a){
						if(a.trim()=='sukses'){
							// alert(ra[1]);
							$('#row2_kelas__'+kelas).fadeOut();
						}else{
							alert(a);
						}
					}
				})
			}




			if(aksi == 'delete'){
				let link_ajax = `ajax/ajax_global_delete.php?table=tb_kelas&acuan=kelas&acuan_val=${kelas}`;

				$.ajax({
					url:link_ajax,
					success:function(a){
						if(a.trim()=='sukses'){
							// alert(ra[1]);
							$('#row_kelas__'+kelas).fadeOut();
						}else{
							alert(a);
						}
					}
				})
			}

			if(aksi == 'tambah'){

				let new_kelas = prompt('Kelas baru: (format [PRODI]-[TAHUN]-[JALUR]-[WAKTU], contoh: TI-2020-KIP-P)','TI-2020-KIP-P');
				if(!new_kelas) return;
				new_kelas = new_kelas.toUpperCase();

				let prodi = new_kelas.substring(0,new_kelas.search('-'));
				let fields = `kelas,        prodi,jenis_jalur, jenis_kelas, kelas_ket, semester`;
				let values = `'${new_kelas}','${prodi}',NULL, NULL, NULL, NULL`;

				let link_ajax = `ajax/ajax_global_insert.php?table=tb_kelas&fields=${fields}&values=${values}`;

				$.ajax({
					url:link_ajax,
					success:function(a){
						if(a.trim()=='sukses'){
							// alert(ra[1]);
							location.reload();
						}else{
							alert(a);
						}
					}
				})
			}



			
			

		})
	})
</script>