<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './vue_generique.php';

class VueScorcast extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        echo "bienvenu sur l'application Prono BZzzzz<br>";
        echo "connectez vous a votre compte pronostiqueur ou créez en un en deux click ";
    }

}

?>