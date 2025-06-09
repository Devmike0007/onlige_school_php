<?php
session_start();
if($_SESSION){
    session_unset();//permet de detruire toute le variable de la session
    session_destroy();
    header('location:../index.php');
}else{
    echo "Vous m'est pas connecté !";

}
?>