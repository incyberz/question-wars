<script type="text/javascript">
  $(document).ready(function(){
    const timer_update_last_activity = setInterval(function(){

      if(document.hidden) return;

      let cnickname = $('#cnickname').val();
      let link_ajax = `jx/jx_update_last_activity.php?nickname=${cnickname}`;

      $.ajax({
        url:link_ajax,
        success:function(a){
          $('.blok_warriors').html(a);
          console.log(`timer_update_last_activity reply: ${a}`)
        }
      })

    },30000);
  })
</script>