<!-- Het inladen van de Header & nav & productArray -->
<?php
include '../includes/header.php';
include '../includes/nav.php';
include '../includes/db.php';
include '../includes/config.php';

$products = [];
if (!empty($_SESSION['cart'])) {
    $productIds = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE productID IN ($placeholders)");
    $stmt->execute($productIds);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!-- container bedankt pagina -->
<div class="container">
    <div class="popup">
        <img src="<?= $base_url ?>/img/vinkje.png" alt="Checkmark">
        <h2>Bedankt voor je bestelling!</h2>
        <p>Hier naast vind je een overzicht van je bestelling en aflevergegevens.</p>
    </div>

    <div class="summary">
        <h3>Bestelde Producten</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
            <!-- winkelwagen -->
            <?php

            $totaal = 0;
            
            foreach ($_SESSION['cart'] as $productId => $aantal) {
                $gevondenProduct = null;
                foreach ($products as $product) {
                    if ($product['productID'] == $productId) {
                        $gevondenProduct = $product;
                        break;
                    }
                }

                if ($gevondenProduct) {
                    $prijs = (!empty($gevondenProduct['product_sale']) && $gevondenProduct['product_sale'] > 0)
                        ? $gevondenProduct['product_sale']
                        : $gevondenProduct['product_price'];
                    $subtotaal = $prijs * $aantal;
                    $totaal += $subtotaal;
                    echo "<tr>
                            <td>{$gevondenProduct['product_name']}</td>
                            <td>$aantal</td>
                            <td>€ " . number_format($subtotaal, 2, ',', '.') . "</td>
                        </tr>";
                } else {
                    echo "<tr><td colspan='3'>Product met ID $productId niet gevonden.</td></tr>";
                }
            }
            ?>
        </table>
    </div>
    <!-- Samenvatting fomulier van bestelpagina -->
    <div class="delivery-info">
        <h3>Afleveradres</h3>
        <p>
            <?php
            $aanhef = $_POST['aanhef'] ?? '';
            $naam = $_POST['naam'] ?? '';
            $tussen = $_POST['tussenv'] ?? '';
            $achternaam = $_POST['achternaam'] ?? '';
            $postcode = $_POST['postcode'] ?? '';
            $huisnummer = $_POST['Huisnummer'] ?? '';
            $toev = $_POST['toev'] ?? '';
            $land = $_POST['landen'] ?? '';
            $email = $_POST['email'] ?? '';
            $telefoon = $_POST['telefoon'] ?? '';
            $geboorte = $_POST['Geboortedatum'] ?? '';

            echo "$aanhef $naam $tussen $achternaam<br>";
            echo "Postcode: $postcode<br>";
            echo "Huisnummer: $huisnummer $toev<br>";
            echo "Land: $land<br>";
            echo "Email: $email<br>";
            echo "Telefoon: $telefoon<br>";
            echo "Geboortedatum: $geboorte<br>";
            ?>
        </p>
    </div>
</div>
<!-- het in laden van de footer -->
<?php
include '../includes/footer.php';
?>