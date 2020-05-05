<?php
    $liste = file_get_contents('../JSON/ListeQuestion.json');
    $liste = json_decode($liste, true);
    $initial = count($liste);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Question</title>
    <link rel="stylesheet" href="../CSS/Acceuil1.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        #genere{
            float: left;
            margin-left: 30px;
        }
        .list{
            overflow: scroll;
        }
    </style>
</head>
<body>

                <div class="nombreQ">
                    <form action="" method="post">
                        <br>
                        <label for="nbPts">Nbre de question/Jeu</label>
                        <input type="text" name="nbPts" id="nbPts" value="<?php if(isset($_POST["nbPts"])){ echo $_POST["nbPts"];}
                        if(empty($_POST['nbPts'])){ echo  $initial;} ?>">
                        <input type="submit" name="valider" value="OK">
                    </form>
                </div>
                <div class="list">
                    <?php
                       
                        if(!empty($_POST['valider'])){
                            if(!empty($_POST["nbPts"]) && $_POST["nbPts"]>=5){
                                $_SESSION['p'] = $_POST["nbPts"];
                            }else{
                                echo "veuillez entrer un nombre supérieur ou égal à 5 !";
                            }
                        }
                            if(!empty($_SESSION['p'])){
                                /************calculer du nombre total d'element du tableau*************** */
                                $total = count($liste);
                               /************************************************************************/
                               /***********************************calcul du nombre de page************ */
                               $nbr=$_SESSION['p'];
                              $nbpage = ((int)($total / $nbr));
                               /************************************************************************ */
                               /*****************************page initial***************************** */
                               $indice=0;
                               if(isset($_GET['indice'])){
                                   $indice = (int)$_GET['indice'];
                               }
                               if($indice<$nbpage){
                                   $nb = ($indice * $nbr + $nbr);
                               }
                               else{
                                   $nb = $total;
                               }
                               /********************************************************************** */
                        for($i=$indice*$nbr; $i<$nb; $i++){
                            if($liste[$i]['reponse']=='choixMultiples'){
                                $numero = $i+1;
                                $reponseVrai = count($liste[$i]['vrais']);
                                $titreQuestion = $liste[$i]['question'];
                                ?>
                                    <label for="" id="titregenere"><?php echo $numero.'.'. $titreQuestion;?></label><br>

                                <?php
                                for($j=1; $j<=count($liste[$i]['rep']); $j++){
                                    $reponse = $liste[$i]['rep'][$j];
                                    ?>
                                    <div class="divgenere">
                                        <input type="checkbox" name="genere<?php echo $j ;?>" id="genere" <?php for ($f=0; $f <$reponseVrai ; $f++) { 
                                           if($liste[$i]['vrais'][$f]==$j){
                                               echo "checked";
                                           }
                                        } ?>> 
                                        <label><?php echo $reponse;?></label><br>
                                    </div>


                                    <?php
                                }
                            }
                            elseif($liste[$i]['reponse']=='choixSimple'){
                                $numero = $i+1;
                                $d = $liste[$i]['vrais'];
                                $titreQuestion = $liste[$i]['question'];
                                ?>
                                    <label for="" id="titregenere"><?php echo $numero.'.'. $titreQuestion;?></label><br>

                                <?php
                                for($j=1; $j<=count($liste[$i]['rep']); $j++){
                                    $reponse = $liste[$i]['rep'][$j];
                                    ?>
                                    <div class="divgenere">
                                        <input type="radio" name="genere<?php echo $i.$j ;?>" id="genere" <?php if($d==$j){echo "checked"; } ?>>  <label><?php echo $reponse;?></label><br>
                                    </div>

                                    <?php
                                }
                            }
                            else{
                                $numero = $i+1;
                                $titreQuestion = $liste[$i]['question'];
                                ?>
                                    <label for="" id="titregenere"><?php echo $numero.'.'. $titreQuestion;?></label><br>

                                <?php
                                
                                    $reponse = $liste[$i]['rep'];
                                    $bon = $reponse;
                                ?>
                                    <div class="divgenere">
                                        <input type="text" name="genere[]" id="genere" value="<?php echo $bon;?>" ><br><br>
                                
                                    </div>

                                <?php
                                
                            }

                        }
                        $indice++;
                   
                    ?>
                </div>
                <div>
                    <a href="Acceuil.php?page=listeQuestion&&indice=<?php if($_GET['indice']==0){ echo $_GET['indice'];}else{ echo $_GET['indice']-1;} ?>" class="bouton1">Précédent</a>
                </div>
                <div>
                    <a href="Acceuil.php?page=listeQuestion&&indice=<?php if($indice<$nbpage){ echo $indice;}else{ echo $nbpage-1;} ?>" class="bouton2">Suivant</a>
                </div>
                        <?php
                             }
                        ?>
</body>
</html>