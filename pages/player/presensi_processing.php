<?php 
if (isset($_POST['btn_submit_presensi'])) {

	// if($cnickname!='salwa') die('Maaf, fitur claim presensi saat ini sedang di maintenance oleh Pak iin, harap tunggu sebentar!'); //zzz debug

	$is_kesulitan = $_POST['is_kesulitan'];
	$is_termotivasi = $_POST['is_termotivasi'];
	$kesulitan_ket = filter_var($_POST['kesulitan_ket2']);
	$kesan_ilmu = filter_var($_POST['kesan_ilmu']);
	$masukan_saran = filter_var($_POST['masukan_saran']);
	$id_room_subject = filter_var($_POST['id_room_subject_selected']);

	$id_presensi = $cnickname."_$id_room_subject";
	$poin_saat_ini = $room_player_point;
	$rank_saat_ini = $rank_player;




	# ===================================================
	# CEK ONTIME | TIDAK
	# ===================================================
	$s = "SELECT date_close FROM tb_room_subject where id_room_subject='$id_room_subject'";
	$q = mysqli_query($cn,$s) or die("Tidak dapat get date_close. ".mysqli_error($cn));
	if(mysqli_num_rows($q)!=1) die("id_room_subject: $id_room_subject tidak ditemukan pada database.");
	$d = mysqli_fetch_assoc($q);
	$date_close = $d['date_close'];

	$is_ontime = 'NULL';
	$jumlah_ontime = 0;
	$poin_presensi = 0;

	if( (strtotime($date_close)-strtotime(date('Y-m-d H:i:s'))) >= 0 ){
		$is_ontime = 1;

		# ===================================================
		# CEK JUMLAH ONTIME
		# ===================================================
		$s = "SELECT count(1) as jumlah_ontime FROM tb_presensi a 
		JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
		WHERE b.id_room = $cid_room 
		AND a.is_ontime=1 
		AND a.nickname = '$cnickname'
		";
		// die($s);
		$q = mysqli_query($cn,$s) or die("Tidak dapat menghitung is_ontime. ".mysqli_error($cn));
		if(mysqli_num_rows($q)!=0){
			$d = mysqli_fetch_assoc($q);
			$jumlah_ontime = $d['jumlah_ontime'];
		}

		$poin_presensi = 5000 + 5000*$jumlah_ontime;
		$jumlah_ontime++;

	}else{
		$poin_presensi = 2500;
	}




	$s = "INSERT INTO tb_presensi (

	id_presensi,
	id_room_subject,
	nickname,
	poin_saat_ini,
	rank_saat_ini,
	is_kesulitan,
	is_termotivasi,
	kesulitan_ket,
	kesan_ilmu,
	masukan_saran,
	poin_presensi,
	is_ontime

	) values (

	'$id_presensi',
	'$id_room_subject',
	'$cnickname',
	'$poin_saat_ini',
	'$rank_saat_ini',
	'$is_kesulitan',
	'$is_termotivasi',
	'$kesulitan_ket',
	'$kesan_ilmu',
	'$masukan_saran',
	'$poin_presensi',
	$is_ontime


	
	)";

	// die($s);


	$q = mysqli_query($cn,$s) or die("Tidak dapat menyimpan data presensi. ".mysqli_error($cn));



	# =====================================================
	# 2. UPDATE POIN PRESENTER
	# =====================================================
	$s = "UPDATE tb_room_player set 
	room_player_point = room_player_point + $poin_presensi   
	where nickname = '$cnickname' and id_room='$cid_room'";
	// die($s);
	$q = mysqli_query($cn,$s) or die("Error @ajax presensi_processing. $s");


	if($is_ontime==1){
		echo "
		<style>#sukses_feedback p{color: darkblue}</style>
		<div class='alert alert-success text-center' style='background: white' id='sukses_feedback'>
			<h3 class='biru'>Kamu Ontime!</h3>
			<p>Total Ontime: $jumlah_ontime</p>
			<img class='img_zoom' src='assets/img/gifs/thanks.gif'>
			<h4>Selamat! Kamu mendapat $poin_presensi Point Presensi.</h4>
			<small>Feedback dari kamu akan kami gunakan untuk pengembangan sistem. Terimakasih! [QWars-Dev-Team]</small> 
			<hr>
			<a href='?presensi' class='btn btn-primary btn-sm'>Go to Presensi List</a>
		</div>
		";
	}else{
		echo "
		<style>#sukses_feedback p{color: darkred}</style>
		<div class='alert alert-success text-center' style='background: white' id='sukses_feedback'>
			<h3 class='merah'>Kamu Telat Presensi!</h3>
			<hr>
			<img class='img_zoom' src='assets/img/gifs/late.gif' style='border-radius:15px; margin-bottom:15px'>
			<h4 class='merah'>Wahh kamu telat! Maaf, angpau nya dikit!!</h4>
			<p>Poin Presensi: $poin_presensi LP</p>
			<small>Lain kali jangan telat presensi ya. Terimakasih atas feedbacknya! [QWars-Dev-Team]</small> 
			<hr>
			<a href='?presensi' class='btn btn-primary btn-sm'>Go to Presensi List</a>
		</div>
		";

	}

	exit();

}

?>

