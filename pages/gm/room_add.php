<?php
$nama_room = ''; if(isset($_POST['nama_room'])) $nama_room = $_POST['nama_room'];
$singkatan_room = ''; if(isset($_POST['singkatan_room'])) $singkatan_room = $_POST['singkatan_room'];
$room_desc = ''; if(isset($_POST['room_desc'])) $room_desc = $_POST['room_desc'];
$date_start = date('Y-m-d'); if(isset($_POST['date_start'])) $date_start = $_POST['date_start'];
$date_end = "NULL"; if(isset($_POST['date_end'])) $date_end = $_POST['date_end'];

if($date_end==0 or $date_end=="") {$date_end = "NULL";}else{
	$date_end = "'$date_end'";
}


$hideit_blok_form_tambah_room = '';
$hideit_blok_form_process = "hideit";
$pesan = "Buat Room Baru gagal.";
$pesan_style = "danger";


if(isset($_POST['btn_simpan_room'])){
	$hideit_blok_form_tambah_room = "hideit";
	$hideit_blok_form_process = '';

	$room_creator = $_POST['room_creator']; 


	# ===============================================
	# GET AUTO-INCREMENT ID-ROOM
	# ===============================================
	$s = "SELECT MAX(id_room)+1 as id_room_new FROM tb_room";
	$q = mysqli_query($cn,$s) or die("Error @tambah_room. Tidak dapat mendapatkan auto-id_room");
	$d = mysqli_fetch_assoc($q);
	$id_room_new = $d['id_room_new'];


	# ===============================================
	# INSERT NEW ROOM
	# ===============================================
	$s = "INSERT into tb_room (
	id_room,room_creator,nama_room,singkatan_room,room_desc,date_start,date_end
	) values (
	'$id_room_new','$room_creator','$nama_room','$singkatan_room','$room_desc','$date_start',$date_end
	)";

	$q = mysqli_query($cn,$s) or die("Error @tambah_room baru. $s .".mysqli_error($cn));


	# ===============================================
	# AUTO-INSERT ROOM SUBJECTS
	# ===============================================
	$nama_subject = "Materi Umum $nama_room";
	$s = "INSERT into tb_room_subject (id_room, nama_subject) values ('$id_room_new','$nama_subject')";
	$q = mysqli_query($cn,$s) or die("Error @tambah_room. Tidak bisa menambahkan subjek room. ".mysqli_error($cn));


	# ===============================================
	# AUTO-ASSIGN ROOM PLAYERS
	# ===============================================
	$id_room_players = $id_room_new."_$cnickname";
	$s = "INSERT into 
	tb_room_player (id_room_players,nickname,id_room,inserted_by) 
	values ('$id_room_players','$cnickname','$id_room_new','$cnickname')";
	$q = mysqli_query($cn,$s) or die("Error @tambah_room. Tidak bisa assign player ke room_players. $s. ".mysqli_error($cn));



	# ===============================================
	# SET SESSION ID-ROOM
	# ===============================================
	$_SESSION['id_room'] = $id_room_new;

	$pesan = "Buat Room Baru berhasil";
	$pesan_style = "success";

}
?>

<section id="tambah_room" class="gm">
	<div class="container">

		<h3>Tambah Room</h3>

		<div class="row <?=$hideit_blok_form_process?>" id="blok_form_process">
		  <div class="col-lg-6">
		  	<div class="alert alert-<?=$pesan_style?>">
		  		<?=$pesan?>
		  		<hr>
		  		<a href="?" class="btn btn-primary btn-sm">Go to Dashboard</a>
		  	</div>
		  	
		  </div>
		</div>

		<div class="row <?=$hideit_blok_form_tambah_room?>" id="blok_form_tambah_room">
		  <div class="col-lg-6">
		    <form method="post" action="?addroom">

		    	<input type="hidden" name="room_creator" id="room_creator" value="<?=$cnickname?>">

		      <div class="form-group">
		        <label>Nama Room</label>
		        <input type="text" class="form-control" name="nama_room" value="<?=$nama_room?>" required maxlength="50">
		        <small>Contoh: MK Web Dasar TI-2021</small>
		      </div>

		      <div class="form-group">
		        <label>Singkatan Room</label>
		        <input type="text" class="form-control" name="singkatan_room" value="<?=$singkatan_room?>" required maxlength="7">
		        <small>Contoh: WebDas, APSI, Grafkom, PTI2021</small>
		      </div>

		      <div class="form-group">
		        <label>Deskripsi Room</label>
		        <textarea class="form-control" rows="5" name="room_desc" id="room_desc" required><?=$room_desc?></textarea>
		      </div>

		      <div class="form-group">
		        <label>Berlaku Tanggal ... s.d ...</label>
		        <div class="row">
		        	<div class="col-lg-6">
		        		<input type="date" class="form-control" name="date_start" required style="margin-bottom: 8px" value="<?=$date_start?>">
		        	</div>
		        	<div class="col-lg-6">
		        		<input type="date" class="form-control" name="date_end" value="<?=$date_end?>">
		        	</div>
		        </div>
		      </div>

		      <div class="form-group">
		        <button class="btn btn-primary btn-block" name="btn_simpan_room" id="btn_simpan_room">Simpan Room</button>

		      </div>

		    </form>

		    <?php if($cid_room==0) echo "<a href='?' class='btn btn-secondary btn-block'>Pilih Room</a>"; ?>


		  </div>

		</div>

	</div>
</section>