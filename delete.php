<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre utilisateur MySQL
$password = "sio2024"; // Le mot de passe de la base de données
$dbname = "github"; // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Supprimer un livre si une demande de suppression est faite
if (isset($_POST['delete'])) {
    $id_livre = $_POST['id_livre'];
    $sql = "DELETE FROM Livres WHERE id_livres = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_livre);
    $stmt->execute();
    $stmt->close();
}

// Récupérer tous les livres
$sql = "SELECT * FROM Livres";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livres</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Bouton revenir en arrière -->
    <a href="index.php" class="absolute top-4 right-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">
        Revenir en arrière
    </a>

    <div class="container mx-auto p-6 mt-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-blue-600 mb-6">Liste des Livres</h1>
        
        <table class="w-full bg-gray-100 border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 border-b">ID</th>
                    <th class="py-3 px-4 border-b">Titre</th>
                    <th class="py-3 px-4 border-b">Auteur</th>
                    <th class="py-3 px-4 border-b">Date de Publication</th>
                    <th class="py-3 px-4 border-b">Genre</th>
                    <th class="py-3 px-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr class='hover:bg-gray-200 transition duration-200'>";
                        echo "<td class='py-3 px-4 border-b'>" . $row['id_livres'] . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . $row['titre'] . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . $row['auteur'] . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . $row['date_publi'] . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . $row['genre'] . "</td>";
                        echo "<td class='py-3 px-4 border-b text-center'>
                            <form method='post' action=''>
                                <input type='hidden' name='id_livre' value='" . $row['id_livres'] . "'>
                                <input type='submit' name='delete' value='Supprimer' class='bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-lg transition-colors duration-300'>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='py-3 px-4 text-center border-b text-gray-500'>Aucun livre trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
