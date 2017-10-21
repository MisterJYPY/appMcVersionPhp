<?php
include 'entete.php';
include 'bordure.php';
 // include './menu.php';

   $id=$get['id'];

   // include 'contenu/tableauRes.php';
  $sql4=" SELECT sortie_produit.id,sortie_produit.date,sortie_produit.dateString as dateEntree,sortie_produit.derniere_modif,"
                . " sortie_produit.libelle,sortie_produit.quantite,sortie_produit.stocks_avant,"
            ." sortie_produit.stocks_apres,articles.id as idArticle,articles.designation as designationArticle,"
            ."magasin.id as idM,magasin.designation as nomMag"
            ." FROM `sortie_produit`"
            ." INNER JOIN magasin ON magasin.id=sortie_produit.magasin"
            ." INNER JOIN articles ON articles.id=sortie_produit.article "
                ."WHERE 1 ORDER BY derniere_modif DESC";
  $sqlA="  SELECT sortie_produit.id,sortie_produit.date,sortie_produit.dateString as dateEntree,sortie_produit.derniere_modif,"
                . " sortie_produit.libelle,sortie_produit.quantite,sortie_produit.stocks_avant,"
            ." sortie_produit.stocks_apres,articles.id as idArticle,articles.designation as designationArticle,"
            ." magasin.id as idM,magasin.designation as nomMag"
            ." FROM `sortie_produit`"
            ." INNER JOIN magasin ON magasin.id=sortie_produit.magasin"
            ." INNER JOIN articles ON articles.id=sortie_produit.article "
                ."WHERE  sortie_produit.date=CURRENT_DATE() ORDER BY derniere_modif DESC";
   //echo $sql4;
    if(count($db->selectInTab($sqlA))>0)
     {
       //  echo $sqlA;
          $entetes=array("designationArticle"=>"article","date"=>"date Entree","quantite"=>"quantite","stocks_avant"=>"stocks avant","stocks_apres"=>"stocks apres"
      ,"libelle"=>"bdr Sortie" );
  $entete=array("designationArticle"=>"designationArticle","date"=>"date","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres"
      , "libelle"=>"libelle");
    // var_dump($entetes);
     //$entete=null;
     $tabi=new Tableau($sqlA,"col-lg-12","Listes des Sortie de Mp de cette journee",$entetes,$entete);

  echo $tabi->leTableau;
     }
     else{

     echo "<marquee><strong style='color:red'>Aucune Sortie de <mark>Matiere Premiere</mark> N'a encore été Effectuée pour la Journée de Aujourd'hui</strong></marquee>"     ;
     }
   $entetes=array("designationArticle"=>"article","date"=>"date Entree","quantite"=>"quantite","stocks_avant"=>"stocks avant","stocks_apres"=>"stocks apres"
      ,"libelle"=>"bdr Sortie" );
  $entete=array("designationArticle"=>"designationArticle","date"=>"date","quantite"=>"quantite","stocks_avant"=>"stocks_avant","stocks_apres"=>"stocks_apres"
      , "libelle"=>"libelle");
    // var_dump($entetes);
     //$entete=null;
     $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Listes de ttes Les Sorties Mp",$entetes,$entete);

  echo $tab->leTableau;

  include './scriptData.php';
  ?>
</body>
 <!-- DataTables JavaScript -->


</html>
