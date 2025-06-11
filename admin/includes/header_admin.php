<?php 
    session_start();
    if(!($_SESSION['id_utilisateur']  && $_SESSION['role_utilisateur'] && $_SESSION['role_utilisateur'] == 'Admin')){
        header('location:login.php');

    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin École - Tableau de bord</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Ton CSS -->
  <link rel="stylesheet" href="css/mon_enfant.css">
</head>