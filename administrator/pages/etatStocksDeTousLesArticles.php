<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4="SELECT stocks.quantite,stocks.id, articles.designation, famille.designation as famille
FROM `stocks`
INNER JOIN articles ON articles.id = stocks.articles
INNER JOIN famille ON famille.id = articles.famille
WHERE 1 ";
 $entete=array("designation"=>"designation","quantite"=>"quantite","famille"=>"famille");
     //$entete=null;           
  $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Liste De Tous le stocks articles complets",$entete,$entete);
  
  echo $tab->leTableau;
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>
