<?php
    session_start();
    $questions = file_get_contents('../JSON/ListeQuestion.json');
    $questions = json_decode($questions, true);
    // unset($_SESSION['envoie']);
    if(!empty($_POST['envoie'])){
      unset($_POST['envoie']);
      var_dump ($_POST);
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
      /* height: 20px; */
      font-size: medium;
    }
    .inputRep{
      margin-left: 30px;
      text-align: left;
      /* margin-top: 50px; */
      padding: 10px
    }
    </style>
</head>
<body>
    <div class="opacité">
            <!--div contenant le logo et le texte-->
            <div class="header">
                <div id="logo"><img src="../IMG/INTÉGRATIONPHP/Images/logo-QuizzSA.png" alt=""></div>
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
                      if(!empty($questions)){
                        $totalQuestion = count($questions);
                      }
                      else{
                        $totalQuestion = 0;
                      }
                      $numQuestion = $_GET['page'] + 1;

                      $laQuestion = $questions[$_GET['page']]['question'];
                    ?>
                        <label for="">Questions: <?php echo $numQuestion; ?>/<?php echo $totalQuestion; ?></label><br><br>
                        <label for=""><?php echo $laQuestion; ?></label><br>
                        <label for="" style="color: red;"><?php if(!empty($_SESSION['message'])){ echo $_SESSION['message'];} ?></label>
                    </div>
                    <form method="post" action="Resultat.php">
                    <input type="hidden" name="niveau" value="<?php echo $_GET['page']; ?>">
                        <div class="milieu">
                        <input type="text" name="nbPts" id="nbPts" disabled value="<?php echo $questions[$_GET['page']]['nbPts'].' pts'; ?>">
                        <input type="hidden" name="question" value="<?php echo $questions[$_GET['page']]['question']; ?>">
                        <input type="hidden" name="type" value="<?php echo $questions[$_GET['page']]['reponse']; ?>">
                        <?php 
                        
                          if($questions[$_GET['page']]['reponse']=='choixMultiples'){
                              for($i=1; $i<=count($questions[$_GET['page']]['rep']); $i++){
                                $rep=$questions[$_GET['page']]['rep'][$i];/* on recupere la rer par rep et on l'affiche*/
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
                                        }                                      }
                                    }
                                  }
                                  ?>>
                                  <label class="labelgenere"><?php echo $rep;?></label><br><br>
                                </div>
                                <?php

                              }
                          }
                          elseif($questions[$_GET['page']]['reponse']=='choixSimple'){
                            for($i=1; $i<=count($questions[$_GET['page']]['rep']); $i++){
                              $rep=$questions[$_GET['page']]['rep'][$i];/* on recupere la rer par rep et on l'affiche*/
                              ?>
                              <div class="inputRep">
                                <input type="radio" name="rep" value="<?php echo $i; ?>" class="checkgenere" <?php
                                  if(!empty($_SESSION['bon'])){
                                    if($i==$_SESSION['bon']){
                                      echo "checked";
                                    }
                                  }
                                ?>>
                                <label class="labelgenere"><?php echo $rep;?></label><br><br>
                              </div>
                              <?php

                            }
                            
                          }
                          else{
                            for($i=0; $i<1; $i++){
                              ?>
                              <div class="inputRep">
                                <input type="text" name="rep" class="checkgenere"value="<?php if(!empty($_SESSION['rep'])){ echo $_SESSION['rep']; } ?>" ><br><br>
                              </div>
                              <?php

                            }
                            
                          }
                        ?>
                        </div>
                        <div class="bas">
                          <?php
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
                          ?>
                         
                          <input type="submit" value="Precedent" name="precedent" class="retour">
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