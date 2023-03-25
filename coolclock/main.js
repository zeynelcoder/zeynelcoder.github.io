setInterval(function(){
	
//		console.log("CoolClock Başlatıldı");
		var date = new Date();
		var saat = date.getHours();
		var dakika = date.getMinutes();
		var saniye = date.getSeconds();
		var gunsa = date.getDate();
		var ay = date.getMonth();
		
	//	console.log(saat + ":" + dakika + " gün >> " + gunsa);
		// 0 ise 00 yapma
			document.getElementById("dakika").innerText =dakika ,+'dakika';
				document.getElementById("saat").innerText = saat;
				document.getElementById("saniye").innerText = saniye;
		if(dakika == 0)
	{
		document.getElementById("dakika").innerText ="00";
	}
	else{
		document.getElementById("dakika").innerText =dakika;
	}
		// saat ve dakika
		document.getElementById("saat").innerText = saat;
		document.getElementById("saniye").innerText =saniye;
	
		// gün sayı, ay, gün metin ve yıl
		
}, 1)

var dies="#";
//         beyaz 0  siyah 1  yeşil 2  turuncu 3   mor 4            kırmızı 5
var colors=["#fff","#000","#90ee90","darkorange","rgba(157,24,72)","rgba(237,30,44)"];
var sel=0;

function selup(){
	sel++;
	if(sel>5)
	{
		sel=0;console.log("Sel Değişkeni Sıfırlandı. Yeni Değer; 0")
	}
	console.log(sel)
	
	switch (sel) {
		// beyaz siyah
		case 0:
		document.getElementById("body").style.backgroundColor= colors[0];
		document.getElementById("body").style.color= colors[1];
		document.getElementById('cover').style.borderColor= colors[2];
		break;
		// siyah beyaz
		case 1:
		document.getElementById("body").style.backgroundColor = colors[1];
		document.getElementById("body").style.color = colors[0];
		document.getElementById('cover').style.borderColor= colors[3];
		break;
		// siyah yeşil
		case 2:
		document.getElementById("body").style.backgroundColor = colors[1];
		document.getElementById("body").style.color = colors[2];
		document.getElementById('cover').style.borderColor= colors[4];
		break;
		// siyah turuncu
		case 3:
			document.getElementById("body").style.backgroundColor = colors[1];
		document.getElementById("body").style.color = colors[3];
		document.getElementById('cover').style.borderColor= 'white';
		break;
		case 4:
			document.getElementById("body").style.backgroundColor = colors[1];
		document.getElementById("body").style.color = colors[4];
		document.getElementById('cover').style.borderColor= 'white';
		break;
		case 5:
			document.getElementById("body").style.backgroundColor = colors[1];
		document.getElementById("body").style.color = colors[5];
		document.getElementById('cover').style.borderColor= 'white';
		

	}
}
