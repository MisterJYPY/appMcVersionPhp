<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4="select cotation.code_cotation as code,CONCAT(personnel.nom,CONCAT(' ',personnel.prenom)) as nom,
services.designation as des,cotation.date_envoi,cotation.id FROM cotation
INNER join demandeachat ON demandeachat.id=cotation.`demandeAchat`
INNER join personnel ON personnel.id=demandeachat.demandeur
INNER join services ON services.id=demandeachat.service
WHERE 1";
 $entete=array("nom"=>"demandeur","code"=>"code cotation","des"=>"service","date_envoi"=>"date creation");
     //$entete=null;           
  $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">  ',"Liste Des cotations",$entete);
  
  echo $tab->leTableau;
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>

