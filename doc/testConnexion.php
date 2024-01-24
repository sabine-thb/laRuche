<?php

try {
    $a = new PDO ('mysql:host=laruchxsabine.mysql.db; dbname=laruchxsabine;port=3306;charset=utf8', 'laruchxsabine','Sabosh2004');
    // Configurer PDO pour générer des exceptions en cas d'erreurs SQL
    $a->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    var_dump($e);
}