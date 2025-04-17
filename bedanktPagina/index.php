<?php
include '../includes/productArray.php';
include '../includes/header.php';
include '../includes/nav.php';
?>



<div class="container">
    <div class="popup">
        <img src="/img/vinkje.png" alt="Checkmark">
        <h2>Bedankt voor je bestelling!</h2>
        <p>Hier naast  vind je een overzicht van je bestelling en aflevergegevens.</p>
    </div>

    <div class="summary">
        <h3>Bestelde Producten</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Aantal</th>
                <th>Prijs</th>
            </tr>
            <?php
            $totaal = 0;
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $aantal) {
                    // Zoek het product in de productarray
                    $gevondenProduct = null;
                    foreach ($products as $product) {
                        if ($product['ProductID'] === $productId) {
                            $gevondenProduct = $product;
                            break;
                        }
                    }

                    if ($gevondenProduct) {
                        $prijs = $gevondenProduct['sale'] === 'true' ? $gevondenProduct['salePrice'] : $gevondenProduct['price'];
                        $subtotaal = $prijs * $aantal;
                        $totaal += $subtotaal;
                        echo "<tr>
                                <td>{$gevondenProduct['name']}</td>
                                <td>$aantal</td>
                                <td>€ " . number_format($subtotaal, 2, ',', '.') . "</td>
                              </tr>";
                    } else {
                        echo "<tr>
                                <td colspan='3'>Product met ID $productId niet gevonden.</td>
                              </tr>";
                    }
                }
                echo "<tr>
                        <td colspan='2'><strong>Totaal incl 21% BTW</strong></td>
                        <td><strong>€ " . number_format($totaal, 2, ',', '.') . "</strong></td>
                      </tr>";
            } else {
                echo "<tr><td colspan='3'>Geen producten in winkelmand.</td></tr>";
            }
            ?>
        </table>
    </div>

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

<?php
include '../includes/footer.php';
?>
