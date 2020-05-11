<?php
    session_start();
    /************************************************************************************ */
    $id=$_SESSION['login'];
/********************************traitement pour interdire les questions deja trouver********************************************* */
 $tabdejatrouver=array();
$dejatrouver = file_get_contents('../JSON/trouver.json');
$dejatrouver= json_decode($dejatrouver, true);
/************les question à jouer************* */
 $ajouer = file_get_contents('../JSON/peujouer.json');
$ajouer= json_decode($ajouer, true);
/**************les questions****************** */
 $questionsall = file_get_contents('../JSON/ListeQuestion.json');
  $questionsall = json_decode($questionsall, true);
  /************************************* */
  /**************les questions a jouer****************** */
 $contenu = file_get_contents('../JSON/peujouer.json');
  $contenu = json_decode($contenu, true);
  /************************************* */
  /******on verifier et parcours les questions deja trouver de l'utilisateur si ca existe */
  if(!empty($dejatrouver)){
    for ($d=0; $d <count($dejatrouver) ; $d++) { 
      foreach ($dejatrouver[$d] as $key => $value) {
        if($key==$id){
          
          $tabdejatrouver=$dejatrouver[$d][$key];
        }
      }
    }
  }
  /******************on vide le tableau a jouer***************************** */
  $vider=array();
  $vide= file_get_contents('../JSON/peujouer.json');
  $vide = json_decode($vide, true);
   $contenu=json_encode($vider);
     file_put_contents('../JSON/peujouer.json',$contenu);
  /******************************************************* */
   /*****************on parcour les questions pour retrouver les non trouver ********/
  if(!empty($questionsall)){
    $questionajouer=array();
     //var_dump($questionsall);
    for ($t=0; $t <count($questionsall) ; $t++) { 
      if(!in_array($questionsall[$t]['id'],$tabdejatrouver)){
        $fr=$questionsall[$t];
        array_push($questionajouer,$fr);
        $remplir= file_get_contents('../JSON/peujouer.json');
        $remplir = json_decode($remplir, true);
        $remplir=json_encode($questionajouer);
          file_put_contents('../JSON/peujouer.json',$remplir);
        /******************************** */
       }
    }
   
  }
  $question= file_get_contents('../JSON/peujouer.json');
  $question = json_decode($question, true);
  
     $questions=$question;
