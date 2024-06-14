<?php
include 'db.php';

if (isset($_GET['id'])) {
    $MusteriID = $_GET['id'];
    
    $sql = "SELECT * FROM musteriler WHERE MusteriID = :MusteriID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MusteriID', $MusteriID);
    $stmt->execute();
    $musteri = $stmt->fetch(PDO::FETCH_ASSOC);
}

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

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Müşteri Düzenle</title>
</head>
<body>
<form action="edit_customer.php" method="post">
    <h2>Müşteri Düzenle</h2>
    <input type="hidden" name="MusteriID" value="<?php echo htmlspecialchars($musteri['MusteriID']); ?>">
    <label for="Ad">Ad:</label><br>
    <input type="text" id="Ad" name="Ad" value="<?php echo htmlspecialchars($musteri['Ad']); ?>" required><br>
    <label for="Soyad">Soyad:</label><br>
    <input type="text" id="Soyad" name="Soyad" value="<?php echo htmlspecialchars($musteri['Soyad']); ?>" required><br>
    <label for="Eposta">Eposta:</label><br>
    <input type="email" id="Eposta" name="Eposta" value="<?php echo htmlspecialchars($musteri['Eposta']); ?>" required><br>
    <label for="Telefon">Telefon:</label><br>
    <input type="text" id="Telefon" name="Telefon" value="<?php echo htmlspecialchars($musteri['Telefon']); ?>" required><br>
    <label for="Adres">Adres:</label><br>
    <input type="text" id="Adres" name="Adres" value="<?php echo htmlspecialchars($musteri['Adres']); ?>" required><br>
    <label for="Sehir">Şehir:</label><br>
    <input type="text" id="Sehir" name="Sehir" value="<?php echo htmlspecialchars($musteri['Sehir']); ?>" required><br>
    <label for="Ulke">Ülke:</label><br>
    <input type="text" id="Ulke" name="Ulke" value="<?php echo htmlspecialchars($musteri['Ulke']); ?>" required><br><br>
    <input type="submit" value="Güncelle">
</form>
</body>
</html>
