<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des Livres Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Utilisez cette partie pour votre CSS personnalisé si nécessaire */
    </style>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold">Bibliothèque du pauvres</h1>
                <p class="text-lg mt-2">Consultez les livres disponibles</p>
            </div>
            <!-- Bouton de déconnexion -->
            <a href="index.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
                Déconnexion
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-4">
        <!-- Filter Section -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <!-- Genre Filter -->
                <div class="mb-4 md:mb-0">
                    <label for="genre" class="block text-lg font-semibold mb-2">Filtrer par genre:</label>
                    <select id="genre" class="p-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-600">
                        <option value="">Tous les genres</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Science-fiction">Science-fiction</option>
                        <option value="Roman">Roman</option>
                    </select>
                </div>
                <!-- Author Filter -->
                <div>
                    <label for="author" class="block text-lg font-semibold mb-2">Filtrer par auteur:</label>
                    <select id="author" class="p-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-600">
                        <option value="">Tous les auteurs</option>
                        <option value="Serranouille">Serranouille</option>
                        <option value="Serranon">Serranon</option>
                        <option value="Serranow">Serranow</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Books Section -->
        <div id="books" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Book Cards (dynamically generated with PHP) -->
            <?php
            session_start();
            require 'config.php'; // Include database connection file

            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                die('Vous devez être connecté pour réserver un livre.');
            }

            $user_id = $_SESSION['user_id'];

            // Fetch books from database
            $result = $mysqli->query("SELECT * FROM Livres");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="' . htmlspecialchars($row['genre']) . '" data-author="' . htmlspecialchars($row['auteur']) . '">';
                echo '<img src="images/' . $row['id_livres'] . '.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">';
                echo '<div class="p-4">';
                echo '<h2 class="text-2xl font-bold mb-2">' . htmlspecialchars($row['titre']) . '</h2>';
                echo '<p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">' . htmlspecialchars($row['auteur']) . '</span></p>';
                echo '<p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">' . htmlspecialchars($row['date_publi']) . '</span></p>';
                echo '<p class="text-gray-700 mb-2">Genre: <span class="font-semibold">' . htmlspecialchars($row['genre']) . '</span></p>';
                echo '<form action="reserve_livre.php" method="POST">';
                echo '<input type="hidden" name="id_livre" value="' . $row['id_livres'] . '">';
                echo '<button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Réserver</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Bibliothèque en Ligne. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const genreFilter = document.getElementById('genre');
            const authorFilter = document.getElementById('author');
            const bookCards = document.querySelectorAll('.book-card');

            function filterBooks() {
                const selectedGenre = genreFilter.value;
                const selectedAuthor = authorFilter.value;

                bookCards.forEach(card => {
                    const cardGenre = card.getAttribute('data-genre');
                    const cardAuthor = card.getAttribute('data-author');

                    const genreMatch = !selectedGenre || cardGenre === selectedGenre;
                    const authorMatch = !selectedAuthor || cardAuthor === selectedAuthor;

                    if (genreMatch && authorMatch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            genreFilter.addEventListener('change', filterBooks);
            authorFilter.addEventListener('change', filterBooks);
        });
    </script>

</body>
</html>
