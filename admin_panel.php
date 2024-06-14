<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Salon Koltuk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />

    <link rel="shortcut icon" href="Adsız2.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900|Oswald:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo m-0 p-0"><a href="index.php" class="mb-0">SALON KOLTUK</a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Ürünler</a></li>
                <li><a href="#properties-section" class="nav-link">Çalışanlar</a></li>
                <li><a href="#news-section" class="nav-link">Müşteriler</a></li>
                <li><a href="#contact-section" class="nav-link">Siparişler</a></li>
                <li><a href="#about-section" class="nav-link">Tedarikçiler</a></li>
                <li><a href="logout.php" class="nav-link">Çıkış Yap</a></li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

    
  </div>  
  


  <?php
include 'db.php';

// Ürünü silme işlemi
if(isset($_POST['delete'])) {
    $UrunID = $_POST['UrunID'];
    $sql = "DELETE FROM urunler WHERE UrunID = :UrunID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':UrunID', $UrunID);
    $stmt->execute();
}

// Ürünü güncelleme işlemi
if(isset($_POST['update'])) {
    // Güncellenecek ürünün UrunID'sini al
    $UrunID = $_POST['UrunID'];
    
    // Yönlendirme
    header("Location: edit_product.php?UrunID=$UrunID");
    exit;
}

$sql = "SELECT * FROM urunler";
$stmt = $conn->prepare($sql);
$stmt->execute();
$urunler = $stmt->fetchAll();
?>


<section class="site-section" id="home-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 text-left">
                <h2 class="section-title mb-3">Ürünler Kontrol</h2>
            </div>
        </div>
        
        <div class="row">
            <?php foreach ($urunler as $urun): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $urun['UrunAdi']; ?></h5>
                            <p class="card-text"><strong>Kategori ID:</strong> <?php echo $urun['KategoriID']; ?></p>
                            <p class="card-text"><strong>Fiyat:</strong> <?php echo $urun['Fiyat']; ?></p>
                            <p class="card-text"><strong>Stok Miktarı:</strong> <?php echo $urun['StokMiktari']; ?></p>
                            <p class="card-text"><strong>Renk:</strong> <?php echo $urun['Renk']; ?></p>
                            <p class="card-text"><strong>Malzeme:</strong> <?php echo $urun['Malzeme']; ?></p>
                            <p class="card-text"><strong>Açıklama:</strong> <?php echo $urun['Aciklama']; ?></p>
                            <form action="admin_panel.php" method="post">
                                <input type="hidden" name="UrunID" value="<?php echo $urun['UrunID']; ?>">
                                <button type="submit" name="update" class="btn btn-primary">Düzenle</button>
                                <button type="submit" name="delete" class="btn btn-danger">Sil</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php
include 'db.php';

// Ürün ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $UrunAdi = $_POST['UrunAdi'];
    $KategoriID = $_POST['KategoriID'];
    $Fiyat = $_POST['Fiyat'];
    $StokMiktari = $_POST['StokMiktari'];
    $Renk = $_POST['Renk'];
    $Malzeme = $_POST['Malzeme'];
    $Aciklama = $_POST['Aciklama'];

    // Ürünü ekle
    $sql = "INSERT INTO urunler (UrunAdi, KategoriID, Fiyat, StokMiktari, Renk, Malzeme, Aciklama) VALUES (:UrunAdi, :KategoriID, :Fiyat, :StokMiktari, :Renk, :Malzeme, :Aciklama)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':UrunAdi', $UrunAdi);
    $stmt->bindParam(':KategoriID', $KategoriID);
    $stmt->bindParam(':Fiyat', $Fiyat);
    $stmt->bindParam(':StokMiktari', $StokMiktari);
    $stmt->bindParam(':Renk', $Renk);
    $stmt->bindParam(':Malzeme', $Malzeme);
    $stmt->bindParam(':Aciklama', $Aciklama);
    
    if ($stmt->execute()) {
        echo "Ürün başarıyla eklendi.";
    } else {
        echo "Ürün eklenirken bir hata oluştu.";
    }
}
?>

