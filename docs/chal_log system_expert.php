<link rel='stylesheet' type='text/css' href='assets/vendor/bootstrap/css/bootstrap.css'>

<h5>Buatlah Fitur Log System pada CRUD App yang dapat mencatat Log Activity (catatan aktifitas user) ke dalam sebuah file text</h5>
<p>Dalam The Top 10 OWASP (sepuluh kerentanan aplikasi terbesar), satu diantaranya adalah Insufficient Logging and Monitoring. Aplikasi Web tanpa Logging (catatan aktifitas user) sangat sulit untuk mengecek apakah web tersebut ada yang meretas atau tidak.
</p>
<p>Challenge ini adalah materi Secure Code bagi para programmer muda agar hasil aplikasi webnya tidak mudah di-hack. Challenge ini membutuhkan skill basic CRUD-PHP dan Login System. Buktikan bahwa kamu memang layak mendapatkan <span class='badge badge-danger'>1jt point reward</span> pada challenge ini! Dan tentunya jaminan <span class='badge badge-success'>nilai A</span> bagi MK Pemrograman Web Dasar <small>)* S&K berlaku</small></p>
<p>Ketentuan:</p>
<ul>
  <li>Rekam semua codingmu sebagai bukti bahwa kamu tidak copas code!</li><li>Buatlah Aplikasi CRUD dengan Login System</li><li>Buat function add_log_activity() dengan fitur PHP Open File dan PHP Create File</li><li>Login sebagai user biasa (bukan admin)</li><li>Setiap user melakukan Create/Read/Update/Delete akan memanggil function add_log_activity(), sehingga setiap aktifitas user tercatat by system.</li>
  <li>Log activity hanya bisa diakses oleh super user (petugas dengan level tertinggi) </li>
  <li>Setiap log (catatan ) terdiri dari: 
    <ol>
<li>Jam dan tanggal saat ini</li><li>Username yang sedang login</li><li>Admin Level</li><li>IP address dan jenis platform yang dipakai user</li><li>Tipe Aktifitas: Login, Create, Read, Update, atau Delete</li><li>Data apa yang dibaca, dibuat, diubah atau dihapus?</li>    
</ol>
  </li>
  <li>Log Example:</li>
  <ul>
    <li>2021-09-12 13:45:56</li>
    <li>Username: insho</li>
    <li>admin-level:4 (Staf BAK)</li>
    <li>from: 182.253.105.98 by Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0)</li>
    <li>Action: Update</li>
    <li>db: db_akademik; tb: tb_nilai_mahasiswa</li>
  </ul>
</ul>

<p>Referensi:</p>
<ol>
  <li>Materi tentang 10 terbesar kerentanan website: <br><a href='https://owasp.org/Top10/' target='_blank' style='font-size:small'>https://owasp.org/Top10/</a></li>
  <li>Praktikum online tentang PHP-File-Open: <br><a href='https://www.w3schools.com/php/php_file_open.asp' target='_blank' style='font-size:small'>https://www.w3schools.com/php/php_file_open.asp</a></li>
  <li>Praktikum online tentang PHP-File-Create: <br><a href='https://www.w3schools.com/php/php_file_create.asp' target='_blank' style='font-size:small'>https://www.w3schools.com/php/php_file_create.asp</a></li>
  <li>Fungsi untuk mendapatkan jam dan tanggal saat ini: <br><a href='https://www.w3schools.com/php/func_date_date.asp' target='_blank' style='font-size:small'>https://www.w3schools.com/php/func_date_date.asp</a></li>
  <li>Fungsi untuk mendapatkan IP address dan User Platform: <br><a href='https://www.w3schools.com/php/php_superglobals_server.asp' target='_blank' style='font-size:small'>https://www.w3schools.com/php/php_superglobals_server.asp</a></li>
  <li>Video Youtube Monitor Login Activity: <br><a href='https://www.youtube.com/watch?v=b_96V9uN7jo' target='_blank' style='font-size:small'>https://www.youtube.com/watch?v=b_96V9uN7jo</a></li>
</ol>
<p>Cara Pengumpulan:</p>
<ul>
  <li>Rekam semua aktifitas codingmu!</li>
  <li>Do video editing with your desirable effects</li>
  <li>Add STMIK IKMI attributes</li>
  <li>Buat screen-recording presentasi aplikasi
    <ol>
      <li>Perkenalkan dirimu!</li>
      <li>Tampilkan fast-forward aktifitas codingmu | <small><i><a href='https://www.bandicam.com/bandicut-video-cutter/support/playback-speed/' target='_blank'>help example</a></i></small></li>
      <li>Tampilkan coding (left) dan hasil coding (right)</li>
      <li>Durasi max 5 menit</li>
      <li>Bonus point in English</li>

    </ol>
  </li>
  <li>Post in QWars Challenge!</li>
</ul>