<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alın
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifre kontrolü
    if ($username === 'root' && $password === '1653') {
        // Doğrulama başarılıysa admin_panel.html'e yönlendir
        header("Location: admin_panel.php");
        exit;
    } else {
        // Doğrulama başarısızsa hata mesajı göster
        echo "Hatalı kullanıcı adı veya şifre.";
    }
}
?>