<!-- Ürün Ekleme Formu -->
<form action="admin_panel.php" method="post" id="1">
    <h2>Ürün Ekle</h2>
    <label for="UrunAdi">Ürün Adı:</label><br>
    <input type="text" id="UrunAdi" name="UrunAdi" required><br>
    <label for="KategoriID">Kategori ID:</label><br>
    <input type="text" id="KategoriID" name="KategoriID" required><br>
    <label for="Fiyat">Fiyat:</label><br>
    <input type="text" id="Fiyat" name="Fiyat" required><br>
    <label for="StokMiktari">Stok Miktarı:</label><br>
    <input type="text" id="StokMiktari" name="StokMiktari" required><br>
    <label for="Renk">Renk:</label><br>
    <input type="text" id="Renk" name="Renk" required><br>
    <label for="Malzeme">Malzeme:</label><br>
    <input type="text" id="Malzeme" name="Malzeme" required><br>
    <label for="Aciklama">Açıklama:</label><br>
    <input type="text" id="Aciklama" name="Aciklama" required><br><br>
    <input type="submit" name="add_product" value="Ürün Ekle">
</form>

        </div>
    </div>
</section>



<?php
include 'db.php';

// Çalışan ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    $Ad = $_POST['Ad'];
    $Soyad = $_POST['Soyad'];
    $Telefon = $_POST['Telefon'];
    $Eposta = $_POST['Eposta'];
    $Departman = $_POST['Departman'];
    $Pozisyon = $_POST['Pozisyon'];
    $Maas = $_POST['Maas'];

    $sql = "INSERT INTO calisanlar (Ad, Soyad, Telefon, Eposta, Departman, Pozisyon, Maas) VALUES (:Ad, :Soyad, :Telefon, :Eposta, :Departman, :Pozisyon, :Maas)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Ad', $Ad);
    $stmt->bindParam(':Soyad', $Soyad);
    $stmt->bindParam(':Telefon', $Telefon);
    $stmt->bindParam(':Eposta', $Eposta);
    $stmt->bindParam(':Departman', $Departman);
    $stmt->bindParam(':Pozisyon', $Pozisyon);
    $stmt->bindParam(':Maas', $Maas);
    
    if ($stmt->execute()) {
        echo "Çalışan başarıyla eklendi.";
    } else {
        echo "Çalışan eklenirken bir hata oluştu.";
    }
}

// Çalışanları listeleme işlemi
$sql = "SELECT * FROM calisanlar";
$stmt = $conn->prepare($sql);
$stmt->execute();
$calisanlar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
<section class="site-section" id="properties-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 text-left">
                <h2 class="section-title mb-3">Çalışanlar Kontrol</h2>
            </div>
        </div>
        <div class="row">
        <table class="table">
          <thead>
              <tr>
                  <th scope="col">Çalışan ID</th>
                  <th scope="col">Ad</th>
                  <th scope="col">Soyad</th>
                  <th scope="col">Telefon</th>
                  <th scope="col">Eposta</th>
                  <th scope="col">Departman</th>
                  <th scope="col">Pozisyon</th>
                  <th scope="col">Maaş</th>
                  <th scope="col">İşlemler</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($calisanlar as $calisan): ?>
                  <tr>
                      <td><?php echo htmlspecialchars($calisan['CalisanID']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Ad']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Soyad']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Telefon']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Eposta']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Departman']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Pozisyon']); ?></td>
                      <td><?php echo htmlspecialchars($calisan['Maas']); ?></td>
                      <td>
                          <form action="edit_employee.php" method="get" style="display: inline;">
                              <input type="hidden" name="id" value="<?php echo $calisan['CalisanID']; ?>">
                              <button type="submit" class="btn btn-primary">Düzenle</button>
                          </form>
                          <form action="delete_employee.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $calisan['CalisanID']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bu çalışanı silmek istediğinizden emin misiniz?');">Sil</button>
                        </form>


                      </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
      </table>

        </div>
        <!-- Çalışan Ekleme Formu -->
        <form action="admin_panel.php" method="post" id="2">
            <h2>Çalışan Ekle</h2>
            <label for="Ad">Ad:</label><br>
            <input type="text" id="Ad" name="Ad" required><br>
            <label for="Soyad">Soyad:</label><br>
            <input type="text" id="Soyad" name="Soyad" required><br>
            <label for="Telefon">Telefon:</label><br>
            <input type="text" id="Telefon" name="Telefon" required><br>
            <label for="Eposta">Eposta:</label><br>
            <input type="email" id="Eposta" name="Eposta" required><br>
            <label for="Departman">Departman:</label><br>
            <input type="text" id="Departman" name="Departman" required><br>
            <label for="Pozisyon">Pozisyon:</label><br>
            <input type="text" id="Pozisyon" name="Pozisyon" required><br>
            <label for="Maas">Maas:</label><br>
            <input type="text" id="Maas" name="Maas" required><br><br>
            <input type="submit" name="add_employee" value="Çalışan Ekle">
        </form>
    </div>
