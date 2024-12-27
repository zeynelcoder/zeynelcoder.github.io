<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newCategory = trim($_POST['category']);
    
    // Kategori boş veya sadece boşluk ise hata mesajı göster
    if (empty($newCategory)) {
        $error = "Kategori adı boş olamaz!";
    } else {
        $categoryFile = 'data/categories.json';
        
        // Var olan kategorileri yükle
        $categories = [];
        if (file_exists($categoryFile)) {
            $categories = json_decode(file_get_contents($categoryFile), true);
            if (!is_array($categories)) {
                $categories = [];
            }
        }

        // Yeni kategoriyi ekle
        if (!in_array($newCategory, $categories)) {
            $categories[] = $newCategory;
            file_put_contents($categoryFile, json_encode($categories, JSON_PRETTY_PRINT));
            header('Location: home.php'); // Kategoriyi ekledikten sonra ana sayfaya yönlendir
            exit;
        } else {
            $error = "Bu kategori zaten mevcut!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Kategori Ekle</title>
</head>
<body>
    <h1>Yeni Kategori Ekle</h1>
    
    <!-- Hata mesajı göster -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="add_category.php" method="POST">
        <label for="category">Yeni Kategori Adı:</label><br>
        <input type="text" name="category" id="category"><br><br>
        <input type="submit" value="Kategori Ekle">
    </form>

    <br>
    <a href="home.php">Ana Sayfaya Dön</a>
</body>
</html>
