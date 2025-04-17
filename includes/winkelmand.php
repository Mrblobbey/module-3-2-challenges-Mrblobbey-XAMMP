<?php

include '../includes/productArray.php';

// Winkelwagen initialiseren als hij nog niet bestaat
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Product toevoegen aan winkelwagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Bestaat het product al in de winkelwagen?
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    echo "<p style='color:green;'>Product toegevoegd aan winkelwagen.</p>";
}

// Winkelwagen tonen
echo "<h2>Winkelwagen</h2>";
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
                echo $product['name'] . " - Aantal: $quantity - Prijs: €" . number_format($totaal_prijs, 2);
                echo "</li>";
            }
        }
    }
    echo "</ul>";
    echo "<p><strong>Totaal: €" . number_format($total, 2)  . "</strong></p>";
    echo '<a href="afrekenen.php"><button>Verder naar afrekenen</button></a>';
} else {
    echo "<p>Je winkelwagen is leeg.</p>";
}
?>