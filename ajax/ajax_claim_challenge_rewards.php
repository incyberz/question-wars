<?php 
$jumlah_soal_minimal = 3;
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

if($_SESSION['admin_level']!=1) die("Error @ajax. Maaf, hanya Player yang dapat mengclaim Challenge Rewards.");


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['id_chal_beatenby'])) die(erjx(4)); $id_chal_beatenby = $_GET['id_chal_beatenby'];
if(trim($id_chal_beatenby)=="") die("Error @ajax. SQL Values Data #4 is empty.");


include "../config.php";
# ================================================
# SECURITY CLAIM
# ================================================
$s = "SELECT a.*,b.admin_level as admin_level_approver from tb_chal_beatenby a 
join tb_player b on a.approved_by=b.nickname 
where a.id_chal_beatenby = '$id_chal_beatenby'";
$q = mysqli_query($cn,$s) or die("Error AJAX. Get beaten_by data. ".mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("Id invalid. Harus satu baris data");

$d=mysqli_fetch_assoc($q);

$date_approved = $d['date_approved'];
$approved_by = $d['approved_by'];
$score_for_player = $d['score_for_player'];
$is_claimed = $d['is_claimed'];
$admin_level_approver = $d['admin_level_approver'];
$beaten_by = $d['beaten_by'];

# =======================================================
# VAR PROCESSING :: SECURITY CLAIM
# =======================================================
if($date_approved=="") die("Tanggal approved_by masih kosong");
if($approved_by=="") die("Belum ada yang memverifikasi submit challenge ini");
if($score_for_player=="" or $score_for_player==0) die("Score challenge kosong, silahkan re-upload bukti link sesuai petunjuk Challenge");
if($is_claimed!=0) die("Maaf, Status Reward ini sudah terambil (claimed)");
if(!($admin_level_approver==2 or $admin_level_approver==9)) die("admin_level_approver harus GM atau Super GM");


# =======================================================
# DO GIVE REWARDS
# =======================================================
// $score_for_player=0;
$s = "UPDATE tb_chal_beatenby SET is_claimed=1, date_claimed=CURRENT_TIMESTAMP where id_chal_beatenby='$id_chal_beatenby'";
$q = mysqli_query($cn,$s) or die("Error AJAX. Update claimed. ".mysqli_error($cn));

$s = "UPDATE tb_room_player SET room_player_point = room_player_point + $score_for_player where id_room='$id_room' and nickname='$beaten_by'";
$q = mysqli_query($cn,$s) or die("Error AJAX. Update room players. ".mysqli_error($cn));

$s = "UPDATE tb_player SET global_point = global_point + $score_for_player where nickname='$beaten_by'";
$q = mysqli_query($cn,$s) or die("Error AJAX. Update global_point players. ".mysqli_error($cn));

echo "1__$score_for_player";
?>