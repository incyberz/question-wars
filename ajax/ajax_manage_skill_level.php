<?php

# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php";
include "ajax_session_security_gm_only.php";

# ================================================
# GET VARIABLES
# ================================================
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die(erjx("id_chal"));
$id_skill_level = isset($_GET['id_skill_level']) ? $_GET['id_skill_level'] : die(erjx("id_skill_level"));
$tipe_btn = isset($_GET['tipe_btn']) ? $_GET['tipe_btn'] : die(erjx("tipe_btn"));

if ($id_chal=='' or $id_skill_level=='' or $tipe_btn=='') {
    die('Error AJAX-global-update. Salah satu index masih kosong.');
}

# ================================================
# MAIN HANDLE
# ================================================
if ($tipe_btn=='btn_delete') {
    $s = "DELETE FROM tb_chal_skill_level WHERE id_skill_level = '$id_skill_level' ";
} elseif ($tipe_btn=='btn_tambah') {
    $s = "INSERT INTO tb_chal_skill_level (id_chal,nama_skill_level,poin_skill_level,syarat_skill_level) VALUES ('$id_chal','(klik untuk ubah!)',0,'(syarat_skill_level, silahkan ubah)')";
} else {
    die("tipe_btn: $tipe_btn belum mempunyai AJAX handler");
}
$q = mysqli_query($cn, $s) or die(''.mysqli_error($cn));
die("sukses");
