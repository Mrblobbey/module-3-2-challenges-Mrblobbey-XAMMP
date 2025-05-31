<?php

$logoPath = '../';

include '../includes/db.php';
include '../includes/header.php';
include '../includes/nav.php';

// ✅ Winkelwagen toevoegen (verwerk formulier)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'] ?? 1;

    // Winkelwagen in sessie opslaan
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    // Terug naar productpagina met melding
    header("Location: index.php?id=$productId&added=1");
    exit;
}

// ✅ Ophalen van productgegevens
$productID = isset($_GET['id']) ? $_GET['id'] : null;

if (!$productID) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Geen product-ID opgegeven.</h2>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE productID = ?");
$stmt->execute([$productID]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Product niet gevonden.</h2>";
    exit;
}
?>

<!-- 🖼 Script voor thumbnails -->
<script>
    function changeMainImage(thumbnail) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = thumbnail.src;
    }
</script>

<body>
    <!-- controle Succesmelding -->
    <?php if (isset($_GET['added'])): ?>
        <div style="text-align: center; margin: 20px; color: green;">
            ✅ Product toegevoegd aan winkelwagen!
        </div>
    <?php endif; ?>

    <!-- 🧾 Product container -->
    <section class="container">
        <!-- 📷 Afbeeldingen -->
        <div id="product-images">
            <!-- Grote afbeelding -->
            <div id="product-main-images">
                <img id="main-image"
                     src="<?php echo str_replace('./', '/rodygamestore/', $product['image']); ?>"
                     alt="Main image"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <!-- Kleine thumbnails (3x dezelfde als invulling ivm met missend data) -->
            <div id="product-small-images">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <div>
                        <img src="<?php echo str_replace('./', '/rodygamestore/', $product['image']); ?>"
                             alt="Thumbnail"
                             style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;"
                             onclick="changeMainImage(this)">
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- ℹ️ Productdetails -->
        <div id="product-interaction">
            <div id="product-name"><?php echo htmlspecialchars($product['product_name']); ?></div>
            <div id="product-review-rate">★ <?php echo htmlspecialchars($product['product_review']); ?> / 5</div>
            <div id="product-price">&euro; <?php echo htmlspecialchars($product['product_price']); ?></div>

            <!-- Verzending keuze -->
            <div id="product-code">
                <label>Hoe je je game toegestuurd krijgt:</label>
                <select>
                    <option>Game code</option>
                    <option>Fysiek game</option>
                    <option>Game account</option>
                </select>
            </div>

            <!--  Winkelwagen formulier -->
            <form id="add-to-cart-form" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit">Voeg toe aan winkelwagen</button>
            </form>

            <!-- Extra details -->
            <div id="product-console">
                Console: <?php echo htmlspecialchars($product['product_console']); ?>
            </div>
            <div id="product-categorie">
                <strong><?php echo htmlspecialchars($product['product_categorie']); ?></strong>
            </div>
            <div id="product-description">
                <?php echo nl2br(htmlspecialchars($product['product_description'])); ?>
            </div>
        </div>
    </section>
</body>

<?php include '../includes/footer.php'; ?>
