<?php
    session_start();
    unset($_SESSION['Admin']);//détruit la variable session
    echo "<script type='text/javascript'>document.location.replace('./Login.php');</script>";//rediriger vers la page de connexion

?>