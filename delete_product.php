<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $UrunID = $_POST['id'];
    
    // Ürünü ilişkili sipariş detaylarından önce sil
    $sql_delete_order_details = "DELETE FROM siparis_detaylari WHERE UrunID = :UrunID";
    $stmt_delete_order_details = $conn->prepare($sql_delete_order_details);
    $stmt_delete_order_details->bindParam(':UrunID', $UrunID);
    
    // Ürünü sil
    $sql_delete_product = "DELETE FROM urunler WHERE UrunID = :UrunID";
    $stmt_delete_product = $conn->prepare($sql_delete_product);
    $stmt_delete_product->bindParam(':UrunID', $UrunID);
    
    try {
        $conn->beginTransaction();
        
        // Sipariş detaylarını sil
        $stmt_delete_order_details->execute();
        
        // Ürünü sil
        $stmt_delete_product->execute();
        
        $conn->commit();
        
        // Silme başarılı ise, kullanıcıyı admin paneline yönlendirin veya istediğiniz bir sayfaya yönlendirin
        header("Location: admin_panel.php");
        exit;
    } catch (PDOException $e) {
        // Hata durumunda işlemleri geri al ve hata mesajını göster
        $conn->rollBack();
        echo "Ürünü silerken bir hata oluştu: " . $e->getMessage();
    }
}
?>
