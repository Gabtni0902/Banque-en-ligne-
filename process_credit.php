<?php
session_start();
require_once ('connect.php');
require_once ('admin_operations.php');


// Créer une instance de la classe Amin
$admin = new Admin($cnx);

if (isset($_POST['client_id'])) {
    $clientId = $_POST['client_id'];
    $montant = $_POST['montant'];
    
    if (isset($_POST['accorder'])) {
        $admin->accorderCredit($clientId, $montant);
    } elseif (isset($_POST['refuser'])) {
        $admin->refuserCredit($clientId);
    }

    header("Location: admin.php");
    exit();
}
?>
