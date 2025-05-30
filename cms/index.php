<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMS Productoverzicht</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <header class="cms-header">
    <h1>Productbeheer</h1>
    <a href="add.php" class="btn primary">+ Nieuw product</a>
  </header>

  <main class="product-table-wrapper">
    <table class="product-table">
      <thead>
        <tr>
          <th>Afbeelding</th>
          <th>Naam</th>
          <th>Prijs</th>
          <th>Categorie</th>
          <th>Console</th>
          <th>Voorraad</th>
          <th>Acties</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../includes/db.php';
        $stmt = $pdo->query("SELECT * FROM products ORDER BY product_name ASC");
        $products = $stmt->fetchAll();

        foreach ($products as $product): ?>
          <tr>
            <td>
              <?php if ($product['image']): ?>
                <img src="<?= str_replace('./', '/rodygamestore/', $product['image']) ?>" class="thumb">
              <?php else: ?>
                <span class="thumb placeholder">Geen</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($product['product_name']) ?></td>
            <td>€<?= number_format($product['product_price'], 2) ?>
              <?php if ($product['product_sale']): ?><span class="badge">Sale</span><?php endif; ?>
            </td>
            <td><?= htmlspecialchars($product['product_categorie']) ?></td>
            <td><?= htmlspecialchars($product['product_console']) ?></td>
            <td><?= $product['product_quantity'] ?></td>
            <td>
              <a href="edit.php?id=<?= $product['productID'] ?>" class="btn small">Bewerken</a>
              <a href="delete.php?id=<?= $product['productID'] ?>" class="btn small danger" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">Verwijderen</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</body>
</html>