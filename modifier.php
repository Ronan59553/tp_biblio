<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'github';
$username = 'root';
$password = 'sio2024';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si un livre spécifique est demandé via un ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Récupérer les informations actuelles du livre
        $sql = "SELECT * FROM Livres WHERE id_livres = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$livre) {
            echo "Livre introuvable.";
            exit;
        }

        // Si le formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
            $date_publi = $_POST['date_publi'];
            $genre = $_POST['genre'];

            // Gestion de la couverture si elle est modifiée
            if (isset($_FILES['couverture']) && $_FILES['couverture']['error'] == 0) {
                $fileInfo = pathinfo($_FILES['couverture']['name']);
                $fileExt = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($fileExt), $allowedExtensions) && $_FILES['couverture']['size'] <= 5000000) {
                    $imageData = file_get_contents($_FILES['couverture']['tmp_name']);
                } else {
                    echo "<p>Erreur avec le fichier de couverture.</p>";
                    exit;
                }
            } else {
                $imageData = $livre['couverture']; // Si pas de nouvelle image, conserver l'ancienne
            }

            // Mettre à jour les informations du livre
            $sql = "UPDATE Livres SET titre = :titre, auteur = :auteur, date_publi = :date_publi, genre = :genre, couverture = :couverture WHERE id_livres = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->bindParam(':date_publi', $date_publi);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':couverture', $imageData, PDO::PARAM_LOB);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo "<p>Livre mis à jour avec succès !</p>";
                // Rediriger vers la page cdl.php après modification
                header("Location: cdl.php");
                exit;
            } else {
                echo "<p>Erreur lors de la mise à jour du livre.</p>";
            }
        }
    } else {
        echo "Aucun livre sélectionné.";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold mb-4">Modifier le Livre</h1>

        <form action="modifier.php?id=<?= htmlspecialchars($id) ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="titre" class="block text-lg font-semibold mb-2">Titre du livre</label>
                <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="auteur" class="block text-lg font-semibold mb-2">Auteur</label>
                <input type="text" id="auteur" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="date_publi" class="block text-lg font-semibold mb-2">Date de publication</label>
                <input type="date" id="date_publi" name="date_publi" value="<?= htmlspecialchars($livre['date_publi']) ?>" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-lg font-semibold mb-2">Genre</label>
                <select id="genre" name="genre" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
                    <option value="Aventure" <?= $livre['genre'] == 'Aventure' ? 'selected' : '' ?>>Aventure</option>
                    <option value="Science-fiction" <?= $livre['genre'] == 'Science-fiction' ? 'selected' : '' ?>>Science-fiction</option>
                    <option value="Roman" <?= $livre['genre'] == 'Roman' ? 'selected' : '' ?>>Roman</option>
                    <option value="Fantastique" <?= $livre['genre'] == 'Fantastique' ? 'selected' : '' ?>>Fantastique</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="couverture" class="block text-lg font-semibold mb-2">Couverture du livre</label>
                <input type="file" id="couverture" name="couverture" accept="image/*" class="p-2 border-2 border-gray-300 rounded-lg w-full">
                <p class="text-sm text-gray-600">Laissez vide pour conserver l'image actuelle.</p>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
