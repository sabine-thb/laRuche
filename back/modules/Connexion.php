<?php

class Connexion {

    protected static $bdd;

    public function __construct() {

    }

    public static function initConnexion() {
        $host = 'laruche2.cah82lrh4zyj.eu-west-3.rds.amazonaws.com';

        //mysql -h laruche.cah82lrh4zyj.eu-west-3.rds.amazonaws.com -P 3306 -u admin -p

        try {
            Connexion::$bdd = new PDO("mysql:host=$host;port=3306;user=admin;password=CouCou&85");

            // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
            Connexion::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }  
    }

}

?>