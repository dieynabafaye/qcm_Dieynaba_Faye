<?php
    session_start();
    $message = array();
    $dejaJouer = array();
    $message['prenom']=$_SESSION['prenom'];
    $message['nom']=$_SESSION['nom'];
    if(empty($_SESSION['point'])){
        $_SESSION['point']=0;
    }else{
        $_SESSION['point']= $_SESSION['point'];
    }
   $score=$_SESSION['point'];
    $message['score']=$_SESSION['point'];
    $user = file_get_contents('../JSON/score.json');
    $user = json_decode($user, true);
    $user[] = $message;
    $user= json_encode($user);
    file_put_contents('../JSON/score.json', $user);
    /************Question jouer*********/
     foreach ($_SESSION['questionJouer'] as $key => $value) {
         array_push($dejaJouer, $value);
     }
    $jouer = file_get_contents('../JSON/QuestionJouer.json');
    $jouer = json_decode($jouer, true);
     $jouer=array_unique($dejaJouer);
     $jouer = json_encode($jouer);
     file_put_contents('../JSON/QuestionJouer.json', $jouer);
    /************************Decoder question.json***********************/
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
    $test=array();
    $question = file_get_contents('../JSON/ListeQuestion.json');
    $question = json_decode($question, true);
    array_melange($question);
    $contenu = json_encode(array_values($question));
    file_put_contents('../JSON/ListeQuestion.json',$contenu);
    /***************************************************************** */
    /******************Temp.json***********************/
    $data = file_get_contents('../JSON/temp.json');
    $data= json_decode($data, true);
     
        unset($data);
   
   
    $contenu = json_encode($test);
    file_put_contents('../JSON/temp.json',$contenu);    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Joueur1.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <title>Terminer</title>
    <style>
        body{
            background-color: #370028;
            color: #FEE7F0;
            text-align: center;
            margin-top: 150px;
            font-size: 40px;
            font-family: 'Josefin Sans';
        }
        .avatar{
            width: 200px;
            height: 200px;
            float: left;
            margin-top: -100px;
            margin-left: 30px;
            border: 1px solid #f8fdfd;
            border-radius: 100px;
            position: relative;
        }
        .avatar img{
            position: absolute;
            top: 0%;
            left: -1%;
        }
        .joueur{
            margin-right: 250px;
        }
        .lien a{
            text-decoration: none;
            color: orange;
        }
        a:hover{
            color: red;
        }
        .lien{
            padding: 50px;
            font-size: 20px;
            float: left;
            font-family: 'Open Sans';
        }
        .buttom{
            margin-top: -250px;
        }
    </style>
</head>
<body>
     <!-- div Avatar-->
     <div class="divAvatar">
        <div class="avatar">
        <?php
            $photo = $_SESSION['avatar'];
            echo "<img class='avatar' src='../IMG/Avatar/$photo' alt='' style='margin-left: -1px;
            margin-top: -1px;'><br><br>";//Image de l'avatar                        
        ?>
    </div>
    <div class="joueur">
        <label for="">Bravo <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'].' '; ?>!</label><br><br>
        <label for="">Votre score est de <?php echo $score ; ?></label>
    </div>
    <div class="lien">
       <i> <a href="./PageJoueur.php?page=0">Cliquez pour rejouer &nbsp;!</a> </i>
    </div>
    <div class="buttom">
        <a href="DeconnexionJ.php"><input type="button" value="Déconnexion" onclick="if(!confirm('Voulez-vous vous déconnecter?'))return false;"></a> <!--affiche boutton deconnexion-->
    </div>
</body>
</html>
<?php
unset($_SESSION['point']);
?>