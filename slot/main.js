
// play button and bet input
var ply=document.getElementById("btn");
var inp=5;
var alertbox=document.getElementById("alert");
var casebox=document.getElementById("case");
var playercase=50;

casebox.innerText = playercase+"$";

// elements on bet box
var betText=document.getElementById("bet");
var luNumText=document.getElementById("lucky-number");
var CaseText=document.getElementById("case");

// slot bars
const sb1=document.getElementById("slot-bar1");
const sb2=document.getElementById("slot-bar2");
const sb3=document.getElementById("slot-bar3");

function play(){

if(playercase>0){

    sb1.style.borderColor="aqua";
    sb2.style.borderColor="aqua";
    sb3.style.borderColor="aqua";

    var audio = new Audio('sounds/handle.mp3');
    audio.play();

/*
alertbox.style.display="block";
alertbox.innerText="başlangıç";
function hide(){
    alert.style.display="none"
}
setTimeout(hide, 3000)
*/

   // write to bet on the screen
    betText.innerText = inp + "$";

    // write to console
console.log("bahis:"+ inp);
    
   // make 3 lucky numbers on 1-0
const b1= Math.floor(Math.random() * 10);
const b2= Math.floor(Math.random() * 10);
const b3= Math.floor(Math.random() * 10);
    // write lucky numbers on screen
luNumText.innerText = "Şanslı Sayılar : "+b1+"-"+b2+"-"+b3;
    // write lucky numbers on console
console.log("Şanslı Sayı = "+b1+"-"+b2+"-"+b3)

    //  make slot numbers
const sn1= Math.floor(Math.random() * 10);
const sn2= Math.floor(Math.random() * 10);
const sn3= Math.floor(Math.random() * 10);
    // write slot numbers on console
    console.log("Slottaki Sayı: "+sn1+"-"+sn2+"-"+sn3)

    // write slot numbers on screen 
    sb1.innerText = sn1;
    sb2.innerText = sn2;
    sb3.innerText = sn3;

    // money spending

    playercase=playercase-5;
    console.log("kasa-5: "+playercase);
    write();

    // check matches

if (sn1==b1) {
    console.log("Tebrikler, 1 Numaralı Slottan 3X Kazandınız...")
    playercase=playercase+inp*3;
    console.log("kasa: "+playercase);
    write();
    sb1.style.borderColor="rgb(57, 131, 0)";

    alertbox.style.display="block";
alertbox.innerText="Tebrikler🎉 1 Numaralı Slottan 3X Kazandınız...";
function hide(){
    alertbox.style.display="none"
}
setTimeout(hide, 3000)
var audio = new Audio('sounds/cash.mp3');
    audio.play();
}
else{
    sb1.style.borderColor="red";
}
if (sn2==b2) {
    console.log("Tebrikler, 2 Numaralı Slottan 3X Kazandınız...")
    playercase=playercase+inp*3;
    console.log("kasa: "+playercase);
    write();
    sb2.style.borderColor="rgb(57, 131, 0)";
    alertbox.style.display="block";
alertbox.innerText="Tebrikler🎉 2 Numaralı Slottan 3X Kazandınız...";
function hide(){
    alertbox.style.display="none"
}
setTimeout(hide, 3000)
var audio = new Audio('sounds/cash.mp3');
    audio.play();
}
else{
    sb2.style.borderColor="red";
}
if (sn3==b3) {
    console.log("Tebrikler, 3 Numaralı Slottan 3X Kazandınız...")
    playercase=playercase+inp*3;
    console.log("kasa: "+playercase);
    write();
    sb3.style.borderColor="rgb(57, 131, 0)";
    alertbox.style.display="block";
alertbox.innerText="Tebrikler🎉 3 Numaralı Slottan 3X Kazandınız...";
function hide(){
    alertbox.style.display="none"
}
setTimeout(hide, 3000)
var audio = new Audio('sounds/cash.mp3');
    audio.play();
}
else{
    sb3.style.borderColor="red";
}



}
else{
    var audio = new Audio('sounds/error.mp3');
    audio.play();
    alertbox.style.display="block";
alertbox.innerText="😳 Kasada Para Kalmadı! Oyun Yeniden Başlatıldı...";
function hide(){
    alertbox.style.display="none"
}
setTimeout(hide, 3000)

    playercase=50;
    write();
}
};

function write(){
    // write to bet on the screen
    betText.innerText = "Bahis : " + inp + "$";

    casebox.innerText = "Kasa : " + playercase + "$";
}