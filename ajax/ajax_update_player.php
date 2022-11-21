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
$nickname = isset($_GET['nickname']) ? $_GET['nickname'] : die(erjx("nickname"));
$isi = isset($_GET['isi']) ? $_GET['isi'] : die(erjx("isi"));

if ($field=="" or $nickname=="" or $isi=="") {
    die("Error AJAX-global-update. Salah satu index masih kosong.");
}

# ================================================
# MAIN HANDLE
# ================================================
$s = "UPDATE tb_player SET $field = '$isi' WHERE nickname = '$nickname' ";
$q = mysqli_query($cn, $s) or die("Error @ajax. Tidak bisa mengupdate values. SQL:$s. ".mysqli_error($cn));
die("sukses");
