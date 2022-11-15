<section id="about" class="visitor">
  <div class="container">

    <div class="section-title">
      <h2>About Question Wars</h2>
      <p>E-learning makes you bored? Not anymore! We will gamified it for you! We gives you interactive leaderboards, repeatable-quests, and challenges. Be proud with your rank, points, and badge achievements!!</p>
    </div>

    <div class="row content">
      <div class="col-lg-3"></div>
      <div class="col-lg-6 text-center">

        <!-- <h4>The Leaderboards</h4> -->
        <table class="table table-bordered table-hover" bgcolor="white">
          <thead>
            <th colspan="3" bgcolor="#00ffff" style="padding: 15px">
              <!-- <center><h4>The Best Players today!</h4></center> -->
              <img src="assets/img/icons/the-best-player.png">
            </th>
          </thead>

          <?php 
          $img = "<img src='assets/img/icons/medal.png'>";
          $imgs = '';
          $sty = '';
          for ($i=1; $i <= 10 ; $i++) { 
            $sup = "th";
            if($i==1) $sup = "st";
            if($i==2) $sup = "nd";
            if($i==3) $sup = "rd";

            if($i==1) $imgs = "$img $img $img";
            if($i==2) $imgs = "$img $img";
            if($i==3) $imgs = "$img";
            if($i>3) $imgs = '';

            $bg = "#fdfdfd";
            if($i==1) $bg = "pink";
            if($i==2) $bg = "lightblue";
            if($i==3) $bg = "#ccffcc";

            if(isset($list_player[$i]))
              echo "
              <tr bgcolor='$bg' align='center'>
                <td $sty>$i<sup>$sup</sup></td>
                <td $sty>$imgs ".$list_player[$i]."</td>
                <td $sty>".$list_point[$i]." LP</td>
              </tr>
              "; 
                       

          }


          ?>

          <tr>
            <td class="tdlead" colspan=3>
              What!? <span style="font-weight: bold;color: red">You not on the list?</span> Or you not the first!
              <a href='#' class='btn btn-primary btn-block link_header' id="linkld__login">Let me in !!</a>
            </td>
          </tr>         
        </table>

      </div>



    </div>

  </div>
</section>