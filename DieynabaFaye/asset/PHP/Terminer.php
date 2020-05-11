<?php
    session_start();    
    $dejaJouer = array();
    
    /**************************************************************** */
    $id=$_SESSION['login'];
    $trouver = file_get_contents('../JSON/trouver.json');
    $trouver= json_decode($trouver, true);
    $t=0;
        $test=0;
        $samatest=array();
        foreach ($_SESSION['trouver'] as $indice => $contenu) {
        array_push($samatest,$contenu);
        }
        
        if(!empty($trouver)){
        foreach ($trouver as $key => $value) {
            foreach ($value as $clef => $valeur) {
                if($clef==$id){
                    $test=1;
                    $position=$key;   
                }
        
            }
        }
          
        
        if($test==1){
            $quesjouer=$trouver[$position][$id];
            for ($i=0; $i <count($samatest) ; $i++) { 
                $po=$samatest[$i];
                if(!in_array($po,$trouver[$position][$id])){
                    array_push($trouver[$position][$id],$po);
                }
            }
             $contenu=json_encode($trouver);
             file_put_contents('../JSON/trouver.json',$contenu);
        }else{

            $tab=array($id=>$_SESSION['trouver']);
            array_push($trouver,$tab);
            $contenu=json_encode($trouver);
            file_put_contents('../JSON/trouver.json',$contenu);
        }
    
    }else{

        $tab=array($id=>$_SESSION['trouver']);
        echo "<br>";            
        array_push($trouver,$tab);
        $contenu=json_encode($trouver);
        file_put_contents('../JSON/trouver.json',$contenu);
    }
       /***************************************************************** */
    $message = array();
    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];
    $message['prenom']=$_SESSION['prenom'];
    $message['nom']=$_SESSION['nom'];
    if(empty($_SESSION['point'])){
        $_SESSION['point']=0;
    }else{
        $_SESSION['point']= $_SESSION['point'];
    }
   $_SESSION['point'] = $score;
    $message['score']=$_SESSION['point'];
    $user = file_get_contents('../JSON/score.json');
    $user = json_decode($user, true);
   $p=0;
    /******************************************************************************* */
    if(!empty($user)){
    foreach ($user as $key => $value) {
           if($user[$key]["prenom"]==$prenom && $user[$key]["nom"]==$nom){
               if($user[$key]["score"]<$score){
                   $pos=$key;
                   $p=1;
               }
           }else{
               $p=2;
           }
        }
        if($p==1){
            $user[$pos]['score']=$score;
                $user= json_encode($user);
                file_put_contents('../JSON/score.json', $user);
        }elseif($p==2){
            array_push($user,$message);
             $user= json_encode($user);
            file_put_contents('../JSON/score.json', $user);
        
        }
}else{
    $user[] = $message;
    $user= json_encode($user);
    file_put_contents('../JSON/score.json', $user);

}
    /****************************************************************************** */
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
    
    $test=array();
    $question = file_get_contents('../JSON/peujouer.json');
    $question = json_decode($question, true);
    
    /***************************************************************** */
    /******************Temp.json***********************/
    $data = file_get_contents('../JSON/temp.json');
    $data= json_decode($data, true);

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
            margin-top: 20px;
            font-size: 40px;
            font-family: 'Josefin Sans';
        }
        .avatar{
            width: 100px;
            height: 100px;
            float: left;
            margin-left: 30px;
            border: 1px solid #f8fdfd;
            border-radius: 70px;
            position: relative;
        }
        .avatar img{
            position: absolute;
            top: 0%;
            left: -1%;
        }
        .joueur{
            font-size: 30px;
            margin-top: 130px;
        } 
        .lien a{
            text-decoration: none;
            color: orange;
        }
        a:hover{
            color: red;
        }
        .lien{
            padding: 120px;
            font-size: 20px;
            margin-left: 40px;
            font-family: 'Open Sans';
        }
        .buttom{
            margin-left: 20px;
            margin-top: 80px;
            width: 36%;
        }
        .left{
            float: left;
            width: 45%;
            margin-top: 10px;
            height: 550px;
        }
        #right{
            text-align:left;
            height: 550px;
            width: 53%;
            margin-top: 10px;
            background-color: white;
            color: black;
            overflow: scroll;
            float: right;
        }
        #labelgenere{
            font-size:25px;
            margin-left: 10px;
        }
        .labelgener{
            font-size:20px;
        }
        .inputgenere{
            margin-left: 20px;
        }
        #conteneur{
            width: 100%;
        }
    </style>
