<?php 
try{

   $bdd3 = new PDO('mysql:host=localhost;dbname=test','root', '');
}
catch(Exception $e){
   die('error :'.$e->getMessage());
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/school.css"/>
    <title>Document</title>
</head>
<body>

<p class="accueil"> Bienvenu , veuillez selectionner l'activite que vous voulez poursuivre:</p>
<form method="post">
  
<div class="motif" >
 <select name="ishure" class="input">
<option value="compte">Creer un compte</option>
<option value="message">Envoyer un message</option>
<option value="horaire">Completer les horaires</option>
<option value="info">Informations etudiants</option>
<option value="delais">Les delais de payements</option>
</select>
<input type="submit" class="ok_but" value="ok" name="ok_but">
 </div>
<?php   
if(isset($_POST['ok_but']))
{
    if($_POST['ishure'] == 'compte'){

      echo '<div class="compte">
      <p>Faculte:</p>

      <select name="fac_select" >
      <option name="infooo" value="info">info</option>
      <option name="histoo" value="Gestion">Gestion</option>
      <option name="histoo" value="Reseau">Reseau</option>
      <option name="histoo" value="Stat">Stat</option>
      <option name="histoo" value="Eco">Eco</option>
      </select>
      
      <p>Etudiant:</p>
      <input type="text" name="student">
      
      <p>password:</p>
      <input type="text" name="password">
      <input type="submit" value="create" name="but4">
      </div>
      ';
      
    }


    elseif($_POST['ishure'] == 'message'){
      echo '<div class="message1">
      
      
      <select name="fac_select1" class = "faculte">
      <option name="infooo" value="info">info</option>
      <option name="histoo" value="Gestion">Gestion</option>
      <option name="histoo" value="Reseau">Reseau</option>
      <option name="histoo" value="Stat">Stat</option>
      <option name="histoo" value="Eco">Eco</option>
      </select>
      
      
      <p>Etudiant:</p>
      <input type="text" name="student">
      
      <p>Message:</p>
      <input type="text" name="message">
      <input type="submit" value="send" name="but3">
      </div>
      ';
    }



    elseif($_POST['ishure'] == 'horaire'){
      echo '
      <div class="horaire">
      <p>Faculte:</p>

      <select name="fac_select" >
      <option name="infooo" value="info">info</option>
      <option name="histoo" value="Gestion">Gestion</option>
      <option name="histoo" value="Reseau">Reseau</option>
      <option name="histoo" value="Stat">Stat</option>
      <option name="histoo" value="Eco">Eco</option>
      </select>
      
      


      <p>Cours:</p>
      <input type="text" name="class_cours">
      
      <p>Prof:</p>
      <input type="text" name="class_prof">
      
      
      <p>Horarire:</p>
      <input type="text" name="class_horaire">
      
      <input type="submit" value="send" class="but2" name="bouton_sub">
      </div>
      ';

    }
    elseif($_POST['ishure'] == 'info'){

      echo '
      <div class="info">
       

      <select name="fac_select" >
      <option name="infooo" value="info">info</option>
      <option name="histoo" value="Gestion">Gestion</option>
      <option name="histoo" value="Reseau">Reseau</option>
      <option name="histoo" value="Stat">Stat</option>
      <option name="histoo" value="Eco">Eco</option>
      </select>
      

      <p>Etudiant:</p>
      <input type="text" name="info_name">

    
      


    
      
      <select name="info_select" >
      <option name="infooo" value="compte">infos</option>
      <option name="histoo" value="message">historique</option>
      </select>

      <input type="submit" value="show" class="but5" name="bouton_sube">
      </div>
      ';
     
    }
    elseif($_POST['ishure'] == 'delais'){

      echo '
      <div class="delais">
      <p>Semestre1:</p>
      <input type="text" name="sem1">


      <p>Semestre2:</p>
      <input type="text" name="sem2">

      <p>Semestre3:</p>
      <input type="text" name="sem3">

      <p>Semestre4:</p>
      <input type="text" name="sem4">
      
      
      <input type="submit" value="send" class="but6" name="but6">
      </div>
      ';
    }
    
}
?>


</form>

</body>
</html>


<?php
if(isset($_POST['bouton_sub']))
{
   
   $repo5 = $bdd3->prepare('UPDATE class SET cours =:nom_cours ,proff = :proff , heure = :heure WHERE nom =:nom'); 
   $repo5->execute(array('nom'=>$_POST['fac_select'],'nom_cours'=>$_POST['class_cours'],'proff'=>$_POST['class_prof'],'heure'=>$_POST['class_horaire']));

}

?>
<?php
if(isset($_POST['but3']))
{
  /*processus de verification des noms des eleves par faculte */
  $repo_ver = $bdd3->prepare('SELECT id ,classe_id FROM school WHERE name =:nom'); 
  $repo_ver->execute(array('nom'=>$_POST['student']));
  $data = $repo_ver->fetch();
  $now = date('Y-m-d');

  $eleve = $data['id'];
if($_POST['fac_select1'] == "info"){
  
  
  if($data['classe_id'] == 1)
  {
    
    $repo6 = $bdd3->prepare('INSERT INTO ubutumwa (Id_eleve, messagee,  date) VALUES (:eleve, :message, :date)'); 
    $repo6->execute(array('message'=>$_POST['message'],'eleve'=>$data['classe_id'], 'date'=>$now));

   
}
 else {
  echo 'wrongus';
 }
}
elseif($_POST['fac_select1'] == "Gestion"){
  
  if($data['classe_id'] == 2)
  {
    $repo6 = $bdd3->prepare('INSERT INTO ubutumwa (Id_eleve, messagee,  date) VALUES (:eleve, :message, :date)'); 
    $repo6->execute(array('message'=>$_POST['message'],'eleve'=>$data['classe_id'], 'date'=>$now));
  }
  else {
  echo 'wrongus';
  }
}


elseif($_POST['fac_select1'] == "Reseau"){
 
  if($data['classe_id'] == 3)
  {
    $repo6 = $bdd3->prepare('INSERT INTO ubutumwa (Id_eleve, messagee,  date) VALUES (:eleve, :message, :date)'); 
    $repo6->execute(array('message'=>$_POST['message'],'eleve'=>$data['classe_id'], 'date'=>$now));
}
 else {
  echo 'wrongus';
 }
}
elseif($_POST['fac_select1'] == "Stat"){
 
  if($data['classe_id'] == 4)
  {
    $repo6 = $bdd3->prepare('INSERT INTO ubutumwa (Id_eleve, messagee,  date) VALUES (:eleve, :message, :date)'); 
    $repo6->execute(array('message'=>$_POST['message'],'eleve'=>$data['classe_id'], 'date'=>$now));
}
 else {
  echo 'wrongus';
 }
}
elseif($_POST['fac_select1'] == "Eco"){
  
  if($data['classe_id'] == 5)
  {
    $repo6 = $bdd3->prepare('INSERT INTO ubutumwa (Id_eleve, messagee,  date) VALUES (:eleve, :message, :date)'); 
    $repo6->execute(array('message'=>$_POST['message'],'eleve'=>$data['classe_id'], 'date'=>$now));
}
 else {
  echo 'wrongus';
 }
}

}



  

?>


<?php
if(isset($_POST['but6']))
{
   $repoa = $bdd3->prepare('UPDATE delay SET date =:datee  WHERE name =\'semestre1\''); 
    $repoa->execute(array('datee'=>$_POST['sem1']));

    $repob = $bdd3->prepare('UPDATE delay SET date =:datee  WHERE name =\'semestre2\''); 
    $repob->execute(array('datee'=>$_POST['sem2']));

    $repoc = $bdd3->prepare('UPDATE delay SET date =:datee  WHERE name =\'semestre3\''); 
    $repoc->execute(array('datee'=>$_POST['sem3']));

    $repod = $bdd3->prepare('UPDATE delay SET date =:datee  WHERE name =\'semestre4\''); 
    $repod->execute(array('datee'=>$_POST['sem4']));

}
?>

<?php   


if(isset($_POST['bouton_sube'])){
  function informer(){
    try{
  
      $bdd3 = new PDO('mysql:host=localhost;dbname=test','root', '');
   }
   catch(Exception $e){
      die('error :'.$e->getMessage());
   }

  $repo1 = $bdd3->prepare('SELECT * FROM bank WHERE name = :nom');
  $repo1->execute(array('nom' => $_POST['info_name']));

if($_POST['info_select'] == 'message'){
  $repo1 = $bdd3->prepare('SELECT * FROM bank WHERE name = :nom');
  $repo1->execute(array('nom' => $_POST['info_name']));

  echo'<div class="table_div">
  <table class="table">  
  <thead>
  <tr>
<th>Nom et prenom</th>
<th>ID</th>
<th>Motif</th>
<th>Montant</th>
<th>Date</th>
</tr>
</thead>
<tbody>
';
while($receive =$repo1->fetch()){
  $repere = $receive;

  echo '   <tr>
  <td> '.$receive['name'].'</td>
  <td> '.$receive['id_eleve'].'</td>
  <td>'.$receive['motif'].'</td>
  <td>'.$receive['amount'].'</td>
  <td>'.$receive['date'].'</td>
  </tr>';
 }


 '
</tbody>
  
  
  
  </table>
  
  </div>';
}
else{
  $repo1 = $bdd3->prepare('SELECT * FROM school WHERE name = :nom');
  $repo1->execute(array('nom' => $_POST['info_name']));
 echo '<div class="table_div">
 <table class="table">  
 <thead>
 <tr>
<th>Nom et prenom</th>
<th>ID</th>
<th>total</th>
<th>password</th>
</tr>
</thead>
<tbody>
';
while($receive =$repo1->fetch()){
  $repere = $receive;

  echo '   <tr>
  <td> '.$receive['name'].'</td>
  <td> '.$receive['id'].'</td>
  <td>'.$receive['total'].'</td>
  <td>'.$receive['password'].'</td>

  </tr>';
 }


 '
</tbody>
    </table>
  
  </div>';
}
}
if($_POST['fac_select'] == "info"){
  $repo_ver = $bdd3->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
  $repo_ver->execute(array('nom'=>$_POST['info_name']));
  $data = $repo_ver->fetch();
  if($data['classe_id'] == 1)
  {
   informer();
}
 else {
  echo 'wrongus';
 }
}

elseif($_POST['fac_select'] == "Gestion"){
  $repo_ver = $bdd3->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
  $repo_ver->execute(array('nom'=>$_POST['info_name']));
  $data = $repo_ver->fetch();
  if($data['classe_id'] == 2)
  {
    informer();
  }
  else {
  echo 'wrongus';
  }
}


elseif($_POST['fac_select'] == "Reseau"){
  $repo_ver = $bdd3->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
  $repo_ver->execute(array('nom'=>$_POST['info_name']));
  $data = $repo_ver->fetch();
  if($data['classe_id'] == 3)
  {
    informer();
}
 else {
  echo 'wrongus';
 }
}
elseif($_POST['fac_select'] == "Stat"){
  $repo_ver = $bdd3->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
  $repo_ver->execute(array('nom'=>$_POST['info_name']));
  $data = $repo_ver->fetch();
  if($data['classe_id'] == 4)
  {
    informer();
}
 else {
  echo 'wrongus';
 }
}
elseif($_POST['fac_select'] == "Eco"){
  $repo_ver = $bdd3->prepare('SELECT classe_id FROM school WHERE name =:nom'); 
  $repo_ver->execute(array('nom'=>$_POST['info_name']));
  $data = $repo_ver->fetch();
  if($data['classe_id'] == 5)
  {
    informer();
}
 else {
  echo 'wrongus';
 }
}
}

if(isset($_POST['but4'])){

 if($_POST['fac_select'] == 'info'){
  $repo_compte = $bdd3->prepare(' INSERT INTO school(name,classe_id,total, password, message) VALUES(:name, 1, 0, :password, \'toi meme\')');
  $repo_compte->execute(array('name' => $_POST['student'], 'password' => $_POST['password']));

 } 

  elseif($_POST['fac_select'] == 'Gestion'){
   $repo_compte = $bdd3->prepare(' INSERT INTO school(name,classe_id,total, password, message) VALUES(:name, 2, 0, :password, \'toi meme\')');
   $repo_compte->execute(array('name' => $_POST['student'], 'password' => $_POST['password']));
 } 
 elseif($_POST['fac_select'] == 'Reseau'){
  $repo_compte = $bdd3->prepare(' INSERT INTO school(name,classe_id,total, password, message) VALUES(:name, 3, 0, :password, \'toi meme\')');
  $repo_compte->execute(array('name' => $_POST['student'], 'password' => $_POST['password']));
} 
elseif($_POST['fac_select'] == 'Stat'){
  $repo_compte = $bdd3->prepare(' INSERT INTO school(name,classe_id,total, password, message) VALUES(:name, 4, 0, :password, \'toi meme\')');
  $repo_compte->execute(array('name' => $_POST['student'], 'password' => $_POST['password']));
} 
elseif($_POST['fac_select'] == 'Eco'){
  $repo_compte = $bdd3->prepare(' INSERT INTO school(name,classe_id,total, password, message) VALUES(:name, 5, 0, :password, \'toi meme\')');
  $repo_compte->execute(array('name' => $_POST['student'], 'password' => $_POST['password']));
} 

}
?>


}