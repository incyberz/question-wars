<?php

# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php";
include "ajax_session_security_gm_only.php";

# ================================================
# GET VARIABLES
# ================================================
$nickname = isset($_GET['nickname']) ? $_GET['nickname'] : die(erjx("nickname"));
$id_chal_beatenby = isset($_GET['id_chal_beatenby']) ? $_GET['id_chal_beatenby'] : die(erjx("id_chal_beatenby"));
$new_comment = isset($_GET['new_comment']) ? $_GET['new_comment'] : die(erjx("new_comment"));

if ($id_chal_beatenby=="" or $nickname=="" or $new_comment=="") {
    die("Error AJAX-global-update. Salah satu index masih kosong.");
}

$gm_comment = $new_comment=='' ? 'NULL' : "'$new_comment'";

# ================================================
# MAIN HANDLE
# ================================================
$s = "UPDATE tb_chal_beatenby SET gm_comment = $gm_comment WHERE id_chal_beatenby = '$id_chal_beatenby' ";
$q = mysqli_query($cn, $s) or die("Error @ajax. Tidak bisa mengupdate values. ".mysqli_error($cn));
die("sukses");
