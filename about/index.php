<?php 
session_start();
$dm=0;


$is_kuliah = 0;
$link_manage_chat_player = '';
$is_login = 0;
$cadmin_level = 0;
$cnama_player = "Unknown";
$cnama_panggilan = "Unknown";
$img_players = "No Players connected.";


# =====================================================
# SESSION VARIABLES
# =====================================================
if (isset($_SESSION['nickname'])){ 
  $is_login = 1;
  $cnickname = $_SESSION['nickname'];
  $cadmin_level = $_SESSION['admin_level'];
}else{

	# =====================================================
	# AUTO LOGIN DEBUG
	# =====================================================
	// $_SESSION['nickname'] = "abi";
	// $_SESSION['admin_level'] = 2;
	// die("Autologin is enabled<hr>You login as GM :: abi :: Iin Sholihin");

}


if(!isset($cadmin_level) || $cadmin_level<1) die("Anda tidak berhak mengakses halaman ini. <hr><a href='../'>Silahkan login dahulu!</a>");



# =====================================================
# DEBUG VARIABLES
# =====================================================
// $nama_player = "Ahmad Firdaus";


# =====================================================
# DATABASE VARIABEL
# =====================================================
include "about_var.php";
include "about_var_view_controll.php";




# =====================================================
# QWARS VARIABEL
# =====================================================
$s = "SELECT 

a.*,
(SELECT prodi FROM tb_kelas b WHERE b.kelas=a.kelas) as prodi, 
(
	SELECT c.nama_prodi FROM tb_kelas b 
	JOIN tb_prodi c ON b.prodi=c.prodi 
	WHERE b.kelas=a.kelas ) as nama_prodi  

from tb_player a 

where a.nickname = '$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error user_var Can't get data player. <hr>".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) die("Error user_var. Harus satu row. $s");


$d = mysqli_fetch_assoc($q);

$qadmin_level  = $d['admin_level'];
$qnama_player  = $d['nama_player'];
$qkelas  = $d['kelas'];
$qprodi  = $d['prodi'];
$qnama_prodi  = $d['nama_prodi'];
$qplay_count  = $d['play_count'];
$qlast_play  = $d['last_play'];
$qmy_points  = $d['global_point'];
$qstatus_aktif  = $d['status_aktif'];
$qpass_hint  = $d['pass_hint'];
$qckelas = $d['kelas'];






# =====================================================
# MANAGE URI
# =====================================================
$a = $_SERVER['REQUEST_URI'];
if (!strpos($a, "?")) $a.="?";
if (!strpos($a, "&")) $a.="&";

$b = explode("?", $a);
$c = explode("&", $b[1]);
$parameter = $c[0];
























































# ===========================================================
# HTML START
# ===========================================================
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$qnama_player ?> | About Player</title>
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<?php include 'about_player_styles.php'; ?>
	<?php if(!$dm) echo '<style>.debug_note, .debug{display: none;}</style>'; ?>

