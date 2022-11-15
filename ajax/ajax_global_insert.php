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
$fields = isset($_GET['fields']) ? $_GET['fields'] : die(erjx("fields"));
$values = isset($_GET['values']) ? $_GET['values'] : die(erjx("values"));

# ?table=table&fields=fields&values=values
// var_dump($_GET);

if ($table=="" OR $fields=="" OR $values=="") die("Error AJAX-global-insert. Salah satu index masih kosong.");

# ================================================
# MAIN HANDLE
# ================================================
$s = "INSERT INTO $table ($fields) VALUES ($values)";
$q = mysqli_query($cn,$s) or die("Error @ajax. ".mysqli_error($cn));

die("sukses");
?>