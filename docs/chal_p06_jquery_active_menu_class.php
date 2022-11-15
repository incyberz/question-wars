<link rel='stylesheet' type='text/css' href='../assets/vendor/bootstrap/css/bootstrap.css'>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<?php   
$p_before = 'P06'; 
$p_ke = 'p06-spa-menu'; 
?>

<style>
.opsional { color: green; }
.rekomendasi { color: blue; }
.larangan { color: red; }
.perintah_utama { font-size: 20px; }

.navigasi{
  border-top: solid 1px #ccc;
  border-bottom: solid 1px #ccc;
  padding: 15px;
  background: linear-gradient(#cfc, #ffc);
  font-family: 'century gothic';
  margin: 10px 0;
}

.item_menu { cursor: pointer; transition: .2s; }
.item_menu:hover { letter-spacing: 1px; color: blue; }

.menu_aktif{
  font-weight: bold;
  text-decoration: underline;
  color: blue;
}

.penjelasan { display: none; border: solid 1px #ccc; border-radius: 15px; padding: 15px; background: linear-gradient(#cfc,#ffc); }
</style>

<p class="perintah_utama">Buatlah Frontend yang dapat menandai Menu mana yang sedang aktif dan yang tidak! Lalu tampilkanlah blok/penjelasan dari menu yang aktif tersebut!</p>

<h4>Intro :: Single Page Application</h4>
<p>Sesuai dengan namanya Single Page Application yaitu sebuah konsep aplikasi web yang memiliki satu halaman saja. Jadi gimana tuh, kok web tetapi hanya satu halaman, apakah cukup? Karena yang kita tahu sebuah aplikasi web biasanya memiliki lebih dari satu halaman. Seperti ada halaman untuk home, login, register dan lain-lain.</p>
<p>Cara Kerja SPA</p>
<p>Pada web biasa atau multi page jika kita melakukan navigasi kehalaman lain, maka browser akan memuat ulang seluruh halaman setelah melakukan request ke server. Berbeda dengan web Single Web Application, ketika kita melakukan navigasi atau berpindah kehalaman lain, maka javascript akan melakukan fetching ke server dan mengganti tampilan ke navigasi lain tanpa perlu browser memuat ulang seluruh halaman.</p>
<div>Kelebihan SPA:</div>
<ul>
  <li>Tanpa reload!</li>
  <li>Lebih cepat karena yang perlu diload hanya yang direquest by user, tampilan lain tetap</li>
  <li>Lebih hemat bandwidth internet</li>
  <li>Dapat dikembangkan dg AJAX untuk acessing database</li>
  <li>Dapat dikembangkan dg teknik Lazy-loading untuk list data yang besar!</li>
</ul>

<div>Kekurangan SPA:</div>
<ul>
  <li>Tidak cocok untuk aplikasi database terstruktur yang kompleks</li>
  <li>Memerlukan logic tinggi khususnya pada konsep Array!</li>
</ul>

<hr>
  

<div class="navigasi">
  <span class="item_menu menu_aktif" id="item_menu__home">Home</span> | 
  <span class="item_menu" id="item_menu__produk">produk</span> | 
  <span class="item_menu" id="item_menu__layanan">layanan</span> | 
  <span class="item_menu" id="item_menu__tentang">tentang</span> | 
  <span class="item_menu" id="item_menu__kontak">kontak</span> 
</div>

<div class="penjelasan" id="penjelasan__home">
  <h4>Menu Home</h4>
  <p>Sed mollit commodo excepteur nulla exercitation et eu sunt aliqua aliquip anim in sint sint exercitation deserunt. Aliqua ex ut ut ut enim non anim dolor tempor aute reprehenderit voluptate nisi aute sint.</p>
</div>

<div class="penjelasan" id="penjelasan__produk">
  <h4>Menu Produk</h4>
  <p>Tempor exercitation ea minim ut consequat excepteur nostrud proident ex pariatur. Dolore minim do mollit veniam non laborum ut id voluptate. Nisi velit commodo minim sed pariatur enim sint laborum labore laborum et reprehenderit sed anim aliqua deserunt culpa. Lorem ipsum pariatur commodo dolor anim dolore dolore in occaecat sint eiusmod.</p>
</div>

<div class="penjelasan" id="penjelasan__layanan">
  <h4>Menu Layanan</h4>
  <p>Ut ea in officia enim esse laboris labore laboris minim dolore. Adipisicing ea consequat duis fugiat do ea culpa dolor ut ad ex irure exercitation est ut. Dolore ut esse nulla in labore velit excepteur sint tempor adipisicing sit.</p>
</div>

<div class="penjelasan" id="penjelasan__tentang">
  <h4>Menu Tentang</h4>
  <p>Et sit in culpa enim aliqua ullamco laborum excepteur aute exercitation. Dolor quis cupidatat aute nisi magna culpa dolor exercitation ex non. Lorem ipsum tempor cillum tempor mollit esse et nostrud proident labore commodo velit aliqua enim dolor consectetur id pariatur cillum consectetur. Enim in ut tempor deserunt ullamco minim ea cillum ea minim commodo in in dolore aliquip.</p>
</div>

<div class="penjelasan" id="penjelasan__kontak">
  <h4>Menu Kontak</h4>
  <p>Id pariatur anim amet deserunt anim amet consectetur ex consequat aute mollit culpa ut occaecat do. Lorem ipsum aliqua officia voluptate est quis adipisicing aliquip deserunt culpa laborum aute id duis. Aliquip deserunt et nisi do pariatur mollit cillum proident sint excepteur. Tempor deserunt nisi qui duis sunt tempor fugiat fugiat tempor anim laborum ex voluptate ad incididunt ex culpa.</p>
</div>

<hr>


<h5>Langkah Pengerjaan:</h5>
<ol>
  <li>Silahkan pelajari dahulu <a href="https://www.w3schools.com/jquery/html_addclass.asp" target="_blank">JQuery Add Class</a> dan <a href="https://www.w3schools.com/jquery/html_removeclass.asp" target="_blank">JQuery Remove Class</a> !</li>
  <li>Install <a href="https://jquery.com/download/" target="_blank">JQuery</a> ke kodemu!</li>
  <li>Buat folder "<?=$p_ke?>" pada project kamu!</li>

  <li class="rekomendasi">Buat Frontend semisal diatas!</li>
  <li>Obfuscate kodemu! Wajib!! agar tidak dicopas orang lain.</li>
  <li>Upload hasilnya ke Github!</li>
  <li>Link akses ke [Github Pages Kamu] semisal: <a href="https://incyberz.github.io/<?=$p_ke?>/" target="_blank"><code>https://incyberz.github.io/</code><?=$p_ke?>/</a> </li>
</ol>



<h5>Ketentuan:</h5>
<ul>
  <li class="rekomendasi">Untuk menghias web silahkan pakai CSS Native (yang diketik sendiri olehmu), untuk class-selector gunakanlah bahasa Indonesia/daerah (semisal: .kotak, .blok_utama, .artikel, .profil_aink)</li>
  <li class="rekomendasi">Bonus Point bagi challenger tercepat</li>
  <li class="larangan">Tidak boleh memakai Web Template atau CSS Framework apapun (Bootstrap, dkk)</li>
  <li class="larangan">Pembuatan Selector Class tidak boleh mirip dengan Bootstrap/Tailwinds (.class, .container, .jumbotron, .text-center, .row, .col-lg, dsb)</li>
</ul>

<h5>Cara Pengumpulan:</h5>
<ul>
  <li>Post link Github Pages kamu yang langsung mengarah ke path <code>[Github Pages Kamu]/<?=$p_ke?>/</code> di QWars Challenge!</li>
</ul>


<script>
  $(document).ready(function(){
    $('.item_menu').click(function(){

      let tid = $(this).prop('id');
      let rid = tid.split('__');
      let id_menu = rid[1];

      $('.item_menu').removeClass('menu_aktif');
      $(this).addClass('menu_aktif')

      $('.penjelasan').slideUp();
      $('#penjelasan__'+id_menu).slideDown();

    })

    // $('.item_menu').click()
  })
</script>

