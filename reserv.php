<?php
session_start();
require 'config.php'; // Include database connection file

if (!isset($_SESSION['user_id'])) {
    die('Vous devez être connecté pour réserver un livre.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_livre = intval($_POST['id_livre']);
    $id_utilisateur = $_SESSION['user_id'];

    // Check if the book is already reserved by the user
    $stmt = $mysqli->prepare("SELECT * FROM reservations WHERE id_livre = ? AND id_utilisateur = ?");
    $stmt->bind_param('ii', $id_livre, $id_utilisateur);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo 'Vous avez déjà réservé ce livre.';
    } else {
        // Reserve the book
        $stmt = $mysqli->prepare("INSERT INTO reservations (id_livre, id_utilisateur) VALUES (?, ?)");
        $stmt->bind_param('ii', $id_livre, $id_utilisateur);
        if ($stmt->execute()) {
            echo 'Réservation réussie!';
        } else {
            echo 'Erreur lors de la réservation.';
        }
    }
    $stmt->close();
}

$mysqli->close();
?>
