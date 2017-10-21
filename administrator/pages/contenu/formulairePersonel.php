<div id="page-wrapper"> 
<div class="row">
              <?php 
              if(isset($pos['serviceP'])):
        /* @var $nom type */
        $nom=$pos['nom'];
        /* @var $prenom type */
        $prenom=$pos['prenom'];
        /* @var $contact type  */
        $contact=$pos['contact'];
              $mail=$pos['mail'];
              $adresse=$pos['adresse'];
              $service=$pos['serviceP'];
              $fonction=$pos["fonction"];
               if(empty($mail)):
                   $mail="Inconnu";
               endif;
                if(empty($adresse)):
                   $adresse="Inconnu";
               endif;
               if(empty($contact)):
                   $contact="Inconnu";
               endif;
            if($db->insertdata('personnel',array(array("nom"=>$nom ,"prenom"=>$prenom ,"fonction"=>$fonction,
                "contacts"=>$contact,"mail"=>$mail,"adresse"=>$adresse
             ,"service"=>$service)))){?>
                   <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-success">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>Succes Enregistement du Personnel</h4>
                                <p>Vous avez enregister le Personnel avec succes</p>
			        </div>
			    </div>
               <?php     }
               else{
                   
                   ?>
          <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-danger">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>!!!!!Echec </h4>
                                <p>Un Probleme est survenue lors de L'Insertion</p>
			        </div>
			    </div>

 <?php
          
               }
              endif;
              
              ?>
</div>
    <form action=" <?php echo $_SERVER["REQUEST_URI"];?>" method='POST' name="formulaire" >
         <div class="col-lg-12">
             <h2>Formulaire d'entree de Personnel</h2>
         </div>
  
  <div class="form-group col-sm-6">
      <label for="noms">Nom :<mark style="color:red">*</mark></label>
     <input type="text" class="form-control" name="nom" placeholder='nom' required="true">
     <input type="hidden" id="ol" value="-1">
  </div>
   <div class="form-group col-sm-6">
     <label for="noms">Prenom(s) :<mark style="color:red">*</mark></label>
     <input type="text" class="form-control" name="prenom" placeholder='Prenom(s)' required="true">
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
    <label for="validite">Foncion:<mark style="color:red">*</mark></label>
    <input type="text" class="form-control" placeholder="fonction personnel" name="fonction" required="true" >
  </div>
      <div class="form-group col-sm-6 col-lg-6">
       <label for="nom">services:<mark style="color:red">*</mark></label>
       <select class="form-control" id="sel1" 
               required="true" name="serviceP">
           <option></option>
  <?php  echo genererListeDeroulante("services","designation","hf" ) ;  ?>
  </select>
  </div>
  <div class="col-sm-12  col-lg-12 col-xs-12">
  <button type="submit" class="btn btn-default btn-success"  value='Enregistrer'>Enregister Le Personnel</button>
     </div>
</form>  
    <?php 
    $sql4="select personnel.id,personnel.nom,personnel.prenom,services.designation,personnel.fonction
FROM personnel
INNER JOIN services ON services.id=personnel.service
WHERE personnel.actif='actif' ORDER BY personnel.nom";
 $entete=array("nom"=>"Nom ","prenom"=>"prenom","designation"=>"service");
     //$entete=null;           
  $tab=new Tableau($sql4,"col-lg-12",'<div>',"Liste De Tous le Personnel Enregistré",$entete);
  
   echo $tab->leTableau;
    ?>
</div>

