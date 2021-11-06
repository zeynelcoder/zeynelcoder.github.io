setInterval(function(){
	
		console.log("CoolClock Başlatıldı");
		var date = new Date();
		var saat = date.getHours();
		var dakika = date.getMinutes();
		var saniye = date.getSeconds();
		var gunsa = date.getDate();
		var ay = date.getMonth();
		console.log(saat + ":" + dakika + " gün >> " + gunsa);
		// 0 ise 00 yapma
		
		if(dakika == 0)
	{
		document.getElementById("dakika").innerText ="00";
	}
	else{
		document.getElementById("dakika").innerText =dakika+"";
	}
		// saat ve dakika
		document.getElementById("saat").innerText = saat + "";
		document.getElementById("saniye").innerText =saniye+"";
	
		// gün sayı, ay, gün metin ve yıl
		document.getElementById("gunsa").innerText = gunsa + "/";
		document.getElementById("ay").innerText = ay;
		
}, 1000)





// tek haneli sayıya 0 ekleme
/*
var c = "ddddghk"
return dakika.toString().length;
if (dakika.length < 10) {
	alert("hi");
	console.log("ejherjt")
}
*/

