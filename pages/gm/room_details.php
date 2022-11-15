<?php 
$bm = " <span style='color:red; font-weight:bold'>*</span>";

$zroom_ended = "none"; //zzz

$s = "SELECT a.*,b.nickname,b.nama_player 
from tb_room a 
join tb_player b on a.room_creator=b.nickname 
where a.id_room=$cid_room";

$q = mysqli_query($cn,$s) or die("Error @room_details #1. ".mysqli_error($cn));
$d = mysqli_fetch_assoc($q);

$zroom_creator = $d['room_creator'];
$znama_creator = $d['nama_player'];
$znama_room = strtoupper($d['nama_room']);
$zmax_player = $d['max_player'];
$zroom_created = $d['room_created'];
$zdate_end = $d['date_end'];
$zstatus_room = $d['status_room'];
$zroom_active_point = $d['room_active_points'];

if($zmax_player==0) $zmax_player="unlimitted";


$s = "SELECT 1 from tb_room_player a 
join tb_player b on a.nickname=b.nickname 
where a.id_room=$cid_room and b.admin_level=1 ";
$q = mysqli_query($cn,$s) or die("Error @room_details #2. ".mysqli_error($cn));
$zjumlah_player = mysqli_num_rows($q);

?>

<section id="room_details" class="gm">
	<div class="container">

		<input class="debug" id="id_room_selected" value="<?=$cid_room?>">
		<input class="debug" id="id_room_subject_selected" value="<?=$id_room_subject_selected?>">

		<div id="blok_room_details">
			<h3>Room Details :: <?=$znama_room ?></h3>
			<style type="text/css">
				#blok_room_property div{border: solid 1px #888; text-align: center;}
			</style>
			<div>
				<div class="row" id="blok_room_property" style="margin: 0px 0px">
					<div class="col-lg-4">
						id : <?=$cid_room ?>
					</div>
					<div class="col-lg-4">
						Creator : <a href="about/?nickname=<?=$zroom_creator?>"><?=$znama_creator ?></a>
					</div>
					<div class="col-lg-4">
						<?=$zjumlah_player ?> Players
					</div>
					<div class="col-lg-4">
						Max Player : <?=$zmax_player ?>
					</div>
					<div class="col-lg-4" zzz>
						Created : <?=$zroom_created ?>
					</div>
					<div class="col-lg-4">
						<?=$jumlah_gm ?> GMs
					</div>
					<div class="col-lg-4">
						Status : <?=$zstatus_room ?>
					</div>
					<div class="col-lg-4">
						Ended : <?=$zroom_ended ?>
					</div>
					<!-- <div class="col-lg-4">
						0 Ortu
					</div> -->
					<div class="col-lg-4">
						Room Points : <?=$zroom_active_point ?>
					</div>
					<!-- <div class="col-lg-4">
						-
					</div> -->
				</div>
			</div>





			<style type="text/css">.tbx {font-size: 10pt;}</style>
			<style type="text/css">.tbx th{color: white; background-color: #d77; text-align: center;}</style>
			<style type="text/css">.tbx td{padding: 3px 6px; text-align: center;}</style>
			<table class="table table-bordered table-hover table-striped tbx" style="margin-top: 8px">
				<thead>
					<th>No</th>
					<th>Room Subjects <span class="badge badge-info help" id="help__nama_subject">?</span> <br><small>(Pembagian Materi Kuliah)</small></th>
					<th>Prioritas <span class="badge badge-info help" id="help__no_subjects">?</span><br><small>Pertemuan ke-</small></th>
					<th>Jadwal Kuliah <span class="badge badge-info help" id="help__date_jadwal">?</span> <br><small>Format: YYYY-MM-DD HH:MM</small></th>
					<th>Penutupan Presensi<span class="badge badge-info help" id="help__date_close">?</span> <br><small>Format: YYYY-MM-DD</small></th>
					<th>Kelengkapan <br>Presensi</th>
					<th>Aksi <span class="badge badge-info help" id="help__aksi">?</span></th>
				</thead>
				<?php

				$s = "SELECT * from tb_room_subject where id_room = $cid_room order by no_subject";
				$q = mysqli_query($cn,$s) or die("Error @room_details. ".mysqli_error($cn));
				if(mysqli_num_rows($q)==0){
					echo "<tr><td colspan=4>No Data</td></tr>";
				}elseif(mysqli_num_rows($q)==1){
					echo "<tr><td colspan=6>Materi secara Umum (tidak ada pembagian Materi Room)</td></tr>";
				}else{
					$i = 0;
					
					while($d=mysqli_fetch_assoc($q)){
						$i++;
						$id_room_subject = $d['id_room_subject'];
						$znama_subject = $d['nama_subject'];
						$zno_subject = $d['no_subject'];
						$zdate_jadwal = $d['date_jadwal'];
						$zdate_close = $d['date_close'];
						$zkelengkapan_presensi_gm = '';

						$st_klp_dosen = "<span class='badge badge-danger'>Lengkapi</span>";
						$ss = "SELECT 1 FROM tb_kelengkapan_presensi where id_room_subject='$id_room_subject'";
						$qq = mysqli_query($cn,$ss) or die("Error @ajax. Tidak dapat mengecek exists id_room_subject");
						if(mysqli_num_rows($qq)==1) $st_klp_dosen = "<span class='badge badge-success'>Ready</span>";

						if($zdate_jadwal!="") $zdate_jadwal=date("Y-m-d H:i",strtotime($zdate_jadwal));
						if($zdate_close!="") $zdate_close=date("Y-m-d H:i",strtotime($zdate_close));

						if($zdate_jadwal=="") $zdate_jadwal="none";
						if($zdate_close=="") $zdate_close="none";


						if(strtolower(substr($znama_subject,0,11))=="materi umum"){
							echo "
							<tr>
								<td>$i</td>
								<td>$znama_subject</td>
								<td>$zno_subject</td>
								<td>$zdate_jadwal</td>
								<td>$zdate_close</td>
								<td>-</td>
								<td>-</td>
							</tr>
							";
						}else{
							echo "
							<tr>
								<td>$i<span class='debug'>$id_room_subject</span></td>
								<td class='editable' id='nama_subject__$id_room_subject' style='text-align:left'>$znama_subject</td>
								<td class='editable' id='no_subject__$id_room_subject'>$zno_subject</td>
								<td class='editable' id='date_jadwal__$id_room_subject'>$zdate_jadwal</td>
								<td class='editable' id='date_close__$id_room_subject'>$zdate_close</td>
								<td class='detkel goto_kelengkapan' id='gk__$id_room_subject'>
									$st_klp_dosen
								</td>
								<td class='deletable' id='delete__$id_room_subject'>Del</td>
							</tr>
							";
						}
					}
				}
				?>
			</table>

			<button class="btn btn-primary btn-sm" id="btn_tambah_room_subjects">Tambah Room Subjects</button>
			<!-- <a href="?managerooms" class="btn btn-success btn-sm" id="">Back to Room List</a> -->
		</div>






















		<?php include "kelengkapan_presensi_gm.php"; ?>

	</div>
</section>























<script type="text/javascript">

	function isValidDate(dateString){
	    // First check for the pattern mm/dd/yyyy
	    // if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
	        // return false;

	    var parts = dateString.split("-");
	    var year = parseInt(parts[0], 10);
	    var month = parseInt(parts[1], 10);
	    var day = parseInt(parts[2], 10);

	    if(year < 2021 || year > 2025 || month == 0 || month > 12 || day == 0 || day > 31) return false;

	    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

	    // Adjust for leap years
	    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)) monthLength[1] = 29;

	    // Check the range of the day
	    return day > 0 && day <= monthLength[month - 1];
	};

	$(document).ready(function(){
		$("#btn_tambah_room_subjects").click(function(){
			var new_sub = prompt("Enter Subject-Name / Sub-Materi: \n\nContoh: Pertemuan 1 HTML Basic\n","Pertemuan 1 HTML Basic");
			if(new_sub == null || new_sub.trim()=="") return;

			var cid_room = $("#id_room_selected").val();
			var link_ajax = "ajax/ajax_add_room_subjects.php?cid_room="+cid_room+"&nama_subject="+new_sub;
			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a=="1__"){
						location.reload();
						// alert(a);
					}else{
						alert("AJAX Error. Reply: "+a)
					}
				}
			})
		})

		$(".editable").click(function(){
			var id = $(this).prop("id");
			var text = $(this).text();
			var rid = id.split("__");
			var field = rid[0];
			var id_room_subject = rid[1];
			var isi_caption = "Insert new value:";
			var isi_default = text;

			if(field=="date_jadwal" || field=="date_close") {
				isi_caption = "Insert date with format: YYYY-MM-DD HH:MM\n\nContoh: 2021-09-25 08:30";
				var t = new Date();
				if(text=="none")isi_default = t.getFullYear()+"-"+(t.getMonth()+1)+"-"+t.getDate()+" "+t.getHours()+":"+t.getMinutes();
			}

			var isi = prompt(isi_caption,isi_default);
			if(isi=="none") isi='';
			isi = isi.trim();
			if(isi=="" || isi==text) return;

			if(field=="date_jadwal" || field=="date_close"){
				if(!isValidDate(isi)){
					alert("Nilai yang Anda masukan bukan tanggal. \n\nSilahkan masukan tanggal dengan format YYYY-MM-DD HH:MM. \n\nContoh: 2021-09-25");
					return;
				}
			}

			var link_ajax = "ajax/ajax_update_room_subjects.php"
			+"?id_room_subject="+id_room_subject
			+"&field="+field
			+"&isi="+isi
			+'';

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a=="1__"){
						$("#"+id).text(isi);
						if(field=="date_jadwal"){
							$("#date_close__"+id_room_subject).text(isi);
							alert("Update Tanggal Perkuliahan berhasil. \n\nPerhatian! Tanggal Pembukaan Presensi dan Tanggal Penutupan Presensi di set sama dengan Tanggal Jadwal Kuliah\n\nUntuk fleksibilitas presensi, silahkan Anda tentukan Tanggal Pembukaan dan Tanggal Penutupan Presensi.")
						}



						if(field=="no_subject") location.reload();
					}else{
						alert("AJAX Error. Reply: "+a)
					}
				}
			})

		})



		$(".deletable").click(function(){
			var id = $(this).prop("id");
			var text = $(this).text();
			var rid = id.split("__");
			var field = rid[0];
			var id_room_subject = rid[1];

			var x = confirm("Yakin mau menghapus Room Subjects?\n\nJika tidak bisa dihapus maka pada Room Subjects tersebut sudah ada soal yang dibuat oleh Player atau oleh Anda (GM)"); if(!x) return;

			var link_ajax = "ajax/ajax_delete_room_subjects.php"
			+"?id_room_subject="+id_room_subject
			+'';

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a=="1__"){
						location.reload();
					}else{
						alert(a)
					}
				}
			})
		})

		$(".goto_kelengkapan").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var id_room_subject = rid[1];
			$("#id_room_subject_selected").val(id_room_subject);

			var nama_subject = $("#nama_subject__"+id_room_subject).text();
			$(".nama_subject_selected").text(nama_subject);

			// if jadwal kuliah none
			var date_jadwal = $("#date_jadwal__"+id_room_subject).text();
			if(date_jadwal=="none") {alert("Silahkan isi dahulu Jadwal Kuliah untuk "+nama_subject); return;}

			var no_subject = $("#no_subject__"+id_room_subject).text();
			$(".no_subject_selected").text(no_subject);


			// =========================================================
			// FILL KELENGKAPAN FROM DATABASE
			// =========================================================
			$(".input_kelengkapan_presensi").val("");
			var link_ajax = "ajax/ajax_get_kelengkapan_presensi.php?id_room_subject="+id_room_subject;
			$.ajax({
				url:link_ajax,
				success:function(a){
					var ra = a.split("__");
					if(parseInt(ra[0])){
						var d = ra[1].split(";;;;");
						var baris;
						for (var i = d.length - 1; i >= 0; i--) {
							baris = d[i].split("====");
							$("#"+baris[0]).val(baris[1]);
							// alert(baris[0]);
						}
					}else if(a!="0__"){
						alert(a);
					}
				}
			})


			var pengantar_pembelajaran = $("#pengantar_pembelajaran").val();
			if(pengantar_pembelajaran=="") $("#pengantar_pembelajaran").val("Di pertemuan ke-"+no_subject+" ini kita akan mempelajari materi tentang "+nama_subject+"");


			// return;

			$("#blok_room_details").hide();
			$("#kelengkapan_presensi").fadeIn(1000);

		})


		$(".backto_room_details").click(function(){
			$("#pengantar_pembelajaran").val("");
			$("#kelengkapan_presensi").hide();
			$("#blok_room_details").fadeIn(1000);

		})
	})
</script>