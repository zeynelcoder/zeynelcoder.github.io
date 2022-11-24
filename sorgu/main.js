function sorgula(){
var name=document.getElementById('isimbox').value;
var surname=document.getElementById('soyisimbox').value;
var output=document.getElementById('output');

	
	
	console.log(name);
 output.innerText= 'http://20.107.221.116/Modules/_AdSoyadSorgula.php?hash=mwvuittonapiservices&Name='+name+'&Surname='+surname;
}

// http://20.107.221.116/Modules/_AdSoyadSorgula.php?hash=mwvuittonapiservices&Name=Mustafa Kemal&Surname=Atatürk