/******************************************************************************************* */
   
    if(!empty($_POST['envoie'])){
      unset($_POST['envoie']);
    }
  
   
    $nbQuestion = file_get_contents('../JSON/nombreparpage.json');
    $nbQuestion = json_decode($nbQuestion, true);
    if(count($questions)>$nbQuestion){
      $limite = $nbQuestion;
    }else{
      $limite = count($questions);
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Joueur</title>
    <link rel="stylesheet" href="../CSS/Joueur1.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="../JS/fonction.js"></script>
    <style type="text/css">
        

    .dropbtn {
      background-color: #f2f2f2;
      color: #51bfd0;
      padding: 9px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .dropdown {
      position: relative;
      display: inline-block;
      width: 50%;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      color: #042425;
      font-family: 'Open Sans';
      background-color: #f9f9f9;
      min-width: 378px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      min-height: 320px;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover .dropbtn {
      background-color: #f8fdfd;
    }
    .titre-header{
      margin-bottom: 40px;
    }
    .milieu{
      height: 320px;
      overflow:scroll;
    }
    .envoie{
      background: #51bfd0;
      height: 37px;
      width: 20%;
      font-size: larger;
      color: white;
      float: right;
    }
    .checkgenere{
      width: 20px;
      margin-left: 10px;
      height: 20px;
    }
    .checkgenere1{
      width: 35%;
      margin-left: 10px;
      font-size: 20px;
      padding: 10px;
      height: 10px;
    }
    .retour{
      background: #51bfd0;
      height: 37px;
      width: 20%;
      font-size: larger;
      color: white;
      float: left;
    }
    #nbPts{
      float: right;
      width: 10%;
      height: 30px;
      text-align: center;
      font-size: 20px;
    }
    .inputRep{
      margin-left: 30px;
      text-align: left;
      /* margin-top: 50px; */
      padding: 10px
    }
    .labelgenere{
      font-size: 25px;
      font-family: 'Open Sans';
    }
    .titreQuestion{
      font-size: 25px;
      font-family: 'Open Sans';
    }
    .soulign{
      width: 28%;
      border: 1px solid black;
      margin-left: 236px;
      margin-top: -20px;
    }
    #question{
      font-size: 20px;
      font-family: 'Open Sans';
      color: #545050;
    }
    </style>
</head>
<body>
    <div class="opacité">
            <!--div contenant le logo et le texte-->
            <div class="header">
                <div id="logo"><img src="../IMG/INTEGRATIONPHP/Images/logo-QuizzSA.png" alt=""></div>
                <div class="texte"><h2>Le plaisir de jouer</h2></div>
            </div>
        
            <div class="whitefont">
                <div class="couleur">
                    <!-- div Avatar-->
                    <div class="divAvatar">
                        <div class="avatar">
                        <?php
                            $photo = $_SESSION['avatar'];
                            echo "<img class='avatar' src='../IMG/Avatar/$photo' alt='' style='margin-left: -1px;
                            margin-top: -1px;'><br><br>";//Image de l'avatar                        
                        ?>
                        </div>
                        <div class="nom">
                            <?php
                                if(empty($_SESSION['Joueur'])){ //vérifie si y a quelqu'un qui c'est connecter
                                    header('location: Login.php');
                                    exit();
                                }
                                echo $_SESSION['prenom'];
                                echo '<br>';
                                echo $_SESSION['nom'];
                            ?>
                        </div>
                        
                    </div>
                    <div class=titre><h2>BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>
                    JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE </h2></div>
                    <div class="buttom">
                      <a href="DeconnexionJ.php"><input type="button" value="Déconnexion" onclick="if(!confirm('Voulez-vous vous déconnecter?'))return false;"></a> <!--affiche boutton deconnexion-->
                    </div>
                </div>
            </div>
            <div class="question">
                <div class="blocdroite">
                    <div class="titre-header">
                    <?php 
                      if(!empty($limite)){
                        $totalQuestion = $limite;
                        $_SESSION['limite'] = $limite;
                      }
                      else{
                        $totalQuestion = 0;
                      }
                      if(!empty($questions)){
                         $numQuestion = $_GET['page'] + 1;
                       }else{
                         $numQuestion = 0;
                         $sms="vous avez épuisé le stock de question du jeu!";
                       }
                     if(!empty($questions)){
                      $laQuestion = $questions[$_GET['page']]['question'];
                     }else{

                       $laQuestion="";
                     }
                      
                    ?>
                        <label for="" class="titreQuestion">Questions: <?php echo $numQuestion; ?>/<?php echo $totalQuestion; ?></label><br><br>
                        <div class="soulign"></div>
                        <label for="" id="question"><?php echo $laQuestion;?></label><br>
                        <label for="" style="color: red;"><?php if(!empty($_SESSION['message'])){ echo $_SESSION['message'];} ?></label>
                    </div>
                    <form method="post" action="Resultat.php">
                    <input type="hidden" name="niveau" value="<?php echo $_GET['page']; ?>">
                        <div class="milieu">
                        <?php
                          if(empty($questions)){
                        ?>
                        <label for="erreur" style="color: red; font-size: 20px;">Vous avez épuisé le stock de question du jeu!</label>
                        <?php
                          }?>
                        <input type="<?php if(!empty($questions)){echo "text";}else{ echo "hidden";} ?>" name="nbPts" id="nbPts" disabled value="<?php if(!empty($questions)){ echo $questions[$_GET['page']]['nbPts'].' pts'; }?>">
                        <input type="hidden" name="question" value="<?php if(!empty($questions)){ echo $questions[$_GET['page']]['question']; }?>">
                        <input type="hidden" name="type" value="<?php if(!empty($questions)){ echo $questions[$_GET['page']]['reponse'];} ?>">
                        <?php 
                          if(!empty($questions)){
                          if($questions[$_GET['page']]['reponse']=='choixMultiple'){
                              for($i=1; $i<=count($questions[$_GET['page']]['rep']); $i++){
                                $rep=$questions[$_GET['page']]['rep'][$i];/* on recupere la reponse dans rep et on l'affiche*/
                                ?>
                                <div class="inputRep">
                                  <input type="checkbox" name="rep[]" value="<?php echo $i; ?>" class="checkgenere" <?php
                                  if(!empty($_SESSION['vrai'])){
                                    if(count($_SESSION['vrai'])==1){
                                      if($i==$_SESSION['vrai'][0]){
                                        echo "checked";
                                      }
                                    }else{
                                      foreach ($_SESSION['vrai'] as $key => $value) {
                                        if($i==$value){
                                          echo "checked";
                                        }                                      
                                      }
                                    }
                                  }
                                  ?>>
                                  <label class="labelgenere"><?php echo $rep;?></label>
                                  <input type="hidden" name="reponse[]" value="<?php echo $rep;?>">
                                  <br><br>
                                  
                                </div>
                                <?php

                              }
                          }
                          elseif($questions[$_GET['page']]['reponse']=='choixSimple'){
                            for($i=1; $i<=count($questions[$_GET['page']]['rep']); $i++){
                              $rep=$questions[$_GET['page']]['rep'][$i];/* on recupere la reponse dans rep et on l'affiche*/
                              ?>
                              <div class="inputRep">
                                <input type="radio" name="rep" value="<?php echo $i; ?>" class="checkgenere" <?php
                                  if(!empty($_SESSION['bon'])){
                                    if($i==$_SESSION['bon']){
                                      echo "checked";
                                    }
                                  }
                                ?>>
                                <label class="labelgenere"><?php echo $rep;?></label>
                                <input type="hidden" name="reponse[]" value="<?php echo $rep;?>">
                                <br><br>
                              </div>
                              <?php

                            }
                            
                          }
                          else{
                            for($i=0; $i<1; $i++){
                              ?>
                              <div class="inputRep">
                                <input type="text" name="rep" class="checkgenere1" placeholder="Reponse" value="<?php if(!empty($_SESSION['rep'])){ echo $_SESSION['rep']; } ?>" ><br><br>
                              </div>
                              <?php

                            }
                            
                          }
                        }
                        ?>
                        </div>
                        <div class="bas">
                          <?php
                          if(!empty($questions)){
                            if($_GET['page'] < $totalQuestion-1){
                              ?>
                               <input type="submit" value="Suivant" name="envoie" class="envoie">
                              <?php
                            }
                            else{
                              ?>
                               <input type="submit" value="Terminer" name="envoie" class="envoie">
                              <?php
                            }
                            if($_GET['page']>0){
 
                          ?>
                         
                          <input type="submit" value="Precedent" name="precedent" class="retour">
                          <?php
                            }
                          }
                          ?>
                        </div>
                    </form>
                </div>
                
                <div class="blocgauche">
                         <div class="dropdown" style="float:left;">
                            <button class="dropbtn">Top Scores</button>
                            <div class="dropdown-content" style="left:0;">
                              <table class="tableaum">
                                <?php 
                                $messages = file_get_contents('../Json/score.json');
                                $messages = json_decode($messages, true);
                                if(!empty($messages)){
                                $columns = array_column($messages, 'score');
                                array_multisort($columns, SORT_DESC, $messages);
                                if(count($messages)<5){
                                  $r=count($messages);
                                }
                                else{
                                  $r=5;
                                }
                               for ($i=0; $i <$r ; $i++) {

                            ?>

                                <tr style="width:50%;height: 35px;">
                                  <td style="text-align:width:50%; center;font-size: large;"><?php echo $messages[$i]['prenom']; ?>
                                  <td style="text-align: center;font-size: large;"><?php echo $messages[$i]['nom']; ?>
                                  </td>

                                  <td style="text-align: center;font-size: large;"><?php echo $messages[$i]['score'].'pts'; ?>
                                  </td>
                                </tr>
                                               <?php } }?>
                              </table>
                            </div>
                          </div>
                          <div class="dropdown" style="float:right;">
                        <button class="dropbtn" style="float:width: 100%;">Mon meilleur score</button>
                        <div class="dropdown-content">
                          <table class="tableaum">
                            <?php 
                              $tab=array();
                               $messages = file_get_contents('../Json/score.json');
                                $messages = json_decode($messages, true);
                                if(!empty($messages)){
                                    $columns = array_column($messages, 'score');
                                    array_multisort($columns, SORT_DESC, $messages);
                                  for ($i=0; $i <count($messages) ; $i++) {

                                    if($messages[$i]['prenom']==$_SESSION['prenom'] && $messages[$i]['nom']==$_SESSION['nom']){
                                      $t= $messages[$i]['score'];
                                      
                                    array_push($tab,$t);
                                        # code...
                                    }
                                  }
                              
                                  $score=max($tab);
                                }else{
                                  $score=0;
                                }
                            ?>

                            <tr style="width:50%;height: 35px;">
                             <td style="text-align: right;width:50%;font-size: large;"><?php echo $_SESSION['prenom']; ?>
                          <td style="text-align: right;font-size: large;"><?php echo $_SESSION['nom']; ?>
                          </td>

                          <td style="text-align: right;font-size: large;"><?php echo $score.'pts'; ?>
                          </td>
                        </tr>
                        <?php   ?>
                      </table>
                    </div>
                </div>
                    
            </div>
    </div>
</body>
</html>