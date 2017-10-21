<?php
include 'entete.php';
  include 'bordure.php';

  /*
   * 
   */
   $sql2="SELECT entree_produit_fini.id,entree_produit_fini.dateString,entree_produit_fini.bordereaux,entree_produit_fini.quantite,entree_produit_fini.stocks_avant,"
      ." entree_produit_fini.stocks_apres,entree_produit_fini.date,"
      ." magasin.id as idM,magasin.designation as nomMag"
      ." FROM `entree_produit_fini`"
      ." INNER JOIN magasin ON magasin.id=entree_produit_fini.magasin"
      . " WHERE entree_produit_fini.type='PRODUCTION' "
      . " AND  entree_produit_fini.date=CURRENT_DATE() ORDER BY entree_produit_fini.date DESC";
   
  $sqlTout="SELECT entree_produit_fini.id,entree_produit_fini.dateString,entree_produit_fini.bordereaux,entree_produit_fini.quantite,entree_produit_fini.stocks_avant,"
      ." entree_produit_fini.stocks_apres,entree_produit_fini.date,"
      ." magasin.id as idM,magasin.designation as nomMag"
      ." FROM `entree_produit_fini`"
      ." INNER JOIN magasin ON magasin.id=entree_produit_fini.magasin"
      . " WHERE entree_produit_fini.type='PRODUCTION' ORDER BY entree_produit_fini.date DESC";
    if(count($db->selectInTab($sql2))>0){
    $entete=array("bordereaux"=>"Bor Prod.","quantite"=>"quantite","stocks_avant"=>"stock avant",
          "stocks_apres"=>"stock apres",
        "nomMag"=>"Magasin","date"=>"date");
      $entetes= $entete=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant",
          "stocks_apres"=>"stocks_apres",
        "nomMag"=>"nomMag","date"=>"date");
     //$entete=null;   
       echo '<div id="page-wrapper">';
  $tab=new Tableau($sql2,"col-lg-12",'<div>',"Liste De Toutes les Productions De Carton Mc de Aujourd'hui ",$entete,$entetes);
  
  echo $tab->leTableau;
    }
    else{
     echo "<marquee><strong style='color:red'>Aucune Production  de <mark>Carton Mc</mark> N'a encore été Effectuée pour la Journée de Aujourd'hui</strong></marquee>"     ;          
     }
       if(count($db->selectInTab($sqlTout))>0){
      $entete=array("bordereaux"=>"Bor Prod.","quantite"=>"quantite","stocks_avant"=>"stock avant",
          "stocks_apres"=>"stock apres",
        "nomMag"=>"Magasin","date"=>"date");
      $entetes= $entete=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant",
          "stocks_apres"=>"stocks_apres",
        "nomMag"=>"nomMag","date"=>"date");
     //$entete=null;           
  $tab=new Tableau($sqlTout,"col-lg-12",'<div id="page-wrapper">',"Liste De Toutes les Productions De Carton Mc ",$entete,$entetes,"dataTables-examples");
  
  echo $tab->leTableau;
       }
          echo '</div>';
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>

