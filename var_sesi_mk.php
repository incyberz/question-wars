<?php 
# ================================================
# SESI_MK DB VARIABLE 
# ================================================
$zid_room_subjects = '';
$zsesi_mks = '';
$jspss = '';
if($cid_room>0){
  $s = "SELECT 
  a.id_room_subject, 
  a.nama_subject, 
  (SELECT count(1) FROM tb_soal 
  WHERE visibility_soal != -2 
  AND id_room_subject=a.id_room_subject 
  AND soal_creator='$cnickname' 
  ) as jumlah_soal_per_sesi
  
  FROM tb_room_subject a 
  WHERE a.id_room=$cid_room 
  AND a.nama_subject NOT LIKE '%materi_umum%'  
  ";
  // die($s);
  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

  while ($d=mysqli_fetch_assoc($q)) {
    $zid_room_subjects .= $d['id_room_subject'].'__';
    $zsesi_mks .= $d['nama_subject'].'__';
    $jspss .= $d['jumlah_soal_per_sesi'].'__';
  }
}

$rsesi_mks = explode('__', $zsesi_mks);
$rid_room_subjects = explode('__', $zid_room_subjects);
$rjspss = explode('__', $jspss);


# ================================================
# STATUS SOAL DB VARIABLE 
# ================================================
$zstatus_soal = '';
$znama_status = '';
$rekap_status = '';
if($cid_room>0){
  $s = "SELECT z.*, 
  (SELECT count(1) FROM tb_soal a 
  JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
  JOIN tb_room c on b.id_room=c.id_room 

  WHERE a.soal_creator='$cnickname' 
  AND a.status_soal=z.status_soal 
  AND a.status_soal=z.status_soal 
  AND c.id_room = $cid_room 
  AND a.visibility_soal != -2 
  AND b.nama_subject NOT LIKE '%materi umum%' 

  ) AS rekap_status 

  FROM tb_soal_status z 
  ";
  // die($s);
  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

  while ($d=mysqli_fetch_assoc($q)) {
    $zstatus_soal .= $d['status_soal'].'__';
    $znama_status .= $d['nama_status'].'__';
    $rekap_status .= $d['rekap_status'].'__';
    // echo "<hr>$zstatus_soal";
  }
}

$rnama_status = explode('__', $znama_status);
$rstatus_soal = explode('__', $zstatus_soal);
$rrekap_status = explode('__', $rekap_status);






# ================================================
# VISIBILITY SOAL DB VARIABLE 
# ================================================
$zvisibility_soal = '';
$znama_visibility = '';
$rekap_visibility = '';
if($cid_room>0){
  $s = "SELECT z.*, 
  (SELECT count(1) FROM tb_soal a 
  JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
  JOIN tb_room c on b.id_room=c.id_room 

  WHERE a.soal_creator='$cnickname' 
  AND a.visibility_soal=z.visibility_soal 
  AND a.visibility_soal=z.visibility_soal 
  AND c.id_room = $cid_room 
  AND a.visibility_soal != -2 
  AND b.nama_subject NOT LIKE '%materi umum%' 

  ) AS rekap_visibility 

  FROM tb_soal_visibility z 
  ";
  // die($s);
  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

  while ($d=mysqli_fetch_assoc($q)) {
    $zvisibility_soal .= $d['visibility_soal'].'__';
    $znama_visibility .= $d['nama_visibility'].'__';
    $rekap_visibility .= $d['rekap_visibility'].'__';
    // echo "<hr>$zvisibility_soal";
  }
}

$rnama_visibility = explode('__', $znama_visibility);
$rvisibility_soal = explode('__', $zvisibility_soal);
$rrekap_visibility = explode('__', $rekap_visibility);
?>