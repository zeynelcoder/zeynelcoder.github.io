var tahmin= Math.floor(Math.random() * 4);
var secilen=0;
var carpan=2; 
var zmoney=250;
var tahminin=document.getElementById("tahminin");



function cay(){
    this.secilen=1;
    console.log("tahmin:", tahmin, "seçtiğin: ", secilen);
    tahminin.innerText = "Seçtiğin : 🍵";
};

function kahve(){
    this.secilen=2;
    console.log("tahmin:", tahmin, "seçtiğin: ", secilen);
    tahminin.innerText = "Seçtiğin : ☕";
};

function kurabiye(){
    this.secilen=3;
    console.log("tahmin:", tahmin, "seçtiğin: ", secilen);
    tahminin.innerText = "Seçtiğin : 🍪";
};

function start(){
    console.log("BAHİS BAŞLATILDI")
    document.getElementById("cüzdan").innerText = "CÜZDANIN : "+zmoney+"ż";

    if(tahmin<1){
        alert("TAHMİN YAPMADAN BAHİS BAŞLATAMAZSSIN!");     
    }
    switch(secilen) {
        case 1:
          console.log("tahmin:", tahmin, "seçtiğin: ", secilen);
          if(secilen==tahmin){
            alert("TEBRİKLER 25 × 2 MONEY KAZANDIN");
            zmoney+=50;
          }
          else{
            alert("KAYBETTİN -25 × 2 MONEY");
            
          }
        break;
        case 2:
            console.log("tahmin:", tahmin, "seçtiğin: ", secilen);
            if(secilen==tahmin){
                alert("TEBRİKLER 25 × 2 MONEY KAZANDIN");
                zmoney+=50;
              }
              else{
                alert("KAYBETTİN -25 × 2 MONEY");
                
              }
        break;
        case 3:
            console.log("tahmin:", tahmin, "seçtiğin: ", secilen);
            if(secilen==tahmin){
                alert("TEBRİKLER 25 × 2 MONEY KAZANDIN");
                zmoney+=50;
              }
              else{
                alert("KAYBETTİN -25 × 2 MONEY");
                
              }
        break;
      }








}
