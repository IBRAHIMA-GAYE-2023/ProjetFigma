<?php
$servername = "localhost";
$username = "root"; // par défaut pour XAMPP
$password = ""; // par défaut pour XAMPP
$dbname = "gestion_figma";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hasher le mot de passe

// Insérer les données dans la base de données
$sql = "INSERT INTO utilisateur (nom, email, mot_de_passe) VALUES ('$nom', '$email', '$mot_de_passe')";

if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie !";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row mt-3">
            <div class="col-lg-4 bg-white m-auto rounded-top">
                <h2 class="text-center">Login</h2>
                <div class="container mt-5">
                    <form action="connexion.php" method="POST">
                        <div class="form-group mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mb-4">   
                            <label for="mot_de_passe">Mot de passe</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Enter your password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">Sign In</button>
                            <p class="text-center mt-2">or</p>
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-light mb-2" onclick="window.location.href='google_auth_url'">Sign up with Google</button>
                        </div>
                    </form>
                    <p class="text-center mt-3"> Si vous n'avez pas un compte?
                        <a href="inscription.html">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>