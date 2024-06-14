<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $CalisanID = $_POST['id'];
    
    // Calisanlar tablosundan çalışanı sil
    $sql = "DELETE FROM calisanlar WHERE CalisanID = :CalisanID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CalisanID', $CalisanID);
    
    if ($stmt->execute()) {
        // Silme başarılı ise, kullanıcıyı admin paneline yönlendirin veya istediğiniz bir sayfaya yönlendirin
        header("Location: admin_panel.php");
        exit;
    } else {
        // Silme başarısızsa hata mesajını görüntüleyin veya gerekli işlemleri yapın
        echo "Çalışanı silerken bir hata oluştu.";
    }
}
?>
