<?php
include 'entete.php';
  include 'bordure.php';

   

  $sql2="SELECT retour_produit_fini.id,retour_produit_fini.dateString,retour_produit_fini.bordereaux,retour_produit_fini.quantite,retour_produit_fini.stocks_avant," 
." retour_produit_fini.stocks_apres,retour_produit_fini.date,personnel.id as idP,concat(personnel.nom,concat(' ',personnel.prenom)) as nomP," 
." magasin.designation as designationM,magasin.id as idM FROM `retour_produit_fini`" 
. " INNER JOIN personnel ON personnel.id=retour_produit_fini.personnel"
." INNER JOIN magasin ON magasin.id=retour_produit_fini.magasin"
." WHERE 1 ORDER BY retour_produit_fini.date DESC";
           //System.out.println("Liste des ventes actuelles : "+md_contenuVente.listeDesVentes(sql2));
      $sqlojd="SELECT retour_produit_fini.id,retour_produit_fini.dateString,retour_produit_fini.bordereaux,retour_produit_fini.quantite,retour_produit_fini.stocks_avant," 
." retour_produit_fini.stocks_apres,retour_produit_fini.date,personnel.id as idP,concat(personnel.nom,concat(' ',personnel.prenom)) as nomP," 
." magasin.designation as designationM,magasin.id as idM FROM `retour_produit_fini`" 
. " INNER JOIN personnel ON personnel.id=retour_produit_fini.personnel"
." INNER JOIN magasin ON magasin.id=retour_produit_fini.magasin"
." WHERE retour_produit_fini.date=CURRENT_DATE() ORDER BY retour_produit_fini.date DESC";
      
    if(count($db->selectInTab( $sqlojd))>0){
    $entete=array("bordereaux"=>"Bor Retour","quantite"=>"quantite","stocks_avant"=>"stock avant","stocks_apres"=>"stock apres",
          "nomP"=>"Nom Rdi","designationM"=>"Magasin","date"=>"date");
   $entetes=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres",
          "nomP"=>"nomP","designationM"=>"designationM","date"=>"date"); 
     //$entete=null;           
  $tab=new Tableau( $sqlojd,"col-lg-12",'<div id="page-wrapper">',"Liste De Tous les Retours De Carton Mc de Aujourd'hui ",$entete,$entetes);
  
  echo $tab->leTableau;
    }
    else{
     echo "<marquee><strong style='color:red'>Aucun Retour de <mark>Carton Mc</mark> N'a encore été Effectuée pour la Journée de Aujourd'hui</strong></marquee>"     ;          
     }
       if(count($db->selectInTab($sql2))>0){
      $entete=array("bordereaux"=>"Bor Retour","quantite"=>"quantite","stocks_avant"=>"stock avant","stocks_apres"=>"stock apres",
          "nomP"=>"Nom Rdi","designationM"=>"Magasin","date"=>"date");
   $entetes=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres",
          "nomP"=>"nomP","designationM"=>"designationM","date"=>"date"); 
     //$entete=null;           
  $tab=new Tableau($sql2,"col-lg-12",'<div id="page-wrapper">',"Liste De Tous les Retours De Carton Mc ",$entete,$entetes,"dataTables-examples");
   echo $tab->leTableau;
       }
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>

