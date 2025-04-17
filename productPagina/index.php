<?php
    include '../includes/productArray.php';
    include '../includes/header.php';
    include '../includes/nav.php';

    	

    $index = 0;

    if(isset($_GET['id'])){
        $index = $_GET['id'];
    }

    $product = $products[$index];
?>
    <script>
    function changeMainImage(thumbnail) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = thumbnail.src;
    }
    </script>
    <body>
        <section class="container">
        <!-- Product Afbeeldingen -->
              <div id="product-images">
              <div id="product-main-images">
                    <img id="main-image" src=".<?php echo $product['image']; ?>" alt="Main image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div id="product-small-images">
                    <?php
                    foreach($product['images'] as $image){
                        ?>
                        <div>
                            <img 
                                src=".<?php echo $image; ?>" 
                                alt="Thumbnail" 
                                style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;" 
                                onclick="changeMainImage(this)">
                        </div>
                        <?php
                    }
                    ?>
                </div>

        </div>

        <!-- Product Info en Interactie -->
        <div id="product-interaction">
            <div id="product-name"><?php echo $product['name']; ?></div>
            <div id="product-review-rate">★ <?php echo $product['reviews']; ?> / 5</div>
            <div id="product-price">
                 &euro; <?php echo $product['price']; ?> 
            </div>
            <div id="product-code">
                <label>Hoe je je game toegestuurd krijgt:</label>
                <select>
                    <option>Game code</option>
                    <option>Fysiek game</option>
                    <option>Game account</option>
                </select>
            </div>

            <form id="add-to-cart-form">
                <input type="hidden" name="product_id" value="<?php echo $product['ProductID']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit">Voeg toe aan winkelwagen</button>
            </form>

            <!-- Winkelmand container die we gaan vullen -->
            <div id="cart-dropdown-container" class="cart-dropdown"></div>
            
            <div id="product-console">
            Console:<?php echo $product['console']; ?><br>
            </div>
            <div id="product-categorie">
                <strong><?php echo $product['categorie']; ?></strong>
            </div>
            <div id="product-description">
                <?php echo $product['description']; ?>
            </div>
        </div>

        </section>
    </body>
<?php
    include '../includes/footer.php';
?>