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

        <form action="add.php" method="POST" style="display:inline;">
            <button type="submit">Toevoegen</button>
        </form>
        <br>
        <?php if (!empty($items)): ?>

            <strong>-------------------------</strong>
            <?php foreach ($items as $item): ?>
                <div class="item-box">
                    <?php foreach ($item as $column => $value): ?>
                        <div class="info-row">
                            <span class="label"><strong><?php echo "$column" ?>: </strong></span>
                            <span class="value"><?php echo "$value" ?></span>
                        </div>

                    <?php endforeach; ?>

                    <form action="edit.php" method="POST" style="display:inline;">
                        <button type="submit" id="edit-<?php echo $item['Id']; ?>" name="id" value="<?php echo $item['Id']; ?>">Aanpassen</button>
                    </form>

                    <form action="delete.php" method="POST" style="display:inline;">
                        <button type="submit" id="delete-<?php echo $item['Id']; ?>" name="id" value="<?php echo $item['Id']; ?>">Verwijderen</button>
                    </form>
                    <br>

                    <strong>-------------------------</strong>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Geen wachtwoorditems gevonden</p>
        <?php endif; ?>
    </div>
</body>