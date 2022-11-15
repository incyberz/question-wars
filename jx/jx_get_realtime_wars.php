<?php 
include '../config.php';

$s = "SELECT 1 FROM tb_player 
WHERE last_activity is not null 
and time_to_sec((TIMEDIFF( now(), last_activity)))<600
";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$online_players = mysqli_num_rows($q);
$warriors="<div style='margin-bottom:10px'>For now <span style='font-size:20px; color:darkred'>$online_players</span> players in wars!!</div>";


$s = "SELECT a.id_playedby, a.dijawab_benar, a.tgl_jawab, b.nama_player as nama_penjawab, d.nama_player as pembuat_soal   
FROM tb_soal_playedby a 
JOIN tb_player b on a.nickname=b.nickname 
JOIN tb_soal c on a.id_soal=c.id_soal 
JOIN tb_player d ON c.soal_creator=d.nickname 
ORDER BY a.tgl_jawab DESC 
LIMIT 10";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
  $i++;
  $id_playedby = $d['id_playedby'];
  $dijawab_benar = $d['dijawab_benar'];
  $nama_penjawab = $d['nama_penjawab'];
  $pembuat_soal = $d['pembuat_soal'];
  $tgl_jawab = $d['tgl_jawab'];


  $id = explode('_by_',$id_playedby);
  $id2 = explode('_',$id[0]);

  $penjawab = $id[1];
  $soal_creator = $id2[0];

  $wp_no = (date('s',strtotime($tgl_jawab)) % 12) + 1; 

  $img_wp = "<img class='img_weapon' src='assets/img/guns/wp$wp_no.png'>";
  $link_penjawab = "<a href='about/?nickname=$penjawab' target='_blank'>$nama_penjawab</a>";
  $link_pembuat_soal = "<a href='about/?nickname=$soal_creator' target='_blank'>$pembuat_soal</a>";

  $row_war_ganjil = $i%2==0 ? '' : 'row_war_ganjil';
  $dijawab_benar_class = $dijawab_benar ? 'dijawab_benar': '';

  $cek = '<img src="assets/img/icons/check_green.png" height="25px" />';
  if(!$dijawab_benar) $cek = '';

  $warriors .= "
  <div class='row_war $row_war_ganjil $dijawab_benar_class'>
    <div class='row'>
      <div class='col-lg-4'>$tgl_jawab $cek</div>
      <div class='col-lg-8'>$link_penjawab $img_wp $link_pembuat_soal</div>
    </div>
  </div>
  ";
}
echo "$warriors";
?>