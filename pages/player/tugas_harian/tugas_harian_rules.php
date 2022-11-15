<script type="text/javascript">
  $(document).ready(function(){
    $("#toggle_syarat_isi").click(function(){
      var text = $(this).text();
      if(text=="Show Rules!"){
        $(this).text("Hide Rules");
        $("#syarat_isi").fadeIn();
      }else{
        $(this).text("Show Rules!");
        $("#syarat_isi").fadeOut();
      }
    })
  })
</script>
<div id="syarat_isi" class="hideit">
  <p>Persyaratan Presensi:</p>
  <ol style="padding: 0 0 0 15px;" >
    <li>Membuat minimal 3 soal pada tiap Room Subjects</li>
    <li>Saat mengisi harus sudah melewati Tanggal Pembukaan</li>
    <li>Saat mengisi jangan sampai melewati Tanggal Penutupan</li>
    <li>Kelengkapan Presensi dari GM terpenuhi</li>
    <li>Mengisi Polling dan Feedback</li>
  </ol>
  <br>
  <label>Rules Presensi:</label>
  <ul style="padding: 0 0 0 15px;">
    <li><b>Jadwal Kuliah</b> ditentukan oleh GM</li>
    <li><b>Tanggal Pembukaan</b> pada hari Ahad pada weekend jadwal kuliah</li>
    <li><b>Tanggal Penutupan</b> pada hari Sabtu pada weekend jadwal kuliah</li>
    <li>Point Presensi = 1000 LP per claim + 500 LP bonus ontime</li>
    <li>Bonus Ontime: absen diawal weekend hingga hari-H tanggal perkuliahan</li>
    <li>No Bonus: absen 1 hari setelah hari-H hingga weekend berakhir (hari sabtu)</li>
    <li>Telat Absen: absen di weekend berikutnya, poin presensi dikurangi 5 s.d 90%, dg pengurangan poin presensi sebesar 5% per hari</li>
    <li>Misal: hari-H (jadwal kuliah) adalah hari Rabu, tgl 8 sep, maka:
      <ul>
        <li>absen ontime dari ahad, 5 sep s.d 8 sep</li>
        <li>absen regular dari kamis, 9 sep s.d sabtu, 11 sep</li>
        <li>absen telat dari ahad, 12 sep, dst</li>
      </ul>

    </li>
  </ul>
</div>