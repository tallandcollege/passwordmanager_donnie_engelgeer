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
    <form action="index.php" method="POST" style="display:inline;">
        <button type="submit" name="home">Terug</button>
    </form>

    <?php
    try {

        $stmt = $pdo->prepare("SELECT * FROM wachtwoorditems WHERE Id = :id");
        $stmt->execute(['id' => $_POST['id']]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    ?>

    <form action="save.php" method="POST">

        <div class="form-group">
            <label for="Gebruikersnaam">Gebruikersnaam</label>
            <input type="text" id="Gebruikersnaam" name="Gebruikersnaam" placeholder="Gebruikersnaam" value="<?php echo $item['Gebruikersnaam']; ?>" required>
        </div>

        <div class="form-group">
            <label for="Wachtwoord">Wachtwoord</label>
            <input type="password" id="Wachtwoord" name="Wachtwoord" placeholder="Wachtwoord" value="<?php echo $item['Wachtwoord']; ?>" required>
        </div>

        <div class="form-group">
            <label for="Url">Url</label>
            <input type="text" id="Url" name="Url" placeholder="Url" value="<?php echo $item['Url']; ?>" required>
        </div>

        <div class="form-group">
            <label for="Opmerking">Opmerking</label>
            <textarea id="Opmerking" name="Opmerking" placeholder="Opmerking"><?php echo $item['Opmerking']; ?></textarea>
        </div>

        <?php $freq = $item['Verversingsfrequentie'] ?? ''; ?>

        <div class="form-group">
            <label for="Wachtwoord-Verversingsfrequentie">Verversingsfrequentie wachtwoord:</label>
            <select id="Wachtwoord-Verversingsfrequentie" name="Wachtwoord-Verversingsfrequentie">
                <option value="" disabled <?php if ($freq === '') echo 'selected'; ?>>Kies een periode</option>
                <option value="7" <?php if ($freq == '7') echo 'selected'; ?>>Elke week</option>
                <option value="14" <?php if ($freq == '14') echo 'selected'; ?>>Elke 2 weken</option>
                <option value="30" <?php if ($freq == '30') echo 'selected'; ?>>Elke maand</option>
                <option value="60" <?php if ($freq == '60') echo 'selected'; ?>>Elke 2 maanden</option>
                <option value="120" <?php if ($freq == '120') echo 'selected'; ?>>Elke 4 maanden</option>
                <option value="180" <?php if ($freq == '180') echo 'selected'; ?>>Elke 6 maanden</option>
                <option value="365" <?php if ($freq == '365') echo 'selected'; ?>>Elk jaar</option>
                <option value="0" <?php if ($freq === '0' || $freq === 0) echo 'selected'; ?>>Nooit</option>
            </select>
        </div>


        <?php $cat = strtolower($item['Categorie'] ?? ''); ?>

        <div class="form-group">
            <label for="Categorie">Categorie:</label>
            <select id="Categorie" name="Categorie">
                <option value="" disabled <?php if ($cat === '') echo 'selected'; ?>>Kies een categorie</option>
                <option value="werk" <?php if ($cat === 'werk') echo 'selected'; ?>>Werk</option>
                <option value="entertainment" <?php if ($cat === 'entertainment') echo 'selected'; ?>>Entertainment</option>
                <option value="reizen" <?php if ($cat === 'reizen') echo 'selected'; ?>>Reizen</option>
                <option value="school" <?php if ($cat === 'school') echo 'selected'; ?>>School</option>
                <option value="overig" <?php if ($cat === 'overig') echo 'selected'; ?>>Overig</option>
            </select>
        </div>

        <input type="hidden" name="Id" value="<?php echo $item['Id']; ?>">

        <input type="hidden" name="action" value="edit">


        <button type="submit">Opslaan</button>
    </form>
</body>

</html>