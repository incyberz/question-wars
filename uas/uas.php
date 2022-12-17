<?php
die("<div class='alert alert-danger'>Maaf, saat ini UAS-2022 sudah berakhir.<hr><a href='index.php'>Login ke QWars</a></div>");
$jawaban[0]='';
$jawaban[1]='';
$jawaban[2]='';
$jawaban[3]='';
$jawaban[4]='';

$nama='';
$nim='';
$selected_tipe_a = '';
$selected_tipe_b = '';

$pesan_error = '';
$is_punya_orang=0;




if (isset($_POST['jawaban'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $tipe_soal = $_POST['tipe_soal'];

    $selected_tipe_a = $tipe_soal=='A' ? 'selected' : '';
    $selected_tipe_b = $tipe_soal=='B' ? 'selected' : '';

    $jawabans = '';
    for ($i=0; $i < 5; $i++) {
        $jawaban[$i] = $_POST['jawaban'][$i];
        $jawabans .= $_POST['jawaban'][$i];
    }


    $s = "SELECT 1 from tb_player where nickname='$nim'";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
    if (mysqli_num_rows($q)==0) {
        $pesan_error = "NIM: $nim, tidak ada di tabel mahasiswa.";
    } else {
        $s = "INSERT INTO tb_uas 
    (nim,  nama,  tipe_soal,  jawabans) values 
    ('$nim','$nama','$tipe_soal','$jawabans')";

        $aksi = 'simpan';
        if (isset($cnickname) and $cnickname!='') {
            echo "<div class='m-3'>Login as: $cnickname</div>";

            if ($cnickname!=$nim) {
                echo "<div class='m-3 alert alert-danger'>Maaf, Anda tidak bisa replace jawaban punya orang.<hr>input NIM: $nim<hr>
            <a href='?uas'>Input Ulang</a> | 
            <a href='index.php'>Relogin ke QWars</a>
            </div>";
                $is_punya_orang=1;
            } else {
                $s .= " ON DUPLICATE KEY UPDATE 
            nama='$nama', 
            tipe_soal='$tipe_soal', 
            jawabans='$jawabans' 
            ";
                $aksi = 'replace';
            }
        }

        $q = mysqli_query($cn, $s);

        $noname = $nama=='' ? 'noname' : $nama;

        if ($q) {
            echo "<h3>Sukses $aksi jawaban.</h3>
        <hr>
        <p>
            Jawaban atas nama: $noname, nim: $nim, telah berhasil disimpan pada database.
        </p>
        <hr>
        Terimakasih telah insert data!
        <hr>
        Kamu bisa lihat hasilnya setelah kelas sore beres UAS.<hr> (by: Pa iin)
        ";
            exit;
        } else {
            $error_kode = mysqli_errno($cn);
            $error_msg = mysqli_error($cn);

            if ($error_kode==1062) {
                $pesan_error = "Jawaban dengan nim: $nim telah ada.<hr>Untuk Replace Jawaban, silahkan <a href='index.php'>login dahulu ke QWars</a>, lalu submit ulang.";
            } else {
                $pesan_error = $error_msg;
            }
        }
    }
}

$pesan_error = $pesan_error=='' ? '' : "<div class='alert alert-danger'>$pesan_error</div>";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UAS</title>
    <link
      rel="stylesheet"
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="uas/uas.css" />
  </head>
  <body>
    <div class="container">
        <?php if ($is_punya_orang) {
            exit;
        }?>
      <h3>Insert Jawaban UAS</h3>
      <?=$pesan_error ?>
      <hr>

      <p>Halo Pengunjung! Silahkan masukan jawaban UAS PWeb Anda:</p>
      <form method="post">
        <div class="row mb-4">
          <div class="col-lg-4 form-group">
            <label for="nim">NIM</label>
            <input
              class="form-control nim"
              type="text"
              minlength="8"
              maxlength="8"
              required
              value="<?=$nim?>" 
              name="nim"
            />
          </div>

          <div class="col-lg-4 form-group">
            <label for="nama">Nama (optional)</label>
            <input
              class="form-control"
              type="text"
              minlength="3"
              maxlength="30"
              value="<?=$nama?>"
              name="nama" 
            />
          </div>
          <div class="col-lg-4">&nbsp;</div>
          <div class="col-lg-4 form-group">
            <label for="tipe_soal">Tipe Soal</label>
            <select
              class="form-control tipe_soal"
              name="tipe_soal"
              id="tipe_soal"
            >
              <option <?=$selected_tipe_a?>
                value="A"><span class=tipe_soal_span>A</span>
              </option>
              <option <?=$selected_tipe_b?>
                value="B"><span class=tipe_soal_span>B</span>
              </option>
            </select>
          </div>
          <div class="col-12">
            <p>Masukan jawaban UAS Anda (25 soal):</p>
          </div>
          <div class="col-lg-2 blok_jawaban">
            <input
              type="text"
              minlength="5"
              maxlength="5"
              class="form-control jawaban"
              id="jawaban__1"
              required
              name="jawaban[]"
              value="<?=$jawaban[0]?>"
            /><small>1 s.d 5</small>
          </div>

          <div class="col-lg-2 blok_jawaban">
            <input
              type="text"
              minlength="5"
              maxlength="5"
              class="form-control jawaban"
              id="jawaban__2"
              required
              name="jawaban[]"
              value="<?=$jawaban[1]?>"
            /><small>6 s.d 10</small>
          </div>

          <div class="col-lg-2 blok_jawaban">
            <input
              type="text"
              minlength="5"
              maxlength="5"
              class="form-control jawaban"
              id="jawaban__3"
              required
              name="jawaban[]"
              value="<?=$jawaban[2]?>"
            /><small>11 s.d 15</small>
          </div>

          <div class="col-lg-2 blok_jawaban">
            <input
              type="text"
              minlength="5"
              maxlength="5"
              class="form-control jawaban"
              id="jawaban__4"
              required
              name="jawaban[]"
              value="<?=$jawaban[3]?>"
            /><small>16 s.d 20</small>
          </div>

          <div class="col-lg-2 blok_jawaban">
            <input
              type="text"
              minlength="5"
              maxlength="5"
              class="form-control jawaban"
              id="jawaban__5"
              required
              name="jawaban[]"
              value="<?=$jawaban[4]?>"
            /><small>21 s.d 25</small>
          </div>

          <div class="col-lg-2 blok_jawaban">
            <button class=" btn btn-primary btn-block btn_submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
