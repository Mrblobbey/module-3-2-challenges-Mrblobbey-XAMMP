<!-- Het inladen van de Header & nav & productArray -->
<?php
include '../includes/header.php';
include '../includes/nav.php';
include '../includes/productArray.php';
?>

<!-- formulier ( verzonden wordt naar bedankt samenvatting) -->
<div id="container">
    <form method="post" action="../bedanktPagina/index.php">
        <div id="orderFrom">
            <h1>Jouw gegevens</h1>
            <h2>Wat moet er op de factuur staan?</h2>

            <div class="form-group">
                <label>Bestel type</label><br>
                <label><input type="radio" name="typebestelling" value="part"> Prive</label>
                <label><input type="radio" name="typebestelling" value="zak"> Zakelijk</label>
            </div>

            <div class="form-group">
                <label>Aanhef</label><br>
                <label><input type="radio" name="aanhef" value="Dhr."> Dhr.</label>
                <label><input type="radio" name="aanhef" value="Mevr."> Mevr.</label>
            </div>

            <div class="form-group">
                <label>Naam:</label>
                <input type="text" name="naam" placeholder="Voornaam">
                <input type="text" name="tussenv" placeholder="Tussenvoegsel">
                <input type="text" name="achternaam" placeholder="Achternaam">
            </div>

            <div class="form-group">
                <label>Postcode:</label>
                <input type="text" name="postcode" placeholder="1234AB">
            </div>

            <div class="form-group">
                <label>Huisnummer:</label>
                <input type="text" name="Huisnummer" placeholder="Nr.">
                <input type="text" name="toev" placeholder="Toev.">
            </div>

            <div class="form-group">
                <label>Land:</label>
                <select name="landen">
                    <option value="NL">Nederland</option>
                    <option value="BE">Belgie</option>
                    <option value="DE">Duitsland</option>
                    <option value="FR">Frankrijk</option>
                    <option value="UK">Engeland</option>
                    <option value="ES">Spanje</option>
                </select>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Email...">
            </div>

            <div class="form-group">
                <label>Telefoonnummer:</label>
                <input type="tel" name="telefoon" placeholder="06-12345678">
            </div>

            <div class="form-group">
                <label>Geboortedatum:</label>
                <input type="date" name="Geboortedatum">
            </div>


            <div class="form-group">
                <button type="submit" class="checkout-button">Bestelling plaatsen</button>
            </div>
        </div>
    </form>
    <!-- winkelwagen -->
    <div id="shoppingCart">
        <h2>Winkelwagen totaal:</h2>
        <?php
        $total = 0;
        if (!empty($_SESSION['cart'])) {
            echo "<ul>";
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                foreach ($products as $product) {
                    if ($product['ProductID'] === $product_id) {
                        $prijs = $product['sale'] === 'true' ? $product['salePrice'] : $product['price'];
                        $totaal_prijs = $prijs * $quantity;
                        $total += $totaal_prijs;

                        echo "<li>{$product['name']} x {$quantity} - €" . number_format($totaal_prijs, 2) . "</li>";
                        break;
                    }
                }
            }
            echo "</ul>";
            echo "<p><strong>Totaal: €" . number_format($total, 2) . " incl 21% BTW</strong></p>";
        } else {
            echo "<p>Je winkelwagen is leeg.</p>";
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>