SELECT 
a.nickname,a.nama_player, b.kelas,
(SELECT COUNT(1) FROM tb_daily_login p JOIN tb_login q ON p.id_login=q.id_login WHERE q.nickname=a.nickname) as daily_login 

from tb_player a 
JOIN tb_kelas_det b on a.nickname=b.nickname 
JOIN tb_room_kelas c on b.kelas=c.kelas 


WHERE c.id_room=26 

ORDER BY b.kelas, a.nama_player