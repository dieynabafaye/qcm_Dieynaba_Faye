<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Joueur</title>
    <link rel="stylesheet" href="../CSS/Acceuil.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

                <h3>LISTE DES JOUEURS PAR SCORE</h3>
                <div class="list">
                    <?php
                        $user = file_get_contents('../JSON/score.json');
                        $user = json_decode($user, true);
                        $joueur = [];
                        foreach ($user as $value) {
                                array_push($joueur, $value);
                        }
                                                    
                            /************calculer du nombre total d'element du tableau*************** */
                            $total = count($joueur);
                            $nbr = 5;
                            /**************************** ********************************************/
                            /***********************************calcul du nombre de page************ */
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
                             ?>
                             <table>
                            <tr>
                            <strong><th style="width: 150px;">NOM</th></strong>
                            <strong><th style="width: 150px;">PRENOM</th></strong>
                            <strong><th style="width: 150px;">SCORE</th></strong>
                                </tr>
                                <?php

                        for($i=$indice*$nbr; $i<$nb; $i++){
                            // Trie le tableau par score dans l'ordre décroissant
                                foreach($joueur as $key => $value){
                                    $score[$key] = $value['score'];
                                }
                                array_multisort($score, SORT_DESC, $joueur);
                               
                               if(array_key_exists($i,$joueur)){
                                        ?>
                                        <tr style="width: 150px; height: 25px">
                                        <td > <?php echo $joueur[$i]['nom'] ;?></td>
                                        <td ><?php echo $joueur[$i]['prenom'] ;?></td>
                                        <td ><?php echo $joueur[$i]['score'] ;?></td>
                                        </tr>
                                        <?php
                                }
                                }
                                $indice++;
                    ?>
                    </table>
                </div>
                <div>
                    <a href="Acceuil.php?page=listeJoueur&&indice=<?php if($_GET['indice']==0){ echo $_GET['indice'];}else{ echo $_GET['indice']-1;} ?>" class="bouton1">Précédent</a>
                </div>
                <div>
                    <a href="Acceuil.php?page=listeJoueur&&indice=<?php if($indice<$nbpage){ echo $indice;}else{ echo $nbpage;} ?>" class="bouton2">Suivant</a>
                </div>
</body>
</html>