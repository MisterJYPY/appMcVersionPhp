<div id="page-wrapper"> 
<div class="row">
              <?php 
              if(isset($pos['secteur-zones'])):
        /* @var $nom type */
        $secteurZ=$pos['secteur-zones'];
        /* @var $prenom type */
        $personel=$pos['personnel'];
        /* @var $contact type  */
            if($db->insertdata('secteur_zone_ad',array(array("secteur_zone"=>$secteurZ ,"personnel"=>$personel 
               )))){?>
                   <div class="col-lg-4">
	                     	<div class="alert alert-dismissable alert-success">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4>reussite Liaison du AD au secteur </h4>
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
    <div class="row">
    <form action=" <?php echo $_SERVER["REQUEST_URI"];?>" method='POST' name="formulaire" >
         <div class="col-lg-12">
             <h2>Formulaire de Liaison d'un AD à un Secteur</h2>
         </div>
  
  <div class="form-group col-sm-6 col-lg-6">
       <label for="nom">Agent Distributeur:<mark style="color:red">*</mark></label>
       <select class="form-control" id="sel1" 
               required="true" name="personnel">
           <option></option>
  <?php   $sql="SELECT personnel.id, personnel.nom, personnel.prenom 
FROM personnel
WHERE personnel.fonction='AGENT DISTRIBUTEUR' and personnel.id NOT IN (select secteur_zone_ad.personnel FROM secteur_zone_ad )";
  echo genererListeDeroulanteRequete($sql, "nom","prenom") ;   ?>
  </select>
  </div>
    <div class="form-group col-sm-6 col-lg-6">
       <label for="nom">Seceur-Zone:<mark style="color:red">*</mark></label>
       <select class="form-control" id="sel1" 
               required="true" name="secteur-zones">
           <option></option>
  <?php   $sql="SELECT secteur_zone.id, secteur_zone.secteur, zone.designation AS zone
FROM secteur_zone
INNER JOIN zone ON zone.id = secteur_zone.zone
WHERE 1";
  echo genererListeDeroulanteRequete($sql, "zone","secteur") ;  ?>
  </select>
  </div>
  
  <div class="">
  <button type="submit" class="btn btn-default btn-success"  value='Enregistrer'>Lié cet Agent</button>
     </div>
</form>  
    </div>
    <div class="row">
        <div class="col-lg-12">
      
    <?php
   
    ?>
    </div>
             <?php
        $sql="SELECT secteur_zone_ad.personnel, secteur_zone_ad.id, personnel.nom, personnel.prenom, secteur_zone.secteur,zone.designation
FROM `secteur_zone_ad`
INNER JOIN personnel ON personnel.id = secteur_zone_ad.personnel
INNER JOIN secteur_zone ON  secteur_zone_ad.secteur_zone=secteur_zone.id
INNER JOIN zone ON zone.id=secteur_zone.zone
WHERE 1 ";
     if(count($db->selectInTab($sql))>0):
     $entete=array("nom"=>"nom","prenom"=>"prenom(s)","designation"=>"zone","secteur"=>"secteur");
       $entetes=array("nom"=>"nom","prenom"=>"prenom","designation"=>"designation","secteur"=>"secteur");
     //$entete=null;           
  $tab=new Tableau($sql,"col-lg-12",'<div> ',"Liste Des AD dejà lié au secteur-zone",$entete,$entetes);
  // echo '<div id="page-wrapper">';
  echo $tab->leTableau;
  endif;
  ?>
             
        </div>
</div>


