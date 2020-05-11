<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/Acceuil.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil Admin</title>
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
                <div class=titre><h2>CRÉER ET PARAMÉRTER VOS QUIZZ</h2></div>
                <div class="buttom">
                    <a href="DeconnexionA.php"><input type="button" value="Déconnexion" onclick="if(!confirm('Voulez-vous vous déconnecter?'))return false;"></a> <!--affiche boutton deconnexion-->
                </div>
            </div>

            <div class=blocgauche>
                <div class="couleurbleu">
                    <div class="avatar">
                        <?php
                            $photo = $_SESSION['avatar'];
                            echo "<img class='avatar' src='../IMG/Avatar/$photo' alt=''><br><br>";//Image de l'avatar                        
                        ?>
                    </div>
                    <div class="nom">
                        <?php
                            if(empty($_SESSION['Admin'])){ //vérifie si y a quelqu'un qui c'est connecter
                                header('location: Login.php');
                                exit();
                            }
                            echo $_SESSION['prenom'];
                            echo '<br>';
                            echo $_SESSION['nom'];
                        ?>
                    </div>
                </div>
                    <nav>
                        <ul>
                            <div class="lien1">
                                <a href="Acceuil.php?page=modifSuprrQuestion">
                                <li>&nbsp;Modif/Suppr Questions</li>
                                <img src="../IMG/INTEGRATIONPHP/Images/Icones/ic-ajout.png" alt="">
                                </a>
                            </div>
                            <div class="lien2">
                                <a href="Acceuil.php?page=listeQuestion&&indice=0">
                                <li>&nbsp;Liste Questions</li>
                                <img src="../IMG/INTEGRATIONPHP/Images/Icones/ic-liste.png" alt="">
                                </a>
                            </div>
                            <div class="lien3">
                                <a href="Acceuil.php?page=creerAdmin">
                                <li>Créer Admin</li>
                                <img src="../IMG/INTEGRATIONPHP/Images/Icones/ic-ajout.png" alt="">
                                </a>
                            </div>
                            <div class="lien4">
                                <a href="Acceuil.php?page=listeJoueur&&indice=0">
                                <li>Liste joueurs</li>
                                <img src="../IMG/INTEGRATIONPHP/Images/Icones/ic-liste.png" alt="">
                                </a>
                            </div>
                            <div class="lien5">
                                <a href="Acceuil.php?page=creerQuestion">
                                <li>Créer Questions</li>
                                <img src="../IMG/INTEGRATIONPHP/Images/Icones/ic-ajout.png" alt="">
                                </a>
                            </div>
                        </ul>
                    </nav>
            </div>
            <div class="blocdroite">
                <?php
                    if(!isset($_GET['page'])){
                        $page = './Acceuil.php';
                    }
                    else{
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'modifSuprrQuestion':
                                include('./ModifSuppr.php');
                                break;
                            case 'listeQuestion':
                                include('./ListeQuestion.php');
                                break;
                            case 'creerAdmin':
                                include('./CreerAdmin.php');
                                break;
                            case 'listeJoueur':
                                include('./ListeJoueur.php');
                                break;
                            case 'creerQuestion':
                                include('./Creerquestion1.php');
                                break;
                            default:
                                'Erreur de chargement';
                                break;
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>