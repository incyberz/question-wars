<?php 
include "presensi_var.php";
$jumlah_soal_minimal = 3; 

# ================================================
# VARIABEL UNTUK PRESENSI 
# ================================================
$count_presensi_skg = 0;
$count_presensi_player = 0;
$nama_subject_skg = "?";
$persen_presensi_player = 0;
$persen_presensi_player_ket = "GM belum menyiapkan Presensi";


$rows_presensi = '';

$s = "SELECT * from tb_room_subject where id_room = $cid_room order by no_subject";
$q = mysqli_query($cn,$s) or die("Error @presensi. ".mysqli_error($cn));
if(mysqli_num_rows($q)==0){
	echo "<tr><td colspan=4>No Data</td></tr>";
}elseif(mysqli_num_rows($q)==1){
	$rows_presensi.= "<div class='alert alert-danger'>Wahh... sepertinya GM belum menyiapkan Presensi.<br><br>Segera hubungi beliau untuk membuat Room Subjects pada Room '$nama_room'!<hr><a href='?' class='btn btn-primary btn-sm'>Back to Dashboard</a></div>";
}else{
	$i = 0;
	while($d=mysqli_fetch_assoc($q)){
		$i++;
		$id_room_subject = $d['id_room_subject'];
		$znama_subject = $d['nama_subject'];
		$zno_subject = $d['no_subject'];
		$zdate_jadwal = $d['date_jadwal'];
		$zdate_open = $d['date_open'];
		$zdate_close = $d['date_close'];

		$zkelengkapan_presensi_gm = 0;
		$ss = "SELECT 1 from tb_kelengkapan_presensi where id_room_subject='$id_room_subject'";
		$qq = mysqli_query($cn,$ss) or die("Tidak dapat mengakses data kelengkapan presensi");
		if(mysqli_num_rows($qq)==1) $zkelengkapan_presensi_gm = 1;

		# =======================================================
		# VAR PROCESSING KELENGKAPAN ICONS
		# =======================================================
		$is_materi_umum=0; if(strtolower(substr($znama_subject,0,11))=="materi umum") $is_materi_umum=1;
		$znama_subject_show = "<h6 style='color:#ff7' id='nama_subject__$id_room_subject'>$znama_subject</h6>";


		$bahan_ajar = '';
		$video_materi = '';
		$dapus1 = '';
		$dapus2 = '';
		$dapus3 = '';
		$kelengkapan_icons = '';
		$img_size = "25px";

		$img_bahan_ajar = "<img src='assets/img/icons/gdrive.png' width='$img_size' class='zoom'>";
		$img_video_materi = "<img src='assets/img/icons/youtube.png' width='$img_size' class='zoom'>";
		$img_dapus1 = "<img src='assets/img/icons/www.png' height='$img_size' class='zoom'>";
		$img_dapus2 = "<img src='assets/img/icons/www.png' height='$img_size' class='zoom'>";
		$img_dapus3 = "<img src='assets/img/icons/www.png' height='$img_size' class='zoom'>";

		$ss = "SELECT * from tb_kelengkapan_presensi where id_room_subject = '$id_room_subject'";
		$qq = mysqli_query($cn,$ss) or die("Error mengakses kelengkapan_presensi_gm. ".mysqli_error($cn));
		if(mysqli_num_rows($qq)==1){

			$dd = mysqli_fetch_assoc($qq);
			$bahan_ajar = $dd['bahan_ajar'];
			$video_materi = $dd['video_materi'];
			$dapus1 = $dd['dapus1'];
			$dapus2 = $dd['dapus2'];
			$dapus3 = $dd['dapus3'];

			$a_bahan_ajar = '';
			$a_video_materi = '';
			$a_dapus1 = '';
			$a_dapus2 = '';
			$a_dapus3 = '';
			if($bahan_ajar!="") $a_bahan_ajar = "<a href='$bahan_ajar' target='_blank'>$img_bahan_ajar</a>";
			if($video_materi!="") $a_video_materi = "<a href='$video_materi' target='_blank'>$img_video_materi</a>";
			if($dapus1!="") $a_dapus1 = "<a href='$dapus1' target='_blank'>$img_dapus1</a>";
			if($dapus2!="") $a_dapus2 = "<a href='$dapus2' target='_blank'>$img_dapus2</a>";
			if($dapus3!="") $a_dapus3 = "<a href='$dapus3' target='_blank'>$img_dapus3</a>";

			$kelengkapan_icons = "$a_bahan_ajar $a_video_materi $a_dapus1 $a_dapus2 $a_dapus3";

		}
		if($kelengkapan_icons!="") $kelengkapan_icons = "<div style='margin: 5px 0 10px 0'>$kelengkapan_icons</div>";


		# =======================================================
		# VAR PROCESSING DATE
		# =======================================================
		$zdate_open = date("Y-m-d",strtotime($zdate_open));
		$zdate_close = date("Y-m-d",strtotime($zdate_close));

		$xjadwal = strtotime(date("Y-m-d",strtotime($zdate_jadwal)));
		$xopen = strtotime($zdate_open);
		$xclose = strtotime($zdate_close);
		$xskg = strtotime($tanggal_skg);

		$jadwal_show="<span class='badge badge-success' id='date_jadwal__$id_room_subject'>none</span>";
		if($zdate_jadwal!="") $jadwal_show="<span class='badge badge-danger' id='date_jadwal__$id_room_subject'>$zdate_jadwal</span>";
		if($zdate_jadwal!="" and $xjadwal<=$xskg) $jadwal_show="<span class='badge badge-success' id='date_jadwal__$id_room_subject'>$zdate_jadwal</span>";

		$open_show="<span class='badge badge-success' id='date_open__$id_room_subject'>none</span>";
		if($zdate_open!="") $open_show="<span class='badge badge-danger' id='date_open__$id_room_subject'>$zdate_open</span>";
		if($zdate_open!="" and $xopen<=$xskg) $open_show="<span class='badge badge-success' id='date_open__$id_room_subject'>$zdate_open</span>";

		$close_show="<span class='badge badge-success' id='date_close__$id_room_subject'>none</span>";
		if($zdate_close!="") $close_show="<span class='badge badge-warning' id='date_close__$id_room_subject'>$zdate_close</span>";
		if($zdate_close!="" and $xclose>=$xskg) $close_show="<span class='badge badge-success' id='date_close__$id_room_subject'>$zdate_close</span>";


		# =======================================================
		# VAR PROCESSING COUNTING
		# =======================================================
		$ss = "SELECT 1 from tb_soal where id_room_subject='$id_room_subject' and soal_creator='$cnickname' and visibility_soal=1";
		$qq = mysqli_query($cn,$ss) or die("Tidak dapat menghitung jumlah soal in room subjects");
		$jumlah_soal_in_room_subjects = mysqli_num_rows($qq);

		$tipe_badge_jumlah_soal = "danger";
		if($jumlah_soal_in_room_subjects>=$jumlah_soal_minimal) $tipe_badge_jumlah_soal = "success";

		$show_jumlah_soal = "<span class='badge badge-$tipe_badge_jumlah_soal' 
		id='jumlah_soal_in_room_subjects__$id_room_subject' 
		style='font-size:12pt; padding: 5px 15px; margin:15px 0px'>$jumlah_soal_in_room_subjects</span>";


		$st_klp_dosen = "<span class='badge badge-danger'>Belum siap</span>";
		$ss = "SELECT 1 FROM tb_kelengkapan_presensi where id_room_subject='$id_room_subject'";
		$qq = mysqli_query($cn,$ss) or die("Error @ajax. Tidak dapat mengecek exists id_room_subject");
		if(mysqli_num_rows($qq)==1) $st_klp_dosen = "<span class='badge badge-success'>Ready</span>";


		# =======================================================
		# VAR PROCESSING BUTTONS
		# =======================================================
		$disabled_btn = "disabled";
		if($zkelengkapan_presensi_gm
			and ($zdate_open!="none" and $xopen<=$xskg)
			//and ($zdate_close!="none" and $xclose>=$xskg)
		) { $disabled_btn = ''; }

			// $disabled_btn = "disabled zkelengkapan_presensi_gm:$zkelengkapan_presensi_gm xopen:$xopen xclose:$xclose xskg:$xskg ";

		if(($zdate_open!="none" and $xopen<=$xskg and !$is_materi_umum)) {
			$count_presensi_skg++;
		}

		# =======================================================
		# FIXED COUNT PRESENSI
		if($count_presensi_skg<$count_presensi_player) $count_presensi_skg=$count_presensi_player;


		$tipe_btn = "primary"; if($jumlah_soal_in_room_subjects<$jumlah_soal_minimal) $tipe_btn = "secondary";

		// if($cnickname=='salwa') $disabled_btn = ''; //zzz debug
		// if($cnickname=='salwa') $tipe_btn = 'danger'; //zzz debug

		$btn_claim_presensi = "<button class='btn btn-$tipe_btn btn-sm btn-block btn_claim_presensi' id='btn_claim_presensi__$id_room_subject' $disabled_btn style='margin-top:7px'>Claim Presensi</button>";


		$btn_tambah_soal = "<a href='?myq&aksi=add&id_room_subject_selected=$id_room_subject' class='btn btn-success btn-block' style='font-size:10pt'>Tambah Soal</a>";
		


		# ==========================================================
		# CEK IS PRESENTED
		# ==========================================================
		$id_presensi = $cnickname."_$id_room_subject";
		$ss = "SELECT tanggal_presensi,is_ontime,poin_presensi from tb_presensi where id_presensi = '$id_presensi'";
		$qq = mysqli_query($cn,$ss) or die("Error @presensi. ".mysqli_error($cn));

		$ztanggal_presensi = "?";
		$is_presented_show = "<span class='badge badge-danger' style='font-size:12pt;margin-bottom:15px'>Belum Absen</span>";
		if(mysqli_num_rows($qq)==1) {
			$dd = mysqli_fetch_assoc($qq);
			$ztanggal_presensi = $dd['tanggal_presensi'];
			$is_ontime = $dd['is_ontime'];
			$poin_presensi = $dd['poin_presensi'];

			$is_ontime_text = $is_ontime==1 ? 'ontime' : 'late';
			$img_ontime = "<img src='assets/img/icons/$is_ontime_text.png' height='30px'>";

			$is_presented_show = "<span class='badge badge-success' style='font-size:12pt'>Sudah Absen</span>
			$img_ontime <small>$poin_presensi LP</small>
			<br><small><i>at $ztanggal_presensi</i></small>";
			$btn_claim_presensi = '';
			$count_presensi_player++;
		}




		# ==========================================================
		# EXCEPTION FOR MATERI UMUM
		# ==========================================================
		if($is_materi_umum){
			$st_klp_dosen = "-";
			$btn_claim_presensi = "&nbsp;";
			$jadwal_show = "<small><i>Everyday</i></small>";
			$open_show = "<small><i>When this room created</i></small>";
			$close_show = "<small><i>Forever</i></small>";
			$is_presented_show = "<small><i>Present by Logins</i></small>";

			$btn_tambah_soal = '';
			$show_jumlah_soal = '-';
		}


		# ==========================================================
		# OUTPUT
		# ==========================================================
		$j = $i-1;
		$rows_presensi.= "
		<div class='tbrow' id='rows_presensi__$j'>
			<div class='row'>
				<div class='col-lg-4'>
					<span id='is_sekarang__$j' class='badge badge-warning' style='margin-bottom:10px; font-size:12pt'></span>
					$znama_subject_show
					$kelengkapan_icons
					$is_presented_show
					<input type='hidden' id='nama_subject_skg__$j' value='$znama_subject'>
				</div>
				<div class='col-lg-4'>
					Jadwal Kuliah: $jadwal_show
					<br>Pembukaan: $open_show
					<br>Penutupan: $close_show
				</div>
				<div class='col-lg-2'>
					Publish soal: $show_jumlah_soal 
					<br>Presensi GM: $st_klp_dosen
				</div>
				<div class='col-lg-2'>
					$btn_tambah_soal
					$btn_claim_presensi
				</div>
			</div>
		</div>
		";
	}

	# ==========================================================
	# PERSEN PRESENSI
	# ==========================================================
	$persen_presensi_player = 0;
	if($count_presensi_skg!=0);
	$persen_presensi_player = intval($count_presensi_player/$count_presensi_skg*100);

	$tipe_ujian = "UTS"; if($count_presensi_skg>8) $tipe_ujian = "UAS";

	if ($persen_presensi_player<75) {
		$persen_presensi_player_ket = "<span class='badge badge-danger' style='font-size:20px;margin-top: 10px;'>Belum bisa mengikuti $tipe_ujian</span>";
	}else{
		$persen_presensi_player_ket = "<span class='badge badge-success' style='font-size:20px;margin-top: 10px;'>Kamu boleh mengikuti $tipe_ujian</span>";
	}


}

