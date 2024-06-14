<?php
// Oturumu sonlandır
session_start();
session_destroy();

// Kullanıcıyı başka bir sayfaya yönlendir (örneğin, giriş sayfasına)
header("Location: index.php");
exit;
?>
