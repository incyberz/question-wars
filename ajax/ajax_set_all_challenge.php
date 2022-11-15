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

if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");


# ================================================
# GET VARIABLES
# ================================================
$score_for_player = isset($_GET['score_for_player']) ? $_GET['score_for_player'] : die(erjx('score_for_player'));
$gm_comment = isset($_GET['gm_comment']) ? "'$_GET[gm_comment]'" : die(erjx('gm_comment'));
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die(erjx('id_chal'));



include "../config.php";

$s = " UPDATE tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 

set 

a.date_approved=CURRENT_TIMESTAMP, 
a.approved_by='$nickname', 
a.score_for_player='$score_for_player', 
a.gm_comment=$gm_comment 

where a.is_claimed=0 
and a.approved_by is null 
and a.date_approved is null 
and a.score_for_player=0 
and a.gm_comment is null 
and b.id_room='$id_room' 
and b.id_chal='$id_chal' 

"; 
// die($s);
$q = mysqli_query($cn,$s) or die("Error @ajax. SQL: $s. ".mysqli_error($cn));

echo "sukses";
?>

