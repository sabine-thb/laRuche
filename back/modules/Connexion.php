<?php

class Connexion {

    protected static $bdd;

    public function __construct() {

    }

    public static function initConnexion() {
        $host = 'test1.cah82lrh4zyj.eu-west-3.rds.amazonaws.com';
        $dbname = 'postgres';

        try {
            Connexion::$bdd = new PDO("pgsql:dbname=$dbname;host=$host;port=5432;user=postgres;password=CouCou&85");

            // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
            Connexion::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }  
    }

}

?>