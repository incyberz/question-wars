<?php
// die("1");  
$dm = 0;
$s_tmp = '';

// if(!isset($_GET['soal_creator'])) die("ajax_var#1 belum terdefinisi");
if(!isset($_GET['id_soal'])) die("ajax_var#2 belum terdefinisi");
if(!isset($_GET['id_room'])) die("ajax_var#3 belum terdefinisi");
if(!isset($_GET['is_verif'])) die("ajax_var#4 belum terdefinisi");
if(!isset($_GET['alasan_banned'])) die("ajax_var#5 belum terdefinisi");


// $soal_creator = $_GET['soal_creator'];
$id_soal = $_GET['id_soal'];
$id_room = $_GET['id_room'];
$is_verif = $_GET['is_verif'];
$alasan_reject = $_GET['alasan_banned'];

// if($soal_creator=="") die("ajax_var#1 tidak boleh kosong");
if($id_soal=="") die("ajax_var#2 tidak boleh kosong");
if($id_room=="") die("ajax_var#3 tidak boleh kosong");
if($is_verif=="") die("ajax_var#4 tidak boleh kosong");

$a = explode("_", $id_soal);
$soal_creator = $a[0];
if($soal_creator=="") die("ajax_var#5 tidak boleh kosong");


# =====================================================
# VARIABEL AWAL / KONFIGURASI
# =====================================================






include "../config.php";
# =====================================================
# GET EARNED-POINT VALUE
# =====================================================
$s = "SELECT earned_points from tb_soal where id_soal = '$id_soal'";
if($dm) $s_tmp = $s;
$q = mysqli_query($cn,$s) or die("Error. Query#1 Failed. $s_tmp");
if(mysqli_num_rows($q)<=0) die("SQL Query#1 sukses tetapi tanpa rows data.");
$d = mysqli_fetch_assoc($q);
$earned_points = $d['earned_points'];

# =====================================================
# UPDATE DATA SOAL :: AFFECT TO
# 1. Verified Value of Soal
# 2. My_point of creator
# 3. Room_point_player of creator
# 4. Set Earned_point to zero if reject
# =====================================================


# =====================================================
# 1. BANNED SOAL + ALASAN
# =====================================================
$s = "UPDATE tb_soal SET is_approved_by_gm = 1 where id_soal='$id_soal'";
if($is_verif!=1) $s = "UPDATE tb_soal SET is_banned = 1, alasan_reject='$alasan_reject' where id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Error. Query#2 Failed. ".mysqli_error($cn));

# =====================================================
# 2. Updated My_point of Creator
# =====================================================
if($is_verif!=1){
	$s = "UPDATE tb_player SET global_point = global_point - ($earned_points * 1.5) where nickname='$soal_creator'";
	$q = mysqli_query($cn,$s) or die("Error. Query#3 Failed.");
}

# =====================================================
# 3. Updated Room_point of Creator
# =====================================================
if($is_verif!=1){
	$s = "UPDATE tb_room_player SET room_player_point = room_player_point - ($earned_points * 1.5) where nickname='$soal_creator' and id_room='$id_room'";
	$q = mysqli_query($cn,$s) or die("Error. Query#4 Failed.");
}

# =====================================================
# 4. Set to Minus Earned Point
# =====================================================
if($is_verif!=1){
	$s = "UPDATE tb_soal SET earned_points = -$earned_points where id_soal='$id_soal'";
	$q = mysqli_query($cn,$s) or die("Error. Query#5 Failed.");
}

echo "1";

?>