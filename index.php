<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion et Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showForm(formType) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');

            if (formType === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginTab.classList.add('border-blue-600', 'text-blue-600');
                registerTab.classList.remove('border-blue-600', 'text-blue-600');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                registerTab.classList.add('border-blue-600', 'text-blue-600');
                loginTab.classList.remove('border-blue-600', 'text-blue-600');
            }
        }
    </script>
    <?php
    // Connexion à la base de données
    $host = 'localhost';
    $dbname = 'GITHUB'; 
    $username = 'root';
    $password = 'sio2024';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        
        $nom = $_POST['register-name'];
        $prenom = $_POST['register-prenom'];
        $email = $_POST['register-email'];
        $password = $_POST['register-password'];

        // Hachage du mot de passe pour sécurité
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Préparer et exécuter la requête SQL
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
        $stmt = $pdo->prepare($sql);

        // Lier les valeurs
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $hashedPassword);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
    
    
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        echo "Connexion réussie !";
        // Redirection vers une page protégée
        // header("Location: dashboard.php");
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>


</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Container -->
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <!-- Tabs -->
        <div class="flex justify-center mb-6">
            <button id="login-tab" onclick="showForm('login')" class="px-4 py-2 w-1/2 border-b-2 text-center border-blue-600 text-blue-600 font-semibold">Connexion</button>
            <button id="register-tab" onclick="showForm('register')" class="px-4 py-2 w-1/2 border-b-2 text-center">Inscription</button>
        </div>

        <!-- Login Form -->
        <form id="login-form" class="space-y-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Se connecter</h2>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre email" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre mot de passe" required>
            </div>
            <div>
                <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Se connecter
                </button>
            </div>
            <div class="text-center">
                <a href="#" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
            </div>
        </form>

        <!-- Register Form (initially hidden) -->
        <form id="register-form" class="space-y-6 hidden">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Créer un compte</h2>
            <div>
                <label for="register-name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="register-name" name="register-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre nom complet" required>
            </div>
            <div>
                <label for="register-name" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="register-name" name="register-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre nom complet" required>
            </div>
            <div>
                <label for="register-email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="register-email" name="register-email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre email" required>
            </div>
            <div>
                <label for="register-password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="register-password" name="register-password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Créez un mot de passe" required>
            </div>
            <div>
                <button type="submit" class="w-full py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>

</body>
</html>
