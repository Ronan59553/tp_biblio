<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'github';
$username = 'root';
$password = 'sio2024';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date_publi = $_POST['date_publi'];
        $genre = $_POST['genre'];

        // Récupération de l'image téléversée
        if (isset($_FILES['couverture']) && $_FILES['couverture']['error'] == 0) {
            // Vérification de la taille de l'image
            if ($_FILES['couverture']['size'] <= 5000000) { // Limite de 5 Mo
                // Vérification du type de fichier
                $fileInfo = pathinfo($_FILES['couverture']['name']);
                $fileExt = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                
                if (in_array(strtolower($fileExt), $allowedExtensions)) {
                    // Lecture du fichier binaire
                    $imageData = file_get_contents($_FILES['couverture']['tmp_name']);
                } else {
                    echo "<p>Format de fichier non autorisé. Seuls les JPG, JPEG, PNG et GIF sont acceptés.</p>";
                    exit;
                }
            } else {
                echo "<p>Fichier trop volumineux (max 5 Mo).</p>";
                exit;
            }
        } else {
            $imageData = null; // Aucun fichier téléchargé, on insère NULL
        }

        $sql = "SELECT couverture FROM Livres WHERE id_livres = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            header("Content-Type: image/jpeg");
            echo $row['couverture'];
        }

        // Insertion dans la base de données
        $sql = "INSERT INTO Livres (titre, auteur, date_publi, genre, couverture) VALUES (:titre, :auteur, :date_publi, :genre, :couverture)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':date_publi', $date_publi);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':couverture', $imageData, PDO::PARAM_LOB);


        // Exécution de la requête
        if ($stmt->execute()) {
            echo "<p>Livre ajouté avec succès !</p>";
        } else {
            echo "<p>Erreur lors de l'ajout du livre.</p>";
        }
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
    <title>Ajouter un Livre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Formulaire d'ajout de livre -->
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold mb-4">Ajouter un Livre</h1>

        <form action="/TPGITHUB/admin.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="titre" class="block text-lg font-semibold mb-2">Titre du livre</label>
                <input type="text" id="titre" name="titre" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="auteur" class="block text-lg font-semibold mb-2">Auteur</label>
                <input type="text" id="auteur" name="auteur" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="date_publi" class="block text-lg font-semibold mb-2">Date de publication</label>
                <input type="date" id="date_publi" name="date_publi" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-lg font-semibold mb-2">Genre</label>
                <select id="genre" name="genre" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
                    <option value="Aventure">Aventure</option>
                    <option value="Science-fiction">Science-fiction</option>
                    <option value="Roman">Roman</option>
                    <option value="Fantastique">Fantastique</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="couverture" class="block text-lg font-semibold mb-2">Couverture du livre</label>
                <input type="file" id="couverture" name="couverture" accept="image/*" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Ajouter</button>
        </form>

    </div>

</body>
</html>
