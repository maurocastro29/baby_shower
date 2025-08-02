const getRemainTime = deadline =>{
    let now = new Date(),
    remainTime = (new Date(deadline) - now + 1000)/1000,
    remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
    remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2),
    remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
    remainDdays = Math.floor(remainTime / (3600 * 24));

    return {
        remainTime,
        remainSeconds,
        remainMinutes,
        remainHours,
        remainDdays
    }
}

const countdown = (deadline, elem, finalMessage) => {
    const el = document.getElementById(elem);
    const timerUpdate = setInterval( () => {
        let t = getRemainTime(deadline);
        console.log(t.remainDdays)
        el.innerHTML = `Falta: ${t.remainDdays}d: ${t.remainHours}h: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        if(t.remainTime <= 1){
            clearInterval(timerUpdate);
            el.innerHTML = finalMessage;
        }
    }, 1000)
};

countdown('Jun 04 2023 16:30:00 GMT-0500', 'clock', 'Bienvenidos a mi babyshower');

console.log(getRemainTime('Jun 04 2023 16:30:00 GMT-0500'));


let inputP = document.getElementById('inputPassword');

let verP = document.getElementById('verPassw');

verP.addEventListener("click", function(){
    if(inputP.type == "password"){
        inputP.type = "text";
    }else{
        inputP.type = "password";
    }
});