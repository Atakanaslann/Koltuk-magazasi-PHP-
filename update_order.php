<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_order'])) {
    $SiparisID = $_POST['SiparisID'];
    $MusteriID = $_POST['MusteriID'];
    $SiparisTarihi = $_POST['SiparisTarihi'];
    $ToplamTutar = $_POST['ToplamTutar'];
    $Durum = $_POST['Durum'];

    $sql = "UPDATE siparisler SET MusteriID = :MusteriID, SiparisTarihi = :SiparisTarihi, ToplamTutar = :ToplamTutar, Durum = :Durum WHERE SiparisID = :SiparisID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':SiparisID', $SiparisID);
    $stmt->bindParam(':MusteriID', $MusteriID);
    $stmt->bindParam(':SiparisTarihi', $SiparisTarihi);
    $stmt->bindParam(':ToplamTutar', $ToplamTutar);
    $stmt->bindParam(':Durum', $Durum);
    
    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit;
    } else {
        echo "Sipariş güncellenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sipariş Düzenle</title>
</head>
<body>
<form action="" method="post">
    <h2>Sipariş Düzenle</h2>
    <label for="SiparisID">Sipariş ID:</label><br>
    <input type="text" id="SiparisID" name="SiparisID" value="<?php echo htmlspecialchars($siparis['SiparisID']); ?>" required><br>
    <label for="MusteriID">Müşteri ID:</label><br>
    <input type="text" id="MusteriID" name="MusteriID" value="<?php echo htmlspecialchars($siparis['MusteriID']); ?>" required><br>
    <label for="SiparisTarihi">Sipariş Tarihi:</label><br>
    <input type="date" id="SiparisTarihi" name="SiparisTarihi" value="<?php echo htmlspecialchars($siparis['SiparisTarihi']); ?>" required><br>
    <label for="ToplamTutar">Toplam Tutar:</label><br>
    <input type="text" id="ToplamTutar" name="ToplamTutar" value="<?php echo htmlspecialchars($siparis['ToplamTutar']); ?>" required><br>
    <label for="Durum">Durum:</label><br>
    <input type="text" id="Durum" name="Durum" value="<?php echo htmlspecialchars($siparis['Durum']); ?>" required><br><br>
    <input type="submit" name="update_order" value="Güncelle">
</form>
</body>
</html>
