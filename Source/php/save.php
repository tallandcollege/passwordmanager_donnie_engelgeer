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
        $sql = "INSERT INTO wachtwoorditems
                (gebruikersnaam, wachtwoord, url, opmerking, verversingsfrequentie, categorie) 
                VALUES 
                (:gebruikersnaam, :wachtwoord, :url, :opmerking, :frequentie, :categorie)";
        
        $stmt = $pdo->prepare($sql);

        // 3. Execute the query safely
        $stmt->execute([
            ':gebruikersnaam' => $gebruikersnaam,
            ':wachtwoord'     => $wachtwoord,
            ':url'            => $url,
            ':opmerking'      => $opmerking,
            ':frequentie'     => $frequentie,
            ':categorie'      => $categorie
        ]);

        echo "Gegevens succesvol opgeslagen!";
    } catch (PDOException $e) {
        echo "Fout bij opslaan: " . $e->getMessage();
    }
}
?>
