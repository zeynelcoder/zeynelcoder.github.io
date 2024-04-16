// mevcut dolar inputu
var md=document.getElementById("md-inp");

// Dolar alınan fiyat
var af=document.getElementById("af-inp");

//TL değeri fonksiyon içinde hesaplanacak, md*af

// Güncel Dolar Kuru Fiyatı
var guncelF=document.getElementById("guncelf-inp");

// Güncel TL değeri fonksiyon içinde hesaplanacak, guncelF*md

// Kâr fonksiyon içinde hesaplanacak, GuncelTL(oluşturulduğunda)-TLdeger(oluşturulduğunda)

function hesapla(){

    // TL değeri hesplandı
var TLdeger= md.value*af.value;
    // TL değeri yazdırıldı
document.getElementById("tl-deger-text").innerText= TLdeger+" ₺"

    // Güncel TL değeri hesaplandı
var guncelTL=guncelF.value*md.value;
    // Güncel TL değeri yazdırıldı
document.getElementById("guncel-tl-text").innerText= guncelTL+" ₺"

    // Kâr hesaplandı
var kar=guncelTL-TLdeger;
var karin=kar;
    // Kâr yazdırıldı
    document.getElementById("kar-text").innerText= kar+" ₺";
}

function kaydet(){
    localStorage.setItem("mdLocal", md.value);
    localStorage.setItem("afLocal", af.value);
    localStorage.setItem("TLdegerLocal", md.value*af.value);
    localStorage.setItem("karLocal", kar);
}

function yazdir(){
    document.getElementById("md-inp").value=localStorage.getItem("mdLocal");
    document.getElementById("af-inp").value=localStorage.getItem("afLocal");
    document.getElementById("tl-deger-text").innerText=localStorage.getItem("TLdegerLocal");
    document.getElementById("kar-text").innerText=localStorage.getItem("karLocal");
}