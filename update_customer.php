<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MusteriID = $_POST['MusteriID'];
    $Ad = $_POST['Ad'];
    $Soyad = $_POST['Soyad'];
    $Eposta = $_POST['Eposta'];
    $Telefon = $_POST['Telefon'];
    $Adres = $_POST['Adres'];
    $Sehir = $_POST['Sehir'];
    $Ulke = $_POST['Ulke'];

    $sql = "UPDATE musteriler SET Ad = :Ad, Soyad = :Soyad, Eposta = :Eposta, Telefon = :Telefon, Adres = :Adres, Sehir = :Sehir, Ulke = :Ulke WHERE MusteriID = :MusteriID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MusteriID', $MusteriID);
    $stmt->bindParam(':Ad', $Ad);
    $stmt->bindParam(':Soyad', $Soyad);
    $stmt->bindParam(':Eposta', $Eposta);
    $stmt->bindParam(':Telefon', $Telefon);
    $stmt->bindParam(':Adres', $Adres);
    $stmt->bindParam(':Sehir', $Sehir);
    $stmt->bindParam(':Ulke', $Ulke);
    
    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "Müşteri güncellenirken bir hata oluştu.";
    }
}
?>
