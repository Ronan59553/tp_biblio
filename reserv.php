<?php
session_start();
require 'config.php'; // Inclure le fichier de connexion à la base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die('Vous devez être connecté pour réserver un livre.');
}

$user_id = $_SESSION['user_id'];

// Récupérez les livres depuis la base de données
$result = $mysqli->query("SELECT * FROM Livres");
while ($row = $result->fetch_assoc()) {
    echo '<div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="' . htmlspecialchars($row['genre']) . '" data-author="' . htmlspecialchars($row['auteur']) . '">';
    echo '<img src="images/' . $row['id_livres'] . '.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">';
    echo '<div class="p-4">';
    echo '<h2 class="text-2xl font-bold mb-2">' . htmlspecialchars($row['titre']) . '</h2>';
    echo '<p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">' . htmlspecialchars($row['auteur']) . '</span></p>';
    echo '<p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">' . htmlspecialchars($row['date_publi']) . '</span></p>';
    echo '<p class="text-gray-700 mb-2">Genre: <span class="font-semibold">' . htmlspecialchars($row['genre']) . '</span></p>';
    // Formulaire de réservation
    echo '<form action="reserve_livre.php" method="POST">';
    echo '<input type="hidden" name="id_livre" value="' . $row['id_livres'] . '">';
    echo '<button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Réserver</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}
?>
