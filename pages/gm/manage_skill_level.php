<?php
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die('Index id_chal belum terdefinisi.');
// $id_chal = 47; //zzz
$row = '';
$bm = '<b style=color:red>*</b>';
$btn_publish = '';

$s = "SELECT * from tb_chal where id_chal=$id_chal";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Data challenge tidak ditemukan. id_chal:$id_chal");
}
$dt = mysqli_fetch_array($q);


$s = "SELECT * from tb_chal_skill_level where id_chal=$id_chal order by poin_skill_level";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $row .= "
        <tr id=row__$d[id_skill_level]>
            <td>$i</td>
            <td class=editable id=nama_skill_level__$d[id_skill_level]>$d[nama_skill_level]</td>
            <td class=editable id=poin_skill_level__$d[id_skill_level]>$d[poin_skill_level]</td>
            <td class=editable id=syarat_skill_level__$d[id_skill_level]>$d[syarat_skill_level]</td>
            <td><button class='btn btn_manage btn-danger btn-sm' id=btn_delete__$d[id_skill_level]__$id_chal>Del</button></td>
        </tr>
    ";
}
if ($row=='') {
    $row = "<tr><td style='background:#ff000033' colspan=5>No Data. Silahkan tambahkan Skill Level!</td></tr>";
}


?>

<style>th{color:yellow} #edit_challenge .link_btn{color:white !important} code{font-size:100%}</style>
<section id="edit_challenge" class="gm">
	<div class="container">
        <h3>Manage Skill Level</h3>
        <p>Challenge: <code><?=$dt['chal_name']?></code></p>
        <p><?=$link_back?> | Halo GM! Silahkan Anda tentukan berapa banyak Skill Level untuk Challenge ini!</p>
        <table class="table">
            <thead>
                <th>No</th>
                <th>Skill Level</th>
                <th>Point</th>
                <th>Syarat</th>
                <th>Aksi</th>
            </thead>
            <?=$row?>

        </table>
        <button class="btn btn-primary btn_manage" id="btn_tambah__new_id__<?=$id_chal?>">Tambah Skill Level</button>
    </div>
</section>

<script>
    $(function(){
        $(".editable").click(function(){
            let tid = $(this).prop("id");
            let rid = tid.split("__");
            let field = rid[0];
            let id_skill_level = rid[1];
            let isi = $(this).text().trim();

            let isi_baru = prompt('Isi baru:',isi).trim();
            if(!isi_baru || isi_baru=='' || isi_baru==isi){
                return;
            }

            let link_ajax = `ajax/ajax_edit_skill_level.php?field=${field}&isi=${isi_baru}&id_skill_level=${id_skill_level}`;
            $.ajax({
                url:link_ajax,
                success:function(a){
                    a=a.trim();
                    if(a=='sukses'){
                        $("#"+tid).text(isi_baru);
                    }else{
                        alert('AJAX error: '+a)
                    }
                }
            })
        })

        $(".btn_manage").click(function(){
            let tid = $(this).prop("id");
            let rid = tid.split("__");
            let tipe_btn = rid[0];
            let id_skill_level = rid[1];
            let id_chal = rid[2];

            if(tipe_btn=='btn_delete'){
                let yakin = confirm('Yakin mau hapus Skill Level ini?');
                if(!yakin) return;
            }else if(tipe_btn=='btn_tambah'){
                let yakin = confirm('Tambah Skill Level baru?');
                if(!yakin) return;
            }else{
                alert(`other tipe_btn: ${tipe_btn} undefined, tell it to programmer`);
                return;
            }
            
            let link_ajax = `ajax/ajax_manage_skill_level.php?tipe_btn=${tipe_btn}&id_skill_level=${id_skill_level}&id_chal=${id_chal}`;

            
            $.ajax({
                url:link_ajax,
                success:function(a){
                    a=a.trim();
                    if(a=='sukses'){
                        if(tipe_btn=='btn_delete'){
                            $("#row__"+id_skill_level).fadeOut();
                        }else if(tipe_btn=='btn_tambah'){
                            location.reload()
                        }else{
                            alert('AJAX Success without handler, tell it to programmer!')
                        }
                    }else{
                        alert('AJAX error: '+a)
                    }
                }
            })
        })    
    })
</script>