var mtbb = document.getElementById("mtbb");
var workbtn = document.getElementById("work-btn");
var lufbtn= document.getElementById("level-up-factory");
var luwbtn= document.getElementById("level-up-workers");
var mt=10;
var mbtbwidth= 242/mt;
var factory=document.getElementById("factory-img");
var worker=document.getElementById("worker-img");
var factorylevel=1;
var workerlevel=1;
var earning=100;
var flimit=110;
var wlimit=120;
var flimiter=document.getElementById("flimittext");
var wlimiter=document.getElementById("wlimittext");
let fsound= new Audio("g-img/fsound.mp3");
let msound= new Audio("g-img/msound.mp3");
let lsound= new Audio("g-img/levelup.wav");


var game = {
    money: 0,
    diamond: 25,
    makingtime: mt,
    autoworker: false,
    levelupfactory: function(){
        if(game.money>=flimit){
        game.money-=flimit;
        switch (factorylevel) {
            case 1:
                lsound.play();
                console.log("luf")
                factory.src = "g-img/factory2.png";
                factorylevel=2;
                earning=earning*1.2;
                flimit=flimit*1.5;
                game.writing();
                break;
            case 2:
                    lsound.play();
                    console.log("luf")
                    factory.src = "g-img/factory3.png";
                    factorylevel=3;
                    earning=earning*1.2;
                    flimit=flimit*1.5;
                    game.writing();
                    break;
            case 3:
                    lsound.play();
                    console.log("luf")
                    factory.src = "g-img/factory4.png";
                    factorylevel=4;
                    earning=earning*1.2;
                    flimit=flimit*1.5;
                    game.writing();
                        break;
            case 4:
                    lsound.play();
                    console.log("luf")
                    factory.src = "g-img/factory5.png";
                    factorylevel=5;
                    earning=earning*1.2;
                    flimit=flimit*1.5;
                    game.writing();
                        break;
            case 5:
                    lsound.play();
                    console.log("luf")
                    factory.src = "g-img/factory6.png";
                    factorylevel=6;
                    earning=earning*1.2;
                    flimit=flimit*1.5;
                    game.writing();
                    document.getElementById("level-up-factory").innerText = "Max Level";
                    lufbtn.disabled=true;
                        break;
            default:
                break;

                // lufbtn.disabled=true;
        }    
        }
        else{
            alert("you do not have a money")
        }

        //////////////////////////////////////////////////

    },
    levelupworker: function(){
      
        if(game.money>=wlimit){
        game.money-=wlimit;
        switch (workerlevel) {
            case 1:
                lsound.play();
                console.log("luw")
                worker.src = "g-img/worker2.png";
                workerlevel=2;
                mt=mt-2;
                wlimit=wlimit*1.5;
                game.writing();
                break;
            case 2:
                lsound.play();
                console.log("luw")
                worker.src = "g-img/worker3.png";
                workerlevel=3;
                mt=mt-2;
                wlimit=wlimit*1.5;
                game.writing();
            break;
            case 3:
                lsound.play();
                console.log("luw")
                worker.src = "g-img/worker4.png";
                workerlevel=4;
                mt=mt-2;
                wlimit=wlimit*1.5;
                game.writing();
            break;
            case 4:
                lsound.play();
                console.log("luw")
                worker.src = "g-img/worker5.png";
                workerlevel=5;
                mt=mt-2;
                wlimit=wlimit*1.5;
                game.writing();
            break;
            case 5:
                lsound.play();
                console.log("luw")
                worker.src = "g-img/worker6.png";
                workerlevel=6;
                mt=mt-2;
                wlimit=wlimit*1.5;
                game.writing();
                document.getElementById("level-up-workers").innerText = "Max Level";
                luwbtn.disabled=true;
            break;
            default:
            break;

            // luwbtn.disabled=true;
        }    
        }
        else{
            alert("you do not have a money")
        }
          
    },
    writing: function() {
        document.getElementById("money-text").innerText = Math.floor(game.money) + "$";
        document.getElementById("diamond-text").innerText = game.diamond + "💎";
        document.getElementById("making-time-text").innerText = game.makingtime + "s";
        document.getElementById("fac-lev-txt").innerText = factorylevel + ".lv";
        document.getElementById("wor-lev-txt").innerText = workerlevel + ".lv";
        flimiter.innerText=Math.floor(flimit);
        wlimiter.innerText=Math.floor(wlimit);
        // writing statistic
        document.getElementById("st-ps").innerText = mt;
        var gps=earning/mt;
        document.getElementById("st-gps").innerText = Math.floor(gps);
        var eps=gps*mt;
        document.getElementById("st-eps").innerText = Math.floor(eps);
    },

    work: function() {
        console.log("hi!");
    workbtn.disabled = true;
    making();

    function making() {
        fsound.play();
        console.log("money updated", game.money);
        game.writing();

        let timeLeft = game.makingtime;
        let fullWidth = 242; // ✔ Çubuğun tam genişliği
        let step = fullWidth / timeLeft;

        // ✔ Her başlatıldığında bar sıfırlansın
        mtbb.style.width = fullWidth + "px";
        let currentWidth = fullWidth;

        // ❗ Daha önce başlatılmış bir interval varsa durdur
        if (game._intervalId) clearInterval(game._intervalId);

        game._intervalId = setInterval(() => {
            
            timeLeft--;
            game.makingtime = timeLeft;

            currentWidth -= step;
            mtbb.style.width = currentWidth + "px";

            game.writing();

            if (timeLeft <= 0) {
                clearInterval(game._intervalId);
                game._intervalId = null;

                game.money += earning;
                game.makingtime = mt;
                game.writing();
                mtbb.style.width = "0px";
                workbtn.disabled = false;
                 fsound.pause();
                 fsound.currentTime = 0;
                 msound.play()
            }
         
        }, 1000);
      
    }
    }
}

game.writing();
console.log("writing :", game.money, game.diamond, game.makingtime);
