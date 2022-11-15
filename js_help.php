<script type="text/javascript">
  $(document).on("click",".help",function(){
    let val = $(this).text();
    let tid = $(this).prop("id");
    let rid = tid.split("__");
    let id = rid[0]==''?'ini':rid[0];
    let m = `Maaf, help untuk id ${id} belum ada. \n\nSilahkan tanyakan langsung ke QWars Programmer: Iin Sholihin, M.Kom\n\nTerimakasih.`;

    switch(id){
      case 'nama_subject': m = "Room Subject adalah Pembagian Materi Perkuliahan (dari P1 s.d P16)\n\nmisal: P1 HTML Dasar."; break;
      case 'no_subjects': m = "Prioritas Room Subjects atau Pertemuan ke- diisi oleh angka."; break;
      case 'date_jadwal': m = "Data ini digunakan pada Fitur Presensi Online. \n\nPlayer tidak bisa mengisi Presensi jika Anda belum menentukan Jadwal Perkuliahan."; break;
      case 'date_open': m = "Data ini digunakan pada Fitur Presensi Online. \n\nPlayer tidak bisa mengisi Presensi jika tanggal sekarang sebelum Tanggal Pembukaan. Jika dikosongkan maka tidak ada aturan dalam batasan tanggal pembukaan mengisi presensi."; break;
      case 'date_close': m = "Data ini digunakan pada Fitur Presensi Online. \n\nPlayer tidak bisa mengisi Presensi jika tanggal sekarang sudah melewati Tanggal Penutupan Presensi. Jika dikosongkan maka Player dapat mengisi selamanya setelah Tanggal Pembukaan."; break;
      case 'aksi': m = "Aksi yang tersedia adalah aksi DELETE.\n\nJika tidak bisa didelete, artinya pada Room Subjects tersebut sudah ada soal yang dibuat oleh Anda (GM) atau oleh para Player Anda yang ada di Room ini."; break;
      case 'info_soal': m = "S/B = Jumlah penjawab dengan hasil menjawab SALAH atau BENAR. \n\nJika jumlah penjawab sudah 20 players atau sudah 30% dari total Players-in-room maka soal tersebut otomatis terverifikasi.\n\n\nRatio menunjukan tingkat kesulitan soal. Ratio dihitung berdasarkan pada jumlah penjawab benar dan penjawab salah. \n\n~~ Ratio < 0,5 :: Soal Mudah\n~~ 0,5 >= Ratio <= 1,5 :: Soal Sedang\n~~ 1,5 > Ratio <= 3 :: Soal Sulit\n~~ Ratio > 3 :: Soal Menjebak\n\n\nEP = Earned Point = Poin yang dihasilkan saat soal itu dibuat dan saat soal itu dijawab.\n\n\nRej = REJECT = Jumlah Players yang mereject soal tersebut."; break;


      case 'tingkat_kesulitan_soal': m = 'Tingkat kesulitan soal diukur dari jumlah penjawab salah dibagi dengan jumlah penjawab benar (rasio = salah/benar), untuk yang timed-out tidak diperhitungkan.';break;
      case 'jumlah_play_benar': m = `Sudah ada yang menjawab benar untuk soal ini sebanyak ${val} players`;break;
      case 'jumlah_play_salah': m = `Sudah ada yang menjawab salah untuk soal ini sebanyak ${val} players`;break;
      case 'jumlah_play_timed_out': m = `Ada yang kehabisan waktu dalam menjawab soal ini sebanyak ${val} players`;break;
      case 'jumlah_reject': m = `Ada yang menganggap soal kamu tidak layak sebanyak ${val} players. Lihat saja alasan mereka! \n\nPerhatian! Jika ada 5 orang yang menganggap soal kamu tidak layak maka sistem akan mem-banned otomatis soal ini.`;break;
      default: m = ''; //zzz skipped
    }
    if(m!='') alert(m);
  })

</script>