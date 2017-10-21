<?php
include 'entete.php';
  include 'bordure.php';


  $sql2="
      SELECT vente_produit_fini.id,vente_produit_fini.dateString,vente_produit_fini.bordereaux,vente_produit_fini.quantite,vente_produit_fini.stocks_avant," 
." vente_produit_fini.stocks_apres,vente_produit_fini.date,personnel.id as idP,concat(personnel.nom,concat(' ',personnel.prenom)) as nomP ," 
." clients.nom as nomC ,clients.id as idC FROM`vente_produit_fini`" 
." INNER JOIN clients ON clients.id=vente_produit_fini.client "
." INNER JOIN personnel ON personnel.id=vente_produit_fini.personnel " 
." WHERE vente_produit_fini.date=CURRENT_DATE()  ORDER BY vente_produit_fini.date DESC";
           //System.out.println("Liste des ventes actuelles : "+md_contenuVente.listeDesVentes(sql2));
      $sqlAll="SELECT vente_produit_fini.id,vente_produit_fini.dateString,vente_produit_fini.bordereaux,vente_produit_fini.quantite,vente_produit_fini.stocks_avant," 
." vente_produit_fini.stocks_apres,vente_produit_fini.date,personnel.id as idP,concat(personnel.nom,concat(' ',personnel.prenom)) as nomP ," 
." clients.nom as nomC ,clients.id as idC FROM`vente_produit_fini`" 
." INNER JOIN clients ON clients.id=vente_produit_fini.client "
." INNER JOIN personnel ON personnel.id=vente_produit_fini.personnel " 
." WHERE 1 ORDER BY vente_produit_fini.date DESC";
      
    if(count($db->selectInTab($sql2))>0){
    $entete=array("bordereaux"=>"Bor de Vente","quantite"=>"quantite","stocks_avant"=>"stock avant","stocks_apres"=>"stock apres",
          "nomC"=>"Nom Client","nomP"=>"nom du RDI","date"=>"date");
      $entetes=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres",
          "nomC"=>"nomC","nomP"=>"nomP","date"=>"date");
     //$entete=null;           
  $tab=new Tableau($sql2,"col-lg-12",'<div id="page-wrapper">',"Liste De Toutes les  Ventes De Carton Mc de Aujourd'hui ",$entete,$entetes);
  
  echo $tab->leTableau;
    }
    else{
     echo "<marquee><strong style='color:red'>Aucune Vente de <mark>Carton Mc</mark> N'a encore été Effectuée pour la Journée de Aujourd'hui</strong></marquee>"     ;          
     }
       if(count($db->selectInTab($sqlAll))>0){
      $entete=array("bordereaux"=>"Bor de Vente","quantite"=>"quantite","stocks_avant"=>"stock avant","stocks_apres"=>"stock apres",
          "nomC"=>"Nom Client","nomP"=>"nom du RDI","date"=>"date");
      $entetes=array("bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres",
          "nomC"=>"nomC","nomP"=>"nomP","date"=>"date");
     //$entete=null;           
  $tab=new Tableau($sqlAll,"col-lg-12",'<div id="page-wrapper">',"Liste De Toutes les  Ventes De Carton Mc ",$entete,$entetes,"dataTables-examples");
  
  echo $tab->leTableau;
       }
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>
