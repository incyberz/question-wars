<?php

# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php";
include "ajax_session_security_gm_only.php";

# ================================================
# GET VARIABLES
# ================================================
$field = isset($_GET['field']) ? $_GET['field'] : die(erjx("field"));
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die(erjx("id_chal"));
$isi = isset($_GET['isi']) ? $_GET['isi'] : die(erjx("isi"));

if ($field=='' or $id_chal=='' or $isi=='') {
    die('Error AJAX-global-update. Salah satu index masih kosong.');
}

# ================================================
# MAIN HANDLE
# ================================================
$s = "UPDATE tb_chal SET $field = '$isi' WHERE id_chal = '$id_chal' ";
$q = mysqli_query($cn, $s) or die(''.mysqli_errno($cn));
die("sukses");
