<?php 
session_unset();

echo "
<div style='border: solid 1px #aaa; margin: 15px; padding: 15px; background-color: #dfd; border-radius: 15px; text-align: center; height:90%'>
  <h2>Goodbye $cnama_player!</h2>
  Semoga hari Anda bermanfaat.
  <hr>
  <a href='?' class='btn btn-success'>Relogin</a>
</div>";
?>
<script>
	location.replace('index.php');
</script>