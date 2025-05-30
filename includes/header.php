<?php
session_start();
include_once __DIR__ . '/config.php';
include_once __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GameWebshop</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./scripts/script.js?<?php echo time(); ?>" defer></script>
</head>
<body>
<header>
    <a href="<?= $base_url ?>/index.php">
        <img src="<?= $base_url ?>/img/logoRodysGame.png" alt="homeLogo" id="headerlogo">
    </a>
    <input type="text" placeholder="Search..">

    <div class="cart-wrapper">
        <button id="cart-button">
            <img src="<?= $base_url ?>/img/winkelmand.png" alt="winkelmand" />
            <span class="cart-count">
                <?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
            </span>
        </button>
        <div class="cart-dropdown">
            <?php
            if (!empty($_SESSION['cart'])) {
                $total = 0;
                $ids = array_keys($_SESSION['cart']);
                $placeholders = rtrim(str_repeat('?,', count($ids)), ',');
                $stmt = $pdo->prepare("SELECT * FROM products WHERE productID IN ($placeholders)");
                $stmt->execute($ids);
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<ul>";
                foreach ($products as $product) {
                    $product_id = $product['productID'];
                    $quantity = $_SESSION['cart'][$product_id];
                    $prijs = $product['product_sale'] ? $product['product_sale'] : $product['product_price'];
                    $totaal_prijs = $prijs * $quantity;
                    $total += $totaal_prijs;

                    echo "<li>";
                    echo "{$product['product_name']} x {$quantity}<br>€" . number_format($totaal_prijs, 2);
                    echo '
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="remove_product_id" value="' . $product_id . '">
                            <button type="submit" class="remove-btn">✕</button>
                        </form>
                    ';
                    echo "</li>";
                }
                echo "</ul>";
                echo "<p><strong>Totaal: €" . number_format($total, 2) . " incl 21% BTW </strong></p>";
                echo '<a href="' . $base_url . '/BestelPagina/index.php"><button class="cart-button">Bestellen</button></a>';
            } else {
                echo "<p>Je winkelwagen is leeg.</p>";
            }
            ?>
        </div>
    </div>
</header>
