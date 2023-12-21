console.log(window);

window.addEventListener("scroll", function() {
    const mesafe = window.scrollY;
    console.log(mesafe)
    if(mesafe>2700)
    {
        document.getElementById("alertbox").style.display="block"; 
        //document.getElementById("body").style.backgroundImage = "url('bg2.png')";
    }
    else{
        //
    }
});

function kapat(){
    document.getElementById("alertbox").style.display="none";
}