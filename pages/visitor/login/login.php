<?php include 'login_process.php'; ?>

<section id="login" class="visitor">
  <div class="container">


    <div class="blok_login">


      <div id="blok_login" style="max-width:400px; margin:auto;">

        <div class="text-centers" style="margin:20px 0">
          <img src="assets/img/ps_logo_full.png" width="200px">
        </div>
        <p id="pesan_login"><?=$pesan_login?></p>

        <form method="post" action="?login">
          <div class="form-group">
            <label for="nickname">NIM</label>
            <input type="text" id="nickname" name="nickname" class="form-control input_login" minlength="3" maxlength="20" required="" placeholder="NIM Anda" value="<?=$nickname?>">
            <small id="nickname_ket"></small>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control input_login" minlength="6" maxlength="20" required="" placeholder="password" value="<?=$password?>">
            <small id="password_ket"></small>
          </div>

          <button id="btn_login" class="btn btn-primary btn-block" name="btn_login" type="submit">Join War</button>
          <p style="text-align:center" id="help_login"><small>
            <a href="#help_login" id="link_howto__get_nickname" class="link_howto scrollto">Register Nickname</a> | 
            <a href="#help_login" id="link_howto__forgot_pass" class="link_howto scrollto">Lupa Password</a>
          </small></p>
        </form>


        <!-- ============================================= -->
        <!-- HOW TO GUIDE -->
        <!-- ============================================= -->
        <style type="text/css">
        .howto{border: solid 1px #ccc; margin: 10px 0; padding: 10px; border-radius: 10px;}
        .howto .subhow{font-size: 10pt;}
        </style>
        <div id="howto_get_nickname" class="howto hideit">
          <p>Cara mendapatkan nickname:</p>
          <div class="subhow">
            <p>Nickname adalah username unik untuk player dan GM (Game Master). Nickname dapat berupa NIS, NIM, NIDN, atau custom nickname. Setelah ada catatan login atau sudah pernah membuat/menjawab soal maka nickname tidak bisa diubah.</p>
            <p>Cara mendapatkan nickname bagi player yaitu dengan cara meminta GM untuk memasukan kamu kedalam Room GM. Yang bertindak sebagai GM kamu adalah gurumu atau dosenmu, hubungi saja beliau via WhatsApp. </p>
            <p>Untuk mendapatkan Nickname GM yaitu dengan cara meminta Super GM untuk membuatkannya. Super GM adalah kaprodi atau GM yang dipromosikan oleh Super User (Developer).</p>
            <div>
              <a href="#login" class="btn btn-primary btn-sm scrollto btn_faham">OK, saya faham</a>
            </div>
          </div>
        </div>
        <div id="howto_forgot_pass" class="howto hideit">
          <p>Cara reset Password:</p>
          <div class="subhow">
            <ul>
              <li>Ketik NIM kamu dahulu (harus 8 digit)</li>
              <li>klik Reset Password [NIM]</li>
              <li>Isi pernyataan bahwa kamu memang lupa password dengan mencantumkan identitas</li>
              <li>Sistem akan meneruskan request ke WhatsApp Dosen</li>
              <li>Tunggu hingga dosen memverifikasinya (fast-reply pada jam kerja)</li>
            </ul>
            <div>
              <div class="form-group">
                <input type="text" id="nickname2" placeholder="NIM Anda" class="form-control text-center" minlength="8" maxlength="8">
              </div>
              <div class="form-group text-center">
                <a id="link_resetpass" href="?" class="btn btn-primary hideit btn-block" style="width:100%">Reset Password [<span id="typed_nim"></span>]</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</section>


<script type="text/javascript">
  $(document).ready(function(){
    // $(".input_login").change(function(){
      // $("#nickname2").val($("#nickname").val());
      // $("#password2").val($("#password").val());

      // var nickname = $("#nickname").val();
      // $('#link_resetpass').prop('href','?resetpass&nickname='+nickname);
      // $('#typed_nim').text(nickname);

    // })

    $("#nickname2").keyup(function(){
      let nickname2 = $(this).val();
      $('#link_resetpass').prop('href','?resetpass&nickname='+nickname2);
      $('#typed_nim').text(nickname2);
      if(nickname2.length==8){
        $('#link_resetpass').slideDown();
      }else{
        $('#link_resetpass').slideUp();
      }
    })




    $(".link_howto").click(function(){
      $(".howto").hide();
      var id = $(this).prop("id");
      var rid = id.split("__");
      var id = rid[1];

      $("#howto_"+id).fadeIn();
      if(id=='forgot_pass') $('#nickname').val('');
    })

    $(".btn_faham").click(function(){
      $(".howto").fadeOut();
    })
  })
</script>