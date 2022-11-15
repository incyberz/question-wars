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

# ================================================
# GET VARIABLES
# ================================================
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : die(erjx('kelas'));
$nim = isset($_GET['nim']) ? $_GET['nim'] : die(erjx('nim'));

if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");





include "../config.php";
# ================================================
# DO ASSIGN PLAYERS TO kelas
# ================================================
$kelas_players = $kelas."_$nim";
$s = "INSERT into tb_kelas_det (
id_kelas_det,
kelas,
nickname
) values (
'$kelas_players',
'$kelas',
'$nim'
)";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat assign player to kelas. Nickname: $nim; kelas:$kelas.\n\n$s\n\n".mysqli_error($cn));

echo "sukses";

?>