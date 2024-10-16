<?php
// Oturum başlat
session_start();

// Oturumu kapat
session_unset(); // Oturum değişkenlerini temizle
session_destroy(); // Oturumu yok et

// Giriş sayfasına yönlendir
header('Location: login.php');
exit; // Yönlendirme sonrası başka işlem yapmasın
