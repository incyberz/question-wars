<?php 
# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php";

# ================================================
# GET VARIABLES
# ================================================
$id_soal = isset($_GET['id_soal']) ? $_GET['id_soal'] : die(erjx("id_soal"));

if ($id_soal=="") die("Error jx_auto_verified_soal. Salah satu index masih kosong.");

# ================================================
# PRE HANDLE
# ================================================
$status_soal = ($cadmin_level==2 or $cadmin_level==9) ? 2 : 1; // DECIDED || VERIFIED

# ================================================
# MAIN HANDLE
# ================================================
$s = "UPDATE tb_soal SET status_soal = '$status_soal' WHERE id_soal = '$id_soal' ";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak bisa jx_auto_verified_soal. SQL:$s. ".mysqli_error($cn));
// die("sukses :: DEBUG jx_auto_verified_soal status_soal:$status_soal cadmin_level:$cadmin_level ");
die("sukses");
?>