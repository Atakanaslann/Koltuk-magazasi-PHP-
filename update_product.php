<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UrunID = $_POST['UrunID'];
    $UrunAdi = $_POST['UrunAdi'];
    $KategoriID = $_POST['KategoriID'];
    $Fiyat = $_POST['Fiyat'];
    $StokMiktari = $_POST['StokMiktari'];
    $Renk = $_POST['Renk'];
    $Malzeme = $_POST['Malzeme'];
    $Aciklama = $_POST['Aciklama'];

    // Ürün bilgilerini güncelle
    $sql = "UPDATE urunler SET UrunAdi = :UrunAdi, KategoriID = :KategoriID, Fiyat = :Fiyat, StokMiktari = :StokMiktari, Renk = :Renk, Malzeme = :Malzeme, Aciklama = :Aciklama WHERE UrunID = :UrunID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':UrunID', $UrunID);
    $stmt->bindParam(':UrunAdi', $UrunAdi);
    $stmt->bindParam(':KategoriID', $KategoriID);
    $stmt->bindParam(':Fiyat', $Fiyat);
    $stmt->bindParam(':StokMiktari', $StokMiktari);
    $stmt->bindParam(':Renk', $Renk);
    $stmt->bindParam(':Malzeme', $Malzeme);
    $stmt->bindParam(':Aciklama', $Aciklama);
    
    if ($stmt->execute()) {
        echo "Ürün başarıyla güncellendi.";
        
    } else {
        echo "Ürün güncellenirken bir hata oluştu.";
    }
    header("Location: admin_panel.php?UrunID=$UrunID");
    exit;
}
?>
