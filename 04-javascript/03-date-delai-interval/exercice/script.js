const hr = document.querySelector('.hr');
const min = document.querySelector('.min');
const sec = document.querySelector('.sec');

function horloge()
{
    let date = new Date();
    const h = date.getHours();
    const m = date.getMinutes();
    const s = date.getSeconds();
    hr.style.transform = `rotate(${(h*30+0.5*m)}deg)`;
    min.style.transform = `rotate(${(m*6+0.1*s)}deg)`;
    sec.style.transform = `rotate(${(s*6)}deg)`;

}
setInterval(horloge, 1000);
