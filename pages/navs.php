<?php
// $img_profile = "assets/img/players/profile_na.jpg";
// $room_player_point  = $d['room_player_point'];
// $singkatan_room  = $d['singkatan_room'];
// $link_path  = $d['link_path'];

if ($cid_room!=0 and $cadmin_level!=0) {
    $s = "SELECT a.room_player_point,b.singkatan_room,c.link_path from  tb_room_player a 
  join tb_room b on a.id_room=b.id_room 
  join tb_player c on a.nickname=c.nickname 
  where a.id_room = '$cid_room' and a.nickname='$cnickname'";
    $q = mysqli_query($cn, $s) or die("Error @navs. Tidak bisa mengakses room_player_point $s");
    $d = mysqli_fetch_assoc($q);
    $room_player_point  = round($d['room_player_point']);
    $singkatan_room  = $d['singkatan_room'];
    $link_path  = $d['link_path'];

    $img_profile = "assets/img/players/profile_$cnickname"."_$link_path.jpg";
    if (!file_exists($img_profile)) {
        $img_profile = "assets/img/players/profile_na.jpg";
    }
}
?>

<nav class="nav-menu d-none d-lg-block">
  <ul>
    <?php if (!$is_login) { ?>

      <!-- =============================================== -->
      <!-- MENU PENGUNJUNG -->
      <!-- =============================================== -->
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="#counts">Our Achievements</a></li>
      <li><a href="#faq">What is this?</a></li>

    <?php } elseif ($is_login and $cadmin_level!=0 and $cid_room!=0) { ?>


      <!-- =============================================== -->
      <!-- MENU LOGGED USER -->
      <!-- =============================================== -->
      <li><a href="?konversi_nilai">Nilai Saya</a></li>
      <li class="drop-down"><a href="#"><?=$cnickname ?></a>
        <ul>
          <li><a href="?kuis">Play Quiz!</a></li>
          <li><a href="?myq">My Questions</a></li>
          <li><a href="?chal">Challenge Praktikum</a></li>
          <!-- <li><a href="?tugas">Tugas Harian</a></li> -->
          <li><a href="?presensi">Presensi Kuliah</a></li>
          <!-- <li><a href="about/">My Profile</a></li> -->
          <li><a href="?ubah_pass">Ubah Password</a></li>


          <!-- =============================================== -->
          <!-- MENU CHANGE ROOM -->
          <!-- =============================================== -->
          <?php if ($manage_room_headers!="") { ?>
            <li class="drop-down"><a href="#">Change Room</a>
              <ul>
                <?=$manage_room_headers?>
              </ul>
            </li>
          <?php } ?>


        </ul>
      </li>

      <li class="drop-down"><a href="#">Info</a>
        <ul>
          <li><a href="?rank_kelas">Rank Kelas</a></li>
          <li><a href="?rank_prodi">Rank Prodi</a></li>
          <li><a href="?rank_global">Rank Global</a></li>
          <li><a href="?paling_rajin">Paling Rajin</a></li>
          <li><a href="?investor_soal">Investor Soal</a></li>
          <li><a href="?best_chal">Best Challenger</a></li>
          <li><a href="?help">Help / Bantuan</a></li>
        </ul>
      </li>







      <!-- =============================================== -->
      <!-- MENU KHUSUS GM -->
      <!-- =============================================== -->
      <?php
      if ($cadmin_level==2 or $cadmin_level==9) {
          ?>
        <li class="drop-down"><a href="#">Fitur GM</a>
          <ul>
            <li><a href="?listplayers" >Kenali Mahasiswa</a></li>
            <li><a href="?manageplayers" >Manage Players</a></li>
            <li><a href="?managekelas" >Manage Kelas</a></li>
            <li><a href="?manageroom" >Manage Pertemuan</a></li>
            <li><a href="?managechal" >Manage Challenge</a></li>
            <li><a href="?playerqs" >Manage Questions</a></li>
            <li><a href="?rpresensi" >Laporan Presensi</a></li>
            <li><a href="?lap_na" >Laporan Nilai Akhir</a></li>
            <li><a href="?fpresensi" >Feedback Presensi</a></li>
            <li><a href="?addroom" >Add New Room</a></li>
          </ul>
        </li>

        <?php
      }


      # ======================================================= -->
      # SHOW LOGAS BACK -->
      # ======================================================= -->
      if (isset($_SESSION['logas_nickname'])) {
          echo "
          <li><a style='background:yellow; color:red' href='?unlogas' onclick='return confirm(\"Yakin mau kembali sebagai GM?\")'>unLog-As</a></li>
        ";
      }
    }
?>


    <!-- ======================================================= -->
    <!-- LOGOUT FOR ALL USERS -->
    <!-- ======================================================= -->
    <?php if ($is_login) { ?>
      <li><a href="?logout" onclick="return confirm('Yakin untuk Logout?')">Logout</a></li>
    <?php } ?>


  </ul>

</nav>


<?php if ($is_login and $cid_room!=0) { ?>
  <a href="?" class="get-started-btn scrollto" style="padding: 5px 8px">
    <!-- <img src="<?=$path_profile ?>" width="25px" height="25px" class="rounded-circle" style="border: solid 1px #888;">  -->
    <span style="font-size:9pt"><?=$singkatan_room?> </span>
    <span class="badge badge-primary" style="font-size:12pt;border:solid 1px #ccc; border-radius:10px"><span id="room_player_point_atheader"><?=$room_player_point ?></span> <span style="font-size:8pt">LP</span></span>
  </a>
<?php } ?>




<script type="text/javascript">
  $(document).ready(function(){
    // =======================================================
    // HEADER LINKS AND VIEW CONTROLLERS
    // =======================================================
    function setview(form){
      $(".visitor").hide();
      $(".player").hide();
      $(".gm").hide();
      $("#"+form).show();
    }


    $(".link_header").click(function(){
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var id = rid[1];
      if(id=="player_questions") {$("#btn_refresh_list_question").show();}
      //else{alert(id);}
      setview(id);
      // alert(id);
    })

    $(".change_room").click(function(){
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var id = rid[1];
      $("#id_room_selected").val(id).change();
      setview("change_room");
    })
  })
</script>