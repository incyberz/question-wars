<?php 
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

// if(!isset($_SESSION['nickname'])) die(erjx(1));
// if(!isset($_SESSION['id_room'])) die(erjx(2));
// if(!isset($_SESSION['admin_level'])) die(erjx(3));

include "../config.php"; 
include "../pages/realtime_counting.php"; 

echo "$jumlah_played_questions,$jumlah_rejecter,$jumlah_created_questions";
?>