const wrapper = document.querySelectorAll('.speedo');
const my_persen_akurasi = document.getElementById('my_persen_akurasi').innerHTML;

const barCount = parseInt(my_persen_akurasi);
const percent1 = 50 * 90/100;

for (let index = 0; index < barCount; index++) {
    const className = index < percent1 ? 'selected1' : '';
    wrapper[0].innerHTML += `<i style="--i: ${index};" class="${className}"></i>`;
}

wrapper[0].innerHTML += `<p class="selected percent-text text1">${my_persen_akurasi}%</p>`
