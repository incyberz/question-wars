<?php   
$p_before = 'P02'; 
$p_ke = 'p03form-lv1'; 
?>

<style>
.opsional { color: green; }
.rekomendasi { color: blue; }
.larangan { color: red; }
.perintah_utama { font-size: 20px; }
h5 { color: #66a; font-family: 'century gothic'; font-weight: bold; }
</style>

<p class="perintah_utama">Buatlah Formulir PMB sesuai dengan <a href="docs/example/formulir-pmb.jpg" target="_blank">Contoh Formulir</a> berikut dengan HTML Only (Tanpa CSS, Tanpa JS)</p>

<h5>Langkah-langkah:</h5>
<ul>
  <li>Lihat <a href="docs/example/formulir-pmb.jpg" target="_blank">Contoh Formulir</a> PMB berikut! Pelajarilah!</li>
  <li>Formulir harus terdapat logo, kop-surat, bagian pengisian formulir, dan bagian ttd</li>
  <li>Buat folder "<?=$p_ke?>" pada project kamu, misal jika folder project "incyberz.github.io" maka path folder untuk tugas ini adalah "<code>incyberz.github.io/<?=$p_ke?>/</code>"</li>
  <li>pada folder "<?=$p_ke?>" buatlah page Formulir PMB sesuai dengan Ketentuan (lihat Section Ketentuan!)</li>
  <li>Lakukan <code>git push</code> ke online website-mu!</li>
  <li>Lihat hasil online dengan cara mengakses Github Pages punya kamu</li>
  <li>Link akses [Github Pages Kamu]/<?=$p_ke?>/, misal: <a href="https://incyberz.github.io/<?=$p_ke?>/" target="_blank"><code>https://incyberz.github.io/</code><?=$p_ke?>/</a> </li>
</ul>

<h5>Referensi:</h5>
<ul>
  <li><a href="https://www.w3schools.com/html/html_forms.asp" target="_blank">w3school - HTML Form</a></li>
</ul>

<h5>Ketentuan:</h5>
<ul>
  <li class="rekomendasi">Formulir harus terdapat logo, kop-surat, bagian pengisian formulir, dan bagian ttd</li>
  <li class="rekomendasi">Untuk input isian gunakan <code>input text</code></li>
  <li class="rekomendasi">Untuk input email gunakan <code>input text - type email</code></li>
  <li class="rekomendasi">Untuk input pilihan lebih dari satu gunakan <code>input-checkbox</code></li>
  <li class="rekomendasi">Untuk input pilihan hanya satu boleh menggunakan <code>input-radio</code> atau <code>select-option</code></li>
  <li class="larangan">Tidak perlu memakai CSS!</li>
  <li class="larangan">Tidak perlu memakai JS!</li>
</ul>

<h5>Cara Pengumpulan:</h5>
<ul>
  <li>Post link Github Pages kamu yang langsung mengarah ke path <code>[Github Pages Kamu]/<?=$p_ke?>/</code> di QWars Challenge!</li>
</ul>