</head>
<body>
	<div class="container">
		<div class="debug"><?=$debug_note?></div>
		<div class="row">
			<div class="col-lg-3 cv_left text-center">
				<?php
				// $z = "
				// <a href='../' onclick=\"return confirm('Go to QWars Page?')\">
				// 	<img class='settings_btn' src='../assets/img/icons/back.png' width='30px' height='30px'>
				// </a>
				// ";

				$z = "<img class='settings_btn' src='../assets/img/icons/back.png' width='30px' height='30px' onclick='history.go(-1)'>";

				$x = $is_mine ? "
				<a href='about_player_edit.php'>
					<img class='settings_btn' src='../assets/img/icons/settings.png' width='30px' height='30px'>
				</a>
				" : "
				<a href='?' onclick=\"return confirm('Go to My Page?')\">
					My Page
				</a> | 
				<a href='testimonny_for.php?nickname=$cnickname' onclick=\"return confirm('Berikan Testimony untuk $qnama_player ?')\">
					Give Testimony
				</a>

				";

				echo "$z$x";

				?>
			</div>
			<div class="col-lg-9">
				<h1 id="top_header">IKMI Students Curriculum Vitae</h1>
			</div>
		</div>

		<div id="blok_header">
			<div class="row">
				<div class="col-lg-3 cv_left" style="text-align:center">
					<style type="text/css">
						.img_foto_profil{
							object-fit: cover;
							width: 160px;
							height: 160px;
							border-radius: 90px;
							border: solid 5px white;
							box-shadow: 0px 0px 5px gray;
							transition: .2s;
							margin: 20px;
							cursor: pointer;
						}

						.img_foto_profil:hover{
							transform: scale(1.2);
						}
					</style>

					<img class="img_foto_profil" src="<?=$profil_show ?>">
					<!-- <img class="img_foto_profil" src="img/profiles/001.jpg"> -->
					
				</div>
				<div class="col-lg-9">
					<div id="blok_tentang_saya">
						<div id="blok_nama_player">
							<h3 id="cap_nama"><?=$nama_player ?> :: <?=$acuan_nickname ?> </h3>
							<h5 id="cap_alamat"><?=$alamat_kec?></h5>
						</div>
						<p id="tentang_saya"><?=$tentang_saya_show ?></p>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-lg-3 cv_left cv_sidebar">


				<div id="data_pribadi" class="point_list">
					Data Pribadi
				</div>

				<div class="content_list">
					<ul>
						<li><b>Tempat Lahir:</b> <?=$tempat_lahir_show ?></li>
						<li><b>Tanggal Lahir:</b> <?=$tanggal_lahir_show ?></li>
						<li><b>Gender:</b> <?=$gender_show ?></li>
						<li><b>Agama:</b> <?=$agama_show ?></li>
						<li><b>Status:</b> <?=$status_menikah_show ?></li>
						<li><b>Kewarganegaraan:</b> <?=$warga_negara_show ?></li>
					</ul>
				</div>


				<div id="data_pribadi" class="point_list">
					Kontak
				</div>

				<div class="content_list">
					<table>
						<tr>
							<td><img src="../assets/img/icons/wa.png" width="20px"></td>
							<td><?=$no_wa_show ?></td>
						</tr>
						<tr>
							<td><img src="../assets/img/icons/mail.png" width="20px"></td>
							<td><?=$email_show ?></td>
						</tr>
						<tr>
							<td><img src="../assets/img/icons/location.png" width="20px"></td>
							<td><?=$alamat_blok_show ?></td>
						</tr>
					</table>
					<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.737728222277!2d108.37168081367385!3d-6.679379195170676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edfdabea6d54b%3A0x7b54c19c3038d706!2sKomunitas%20H3O%20BSF!5e0!3m2!1sen!2sid!4v1648806575427!5m2!1sen!2sid" width="100%" height="150px" style="border: solid 1px #ccc;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
				</div>


				<?php include 'about_player_skills.php'; ?>
				<?php include 'about_player_hobby_cita.php'; ?>

























			<!-- ====================================================== -->
			<!-- CONTENT RIGHT -->
			<!-- ====================================================== -->
			<div class="col-lg-9 cv_content_right">

				<div id="data_pribadi" class="point_list_right">
					QWars Rank [ <span style="color:red; font-weight: bold;">Prototype | Frontend Only</span> ]
				</div>

				<div class="content_list">
					<div id="blok_qwars_rank">
						<div id="qwars_rank"><span style="font-size:30px; color: blue;"><b>3</b><sup>rd</sup></span> of 372 Players</div>
						<table class="table table-hover">
							<tr>
								<td width="25%"><b>Level</b></td>
								<td>Web Developer Level 12</td>
							</tr>
							<tr>
								<td><b>Developer Type</b></td>
								<td>Frontend Developer</td>
							</tr>
							<tr>
								<td><b>Badges</b></td>
								<td>CSS-Warrior, JS-Novice, PHP-Advanced</td>
							</tr>
						</table>
					</div>
				</div>


				<?php include "about_player_riwayat.php"; ?>
				<?php include "gallery.php"; ?>
				<?php include "testimony.php"; ?>

				
			</div>
		</div>



	</div>

</body>
</html>












































<script>
	$(document).ready(function(){
		$('.not_set').click(function(){
			alert('Untuk Update Profil, silahkan klik "My Page", lalu klik tombol Gerigi.');
		})
	})
</script>