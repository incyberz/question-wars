<?php 
$pesan_request='';

if(isset($_POST['btn_submit_request'])){
  $req_id_room = $_POST['req_id_room'];
  $id_request_player = $nickname."_$req_id_room";
  $link_go = "<hr><a href='?' class='btn btn-primary btn-sm'>Back to Set Room</a>";


  if($req_id_room=="0"){
    $pesan_request = "<div class='alert alert-danger'>Sepertinya kamu belum memilih Room nya!$link_go</div>";
  }else{
    $s = "INSERT INTO tb_request_player (id_request_player,nickname,id_room) 
    values ('$id_request_player','$nickname','$req_id_room')";
    $q = mysqli_query($cn,$s);


    if($q){
      $pesan_request = "<div class='alert alert-success'>Sukses mengirimkan request<hr>
      <small><i>Please wait for GM to approve your requests!</i></small>$link_go</div>";
    }else{
      $pesan_request = "<div class='alert alert-danger'>Gagal mengirimkan request. ".mysqli_error($cn)."$link_go</div>";
    }
  }
}


$btn_create_room = "<a href='?logout' name='btn_logout_no_room' class='btn btn-primary btn-block'>Logout</a>";
$welcome_player = "Wahhh... sepertinya Anda belum dimasukan ke room oleh GM. Silahkan Anda whatsapp GM!";
if($admin_level==2 or $admin_level==9) {
  $welcome_player = "Wahhh... sepertinya Anda belum punya Room. Silahkan Anda buat dahulu!";
  $btn_create_room = "<a href='?addroom' name='btn_logout_no_room' class='btn btn-primary btn-block'>Create Room</a>";
}



# ================================================
# GET ALL ROOM LIST OF PLAYER
# ================================================
$not_my_room_options = '';
$sql_status_room = $cadmin_level==2 ? " 1 " : " a.status_room = 1 ";

$s = "SELECT a.id_room,a.nama_room from tb_room a 
left join tb_room_player b on a.id_room=b.id_room and b.nickname='$cnickname'
where b.nickname is null 
and $sql_status_room  
order by a.nama_room
";
// die($s);
$q = mysqli_query($cn,$s) or die("Error #set_room e4r5: Can't get room data. ".mysqli_error($cn));

while ($d = mysqli_fetch_assoc($q)) {
  $id_rooms = $d['id_room'];
  $nama_rooms = $d['nama_room'];
  $not_my_room_options.="<option value='$id_rooms'>$nama_rooms</option>";
}









?>

