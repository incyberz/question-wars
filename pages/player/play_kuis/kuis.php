<?php 
$img_medal = "<img class='img_icon' src='assets/img/icons/medal.png' />";

$id_room_subject = isset($_GET['id_room_subject']) ? $_GET['id_room_subject'] : die('Index id_room_subject masih kosong.');


$ralasan_reject = [
	'Typho | Salah ketik',
	'Kalimat Rancu',
	'Jawaban Ganda',
	'Tak ada Jawaban',
	'Salah Posisi Jawaban',
	'Jawaban Ga Nyambung',
	'Out of Topic',
	'Alasan lainnya'
];

$alasan_rejects = '';
for ($i=1; $i <= count($ralasan_reject); $i++) { 
	$h = $i-1;
	$alasan_rejects .= "
	<div class='col-lg-6 blok_alasan' id='blok_alasan__$i'>
		<input type='radio' name='alasan_reject' id='alasan_reject__$i' class='alasan_reject' required=' value='$i'>
		<label for='alasan_reject__$i'>($i) $ralasan_reject[$h]</label>
	</div>
	";
}

$rket_rate = [
	'Soal pas-pasan',
	'Soal lumayan, pengetikan OK',
	'Soal sesuai tema sesi',
	'Sesuai tema dan soal baru (unik)',
	'Sesuai tema, unik, dan mantaf!'
];

include 'kuis_styles.php';
?>

<section id="sec_kuis_play" class="player">
	<div class="container">

		<!-- =================================================== -->
		<!-- KUIS VAR FROM JX_GET_PAKET_KUIS  -->
		<!-- =================================================== -->
		<?php include 'get_paket_soal.php'; ?>

		<div class="blok_kuis">
			<!-- =================================================== -->
			<!-- PLAYING BLOCK  -->
			<!-- =================================================== -->
			<?php include 'blok_tampil_soal.php'; ?>
		</div>


		<?php include 'blok_hasil_kuis.php'; ?>


	</div>
</section>

<?php include 'js_functions.php'; ?>
<?php include 'js_functions_set_tampilan.php'; ?>
<?php include 'js_functions_next_soal.php'; ?>
<?php include 'js_functions_cek_jawaban.php'; ?>
<?php include 'js_timer.php'; ?>
<?php include 'js_opsi_klik.php'; ?>
<?php include 'js_btn_aksi.php'; ?>
<?php include 'js_rate_soal.php'; ?>

<script type="text/javascript">
	// =========================================
	// WHEN DOCUMENT READY
	// =========================================
	$(document).ready(function(){
		// set_posisi_soal_ke(19);
		$('#blok_play').slideDown();
		next_soal();
	})
</script>
