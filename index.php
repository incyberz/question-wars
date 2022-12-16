<?php
# =====================================================
# MAIN INDEX
# =====================================================
session_start();
//session_destroy();exit();
$dm = 0;
$ket_maintenance = '';
$dm_notes = '';

$proto = '<p class="prototype">Fitur masih dalam tahap pengembangan. [Frontend Only]</p><hr>';

// $pass_main = isset($_GET['pass_main']) ? $_GET['pass_main'] : '';
// if($pass_main=='') $ket_maintenance = "Maintenance fitur reject soal dan banned soal.";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";



# =====================================================
# INITIAL VARIABLES
# =====================================================
$is_login = 0;
$admin_level = 0;

$cnickname = '';
$cnama_player = "Pengunjung";
$cid_room = 0;




# =====================================================
# DATABASE CONNECTION
# =====================================================
include "config.php";
// include 'var_sesi_mk.php';



# =====================================================
# SESSION VARIABLES
# =====================================================
$password_sama = 0;
if (isset($_SESSION['nickname'])) {
    $is_login = 1;
    $cnickname = $_SESSION['nickname'];
    $cadmin_level = $_SESSION['admin_level'];

    # ========================================================================
    # WAJIB UBAH DEFAULT PASSWORD
    # ========================================================================
    include 'pages/player/ubah_password/get_current_pass.php';
    if ($cnickname == $cpassword) {
        $password_sama=1;
    }
    // echo "<h1>cnickname:$cnickname cpassword:$cpassword</h1>";
}

if (isset($_SESSION['id_room'])) {
    $cid_room = $_SESSION['id_room'];
}



# =====================================================
# MANAGE URI
# =====================================================
$a = $_SERVER['REQUEST_URI'];
if (!strpos($a, "?")) {
    $a.="?";
}
if (!strpos($a, "&")) {
    $a.="&";
}

$b = explode("?", $a);
$c = explode("&", $b[1]);
$parameter = $c[0];

if ($parameter=='uas') {
    include 'uas/uas.php';
    exit();
}

if ($parameter=='resetpass') {
    include 'pages/player/login_system/reset_password.php';
    exit();
}

if ($parameter=='unlogas') {
    include 'pages/gm/login_as/unlog_as.php';
    exit();
}



# =====================================================
# REALTIME COUNTING FOR HOME
# =====================================================
if (!$is_login) {
    include "pages/realtime_counting.php";
}


# =====================================================
# LOGOUT
# =====================================================
if ($parameter=="logout") {
    include 'pages/player/login_system/logout.php';
    exit();
}


# =====================================================
# LOGIN PROCESS
# =====================================================
if (isset($_POST['btn_submit_login'])) {
    include 'pages/player/login_system/login_process.php';
}



# =====================================================
# SUBMIT ID-ROOM
# =====================================================
if (isset($_POST['btn_change_room'])) {
    $_SESSION['id_room'] = $_POST['id_room_selected'];
    $cid_room = $_POST['id_room_selected'];
}
if (isset($_POST['btn_set_first_room'])) {
    $_SESSION['id_room'] = $_POST['id_room'];
    $cid_room = $_POST['id_room'];
}



# =====================================================
# PUBLIC THE BEST TOP 10
# =====================================================
if ($is_login==0) {
    $s = "SELECT nama_player, global_point from tb_player where status_aktif=1 and admin_level=1 order by global_point desc limit 10";
    $q = mysqli_query($cn, $s) or die("Error @index. Tidak dapat mengakses data list-player. ".mysqli_error($cn));
    $i=0;
    while ($d=mysqli_fetch_assoc($q)) {
        $i++;
        $list_player[$i] = ucwords(strtolower($d['nama_player']));
        $list_point[$i] = $d['global_point'];
    }
}



?>
<!DOCTYPE html>
<html lang="en" translate="no">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Perang Soal | STMIK IKMI Gamified Learning Apps</title>
  <meta content="Iin Sholihin" name="author">
  <meta content="Gamified Learning Question Wars | Perang Soal" name="description">
  <meta content="game,perang soal,gamified,gamifikasi,learning,belajar,kuliah,sekolah,question,soal,online,perang,duel" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="qwars.css">
  <?php include 'qwars_styles.php'; ?>
</head>

<body>

  <?php

  if ($is_login) {
      # ===========================================================
      # GET TMP_USER_VAR
      # ===========================================================

      include 'user_data.php';
      if ($cid_room>0) {
          include 'user_var.php';
          include 'room_var.php';
      }
      // include 'var_sesi_mk.php';
      include 'pages/player/update_last_activity/update_last_activity.php';
  } elseif ($parameter=='login') {
      include 'pages/visitor/login/login.php';
      exit();
  }


  include "pages/header.php";
?>

  <main id="main">


    <?php
  if ($ket_maintenance!="") {
      include "maintenance.php";
      exit();
  }
  if ($is_login) {
      # ===========================================================
      # JIKA BELUM PUNYA FOTO PROFIL
      # ===========================================================
      if (!$punya_profil or $parameter=="ubah_profil") {
          # ===========================================================
          # JIKA PROFIL BELUM ADA ATAU REQUEST UBAH PROFIL
          # ===========================================================
          include 'pages/player/update_profile/upload_profil.php';
          exit;
      }




      if ($cid_room==0) {
          # =====================================================
          # BELUM MEMILIH ROOM
          # =====================================================

          if ($parameter=="addroom") {
              include "pages/gm/room_add.php";
          } else {
              include "pages/set_room.php";
          }
      } else {
          # =====================================================
          # ID-ROOM SUDAH TERPILIH :: GO ROUTING
          # =====================================================






          # ===========================================================
          # JIKA PASSWORD MASIH DEFAULT
          # ===========================================================
          if ($password_sama) {
              include 'pages/player/ubah_password/ubah_pass.php';
          // exit();
          } else {
              # =====================================================
              # ALL USER ROUTING
              # =====================================================
              include "routing.php";
              # =====================================================
          }
      }
  } else {
      # =====================================================
      # NOT LOGIN
      include "pages/visitor/visitor.php";
  }
?>
  </main>

  <?php include "pages/footer.php"; ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<?php include 'js_help.php'; ?>