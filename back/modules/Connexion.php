<?php

class Connexion {

    protected static $bdd;

    public function __construct() {

    }

    public static function initConnexion() {

        try {
            Connexion::$bdd = new PDO ('mysql:host=laruchxsabine.mysql.db; dbname=laruchxsabine;port=3306;charset=utf8', 'laruchxsabine','Sabosh2004');

            // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
            Connexion::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            die("Erreur connection a la base de donné \n");

        }  
    }

}
