<?php
    session_start();
    $data = file_get_contents('../JSON/temp.json');
    $data = json_decode($data, true);
    if(!empty($_POST['envoie'])){
        unset($_POST['envoie']);
        $niveau = $_POST['niveau'];
        unset($_POST['niveau']);
        unset($_POST['nbPts']);
        

        $question = file_get_contents('../JSON/ListeQuestion.json');
        $question = json_decode($question, true);
       
        $data[$niveau] = $_POST;
        $contenu = json_encode(array_values($data), true);
        file_put_contents('../JSON/temp.json', $contenu);
        unset($_SESSION['vrai']);
        unset($_SESSION['bon']);
        unset($_SESSION['rep']);

        $fin = count($question);
        unset($_POST['question']);
        unset($_POST['precedent']);
        unset($_POST['type']);
        $tab = $_POST;
        $_SESSION['message'] = "";
        $tab1=array();
        $verif =  array();
        if($question[$niveau]['reponse']=='choixMultiples' || $question[$niveau]['reponse']=='choixSimple'){
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
            header('location: ./Pagejoueur.php?page='.$niveau);
        }else{
            array_push($_SESSION['questionJouer'],$niveau);
            unset($_SESSION['message']);
            
            $pageSuivant = $niveau + 1;
            $monscore = $question[$niveau]['nbPts'];
            foreach ($tab as $key => $value) {
                array_push($tab1,$value);
            }
            if($niveau<$fin-1){
                if($question[$niveau]['reponse']=='choixMultiples'){
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
                    $resultat = array_diff($tab1,$verif);
                    if($resultat==false){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                    }
                }
                elseif($question[$niveau]['reponse']=='choixSimple'){
                    $repBon = $question[$niveau]['vrais'];
                    array_push($verif,$repBon);
                    $resultat = array_diff($tab1,$verif);
                    if($resultat==false){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                    }
                }
                else{
                    $repBon = $_POST['rep'];
                    $repVrai = $question[$niveau]['rep'];
                    if($repBon==$repVrai){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                    }
                    else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                    }
                }
                header('location: ./PageJoueur.php?page='.$pageSuivant);
            }
            else{/*******************else final */
                if($question[$niveau]['reponse']=='choixMultiples'){
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
                    $resultat = array_diff($tab1,$verif);
                    if($resultat==false){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                    }
                }
                elseif($question[$niveau]['reponse']=='choixSimple'){
                    $repBon = $question[$niveau]['vrais'];
                    array_push($verif,$repBon);
                    $resultat = array_diff($tab1,$verif);
                    if($resultat==false){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                    }else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                    }
                }
                else{
                    $repBon = $_POST['rep'];
                    $repVrai = $question[$niveau]['rep'];
                    if($repBon==$repVrai){
                        $_SESSION['point'] =  $_SESSION['point']  + $monscore;
                    }
                    else{
                        $_SESSION['point'] =  $_SESSION['point']  + 0;
                    }
                }
                header('location: ./Terminer.php');
            }

           
        }
    }
    if(!empty($_POST['precedent'])){
        $data = file_get_contents('../JSON/temp.json');
        $data = json_decode($data, true);

        $niveau = $_POST['niveau'];
        if($niveau==0){
            $page = 0;
        }else{
            $page = $niveau-1;
        }
        
        
        $_SESSION['rep'] = "";  
        
        if($data[$page]['type']=="choixMultiples"){
            $_SESSION['vrai'] = array();
            if(count($data[$page]['rep'])==1){
                $t=$data[$page]['rep'][0];
                array_push($_SESSION['vrai'],$t);
            }else{
                for($i=0; $i<count($data[$page]['rep']); $i++){
                    $t = $data[$page]['rep'][$i];
                    array_push($_SESSION['vrai'],$t);
                }
            }
        }
        elseif($data[$page]['type']=="choixSimple"){
            $_SESSION['bon'] = "";
            $_SESSION['bon'] = $data[$page]['rep'];
                 
        }
        else{
            $_SESSION['rep'] = $data[$page]['rep'];
        }
        header('location: ./Pagejoueur.php?page='.$page);
    }
   
?>