<section id="set_room" class="visitor">
  <div class="container">




    <div class="row">
      <div class="col-lg-3">
        &nbsp;
      </div>
      <div class="col-lg-6">
        <?php if($pesan_request!=""){echo $pesan_request;exit();} ?>
        <h3>Welcome back <?=$cnama_player?></h3>

        <?php 
        if (count($my_available_id_rooms)==0) {

          ?>

          <p><?=$welcome_player?></p>
          <form method="post">
            <?=$btn_create_room?>
          </form>


          <?php
        }else{
          ?>

          <p>Kamu login sebagai: <span class="badge badge-success" style="font-size:12pt"><?=$cjenis_user?></span></p>


          <!-- # =========================================================== -->
          <!-- # TAWARAN MENGUBAH PROFIL (OPSIONAL) -->
          <!-- # =========================================================== -->
          <div id='blok_foto_saya' class='wadah text-center'>
            <!-- Foto Profile kamu: -->
            <div>
              <img src='<?=$path_profile?>' class='foto_profil'>
            </div>
            <p><small class='abu'>Jika ingin mengubah silahkan <a href='?ubah_profil'>Replace</a> dengan foto baru!</small></p>
          </div>


          <br>
          <div class="text-center">Silahkan Join Room!</div>
          <?php 
          if(isset($_POST['id_room_selected'])){
            $_SESSION['id_room'] = $_POST['id_room_selected'];
            echo "<script>location.replace('index.php')</script>";
            exit;
          }
          ?>


          <!-- ====================================================== -->
          <!-- BLOK SET_ROOM -->
          <!-- ====================================================== -->
          <style type="text/css">
            .blok_available_rooms{
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
            }
            .img_room_creator{
              width: 70px;
              height: 70px;
              border-radius: 50%;
              display: inline-block;
              background: white;
              margin: 5px;
              object-fit: cover;
              padding: 3px;
              transition: .3s;
            }

            .img_room_creator:hover {
              transform: scale(1.1);
            }

            .item_room{
              border: solid 1px #aaf;
              border-radius: 10px;
              /*background: linear-gradient(#dfd,#afa);*/
              padding: 10px;
              text-align: center;
              font-size: small;
              width: 150px;
              margin: 10px;
            }
          </style>
          <div class="blok_available_rooms">
            <?php 
            for ($i=0; $i < count($my_available_id_rooms); $i++) { 
              echo "
              <form method='post'>
                <input type='hidden' name='id_room_selected' value='$my_available_id_rooms[$i]'>
                <button class='item_room btn btn-primary'>
                  $my_available_nama_rooms[$i]
                  <div><img src='uploads/$my_available_room_creator_folder_uploads[$i]/_profile.jpg' class='img_room_creator'></div>
                  by: $my_available_room_creator[$i]
                </button>
              </form>
              ";
            }
            ?>
          </div>

          <form method="post">
            <!-- ====================================================== -->
            <!-- BLOK REQUEST PLAYER -->
            <!-- ====================================================== -->
            <div id="blok_request_player" class="hideit blok_fitur">
              <div class="form-group">
                <select class="form-control" id="id_not_my_room" name="req_id_room">
                  <option value="0">--Pilih--</option>
                  <?=$not_my_room_options?>
                </select>
              </div>
              
              <p>Halo, Selamat <?=$waktu?> Bapak/Ibu GM!<br>Saya <?=$nama_player?>,, izin ikut Room '<span id="nama_room">?</span>' ya :)</p>

              <button type="submit" name="btn_submit_request" class="btn-primary btn-block btn-lg"  style="border-radius: 9px;">Submit Request</button>

              <a href='#set_room' name="btn_cancel_request" class="btn-info btn-block btn-lg btn_nav text-center"  style="border-radius: 9px;" id="btn_cancel_request">Cancel</a>

            </div>
            <!-- ====================================================== -->

            
          </form>

          <?php 

          # ====================================================== -->
          # PENDING REQUEST
          # ====================================================== -->
          $s = "SELECT a.date_request,b.nama_room from tb_request_player a 
          join tb_room b on a.id_room = b.id_room 
          where a.nickname='$cnickname' and b.status_room=1";
          $q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data request player");
          if(mysqli_num_rows($q)>0){
            $hasil ="<hr><p>Your pending request:</p>";
            while($d=mysqli_fetch_assoc($q)){
              $nama_room = $d['nama_room'];
              $date_request = $d['date_request'];
              $hasil.= "~ Room: $nama_room at $date_request<br>";
            }
          }else{
            $hasil = '';
          }

          echo "$hasil";


          if($admin_level==2 or $admin_level==9) echo "<a href='?addroom' class='btn btn-success btn-block' style='margin-top: 10px'>Tambah Room Baru</a>";
        }

         ?>





      </div>
      <div class="col-lg-4">
        &nbsp;
      </div>

    </div>

  </div>
</section>


<script type="text/javascript">
  $(document).ready(function(){
    $("#id_not_my_room").change(function(){
      var id_room = $(this).val();
      if(id_room=="0"){
        $("#nama_room").text("?");
      }else{
        $("#nama_room").text($("#id_not_my_room option:selected").text());
      }
    })

    $(".btn_nav").click(function(){
      var id = $(this).prop("id");

      $(".blok_fitur").hide();

      switch(id){
        case "btn_request_as_player":$("#blok_request_player").fadeIn();break;
        case "btn_cancel_request":$("#blok_set_room").fadeIn();break;
      }
    })
  })
</script>