<?php 
$nickname = isset($_GET['nickname'])?$_GET['nickname']: die('Tidak dapat diakses secara langsung.');
if($cadmin_level<2) die('Maaf, hanya GM yang berhak mengakses halaman ini.');

$_SESSION['logas_nickname'] = $cnickname;
$_SESSION['nickname'] = $nickname;
$_SESSION['admin_level'] = 1;

?>
<script>location.replace('index.php')</script>