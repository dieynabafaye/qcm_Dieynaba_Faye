<?php
    session_start();
    unset($_SESSION['Admin']);//détruit la variable session
    header('location:Login.php');//rediriger vers la page de connexion

?>