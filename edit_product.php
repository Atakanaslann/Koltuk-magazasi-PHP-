<?php
include 'db.php';

if(isset($_GET['UrunID'])) {
    $UrunID = $_GET['UrunID'];

    // Veritabanından belirli ürünü seç
    $sql = "SELECT * FROM urunler WHERE UrunID = :UrunID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':UrunID', $UrunID);
    $stmt->execute();
    $urun = $stmt->fetch();

    // Ürünü düzenleme formu
    echo '<form action="update_product.php" method="post">';
    echo '<input type="hidden" name="UrunID" value="' . $urun['UrunID'] . '">';
    echo 'Ürün Adı: <input type="text" name="UrunAdi" value="' . $urun['UrunAdi'] . '"><br>';
    echo 'Kategori ID: <input type="text" name="KategoriID" value="' . $urun['KategoriID'] . '"><br>';
    echo 'Fiyat: <input type="text" name="Fiyat" value="' . $urun['Fiyat'] . '"><br>';
    echo 'Stok Miktarı: <input type="text" name="StokMiktari" value="' . $urun['StokMiktari'] . '"><br>';
    echo 'Renk: <input type="text" name="Renk" value="' . $urun['Renk'] . '"><br>';
    echo 'Malzeme: <input type="text" name="Malzeme" value="' . $urun['Malzeme'] . '"><br>';
    echo 'Açıklama: <input type="text" name="Aciklama" value="' . $urun['Aciklama'] . '"><br>';
    echo '<input type="submit" value="Güncelle">';
    echo '</form>';
    
}
?>
