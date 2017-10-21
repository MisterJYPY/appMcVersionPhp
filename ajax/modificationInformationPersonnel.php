<?php

   header('Content-type:text');
include_once '../core/config.php';
  $nom="";
  $prenom="";
  $contact="";
  $adresse="";
  $mail="";
  $fonction="";
   $id=$_SESSION['idPersonnel'];
  $sql="SELECT * FROM personnel WHERE id=$id";
      $result=$db->selectInTab($sql);
      $nom=$result[0]['nom'];
      $prenom=$result[0]['prenom'];
      $contact=$result[0]['contacts'];
      $mail=$result[0]['mail'];
      $adresse=$result[0]['adresse'];
      $fonction=$result[0]['fonction'];
?>
<body class="wrapper">
    <div class="container">
         <head class='row parie1'>
           <div class="col-xs-3 col-md-3 col-lg-2 logo"></div>
            <div class="col-xs-4 col-md-6 col-lg-8">
                   <table class='table table-bordered'>
                       <thead>
                           <tr>
                       <th><p class="center-block TitreFeuille2"><a href="#">Page Modification De Vos Informations Personnelles</a> </p>
                       </th>
                           </tr>
                       </thead> 
                   </table>
            </div>
            <input type="hidden"  id="champCacher" value="N°
                   :Aucun">
            <div class="col-xs-4 col-md-3 col-lg-2">
                <p></p>
         
            </div>
           <div class="">
           </div>
    </head>
      <form >
   <div class="form-group col-sm-6">
       <label for="nom">Nom:</label>
       <input type="text"  class="form-control" id="nomM"  placeholder='nom' value="<?php echo $nom; ?>">
  </div>
  <div class="form-group col-sm-6">
     <label for="prenoms">Prenom:</label>
    <input type="text" class="form-control" id="prenomM" placeholder='prenom' value="<?php echo $prenom;?>">
  </div>
  <div class="form-group col-sm-6">
   <label for="contact">Contact(s):</label>
    <input type="text" class="form-control" id="contactM" placeholder='contact(s)' value="<?php echo $contact;?>">
  </div>
          <div class="form-group col-sm-6">
   <label for="adresse">Adresse:</label>
    <input type="text" class="form-control" id="adresseM" placeholder='adresse' value="<?php echo $adresse;?>">
  </div>
   <div class="form-group col-sm-6">
    <label for="fonction">Fonction:</label>
    <input type="text" class="form-control" disabled="true" id="fonctionM" placeholder='fonction' value="<?php echo $fonction;?>">
  </div>
     <div class="form-group col-sm-6">
    <label for="email">mail:</label>
    <input type="email" class="form-control" id="mailM" placeholder='mail' value="<?php echo $mail; ?>">
  </div>
     <div class="col-sm-12  col-lg-12 col-xs-12 center-block center">
  <button type="submit" class="btn btn-default btn-dark" onclick="modifInFormation('name')" >Modifier</button>
     </div>
</form>
    </div>
</body>