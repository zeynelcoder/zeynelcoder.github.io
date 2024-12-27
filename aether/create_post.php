<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$filePath = 'data/posts.json';
$categoriesFilePath = 'data/categories.json';

// Kategoriler
if (file_exists($categoriesFilePath)) {
    $categories = json_decode(file_get_contents($categoriesFilePath), true);
    if (!is_array($categories)) {
        $categories = [];
    }
} else {
    $categories = [];
}

// Yeni gönderi işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    $category = $_POST['category'];
    
    // Yeni kategori ekleme
    if ($category === 'new' && !empty($_POST['newCategory'])) {
        $newCategory = trim($_POST['newCategory']);
        if (!in_array($newCategory, $categories)) {
            $categories[] = $newCategory;
            file_put_contents($categoriesFilePath, json_encode($categories));
            $category = $newCategory; // Yeni eklenen kategori seçilsin
        }
    }

    // Gönderi ekleme
    $post = [
        'author' => $username,
        'content' => $content,
        'category' => $category,
        'timestamp' => time(),
    ];

    if (file_exists($filePath)) {
        $posts = json_decode(file_get_contents($filePath), true);
        if (!is_array($posts)) {
            $posts = [];
        }
    } else {
        $posts = [];
    }

    $posts[] = $post;
    file_put_contents($filePath, json_encode($posts));

    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gönderi Oluştur</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Gönderi Oluştur</h1>
    <a href="home.php">Geri Dön</a>
    <form method="POST" action="create_post.php">
        <label for="content">Gönderi İçeriği:</label><br>
        <textarea id="content" name="content" required></textarea><br>

        <label for="category">Kategori:</label>
        <select name="category" id="category" required>
            <option value="">Kategori Seçin</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></option>
            <?php endforeach; ?>
            <option value="new">Yeni Kategori Ekle</option>
        </select>

        <div id="newCategoryInput" style="display:none;">
            <label for="newCategory">Yeni Kategori Adı:</label>
            <input type="text" name="newCategory" id="newCategory" placeholder="Yeni kategori adı" />
        </div><br>

        <button type="submit">Gönderiyi Paylaş</button>
    </form>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            var newCategoryInput = document.getElementById('newCategoryInput');
            if (this.value === 'new') {
                newCategoryInput.style.display = 'block';
            } else {
                newCategoryInput.style.display = 'none';
            }
        });
    </script>
</body>
</html>
