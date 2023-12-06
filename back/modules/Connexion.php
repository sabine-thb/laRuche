<?php

class Connexion {

    protected static $bdd;

    public function __construct() {

    }

    public static function initConnexion() {
        $host = 'laruche.cah82lrh4zyj.eu-west-3.rds.amazonaws.com';
        $dbname = 'admin';

        //mysql -h laruche.cah82lrh4zyj.eu-west-3.rds.amazonaws.com -P 3306 -u admin -p

        try {
            Connexion::$bdd = new PDO("mysql:host=$host;port=3306;user=admin;password=CouCou&85");
            //$pdo = new PDO("mysql:host=localhost;dbname=world", 'my_user', 'my_password');

            // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
            Connexion::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }  
    }

}

?>