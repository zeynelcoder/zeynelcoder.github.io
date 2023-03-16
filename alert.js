var box=document.getElementById("alertbox");
var bt=document.getElementById("alertbt");

const messages = [
"Hoşgeldinnn!",
"HTML developerlar şuan ne yapıyor?",
"Neden böyle bi kutu var bilmiyorum😇",
"Tasarladığım ürünler için yukarı kaydır! ⬆️⬆️⬆️",
"Blog sayfamda büyüleyici şeyler var! Bi göz at derim.",
];


function yazdir(){
    box.innerHTML=messages[Math.floor(Math.random() * 5)];
    
}

function tik(){
    yazdir();
}
