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
        if(t.remainDdays == 1){
            el.innerHTML = `Falta: ${t.remainDdays}d: ${t.remainHours}h: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        }else if(t.remainDdays > 1){
            el.innerHTML = `Faltan: ${t.remainDdays}d: ${t.remainHours}h: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        }else if(t.remainDdays < 1 && t.remainHours > 1){
            el.innerHTML = `Faltan: ${t.remainHours}h: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        }else if(t.remainDdays < 1 && t.remainHours == 1){
            el.innerHTML = `Falta: ${t.remainHours}h: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        }else if(t.remainDdays < 1 && t.remainHours < 1 && t.remainMinutes > 1){
            el.innerHTML = `Faltan: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        }else if(t.remainDdays < 1 && t.remainHours < 1 && t.remainMinutes == 1){
            el.innerHTML = `Falta: ${t.remainMinutes}m: ${t.remainSeconds}s`;
        }else if(t.remainDdays < 1 && t.remainHours < 1 && t.remainMinutes < 1 && t.remainSeconds > 1){
            el.innerHTML = `Faltan: ${t.remainSeconds}s`;
        }else if(t.remainDdays < 1 && t.remainHours < 1 && t.remainMinutes < 1 && t.remainSeconds == 1){
            el.innerHTML = `Falta: ${t.remainSeconds}s`;
        }
        if(t.remainTime <= 1){
            clearInterval(timerUpdate);
            el.innerHTML = finalMessage;
        }
    }, 1000)
};

countdown('Aug 30 2024 16:58:30 GMT-0500', 'clock', 'Bienvenidos a mi babyshower');

let inputP = document.getElementById('inputPassword');

let verP = document.getElementById('verPassw');

verP.addEventListener("click", function(){
    if(inputP.type == "password"){
        inputP.type = "text";
    }else{
        inputP.type = "password";
    }
});

//Account Password: Z73uHHNqHoa0F

/*
MySQL DB Name: if0_37108021_babyshowerprueba
MySQL User Name: 	if0_37108021
MySQL Password: Z73uHHNqHoa0F
MySQL Host Name: sql110.infinityfree.com
*/