<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];
    $url = $_POST['Url'];
    $opmerking = $_POST['Opmerking'] ?? '';
    $frequentie = $_POST['Wachtwoord-Verversingsfrequentie'] ?? 0;
    $categorie = $_POST['Categorie'] ?? 'overig';

    try {
        $sql = "";
        $params = [
            ':gebruikersnaam' => $gebruikersnaam,
            ':wachtwoord'     => $wachtwoord,
            ':url'            => $url,
            ':opmerking'      => $opmerking,
            ':frequentie'     => $frequentie,
            ':categorie'      => $categorie
        ];

        if ($_POST['action'] == "save") {
            $sql = "INSERT INTO wachtwoorditems
                    (gebruikersnaam, wachtwoord, url, opmerking, verversingsfrequentie, categorie) 
                    VALUES 
                    (:gebruikersnaam, :wachtwoord, :url, :opmerking, :frequentie, :categorie)";
        } else if ($_POST['action'] == "edit") {
            $sql = "UPDATE wachtwoorditems SET
                    gebruikersnaam = :gebruikersnaam,
                    wachtwoord = :wachtwoord,
                    url = :url,
                    opmerking = :opmerking,
                    verversingsfrequentie = :frequentie,
                    categorie = :categorie
                    WHERE Id = :id";
            $params[':id'] = $_POST['Id'];
        }

        $stmt = $pdo->prepare($sql);

        // 3. Execute the query safely
        $stmt->execute($params);

        echo "Gegevens succesvol opgeslagen!";
        echo '<br><form action="index.php" method="POST" style="display:inline;">
        <button type="submit">Home</button>
      </form>';

    } catch (PDOException $e) {
        echo "Fout bij opslaan: " . $e->getMessage();
    }
}
