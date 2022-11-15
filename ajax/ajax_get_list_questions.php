<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}
include "../config.php";

$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die(erjx('nickname'));
$cid_room = isset($_SESSION['id_room']) ? $_SESSION['id_room'] : die(erjx('id_room'));
$admin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die(erjx('admin_level'));

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : die(erjx('keyword'));
$id_room_subject = isset($_GET['id_room_subject']) ? $_GET['id_room_subject'] : die(erjx('id_room_subject'));
$status_soal = isset($_GET['status_soal']) ? $_GET['status_soal'] : die(erjx('status_soal'));
$visibility_soal = isset($_GET['visibility_soal']) ? $_GET['visibility_soal'] : die(erjx('visibility_soal'));

# =========================================
# VAR SESI MK
# =========================================
include '../var_sesi_mk.php';
$select_sesi_mk = '';

$sql_id_room_subject  = $id_room_subject=='all' ? " 1 " : " b.id_room_subject='$id_room_subject' ";
$sql_status_soal  = $status_soal=='all' ? " 1 " : " a.status_soal='$status_soal' ";
$sql_visibility_soal  = $visibility_soal=='all' ? " 1 " : " a.visibility_soal='$visibility_soal' ";



# =========================================
# GET MY QUESTIONS
# =========================================
$s = "
	SELECT a.*, 

	( SELECT count(1) FROM tb_soal_playedby  
		WHERE id_soal=a.id_soal 
		) AS jumlah_play, 

	( SELECT count(1) FROM tb_soal_playedby  
		WHERE id_soal=a.id_soal 
		AND dijawab_benar = 1 
		) AS jumlah_play_benar, 

	( SELECT count(1) FROM tb_soal_playedby  
		WHERE id_soal=a.id_soal 
		AND dijawab_benar = 0 
		) AS jumlah_play_salah, 

	( SELECT count(1) FROM tb_soal_playedby  
		WHERE id_soal=a.id_soal 
		AND dijawab_benar is null  
		) AS jumlah_play_timed_out, 

	( SELECT count(1) FROM tb_soal_rejectby  
		WHERE id_soal=a.id_soal 
		) AS jumlah_reject, 
		
	( SELECT tags FROM tb_kelengkapan_presensi   
		WHERE id_room_subject=b.id_room_subject 
		) AS tags, 
		

	b.nama_subject,
	d.*,
	e.* 

	FROM tb_soal a 
	JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
	JOIN tb_room c on b.id_room=c.id_room 
	JOIN tb_soal_status d on a.status_soal=d.status_soal 
	JOIN tb_soal_visibility e on a.visibility_soal=e.visibility_soal 
	WHERE a.soal_creator = '$cnickname' 
	AND c.id_room = $cid_room 
	AND a.kalimat_soal LIKE '%$keyword%'
	AND $sql_id_room_subject 
	AND $sql_status_soal 
	AND $sql_visibility_soal
	AND a.visibility_soal != -2 
	AND b.nama_subject NOT LIKE '%materi umum%' 
	ORDER BY a.tanggal_buat DESC, a.is_banned, a.is_approved_by_gm desc 
	LIMIT 100
	";

	// die("<pre>$s</pre>");

$q = mysqli_query($cn,$s) or die("Error @ajax. SQL error. ".mysqli_error($cn));
$jumlah_soal = mysqli_num_rows($q);


# =========================================
# INITIALIZE OUTPUT
# =========================================
$o='';
if(mysqli_num_rows($q)==0) $o="<div class='rounded-border' style='margin-bottom:10px'>No Data. Filter lagi atau silahkan buat soal baru!</div>";

