<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
   $id=$get['id'];
   // include 'contenu/tableauRes.php';
  $sql4="select personnel.id,personnel.nom,personnel.prenom,services.designation,personnel.fonction
FROM personnel
INNER JOIN services ON services.id=personnel.service
WHERE personnel.actif='actif' AND personnel.fonction='AGENT DISTRIBUTEUR'";
 $entete=array("nom"=>"Nom ","prenom"=>"prenom","designation"=>"service");
     //$entete=null;           
  $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Liste Des Agents Distributeur enregistré",$entete);
  
  echo $tab->leTableau;
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>