?>
<input type="hidden" id="jumlah_soal_minimal" value="<?=$jumlah_soal_minimal?>">
<section id="presensi" class="player">
	<div class="container">

		<?php include "presensi_processing.php"; ?>

		<h3>Mengisi Presensi</h3>
		<p>Berikut adalah daftar presensi (kehadiran) dalam mengikuti pembelajaran online. Setiap presensi mempunyai syarat dan ketentuan yang berbeda yang ditentukan oleh kebijakan GM. Minimal Presensi mengikuti UTS/UAS adalah 75%. </p>

		<div style="border:solid 1px #aaa; border-radius: 10px; padding: 10px; margin-bottom:10px; text-align: center; background:linear-gradient(#5a5,#333);"> 
			Saat ini sudah masuk:<br>
			<span style="font-size:16pt">Pertemuan ke-<?=$count_presensi_skg?>: <span id="nama_subject_skg"><?=$nama_subject_skg?></span></span>
			
		</div>

		<div style="border:solid 1px #aaa; border-radius: 10px; padding: 15px;">
			<p class="text-center">
				Halo <?=$cnama_player?>! Presensi kamu:<br>
				<span style="font-size:60px"><?=$persen_presensi_player?>%</span><br>
				<span id="count_presensi_player"><?=$count_presensi_player?></span>
				 of 
				<span id="count_presensi_skg"><?=$count_presensi_skg?></span> presensi<br>
				<?=$persen_presensi_player_ket?>
			</p>
		</div>

		<?php include "presensi_syarat.php"; ?>

		<style type="text/css">
			.tbjudul, .tbrow{font-size: ;border: solid 1px #aaa;padding: 15px;}
			.tbjudul{color: white; background-color: #d77; text-align: center;}
		</style>

		<?=$rows_presensi?>

	</div>
</section>


<script type="text/javascript">
	$(document).ready(function(){

		var count_presensi_skg = $("#count_presensi_skg").text();
		$("#rows_presensi__"+count_presensi_skg).prop("style","background:linear-gradient(#080,#006); border: solid 5px yellow");
		$("#is_sekarang__"+count_presensi_skg).text("Sekarang");
		$("#nama_subject_skg").text($("#nama_subject_skg__"+count_presensi_skg).val());



		$(".btn_claim_presensi").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var id_room_subject = rid[1];
			var jumlah_soal_in_room_subjects = parseInt($("#jumlah_soal_in_room_subjects__"+id_room_subject).text());
			var nama_subject = $("#nama_subject__"+id_room_subject).text();
			var jumlah_soal_minimal = parseInt($("#jumlah_soal_minimal").val());

			var date_jadwal = $("#date_jadwal__"+id_room_subject).text();
			var date_open = $("#date_open__"+id_room_subject).text();
			var date_close = $("#date_close__"+id_room_subject).text();

			// let cnickname = $('#cnickname').val(); //zzz debug
			// if(cnickname=='salwa') jumlah_soal_in_room_subjects = 3; //zzz debug

			if(jumlah_soal_in_room_subjects<jumlah_soal_minimal) {
				alert(`Kamu wajib publish ${jumlah_soal_minimal} soal di sesi ${nama_subject}. Silahkan klik dahulu Tambah Soal!`)
				return
			}


			$("#id_room_subject_selected").val(id_room_subject);
			$("#td_nama_subject").text(nama_subject);
			$("#td_nama_subject2").text(nama_subject);

			var d = new Date();
			var date_now = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
			$("#td_date_now").text(date_now);
			$("#td_date_jadwal").text(date_jadwal);
			$("#td_date_open").text(date_open);
			$("#td_date_close").text(date_close);

			$("#td_jumlah_soal").text(jumlah_soal_in_room_subjects);

			// $("#presensi").hide();
			$("#presensi_feedback").show();
			$("#presensi").slideUp();


		})


		$("#btn_back_to_list_presensi").click(function(){
			$("#presensi_feedback").hide();
			$("#presensi").fadeIn();

		})


	})
</script>

<?php include "presensi_feedback.php"; ?>