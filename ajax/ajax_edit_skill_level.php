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
$id_skill_level = isset($_GET['id_skill_level']) ? $_GET['id_skill_level'] : die(erjx("id_skill_level"));
$isi = isset($_GET['isi']) ? $_GET['isi'] : die(erjx("isi"));

if ($field=='' or $id_skill_level=='' or $isi=='') {
    die('Error AJAX-global-update. Salah satu index masih kosong.');
}

# ================================================
# MAIN HANDLE
# ================================================
$s = "UPDATE tb_chal_skill_level SET $field = '$isi' WHERE id_skill_level = '$id_skill_level' ";
$q = mysqli_query($cn, $s) or die(''.mysqli_error($cn));
die("sukses");
