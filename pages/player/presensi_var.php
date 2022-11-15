<?php 
# =====================================================
# TOTAL PERTEMUAN HINGGA HARI INI
# =====================================================
$s = "SELECT 1 from tb_room_subject where id_room='$cid_room' and date_open<='".date("Y-m-d")."'";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung total_pertemuan");
$total_pertemuan = mysqli_num_rows($q); 
// $id_room_subject = 24;

?>