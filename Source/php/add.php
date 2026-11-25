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

    <form action="save.php" method="POST">

        <div class="form-group">
            <label for="Gebruikersnaam">Gebruikersnaam</label>
            <input type="text" id="Gebruikersnaam" name="Gebruikersnaam" placeholder="Gebruikersnaam" required>
        </div>

        <div class="form-group">
            <label for="Wachtwoord">Wachtwoord</label>
            <input type="password" id="Wachtwoord" name="Wachtwoord" placeholder="Wachtwoord" required>
        </div>

        <div class="form-group">
            <label for="Url">Url</label>
            <input type="text" id="Url" name="Url" placeholder="Url" required>
        </div>

        <div class="form-group">
            <label for="Opmerking">Opmerking</label>
            <textarea id="Opmerking" name="Opmerking" placeholder="Opmerking"></textarea>
        </div>

        <div class="form-group">
            <label for="Wachtwoord-Verversingsfrequentie">Verversingsfrequentie wachtwoord:</label>
            <select id="Wachtwoord-Verversingsfrequentie" name="Wachtwoord-Verversingsfrequentie">
                <option value="" disabled selected>Kies een periode</option>
                <option value="7">Elke week</option>
                <option value="14">Elke 2 weken</option>
                <option value="30">Elke maand</option>
                <option value="60">Elke 2 maanden</option>
                <option value="120">Elke 4 maanden</option>
                <option value="180">Elke 6 maanden</option>
                <option value="365">Elk jaar</option>
                <option value="0">Nooit</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Categorie">Categorie:</label>
            <select id="Categorie" name="Categorie">
                <option value="" disabled selected>Kies een categorie</option>
                <option value="werk">Werk</option>
                <option value="entertainment">Entertainment</option>
                <option value="reizen">Reizen</option>
                <option value="school">School</option>
                <option value="overig">Overig</option>
            </select>
        </div>

        <input type="hidden" name="action" value="save">

        <button type="submit">Opslaan</button>
    </form>
</body>

</html>