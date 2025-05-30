<?php
session_start();
include_once __DIR__ . '/includes/db.php';
include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/nav.php';

// ✅ Verwijderen van product uit winkelwagen direct hier afhandelen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product_id'])) {
    $remove_id = $_POST['remove_product_id'];
    unset($_SESSION['cart'][$remove_id]);
    header("Location: winkelwagen.php");
    exit;
}

// Winkelwagen uitlezen
$cart = $_SESSION['cart'] ?? [];
$total = 0.0;

$products = [];
if (!empty($cart)) {
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE productID IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h1 style="text-align:center; margin-top:30px;">🛒 Winkelwagen</h1>

<?php if (empty($products)): ?>
    <p style="text-align:center;">Je winkelwagen is leeg.</p>
<?php else: ?>
    <table style="width: 90%; margin: 20px auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left;">Product</th>
                <th>Prijs</th>
                <th>Aantal</th>
                <th>Totaal</th>
                <th>Verwijderen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): 
                $id = $product['productID'];
                $qty = $cart[$id];

                // ✅ Prijsberekening met veilige fallback
                $prijs = (floatval($product['product_sale']) > 0)
                    ? floatval($product['product_sale'])
                    : floatval($product['product_price']);

                $subtotaal = $prijs * $qty;
                $total += $subtotaal;
            ?>
            <tr style="border-top: 1px solid #ccc;">
                <td><?= htmlspecialchars($product['product_name']) ?></td>
                <td>&euro; <?= number_format($prijs, 2, ',', '.') ?></td>
                <td><?= $qty ?></td>
                <td>&euro; <?= number_format($subtotaal, 2, ',', '.') ?></td>
                <td>
                    <form method="POST" action="<?= $base_url ?>/winkelwagen.php">
                        <input type="hidden" name="remove_product_id" value="<?= $id ?>">
                        <button type="submit" style="color: red; background:none; border:none; cursor:pointer;">✕</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3 style="text-align: center;">Totaal: &euro; <?= number_format($total, 2, ',', '.') ?></h3>
<?php endif; ?>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
