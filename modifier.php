<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'github';
$username = 'root';
$password = 'sio2024';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifie si l'ID du livre est passé en GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Récupère les informations actuelles du livre
        $sql = "SELECT * FROM Livres WHERE id_livres = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$livre) {
            echo "Livre non trouvé";
            exit;
        }
    } else {
        echo "Aucun livre sélectionné.";
        exit;
    }

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date_publi = $_POST['date_publi'];
        $genre = $_POST['genre'];

        // Gestion de l'image
        if (isset($_FILES['couverture']) && $_FILES['couverture']['error'] == 0) {
            $imageData = file_get_contents($_FILES['couverture']['tmp_name']);
        } else {
            // Si aucune nouvelle image n'est envoyée, on garde l'ancienne
            $imageData = $livre['couverture'];
        }

        // Mise à jour dans la base de données
        $sql = "UPDATE Livres SET titre = :titre, auteur = :auteur, date_publi = :date_publi, genre = :genre, couverture = :couverture WHERE id_livres = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':date_publi', $date_publi);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':couverture', $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Livre modifié avec succès !";
        } else {
            echo "Erreur lors de la modification du livre.";
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
    <title>Modifier un Livre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold mb-4">Modifier un Livre</h1>

        <form action="modifier.php?id=<?php echo $livre['id_livres']; ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="titre" class="block text-lg font-semibold mb-2">Titre du livre</label>
                <input type="text" id="titre" name="titre" value="<?php echo $livre['titre']; ?>" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="auteur" class="block text-lg font-semibold mb-2">Auteur</label>
                <input type="text" id="auteur" name="auteur" value="<?php echo $livre['auteur']; ?>" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="date_publi" class="block text-lg font-semibold mb-2">Date de publication</label>
                <input type="date" id="date_publi" name="date_publi" value="<?php echo $livre['date_publi']; ?>" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-lg font-semibold mb-2">Genre</label>
                <select id="genre" name="genre" required class="p-2 border-2 border-gray-300 rounded-lg w-full">
                    <option value="Aventure" <?php if($livre['genre'] == 'Aventure') echo 'selected'; ?>>Aventure</option>
                    <option value="Science-fiction" <?php if($livre['genre'] == 'Science-fiction') echo 'selected'; ?>>Science-fiction</option>
                    <option value="Roman" <?php if($livre['genre'] == 'Roman') echo 'selected'; ?>>Roman</option>
                    <option value="Fantastique" <?php if($livre['genre'] == 'Fantastique') echo 'selected'; ?>>Fantastique</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="couverture" class="block text-lg font-semibold mb-2">Couverture</label>
                <input type="file" id="couverture" name="couverture" class="p-2 border-2 border-gray-300 rounded-lg w-full">
                <!-- Afficher l'image actuelle si disponible -->
                <?php if ($livre['couverture']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($livre['couverture']); ?>" alt="Couverture actuelle" class="mt-4">
                <?php endif; ?>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Modifier</button>
        </form>
    </div>

</body>
</html>
