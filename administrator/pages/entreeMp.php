<?php



        /**
         * requet pour la date de Aujourd'hui  entree_produit.date=CURRENT_DATE()
         */
         

include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4=" SELECT entree_produit.id,entree_produit.date,entree_produit.dateString as dateEntree,entree_produit.numeroVehicule,entree_produit.derniere_modif,"
                . " entree_produit.libelle,entree_produit.quantite,entree_produit.stocks_avant," 
            ." entree_produit.stocks_apres,articles.id as idArticle,articles.designation as designationArticle," 
            ." fournisseur.id as idFournisseur,fournisseur.nom,magasin.id as idM,magasin.designation as nomMag," 
            ." demandeachat.id as idDemande,demandeachat.bordereaux" 
            ." FROM `entree_produit`" 
            ." INNER JOIN fournisseur ON fournisseur.id=entree_produit.fournisseur" 
            ." INNER JOIN demandeachat ON demandeachat.id=entree_produit.demandeAchat" 
            ." INNER JOIN magasin ON magasin.id=entree_produit.magasin" 
            ." INNER JOIN articles ON articles.id=entree_produit.article "
                ."WHERE 1 ORDER BY derniere_modif DESC";  
  $sqlA=" SELECT entree_produit.id,entree_produit.date,entree_produit.dateString as dateEntree,entree_produit.numeroVehicule,entree_produit.derniere_modif,"
                . " entree_produit.libelle,entree_produit.quantite,entree_produit.stocks_avant," 
            ." entree_produit.stocks_apres,articles.id as idArticle,articles.designation as designationArticle," 
            ." fournisseur.id as idFournisseur,fournisseur.nom,magasin.id as idM,magasin.designation as nomMag," 
            ." demandeachat.id as idDemande,demandeachat.bordereaux" 
            ." FROM `entree_produit`" 
            ." INNER JOIN fournisseur ON fournisseur.id=entree_produit.fournisseur" 
            ." INNER JOIN demandeachat ON demandeachat.id=entree_produit.demandeAchat" 
            ." INNER JOIN magasin ON magasin.id=entree_produit.magasin" 
            ." INNER JOIN articles ON articles.id=entree_produit.article "
            ." WHERE entree_produit.date=CURRENT_DATE() ORDER BY derniere_modif DESC";  
    if(count($db->selectInTab($sqlA))>0)
     {
       //  echo $sqlA;
          $entetes=array("designationArticle"=>"article","date"=>"date Entree","bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks avant","stocks_apres"=>"stocks apres"
      ,"nom"=>"nom du fournisseur","numeroVehicule"=>"ehicule number" );
  $entete=array("designationArticle"=>"designationArticle","date"=>"date","bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres"
      ,"nom"=>"nom","numeroVehicule"=>"numeroVehicule" );
    // var_dump($entetes);
     //$entete=null;           
     $tabi=new Tableau($sqlA,"col-lg-12","Listes des entrees de Mp de cette journee",$entetes,$entete);
  
  echo $tabi->leTableau;
     }
     else{

     echo "<marquee><strong style='color:red'>Aucune Entree de <mark>Matiere Premiere</mark> N'a encore été Effectuée pour la Journée de Aujourd'hui</strong></marquee>"     ;
     }
   if(count($db->selectInTab($sql4))>0)
     {
   $entetes=array("designationArticle"=>"article","date"=>"date Entree","bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks avant","stocks_apres"=>"stocks apres"
      ,"nom"=>"nom du fournisseur","numeroVehicule"=>"ehicule number" );
  $entete=array("designationArticle"=>"designationArticle","date"=>"date","bordereaux"=>"bordereaux","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres"
      ,"nom"=>"nom","numeroVehicule"=>"numeroVehicule" );
    // var_dump($entetes);
     //$entete=null;           
     $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Listes de ttes Les entrees Mp",$entetes,$entete);
  
  echo $tab->leTableau;
     }
  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->
    

</html>
