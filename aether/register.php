<?php
session_start();

// Eğer kullanıcı oturum açtıysa ana sayfaya yönlendir
if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit;
}

// Kayıt işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $filePath = 'data/users.json';
    $users = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

    foreach ($users as $user) {
        if ($user['email'] === $email || $user['username'] === $username) {
            $error = 'Bu kullanıcı adı veya e-posta zaten kullanılıyor.';
            break;
        }
    }

    if (!isset($error)) {
        $users[] = ['username' => $username, 'email' => $email, 'password' => $password];
        file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT));
        $success = 'Kayıt başarılı! Giriş yapmak için <a href="login.php">tıklayın</a>.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Kayıt Ol</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="email" name="email" placeholder="E-posta" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Kayıt Ol</button>
    </form>
    <p>Zaten bir hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
</body>
</html>
