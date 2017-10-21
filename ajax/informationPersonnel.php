  <?php
  header('Content-type:text');
include_once '../core/config.php';
  $id=$_SESSION['idPersonnel'];
   if(isset($pos['name'])):
  $nom=$pos['nom'];
  $prenom=$pos['prenom'];
  $contact=$pos['contact'];
  $adresse=$pos['adresse'];
  $mail=$pos['mail'];
    $requeteActualisation=" WHERE id=$id ";
                                               /*actualisation des elements pour le validant */
  if($db->update('personnel',array("nom"=>$nom,"prenom"=>$prenom,"contacts"=>$contact,"adresse"=>$adresse,"mail"=>$mail),$requeteActualisation)){

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
                <marquee style='color:rgb(210,210,0)'>Modification effectuée avec succes, ci-dessous un recap de toutes vos informations</marquee>
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
       <input type="text"  class="form-control" disabled="true" id="nomM"  placeholder='nom' value="<?php echo $nom; ?>">
  </div>
  <div class="form-group col-sm-6">
     <label for="prenoms">Prenom:</label>
    <input type="text" class="form-control" disabled="true" id="prenomM" placeholder='prenom' value="<?php echo $prenom;?>">
  </div>
  <div class="form-group col-sm-6">
   <label for="contact">Contact(s):</label>
    <input type="text" class="form-control" disabled="true" id="contactM" placeholder='contact(s)' value="<?php echo $contact;?>">
  </div>
          <div class="form-group col-sm-6">
   <label for="adresse">Adresse:</label>
    <input type="text" class="form-control" disabled="true" id="adresseM" placeholder='adresse' value="<?php echo $adresse;?>">
  </div>
   <div class="form-group col-sm-6">
    <label for="fonction">Fonction:</label>
    <input type="text" class="form-control" disabled="true" id="fonctionM" placeholder='fonction' value="<?php echo $fonction;?>">
  </div>
     <div class="form-group col-sm-6">
    <label for="email">mail:</label>
    <input type="email" class="form-control" disabled="true" id="mailM" placeholder='mail' value="<?php echo $mail; ?>">
  </div>
</form>
    </div>
</body>
<?php }
  else{
      ?>
<body class="wrapper">
    <div class="container">
        <div class="row">
							<div class="col-lg-12">
								
								<div class="alert alert-dismissable alert-danger">
									<button data-dismiss="alert" class="close" type="button">×</button>
									<h4>!!!!!Echec Insertion!!!!!</h4>
									<p>SVP reesayer car une erreur technique est survenue,Revoyez vos champs</p>
								</div>
							</div>
						</div>
    </div>
</body>
<?php
      }
      endif;
      if(isset($pos['log'])):
           $login=$pos['login'];
           $pass=md5($pos['pass']);
           
           
         $requeteActualisation=" WHERE personnel=$id ";
                                               /*actualisation des elements pour le validant */
  if($db->update('comptes_personnel',array("login"=>$login,"password"=>$pass),$requeteActualisation)){
      $_SESSION['password']=$pass;
      ?>
      <body class="wrapper">
    <div class="container">
        <div class="row">
				<div class="col-lg-12">
			
		<div class="alert alert-dismissable alert-success">
		<button data-dismiss="alert" class="close" type="button">×</button>
		<h4>Actualisation Success</h4>
		<p>Vos Donnéés de Connexion ont bien été Modifier</p>
		</div>
			        </div>
				</div>
    </div>
</body>
      
    <?php
    }
      else{
          ?>
<body class="wrapper">
    <div class="container">
        <div class="row">
				<div class="col-lg-12">
			
		<div class="alert alert-dismissable alert-success">
		<button data-dismiss="alert" class="close" type="button"></button>
		<h4><strong>Notification </strong>Echec Actualisation</h4>
		<p>Une Erreur est Survenue lors de L'Actualisation De Vos Donnée de connexion,Reeesayer SVP</p>
		</div>
			        </div>
				</div>
    </div>
</body>
          <?php
      }
      endif;
?>