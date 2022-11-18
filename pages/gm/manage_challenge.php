<?php
$row = '';
$img_del = '<img class="img_zoom" src="assets/img/icons/delete.png" height=25px />';
$img_pub = '<img class="img_zoom" src="assets/img/icons/publish.png" height=25px />';
$img_manage = '<img class="img_zoom" src="assets/img/icons/edit5.png" height=25px />';
$img_published = '<img class="img_zoom no_editing" src="assets/img/gifs/wifi3.gif" height=25px />';

$s = "SELECT a.*,
(select count(1) from tb_chal_skill_level where id_chal=a.id_chal)as jumlah_skill_level, 
(select nama_subject from tb_room_subject where id_room_subject=a.id_room_subject) as nama_subject 
from tb_chal a 
where a.id_room=$cid_room order by chal_created desc";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $jumlah_skill_level_show = $d['jumlah_skill_level']==0 ? '-' : "$d[jumlah_skill_level]";
    $id_room_subject_show = $d['id_room_subject']=='' ? '-' : "$d[nama_subject]";
    $arr_chal_visibility = array(-1 => 'Inactive',0 => 'Suspended',null => 'Unpublish', 1 => $img_published);
    $arr_bg_visibility = array(-1 => 'ff0000',0 => 'ffff00',null => 'aaff00', 1 => '00ff00');
    $chal_visibility = $d['chal_visibility'];
    $img_pub = $chal_visibility==1 ? $img_manage : $img_pub;
    $row.="
    <tr style='background: #$arr_bg_visibility[$chal_visibility]55'>
        <td>$i</td>
        <td>$d[chal_name]</td>
        <td>$id_room_subject_show  </td>
        <td>$jumlah_skill_level_show  </td>
        <td>$arr_chal_visibility[$chal_visibility]</td>
        <td>
            <a href='?editchal&id_chal=$d[id_chal]' id='btn_edit__$d[id_chal]' class='img_link btn_edit btn_manage'>$img_pub</a> 
            <span id='btn_delete__$d[id_chal]' class='img_link btn_delete btn_manage'>$img_del</span> 
        </td>
    </tr>
    ";
}

?>

<style>.img_link{cursor: pointer;} .no_editing{cursor:not-allowed}</style>
<section id="manage_challenge" class="gm">
	<div class="container">
        <h3>Manage Challenge</h3>
        <p>Berikut adalah beberapa challenge praktikum yang saya buat di Room <?=$nama_room?></p>
        <table class="table">
            <tr>
                <td>No</td>
                <td>Challenge</td>
                <td>Pertemuan</td>
                <td>Skill Levels</td>
                <td>Visibility</td>
                <td>Aksi</td>
            </tr>
            <?=$row?>

        </table>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
        $(".btn_manage").click(function(){
			let id = $(this).prop("id");
			let rid = id.split("__");
			let tipe_btn = rid[0];
			let id_chal = rid[1];

			if(tipe_btn=="btn_delete"){
				let x = confirm("Yakin untuk delete challenge ini?\n\nPerhatian! Challenge tidak bisa dihapus jika sudah ada yang mengerjakan (submit bukti challenge)."); if(!x) return;

    			let link_ajax = "ajax/ajax_delete_challenge.php"
	    		+"?id_chal="+id_chal
		    	+'';

                alert(link_ajax);

    			$.ajax({
	    			url:link_ajax,
		    		success:function(a){
			    		let ra = a.split("__");
				    	if(ra[0]=='sukses'){
                            //zzz
		    			}else{
				    		alert(a)
					    }
	    			}
		    	})
			}



		})
    })

	$(document).on("click",".btn_aksi",function(){
		
        
	})

</script>