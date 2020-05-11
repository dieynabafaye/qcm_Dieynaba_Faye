<?php
    session_start();
    $data = file_get_contents('../JSON/temp.json');
    $data = json_decode($data, true);
    if(!empty($_POST['envoie'])){
        unset($_POST['envoie']);
        $niveau = $_POST['niveau'];
        unset($_POST['niveau']);
        unset($_POST['nbPts']);
        /*************************************************** */
        function valeur_identic( $arrayA , $arrayB){
            sort($arrayA);
            sort($arrayB);
            return $arrayA==$arrayB;
        }
        /************************************************* */

        $question = file_get_contents('../JSON/peujouer.json');
        $question = json_decode($question, true);
       
        $data[$niveau] = $_POST;
        $contenu = json_encode(array_values($data), true);
        file_put_contents('../JSON/temp.json', $contenu);
        unset($_SESSION['vrai']);
        unset($_SESSION['bon']);
        unset($_SESSION['rep']);

        $fin = $_SESSION['limite'];
        unset($_POST['question']);
        unset($_POST['precedent']);
        unset($_POST['type']);
        $tab = $_POST;
        $_SESSION['post']=$tab;
        $_SESSION['message'] = "";
        $tab1=array();
        $verif =  array();

        $jouer = $question[$niveau]['id'];
            if($niveau<$fin-1){
                $pageSuivant = $niveau + 1;
                array_push($_SESSION['questionJouer'],$niveau);
                /********************************************************************************** */
                if($question[$niveau]['reponse']=='choixMultiple' || $question[$niveau]['reponse']=='choixSimple'){
                    if(count($tab)==0){
                        $_SESSION['message']= "Veuillez répondre à cette question!";
                    }
                }
                else{
                    if(empty($_POST['rep'])){
                        $_SESSION['message']= "Veuillez répondre à cette question!";
                    }
                }
                if(!empty($_SESSION['message'])){
                    echo "<script type='text/javascript'>document.location.replace('./PageJoueur.php?page='.$pageSuivant);</script>";
                    unset($_SESSION['message']);

                }else{
                    $monscore = $question[$niveau]['nbPts'];
                    foreach ($tab['rep'] as $key => $value) {
                        array_push($tab1,$value);
                    }
                /********************************************************************* */
                if($question[$niveau]['reponse']=='choixMultiple'){
                    if(count($question[$niveau]['vrais'])==1){
                        $nombre = 1;
                    }
                    else{
                        $nombre = count($question[$niveau]['vrais']);
                    }
                    for($i=0; $i<$nombre; $i++){
                        $bon = $question[$niveau]['vrais'][$i];
                        array_push($verif, $bon);
                    }
                    $resultat =valeur_identic($tab1, $verif);
                    if($resultat==1){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                        array_push($_SESSION['trouver'], $jouer);
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                        
                    }
                }
                elseif($question[$niveau]['reponse']=='choixSimple'){
                    $tab1=$_POST['rep'];
                    $repBon = $question[$niveau]['vrais'];
                    
                    if($tab1==$repBon){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                        array_push($_SESSION['trouver'], $jouer);
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                       
                    }
                }
                else{
                    $repBon = $_POST['rep'];
                    $repVrai = $question[$niveau]['rep'];
                    if($repBon==$repVrai){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                        array_push($_SESSION['trouver'], $jouer);
                    }
                    else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
  
                    }
                }
                echo "<script type='text/javascript'>document.location.replace('./PageJoueur.php?page='.$pageSuivant);</script>";
                    // echo "<script type='text/javascript'>document.location.replace('./joueur.php?page=$t');</script>";
                }
            }
            else{/*******************else final */
                $pageSuivant = $niveau + 1;
                array_push($_SESSION['questionJouer'],$niveau);
                /********************************************************************************** */
                if($question[$niveau]['reponse']=='choixMultiple' || $question[$niveau]['reponse']=='choixSimple'){
                    if(count($tab)==0){
                        $_SESSION['message']= "Veuillez répondre à cette question!";
                       
                    }
                }
                else{
                    if(empty($_POST['rep'])){
                        $_SESSION['message']= "Veuillez répondre à cette question!";
                    }
                }
                if(!empty($_SESSION['message'])){
                    echo "<script type='text/javascript'>document.location.replace('./Terminer.php');</script>";
                    unset($_SESSION['message']);

                }else{
                    $monscore = $question[$niveau]['nbPts'];
                    foreach ($tab as $key => $value) {
                        array_push($tab1,$value);
                    }
                /********************************************************************* */
                if($question[$niveau]['reponse']=='choixMultiple'){
                    if(count($question[$niveau]['vrais'])==1){
                        $nombre = 1;
                    }
                    else{
                        $nombre = count($question[$niveau]['vrais']);
                    }
                    for($i=1; $i<=$nombre; $i++){
                        $bon = $question[$niveau]['vrais'][$i];
                        array_push($verif, $bon);
                    }
                    $resultat =valeur_identic($tab1, $verif);
                    if($resultat==1){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                        array_push($_SESSION['trouver'], $jouer);
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;

                    }
                }
                elseif($question[$niveau]['reponse']=='choixSimple'){
                    $tab1=$_POST['rep'];
                    $repBon = $question[$niveau]['vrais'];
                    
                    if($tab1==$repBon){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                        array_push($_SESSION['trouver'], $jouer);
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                       
                    }
                }
                else{
                    $repBon = $_POST['rep'];
                    $repVrai = $question[$niveau]['rep'];
                    if($repBon==$repVrai){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                        array_push($_SESSION['trouver'], $jouer);
                    }
                    else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                        
                    }
                }
                    echo "<script type='text/javascript'>document.location.replace('./Terminer.php');</script>";
                }
            }

           
    }
    if(!empty($_POST['precedent'])){
        $data = file_get_contents('../JSON/temp.json');
        $data = json_decode($data, true);

        $question = file_get_contents('../JSON/peujouer.json');
        $question = json_decode($question, true);
        $found = array();

        $niveau = $_POST['niveau'];
        if($niveau==0){
            $page = 0;
        }else{
            $page = $niveau-1;
        }
        
        
        $_SESSION['rep'] = "";  
        $score = $question[$page]['nbPts'];
        if($data[$page]['type']=="choixMultiple"){
            $_SESSION['vrai'] = array();
            if(count($data[$page]['rep'])==1){

                $t=$data[$page]['rep'][0];
                array_push($_SESSION['vrai'],$t);
                if(count($question[$page]['rep'])==1){
                    $g=$question[$page]['rep'][0];
                }
                    if($g==$t){
                        $_SESSION['point'] =  $_SESSION['point']  - $score; 
                    }
            }else{
                for($i=0; $i<count($data[$page]['rep']); $i++){
                    $t = $data[$page]['rep'][$i];
                    array_push($_SESSION['vrai'],$t);
                }
                foreach ($question[$page]['vrais'] as $key => $value) {
                    array_push($found, $value);
                }
                $resultat = array_diff($_SESSION['vrai'],$found);
                    if($resultat==false){
                        $_SESSION['point'] =  $_SESSION['point']  - $score;
                    }
            }
        }

        elseif($data[$page]['type']=="choixSimple"){
            $_SESSION['bon'] = "";
            $_SESSION['bon'] = $data[$page]['rep'];
            $d = $question[$page]['vrais'];
            if($d == $_SESSION['bon']){
                $_SESSION['point'] =  $_SESSION['point']  - $score;
            }
                 
        }
        else{
            $_SESSION['rep'] = $data[$page]['rep'];
            $rep = $question[$page]['rep'];
            if($_SESSION['rep']==$rep){
                $_SESSION['point'] =  $_SESSION['point']  - $score;
            }
        }
        echo "<script type='text/javascript'>document.location.replace('./PageJoueur.php?page='.$pageSuivant);</script>";
    }
   
?>