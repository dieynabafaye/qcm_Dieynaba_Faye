<?php
    session_start();
    unset($_SESSION['trouver']);//détruit la variable session
    unset($_SESSION['point']);
    $_SESSION['trouver']=array();

    function array_melange(&$array) {
        if (is_array($array)) {
            $keys = array_keys($array); // We need this to preserve keys
            $temp = $array;
            $array = NULL;
            shuffle($temp); // Array shuffle
            foreach ($temp as $k => $item) {
                $array[$keys[$k]] = $item;
            }
            return;
        }
        return false;
    }
    $question = file_get_contents('../JSON/peujouer.json');
    $question = json_decode($question, true);
    array_melange($question);
    $contenu = json_encode(array_values($question));
    file_put_contents('../JSON/ListeQuestion.json',$contenu);

    echo "<script type='text/javascript'>document.location.replace('./PageJoueur.php?page=0');</script>";//rediriger vers la page de connexion

?>