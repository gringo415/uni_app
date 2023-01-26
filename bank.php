
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bank.css">
    <title>Document</title>
</head>
<body>
    <div class="groupe1">
    <div class="nom">
 <p> Nom et prenom : </p> 

 <form method="post" >
 <input type="text" name="name" class="input" >  
    </div>

    <div class="fac"> 
    <p>Faculte: </p> 
    <select name="fac" class="input">
    <option value="info">Informatique</option>
<option value="gestion">Gestion</option>
<option value="reso">Reseau</option>
<option value="stat">Statistique</option>
<option value="eco">Eco</option>

 </select>

    </div>

    <div class="motif" >
 <p> Motif: </p> 
 <select name="motif" class="input">
<option value="minos">Minerval</option>
<option value="amande">Ammande</option>
<option value="iyinjira">Inscription</option>
 </select>
 </div>
 <div class="montant">
 <p> Montant : </p> 
 <input type="text" name="montant"  class="input" >  

 <p> Date : </p> 
 <input type="text" name="date"  class="input" >
 </div>

 <input type="submit" title="save in database" name="button" value="Enregistrer" class="but1">
 
 
    </div>
    <form  method="post" >

<input class ="ok_button"type="submit" name="ok_button" value="ok">


</form>

   
   <form method="post">
  <div class="groupe2">
<p> Recherche :</p>
<input type="search" name="searche" placeholder="search">
<input type="submit" name="go" value="Go">
</div>  
<div class="table_but">
</form>
<table  class="table">
   <thead>
<tr>
<th>Nom et prenom</th>
<th>Fac</th>
<th>Motif</th>
<th>Montant</th>
<th>Date</th>
</tr>
</thead>
<tbody  class="table_body" <?php 
if(isset($_POST['ok_button'])){
echo 'style = "display:none;" ';
}

?>  >
   
<?php 

 try
 { $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', ''); 
 } 
 catch (Exception $e) {     
die('Erreur : ' . $e->getMessage()); 
 }
    /*A partir d'ici le code concerne la sauvergade d'un etudiant dans la base de donnees  apres le payement*/


    
    if(isset($_POST['button'])){

         function save(){
            try{
  
               $bdd3 = new PDO('mysql:host=localhost;dbname=test','root', '');
            }
            catch(Exception $e){
               die('error :'.$e->getMessage());
            }
           $repo = $bdd3->prepare('INSERT INTO bank(name,faculte,amount ,motif,date) VALUES(:name,:faculte,:amount,:motif,:date)');
           $repo->execute(array('name'=>$_POST['name'],'faculte'=>$_POST['fac'],'motif'=>$_POST['motif'],'date'=>$_POST['date'],'amount'=>$_POST['montant']));
           
           $repo11 = $bdd3->prepare('SELECT total FROM school WHERE name= :namee' );
           $repo11->execute(array('namee'=>$_POST['name']));
           $answer4 = $repo11->fetch();
           
           echo'reussi';

          $somme = $answer4['total'] + $_POST['montant'];
    
           $repo = $bdd3->prepare('UPDATE school SET total = :total WHERE name= :namee');
           $repo->execute(array('namee'=>$_POST['name'],'total'=>$somme));
         }

         if($_POST['fac'] == "info"){
            $repo_ver = $bdd->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
            $repo_ver->execute(array('nom'=>$_POST['name']));
            $data = $repo_ver->fetch();
            if($data['classe_id'] == 1)
            {
             save();
          }
           else {
            echo 'wrongus';
           }
          }
          
          elseif($_POST['fac'] == "gestion"){
            $repo_ver = $bdd->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
            $repo_ver->execute(array('nom'=>$_POST['name']));
            $data = $repo_ver->fetch();
            if($data['classe_id'] == 2)
            {
              save();
            }
            else {
            echo 'wrongus';
            }
          }
          
          
          elseif($_POST['fac'] == "reseau"){
            $repo_ver = $bdd->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
            $repo_ver->execute(array('nom'=>$_POST['name']));
            $data = $repo_ver->fetch();
            if($data['classe_id'] == 3)
            {
              save();
          }
           else {
            echo 'wrongus';
           }
          }
          elseif($_POST['fac'] == "stat"){
            $repo_ver = $bdd->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
            $repo_ver->execute(array('nom'=>$_POST['name']));
            $data = $repo_ver->fetch();
            if($data['classe_id'] == 4)
            {
              save();
          }
           else {
            echo 'wrongus';
           }
          }
          elseif($_POST['fac'] == "eco"){
            $repo_ver = $bdd->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
            $repo_ver->execute(array('nom'=>$_POST['name']));
            $data = $repo_ver->fetch();
            if($data['classe_id'] == 5)
            {
              save();
          }
           else {
            echo 'wrongus';
           }
          }
         



}
 ?>
 
<?php /*Cette partie du php concerne les recherche que le banquier peut effectuer dans la base de donnees*/

if(isset($_POST['go'])){
   $repere = null;
 
   
   $repo1 = $bdd->prepare('SELECT * FROM bank WHERE name = :nom');
   $repo1->execute(array('nom' => $_POST['searche']));
   
   while($receive =$repo1->fetch()){
      $repere = $receive;
	 
      echo '   <tr>
      <td> '.$receive['name'].'</td>
      <td> '.$receive['faculte'].'</td>
      <td>'.$receive['motif'].'</td>
      <td>'.$receive['amount'].'</td>
      <td>'.$receive['date'].'</td>
      </tr>';
     }
     


   if($receive == false){
      $repo1 = $bdd->prepare('SELECT * FROM bank WHERE motif = :motif');
      $repo1->execute(array('motif' => $_POST['searche']));
      while($receive =$repo1->fetch()){
         $repere = $receive;
	 
         echo '   <tr>
         <td> '.$receive['name'].'</td>
         <td>'.$receive['motif'].'</td>
         <td>'.$receive['date'].'</td>
         </tr>';
        }
   
   }
   if($receive == false){
      $repo1 = $bdd->prepare('SELECT * FROM bank WHERE date = :date');
      $repo1->execute(array('date' => $_POST['searche']));
      while($receive =$repo1->fetch()){
         $repere = $receive;
         echo '   <tr>
         <td> '.$receive['name'].'</td>
         <td>'.$receive['motif'].'</td>
         <td>'.$receive['date'].'</td>
         </tr>'   ; 
        }
   
   }
   if($repere== null){
      echo 'Pas de resultats correspondants a votre recherche ';
   }

$repo1->closeCursor();
      
}

?>

</tbody>
</TABle>
<form method="post">

</form>
</div>

<footer class="foot">
<p></p>
</footer>
<p class="pa"> Univerite du Lac Tanganyika</p>
</body>
</html>

