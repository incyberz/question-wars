<link rel='stylesheet' type='text/css' href='../assets/vendor/bootstrap/css/bootstrap.css'>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<?php   
$p_before = 'P05'; 
$p_ke = 'p05-jquery-sliding'; 
?>

<style>
.opsional { color: green; }
.rekomendasi { color: blue; }
.larangan { color: red; }
.perintah_utama { font-size: 20px; }

.sub_wadah{
  border: solid 1px #ccc;
  border-radius: 10px;
  padding: 15px;
  background: linear-gradient(#cfc, #ffc);
  font-family: 'century gothic';
  margin: 10px 0;
}

#penjelasan { display: none; }
</style>

<p class="perintah_utama">Buatlah Frontend yang dapat di menampilkan atau menyembunyikan blok/div lain memakai Javascript/JQuery.</p>

<button class="btn btn-primary btn-sm btn_aksi" id="btn_penjelasan">Penjelasan JQuery Slide Toggle</button>
<< klik tombol ini!
<div class="sub_wadah" id="penjelasan">
  <p>jQuery is a JavaScript library designed to simplify HTML DOM tree traversal and manipulation, as well as event handling, CSS animation, and Ajax. It is free, open-source software using the permissive MIT License. As of Aug 2022, jQuery is used by 77% of the 10 million most popular websites (from: Wikipedia).</p>

  <p>Efek slide adalah efek kemunculan sebuah elemen HTML dengan cara turun dari atas kebawah. Untuk membuat efek ini, jQuery menyediakan 2 buah method: slideUp() dan slideDown().</p>

  <p>Metode slide lainnya adalah slideToggle(). Metode ini merupakan sebuah metode yang berfungsi sebagai efek slideDown dan slideUp. Adapun sintak nya adalah sebagai berikut.</p>
  <p><code>$(selector).slideToggle(speed,easing,callback)</code></p>
  
</div>



<h5>Langkah Pengerjaan:</h5>
<ol>
  <li>Silahkan pelajari dahulu <a href="https://www.w3schools.com/jquery/jquery_slide.asp" target="_blank">JQuery Effects - Sliding</a> !</li>
  <li>Install <a href="https://jquery.com/download/" target="_blank">JQuery</a> ke kodemu!</li>
  <li class="rekomendasi">Buat Frontend yang dapat menampilkan, menyembunyikan, atau toggling sebuah blok penjelasan semisal diatas!</li>
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
    $('#btn_penjelasan').click(function(){
      let isi = $(this).text();

      $('#penjelasan').slideToggle();

    })
  })
</script>

