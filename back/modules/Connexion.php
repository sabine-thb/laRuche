<?php

class Connexion
{

    protected static $bdd;

    public function __construct()
    {

    }

    public static function deconnexionBDD()
    {
        Connexion::$bdd = null;
    }

    public static function initConnexion()
    {
        require_once dirname(__DIR__, 2) . '/config.php';

        try {
            Connexion::$bdd = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

            Connexion::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            die("Il y a une erreur de connexion avec la base de données : appel arsene wala \n");

        }
    }

}
