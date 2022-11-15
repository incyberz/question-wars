<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
// if(!isset($_SESSION['id_room'])) die(erjx(2));
if(!isset($_SESSION['admin_level'])) die(erjx(3));
if(!isset($_GET['id'])) die(erjx(4));

$nickname = $_SESSION['nickname'];
// $admin_level = $_SESSION['admin_level'];
// $id_room = $_SESSION['id_room'];
$id = $_GET['id'];
if(trim($id)=="") die("Error @ajax. SQL Values Data is empty.");

include "../config.php";
# ================================================
# CLAIM DAILY LOGIN
# ================================================
$s = "SELECT c.global_point,c.nickname, a.login_point from tb_daily_login a 
join tb_login b on a.id_login=b.id_login 
join tb_player c on b.nickname=c.nickname 
where a.id_daily_login='$id'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses data daily login $s");
if(mysqli_num_rows($q)!=1)die("Error @ajax. Harus satu baris data daily login");
$d = mysqli_fetch_assoc($q);

$nickname = $d['nickname'];
$global_point = $d['global_point'];
$login_point = $d['login_point'];

$s = "UPDATE tb_daily_login set login_point=0 where id_daily_login='$id'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengupdate data daily login");

$new_my_points = $global_point + $login_point;
$s = "UPDATE tb_player set global_point=$new_my_points where nickname='$nickname'";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengupdate poin player");


echo "1__$new_my_points"."__Claim daily login sukses.";

?>