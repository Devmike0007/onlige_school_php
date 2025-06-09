<?php 
    session_start();
    if(!($_SESSION['id_utilisateur']  && $_SESSION['role_utilisateur'] && $_SESSION['role_utilisateur'] == 'Admin')){
        header('location:login.php');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./images/fond_et_illustraction/illustration/icon/pile-de-livres.png">
    <link rel="stylesheet" href="./css/index.css">
    <title>Admin</title>
</head>