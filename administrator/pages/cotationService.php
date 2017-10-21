<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4="SELECT demandeachat.id,demandeachat.bordereaux as code,demandeachat.`date`,CONCAT(personnel.nom,CONCAT(' ',personnel.prenom)) as nom,services.designation as des "
                 ."FROM demandeachat INNER JOIN services ON services.id=demandeachat.service "
                 ."INNER JOIN personnel ON personnel.id=demandeachat.demandeur "
                  . " WHERE 1";
     $entete=array("nom"=>"Nom Demandeur","code"=>"bordereaux","date"=>"date demande","des"=>"Services");
     //$entete=null;           
  $tab=new Tableau($sql4,"col-lg-12","Les Demandes achats",$entete);
  
  echo $tab->leTableau;
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>