</section>
</body>
</html>


          </div>
        </div>
      </div>
    </section>
    <?php
include 'db.php';

// Müşteri ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_customer'])) {
    $Ad = $_POST['Ad'];
    $Soyad = $_POST['Soyad'];
    $Eposta = $_POST['Eposta'];
    $Telefon = $_POST['Telefon'];
    $Adres = $_POST['Adres'];
    $Sehir = $_POST['Sehir'];
    $Ulke = $_POST['Ulke'];

    $sql = "INSERT INTO musteriler (Ad, Soyad, Eposta, Telefon, Adres, Sehir, Ulke) VALUES (:Ad, :Soyad, :Eposta, :Telefon, :Adres, :Sehir, :Ulke)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Ad', $Ad);
    $stmt->bindParam(':Soyad', $Soyad);
    $stmt->bindParam(':Eposta', $Eposta);
    $stmt->bindParam(':Telefon', $Telefon);
    $stmt->bindParam(':Adres', $Adres);
    $stmt->bindParam(':Sehir', $Sehir);
    $stmt->bindParam(':Ulke', $Ulke);
    
    if ($stmt->execute()) {
        echo "Müşteri başarıyla eklendi.";
    } else {
        echo "Müşteri eklenirken bir hata oluştu.";
    }
}

// Müşterileri listeleme işlemi
$sql = "SELECT * FROM musteriler";
$stmt = $conn->prepare($sql);
$stmt->execute();
$musteriler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="site-section" id="news-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 text-left">
                <h2 class="section-title mb-3">Müşteriler Kontrol</h2>
            </div>
        </div>
        <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Müşteri ID</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Eposta</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Adres</th>
                    <th scope="col">Şehir</th>
                    <th scope="col">Ülke</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($musteriler as $musteri): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($musteri['MusteriID']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Ad']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Soyad']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Eposta']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Telefon']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Adres']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Sehir']); ?></td>
                        <td><?php echo htmlspecialchars($musteri['Ulke']); ?></td>
                        <td>
                            <form action="edit_customer.php" method="get" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $musteri['MusteriID']; ?>">
                                <button type="submit" class="btn btn-primary">Düzenle</button>
                            </form>
                            <form action="delete_customer.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $musteri['MusteriID']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bu müşteriyi silmek istediğinizden emin misiniz?');">Sil</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <!-- Müşteri Ekleme Formu -->
        <form action="admin_panel.php" method="post" id="3">
            <h2>Müşteri Ekle</h2>
            <label for="Ad">Ad:</label><br>
            <input type="text" id="Ad" name="Ad" required><br>
            <label for="Soyad">Soyad:</label><br>
            <input type="text" id="Soyad" name="Soyad" required><br>
            <label for="Eposta">Eposta:</label><br>
            <input type="email" id="Eposta" name="Eposta" required><br>
            <label for="Telefon">Telefon:</label><br>
            <input type="text" id="Telefon" name="Telefon" required><br>
            <label for="Adres">Adres:</label><br>
            <input type="text" id="Adres" name="Adres" required><br>
            <label for="Sehir">Şehir:</label><br>
            <input type="text" id="Sehir" name="Sehir" required><br>
            <label for="Ulke">Ülke:</label><br>
            <input type="text" id="Ulke" name="Ulke" required><br><br>
            <input type="submit" name="add_customer" value="Müşteri Ekle">
        </form>
    </div>