$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$i++;
	$id_soal = $d['id_soal'];
	$tipe_soal = $d['tipe_soal'];
	$level_soal = $d['level_soal'];
	$kalimat_soal = $d['kalimat_soal'];
	
	$jawaban_pg = $d['jawaban_pg'];
	$jawaban_tf = $d['jawaban_tf'];
	$jawaban_isian = $d['jawaban_isian'];
	$opsi_pg1 = $d['opsi_pg1'];
	$opsi_pg2 = $d['opsi_pg2'];
	$opsi_pg3 = $d['opsi_pg3'];
	$opsi_pg4 = $d['opsi_pg4'];
	$opsi_pg5 = $d['opsi_pg5'];

	$is_approved_by_gm = $d['is_approved_by_gm'];
	$earned_points = $d['earned_points'];
	$gm_point = $d['gm_point'];
	$gm_comment = $d['gm_comment'];
	$jumlah_reject = $d['jumlah_reject'];
	$count_report = $d['count_report'];
	$last_answered = $d['last_answered'];
	$durasi_jawab = $d['durasi_jawab'];

	$jumlah_play = $d['jumlah_play'];
	$jumlah_play_benar = $d['jumlah_play_benar'];
	$jumlah_play_salah = $d['jumlah_play_salah'];
	$jumlah_play_timed_out = $d['jumlah_play_timed_out'];
	$is_banned = $d['is_banned'];

	$status_soal = $d['status_soal'];
	$nama_status = $d['nama_status'];
	$ket_status = $d['ket_status'];

	$visibility_soal = $d['visibility_soal'];
	$nama_visibility = $d['nama_visibility'];
	$ket_visibility = $d['ket_visibility'];

	$nama_subject = $d['nama_subject'];

	$id_room_subject = $d['id_room_subject'];
	$tags = $d['tags'];
	$tags_soal = $d['tags_soal'];

	# ============================================================
	# VAR PROCESSING
	# ============================================================
	$tags_soal_show = str_replace(',', ', ', $tags_soal);

	$jumlah_reject_show = $jumlah_reject==0?'<i>none</i>':"<span class='help badge badge-danger' id='jumlah_reject__$id_soal'>$jumlah_reject</span> players";

	$soal_ratio = round(($jumlah_play_salah+5)/($jumlah_play_benar+5),2);
	$tk_sulit = "Level: Undefined";
	$tk_sulit_sty = "secondary";

	if($jumlah_play>=10){
		if($soal_ratio<0.5){$tk_sulit="Soal Mudah"; $tk_sulit_sty="success";}
		if($soal_ratio>=0.5 and $soal_ratio<=1.5){$tk_sulit="Soal Sedang"; $tk_sulit_sty="primary";}
		if($soal_ratio>1.5 and $soal_ratio<=3){$tk_sulit="Soal Sulit"; $tk_sulit_sty="warning";}
		if($soal_ratio>3){$tk_sulit="Soal Menjebak"; $tk_sulit_sty="danger";}
	}





	$verif = "<span class='badge badge-danger'>Danger</span>";

	# ============================================================
	# STATUS SOAL:
	# ============================================================
	# -1 Banned
	# 0 Unverified
	# 1 Verified by Comunity
	# 2 Decided by GM
	# 3 Promoted
	# 4 Starred
	# ============================================================

	# ============================================================
	# VISIBILITY SOAL:
	# ============================================================
	# -2 DELETED (HIDDEN FROM ALL) >> NOT DESIGN PROCEDED
	# -1 SUSPEND (UNPUBLISH)
	# 0 NEW
	# 1 PUBLISH
	# ============================================================





	# ============================================================
	# BUTTONS VALIDATIONS FOR STATUS SOAL
	# ============================================================
	$bg_soal = 'red';
	$banned = '<span class="badge badge-danger">SOAL TERKENA BANNED</span>';
	$unver = '<span class="badge badge-warning">UNVERIFIED</span>';
	$dverif = '<span class="badge badge-success">VERIFIED</span>';
	$like_from_gm = '<span class="badge badge-primary">GM-DECIDED</span>';
	$medal = '<span class="badge badge-primary">GM-PROMOTED</span>';
	$crown = '<span class="badge badge-primary">GM-CROWNED</span>';
	# IF -1 BANNED ... BG RED + DISABLE ALL EXCEPT COPY
	# IF 0 UNVERIFIED ... BG YELLOW
	# IF 1 VERIFIED ... BG GREEN
	# IF 2 DECIDED ... BG GREEN + LIKE FROM GM
	# IF 3 PROMOTED ... BG PINK + MEDAL
	# IF 4 STARRED ... BG PINK + MEDAL + CROWN
	switch ($status_soal) {
		case -1: $bg_soal = 'red'; 		$drank = "$banned"; break;
		case 0: $bg_soal = '#955'; 		$drank = "$unver"; break;
		case 1: $bg_soal = 'green'; 	$drank = "$dverif"; break;
		case 2: $bg_soal = '#0f0';		$drank = "$like_from_gm"; break;
		case 3: $bg_soal = 'hotpink'; $drank = "$medal"; break;
		case 4: $bg_soal = 'gold'; 		$drank = "$crown"; break;
		default: die("switch status_soal: $status_soal can not be accepted.");
	}


	# ============================================================
	# DESIGN FOR UNVERIFIED OR VERIFIED SOAL
	# ============================================================
	$select_sesi_mk = $nama_subject;
	if($status_soal != 0){

		# ============================================================
		# BANNED | VERIFIED
		# ============================================================
		$class_editable = '';
		$class_hide_kj = 'hideit';

		if($status_soal == -1){
			# ============================================================
			# BANNED SOAL
			# ============================================================
			$ket_visibility = '';
			$btn_states = '1001';
		}else{
			# ============================================================
			# VERIFIED SOAL
			# ============================================================

		}

	}else{

		# ============================================================
		# UNVERIFIED SOAL
		# ============================================================
		# DAPAT SELECT SESI MK
		# DAPAT DIEDIT
		# DAPAT SET KUNCI JAWABAN



		# ============================================================
		# SELECT SESI MK
		# ============================================================
		if($visibility_soal == 0){
			$select_sesi_mk = "<select class='form-control row_sesi_mk input-sm' id='id_room_subject__$id_soal'>";
			for ($j=0; $j < (count($rsesi_mks)-1); $j++) { 
				$selected = ($id_room_subject == $rid_room_subjects[$j]) ? 'selected' : '';
				$select_sesi_mk.="<option value='$rid_room_subjects[$j]' $selected>$rsesi_mks[$j]</option>";
			}
			$select_sesi_mk.= "</select>";

		}


		# ============================================================
		# EDITABLE PROCESSING FOR VISIBILITY SOAL
		# ============================================================
		# IF PUBLISHED DISABLE ALL EDITABLE
		# IF NEW SOAL ALL EDITABLE
		# IF SUSPEND IF JUMLAH BELUM DIJAWAB MAKA ALL EDITABLE
		$class_editable = '';
		$class_hide_kj = 'hideit';
		switch ($visibility_soal) {
			case -2: break; // NOTHING FOR HIDDEN DELETED SOAL
			case -1: $class_editable = ''; 					$class_hide_kj = 'hideit'; break; // SUSPEND 
			case  0: $class_editable = 'editable'; 	$class_hide_kj = ''; 			 break;	// NEW SOAL
			case  1: $class_editable = ''; 					$class_hide_kj = 'hideit'; break;	// PUBLISH
			default: die("switch visibility_soal: $visibility_soal can not be accepted.");
		}
	}


	# ============================================================
	# TIDAK BISA EDIT JIKA SUDAH ADA YG JAWAB/REJECT
	# ============================================================
	if($jumlah_play>0 or $jumlah_reject>0){
		$class_editable = '';
		$class_hide_kj = 'hideit';
		$select_sesi_mk = $nama_subject;
	}


	# ============================================================
	# BUTTONS VALIDATIONS FOR VISIBILITY SOAL
	# ============================================================
	$btn_states = '0000';

	$ani_wifi = '<img src="assets/img/gifs/wifi3.gif" style="border-radius:50%; width:40px; height:40px; object-fit: contain; padding: 3px; background: white; margin: 10px">';

	$bd_suspend = '<span class="badge badge-danger">SUSPEND / UNPUBLISH</span>';
	$bd_new_soal = '<span class="badge badge-warning">NEW SOAL / UNPUBLISH</span>';
	$bd_published = "<span class='badge badge-success'>PUBLISHED</span> $ani_wifi";
	# -2 DELETED ... NOTHING
	# -1 SUSPEND ... DELETE |         | PUBLISH | COPY
	# 0 NEW ........ DELETE |         | PUBLISH
	# 1 PUBLISH ....        | SUSPEND |         | COPY
	switch ($visibility_soal) {
		case -2: $dvis = 'DELETED'; $btn_states = '0000'; break;
		case -1: $dvis = $bd_suspend; $btn_states = '1011'; break;
		case 0: $dvis = $bd_new_soal; $btn_states = '1010'; break;
		case 1: $dvis = $bd_published; $btn_states = '0101'; break;
		default: die("switch visibility_soal: $visibility_soal can not be accepted.");
	}

	if($status_soal==-1) $btn_states = '0001';






	# ============================================================
	# KUNCI JAWABAN PROCESSING
	# ============================================================
	if ($tipe_soal==1) {
		$tipe_soal_cap = "PG";

		$kalimat_pembahasan = ''; //ZZZ

		$index_opsi = '';
		$btn_set_benar1 = '';
		$btn_set_benar2 = '';
		$btn_set_benar3 = '';
		$btn_set_benar4 = '';
		switch ($jawaban_pg) {
			case "A": $btn_set_benar1 = 'btn_set_benar_true'; $index_opsi = 1; break;
			case "B": $btn_set_benar2 = 'btn_set_benar_true'; $index_opsi = 2; break;
			case "C": $btn_set_benar3 = 'btn_set_benar_true'; $index_opsi = 3; break;
			case "D": $btn_set_benar4 = 'btn_set_benar_true'; $index_opsi = 4; break;
		}

		$is_benar1 = "<button class='btn btn_set_benar $btn_set_benar1' id='jawaban_pg__A__$id_soal'>Benar</button>";
		$is_benar2 = "<button class='btn btn_set_benar $btn_set_benar2' id='jawaban_pg__B__$id_soal'>Benar</button>";
		$is_benar3 = "<button class='btn btn_set_benar $btn_set_benar3' id='jawaban_pg__C__$id_soal'>Benar</button>";
		$is_benar4 = "<button class='btn btn_set_benar $btn_set_benar4' id='jawaban_pg__D__$id_soal'>Benar</button>";

		$penanda_opsi_benar = [];
		for ($j=1; $j <= 4 ; $j++) $penanda_opsi_benar[$j] = 'opsi_salah';

		$penanda_opsi_benar[$index_opsi] = 'opsi_benar';

		$opsi_jawaban = "
		<div class='opsi_jawaban'>
			<div class='blok_opsi_pg'>
				<div>a.</div>
				<div class='opsi_pg $class_editable $penanda_opsi_benar[1]' id='opsi_pg1__$id_soal'>$opsi_pg1</div>
				<div class='$class_hide_kj'>$is_benar1</div>
			</div>
			<div class='blok_opsi_pg'>
				<div>b.</div>
				<div class='opsi_pg $class_editable $penanda_opsi_benar[2]' id='opsi_pg2__$id_soal'>$opsi_pg2</div>
				<div class='$class_hide_kj'>$is_benar2</div>
			</div>
			<div class='blok_opsi_pg'>
				<div>c.</div>
				<div class='opsi_pg $class_editable $penanda_opsi_benar[3]' id='opsi_pg3__$id_soal'>$opsi_pg3</div>
				<div class='$class_hide_kj'>$is_benar3</div>
			</div>
			<div class='blok_opsi_pg'>
				<div>d.</div>
				<div class='opsi_pg $class_editable $penanda_opsi_benar[4]' id='opsi_pg4__$id_soal'>$opsi_pg4</div>
				<div class='$class_hide_kj'>$is_benar4</div>
			</div>

			<div class='hideit'>
				<div style='margin-top: 5px'><small class='pembahasan' id='pembahasan__$id_soal'>Pembahasan:</small></div>
				<div id='blok_pembahasan__$id_soal'>
					<textarea class='form-control'>$kalimat_pembahasan</textarea>
				</div>
			</div>
		</div>
		";
	}



	# ============================================================
	# DESAIN AKSI-AKSI BUTTONS
	# ============================================================
	$hide_delete 	= substr($btn_states, 0, 1)=='0' ? 'hideit' : '';
	$hide_suspend = substr($btn_states, 1, 1)=='0' ? 'hideit' : '';
	$hide_publish = substr($btn_states, 2, 1)=='0' ? 'hideit' : '';
	$hide_copy 		= substr($btn_states, 3, 1)=='0' ? 'hideit' : '';

	$btn_aksis = "
	<div class='row aksi_soal'>
		<div class='col-3 $hide_delete'>
			<button class='btn btn-block btn-sm btn-danger btn_aksi' id='delete__$id_soal'>Delete</button>
		</div>
		<div class='col-3 $hide_suspend'>
			<button class='btn btn-block btn-sm btn-warning btn_aksi' id='suspend__$id_soal'>Suspend</button>
		</div>
		<div class='col-3 $hide_publish'>
			<button class='btn btn-block btn-sm btn-primary btn_aksi' id='publish__$id_soal'>Publish</button>
		</div>
		<div class='col-3 $hide_copy'>
			<button class='btn btn-block btn-sm btn-success btn_aksi' id='copy__$id_soal'>Copy</button>
		</div>
	</div>
	";






	# ============================================================
	# EDITABLE KET
	# ============================================================
	$ket_editable = $class_editable=='' ? 'Soal tidak dapat diedit karena pernah di-publish, ada yang menjawab, di-reject, kena banned, atau sudah terverifikasi.' : '';



	# ============================================================
	# TAGS KET
	# ============================================================
	$tags_soal_none = $tags_soal=='' ? '<img src="assets/img/icons/warning.png" width="25px" />' : $tags_soal;
	$ket_tags = ($class_editable=='editable' AND $tags!='') ? "
	<div class='ket_tags wadah'>
		Perhatian! Untuk mencegah soal yang OOT (Out of Topic) maka kalimat soal atau opsi jawaban wajib mengandung minimal salah satu tags berikut: 
		<div class='tags' id='tags__$id_soal'>$tags</div>
		<div class='wadah' style='margin:10px 0'>
			Tags soal kamu: <span id='current_tags_soal__$id_soal' class='yellow'>$tags_soal_none</span>
		</div>
		<div class='wadah'>
			<button class='btn_cek_similar btn btn-warning btn-sm' id='btn_cek_similar__$id_soal'>Cek Similarity</button>
			<div style='margin-top:10px'>
				Hasil similarity: <span class='hasil_similarity red' id='hasil_similarity__$id_soal'>???</span> 
			</div>
		</div>
	</div>
	" : "
	<div class='ket_tags wadah'>
		<span class='tags'>Perhatian!</span> Saat ini belum bisa publish soal pada sesi ini karena dosen belum menentukan tags agar soal yang dibuat tidak OOT (Out of Topic). Silahkan segera hubungi dosen!
	</div>
	";
	if($visibility_soal!=0) $ket_tags = '';


	# ============================================================
	# DEBUG
	# ============================================================
	$debug = "
	<div class='debug'>
		id_soal: $id_soal | 
		status_soal:$status_soal |
		visibility_soal:$visibility_soal |
		id_room_subject:$id_room_subject |
		btn_states:$btn_states |
		<span id='tags_soal__$id_soal'>$tags_soal</span>

	</div>";


	# ============================================================
	# SET FULL OUTPUT
	# ============================================================
	$o.= "
		<div class='row_soal' style='background: linear-gradient($bg_soal,#404);' id='row_soal__$id_soal'>
			<div>$drank :: $dvis</div>
			<div class='blok_materi_tentang'>
				<div>Materi tentang</div><div>$select_sesi_mk</div>
				<div>Status</div><div>$ket_status. $ket_visibility</div>
			</div>

			<div class='kalimat_soal'>
				<div class='nomor_soal'>$i</div>
				<div class='$class_editable isi_kalimat_soal' id='kalimat_soal__$id_soal'>$kalimat_soal</div>
			</div>
			$opsi_jawaban
			$ket_tags
			$btn_aksis

			<div class='ket_soal'>
				<div>
					<div>Level: <span id='tingkat_kesulitan_soal__$id_soal' class='badge badge-$tk_sulit_sty help' style='margin:5px 5px 5px 0'>$tk_sulit</span> | Ratio: $soal_ratio</div>  
					<div>
						<a href='?playedby&id_soal=$id_soal'>Play Count:</a> 
						<span id='jumlah_play__$id_soal'>$jumlah_play</span> | 
						<span class='help badge badge-primary' id='jumlah_play_benar__$id_soal'>$jumlah_play_benar</span> 
						<span class='help badge badge-warning' id='jumlah_play_salah__$id_soal'>$jumlah_play_salah</span> 
						<span class='help badge badge-danger' id='jumlah_play_timed_out__$id_soal'>$jumlah_play_timed_out</span> 
					</div>
					<div>
						Reject by: $jumlah_reject_show
					</div>
				</div>
				<div>Earned Points: $earned_points LP</div>
				<div>Tags: $tags_soal_show</div>
				<div class='ket_editable'>$ket_editable</div>

			</div>
			$debug

		</div>
	";

}

$jumlah_soal_cap = $jumlah_soal==0?'':"<div style='margin: 10px 0 -20px 0; font-size: small;'>$jumlah_soal records found.</div>";

echo "<div class='debug'>$s</div> $jumlah_soal_cap $o";
?>