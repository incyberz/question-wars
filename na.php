<section id="set_room" class="visitor">
  <div class="container text-center">


<?php 
$a = $_SERVER['REQUEST_URI'];
?>
<img src="assets/img/error404.png" style="max-width: 200px;">
<hr>
<small>Sepertinya Anda nyasar!!? Atau mungkin fiturnya belum ada. Jangan khawatir, sistem telah mencatatnya... :)</small>
<hr>

<small style="font-family: consolas; color:lightgreen;">
	Broken-Link: <i><?=$a?></i> has been saved at <?=date("Y-m-d H:i:s")?>. <br>Programmer will be soon fixed it!
	<br><?=$btn_back?> 
</small>

</div>
</section>