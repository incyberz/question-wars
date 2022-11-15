<?php 
# ================================================
# SESSION SECURITY
# ================================================
include 'ajax_session_security.php';
if($cadmin_level<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");


# ================================================
# GET VARIABLES
# ================================================
$nim = isset($_GET['nim']) ? $_GET['nim'] : die(erjx('nim'));
if(trim($nim)=="") die("Error @ajax. nim is empty.");

$nama_player = isset($_GET['nama_player']) ? $_GET['nama_player'] : die(erjx('nama_player'));
if(trim($nama_player)=="") die("Error @ajax. nama_player is empty.");


include "../config.php";

# ================================================
# ADD PLAYER
# ================================================
$s = "INSERT into tb_player 
(nickname,password,nama_player) values 
('$nim','$nim','$nama_player')
";
$q = mysqli_query($cn,$s) or die("Error @ajax add player. ".mysqli_error($cn));

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
$q = mysqli_query($cn,$s) or die("Error @ajax assign player. ".mysqli_error($cn));




echo "sukses";

?>