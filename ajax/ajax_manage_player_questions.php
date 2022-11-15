<?php
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_SESSION['admin_level'])) die(erjx(3));
$nickname = $_SESSION['nickname'];
$id_room = $_SESSION['id_room'];
$admin_level = $_SESSION['admin_level'];

if(!isset($_GET['keywords'])) die(erjx(4)); $keywords = $_GET['keywords'];

if(!isset($_GET['include_banned'])) die(erjx(5)); $include_banned = $_GET['include_banned'];
if(!isset($_GET['include_suspend'])) die(erjx(6)); $include_suspend = $_GET['include_suspend'];
if(!isset($_GET['include_verified'])) die(erjx(7)); $include_verified = $_GET['include_verified'];
if(!isset($_GET['include_promoted'])) die(erjx(8)); $include_promoted = $_GET['include_promoted'];

if(!isset($_GET['include_mudah'])) die(erjx(9)); $include_mudah = $_GET['include_mudah'];
if(!isset($_GET['include_sedang'])) die(erjx(10)); $include_sedang = $_GET['include_sedang'];
if(!isset($_GET['include_sulit'])) die(erjx(11)); $include_sulit = $_GET['include_sulit'];
if(!isset($_GET['include_menjebak'])) die(erjx(12)); $include_menjebak = $_GET['include_menjebak'];

$sql_banned = " 0 "; if($include_banned=="true") $sql_banned=" a.is_banned is not null ";
$sql_suspend = " 0 "; if($include_suspend=="true") $sql_suspend=" a.is_approved_by_gm=0 ";
$sql_verified = " 0 "; if($include_verified=="true") $sql_verified=" (a.is_approved_by_gm=1 or a.is_approved_by_com=1 ) ";
$sql_promoted = " 0 "; if($include_promoted=="true") $sql_promoted=" a.is_approved_by_gm=2 ";

$batas_ratio_mudah = 0.5;
$batas_ratio_sedang = 1.5;
$batas_ratio_sulit = 3;

$sql_mudah = " 1 ";
$sql_sedang = " 1 ";
$sql_sulit = " 1 ";
$sql_menjebak = " 1 ";

if($include_mudah=="false") $sql_mudah=" ((salah_count+5)/(benar_count+5))>$batas_ratio_mudah ";
if($include_sedang=="false") $sql_sedang=" (((salah_count+5)/(benar_count+5))<=$batas_ratio_mudah or ((salah_count+5)/(benar_count+5))>=$batas_ratio_sedang)  ";
if($include_sulit=="false") $sql_sulit=" (((salah_count+5)/(benar_count+5))<$batas_ratio_sedang or ((salah_count+5)/(benar_count+5))>=$batas_ratio_sulit)  ";
if($include_menjebak=="false") $sql_menjebak=" ((salah_count+5)/(benar_count+5))<$batas_ratio_sulit   ";

include "../config.php";
$s = "
	SELECT 
	a.*,
	d.nama_player, 
	((salah_count+5)/(benar_count+5)) as soal_ratio, 
	(benar_count+salah_count) as play_count 
	
	from tb_soal a 
	JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
	join tb_room c on b.id_room=c.id_room 
	join tb_player d on a.soal_creator=d.nickname  
	where c.id_room = $id_room 
	and d.admin_level = 1 
	and (d.nama_player like '%$keywords%' or a.kalimat_soal like '%$keywords%') 
	and (a.is_banned is null or $sql_banned) 
	and (a.is_approved_by_gm is null or $sql_suspend or $sql_verified or $sql_promoted) 

	and ($sql_mudah and $sql_sedang and $sql_sulit and $sql_menjebak) 

	and a.visibility_soal=1 

	ORDER BY a.count_reject desc,  soal_ratio desc, play_count,tgl_edit desc 
	";
$q = mysqli_query($cn,$s) or die("Error @ajax. SQL error. ".mysqli_error($cn));
$jumlah_rows = mysqli_num_rows($q);

$s.= " limit 100";
$q = mysqli_query($cn,$s) or die("Error @ajax. Limitted SQL error. ".mysqli_error($cn));


$output="
<table class='table table-bordered table-hover table-striped'>
	<thead>
		<th>No</th>
		<th>Creator</th>
		<th>Questions <span class='badge badge-info' style='font-size:10pt'>$jumlah_rows</span></th>
		<th>Options</th>
		<th width='100px'>Info <span class='badge badge-info help' id='help__info_soal'>?</span></th>
		<th>Actions</th>
	</thead>
	";
