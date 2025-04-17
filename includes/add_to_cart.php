<?php
session_start();
include 'productArray.php';

// Winkelwagen initialiseren
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// POST-verzoek verwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ✅ Product toevoegen
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }

    // ✅ Product verwijderen
    elseif (isset($_POST['remove_product_id'])) {
        $remove_id = $_POST['remove_product_id'];
        unset($_SESSION['cart'][$remove_id]);
    }
}

// ✅ Winkelmand weergeven
$total = 0;

if (!empty($_SESSION['cart'])) {
    echo "<ul>";
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        foreach ($products as $product) {
            if ($product['ProductID'] === $product_id) {
                $prijs = $product['sale'] === 'true' ? $product['salePrice'] : $product['price'];
                $totaal_prijs = $prijs * $quantity;
                $total += $totaal_prijs;

                echo "<li>";
                echo "{$product['name']} x {$quantity} - €" . number_format($totaal_prijs, 2);
                echo "<button class='remove-btn' data-product-id='" . $product['ProductID'] . "'>✕</button>";
                echo "</li>";
                break;
            }
        }
    }
    echo "</ul>";
    echo "<p><strong>Totaal: €" . number_format($total, 2) . "</strong></p>";
    echo '<a href="/BestelPagina/index.php"><button class="cart-button">Bestellen</button></a>';
} else {
    echo "<p>Je winkelwagen is leeg.</p>";
}
?>
