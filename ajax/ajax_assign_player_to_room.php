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
if(!isset($_GET['nim'])) die(erjx(4));
$nim = $_GET['nim'];
if(trim($nim)=="") die("Error @ajax. SQL Values Data is empty.");



include "../config.php";
# ================================================
# DO ASSIGN PLAYERS TO ROOM
# ================================================
$id_room_players = $id_room."_$nim";
$s = "INSERT into tb_room_player (
id_room_players,
nickname,
id_room,
inserted_by
) values (
'$id_room_players',
'$nim',
'$id_room',
'$nickname'
)";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat assign player to room. Nickname: $nim; id_room:$id_room");




echo "1__Sukses assign player: '$nim' to room-id: $id_room. \n\nTekan refresh (F5) untuk melihat perubahan pada Daftar Peserta Room";

?>