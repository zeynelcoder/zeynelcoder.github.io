<?php
header('Content-Type: text/html; charset=utf-8');

// Örnek kullanıcı ve telefon
$userId = 123;
$userPhone = '+905551112233';

// POST isteği: QR okutma sonrası aktivasyon
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']==='activate'){
    $token = trim($_POST['token'] ?? '');
    if(!$token){
        echo json_encode(['success'=>false,'message'=>'Token eksik']); exit;
    }

    $dbFile = 'tokens.json';
    if(!file_exists($dbFile)){
        file_put_contents($dbFile,json_encode([
            'used'=>[],
            'valid'=>['TK0101','TK0102','TK0103'] // Örnek tokenler
        ]));
    }
    $db = json_decode(file_get_contents($dbFile), true);

    if(!in_array($token,$db['valid'])){
        echo json_encode(['success'=>false,'message'=>'Geçersiz token']); exit;
    }
    if(in_array($token,$db['used'])){
        echo json_encode(['success'=>false,'message'=>'Token zaten kullanılmış']); exit;
    }

    // Tokeni kullanılmış olarak işaretle
    $db['used'][] = $token;
    file_put_contents($dbFile,json_encode($db));

    // Token klasörü oluştur
    $folderName = __DIR__.'/'.$token;
    if(!file_exists($folderName)) mkdir($folderName,0777,true);

    // index.html dosyası oluştur
    $indexContent = "<!DOCTYPE html>
<html lang='tr'>
<head><meta charset='UTF-8'><title>$token</title></head>
<body>
<h2>Token Bilgisi</h2>
<p>Token: $token</p>
<p>Kullanıcı ID: $userId</p>
<p>Telefon: <a href='tel:$userPhone'>Ara</a></p>
</body></html>";
    file_put_contents($folderName.'/index.html', $indexContent);

    echo json_encode(['success'=>true,'message'=>"Token $token aktive edildi, klasör ve index.html oluşturuldu!"]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QR Aktivasyon + Telefon</title>
<script src="https://unpkg.com/html5-qrcode"></script>
<style>
body { font-family: Arial; text-align:center; padding:20px; background:#f5f5f5;}
#reader{width:300px;margin:20px auto;}
button{padding:12px 20px;font-size:16px;border:none;background:#007bff;color:white;border-radius:8px;cursor:pointer;margin:10px;}
button:hover{background:#0056b3;}
#result{margin-top:20px;font-weight:bold;}
</style>
</head>
<body>
<h2>QR Aktivasyon & Telefon Linki</h2>
<p>QR kodu arka kameraya gösterin</p>
<button onclick="startScanner()">QR Oku</button>
<div id="reader"></div>
<div id="result"></div>

<script>
let html5QrCode;
const userId = <?php echo $userId; ?>;
const userPhone = '<?php echo $userPhone; ?>';

async function startScanner(){
    if(html5QrCode) return;
    html5QrCode = new Html5Qrcode("reader");

    try{
        const devices = await Html5Qrcode.getCameras();
        if(!devices.length){ alert("Kamera bulunamadı"); return; }

        let backCamera = devices.find(d=>d.label.toLowerCase().includes("back")||d.label.toLowerCase().includes("environment"));
        if(!backCamera) backCamera = devices[devices.length-1];

        await html5QrCode.start(
            backCamera.id,
            { fps:10, qrbox:250 },
            async (decodedText)=>{
                await html5QrCode.stop();
                html5QrCode = null;

                const formData = new FormData();
                formData.append('action','activate');
                formData.append('token',decodedText.trim());

                const res = await fetch('activation.php',{
                    method:'POST',
                    body: formData
                });
                const data = await res.json();

                // Sonucu göster
                let resultDiv = document.getElementById('result');
                resultDiv.innerHTML = data.message;

                if(data.success){
                    // Telefon linki buton olarak ekle
                    let phoneBtn = document.createElement('a');
                    phoneBtn.href = 'tel:' + userPhone;
                    phoneBtn.innerText = 'Ara';
                    phoneBtn.style.display = 'inline-block';
                    phoneBtn.style.marginTop = '10px';
                    phoneBtn.style.padding = '10px 20px';
                    phoneBtn.style.background = '#28a745';
                    phoneBtn.style.color = 'white';
                    phoneBtn.style.borderRadius = '8px';
                    phoneBtn.style.textDecoration = 'none';
                    resultDiv.appendChild(document.createElement('br'));
                    resultDiv.appendChild(phoneBtn);
                }
            }
        );

    } catch(err){
        console.error(err);
        alert("Kamera başlatılamadı");
    }
}
</script>
</body>
</html>
