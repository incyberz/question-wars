<?php 
include 'jx_session_security.php';

// $nickname = isset($_GET['nickname']) ? $_GET['nickname'] : '' ;
if($cnickname!=''){
  $s = "UPDATE tb_player set last_activity=current_timestamp where nickname='$cnickname'";
  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
  echo "sukses";

}else{
  echo "cnickname: $cnickname undefined.";
}

?>