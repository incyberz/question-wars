<section id="counts" class="visitor counts">
  <div class="container">

    <div class="text-center title">
      <h3>Our achieved so far</h3>
      <p>We are growing with your enthusiasm. More You play more better system !</p>
    </div>

    <div class="row counters">

      <div class="col-lg-3 col-6 text-center">
        <span data-toggle="counter-up" id="jumlah_played_questions"><?=$jumlah_played_questions?></span>
        <p>Played Questions</p>
      </div>

      <div class="col-lg-3 col-6 text-center">
        <span data-toggle="counter-up" id="jumlah_rejecter"><?=$jumlah_rejecter?></span>
        <p>Qoestion Rejecters</p>
      </div>

      <div class="col-lg-3 col-6 text-center">
        <span data-toggle="counter-up" id="jumlah_created_questions"><?=$jumlah_created_questions?></span>
        <p>Created Questions</p>
      </div>

      <div class="col-lg-3 col-6 text-center">
        <span data-toggle="counter-up" id="jumlah_active_players"><?=$jumlah_active_players?></span>
        <p>Active Players</p>
      </div>

    </div>

  </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    var x = setInterval(function(){

      var link_ajax = "ajax/ajax_get_realtime_count.php";

      $.ajax({
        url:link_ajax,
        success:function(a){
          var ra = a.split(",")
          var jumlah_played_questions = parseInt($("#jumlah_played_questions").text());
          var jumlah_rejecter = parseInt($("#jumlah_rejecter").text());
          var jumlah_created_questions = parseInt($("#jumlah_created_questions").text());
          var jumlah_wars_activity = parseInt($("#jumlah_wars_activity").text());

          var jumlah_played_questions_new = parseInt(ra[0]);
          var jumlah_rejecter_new = parseInt(ra[1]);
          var jumlah_created_questions_new = parseInt(ra[2]);
          var jumlah_wars_activity_new = jumlah_played_questions_new+jumlah_rejecter_new+jumlah_created_questions_new;

          if(jumlah_wars_activity==jumlah_wars_activity_new) {
            return;
          }

          // ===========================================
          // ANIMATED CHANGES FOR ALL ACTIVITY
          // ===========================================
          if(jumlah_wars_activity!=jumlah_wars_activity_new){
            var y = setInterval(function(){

              var jumlah_wars_activity = parseInt($("#jumlah_wars_activity").text());
              if(jumlah_wars_activity>=jumlah_wars_activity_new){
                $("#blok_wars_activity").prop("style","");
                clearInterval(y);
              }else{
                jumlah_wars_activity++;
                $("#jumlah_wars_activity").text(jumlah_wars_activity);

                if(jumlah_wars_activity % 2 == 0){
                  $("#blok_wars_activity").prop("style","color: yellow");
                }else{
                  $("#blok_wars_activity").prop("style","color: #0ff");
                }

              }
            },1000);
          }



          // ===========================================
          // ANIMATED CHANGES FOR PLAYED QUESTIONS
          // ===========================================
          if(jumlah_played_questions!=jumlah_played_questions_new){
            var y2 = setInterval(function(){

              var jumlah_played_questions = parseInt($("#jumlah_played_questions").text());
              if(jumlah_played_questions==jumlah_played_questions_new){
                $("#jumlah_played_questions").prop("style","");
                clearInterval(y2);
              }else{
                jumlah_played_questions++;
                $("#jumlah_played_questions").text(jumlah_played_questions);

                if(jumlah_played_questions % 2 == 0){
                  $("#jumlah_played_questions").prop("style","color: yellow");
                }else{
                  $("#jumlah_played_questions").prop("style","color: #0ff");
                }

              }
            },1000);
          }


          // ===========================================
          // ANIMATED CHANGES FOR REJECTERS
          // ===========================================
          if(jumlah_rejecter!=jumlah_rejecter_new){
            var z = setInterval(function(){

              var jumlah_rejecter = parseInt($("#jumlah_rejecter").text());
              if(jumlah_rejecter==jumlah_rejecter_new){
                $("#jumlah_rejecter").prop("style","");
                clearInterval(z);
              }else{
                jumlah_rejecter++;
                $("#jumlah_rejecter").text(jumlah_rejecter);

                if(jumlah_rejecter % 2 == 0){
                  $("#jumlah_rejecter").prop("style","color: yellow");
                }else{
                  $("#jumlah_rejecter").prop("style","color: #0ff");
                }

              }
            },1000);
          }



          // ===========================================
          // ANIMATED CHANGES FOR REJECTERS
          // ===========================================
          if(jumlah_created_questions!=jumlah_created_questions_new){
            var z2 = setInterval(function(){

              var jumlah_created_questions = parseInt($("#jumlah_created_questions").text());
              if(jumlah_created_questions==jumlah_created_questions_new){
                $("#jumlah_created_questions").prop("style","");
                clearInterval(z2);
              }else{
                jumlah_created_questions++;
                $("#jumlah_created_questions").text(jumlah_created_questions);

                if(jumlah_created_questions % 2 == 0){
                  $("#jumlah_created_questions").prop("style","color: yellow");
                }else{
                  $("#jumlah_created_questions").prop("style","color: #0ff");
                }

              }
            },1000);
          }


        }
      })


    },10000)
  })

</script>