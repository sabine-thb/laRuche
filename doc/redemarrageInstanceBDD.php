<?php
require '../vendor/autoload.php';

use Aws\Exception\AwsException;
use Aws\Rds\RdsClient;

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