<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4="SELECT *
FROM `clients`
NATURAL JOIN secteur_zone_localite
";
  
     $entetes=array("nom"=>"Nom et Prenom","contacts"=>"contacts","mail"=>"Mail","ville"=>"La localité");
      $entete=array("nom"=>"nom","contacts"=>"contacts","mail"=>"mail","ville"=>"ville");
    // var_dump($entetes);
     //$entete=null;           
     $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Listes Des Clients Mccroft Tobacco",$entetes,$entete);
  
  echo $tab->leTableau;
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>
