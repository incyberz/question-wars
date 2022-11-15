<?php 
session_start();
# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php";

# ================================================
# GET VARIABLES
# ================================================
$table = isset($_GET['table']) ? $_GET['table'] : die(erjx("table"));
$field = isset($_GET['field']) ? $_GET['field'] : die(erjx("field"));
$acuan = isset($_GET['acuan']) ? $_GET['acuan'] : die(erjx("acuan"));
$acuan_val = isset($_GET['acuan_val']) ? $_GET['acuan_val'] : die(erjx("acuan_val"));
$field_val = isset($_GET['field_val']) ? $_GET['field_val'] : die(erjx("field_val"));

if ($table=="" OR $field=="" OR $acuan=="" OR $acuan_val=="" OR $field_val=="") die("Error AJAX-global-update. Salah satu index masih kosong.");

# ================================================
# MAIN HANDLE
# ================================================
$s = "UPDATE $table SET $field = '$field_val' WHERE $acuan = '$acuan_val' ";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak bisa mengupdate values. SQL:$s. ".mysqli_error($cn));
die("sukses");
?>