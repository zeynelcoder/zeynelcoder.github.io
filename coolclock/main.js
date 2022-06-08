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
var colors=["#fff","#FF4848","#C2FFD9","#142F43","#FFE459","000"];
var sel=0;

function selup(){
	sel++;
	if(sel>6)
	{
		sel=0;console.log("Sel Değişkeni Sıfırlandı. Yeni Değer; 0")
	}
	console.log(sel)
	
	switch (sel) {
		case 0:
		document.getElementById("body").style.backgroundColor= colors[1];
		document.getElementById("body").style.color= colors[2];
		document.getElementById('cover').style.borderColor= colors[2];
		break;
		case 1:
			document.getElementById("body").style.backgroundColor = colors[2];
		document.getElementById("body").style.color = colors[3];
		document.getElementById('cover').style.borderColor= colors[3];
		break;
		case 2:
			document.getElementById("body").style.backgroundColor = colors[3];
		document.getElementById("body").style.color = colors[4];
		document.getElementById('cover').style.borderColor= colors[4];
		break;
		case 3:
			document.getElementById("body").style.backgroundColor = 'darkorange';
		document.getElementById("body").style.color = 'white';
		document.getElementById('cover').style.borderColor= 'white';
		break;
		case 4:
			document.getElementById("body").style.backgroundColor = 'black';
		document.getElementById("body").style.color = 'lightgreen';
		document.getElementById('cover').style.borderColor= 'lightgreen';
		break;
		case 5:
			document.getElementById("body").style.backgroundColor = colors[0];
		document.getElementById("body").style.color = 'black';
		document.getElementById('cover').style.borderColor= 'black';
		break;
	}
}










// tek haneli sayıya 0 ekleme
/*
var c = "ddddghk"
return dakika.toString().length;
if (dakika.length < 10) {
	alert("hi");
	console.log("ejherjt")
}
*/

