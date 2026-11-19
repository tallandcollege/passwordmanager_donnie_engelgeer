<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM wachtwoorditems WHERE Id = :id");
        $stmt->execute([':id' => $id]);

        // Stuur direct terug naar het overzicht (pas index.php aan naar jouw bestandsnaam)
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Fout bij verwijderen: " . $e->getMessage();
    }
} else {
    echo "Geen geldig ID opgegeven.";
}
?>