<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$filePath = 'data/posts.json';
$categoriesFilePath = 'data/categories.json';

// Kategori filtrelemesi
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;

// Gönderiler dizisini yükle
if (file_exists($filePath)) {
    $posts = json_decode(file_get_contents($filePath), true);
    if (!is_array($posts)) {
        $posts = [];
    }
} else {
    $posts = [];
}

// Kategori filtresi uygulama
if ($categoryFilter) {
    $posts = array_filter($posts, function ($post) use ($categoryFilter) {
        return $post['category'] === $categoryFilter;
    });
}

// Kategorileri yükle
if (file_exists($categoriesFilePath)) {
    $categories = json_decode(file_get_contents($categoriesFilePath), true);
    if (!is_array($categories)) {
        $categories = [];
    }
} else {
    $categories = [];
}

function formatTimestamp($timestamp) {
    // Eğer zaman damgası UNIX zaman damgası ise:
    if (is_numeric($timestamp)) {
        // UNIX zaman damgası kullanılıyorsa
        $date = new DateTime("@$timestamp");
    } else {
        // Tarih ve saat stringi kullanılıyorsa
        $date = new DateTime($timestamp);
    }
    
    return $date->format('d F Y H:i') . ' ÖS';
}

function getPreview($content) {
    return mb_substr($content, 0, 100);  // İçeriğin ilk 100 karakterini döndürür
}

function getFullContent($content) {
    return $content;  // İçeriğin tamamını döndürür
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function togglePostContent(postId) {
            var fullContent = document.getElementById("fullContent_" + postId);
            var previewContent = document.getElementById("previewContent_" + postId);
            var toggleLink = document.getElementById("toggleLink_" + postId);

            if (fullContent.style.display === "none") {
                fullContent.style.display = "block";
                previewContent.style.display = "none";
                toggleLink.innerHTML = "...daha kısa göster";
            } else {
                fullContent.style.display = "none";
                previewContent.style.display = "block";
                toggleLink.innerHTML = "...devamını oku";
            }
        }
    </script>
</head>
<body>
    <div id="menu">
    <img id="logo" src="img/Aether-little.png" alt=""><br>
    <a href="create_post.php">Gönderi Oluştur</a> | <a href="profile.php">Profilim</a> | <a href="logout.php">Çıkış Yap</a>
</div>


    <!-- Kategori filtreleme seçenekleri -->
    <div class="category-container">
        <a href="home.php">Tüm Konular</a>
        <?php foreach ($categories as $category): ?>
            <a href="home.php?category=<?= urlencode($category) ?>"><?= htmlspecialchars($category) ?></a>
        <?php endforeach; ?>
    </div>

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
