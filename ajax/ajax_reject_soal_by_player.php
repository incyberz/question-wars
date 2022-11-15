<?php
# ================================================
# SESSION SECURITY
# ================================================
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['admin_level'])) die(erjx(2));
if(!isset($_SESSION['id_room'])) die(erjx(3));

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];

// if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");

# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['id_soal'])) die(erjx(4));
if(!isset($_GET['alasan_banned'])) die(erjx(5));
$id_soal = $_GET['id_soal'];
$alasan_reject = $_GET['alasan_banned'];


if($id_soal=="") die("ajax_var#1 tidak boleh kosong");
if($alasan_reject=="") die("ajax_var#3 tidak boleh kosong");

$a = explode("_", $id_soal);
$soal_creator = $a[0];
if($soal_creator=="") die("ajax_var#4 tidak boleh kosong");


include "../config.php";
# =====================================================
# CEK JIKA SUDAH TERVERIFIKASI
# =====================================================
$s = "SELECT is_approved_by_gm from tb_soal where id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data soal");
if(mysqli_num_rows($q)==1){
	$d = mysqli_fetch_assoc($q);
	$is_approved_by_gm = $d['is_approved_by_gm'];
	if($is_approved_by_gm) die("Maaf, Anda tidak bisa mereject soal yang sudah diverifikasi oleh GM or by system. \n\nScreenshoot dan kirim secara manual ke Whatsapp GM jika kamu mempunyai bukti kuat bahwa soal tersebut layak dibanned.");
}



# =====================================================
# CEK JIKA SUDAH MEREJECT
# =====================================================
$s = "SELECT 1 FROM tb_soal_rejectby where id_soal = '$id_soal' and nickname='$nickname'";
$q = mysqli_query($cn,$s) or die("Error. Query Cek Rejecter Failed.");
if(mysqli_num_rows($q)>0) die("3");


# =====================================================
# VARIABEL AWAL / KONFIGURASI
# =====================================================
$jumlah_max_reject = 5;


# =====================================================
# GET EARNED-POINT VALUE AND JUMLAH-REJECT
# =====================================================
$s = "SELECT earned_points, count_reject from tb_soal where id_soal = '$id_soal'";
$q = mysqli_query($cn,$s) or die("Error. Query#1 Failed.");
if(mysqli_num_rows($q)<=0) die("SQL Query#1 sukses tetapi tanpa rows data.");
$d = mysqli_fetch_assoc($q);
$earned_points = $d['earned_points'];
$count_reject = $d['count_reject'];



# =====================================================
# UPDATE DATA SOAL :: AFFECT TO
# =====================================================


# =====================================================
# 1. Insert Rejecter
# =====================================================
$s = "INSERT into tb_soal_rejectby (id_soal,nickname,alasan_reject) values('$id_soal','$nickname','$alasan_reject')";
$q = mysqli_query($cn,$s) or die("Error. Query#2a Failed.");

# =====================================================
# 1. Count Reject++
# =====================================================
$count_reject++;
$s = "UPDATE tb_soal SET count_reject = $count_reject where id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Error. Query#2b Failed.");


# =====================================================
# NO AUTO BANNED JIKA KURANG DARI 5 REJECTER
# =====================================================
if($count_reject<$jumlah_max_reject) die("1");



# ======================================================================
# AUTO BANNED
# ======================================================================
# 1. SET BANNED
# 2. SET EARNED POINT OF CREATOR
# =====================================================
$earned_points = $earned_points * -1.5;
$s = "UPDATE tb_soal SET is_banned = 1, earned_points='$earned_points' where id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Error SetBanned. Query Failed.");

# =====================================================
# 3. Updated My_point of Creator
# =====================================================
$s = "UPDATE tb_player SET global_point = global_point + $earned_points where nickname='$soal_creator'";
$q = mysqli_query($cn,$s) or die("Error. Query#4 Failed.");

# =====================================================
# 4. Updated Room_point of Creator
# =====================================================
$s = "UPDATE tb_room_player SET room_player_point = room_player_point - $earned_points where nickname='$soal_creator' and id_room='$id_room'";
$q = mysqli_query($cn,$s) or die("Error. Query#5 Failed.");

# =====================================================
# 5. Set to zero Earned Point
# =====================================================
// $s = "UPDATE tb_soal SET earned_points = 0 where id_soal='$id_soal'";
// $q = mysqli_query($cn,$s) or die("Error. Query#6 Failed.");

# =====================================================
# 6. Rollback Point to Rejecter
# =====================================================
$rejecter_point = 20 - 0.1* $earned_points;
$s = "SELECT * from tb_soal_rejectby where id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Error. Query#7 Failed.");
while ($d=mysqli_fetch_assoc($q)) {
	$nickname_rejecter = $d['nickname'];
	$ss = "UPDATE tb_player set global_point=global_point + $rejecter_point where nickname='$nickname_rejecter'";
	$qq = mysqli_query($cn,$ss) or die("Error. Query#8 Failed.");

	$ss = "UPDATE tb_room_player set room_player_point = room_player_point + $rejecter_point where nickname='$nickname_rejecter' and id_room='$id_room'";
	$qq = mysqli_query($cn,$ss) or die("Error. Query#9 Failed.");

}


echo "2";

?>