<?php
session_start();

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

// Vérifier si les données du formulaire existent
if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?" );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nom'] = $row['nom'];
            echo "Connexion réussie !";
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
} else {
    die("Données du formulaire manquantes.");
}

$conn->close();
?>