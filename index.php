<!-- Het inladen van de Header & nav & producten uit de database -->
<?php
include 'includes/header.php';
include 'includes/db.php';  // verbinding met database
include 'includes/nav.php';

$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Hero actie video  -->
<section class="hero">
    <div class="hero-video-wrapper">
        <iframe id="heroVideo"
            src="https://www.youtube.com/embed/pBM2xyco_Kg?autoplay=1&mute=1&loop=1&playlist=pBM2xyco_Kg"
            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <div class="hero-overlay"></div> <!-- Donkere overlay -->
    </div>
    <div class="hero-content">
        <h1>RodysGameShop</h1>
        <p>Welcome to best GameShop around</p>
    </div>
</section>
<!-- Titel games -->
<section class="titlemain">
    <h2>Games </h2>
</section>
<!-- Producten container  -->
<section class="products">
    <?php foreach ($products as $product): ?>
        <a href="./productPagina/index.php?id=<?php echo $product['productID']; ?>" class="product">
            <div class="product-image">
                <!-- Als je geen image in database hebt, tijdelijk placeholder gebruiken -->
                <img src="<?php echo $product['image']; ?>" alt="productImage">
            </div>
            <div class="product-info">
                <h2><?php echo $product['product_name']; ?></h2>
                <p class="price">&euro; <?php echo $product['product_price']; ?> </p>
            </div>
        </a>
    <?php endforeach; ?>

    <!-- Product filter -->
    <div id="filter-container">
        <h3>Filter producten</h3>

        <div class="filter-section">
            <label for="priceRange">Maximale prijs: <span id="priceValue">€90</span></label>
            <input type="range" id="priceRange" name="priceRange" min="0" max="100" value="50">
        </div>

        <div class="filter-section">
            <label for="categorie">Categorie:</label>
            <select id="categorie" name="categorie">
                <option value="all">Alle categorieën</option>
                <option value="actie">Actie</option>
                <option value="avontuur">Avontuur</option>
                <option value="racing">Racing</option>
                <option value="sport">Sport</option>
            </select>
        </div>

        <div class="filter-section">
            <button type="submit">Toon resultaten</button>
        </div>
    </div>
</section>
</body>
<!-- Het inladen van footer content -->
<?php
include 'includes/footer.php';
?>