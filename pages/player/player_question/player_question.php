<?php
$aksi = '';
if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
}
$id_room_subject_selected = '';
if (isset($_GET['id_room_subject_selected'])) {
    $id_room_subject_selected = $_GET['id_room_subject_selected'];
}


define('max_publish_per_sesi', 3);
define('max_soal_per_sesi', 10);

$ket_jumlah_soal = 'Keterangan Jumlah Soal:<ul>';

$s = "SELECT 
	a.id_room_subject,  
	a.status_soal,  
	a.visibility_soal   
	FROM tb_soal a 
	JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
	JOIN tb_room c on b.id_room=c.id_room 
	WHERE a.soal_creator = '$cnickname' 
	AND c.id_room = $cid_room 
	AND a.visibility_soal != -2 
	";

// die("<pre>$s</pre>");

$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d = mysqli_fetch_assoc($q)) {
    $id_room_subject = $d['id_room_subject'];
    $status_soal = $d['status_soal'];
    $visibility_soal = $d['visibility_soal'];
}

// $ket_jumlah_soal .= "<li>Total Soal: $my_soal_total</li>";
$ket_jumlah_soal .= '</ul>';

?> 




<section id="player_questions" class="player blok_question">
	<div class="container">

		<h3>My Questions</h3>

		<!-- ======================================= -->
		<!-- REKAP SOAL -->
		<!-- ======================================= -->
		<?php //include 'player_question_rekap.php';?>
		<p>Room <?=$nama_room ?></p>


		<!-- ======================================= -->
		<!-- FILTER SOAL -->
		<!-- ======================================= -->
		<?php include 'player_question_filter.php'; ?>

		<!-- ======================================= -->
		<!-- LIST QUESTION STYLES -->
		<!-- ======================================= -->
		<style type="text/css">
			.blok_materi_tentang{
				border-bottom: solid 1px #ccc;
				margin: 10px 0 15px 0;
				padding-bottom: 15px;
				display: grid;
				grid-template-columns: 130px auto;
			}
			.row_soal{ 
				margin: 25px 0;
				border: solid 1px #ccc; 
				padding: 10px; 
				border-radius:5px;
				/*background: linear-gradient(#060,#404);*/
				font-family: 'century gothic';
			}

			#list_questions { margin-top: 10px; }
			#list_questions ul { margin: 0; font-size: small; }
			#list_questions a { color: #0ff; transition: .2s; }
			#list_questions a:hover { color: yellow; letter-spacing: 2px; text-transform: uppercase; }

			#tb_ket_soal td{
				border: solid 1px #333; 
				padding:2px 5px; 
				font-size:8pt}
			#list_questions .det_soal span{font-size: 10pt; }

			.kalimat_soal { display: grid; grid-template-columns: 40px auto; margin-bottom: 15px;}
			.blok_opsi_pg { display: grid; grid-template-columns: 25px auto 80px; }
			.btn_set_benar { background: lightgray; width: 100%; margin: 2px 0 2px 5px; color: #aaa;}
			.btn_set_benar:hover { background: lightgreen; }

			.btn_set_benar_true { color: black; font-weight: bold; background: lightgreen; border: solid 2px white; }


			.ket_soal { font-size: ; margin-top: 15px; border-top:  solid 1px #ccc; padding-top: 10px;}

			.nomor_soal { text-align: center; background: #447; border: solid 1px #ccc; border-radius: 5px; padding-top: 4px; max-height: 38px; margin-right: 7px; }

			.opsi_jawaban { margin-left: 40px; }
			.opsi_benar { color: #0f0; font-weight: bold; }
			.kalimat_soal { color: #cfc; }
			.jawaban_benar { color: #7f7; margin-top:  10px}
			.jawaban_benar, .kalimat_soal { font-weight: bold; }
			.jawaban_salah { color: #faa; }

			.aksi_soal { margin: -4px; margin-top: 10px;}
			.aksi_soal div { margin: 0; padding: 4px; }

			.editable { 
				background: #060;
				padding: 5px; 
				border: solid 1px #aa6;
				border-radius: 5px;
				transition: .2s;
			}

			.editable:hover{
				letter-spacing: 1px;
			}

			.ket_editable{
				color: tomato; font-size: small;
			}

			.ket_tags{
				margin: 10px 0;
			}

			.ket_tags .tags{
				color: yellow;
				font-family: consolas;
			}

		</style>

		<!-- ======================================= -->
		<!-- LIST QUESTION HERE -->
		<!-- ======================================= -->
		<div id="list_questions"></div>
		<!-- ======================================= -->

		<div class="row">
			<div class="col-lg-4">
				<button class="btn btn-success btn-block btn_add_soal">Add Soal</button>
			</div>
		</div>

	</div>
</section>




<?php include 'js_soal_functions.php'; ?>
<?php include 'js_soal_doc_ready.php'; ?>
<?php include 'js_soal_editable.php'; ?>
<?php include 'js_soal_set_kj_benar.php'; ?>
<?php include 'js_soal_set_materi.php'; ?>
<?php include 'js_soal_btn_aksi.php'; ?>
<?php include 'js_soal_cek_similar.php'; ?>
