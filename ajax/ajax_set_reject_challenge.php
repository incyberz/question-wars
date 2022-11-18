<?php
# ================================================
# SESSION SECURITY
# ================================================
session_start();
function erjx($a)
{
    return "Error @ajax. Index($a) belum terdefinisi.";
}

if (!isset($_SESSION['nickname'])) {
    die(erjx(1));
}
if (!isset($_SESSION['admin_level'])) {
    die(erjx(2));
}
if (!isset($_SESSION['id_room'])) {
    die(erjx(3));
}

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];

if ($_SESSION['admin_level']<2) {
    die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");
}


# ================================================
# GET VARIABLES
# ================================================
if (!isset($_GET['id_chal_beatenby'])) {
    die(erjx(4));
} $id_chal_beatenby = $_GET['id_chal_beatenby'];
if (trim($id_chal_beatenby)=="") {
    die("Error @ajax. SQL Values Data #4 is empty.");
}
if (!isset($_GET['tipe_btn'])) {
    die(erjx(5));
} $tipe_btn = $_GET['tipe_btn'];
if (trim($tipe_btn)=="") {
    die("Error @ajax. SQL Values Data #5 is empty.");
}

if (!isset($_GET['score_for_player'])) {
    die(erjx(6));
} $score_for_player = $_GET['score_for_player'];
if (!isset($_GET['gm_comment'])) {
    die(erjx(7));
} $gm_comment = $_GET['gm_comment'];

$gm_comment = "'$gm_comment'";

if ($tipe_btn=="btn_reject" and $score_for_player>0) {
    $score_for_player=0;
}





include "../config.php";
// switch($tipe_btn){
// 	case 'btn_reject': $set = " is_banned=1 "; break;
// 	case 'btn_set': $set = " is_approved_by_gm=0 "; break;
// }

$s = " UPDATE tb_chal_beatenby set 

date_approved=CURRENT_TIMESTAMP, 
approved_by='$nickname', 
score_for_player='$score_for_player', 
gm_comment=$gm_comment 

where id_chal_beatenby='$id_chal_beatenby'";
// die($s);
if ($tipe_btn=='btn_undo') {
    $s = " UPDATE tb_chal_beatenby set 

date_approved=NULL, 
approved_by=NULL, 
score_for_player=0, 
gm_comment=NULL 

where id_chal_beatenby='$id_chal_beatenby'";
}
$q = mysqli_query($cn, $s) or die("Error @ajax. SQL: $s. ".mysqli_error($cn));

$pesan = "Reject";
if ($tipe_btn=="btn_set") {
    $pesan = "Set Reward";
}
echo "sukses__$pesan Submit Challenge dari player sukses.__$score_for_player";
?>

