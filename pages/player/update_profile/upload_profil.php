<section id="ubah_pass" class="player">
  <div class="container">

  	<?php 
  	if(isset($_POST['btn_upload_profil'])){

  		if(!file_exists($path_folder)) mkdir($path_folder);

  		if(file_exists($path_profile)){
  			rename($path_profile, $path_profile."_".date("YmdHis").".jpg");
  		}

  		$tmp_name = $_FILES['input_profil']['tmp_name'];

  		if(move_uploaded_file($tmp_name, $path_profile)){

        echo "<div class='alert alert-success'>
          Upload berhasil.
          <hr>
          <a href='index.php'>Home</a> 
        </div>";
        exit;

  		}else{
        echo "<div class='alert alert-danger'>
          Sepertinya kesalahan teknis pada pemindahan file upload.
          <hr>
          <a href='?ubah_profil'>Coba Lagi</a> 
        </div>";
        exit;
      }

  	}



  	?>
  	<div class="alert alert-success">Silahkan upload dahulu foto profil! 
      <div>
        <small>
          
          <ul>
            <li>Foto profil kamu <span style="color:darkred;">bersifat private</span> (tidak diperlihatkan ke player lain, kecuali sudah berteman)</li>
            <li>Gunakan gambar JPG berukuran antara 20 s.d 200kb, terlihat wajah, boleh formal, boleh pose bebas!</li>
            <li>Gunakan tools 
            <a href="https://imagecompressor.11zon.com/en/image-compressor/compress-jpeg-to-200kb.php" target="_blank" style="color:darkblue;">Online Foto Resizer</a> untuk memperkecil foto kamu ke 200kb.</li>
          </ul>



        </small>
      </div>
    </div>

  	<form method="post" enctype="multipart/form-data">
  		<div class="form-group" id="blok_upload_profil">
  			<div class="blok_inpu_profil">
  				<input type="file" name="input_profil" id="input_profil" accept="image/jpg, image/jpeg">
          <script type="text/javascript">
            let f = document.getElementById("input_profil");
            f.onchange = function() {
              if(this.files[0].size < 20000 ){
                alert("Ukuran Gambar terlalu kecil. Silahkan Anda cari ukuran 20 s.d 200kb.");
                this.value = '';
              }
              if(this.files[0].size > 206000){
                alert("Ukuran Gambar terlalu besar. Silahkan Anda cari ukuran 20 s.d 200kb.");
                this.value = '';
              }
            };
          </script>
  			</div>
  			<div>
  				<button class="btn btn-primary btn-block" name="btn_upload_profil">Upload</button>
  			</div>
  			<div>
  				<span><small id="lihat_contoh">Lihat Contoh</small></span>
  				<div id="blok_contoh_profil">
  					<div><img src="assets/img/profiles/example1.jpg" class="foto_profil"></div>
  					<div><img src="assets/img/profiles/example2.jpg" class="foto_profil"></div>
  					<div><img src="assets/img/profiles/example3.jpg" class="foto_profil"></div>
  					<div><img src="assets/img/profiles/example4.jpg" class="foto_profil"></div>
  				</div>
  			</div>
  			
  		</div>
  	</form>

  	<div style="height:200px">&nbsp;</div>
  	<script type="text/javascript">
  		$(document).ready(function(){
  			$("#lihat_contoh").click(function(){
  				$("#blok_contoh_profil").slideToggle();
  			});

  			// $("#lihat_contoh").click();
  		})
  	</script>

  </div>
</section>
