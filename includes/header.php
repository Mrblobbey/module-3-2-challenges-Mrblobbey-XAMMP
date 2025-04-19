<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GameWebshop</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="script.js?v<?php echo time(); ?>" defer></script>
    <script src="/scripts/script.js?v=<?php echo time(); ?>" defer></script>

</head>
<body>
<header>
    <a href=" /index.php">
        <img src="/img/logoRodysGame.png" alt="homeLogo" id="headerlogo">
    </a>
    <input type="text" placeholder="Search..">
    <!-- winkelwagen  -->
        <?php session_start(); ?>
    <div class="cart-wrapper">
        <button id="cart-button">
            <img src="/img/winkelmand.png" alt="winkelmand" />
            <span class="cart-count">
                <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
            </span>
        </button>
        <div class="cart-dropdown">
            <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/productArray.php';

            if (!empty($_SESSION['cart'])) {
                $total = 0;
                echo "<ul>";
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    foreach ($products as $product) {
                        if ($product['ProductID'] === $product_id) {
                            $prijs = $product['sale'] === 'true' ? $product['salePrice'] : $product['price'];
                            $totaal_prijs = $prijs * $quantity;
                            $total += $totaal_prijs;

                            echo "<li>";
                            echo "{$product['name']} x {$quantity}<br>€" . number_format($totaal_prijs, 2);
                            echo '
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="remove_product_id" value="' . $product['ProductID'] . '">
                                    <button type="submit" class="remove-btn">✕</button>
                                </form>
                            ';
                            echo "</li>";
                            break;
                        }
                    }
                }
                echo "</ul>";
                echo "<p><strong>Totaal: €" . number_format($total, 2) . " incl 21% BTW </strong></p>";
                echo '<a href="/BestelPagina/index.php"><button class="cart-button">Bestellen</button></a>';
            } else {
                echo "<p>Je winkelwagen is leeg.</p>";
            }
            ?>
        </div>
    </div>
</header>
