<?php
$question = file_get_contents('../JSON/ListeQuestion.json');
$question = json_decode($question, true);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification et Supprimer une question</title>
    <style>
        #numQuestion{
            width: 20%;
            height: 30px;
        }
        #buttom{
            width: 14%;
            font-size: 20px;
        }
        .milieu{
            height: 400px;
            width: 100%;
        }
        .bas{
            height: 50px;
            width: 100%;
        }
        .divgener{
            padding: 9px;
        }
        #inpgener{
            width: 50%;
        }
        #inputgenere{
            width: 80%;
            margin-left: -10px;
            padding: 20px;
        }
        #generer{
            width: 30px;
            height: 28px;
            background-color: #51bfd0;
            font-size: 22px;
            color: #f8fdfd;
            margin-right: 70px;
            border-radius: 5px;
            border: 1px solid silver;
        }
        .deletgener{
            width: 22px;
            height: 25px;
            margin-left: 10px;
            background-image: url('../IMG/INTEGRATIONPHP/Images/Icones/ic-supprimer.png');
            background-size: cover;
        }
        .checkgener{
            width: 20px;
            margin-left: -160px;
            height: 20px;
        }
        #typ{
            width: 20%;
            height: 30px; 
        }
        #nbPts{
            width: 10%;
            height: 10px;
            margin-left: 200px;
        }
    </style>
</head>
<body>
    <div>
        <form method="post">
            <br>
            <select name="numQuestion" id="numQuestion">
            <option value="num Question" selected disabled=""><?php if(!empty($_POST['numQuestion'])){
                    echo $_POST['numQuestion']; 
                    }
                    else{ echo "num Question";}?></option>
                <?php for($i=1;$i<=count($question);$i++){
                    ?>
                        <option><?php echo $i; ?></option>
                    <?php
                    
                } ?>

            </select>
            <select name="choix" id="typ" >
                <option selected="" disabled=""><?php if(!empty($_POST['choix'])){
                    echo $_POST['choix']; 
                    }
                    else{ echo "Votre choix";}?></option>
                <option value="choixMultiple">Choix Multpiles</option>
                <option value="choixSimple">Choix Simple</option>
                <option value="choixTexte">Choix Texte</option>
            </select>
            <input type="submit" value="Modifier" name="modifier" id="buttom">
            <input type="submit" value="Supprimer" name="supprimer" id="buttom" style="background-color: darkred; width: 18%">
            <div class="milieu">
            <?php
            /*****************************************Modifier une question*********************************************/
            if(!empty($_POST['modifier'])){
                if(!empty($_POST['choix']) && !empty($_POST['numQuestion'])){
                $jouer = file_get_contents('../JSON/QuestionJouer.json');
                $jouer = json_decode($jouer,true);
            if(!empty($jouer)){
                $test = 0;
                $numQuestion = $_POST['numQuestion'];
                $_SESSION['p']=$numQuestion-1;
                $choix = $_POST['choix'];
                for($j=0; $j<count($jouer); $j++){
               
                    if($numQuestion == $jouer[$j]){
                        $test = 1;
                    }
                }
                if($test==1){
                    echo "<p style='color: red;'>Cette question ne peut être modifier!</p>";
                }
                else{/*********************************************************************/
                    if($choix == 'choixMultiple'){
                        $point = $question[$_SESSION['p']]['nbPts'];
                        $q = $question[$_SESSION['p']]['question'];
                        ?>
                        <div id="inputgenere">
                            <input type="text" name="question" value="<?php echo $q; ?>">
                            <input type="text" name="nbPts" id="nbPts" value="<?php echo $point; ?>" placeholder="score">
                            <input type="hidden" name="reponse" value="<?php echo $_POST['choix'];?>">
                            <button type="button" id="generer" onclick="genere()">+</button><br>
                        </div>
                        <?php
                    }

                    elseif($choix == 'choixSimple'){
                        $point = $question[$_SESSION['p']]['nbPts'];
                        $q = $question[$_SESSION['p']]['question'];
                        ?>
                        <div id="inputgenere">
                            <input type="text" name="question" value="<?php echo $q; ?>">
                            <input type="text" name="nbPts" id="nbPts" value="<?php echo $point; ?>" placeholder="score">
                            <input type="hidden" name="reponse" value="<?php echo $_POST['choix'];?>">
                            <button type="button" id="generer" onclick="genere()">+</button><br>
                        </div>
                        <?php
                    }
                    else{
                        $point = $question[$_SESSION['p']]['nbPts'];
                        $q = $question[$_SESSION['p']]['question'];
                        ?>
                        <div id="inputgenere">
                            <input type="text" name="question" value="<?php echo $q; ?>">
                            <input type="text" name="nbPts" id="nbPts" value="<?php echo $point; ?>" placeholder="score">
                            <input type="hidden" name="reponse" value="<?php echo $_POST['choix'];?>">
                            <button type="button" id="generer" onclick="genere()">+</button><br>
                        </div>
                        <?php
                    }
                }/************************************************************************/
            }
        }
    }
