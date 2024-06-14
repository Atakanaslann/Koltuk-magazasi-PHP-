<?php
try {
    // Veritabanı bağlantı bilgileri
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "koltuk";

    // PDO ile veritabanına bağlan
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // PDO hata modunu ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Çalışan ID'sini belirle (örneğin, 1)
    $employeeid = 7;

    // SQL sorgusunu hazırla ve çalıştır
    $calisan = $conn->prepare("SELECT Ad, Soyad FROM calisanlar WHERE CalisanID = :id");
    $calisan->bindParam(":id", $employeeid, PDO::PARAM_INT);
    $calisan->execute();

    // Sonucu al
    $result = $calisan->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $adSoyad = $result["Ad"] . " " . $result["Soyad"];
        echo htmlspecialchars($adSoyad);
    } else {
        echo "Çalışan bulunamadı";
    }
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . htmlspecialchars($e->getMessage());
}

// Bağlantıyı kapat
$conn = null;
?>
