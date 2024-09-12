<?php

session_start();

$servername = 'localhost';
$username = 'root';
$password = 'sio2024';
$dbname = 'github';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

if (!$mysqli) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// Gestion de l'inscription
if (isset($_POST["submitAll"])) {
    $nom = mysqli_real_escape_string($mysqli, $_POST['nom']);
    $prenom = mysqli_real_escape_string($mysqli, $_POST['prenom']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);  // Hachage du mot de passe

    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) 
            VALUES ('$nom', '$prenom', '$email', '$mdp')";

    if ($mysqli->query($sql) === TRUE) {
        $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } else {
        $message = "Erreur: " . $sql . "<br>" . $mysqli->error;
    }
}

// Gestion de la connexion
if (isset($_POST["submitLogin"])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Vérification du mot de passe
        if (password_verify($password, $user['mot_de_passe'])) {
            // Mot de passe correct, démarrage de la session
            $_SESSION['user'] = $user['email'];
            // Redirection vers la page de bienvenue
            header("Location: cdl.php");
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Aucun compte trouvé avec cet email.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion et Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        
        <!-- Affiche un message après l'inscription -->
        <?php if (isset($message)): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Affiche un message d'erreur en cas de connexion échouée -->
        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form id="login-form" method="POST" class="space-y-6">
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
                <button type="submit" name="submitLogin" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Se connecter
                </button>
            </div>
            <div class="text-center">
                <a href="#" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
            </div>
        </form>
        
        <!-- Formulaire d'inscription -->
        <form id="register-form" method="POST" class="space-y-6 mt-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Créer un compte</h2>
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="nom" name="nom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre nom complet" required>
            </div>
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre prénom" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Entrez votre email" required>
            </div>
            <div>
                <label for="mdp" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1" placeholder="Créez un mot de passe" required>
            </div>
            <div>
                <button type="submit" name="submitAll" class="w-full py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</body>
</html>
