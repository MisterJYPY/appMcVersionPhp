<div id="page-wrapper">
<div class="panel-body">
      <div class="row">
              <?php 
              if(isset($pos['nom'])):
              $nom=$pos['nom'];
              $contact=$pos['contact'];
              $mail=$pos['mail'];
              $adresse=$pos['adresse'];
              $ville=$pos['ville'];
               if(empty($mail)):
                   $mail="Inconnu";
               endif;
                if(empty($adresse)):
                   $adresse="Inconnu";
               endif;
               if(empty($contact)):
                   $contact="Inconnu";
               endif;
            if($db->insertdata('clients',array(array("nom"=>$nom ,"contacts"=>$contact,"mail"=>$mail,"adresse"=>$adresse
                    ,"secteur_zone_localite"=>$ville)))){ ?>
                   <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-success">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>Succes Enregistement du client</h4>
                                <p>Vous avez enregister le client avec succes</p>
			        </div>
			    </div>
               <?php     }
               else{
                   
                   ?>
          <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-danger">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>!!!!!Echec </h4>
                                <p>Un Probleme est survenue lors de L'Enregistrement</p>
			        </div>
			    </div>

 <?php
          
               }
              endif;
              if(isset($pos['localiteNew'])):
                $newLocalite=$pos['localiteNew'];
                $secteurZ=$pos['secteur-zone'];
                 if($db->insertdata('secteur_zone_localite',array(array("ville"=>$newLocalite ,"secteur_zone"=>$secteurZ)))){ ?>
                   <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-success">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>Succes Enregistement de la localité</h4>
                                <p>Vous avez enregister la ville:<strong><?php echo $newLocalite;?></strong> avec succes</p>
			        </div>
			    </div>
               <?php     }
               else{
                   
                   ?>
          <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-danger">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>!!!!!Echec Insertion</h4>
                                <p>Un Probleme est Survenu lors de l'enregistrement de cette localite</p>
			        </div>
			    </div>

 <?php
          
               }
              endif;
              ?>
      </div>
    <form action=" <?php echo $_SERVER["REQUEST_URI"];?>" method='POST' name="formulaire" >
         <div class="col-lg-12">
             <h2>Formulaire d'entree de Nouveaux Clients</h2>
         </div>
  
  <div class="form-group col-sm-6">
      <label for="noms">Nom et Prenom:<mark style="color:red">*</mark></label>
     <input type="text" class="form-control" name="nom" placeholder='nom' required="">
     <input type="hidden" id="ol" value="-1">
  </div>
  <div class="form-group col-sm-6">
   <label for="contact">Contact(s):</label>
   <input type="text" class="form-control" name="contact" placeholder='contact(s)' >
  </div>
     <div class="form-group col-sm-6">
    <label for="text">Adresse Client</label>
    <input type="text" class="form-control" name="adresse" placeholder='adresse' >
  </div>
  <div class="form-group col-sm-6">
    <label for="telecopie">mail:</label>
    <input type="email" class="form-control" name="mail" placeholder='le mail' >
  </div>
   <div class="form-group col-sm-6">
    <label for="validite">Type du client</label>
    <input type="text" class="form-control" Value="Grossiste" disabled="" >
  </div>
      <div class="form-group col-sm-6 col-lg-6">
       <label for="nom">Localité:<mark style="color:red">*</mark></label>
       <select class="form-control" id="sel1" 
               required="" name="ville">
           <option></option>
  <?php  echo genererListeDeroulante("secteur_zone_localite", "ville" ) ;  ?>
  </select>
  </div>
  
 
     <div class="col-sm-12  col-lg-12 col-xs-12">
  <button type="submit" class="btn btn-default btn-success"  value='Enregistrer'>Enregister Le Client</button>
     </div>
</form>
    <div class="row">
        <div class="coll-lg-12">
            <h3> ENREGISTER UNE NOUVELLE LOCALITE</h3>
        </div> 
        <form action=" <?php echo $_SERVER["REQUEST_URI"];?>" method='POST'>
          <div class="form-group col-sm-6">
    <label for="validite">Localité:<mark style="color:red">*</mark></label>
    <input type="text" class="form-control" placeholder="la localite" name="localiteNew" required="">
    </div>
           <div class="form-group col-sm-6">
    <label for="validite">SECTEUR - ZONE :<mark style="color:red">*</mark></label>
     <select class="form-control" id="sel1" 
               required="" name="secteur-zone">
           <option></option>
  <?php  
    $sql="SELECT secteur_zone.id, secteur_zone.secteur, zone.designation AS zone
FROM secteur_zone
INNER JOIN zone ON zone.id = secteur_zone.zone
WHERE 1";
  echo genererListeDeroulanteRequete($sql, "zone","secteur") ;  ?>
  </select>
    </div>
             <div class="col-sm-12  col-lg-12 col-xs-12">
  <button type="submit" class="btn btn-default btn-danger"  value='Enregistrer'>Enregistrer localite</button>
     </div>
        </form>
    </div>
</div>
 <?php 
   $sql4="SELECT *
FROM `clients`
NATURAL JOIN secteur_zone_localite
";
  
     $entetes=array("nom"=>"Nom et Prenom","contacts"=>"contacts","mail"=>"Mail","ville"=>"La localité");
      $entete=array("nom"=>"nom","contacts"=>"contacts","mail"=>"mail","ville"=>"ville");
    // var_dump($entetes);
     //$entete=null;           
     $tab=new Tableau($sql4,"col-lg-12",'<div>',"Listes Des Clients Mccroft Tobacco",$entetes,$entete);
  
  echo $tab->leTableau;
 ?>
</div>