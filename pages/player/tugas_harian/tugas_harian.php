<section id="tugas_harian" class="player">
  <div class="container">

    <?=$proto?>

    <h3>Upload Tugas Harian</h3>
    <p>Berikut adalah daftar tugas harian yang kamu upload.</p>

    <div style="border:solid 1px #aaa; border-radius: 10px; padding: 10px; margin-bottom:10px; text-align: center; background:linear-gradient(#5a5,#333);"> 
      Saat ini sudah masuk:<br>
      <span style="font-size:16pt">Pertemuan ke-1: <span id="nama_subject_skg">?</span></span>
      
    </div>

    <div style="border:solid 1px #aaa; border-radius: 10px; padding: 15px;">
      <p class="text-center">
        Halo Iin Sholihin! Tugas Harian kamu:<br>
        <span style="font-size:60px">100%</span><br>
        <span id="count_tugas_harian_player">1</span>
        of 
        <span id="count_tugas_harian_skg">1</span> tugas_harian<br>
        <span class='badge badge-success' style='font-size:20px;margin-top: 10px;'>Kamu boleh mengikuti UTS</span>      </p>
      </div>

      <span style="cursor: pointer;font-size: 10pt; margin: 10px 0;" class="badge badge-info" id="toggle_syarat_isi">Show Rules!</span>
      <?php include 'tugas_harian_rules.php'; ?>
      <style type="text/css">
      .tbjudul, .tbrow{font-size: ;border: solid 1px #aaa;padding: 15px;}
      .tbjudul{color: white; background-color: #d77; text-align: center;}

      .judul_sesi{
        margin-bottom:10px; 
        font-size:12pt;
        color: #ff7;
      }

      .blok_tugas_harian, .blok_tugas_challenge{
        border: solid 1px #ccc;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        height: 100%;
      }

      .blok_tugas_harian{
        background: linear-gradient(#000055bb, #550055bb);
      }

      .blok_tugas_challenge{
        background: linear-gradient(#770000bb, #770055bb);
      }

      .scr_tugas{
        width: 150px;
        height: 100px;
      }

      .point_list{
        margin: 0 0 15px 0;
        font-family: 'century gothic';
        font-size: 20px;
        color: orange;
      }

      .nama_tugas{
        font-family: 'verdana';
        color: yellow;
        margin: 10px 0;
      }

      .judul_sesi{
        font-size: 30px;
        margin: 10px 0;
      }

      .blok_judul_sesi{
        margin: 10px 0;
      }

      .blok_sekarang{
        border: solid 7px yellow;
        background: #00ff0044;
      }

      .tbrow{
        margin: 15px 0;
      }

      .blok_tugas{
        border-top: solid 1px #aaa;
        margin-top: 25px;
      }
    </style>


    
    <div class='tbrow blok_sekarang' id='rows_tugas_harian__1'>
      
      <div class="blok_judul_sesi">
        <span id='is_sekarang__1' class='badge badge-warning' style="font-size:16px">Sesi Sekarang</span>
        <h6 class="judul_sesi">P01 Pengantar Teknologi Web</h6>
        
        <span class='badge badge-success' style="font-size:16px">Completed</span> 
        <small><i>at 2022-08-31 10:39:50</i></small>
      </div>

      <div class='row'>

        <div class='col-lg-6'>
          <div class="blok_tugas_harian">
            <div class="point_list">Tugas Harian:</div>
            <div class="blok_tugas">
              <div class="nama_tugas">Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
              <span class='badge badge-success'>Uploaded</span>
              <small><i>at 2022-08-31 10:39:50</i></small>
            </div>
            


            <div class="blok_tugas">
              <div class="nama_tugas">Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
              <span class='badge badge-success'>Uploaded</span>
              <small><i>at 2022-08-31 10:39:50</i></small>
            </div>

          </div>

        </div>


        <div class='col-lg-6'>
          <div class="blok_tugas_challenge">
            <div class="point_list">Challenges</div>

            <div class="blok_tugas">
              <div class="nama_tugas">CSS Hello World HTML</div>
              <div class="blok_perintah_tugas">
                Buatlah Lorem ipsum reprehenderit non aliqua nisi consequat et in laboris minim deserunt sed ut culpa cupidatat dolore minim culpa in magna. Veniam pariatur fugiat velit elit ea ut aliqua excepteur aute magna id anim cupidatat.
              </div>
            </div>

            <div class="blok_tugas">
              <div class="nama_tugas">JS Animated Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
              <span class='badge badge-success'>Uploaded</span>
              <small><i>at 2022-08-31 10:39:50</i></small>

            </div>

            <div class="blok_tugas">
              <div class="nama_tugas">Hello Github Pages</div>
              <div class="blok_perintah_tugas">
                Buatlah Consectetur amet aliquip ad ut tempor excepteur esse adipisicing do ut sint duis enim exercitation id. Dolore occaecat ut dolore magna dolor et nisi sit culpa nulla excepteur dolore ut anim qui.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class='tbrow' id='rows_tugas_harian__2'>
      
      <div class="blok_judul_sesi">
        <h6 class="judul_sesi">P02 Karir Web Development</h6>
        
        <span class='badge badge-danger' style="font-size:16px">Belum Upload</span> 
        <small><i>at 2022-08-31 10:39:50</i></small>
      </div>

      <div class='row'>

        <div class='col-lg-6'>
          <div class="blok_tugas_harian">
            <div class="point_list">Tugas Harian:</div>
            <div class="blok_tugas">
              <div class="nama_tugas">Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
              <span class='badge badge-success'>Uploaded</span>
              <small><i>at 2022-08-31 10:39:50</i></small>
            </div>
            


            <div class="blok_tugas">
              <div class="nama_tugas">Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
            </div>

          </div>

        </div>


        <div class='col-lg-6'>
          <div class="blok_tugas_challenge">
            <div class="point_list">Challenges</div>

            <div class="blok_tugas">
              <div class="nama_tugas">CSS Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
            </div>

            <div class="blok_tugas">
              <div class="nama_tugas">JS Animated Hello World HTML</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
            </div>

            <div class="blok_tugas">
              <div class="nama_tugas">Hello Github Pages</div>
              <div class="blok_scr_tugas">
                <img class="scr_tugas" src="asd">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    
  </div>
</section>