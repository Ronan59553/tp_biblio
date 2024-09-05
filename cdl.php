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
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold">Bibliothèque en Ligne</h1>
            <p class="text-lg mt-2">Consultez les livres disponibles</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-4">
        <!-- Search Bar -->
        <div class="flex justify-center mb-6">
            <input type="text" placeholder="Rechercher un livre..." class="w-full max-w-lg p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:border-blue-600">
        </div>

        <!-- Books Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Book Card 1 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="" alt="Couverture du livre" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Titre du Livre 1</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Auteur 1</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2020</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Roman</span></p>
                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                </div>
            </div>

            <!-- Book Card 2 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Couverture du livre" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Titre du Livre 2</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Auteur 2</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2018</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Science-fiction</span></p>
                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
                </div>
            </div>

            <!-- Book Card 3 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Couverture du livre" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-2">Titre du Livre 3</h2>
                    <p class="text-gray-700 mb-2">Auteur: <span class="font-semibold">Auteur 3</span></p>
                    <p class="text-gray-700 mb-2">Date de publication: <span class="font-semibold">2021</span></p>
                    <p class="text-gray-700 mb-2">Genre: <span class="font-semibold">Biographie</span></p>
                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</button>
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

</body>
</html>