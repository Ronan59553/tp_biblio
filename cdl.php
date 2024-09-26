<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'github';
$username = 'root';
$password = 'sio2024';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération de tous les livres dans la base de données
    $sql = "SELECT * FROM Livres";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des Livres Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-600 text-white py-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold">Bibliothèque du pauvres</h1>
                <p class="text-lg mt-2">Consultez les livres disponibles</p>
            </div>
            <div class="flex space-x-4">
                <a href="admin.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Gestion Admin
                </a>
                <a href="index.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Déconnexion
                </a>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-4">
        <div id="books" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($livres as $livre) : ?>
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="<?= htmlspecialchars($livre['genre']) ?>" data-author="<?= htmlspecialchars($livre['auteur']) ?>">
                <!-- Affichage de la couverture si elle existe -->
                <?php if ($livre['couverture']) : ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($livre['couverture']) ?>" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <?php else : ?>
                    <img src="images/default.jpg" alt="Couverture par défaut" class="w-full h-[500px] object-cover">
                <?php endif; ?>
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($livre['titre']) ?></h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold"><?= htmlspecialchars($livre['auteur']) ?></span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold"><?= htmlspecialchars($livre['date_publi']) ?></span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold"><?= htmlspecialchars($livre['genre']) ?></span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
