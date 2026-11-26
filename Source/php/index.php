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
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: login.php");
        exit;
    }

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
        <form action="logout.php" method="POST" style="display:inline;">
            <button type="submit">Uitloggen</button>
        </form>
        <br>
        <?php if (!empty($items)): ?>

            <strong>---------------------------------------------------------</strong>
            <?php foreach ($items as $item): ?>
                <div class="item-box">
                    <?php foreach ($item as $column => $value): ?>
                        <div class="info-row">
                            <span class="label"><strong><?php echo htmlspecialchars($column); ?>: </strong></span>
                            <?php if ($column == 'Wachtwoord'): ?>
                                <span class="value" data-password="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>">••••••••</span>
                                <button type="button" onclick="showPassword(this)">Toon</button>
                                <button type="button" onclick="copyPassword(this)">Kopieer</button>
                            <?php else: ?>
                                <span class="value"><?php echo htmlspecialchars($value); ?></span>
                                <?php if ($column == 'Verversingsfrequentie') {
                                    echo ' dagen';
                                } ?>
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>

                    <form action="edit.php" method="POST" style="display:inline;">
                        <button type="submit" id="edit-<?php echo $item['Id']; ?>" name="id" value="<?php echo $item['Id']; ?>">Aanpassen</button>
                    </form>

                    <form action="delete.php" method="POST" style="display:inline;">
                        <button type="submit" id="delete-<?php echo $item['Id']; ?>" name="id" value="<?php echo $item['Id']; ?>">Verwijderen</button>
                    </form>
                    <br>

                    <strong>---------------------------------------------------------</strong>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Geen wachtwoorditems gevonden</p>
        <?php endif; ?>
    </div>
</body>

<script>
    function showPassword(btn) {
        var valueSpan = btn.closest('.info-row').querySelector('.value');

        if (valueSpan.textContent === '••••••••') {
            valueSpan.textContent = valueSpan.dataset.password;
            btn.textContent = 'Verberg';
        } else {
            valueSpan.textContent = '••••••••';
            btn.textContent = 'Toon';
        }
    }

    function copyPassword(btn) {
        var valueSpan = btn.closest('.info-row').querySelector('.value');
        var copyText = valueSpan.dataset.password || valueSpan.textContent.trim();
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(copyText).then(function() {
                btn.textContent = "Gekopieerd!";
                setTimeout(() => btn.textContent = "kopieer", 1500);
            });
        } else {
            // Fallback for plain HTTP (e.g., local IP or custom local domain)
            var textArea = document.createElement("textarea");
            textArea.value = copyText;
            textArea.style.position = "fixed";
            textArea.style.left = "-9999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            btn.textContent = "Gekopieerd!";
            setTimeout(() => btn.textContent = "kopieer", 1500);
        }
    }
</script>