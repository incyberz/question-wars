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

# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['id_chal_beatenby'])) die(erjx(4)); $id_chal_beatenby = $_GET['id_chal_beatenby'];
if(trim($id_chal_beatenby)=="") die("Error @ajax. SQL Values Data #4 is empty.");


include "../config.php";
# ================================================
# DO DELETE
# ================================================
$s = "DELETE FROM tb_chal_beatenby where id_chal_beatenby='$id_chal_beatenby'";
$q = mysqli_query($cn,$s) or die("Error AJAX. Hapus id_chal_beatenby:$id_chal_beatenby. ".mysqli_error($cn));

echo "1__";
?>