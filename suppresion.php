<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_livre'])) {
    $id_livre = intval($_POST['id_livre']);

    // Vérifier que l'ID du livre est valide
    if ($id_livre > 0) {
        // Connexion à la base de données
        $connexion = new mysqli("localhost", "root", "", "github");

        // Vérifier la connexion
        if ($connexion->connect_error) {
            die("Connexion échouée: " . $connexion->connect_error);
        }

        // Préparer la requête pour supprimer le livre
        $stmt = $connexion->prepare("DELETE FROM Livres WHERE id_livres = ?");
        $stmt->bind_param("i", $id_livre);

        if ($stmt->execute()) {
            echo "Le livre a été supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du livre : " . $stmt->error;
        }

        // Fermer la connexion
        $stmt->close();
        $connexion->close();
    } else {
        echo "ID de livre invalide.";
    }
} else {
    echo "Aucun livre sélectionné.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de Livre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-12">
        <h1 class="text-3xl font-bold mb-6">Suppression d'un Livre</h1>

        <!-- Formulaire pour sélectionner le livre à supprimer -->
        <form action="supprimer_livre.php" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <label for="id_livre" class="block text-lg font-semibold mb-2">Sélectionnez un livre à supprimer :</label>
            <select name="id_livre" id="id_livre" class="p-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-red-600 w-full mb-4">
                <option value="">-- Sélectionnez un livre --</option>
                <?php
                // Connexion à la base de données
                $connexion = new mysqli("localhost", "root", "", "github");

                // Vérifier la connexion
                if ($connexion->connect_error) {
                    die("Connexion échouée: " . $connexion->connect_error);
                }

                // Récupérer la liste des livres disponibles
                $resultat = $connexion->query("SELECT id_livres, titre FROM Livres");

                // Afficher chaque livre dans la liste déroulante
                while ($livre = $resultat->fetch_assoc()) {
                    echo '<option value="' . $livre['id_livres'] . '">' . $livre['titre'] . '</option>';
                }

                // Fermer la connexion
                $connexion->close();
                ?>
            </select>

            <!-- Bouton pour supprimer le livre -->
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                Supprimer
            </button>
        </form>
    </div>
</body>
</html>
