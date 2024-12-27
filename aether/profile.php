<?php
session_start();

// Kullanıcı oturum açmamışsa giriş sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Kullanıcı adı URL parametresinden alınıyor
$profileUser = isset($_GET['user']) ? $_GET['user'] : $_SESSION['username'];

$filePath = 'data/posts.json';

// Gönderiler dizisini yükle
if (file_exists($filePath)) {
    $posts = json_decode(file_get_contents($filePath), true);
    if (!is_array($posts)) {
        $posts = [];
    }
} else {
    $posts = [];
}

// Kullanıcıya ait gönderileri filtrele
$userPosts = array_filter($posts, function($post) use ($profileUser) {
    return $post['author'] === $profileUser;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - <?= htmlspecialchars($profileUser) ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1><?= htmlspecialchars($profileUser) ?> Profiline Hoş Geldiniz!</h1>
    <a href="home.php">Ana Sayfaya Dön</a> | <a href="logout.php">Çıkış Yap</a>

    <h2>Gönderiler</h2>
    <?php if (empty($posts)): ?>
        <p>Henüz gönderi yok.</p>
    <?php else: ?>
        <?php foreach (array_reverse($posts) as $index => $post): ?>
            <div style="border: 1px solid #ccc; margin: 10px 0; padding: 10px;">
                <p>
                    <strong><a href="profile.php?user=<?= urlencode($post['author']) ?>" style="text-decoration: none;"><?= htmlspecialchars($post['author']) ?></a></strong> 
                    | <?= formatTimestamp($post['timestamp']) ?> 
                    | <strong><a href="home.php?category=<?= urlencode($post['category']) ?>"><?= htmlspecialchars($post['category']) ?></a></strong>
                </p>

                <?php if (strlen($post['content']) > 100): ?>
                    <!-- 100 karakterden uzun içerikler -->
                    <div id="previewContent_<?= $index ?>" class="post-content">
                        <p><?= nl2br(htmlspecialchars(getPreview($post['content']))) ?> <a href="javascript:void(0);" id="toggleLink_<?= $index ?>" onclick="togglePostContent(<?= $index ?>)">...devamını oku</a></p>
                    </div>
                    <div id="fullContent_<?= $index ?>" style="display: none;" class="post-content">
                        <p><?= nl2br(htmlspecialchars(getFullContent($post['content']))) ?> <a href="javascript:void(0);" id="toggleLink_<?= $index ?>" onclick="togglePostContent(<?= $index ?>)">...daha kısa göster</a></p>
                    </div>
                <?php else: ?>
                    <!-- 100 karakterden kısa içerikler, sadece metin gösterilir -->
                    <div class="post-content">
                        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
