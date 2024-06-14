<?php
include 'db.php';

if (isset($_GET['id'])) {
    $SiparisID = $_GET['id'];
    
    $sql = "DELETE FROM siparisler WHERE SiparisID = :SiparisID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':SiparisID', $SiparisID);
    
    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "Sipariş silinirken bir hata oluştu.";
    }
}
?>