if(mysqli_num_rows($q)==0) {
	$output="<div class='rounded-border'>No Data. Saatnya untuk membuat soal pertamamu di <a href='?myq'>My Questions</a>.</div>";
}else{

	// $output.="<tr><td colspan=6 align=center>
	// 	<table width='100%' style='background: linear-gradient(#449,#444);'>
	// 		<tr>
	// 			<td align=center>
	// 				Auto verified digunakan untuk soal dg play_count >= 30% total room players atau play_count >= 30 &nbsp;&nbsp;
	// 				<button class='btn btn-primary btn-primary btn-sm' id='btn_auto_verified'>Auto Verified</button>
	// 			</td>
	// 		</tr>
	// 	</table>
	// </td></tr>";

	$i=0;
	while ($d=mysqli_fetch_assoc($q)) {
		$i++;
		$id_soal = $d['id_soal'];
		$tipe_soal = $d['tipe_soal'];
		$level_soal = $d['level_soal'];
		$kalimat_soal = $d['kalimat_soal'];
		$soal_creator = $d['soal_creator'];
		$nama_player = $d['nama_player'];

		$is_banned = $d['is_banned'];
		
		$jawaban_pg = $d['jawaban_pg'];
		$jawaban_tf = $d['jawaban_tf'];
		$jawaban_isian = $d['jawaban_isian'];
		$opsi_pg1 = "a. ".$d['opsi_pg1'];
		$opsi_pg2 = "b. ".$d['opsi_pg2'];
		$opsi_pg3 = "c. ".$d['opsi_pg3'];
		$opsi_pg4 = "d. ".$d['opsi_pg4'];

		$benar_count = $d['benar_count'];
		$salah_count = $d['salah_count'];
		$is_approved_by_gm = $d['is_approved_by_gm'];
		$is_approved_by_com = $d['is_approved_by_com'];
		$earned_points = $d['earned_points'];
		$gm_point = $d['gm_point'];
		$gm_comment = $d['gm_comment'];
		$count_reject = $d['count_reject'];
		$count_report = $d['count_report'];
		$last_answered = $d['last_answered'];
		$durasi_jawab = $d['durasi_jawab'];
		
		# ====================================================
		# RATIO PLAY_COUNT
		# ====================================================
		$soal_ratio = round($d['soal_ratio'],2);
		$play_count = $d['play_count'];

		# ====================================================
		# VAR PROCESSING
		# ====================================================
		$tr_class = '';
		if ($is_banned) $tr_class = "banned";

		if ($soal_ratio<$batas_ratio_mudah) {
			$soal_ratio = "<span class='badge badge-success'>$soal_ratio</span>"; 
			if(!$is_banned) $tr_class = "mudah";
		}
		if ($soal_ratio>=$batas_ratio_mudah and $soal_ratio<$batas_ratio_sedang) 
			$soal_ratio = "<span class='badge badge-primary'>$soal_ratio</span>";
		if ($soal_ratio>=$batas_ratio_sedang and $soal_ratio<$batas_ratio_sulit) 
			$soal_ratio = "<span class='badge badge-warning'>$soal_ratio</span>";
		if ($soal_ratio>=$batas_ratio_sulit) {
			$soal_ratio = "<span class='badge badge-danger'>$soal_ratio</span>"; 
			if(!$is_banned)$tr_class = "sulit";
		}

		if($count_reject>0) $count_reject = "<span class='badge badge-danger besar'>$count_reject</span>";


		switch(strtolower($jawaban_pg)){
			case "a": $opsi_pg1 = "<span class='jawaban_benar'>$opsi_pg1</span>"; break;
			case "b": $opsi_pg2 = "<span class='jawaban_benar'>$opsi_pg2</span>"; break;
			case "c": $opsi_pg3 = "<span class='jawaban_benar'>$opsi_pg3</span>"; break;
			case "d": $opsi_pg4 = "<span class='jawaban_benar'>$opsi_pg4</span>"; break;
		}


		$btn_actions = '';
		if(!$is_banned and $is_approved_by_gm=="")$btn_actions = "
		<button class='btn btn-danger btn-sm btn-block btn_aksi' id='btn_banned__$id_soal' style='padding:3px 8px'>Banned</button>
		<button class='btn btn-warning btn-sm btn-block btn_aksi' id='btn_suspend__$id_soal' style='padding:3px 8px;'>Suspend</button>
		<button class='btn btn-primary btn-sm btn-block btn_aksi' id='btn_approved__$id_soal' style='padding:3px 8px'>Verified</button>
		<button class='btn btn-success btn-sm btn-block btn_aksi' id='btn_promoted__$id_soal' style='padding:3px 8px'>Promoted</button>
		";


		$blok_banned = '';
		if($is_banned){
			$ss = "SELECT b.nama_player from tb_soal_rejectby a 
			join tb_player b on a.nickname=b.nickname 
			where a.id_soal='$id_soal' and a.nickname='$nickname'";
			$qq = mysqli_query($cn,$ss) or die("Tidak bisa menampilkan Rejecters");
			$li_rejecters = '';
			while($dd=mysqli_fetch_assoc($qq)){
				$li_rejecters.= "<li>".$dd['nama_player']."</li>";
			}
			$blok_banned = "
			<div id='blok_alasan_banned'>
				Alasan Banned:
				<select id='alasan_banned__$id_soal' class='form-control input-sm' style='font-size:10pt;margin-bottom:10px'>
					<option>Jawaban Ganda</option>
					<option>Tidak Ada Jawaban</option>
					<option>Salah Posisi Jawaban</option>
					<option>Soal Terlalu Mudah</option>
					<option>Out of Topic</option>
					<option>Asal-asalan</option>
					<option value='99'>Alasan lainnya</option>
				</select>
				
				Rejecters: 
				<ol style='font-size:8pt'>$li_rejecters</ol>
				<small>Ket: Point creator [$earned_points EP] akan menjadi negatif dan diberikan Report Point bagi pelapor</small>
				<button class='btn btn-primary btn-sm btn-block' id='btn_apply_banned__$id_soal'>Apply Banned</button>
				<button class='btn btn-warning btn-sm btn-block' id='btn_undo_banned__$id_soal'>Undo Banned</button>
			</div>
			";
		} 


		$blok_approv = '';
		if($is_approved_by_gm!=""){
			$bonus_point_default = 0;
			$judul_approv = "Soal Suspended";
			$style_approv = "info";

			$ket_approv = "Bonus Point dari GM bagi Soal Verified dan Soal Promoted";
			if($is_approved_by_gm==0)$ket_approv = "<span class='tebal merah'>Soal suspended (dinonaktifkan) wajib ada komentar dari GM</span>";
			
			if($is_approved_by_gm==1){$bonus_point_default = 10;$judul_approv="Verified by GM"; $style_approv="primary";}
			if($is_approved_by_com==1){$bonus_point_default = 10;$judul_approv="Community Verified"; $style_approv="primary";}
			if($is_approved_by_gm==2){$bonus_point_default = 30;$judul_approv="Promoted by GM"; $style_approv="success";}

			$btn_promoted = '';
			if($is_approved_by_gm==1 or $is_approved_by_com==1)$btn_promoted = "
			<button class='btn btn-success btn-sm btn-block btn_aksi' id='btn_promoted__$id_soal' style='padding:3px 8px'>Promoted</button>
			";

			$blok_approv = "
			<div id='blok_alasan_approv'>
				<h4><span class='badge badge-$style_approv'>$judul_approv</span></h4>
				GM Comment:
				<textarea class='form-control'></textarea>
				Bonus Poin:
				<input type='number' class='form-control' value='$bonus_point_default'> 
				
				<small>Ket: $ket_approv</small>
				<button class='btn btn-primary btn-sm btn-block' id='btn_apply_approv__$id_soal'>Apply Approv</button>
				<button class='btn btn-warning btn-sm btn-block' id='btn_undo_approv__$id_soal'>Undo Approv</button>
				$btn_promoted
			</div>
			";
		} 



		# ===============================================================
		# PERFORM AUTO VERIFIED
		# ===============================================================
		$ss = "SELECT 1 from tb_room_player a join tb_player b on a.nickname=b.nickname 
		where a.id_room = '$id_room' and b.admin_level=1";
		$qq = mysqli_query($cn,$ss) or die("Tidak bisa menghitung jumlah peserta room");
		$total_player = mysqli_num_rows($qq);
		$jumlah_acuan = intval($total_player/3);
		if($jumlah_acuan>30) $jumlah_acuan=30;

		if($play_count >= $jumlah_acuan){
			$ss = "UPDATE tb_soal set is_approved_by_gm=1,is_approved_by_com=1 
			where count_reject=0 and id_soal='$id_soal' and is_banned is null and (benar_count+salah_count)>=$jumlah_acuan";
			$qq = mysqli_query($cn,$ss) or die("Gagal auto-approve by community. id: $id_soal");

		}





		


		$output.= "
		<tr class='$tr_class' id='baris_$id_soal'>
			<td>$i</td>
			<td>$nama_player</td>
			<td class='kalimat_soal'>$kalimat_soal</td>
			<td>
				$opsi_pg1
				<br>$opsi_pg2
				<br>$opsi_pg3
				<br>$opsi_pg4
			</td>
			<td>
				S/B: $salah_count/$benar_count
				<br>Ratio: $soal_ratio
				<br>EP: $earned_points
				<br>Rej: $count_reject
			</td>
			<td>

				<table>
					<tr>
						<td style='padding:0; border:none'>

							$btn_actions
							$blok_banned
							$blok_approv

						</td>
					</tr>
				</table>


			</td>
		</tr>
		";
	}
}


$output.="</table>";

$pesan_auto = "<p><small>Relax!! Auto Banned is <span class='badge badge-success help' id='help__auto_banned'>ON</span>. Auto Verified is <span class='badge badge-success help' id='help__auto_verified'>ON</span>. Anda boleh ikut memverifikasi soal yang belum terverifikasi oleh sistem.</small></p>";


echo "$pesan_auto $output";
?>

<style type="text/css">
	.tabelku td{padding: 5px;}
</style>

