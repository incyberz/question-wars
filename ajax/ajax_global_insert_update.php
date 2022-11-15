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
$pair_updates = isset($_GET['pair_updates']) ? $_GET['pair_updates'] : die(erjx("pair_updates"));

if ($table=="" OR $fields=="" OR $values=="" OR $pair_updates=="") die("Error AJAX-global-insert-update. Salah satu index masih kosong.");


# ================================================
# MAIN HANDLE
# ================================================
// $rfields = explode(",", $fields);
// $rvalues = explode(",", $values);
// if(count($rfields) != count($rvalues)) die("Jumlah kolom dan jumlah isi tidak sama. rfields:$rfields | rvalues:$rvalues");

// $updates = '';
// for ($i=0; $i < count($rfields); $i++) { 
// 	$updates = '';
// }

// $updates = " id_jawab='33' ,  id_soal='4' ,  jawaban='xxx'";

$s = "INSERT INTO $table ($fields) VALUES ($values)
ON DUPLICATE KEY UPDATE $pair_updates
";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak bisa menambah data. SQL:$s. ".mysqli_error($cn));

die("sukses");
?>