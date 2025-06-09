<?php
$dsn='mysql:dbname=onligne_schools;host=localhost';
$user='root';
$password='';

try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}
?>