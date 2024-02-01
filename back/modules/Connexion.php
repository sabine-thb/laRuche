<?php

class Connexion
{

    protected static $bdd;

    public function __construct()
    {

    }

    public static function initConnexion()
    {

        $host = 'laruche2.cah82lrh4zyj.eu-west-3.rds.amazonaws.com';

        //mysql -h laruche2.cah82lrh4zyj.eu-west-3.rds.amazonaws.com -P 3306 -u admin -p

        //CALL mysql.rds_rotate_general_log;
        //CALL mysql.rds_rotate_slow_log;
        //SELECT count(*) FROM mysql.binary_log;
        //SELECT count(*) FROM mysql.slow_log;

        try {
            Connexion::$bdd = new PDO("mysql:host=$host;port=3306;user=admin;password=CouCou&85");

            // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
            Connexion::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            die("Il y a une erreur de connexion avec la base de données : 
            Veullez vous connexter via http://35.181.154.112 pour relancer la base de donnée \n");

        }
    }

}
