<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <title>Créer Questions</title>
</head>
<body>
<style type="text/css">
  select{
      font-size: 17px;
    font-family: 'open Sans';
    /* margin-top: 22px; */
    background-color: #f2f2f2;
    border: 1px solid cadetblue;
    /* box-shadow: 2px 2px 2px cadetblue; */
    /* margin-right: 60px; */
    margin-left: -50px;
    width: 60%;
  }
  form{
        height: 460px;
   
  }
  .haut{
    height: 410px;
    overflow: scroll;
  }
  .divgener{
    padding: 9px;
  }
.checkgener{
      width: 20px;
    margin-left: -90px;
    height: 20px;
}
.deletgener{
  width: 22px;
    height: 25px;
    margin-left: 5px;
    background-image: url('../IMG/INTÉGRATIONPHP/Images/Icônes/ic-supprimer.png');
    background-size: cover;
}
.div{
  padding: 4px;
  height: 50px;
}
.div1{
  height: 90px;
  padding: 4px;

}
.textarea{
    float: left;
    margin-left: 10px;
    width: 65%;
    height: 50px;
    font-family: 'Open sans';
    border-radius: 3px;
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid cadetblue;
    box-shadow: 2px 2px 2px cadetblue;
}
#point{
    float: left;
    margin-left: 10px;
    width: 8%;
    font-family: 'Open sans';
    border-radius: 2px;
    padding: 10px;
    background-color: #f2f2f2;
    border: 1px solid cadetblue;
    box-shadow: 2px 2px 2px cadetblue;
}
#inpgener{
  width: 50%;
}
#generer{
    width: 40px;
    height: 38px;
    background-color: #51bfd0;
    font-size: 30px;
    color: #f8fdfd;
    margin-left: 10px;
    border-radius: 5px;
    border: 1px solid silver;
}
#label{
  font-size: 18px;
  font-family: 'Open sans';
  margin-top: 12px;
}
#typ{
  width: 55%;
  height: 38px;
  margin-left: 10px;
}
#buttom{
    width: 23%;
    height: 35px;
    background-color: #51bfd0;
    font-size: 18px;
    color: #f8fdfd;
    float: right;
    margin-top: 6px;
    border-radius: 5px;
    border: 1px solid silver;
}
</style>
            
                <h3> PARAMÉTRER VOTRE QUESTION</h3>
                <div class="list">
                    <form action="" method="post">
                        <div class="haut">
                          <div class="div1">
                            <label for="question" id="label">Questions</label>
                            <input type="textarea" name="question" class="textarea" id="question">
                          </div>
                          <div class="div">
                             <label for="nbPts" id="label">Nbre de Points</label>
                              <input type="number" id="point" name="nbPts" id="nbPts">
                          </div>
                          <div class="div">
                             <label for="typeReponse" id="label">Type de réponse</label>
                              <select name="reponse" id="typ">
                                  <option value="Selectionnez votre choix" selected>Selectionnez votre choix</option>
                                  <option value="choixMultiple">choix multiple</option>
                                  <option value="choixSimple">choix simple</option>
                                  <option value="choixText">choix texte</option>
                              </select>
                             <button type="button" id="generer" onclick="genere()">+</button>
                          </div>
                        
                            <div class="active">
                                <div class="hautgener" id="hautgener">
                                  <div class="divgener" id="row_0">
                                   
                                  </div>
                                
                              </div>
                              
                           </div>
                        
                       
                 
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
                        if(typ.value=="choixText"){
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
                    </div>
                      <div class="bas">
                         <input type="submit" value="Enregistrer" name="envoie" id="buttom">
                      </div>
                    </form>
                    <?php
                   if(!empty($_POST['envoie'])){
                       unset($_POST['envoie']);
                       $tab = $_POST;
                        $liste = file_get_contents('../JSON/ListeQuestion.json');
                       $liste = json_decode($liste, true);
                       $liste[] = $tab;
                        $liste = json_encode($liste);
                       file_put_contents('../JSON/ListeQuestion.json', $liste);
                           }
    
                       ?>
                </div>
          
</body>
</html>