/******************************Supprimer Question*********************************/
    if(!empty($_POST['supprimer'])){
        if(!empty($_POST['numQuestion'])){
            $jouer = file_get_contents('../JSON/QuestionJouer.json');
            $jouer = json_decode($jouer,true);
            if(!empty($jouer)){
                $test = 0;
                $numQuestion = $_POST['numQuestion'];
                $_SESSION['p']=$numQuestion-1;
                for($j=0; $j<count($jouer); $j++){
                    if($numQuestion == $jouer[$j]){
                        $test = 1;
                    }
                }
                if($test==1){
                    echo "<p style='color: red;'>Cette question ne peut être modifier!</p>";
                }
                else{
                    unset($question[$_SESSION['p']]);
                    $contenu = json_encode(array_values($question));
                    file_put_contents('../JSON/ListeQuestion.json', $contenu);
                }
            }
        }
    }
    ?>
    <div class="active">
        <div class="hautgener" id="hautgener">
            <div class="divgener" id="row_0">
            
            </div>
        </div>
    </div>
    </div>
    <div class="bas">
        <input type="submit" value="Valider" name="valider" id="buttom">
    </div>
     </form>
    </div>
    <?php
        if(!empty($_POST['valider'])){
            unset($_POST['valider']);
           $newQuestion = $_POST;
           //var_dump($_POST);
           $question [$_SESSION['p']] = $_POST;
           $contenu = json_encode(array_values($question));
           file_put_contents('../JSON/ListeQuestion.json', $contenu);
        }
    ?>
    <!-------------------------------------------------------------------------->
    <script type="text/javascript">
        var nbrow = 0;
        var i=0;
        function genere() {
            nbrow++;
            i++;
            var choise=document.getElementById('select');
            var divInputs =document.getElementById('hautgener');
            var newInput= document.createElement('div');
            newInput.setAttribute('class','divgener');
            newInput.setAttribute('id','row_'+nbrow);
            if(typ.value=="choixMultiple"){
                newInput.innerHTML ='<input class="inpgener" type="text" name="rep['+i+']" id="inpgener" placeholder="reponse'+i+'"><input class="checkgener" type="checkbox" name="vrais[]" value="'+i+'" id="checkgener"><button type="button" class="deletgener" onclick="ondelete('+nbrow+')"></button>'
                        ;
                divInputs.appendChild(newInput);
            }
            if(typ.value=="choixSimple"){
                newInput.innerHTML ='<input class="inpgener" type="text" name="rep['+i+']" id="inpgener" placeholder="reponse'+i+'"><input class="checkgener" type="radio" name="vrais" value="'+i+'" id="checkgener"><button type="button" class="deletgener" onclick="ondelete('+nbrow+')"></button>'
                        ;
                divInputs.appendChild(newInput);
            }
            if(typ.value=="choixTexte"){
                newInput.innerHTML ='<input class="inpgener" type="text" name="rep" id="inpgener" placeholder="reponse'+i+'"><button type="button" class="deletgener" onclick="ondelete('+nbrow+')"></button>'
                        ;
                divInputs.appendChild(newInput);
                if (i>=1) {
                generer.setAttribute('disabled','disabled');
                }
                // generer.setAttribute('type','hidden');
            }
        }
        function ondelete(n) {
            var target = document.getElementById('row_'+n);
            target.remove();
            
        }
        </script>
</body>
</html>