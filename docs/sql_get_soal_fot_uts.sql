SELECT 
z.kalimat_soal,
z.jawaban_pg,
z.opsi_pg1,
z.opsi_pg2,
z.opsi_pg3,
z.opsi_pg4,
z.opsi_pg5,
y.nama_subject,

(SELECT count(1) from tb_soal_playedby WHERE id_soal=z.id_soal and dijawab_benar is not null) as play_count,
(SELECT count(1) from tb_soal_playedby WHERE id_soal=z.id_soal and dijawab_benar=1) as jumlah_benar,
(SELECT count(1) from tb_soal_playedby WHERE id_soal=z.id_soal and dijawab_benar=0) as jumlah_salah,
(SELECT count(1) from tb_soal_playedby WHERE id_soal=z.id_soal and dijawab_benar is null) as jumlah_timed_out,
(SELECT count(1) from tb_soal_rejectby WHERE id_soal=z.id_soal) as jumlah_reject 



FROM tb_soal z 
JOIN tb_room_subject y on z.id_room_subject=y.id_room_subject 

WHERE z.status_soal != -1 
AND z.visibility_soal = 1


ORDER by play_count DESC 

LIMIT 100