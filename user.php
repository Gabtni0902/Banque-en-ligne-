<?php
class User {

// database connection
private $cnx;

// object properties
private $nom;
private $prenom;
private $email;
private $phone;
private $password;
private $salaire;

// constructor with $db as database connection
public function __construct($db, $nom, $prenom, $email, $phone, $password, $salaire) {
    $this->cnx = $db;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->email = $email;
    $this->phone = $phone;
    $this->password = $password;
    $this->salaire = $salaire;
}

// signup user
public function signup() {
    // Préparer une déclaration SQL pour insérer un nouveau client dans la base de données
    $stmt = $this->cnx->prepare("INSERT INTO clients (nom, prenom, email, telephone, mot_de_passe, salaire) 
    VALUES (:nom, :prenom, :email, :phone, :password, :salaire)");
    $data = array(
        ':nom' => $this->nom,
        ':prenom' => $this->prenom,
        ':email' => $this->email,
        ':phone' => $this->phone,
        ':password' => $this->password,
        ':salaire' => $this->salaire
    );
    $stmt->execute($data);
    return $stmt->rowCount() == 1;
}

// login user
public function login() {
    // Préparer une déclaration SQL pour vérifier les informations d'identification de l'utilisateur
    $stmt = $this->cnx->prepare("SELECT * FROM clients WHERE email = :email");
    $data = array(':email' => $this->email);
    $stmt->execute($data);
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($this->password, $user['mot_de_passe'])) {
            return $user;
        }
    }
    return false;
}
}
?>