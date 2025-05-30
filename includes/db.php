
<?php
$host = 'localhost';            // of je servernaam
$db   = 'webshop';              // ✅ dit moet exact de naam van je database zijn
$user = 'root';                 // of jouw gebruikersnaam
$pass = '';                     // vaak leeg bij lokale omgeving (bijv. XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database verbinding mislukt: " . $e->getMessage());
}
?>