<?php
    session_start();
    // ob_start();
    /***********Fonction de connexion */
    function connexion($login,$pass){
	$users=getData();
	foreach ($users as $key => $user) {
		if($user['login']===$login && $user['password']===$pass){
			$_SESSION['user']=$user;
			$_SESSION['status']="login";
			if($user['role']==="Joueur"){
	
				return "jeux";
				
			}
			else
			{
				return "accueil";
			}
			
		}

	}
	return "error";
	
}
/******************fonction qui permet de decoder un fichiers json*********************** */
function getData($file="Utilisateur"){
	$data=file_get_contents("../JSON/".$file.".json");
	$data=json_decode($data,true);
	return $data;
}
/**************************************************** */
        if(!empty($_POST['envoie'])){
                $login = $_POST['login'];
                $pwd = $_POST['pwd'];
             $result = connexion($login,$pwd);
         
         if($result=="error"){
          $tres="login ou mot passe incorrect";
         }else{
          
          if($result=="accueil"){
              $_SESSION['Admin']="role";
              echo"bonjour admin";
            $_SESSION['avatar']=$_SESSION['user']['avatar'];
            $_SESSION['prenom']=$_SESSION['user']['prenom'];
            $_SESSION['nom']=$_SESSION['user']['nom'];
             header ("location:./Acceuil.php");
          }
          if($result=="jeux"){
              $_SESSION['Joueur']="role";
            $_SESSION['avatar']=$_SESSION['user']['avatar'];
            $_SESSION['prenom']=$_SESSION['user']['prenom'];
            $_SESSION['nom']=$_SESSION['user']['nom'];
            $_SESSION['questionJouer']=array();
             header ("location:./PageJoueur.php?page=0");
          }
                
         } 
        }
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../CSS/Login.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <div class="opacité">
        <!--div contenant le logo et le texte-->
        <div class="header">
            <div id="logo"><img src="../IMG/INTÉGRATIONPHP/Images/logo-QuizzSA.png" alt=""></div>
            <div class="texte"><h2>Le plaisir de jouer</h2></div>
        </div>
         <!--partie connexion et inscription-->
    <div class="whitefont">
        <div class="couleur">   
        <p>Login Form</p><input type="reset" value="X" name="fermer" style="background: #51bfd0; 
        margin-left: 350px; margin-top: 38px;   border-color: #51bfd0;  border: none;  font-size: 18px; ">
        <?php if(!empty($tres)){echo $tres;}  ?>
        </div>
        <div>
            <form action="" method="post" id="myForm">
                <br><br>
                <!--Bloc input pour le login et l'icone1-->
                <div class="blocIcone1">
                    <div class="icone1">
                        <img src="../IMG/INTÉGRATIONPHP/Images/Icônes/ic-login.png" alt="">
                    </div>
                        <input type="text" name="login" id="login" error="error1" placeholder="Login"><br><br><br>
                    <div class="error1" id="error1"></div>
                </div>
                <!--Bloc input pour le mot de passe et l'icone2-->
                <div class="blocIcone2">
                    <div class="icone2">
                        <img src="../IMG/INTÉGRATIONPHP/Images/Icônes/icone-password.png" alt="">
                    </div>
                        <input type="password" name="pwd" id="pwd" error="error2" style="color: black"; placeholder="Password"><br><br><br>
                    <div class="error" id="error2" style="color: red;  margin-top: -20px;"></div>
                </div>
                <!--Input boutton connexion et lien inscription-->
                <input type="submit" value="Connexion" name="envoie" style="background-color: #51bfd0;">
                </div>
                <a href="./InscriptionUser.php"><p>S'inscrire pour jouer?</p></a>
            </form>
    </div>

    <!--Validation avec JavaScript-->
    <script>
        /* permet de désactiver le message d'erreur lorqu'on commence à écrire dans le champs */  
        const inputs = document.getElementsByTagName('input');
        for(input of inputs)
        {
            input.addEventListener('keyup', function(e){
                if(e.target.hasAttribute('error'))
                {
                    var idDivError = e.target.getAttribute('error');
                    document.getElementById(idDivError).innerText = "";
                }
            });
        }
        /* Affichage du message d'erreur */
        var myForm = document.getElementById('myForm');
        myForm.addEventListener('submit', function(e){

            const inputs = document.getElementsByTagName('input');
            var error = false;
            for(input of inputs)
            {
                if(input.hasAttribute('error'))
                {
                var idDivError = input.getAttribute('error');
                        if(!input.value)
                        {
                            document.getElementById(idDivError).innerText = "Veillez renseignez ce champ!"; 
                            error = true; 
                        }
                    
                }
            }
        if(error){
            e.preventDefault();
            return false;
        }  
        });

    </script>

    </div>
</body>
</html>