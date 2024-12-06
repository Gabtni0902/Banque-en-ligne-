<?php
session_start();
require_once ('connect.php');
require_once ('user.php');

if (isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $salaire = $_POST['salaire'];

    // Créer une instance de la classe User
    $user = new User($cnx, $nom, $prenom, $email, $phone, $password, $salaire);

    // Inscrire l'utilisateur
    if ($user->signup()) {
        // Rediriger l'utilisateur vers la page de connexion
        header("Location: login.html");
        exit();
    } else {
        echo "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
    }
}
?>
