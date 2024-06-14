<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alın
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Veritabanı bağlantı bilgileri
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "koltuk"; // Veritabanı adını 'koltuk' olarak ayarladık

    try {
        // Veritabanına bağlanın
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // PDO hata modunu ayarlayın
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL sorgusunu hazırlayın
        $sql = "INSERT INTO mesajlar (Ad, Soyad, Eposta, Mesaj) VALUES (:fname, :lname, :email, :message)";
        $stmt = $conn->prepare($sql);

        // Parametreleri bağlayın
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Sorguyu çalıştırın
        $stmt->execute();
        echo "Yeni kayıt başarıyla oluşturuldu";

        // Bağlantıyı kapatın
        $conn = null;

        // Index.html sayfasına yönlendirme yap
        header("Location: index.php");
        exit;
    } catch(PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
?>
