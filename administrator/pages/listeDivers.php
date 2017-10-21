<?php
include 'entete.php';
  include 'bordure.php';

  $sql2="SELECT consommation_produit_fini.id,consommation_produit_fini.dateString,consommation_produit_fini.bordereaux,consommation_produit_fini.quantite,consommation_produit_fini.stocks_avant," 
." consommation_produit_fini.motif,consommation_produit_fini.date,consommation_produit_fini.stocks_apres," 
." magasin.designation as designationM,magasin.id as idM FROM `consommation_produit_fini`"
." INNER JOIN magasin ON magasin.id=consommation_produit_fini.magasin "
              . "WHERE 1 ORDER BY consommation_produit_fini.date DESC";
           //System.out.println("Liste des ventes actuelles : "+md_contenuVente.listeDesVentes(sql2));
      $sqlojd="SELECT consommation_produit_fini.id,consommation_produit_fini.dateString,consommation_produit_fini.bordereaux,consommation_produit_fini.quantite,consommation_produit_fini.stocks_avant," 
." consommation_produit_fini.motif,consommation_produit_fini.date,consommation_produit_fini.stocks_apres," 
." magasin.designation as designationM,magasin.id as idM FROM `consommation_produit_fini`"
." INNER JOIN magasin ON magasin.id=consommation_produit_fini.magasin "
   . "WHERE consommation_produit_fini.date=CURRENT_DATE() ORDER BY consommation_produit_fini.date DESC";
      
    if(count($db->selectInTab( $sqlojd))>0){
    $entete=array("bordereaux"=>"Bor Divers","quantite"=>"quantite","stocks_avant"=>"stock avant","stocks_apres"=>"stock apres",
          "motif"=>"motif","designationM"=>"Magasin","date"=>"date");
   $entetes=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres",
          "motif"=>"motif","designationM"=>"designationM","date"=>"date"); 
     //$entete=null;           
  $tab=new Tableau( $sqlojd,"col-lg-12",'<div id="page-wrapper">',"Liste De Toutes les Consommations De Carton Mc de Aujourd'hui ",$entete,$entetes);
  
  echo $tab->leTableau;
    }
    else{
     echo "<marquee><strong style='color:red'>Aucune Vente de <mark>Carton Mc</mark> N'a encore été Effectuée pour la Journée de Aujourd'hui</strong></marquee>"     ;          
     }
       if(count($db->selectInTab($sql2))>0){
      $entete=array("bordereaux"=>"Bor Divers","quantite"=>"quantite","stocks_avant"=>"stock avant","stocks_apres"=>"stock apres",
          "motif"=>"motif","designationM"=>"Magasin","date"=>"date");
   $entetes=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres",
          "motif"=>"motif","designationM"=>"designationM","date"=>"date"); 
     //$entete=null;           
  $tab=new Tableau($sql2,"col-lg-12",'<div id="page-wrapper">',"Liste De Toutes les Consommations De Carton Mc ",$entete,$entetes,"dataTables-examples");
   echo $tab->leTableau;
       }
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>

