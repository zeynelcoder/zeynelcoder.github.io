<?php
session_start();

// Kullanıcı verilerini tutacak dosya
define('USER_FILE', 'users.json');

// Kullanıcı kaydı işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Dosyadan mevcut kullanıcıları oku
    $users = json_decode(file_get_contents(USER_FILE), true);

    // Kullanıcı adı kontrolü (aynı kullanıcı adı olamaz)
    if (isset($users[$username])) {
        $error = "Bu kullanıcı adı zaten alınmış.";
    } else {
        // Yeni kullanıcıyı ekle
        $users[$username] = $password; // Şifre düz metin olarak kaydedilir
        file_put_contents(USER_FILE, json_encode($users, JSON_PRETTY_PRINT));
        $success = "Kayıt başarılı. Giriş yapabilirsiniz.";
    }
}

// Giriş işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Dosyadan mevcut kullanıcıları oku
    $users = json_decode(file_get_contents(USER_FILE), true);

    // Kullanıcı adı ve şifre kontrolü
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username; // Oturum değişkenini ayarla
        header('Location: index.php'); // Ana sayfaya yönlendir
        exit;
    } else {
        $error = "Kullanıcı adı veya şifre yanlış.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
    <link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş / Kayıt</title>
</head>
<body>
    <h1>Giriş Yap veya Kayıt Ol</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST">
        <h2>Kayıt Ol</h2>
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit" name="register">Kayıt Ol</button>
    </form>

    <form method="POST">
        <h2>Giriş Yap</h2>
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit" name="login">Giriş Yap</button>
    </form>
</body>
</html>
