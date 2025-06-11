<?php
    if(isset($_POST['envoyer'])){
        if(empty($_POST['nom'])){
            echo "<script>alert('Veuillez saisir votre nom !');</script>";
        }
        if(empty($_POST['prenom'])){
            echo "<script>alert('Veuillez saisir votre nom !');</script>";
        }
        elseif(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "Veuillez saisir votre email !";
        }
        elseif(empty($_POST['message'])){
            echo "Veuillez saisir votre message !";
        }
        else{
            require_once 'PHPMailer/sendemail.php';
            echo "<script type=\"text/javascript\">
                alert(' Messege envoyer!');
                document.location.href='http://localhost/onligne_school/index.php';
                </script>";

        }

    }
    else{
        echo "<script type=\"text/javascript\">
    alert('Pour accèder à votre profil, vous devez etre connecte !!');
    document.location.href='login.php';
    </script>";
    }

?>