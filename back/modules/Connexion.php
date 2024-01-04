<?php

require './vendor/autoload.php';

use Aws\Exception\AwsException;
use Aws\Rds\RdsClient;

class Connexion {

    protected static $bdd;

    public function __construct() {

    }

    public static function initConnexion() {
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

            $region = 'eu-west-3';
            $key = 'AKIA2S3VHVIGLJZYU276';
            $secret = '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';

            $nom_instance_rds = 'laruche2';

            try {
                $rdsClient = new RdsClient([
                    'version'     => 'latest',
                    'region'      => $region,
                    'credentials' => [
                        'key'    => $key,
                        'secret' => $secret,
                    ],
                ]);

                // Redémarrer l'instance RDS
                $result = $rdsClient->rebootDBInstance([
                    'DBInstanceIdentifier' => $nom_instance_rds,
                ]);

                die("Redémarrage en cours de l'instance RDS : " . $nom_instance_rds . "\n");
            } catch (AwsException $e) {
                die("Une erreur s'est produite : " . $e->getAwsErrorMessage() . "\n");
            }
        }  
    }

}
