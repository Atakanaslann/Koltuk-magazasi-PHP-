<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CalisanID = $_POST['CalisanID'];
    $Ad = $_POST['Ad'];
    $Soyad = $_POST['Soyad'];
    $Telefon = $_POST['Telefon'];
    $Eposta = $_POST['Eposta'];
    $Departman = $_POST['Departman'];
    $Pozisyon = $_POST['Pozisyon'];
    $Maas = $_POST['Maas'];

    $sql = "UPDATE calisanlar SET Ad = :Ad, Soyad = :Soyad, Telefon = :Telefon, Eposta = :Eposta, Departman = :Departman, Pozisyon = :Pozisyon, Maas = :Maas WHERE CalisanID = :CalisanID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CalisanID', $CalisanID);
    $stmt->bindParam(':Ad', $Ad);
    $stmt->bindParam(':Soyad', $Soyad);
    $stmt->bindParam(':Telefon', $Telefon);
    $stmt->bindParam(':Eposta', $Eposta);
    $stmt->bindParam(':Departman', $Departman);
    $stmt->bindParam(':Pozisyon', $Pozisyon);
    $stmt->bindParam(':Maas', $Maas);
    
    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "Çalışan güncellenirken bir hata oluştu.";
    }
}
?>
