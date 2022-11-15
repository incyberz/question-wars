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
.tabelku .judul_tabel { font-weight: bold; background: linear-gradient(#ffffaa,#aaffff);}
.tabelku tr { border-top: solid 1px #ccc; }
.tabelku td { padding: 5px; cursor: pointer; transition: .2s; }
.tabelku td:hover { background: linear-gradient(#eee,#ccffff); letter-spacing: 1px; }
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
<img src="chal_p05_jquery_when_delete_hide_rows_kode.jpg">



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
  $(document).ready(function(){
    $('.cell').click(function(){
      let isi = $(this).text();
      let tid = $(this).prop('id');
      let rid = tid.split('__');
      let id_baris = rid[1];
      let nama_mhs = $('#nama__'+id_baris).text();

      if(isi=='Hapus'){
        let yakin = confirm(`Yakin mau menghapus data atas nama ${nama_mhs} ??`);
        if(!yakin) return;

        $('#baris__'+id_baris).fadeOut();

      }else{
        alert('Aksi lain untuk Cell ini belum ada. Terimakasih sudah mencoba.')
      }
    })
  })
</script>

