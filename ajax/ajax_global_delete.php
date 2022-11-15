<?php 
session_start();
# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php"; 

# ================================================
# GET VARIABLES
# ================================================
# ?table=table&acuan=acuan&acuan_val-acuan_val
$table = isset($_GET['table']) ? $_GET['table'] : die(erjx("table"));
$acuan = isset($_GET['acuan']) ? $_GET['acuan'] : die(erjx("acuan"));
$acuan_val = isset($_GET['acuan_val']) ? $_GET['acuan_val'] : die(erjx("acuan_val"));

if ($table=="" OR $acuan=="" OR $acuan_val=="") die("Error AJAX-global-delete. Salah satu index masih kosong.");

# ================================================
# MAIN HANDLE
# ================================================
$s = "DELETE FROM $table WHERE $acuan = '$acuan_val' ";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak bisa menghapus data. \n\nSQL: $s\n\n".mysqli_error($cn));
die("sukses");
?>