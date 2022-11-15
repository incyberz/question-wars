<link rel='stylesheet' type='text/css' href='assets/vendor/bootstrap/css/bootstrap.css'>
<?php   
$p_before = 'P02'; 
$p_ke = 'p03css'; 
?>

<style>
.opsional { color: green; }
.rekomendasi { color: blue; }
.larangan { color: red; }
.perintah_utama { font-size: 20px; }

.tabelku { border-spacing: 0; margin: 15px 0; width: 100%; max-width: 600px; background: linear-gradient(#ccffcc88,#ffffcc88);}
.tabelku .judul_tabel { font-weight: bold; background: linear-gradient(#ffffaa,#aaffff);}
.tabelku tr { border-top: solid 1px #ccc; }
.tabelku td { padding: 5px; cursor: pointer; transition: .2s;}
.tabelku td:hover { background: linear-gradient(#eee,#ccffff); letter-spacing: 1px; }
h5 { color: #66a; font-family: 'century gothic'; font-weight: bold; }
</style>

<p class="perintah_utama">Update Tugas <?=$p_before ?> dengan menampilkan 10 kawan terbaikmu di IKMI dalam bentuk tabel dengan kolom: 1. Nama dan 2. Alamat dilengkapi dengan Native CSS: background, padding, margin, hover, dan hiasan lainnya</p>

<hr>
<h4>My Best 5 Friends :: Lima Kawan terbaikku di IKMI</h4>
<table class="tabelku">
  <tr>
    <td class="judul_tabel" width="7%">No</td>
    <td class="judul_tabel" width="33%">Nama Kawanku</td>
    <td class="judul_tabel" width="40%">Alamat</td>
    <td class="judul_tabel" width="20%">Aksi</td>
  </tr>
  <tr>
    <td>1</td>
    <td>...</td>
    <td>...</td>
    <td>Edit | Hapus</td>
  </tr>

  <tr>
    <td>2</td>
    <td>...</td>
    <td>...</td>
    <td>Edit | Hapus</td>
  </tr>

  <tr>
    <td>3</td>
    <td>...</td>
    <td>...</td>
    <td>Edit | Hapus</td>
  </tr>

  <tr>
    <td>4</td>
    <td>...</td>
    <td>...</td>
    <td>Edit | Hapus</td>
  </tr>

  <tr>
    <td>5</td>
    <td>...</td>
    <td>...</td>
    <td>Edit | Hapus</td>
  </tr>


</table>
<hr>

<h5>Langkah:</h5>
<ul>
  <li>Buat folder "<?=$p_ke?>" pada project <?=$p_before ?> kamu, misal jika folder project "incyberz.github.io" maka path folder untuk tugas ini adalah "incyberz.github.io/<?=$p_ke?>/"</li>
  <li>pada folder "<?=$p_ke?>" buatlah page The Top 5 of My Best Friend</li>
  <li>Tabel diisi dengan nama & alamat lengkap kawanmu</li>
  <li class="rekomendasi"><b>Wajib dihiasi dengan CSS Native !!!</b></li>
  <li>eksekusi: <code>git add --all</code></li>
  <li>eksekusi: <code>git commit -m "Ini tugas <?=$p_ke?> Iin Sholihin-NIM: 41410034"</code></li>
  <li>eksekusi: <code>git push -u origin main</code></li>
  <li>Lihat hasil online dengan cara mengakses Github Pages punya kamu</li>
  <li>Link akses [Github Pages Kamu]/<?=$p_ke?>/, misal: <a href="https://incyberz.github.io/<?=$p_ke?>/" target="_blank"><code>https://incyberz.github.io/</code><?=$p_ke?>/</a> </li>
  <li class="opsional">(opsional) Tambahkan link dari Pages Utama ke path "/<?=$p_ke?>/</li>
  <li class="opsional">(opsional) Tambahkan link back dari path "/<?=$p_ke?>/ ke Pages Utama</li>
</ul>

<h5>Referensi:</h5>
<ul>
  <li><a href="https://www.w3schools.com/html/html_tables.asp" target="_blank">w3school - HTML Table</a></li>
  <li><a href="https://www.w3schools.com/csSref/sel_hover.asp" target="_blank">w3school - CSS Hover</a></li>

</ul>

<h5>Ketentuan:</h5>
<ul>
  <li class="rekomendasi">Untuk menghias web silahkan pakai CSS Native (yang diketik sendiri olehmu), untuk class-selector gunakanlah bahasa Indonesia/daerah (semisal: .kotak, .blok_utama, .artikel, .profil_aink)</li>
  <li class="rekomendasi">Bonus Point jika saat Submit hari-H (saat pertemuan <?=$p_ke ?>)</li>
  <li class="larangan">Tidak boleh memakai Web Template atau CSS Framework apapun (Bootstrap, dkk)</li>
  <li class="larangan">Pembuatan Selector Class tidak boleh mirip dengan Bootstrap/Tailwinds (.class, .container, .jumbotron, .text-center, .row, .col-lg, dsb)</li>
</ul>

<h5>Cara Pengumpulan:</h5>
<ul>
  <li>Post link Github Pages kamu yang langsung mengarah ke path <code>[Github Pages Kamu]/<?=$p_ke?>/</code> di QWars Challenge!</li>
</ul>