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
                <p class="text-lg mt-2">Consultez les livres disponibles (désolé on a que 3 livres d'un auteur pas foufou)</p>
            </div>
            <!-- Boutons de déconnexion et gestion admin -->
            <div class="flex space-x-4">
            <a href="suppresion.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    Suppresion
                </a>
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
            <!-- Book Card 1 -->
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="Aventure" data-author="Serranouille">
                <img src="images/1.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Au clair de la lune</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Serranouille</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">1967</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Aventure</span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
            <!-- Book Card 2 -->
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="Science-fiction" data-author="Serranon">
                <img src="images/2.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Chasses aux Dragons</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Serranon</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2002</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Science-fiction</span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
            <!-- Book Card 3 -->
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="Roman" data-author="Serranow">
                <img src="images/3.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">La sirène des îles</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Serranow</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2021</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Roman</span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
            <!-- Book Card 4 -->
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="Aventure" data-author="Serranouille">
                <img src="images/4.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Le monde de disney</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Serranouille</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">1985</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Fantastique</span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
            <!-- Book Card 5 -->
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="Science-fiction" data-author="Serranon">
                <img src="images/5.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Dinotirex</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Serranon</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2015</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Science-fiction</span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
            <!-- Book Card 6 -->
            <div class="book-card bg-white shadow-md rounded-lg overflow-hidden" data-genre="Roman" data-author="Serranow">
                <img src="images/6.jpeg" alt="Couverture du livre" class="w-full h-[500px] object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">The 1000</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Serranow</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2010</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Roman</span></p>
                    <div class="mt-4 flex space-x-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Réserver</button>
                    </div>
                </div>
            </div>
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