</head>
<body>
    <div class=left>
        <!-- div Avatar-->
        <div class="divAvatar">
            <div class="avatar">
            <?php
                $photo = $_SESSION['avatar'];
                echo "<img class='avatar' src='../IMG/Avatar/$photo' alt='' style='margin-left: -1px;
                margin-top: -1px;'><br><br>";//Image de l'avatar                        
            ?>
        </div>
        </div><br>
        <div class="joueur">
            <br><label for="">Bravo <?php echo $_SESSION['prenom'].' '.$_SESSION['nom'].' '; ?>!</label><br><br>
            <label for="">Votre score est de <?php echo $score ; ?></label>
        </div><br>

        <div class="buttom">
            <a href="DeconnexionJ.php"><input type="button" value="Déconnexion" onclick="if(!confirm('Voulez-vous vous déconnecter?'))return false;"></a> <!--affiche boutton deconnexion-->
        </div>
        <div class="lien">
            <i> <a href="./rejouer.php">Cliquez pour rejouer &nbsp;!</a> </i><br>
        </div>
        
    </div>

    <div id="right">
        <div id="conteneur">
        <?php
            if(!empty($data)){
                for($i=0; $i<count($data); $i++){
                    if(array_key_exists($i, $question)){
                        if($data[$i]['type']=="choixMultiple"){
                            $result1=array();
                            if(array_key_exists($i,$question)){
                            $tabon=($question[$i]['vrais']);
                            if (array_key_exists('rep', $data[$i])){
                            $tabverif =($data[$i]['rep']);
                            }
                            else{
                                $tabverif =($question[$i]['rep']);
                            }
                            $resultbon = array_intersect($tabon, $tabverif);
                        $result1 =array_values(array_diff($tabverif, $tabon));
                        
                            $tabdata=array();
                            ?>
                            <label for="" id="labelgenere"><?php echo $data[$i]['question']; ?></label>
                            <?php
                            for ($j=0; $j < count($data[$i]['reponse']); $j++) { 
                            $label=$data[$i]['reponse'][$j];
                            ?>
                            <div class="inputgenere">
                                    <input type="checkbox" disabled <?php  if (array_key_exists('rep', $data[$i])){ 
                                        for ($k=0; $k < count($data[$i]['rep']) ; $k++) { 
                                        $cocherdejouer=$data[$i]['rep'][$k];
                                    
                                        if($cocherdejouer==$j+1){echo "checked";}
                                    } 
                                    }?> name="rep">
                                    <label for="" class="labelgener"<?php if(!empty($resultbon)){for ($m=0; $m <count($resultbon) ; $m++) { 
                                if($resultbon[$m]==$j+1){ echo"style='background-color:green'";}else{
                                    for ($n=0; $n <count($result1) ; $n++) { 
                                        if((int)$result1[$n]==$j+1){echo"style='background-color:red'";}
                                    }
                                }
                            } } ?>  ><?php echo $label; ?></label><br>
                                </div>
                            <?php
                            }
                            }
                        }
                        elseif($data[$i]['type']=="choixSimple"){
                            
                            if (array_key_exists('rep', $data[$i])){
                            $ver=$data[$i]['rep'][0];
                            }else{
                                $ver = 1000;
                            }
                            if(array_key_exists($i,$question)){
                            $bon=$question[$i]['vrais'];
                            ?>
                            <label for="" id="labelgenere"><?php echo $data[$i]['question']; ?></label>
                            <?php
                            for ($j=0; $j < count($data[$i]['reponse']); $j++) { 
                            $label=$data[$i]['reponse'][$j];
                            ?>
                            
                            <div class="inputgenere">
                                    <input type="radio" disabled <?php  if (array_key_exists('rep', $data[$i])){ if($data[$i]['rep'][0]==$j+1){echo "checked";} }?>  name="rep[<?php echo $i.$j;?>]" >
                                    <label for="" class="labelgener"style="background-color:<?php if($bon==$ver && $ver==$j+1){ echo'green';}elseif($bon!=$ver && $ver==$j+1){ echo 'red';}?>"><?php echo $label; ?></label><br>
                                </div>
                            <?php
                            }
                        }
                        }else{
                            if(array_key_exists($i,$question)){
                                $bonn=$question[$i]['rep'];
                            }
                            
                            $verr=$data[$i]['rep'];
                            ?>
                            <label for="" id="labelgenere"><?php echo $data[$i]['question']; ?></label>
                            <div class="inputgenere">
                                <input type="text" name="rep" readonly value="<?php echo $data[$i]['rep']; ?>" 
                                <?php if($bonn==$verr){
                                    echo"style='background-color:green'"; 
                                }else{echo"style='background-color:red'";} ?> >
                                    
                            </div>
                            <?php
                            
                        }
                    }
                }   
            }
        
        ?>
        </div>
    </div>
</body>
</html>
<?php
unset($_SESSION['point']);
?>