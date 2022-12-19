<header id="header" class="fixed-top ">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-xl-9 d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="index.php"><img src="assets/img/ps_logo.png" height="40px"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <?php
        include "navs.php";
        ?>

      </div>
    </div>
      <?php

        if ($status_room==-1) {
            include 'pages/gm/manage_room/info_room_ended.php';
        }
        ?>

  </div>


  <style>
    .blok_debug{ font-size: 8pt; }
    .blok_debug input{ width: 50px; margin-right: 10px; }
  </style>
  <div class="debug blok_debug">
    cnickname<input id="cnickname" value="<?=strtolower($cnickname)?>">
    id_room<input id="id_room" value="<?=$cid_room?>">
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      var unplayed_questions_show = $("#unplayed_questions_show").val();
      $("#nav_unplayed_questions").text(unplayed_questions_show);
    })
  </script>

</header>