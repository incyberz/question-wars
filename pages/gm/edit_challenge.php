<?php
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die('Index id_chal belum terdefinisi.');

$row = '';
$bm = '<b style=color:red>*</b>';
$btn_publish = '';

$s = "SELECT * from tb_chal where id_chal=$id_chal";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Data challenge tidak ditemukan. id_chal:$id_chal");
}
$dt = mysqli_fetch_array($q);



$s = "SELECT id_room_subject, nama_subject from tb_room_subject where id_room=$cid_room and nama_subject not like 'materi umum%' order by no_subject";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$ket_pertemuan = '';
while ($d=mysqli_fetch_assoc($q)) {
    $ket_pertemuan .= "<div>$d[id_room_subject] ~ $d[nama_subject]</div>";
}
$ket['id_room_subject'] = "<small>$ket_pertemuan</small>";



$s = "SELECT chal_level, rank_level from tb_chal_level order by rank_level";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$ket_chal_level = '';
while ($d=mysqli_fetch_assoc($q)) {
    $ket_chal_level .= "<div>$d[chal_level]</div>";
}
$ket['chal_level'] = "$ket_chal_level";



$s = "SELECT sifat_chal from tb_chal_sifat";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$ket_sifat_chal = '';
while ($d=mysqli_fetch_assoc($q)) {
    $ket_sifat_chal .= "<div>$d[sifat_chal]</div>";
}
$ket['sifat_chal'] = "$ket_sifat_chal(boleh kosong, artinya challenge bersifat opsional)";


if ($dt['chal_visibility']==1) {
    $btn_publish = "<a href='?publishchal&id_chal=$id_chal&publish=0' class='link_btn btn btn-warning btn-sm mr-1'>Suspend</a>";
    $btn_publish .= "<a href='?publishchal&id_chal=$id_chal&publish=-1' class='link_btn btn btn-danger btn-sm'>Hide</a>";
} else {
    $btn_publish = "<a href='?publishchal&id_chal=$id_chal&publish=1' class='link_btn btn btn-primary btn-sm'>Publish Challenge</a>";
}
$ket['chal_visibility'] = "<div>$btn_publish</div><small>1: Published <br>0: Suspended <br>-1: Hide <br>null: Unpublished</small>";


$ket['input_harus_mengandung'] = 'Link input wajib mengandung salah satu keyword. Pisahkan dengan double-titik-koma jika lebih dari 1 keyword';
$ket['input_tidak_mengandung'] = 'Link input tidak boleh mengandung salah satu keyword. Pisahkan dengan double-titik-koma jika lebih dari 1 keyword';
$ket['tanggal_penutupan'] = 'Player tidak bisa submit challenge saat melebihi tanggal penutupan. <small><div>Format: YYYY-MM-DD HH:NN:SS</div><div>Contoh: 2022-10-15 08:30:00</div></small>';
$ket['chal_visibility'] = '1: diperlihatkan; <br>0: disembunyikan';
$ket['chal_desc'] = "<a href='?editdeschal&id_chal=$id_chal' class='link_btn btn btn-success btn-sm'>Ubah Deskripsi</a>";
$ket['batas_ontime'] = "Player mendapatkan speed-point-max jika tidak melebihi batas ontime.<br>Contoh: 2022-11-15 18:30:00";




$s = "DESCRIBE tb_chal";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

$kolom_fix = ['id_room','chal_creator','chal_created','chal_desc','chal_visibility'];
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $j=$i-1;
    $field = $d['Field'];
    $editable = $d['Key']!='PRI' ? 'editable' : '';
    $editable = in_array($d['Field'], $kolom_fix) ? '' : $editable;
    $available_values = $editable=='' ? '-' : '<i>editable</i>';
    $available_values = $d['Null']=='YES' ? "$available_values<div><i>(boleh kosong)</i></div>" : $available_values;



    $available_values = isset($ket[$field]) ? $ket[$field] : $available_values;
    $field_show = $d['Null']=='NO' ? "$field $bm" : $field;
    $img_check = "<img src='assets/img/icons/check_green.png' height=25px class='img_check hideit' id='img_check__$d[Field]'/>";

    $row .= "
        <tr>
            <td>$i</td>
            <td><b>$field_show</b> $img_check<br><i><small>$d[Type]</small></i></td>
            <td class=$editable id=$d[Field]__$dt[id_chal]>$dt[$j]</td>
            <td>$available_values</td>
        </tr>
    ";
}



?>

<style>th{color:yellow} #edit_challenge .link_btn{color:white !important}</style>
<section id="edit_challenge" class="gm">
	<div class="container">
        <h3>Edit Challenge</h3>
        <p><?=$link_back?> | Halo GM! Silahkan Anda edit challenge Anda pada kolom yang berlatar hijau!</p>
        <p class="text-right"><a href="?manageskilllevel&id_chal=<?=$id_chal?>" class='link_btn btn btn-success btn-sm'>Manage Skill Level</a></p>
        <table class="table">
            <thead>
                <th>No</th>
                <th>Field</th>
                <th>Input Value</th>
                <th>Available Values</th>
            </thead>
            <?=$row?>

        </table>
    </div>
</section>

<script>
    $(function(){
        $(".editable").click(function(){
            $('.img_check').hide();
            let tid = $(this).prop("id");
            let rid = tid.split("__");
            let field = rid[0];
            let id_chal = rid[1];
            let isi = $(this).text().trim();

            let isi_baru = prompt('Isi baru:',isi).trim();
            if(!isi_baru || isi_baru=='' || isi_baru==isi){
                return;
            }

            let link_ajax = `ajax/ajax_edit_challenge.php?field=${field}&isi=${isi_baru}&id_chal=${id_chal}`;
            $.ajax({
                url:link_ajax,
                success:function(a){
                    a=a.trim();
                    if(a=='sukses'){
                        $("#"+tid).text(isi_baru);
                        $("#img_check__"+field).fadeIn();
                    }else if(a=='1452'){
                        alert('Silahkan masukan input sesuai pilihan (available values)')
                    }else{
                        alert('AJAX error kode: '+a)
                    }
                }
            })
        })
    })
</script>