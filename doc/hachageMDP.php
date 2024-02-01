<?php
$option = [
    'cost' => 10,
];

$motDePasse = "Carotte_violette2000.";

$mdp = password_hash($motDePasse, PASSWORD_BCRYPT, $option);

echo $mdp;