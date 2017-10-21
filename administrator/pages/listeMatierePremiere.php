<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4="select stocks.quantite as qte,articles.designation ,articles.id,stocks.derniere_modif as der
  FROM stocks
  INNER JOIN articles ON stocks.articles=articles.id AND articles.famille=(SELECT id FROM famille WHERE designation='Matiere premiere')
  WHERE 1";
  
     $entetes=array("designation"=>"Designation article","qte"=>"quantite","der"=>"Derniere Modif Stocks");
     $entete=array("designation"=>"designation","qte"=>"qte","der"=>"der");
    
    // var_dump($entetes);
     //$entete=null;           
     $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Listes Des Matieres Premieres",$entetes);
  
      echo $tab->leTableau;
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>