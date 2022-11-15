<?php 
$id_room_subject_selected = isset($_GET['id_room_subject_selected']) ? $_GET['id_room_subject_selected'] : '';
$get_keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$get_status_soal = isset($_GET['status_soal']) ? $_GET['status_soal'] : '';
$get_visibility_soal = isset($_GET['visibility_soal']) ? $_GET['visibility_soal'] : '';


$zid_room_subjects = '';
$zsesi_mks = '';
if($cid_room>0){
  $s = "SELECT 
  a.id_room_subject, 
  a.nama_subject 
  
  FROM tb_room_subject a 
  WHERE a.id_room=$cid_room 
  AND a.nama_subject NOT LIKE '%materi_umum%'  
  ";
  // die($s);
  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

  while ($d=mysqli_fetch_assoc($q)) {
    $zid_room_subjects .= $d['id_room_subject'].'__';
    $zsesi_mks .= $d['nama_subject'].'__';
  }
}

$rsesi_mks = explode('__', $zsesi_mks);
$rid_room_subjects = explode('__', $zid_room_subjects);


?>

<style>
	#blok_filter_soal { font-size: small; margin-top: 10px;}
</style>

<!-- ======================================= -->
<!-- FILTER SOAL -->
<!-- ======================================= -->
<div id="blok_filter_soal">
	<div class="row">
		<div class="col-lg-6">
			<div>Filter <input class="debug" id="keyword2"></div>
			<input class="form-control input-sm" id="keyword" value="<?=$get_keyword ?>">
		</div>
		<div class="col-lg-6">
			<div>Sesi MK: <input class="debug" id="id_room_subject_selected" value="<?=$id_room_subject_selected ?>"></div> 
			<select class="form-control input-sm" id="filter__id_room_subject">
				<option value="all">--All--</option>
				<?php 
				for ($i=0; $i < (count($rsesi_mks)-1) ; $i++){
					echo "<option value='$rid_room_subjects[$i]'>$rsesi_mks[$i]</option>";
				} ?>
			</select>
		</div>
		<div class="col-lg-4">
			<div>Status: <input class="debug" id="get_status_soal" value="<?=$get_status_soal ?>"></div> 
			<select class="form-control input-sm filter" id="filter__status_soal">
				<option value="all">--All--</option>
				<option value="-1">Banned</option>
				<option value="0">Unverified</option>
				<option value="1">Verified</option>
				<option value="2">Decided</option>
				<option value="3">Promoted</option>
				<option value="4">Crowned</option>
			</select>
		</div>
		<div class="col-lg-4">
			<div>Visibility: <input class="debug" id="get_visibility_soal" value="<?=$get_visibility_soal ?>"></div> 
			<select class="form-control input-sm filter" id="filter__visibility_soal">
				<option value="all">--All--</option>
				<option value="-1">Suspend</option>
				<option value="0">New Soal</option>
				<option value="1">Publish</option>
			</select>
		</div>
		<div class="col-lg-4">
			<div>Tambah Soal:</div>
			<button class="btn btn-success btn-block btn_add_soal">Add Soal</button>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
		if($('#id_room_subject_selected').val()!=''){
			$('#filter__id_room_subject').val($('#id_room_subject_selected').val()).change();
		}
		if($('#get_status_soal').val()!=''){
			$('#filter__status_soal').val($('#get_status_soal').val()).change();
		}
		if($('#get_visibility_soal').val()!=''){
			$('#filter__visibility_soal').val($('#get_visibility_soal').val()).change();
		}
	})
</script>