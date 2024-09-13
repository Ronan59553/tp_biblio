<?php
$mysqli = new mysqli('localhost', 'votre_utilisateur', 'votre_mot_de_passe', 'GITHUB');

if ($mysqli->connect_error) {
    die('Erreur de connexion (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