</section>

<?php
include 'db.php';

// Sipariş ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_order'])) {
    $MusteriID = $_POST['MusteriID'];
    $SiparisTarihi = $_POST['SiparisTarihi'];
    $ToplamTutar = $_POST['ToplamTutar'];
    $Durum = $_POST['Durum'];

    $sql = "INSERT INTO siparisler (MusteriID, SiparisTarihi, ToplamTutar, Durum) VALUES (:MusteriID, :SiparisTarihi, :ToplamTutar, :Durum)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MusteriID', $MusteriID);
    $stmt->bindParam(':SiparisTarihi', $SiparisTarihi);
    $stmt->bindParam(':ToplamTutar', $ToplamTutar);
    $stmt->bindParam(':Durum', $Durum);
    
    if ($stmt->execute()) {
        echo "Sipariş başarıyla eklendi.";
    } else {
        echo "Sipariş eklenirken bir hata oluştu.";
    }
}

// Siparişleri listeleme işlemi
$sql = "SELECT * FROM siparisler";
$stmt = $conn->prepare($sql);
$stmt->execute();
$siparisler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<section class="site-section" id="contact-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 text-left">
                <h2 class="section-title mb-3">Siparişler Kontrol</h2>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>SiparisID</th>
                        <th>MusteriID</th>
                        <th>SiparisTarihi</th>
                        <th>ToplamTutar</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siparisler as $siparis): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($siparis['SiparisID']); ?></td>
                            <td><?php echo htmlspecialchars($siparis['MusteriID']); ?></td>
                            <td><?php echo htmlspecialchars($siparis['SiparisTarihi']); ?></td>
                            <td><?php echo htmlspecialchars($siparis['ToplamTutar']); ?></td>
                            <td><?php echo htmlspecialchars($siparis['Durum']); ?></td>
                            <td>
                                <a href="edit_order.php?id=<?php echo $siparis['SiparisID']; ?>" class="btn btn-primary">Düzenle</a>
                                <a href="delete_order.php?id=<?php echo $siparis['SiparisID']; ?>" class="btn btn-danger" onclick="return confirm('Bu siparişi silmek istediğinizden emin misiniz?');">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Sipariş Ekleme Formu -->
        <form action="admin_panel.php" method="post" id="4">
            <h2>Sipariş Ekle</h2>
            <label for="MusteriID">Müşteri ID:</label><br>
            <input type="text" id="MusteriID" name="MusteriID" required><br>
            <label for="SiparisTarihi">Sipariş Tarihi:</label><br>
            <input type="date" id="SiparisTarihi" name="SiparisTarihi" required><br>
            <label for="ToplamTutar">Toplam Tutar:</label><br>
            <input type="text" id="ToplamTutar" name="ToplamTutar" required><br>
            <label for="Durum">Durum:</label><br>
            <input type="text" id="Durum" name="Durum" required><br><br>
            <input type="submit" name="add_order" value="Sipariş Ekle">
        </form>
    </div>
</section>

      <section class="site-section" id="about-section">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-7 text-left">
              <h2 class="section-title mb-3">Tedarikçiler</h2>
            </div>
          </div>
        </div>
      </section>

    
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">HAKKIMIZDA</h2>
                <p>Salon Koltuk Kalitenin Tek Adresi.</p>
              </div>
              <div class="col-md-3 mx-auto">
                <h2 class="footer-heading mb-4">HIZLI ERİŞİM</h2>
                <ul class="list-unstyled">
                  <li><a href="index.php">Anasayfa</a></li>
                </ul>
              </div>
              
            </div>
          </div>
          <div class="col-md-4">
            
            
            <div class="">
              <h2 class="footer-heading mb-4">TAKİP ET</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p class="copyright"><small>&copy; <script>document.write(new Date().getFullYear());</script> Salon Koltuk. Tüm Haklar Saklıdır.</small></p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <a href="#top" class="gototop"><span class="icon-angle-double-up"></span></a> 

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>

  
  <script src="js/main.js"></script>
    
  </body>
</html>