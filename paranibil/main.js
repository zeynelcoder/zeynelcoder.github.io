var date=new Date();
var process="hello world";
var dbox=document.getElementById("date-box");

var user={
	money:0,
	tobank:0,
	add:function(){
	
	process="gather";
			console.log("İŞLEM : " , process)
var addbox=parseInt(document.getElementById("box").value);
		console.log("Ekleme İşlemi Başlatıldı");
		
		var gather=user.money+addbox;
		
		var x=1;
		
		if(x==1)
		{
			user.money=gather;
		}
		
		console.log("Toplanan :" , gather, "User Money :" , user.money);
		
		
		document.getElementById("money-box").innerText =user.money;
		
		// write to date-box
		user.wconsole();
		user.storage();
		
	},
	interest:function()
	{
		
		console.log("İNTERESTİNG")
		
		process="interest";
		console.log("İŞLEM : " , process)
		
		var interestbox = parseInt(document.getElementById("box").value);
		
		console.log("Ekleme İşlemi Başlatıldı");
		
		var interest = user.money - interestbox;
		
		var x = 1;
		
		if (x == 1)
		{
			user.money = interest;
		}
		
		console.log("Çıkarılan :", interest, "User Money :", user.money);
		
		
		document.getElementById("money-box").innerText = user.money;
		// write to date-box
		
		user.wconsole();
		user.storage();
		
	},
	write:function(){
		
		user.money=+localStorage.getItem("moneyStorage");
		
		console.log("Uygulama Başlatıldı"
		)
	document.getElementById("money-box").innerText = localStorage.getItem("moneyStorage");
	
	document.getElementById("date-box").innerText = localStorage.getItem("dateStorage");
	
	},
	storage:function(){
		console.log("storage time")
		var v=1365;
	//						var name		/	value
		localStorage.setItem("moneyStorage", user.money);
		localStorage.setItem("dateStorage", d+" Tarihinde "+user.money+"$"+process)
	},
	wconsole:function(){
		console.log("Wconsole Çalışıyor...");
		
		// gather control
		if(process=="gather")
		{
		var moneyto=document.getElementById("box").value;
	document.getElementById("date-box").innerText = moneyto+"₺"+" Anapara'ya Eklendi "+date;


		
		}
		// intersting control
		if (process == "interest")
		{
		var moneyto=document.getElementById("box").value;
			document.getElementById("date-box").innerText = moneyto+"₺"+" Anapara'dan Çıkarıldı "+"Tarih: "+date;
		}
		
		
	}
	
}
