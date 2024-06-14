<?php
include 'db.php';

if (isset($_GET['id'])) {
    $CalisanID = $_GET['id'];
    
    $sql = "SELECT * FROM calisanlar WHERE CalisanID = :CalisanID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CalisanID', $CalisanID);
    $stmt->execute();
    $calisan = $stmt->fetch(PDO::FETCH_ASSOC);
}

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

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Çalışan Düzenle</title>
</head>
<body>
<form action="edit_employee.php" method="post">
    <h2>Çalışan Düzenle</h2>
    <input type="hidden" name="CalisanID" value="<?php echo htmlspecialchars($calisan['CalisanID']); ?>">
    <label for="Ad">Ad:</label><br>
    <input type="text" id="Ad" name="Ad" value="<?php echo htmlspecialchars($calisan['Ad']); ?>" required><br>
    <label for="Soyad">Soyad:</label><br>
    <input type="text" id="Soyad" name="Soyad" value="<?php echo htmlspecialchars($calisan['Soyad']); ?>" required><br>
    <label for="Telefon">Telefon:</label><br>
    <input type="text" id="Telefon" name="Telefon" value="<?php echo htmlspecialchars($calisan['Telefon']); ?>" required><br>
    <label for="Eposta">Eposta:</label><br>
    <input type="email" id="Eposta" name="Eposta" value="<?php echo htmlspecialchars($calisan['Eposta']); ?>" required><br>
    <label for="Departman">Departman:</label><br>
    <input type="text" id="Departman" name="Departman" value="<?php echo htmlspecialchars($calisan['Departman']); ?>" required><br>
    <label for="Pozisyon">Pozisyon:</label><br>
    <input type="text" id="Pozisyon" name="Pozisyon" value="<?php echo htmlspecialchars($calisan['Pozisyon']); ?>" required><br>
    <label for="Maas">Maas:</label><br>
    <input type="text" id="Maas" name="Maas" value="<?php echo htmlspecialchars($calisan['Maas']); ?>" required><br><br>
    <input type="submit" value="Güncelle">
</form>
</body>
</html>
