
var b=document.getElementById('b')
var box=document.getElementById('box');
var btn=document.getElementById('make')

btn.onclick=function x(){
	
	// RGBA bölümlerinin rastgele ayarlanması 
	var c1 = Math.floor(Math.random() * 256);
	var c2 = Math.floor(Math.random() * 256);
	var c3 = Math.floor(Math.random() * 256);
	
 // Consola yazdırma
 console.log('C1: ',c1)
 console.log('C2: ',c2)
 console.log('C3: ',c3)
 
 //
 b.innerText=("color: rgba("+c1+","+c2+","+c3+")")

 
 var val=c1+c2+c3;
 console.log(val, "val değişkeni")
 // box öğesine renk değerleri ile etki etme
 document.getElementById('box').style.backgroundColor= "rgba(" + c1 + "," + c2 + "," + c3 + ")";
 
}