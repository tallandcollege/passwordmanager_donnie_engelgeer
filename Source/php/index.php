<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWmanager</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once 'db.php'; ?>
    <h1>PWmanager</h1>

    <?php
    try {
    
    $stmt = $pdo->query("SELECT * FROM wachtwoorditems");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
    <div class="box-container">
        <?php if (!empty($items)): ?>
            
            <strong>-------------------------</strong>
            <?php foreach ($items as $item): ?>
                <div class="item-box">
                    <?php foreach ($item as $column => $value): ?>
                        <div class="info-row">
                            <span class="label"><strong><?= htmlspecialchars($column) ?>: </strong></span>
                            <span class="value"><?= htmlspecialchars($value ?? '') ?></span>
                        </div>
                    <?php endforeach; ?>
                    <strong>-------------------------</strong>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Geen wachtwoorditems gevonden</p>
        <?php endif; ?>
    </div>
</body>