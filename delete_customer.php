<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $MusteriID = $_POST['id'];
    
    // Musteriler tablosundan müşteriyi sil
    $sql = "DELETE FROM musteriler WHERE MusteriID = :MusteriID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MusteriID', $MusteriID);
    
    if ($stmt->execute()) {
        // Silme başarılı ise, kullanıcıyı admin paneline yönlendirin veya istediğiniz bir sayfaya yönlendirin
        header("Location: admin_panel.php");
        exit;
    } else {
        // Silme başarısızsa hata mesajını görüntüleyin veya gerekli işlemleri yapın
        echo "Müşteriyi silerken bir hata oluştu.";
    }
}
?>
