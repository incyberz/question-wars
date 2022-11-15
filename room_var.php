<?php 
if ($cid_room>0){
	# ================================================
	# ROOM_VARS
	# ================================================
	$cid_room=$cid_room;

	# ================================================
	# ROOM PROPERTIES
	$total_player = 0;
	$jumlah_player_in_kelas = 0;
	$jumlah_player_in_prodi = 0;

	$rank_player = 0;
	$rank_player_in_kelas = 0;
	$rank_player_in_prodi = 0;


	# ================================================
	# ROOM_VARS :: PRESENSI
	$jumlah_presensi = 0;
	$total_presensi_saat_ini = 0;
	$total_presensi = 14; //zzz must be fixed

	# ================================================
	# ROOM_VARS :: SOAL
	$jumlah_soal_publish = 0;
	$jumlah_soal_banned = 0;
	$jumlah_soal_suspend = 0;
	$jumlah_soal_new = 0;
	$total_soal = 0;

	# ================================================
	# ROOM_VARS :: CHALLENGES
	$jumlah_chal = 0;
	$jumlah_chal_unclaim = 0;
	$jumlah_chal_claimed = 0;
	$jumlah_chal_unver = 0;
	// $jumlah_chal_point = 0;
	$total_chal = 0;
	$total_chal_point = 0;

	# ================================================
	# ROOM_VARS :: CHALLENGE TUGAS
	$jumlah_tugas = 0;
	$total_tugas = 0;


	# ================================================
	# OTHER ACTIVITY
	$jumlah_play = 0;
	$jumlah_play_benar = 0;
	$jumlah_play_salah = 0;
	$jumlah_play_timed_out = 0;
	$jumlah_reject = 0;
	$jumlah_daily_login = 0;

	$total_play_kuis = 0;
	$total_aktif_player = 0;

	# ================================================
	# OUTPUT PERSEN
	$persen_presensi = 0;
	$persen_akurasi = 0;
	$persen_chal = 0;
































	# ================================================
	# GET DATA PLAYER + PRODI
	# ================================================
	$s = "SELECT * from tb_room a 
	where a.id_room = '$cid_room'";
	$q = mysqli_query($cn, $s) or die("Error room_var1 Can't get data room");
	$d = mysqli_fetch_assoc($q);

	$nama_room  = ucwords(strtolower($d['nama_room']));
	$room_created  = $d['room_created'];
	$room_active_points  = $d['room_active_points'];


	# ================================================
	# SUBJECTS OF ROOM
	# ================================================
	$nama_subject_options = '';
	$s = "SELECT * from tb_room_subject a 
	join tb_room b on a.id_room = b.id_room  
	where b.id_room = '$cid_room'";
	$q = mysqli_query($cn, $s) or die("Error room_var2 Can't get data room".mysqli_error($cn));

	if (mysqli_num_rows($q)>0) {
		while ($d2 = mysqli_fetch_assoc($q)) {
			$nama_subject = $d2['nama_subject'];
			$id_room_subject = $d2['id_room_subject'];
			$nama_subject_options .= "<option value='$id_room_subject'>$nama_subject</option>";
		}
	}else{
		$s = "INSERT INTO tb_room_subject (id_room,nama_subject) values ($cid_room,'MATERI UMUM $nama_room')";
		if($dm) {
			$q = mysqli_query($cn, $s) or die("Error room_var3 Insert new room subjects <hr>SQL: $s<hr> ".mysqli_error($cn));
		}else{
			$q = mysqli_query($cn, $s) or die("Error room_var3 Insert new room subjects");
		}

		if ($q) {
			$s = "SELECT * from tb_room_subject a 
			join tb_room b on a.id_room = b.id_room  
			where b.id_room = '$cid_room'";
			$q = mysqli_query($cn, $s) or die("Error room_var4 Can't get data room");

			$d2 = mysqli_fetch_assoc($q);
			$nama_subject = $d2['nama_subject'];
			$id_room_subject = $d2['id_room_subject'];
			$nama_subject_options .= "<option value='$id_room_subject'>$nama_subject</option>";
		}
	}

	include 'room_var_update.php';
}
?>