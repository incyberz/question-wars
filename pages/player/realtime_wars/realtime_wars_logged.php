<style type="text/css">
  .blok_warriors{
    padding: 10px;
    border: solid 1px #ccc;
    background: linear-gradient(#ccf,#cfc);
    color: darkblue;
    font-family: consolas;
    font-size: small;
    transition: .2s;
  }

  .img_weapon{
    height: 18px;
    width: auto;
    transition: .2s;
    cursor: pointer;
  }
  .img_weapon:hover{
    transform: scale(1.2);
  }

  .row_war{
    border-top: solid 1px #ccc;
    padding: 5px;
  }

  .row_war_ganjil{
    background: #ffff0011;
  }

</style>
<div class="col-lg-6">
  <h4>Realtime Warriors Today</h4>
  <div class="blok_warriors">The warriors today will be shown here...</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    const timer_war = setInterval(function(){

      if(document.hidden) return;

      let cnickname = $('#cnickname').val();
      let link_ajax = `jx/jx_get_realtime_wars.php?nickname=${cnickname}`;

      $.ajax({
        url:link_ajax,
        success:function(a){
          $('.blok_warriors').html(a);
        }
      })

    },5000);
  })
</script>