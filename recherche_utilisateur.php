<?php

const BASE_URL = "securité";

require_once("./back/modules/mod_admin/modele_admin.php");

Connexion::initConnexion();

$modele = new ModeleAdmin();

// Récupérer le pseudo de la requête GET
$pseudo = isset($_GET['pseudo']) ? htmlspecialchars($_GET['pseudo']) : '';

$pseudos = $modele->rechercheUser(strtolower($pseudo));

//fermer la connexion
Connexion::deconnexionBDD();

// Retourner les résultats au format JSON
header('Content-Type: application/json');
echo json_encode($pseudos);
