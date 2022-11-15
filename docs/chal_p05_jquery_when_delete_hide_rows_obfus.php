<link rel='stylesheet' type='text/css' href='../assets/vendor/bootstrap/css/bootstrap.css'>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<?php   
$p_before = 'P05'; 
$p_ke = 'p05-jquery-delete'; 
?>

<style>
.opsional { color: green; }
.rekomendasi { color: blue; }
.larangan { color: red; }
.perintah_utama { font-size: 20px; }

.tabelku { color: black; border-spacing: 0; margin: 15px 0; width: 100%; max-width: 600px; background: linear-gradient(#ccffcc88,#ffffcc88); }
.tabelku .judul_tabel { font-weight: bold; background: linear-gradient(#ffffaa,#aaffff); color: darkred;}
.tabelku tr { border-top: solid 1px #ccc; }
.tabelku td { padding: 5px; cursor: pointer; transition: .2s; }
.tabelku td:hover { background: linear-gradient(#eee,#ccffff); letter-spacing: 1px; color: darkblue; }
h5 { color: #66a; font-family: 'century gothic'; font-weight: bold; }
</style>

<p class="perintah_utama">Buatlah Frontend Hapus Data dimana ketika tekan Hapus ada konfirmasi, dan jika terkonfirmasi maka rows data tersebut disembunyikan memakai Javascript/JQuery.</p>

<table class="tabelku">
  <tr>
    <td class="judul_tabel" width="7%">No</td>
    <td class="judul_tabel" width="33%">Nama Kawanku</td>
    <td class="judul_tabel" width="40%">Alamat</td>
    <td class="judul_tabel" width="20%">Aksi</td>
  </tr>
  
  <?php 
  $nama = ['Ahmad','Budi','Charlie','Deni','Erwin'];
  $alamat = ['Majasem','Ciwaringin','Talun','Brebes','Sumedang'];
  for ($i=1; $i <=5 ; $i++) { 
    $j=$i-1;
    echo "
    <tr class='baris' id='baris__$i'>
      <td>$i</td>
      <td class='cell' id='nama__$i'>$nama[$j]</td>
      <td class='cell' id='alamat__$i'>$alamat[$j]</td>
      <td class='cell' id='hapus__$i'>Hapus</td>
    </tr>
    ";
  }
  ?>


</table>

<p>Silahkan pelajari kode JQuery untuk tabel diatas</p>
<img src="docs/chal_p05_jquery_when_delete_hide_rows_kode.jpg">



<h5>Langkah Pengerjaan:</h5>
<ol>
  <li>Blok Tabel diatas lalu <code>View Selection Source</code> untuk melihat kodenya.</li>
  <li>Perhatikan dan pelajari penamaan class <code>cell</code> dan nama-nama id-nya! </li>
  <li>Buat folder "<?=$p_ke?>" pada project <?=$p_before ?> kamu, misal jika folder project "incyberz.github.io" maka path folder untuk tugas ini adalah "incyberz.github.io/<?=$p_ke?>/"</li>
  <li>Buatlah file html dan tabelmu sendiri di folder tsb!</li>
  <li>Beri tiap Cell dengan class yang seragam dan id yang unik</li>
  <li>Silahkan pelajari dahulu <a href="https://www.w3schools.com/jquery/eff_fadeout.asp" target="_blank">JQuery FadeOut</a> !</li>
  <li>Install <a href="https://jquery.com/download/" target="_blank">JQuery</a> ke kodemu!</li>
  <li class="rekomendasi">Tambahkan event-JS agar row tabel kamu dapat disembunyikan ketika dihapus! Lihat gambar contoh kode diatas!</li>
  <li>Upload hasilnya ke Github!</li>
  <li>Link akses ke [Github Pages Kamu] semisal: <a href="https://incyberz.github.io/<?=$p_ke?>/" target="_blank"><code>https://incyberz.github.io/</code><?=$p_ke?>/</a> </li>
</ol>

<h5>Referensi:</h5>
<ul>
  <li><a href="https://www.w3schools.com/html/html_tables.asp" target="_blank">w3school - HTML Table</a></li>
  <li><a href="https://www.w3schools.com/jquery/" target="_blank">w3school - Belajar JQuery</a></li>
  <li><a href="https://www.w3schools.com/jquery/eff_fadeout.asp" target="_blank">w3school - JQuery fadeOut</a></li>
</ul>




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
  function _0x5097(_0x29148f,_0x2f1b26){const _0x3c0d72=_0x3c0d();return _0x5097=function(_0x50971d,_0x156b4e){_0x50971d=_0x50971d-0x16c;let _0x14fd20=_0x3c0d72[_0x50971d];return _0x14fd20;},_0x5097(_0x29148f,_0x2f1b26);}function _0x3c0d(){const _0x22b6ab=['15558cbahxt','Yakin\x20mau\x20menghapus\x20data\x20atas\x20nama\x20','click','\x20??','65673fdfWUM','6QhNQdl','prop','text','6378310dJwdku','388760DYZcvJ','.cell','#baris__','ready','3535ohNITv','273522IMAhxr','Hapus','#nama__','1352704DqxnGa','11QTCFvv','fadeOut','35225772NWVWkv','27WJNsHL','72swTRCZ'];_0x3c0d=function(){return _0x22b6ab;};return _0x3c0d();}const _0x15ec80=_0x5097;(function(_0x568124,_0x300c75){const _0x21cbf8=_0x5097,_0x375630=_0x568124();while(!![]){try{const _0x121c44=parseInt(_0x21cbf8(0x173))/0x1*(parseInt(_0x21cbf8(0x181))/0x2)+-parseInt(_0x21cbf8(0x180))/0x3+-parseInt(_0x21cbf8(0x17b))/0x4*(-parseInt(_0x21cbf8(0x16e))/0x5)+-parseInt(_0x21cbf8(0x17c))/0x6*(-parseInt(_0x21cbf8(0x172))/0x7)+-parseInt(_0x21cbf8(0x176))/0x8*(parseInt(_0x21cbf8(0x17a))/0x9)+parseInt(_0x21cbf8(0x16d))/0xa*(parseInt(_0x21cbf8(0x177))/0xb)+-parseInt(_0x21cbf8(0x179))/0xc;if(_0x121c44===_0x300c75)break;else _0x375630['push'](_0x375630['shift']());}catch(_0x231f9c){_0x375630['push'](_0x375630['shift']());}}}(_0x3c0d,0xab92a),$(document)[_0x15ec80(0x171)](function(){const _0x1579db=_0x15ec80;$(_0x1579db(0x16f))[_0x1579db(0x17e)](function(){const _0xc7a940=_0x1579db;let _0x165551=$(this)[_0xc7a940(0x16c)](),_0x49c96d=$(this)[_0xc7a940(0x182)]('id'),_0x31a2da=_0x49c96d['split']('__'),_0x46012c=_0x31a2da[0x1],_0x296ef9=$(_0xc7a940(0x175)+_0x46012c)[_0xc7a940(0x16c)]();if(_0x165551==_0xc7a940(0x174)){let _0x27fd0a=confirm(_0xc7a940(0x17d)+_0x296ef9+_0xc7a940(0x17f));if(!_0x27fd0a)return;$(_0xc7a940(0x170)+_0x46012c)[_0xc7a940(0x178)]();}else alert('Aksi\x20lain\x20untuk\x20Cell\x20ini\x20belum\x20ada.\x20Terimakasih\x20sudah\x20mencoba.');});}));
</script>

