<?php 
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
$poin_akurasi = isset($_GET['poin_akurasi']) ? $_GET['poin_akurasi'] : die(erjx("poin_akurasi"));


if ($poin_akurasi=='' OR $table=="" OR $fields=="" OR $values=="" OR $pair_updates=="") die("Error AJAX-global-insert-update. Salah satu index masih kosong.");


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
// die($s);
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak bisa menambah data. SQL:$s. ".mysqli_error($cn));


# ======================================
# UPDATE GLOBAL POINT OF THIS PLAYER
# ======================================
$s2 = "UPDATE tb_player set global_point = global_point - $poin_akurasi where nickname='$cnickname'";
// die($s2);
$q2 = mysqli_query($cn, $s2) or die('error update global_point. '.mysqli_error($cn));



# ======================================
# UPDATE ROOM POINT OF THIS PLAYER
# ======================================
$s = "UPDATE tb_room_player SET room_player_point= room_player_point + $poin_akurasi WHERE nickname='$cnickname' AND id_room='$cid_room'";
$q = mysqli_query($cn,$s) or die('error update room_point_player. '.mysqli_error($cn));



die("sukses");
?>