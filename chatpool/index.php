<?php
// Oturum başlat
session_start();

// Oturum süresi (dakika)
$sessionTimeout = 10; // 10 dakika

// Eğer oturumda kullanıcı adı yoksa login.php'ye yönlendir
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit; // Yönlendirme sonrası başka işlem yapmasın
}

// Oturum süresi kontrolü
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > ($sessionTimeout * 60)) {
    // Oturum süresi dolmuş, oturumu yok et
    session_unset(); // Oturum değişkenlerini temizle
    session_destroy(); // Oturumu kapat
    header('Location: login.php'); // Kullanıcıyı giriş sayfasına yönlendir
    exit; // Yönlendirme sonrası başka işlem yapmasın
}

// Oturum için renk belirle
if (!isset($_SESSION['color'])) {
    $_SESSION['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Rastgele bir renk oluştur
}

$_SESSION['last_activity'] = time(); // Son etkinlik zamanını güncelle

// Mesajları tutacak olan JSON dosyalarının yolları
define('MESSAGE_FILE', 'messages.json');
define('COUNTER_FILE', 'counter.json');

// Mesaj gönderimi için kontrol
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $username = $_SESSION['username']; // Oturumdan kullanıcı adını alıyoruz
    $message = $_POST['message'];
    $timestamp = time();
    $color = $_SESSION['color']; // Oturumdan alınan rengi kullan

    // Var olan mesajları oku
    $messages = json_decode(file_get_contents(MESSAGE_FILE), true);

    // Yeni mesajı ekle
    $messages[] = ['username' => $username, 'message' => $message, 'timestamp' => $timestamp, 'color' => $color];

    // Güncellenmiş mesajları JSON dosyasına yaz
    file_put_contents(MESSAGE_FILE, json_encode($messages, JSON_PRETTY_PRINT));

    // Sayacın güncellenmesi
    $counter = json_decode(file_get_contents(COUNTER_FILE), true);
    $counter['count'] += 1; // Sayacı 1 artır
    file_put_contents(COUNTER_FILE, json_encode($counter, JSON_PRETTY_PRINT));

    // Sayfayı yenile
    header('Location: index.php');
    exit; // Yenileme sonrası başka işlem yapma
}

// Var olan mesajları oku
$messages = json_decode(file_get_contents(MESSAGE_FILE), true);
$counter = json_decode(file_get_contents(COUNTER_FILE), true);
$currentCount = $counter['count']; // Mevcut sayaç değeri

// Son sayaç değerini kontrol et
if (!isset($_SESSION['lastCount'])) {
    $_SESSION['lastCount'] = $currentCount;
} else {
    // Eğer sayaç değeri değiştiyse, sayfayı yenile
    if ($currentCount > $_SESSION['lastCount']) {
        $_SESSION['lastCount'] = $currentCount; // Son sayacı güncelle
        header('Location: index.php');
        exit; // Yenileme sonrası başka işlem yapma
    }
}

// Mesajları ters sırada listelemek için ters çeviriyoruz
$messages = array_reverse($messages);
?>

<!DOCTYPE html>
<html lang="tr">
    <link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Pool</title>
    <script>
        // Counter.json dosyasını düzenli aralıklarla kontrol et ve sayaç değiştiğinde sayfayı yenile
        setInterval(function() {
            fetch('counter.json')
                .then(response => response.json())
                .then(data => {
                    // Mevcut sayacı kontrol et
                    let currentCount = <?php echo $currentCount; ?>;
                    if (data.count > currentCount) {
                        window.location.reload(); // Sayfa yenilenir
                    }
                });
        }, 3000); // Her 3 saniyede bir kontrol et

        // Sayfa yüklendiğinde input alanına odaklan
        window.onload = function() {
            document.getElementById('messageInput').focus();
        };
    </script>
</head>
<body>
    <h1>Hoş geldin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <form id="messageForm" method="POST">
        <input type="text" id="messageInput" name="message" placeholder="Mesajınızı yazın..." required>
        <button id="gonder" type="submit"><img id="paperplane" src="paper-plane.png" ></button>
    </form>
    <form method="POST" action="logout.php">
        <button type="submit" id="cıkıs">Çıkış Yap</button>
    </form>
    
    <h2>Mesajlar</h2>
    <ul id="messages">
        <?php
        foreach ($messages as $msg) {
            // Sadece saat ve dakika göstermek için date formatı H:i kullanılıyor
            echo '<li style="color:' . htmlspecialchars($msg['color']) . '"><strong>' . htmlspecialchars($msg['username']) . ':</strong> ' . htmlspecialchars($msg['message']) . ' <em>(' . date('H:i', $msg['timestamp']) . ')</em></li>';
        }
        ?>
    </ul>

    <!-- Çıkış Yap butonu -->
    
</body>
</html>
