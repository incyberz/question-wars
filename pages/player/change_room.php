<?php
$change_to_id_room = '';
if (isset($_GET['id_room'])) {
    $change_to_id_room = $_GET['id_room'];
}
?>
<input type="hidden" id="change_to_id_room" value="<?=$change_to_id_room?>">
<section id="change_room" class="player">
  <div class="container">

    <div class="row">
      <div class="col-lg-4">
        &nbsp;
      </div>
      <div class="col-lg-4">
        <h4>Hello <?=$cnama_player?>, wanna to another room?</h4>
        <p>Choose it!</p>
        <hr>
        <form method="post" action="?">
          <div class="form-group">
            <select name="id_room_selected" id="id_room_selected" class="form-control">
              <?=$room_options_for_change_room?>
            </select>
          </div>
          <button type="submit" name="btn_change_room" class="btn-primary btn-block btn-lg" style="border-radius: 9px;text-align: center">Change Room</a>
        </form>

      </div>
      <div class="col-lg-4">
        &nbsp;
      </div>

    </div>

  </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    $("#id_room_selected").val($("#change_to_id_room").val()).change();

  })
</script>