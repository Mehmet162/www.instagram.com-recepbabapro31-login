<?php
// db.php dosyasındaki veritabanı bağlantısı
$host = 'localhost'; // Sunucu
$dbname = 'insta'; // Veritabanı adı
$username = 'root'; // Veritabanı kullanıcı adı
$password = ''; // Veritabanı şifresi

try {
    // PDO bağlantısı
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Hata ayıklama modu
} catch (PDOException $e) {
    // Hata oluşursa mesaj verir
    die("Veritabanına bağlanılamadı: " . $e->getMessage());
}
?>
