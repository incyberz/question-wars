<?php 
# ================================================
# SESSION SECURITY
# ================================================
include 'ajax_session_security.php';
if($cadmin_level<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['nama_subject'])) die(erjx('nama_subject')); $nama_subject = $_GET['nama_subject'];
if(trim($nama_subject)=="") die("Error @ajax. SQL Values Data #5 is empty.");



include "../config.php";
# ================================================
# GET MAX PRIORITY
# ================================================
$s = "SELECT max(no_subject) as priority FROM tb_room_subject where id_room=$cid_room ";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat mengakses room-subjects-priority");
$d = mysqli_fetch_assoc($q);
$priority = $d['priority'];
if($priority=="") $priority=0;
$priority++;

# ================================================
# DO ADD ROOM SUBJECTS
# ================================================
$s = "INSERT into tb_room_subject (id_room,no_subject,nama_subject) values ($cid_room,$priority,'$nama_subject')";
$q = mysqli_query($cn,$s) or die("Error @ajax. Tidak dapat menambah room-subjects");




echo "1__";

?>