<?php
session_start();

// Eğer kullanıcı oturum açtıysa ana sayfaya yönlendir
if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit;
}

// Giriş yap işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $filePath = 'data/users.json';
    $users = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['username'] = $user['username'];
            header('Location: home.php');
            exit;
        }
    }

    $error = 'Geçersiz giriş bilgileri.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Giriş Yap</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="E-posta" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Giriş Yap</button>
    </form>
    <p>Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></p>
</body>
</html>
