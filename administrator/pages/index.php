<?php 
     include_once 'entete.php';
      include 'bordure.php'; 
      /*
       * code pour avoir la date du premier jour du Mois en cour
       */
        $today = date("Y-m-d"); 
        $days= date("d")-1;
        echo $year=date("Y");
         $firstJ=$year."-01-01";
        $date = date_create( $today);
        date_sub($date, date_interval_create_from_date_string("$days days"));
       
   $debut_mois=date_format($date, 'Y-m-d');
   //les requetes pour le mois
   $sqlProduction="SELECT SUM(quantite) as qt FROM entree_produit_fini WHERE entree_produit_fini.`date` BETWEEN '$debut_mois' AND '$today' AND entree_produit_fini.`type`='PRODUCTION'";       
   $sqlRetour="SELECT SUM(quantite) as qt FROM retour_produit_fini WHERE retour_produit_fini.`date` BETWEEN '$debut_mois' AND '$today'";
   $sqlVente="SELECT SUM(quantite) as qt FROM vente_produit_fini WHERE vente_produit_fini.`date` BETWEEN '$debut_mois' AND '$today'";
   $sqlConsommation="SELECT SUM(quantite) as qt FROM consommation_produit_fini WHERE consommation_produit_fini.`date` BETWEEN '$debut_mois' AND '$today'";
     //initialisation des variables
             $prod=0;
			 $retr=0;
			 $vente=0;
			 $conso=0;
          // echo $sqlProduction;
           $prod=$db->selectInTab($sqlProduction)[0]['qt'];
           $retr=$db->selectInTab($sqlRetour)[0]['qt'];
           $Vente=$db->selectInTab($sqlVente)[0]['qt'];
           $Conso=$db->selectInTab($sqlConsommation)[0]['qt'];
           
   //les requetes pour l'annee
   $sqlProductionA="SELECT SUM(quantite) as qt FROM entree_produit_fini WHERE entree_produit_fini.`date`>='$firstJ' AND entree_produit_fini.`type`='PRODUCTION'";       
   $sqlRetourA="SELECT SUM(quantite) as qt FROM retour_produit_fini WHERE retour_produit_fini.`date`>='$firstJ'";
   $sqlVenteA="SELECT SUM(quantite) as qt FROM vente_produit_fini WHERE vente_produit_fini.`date`>='$firstJ'";
   $sqlConsommationA="SELECT SUM(quantite) as qt FROM consommation_produit_fini WHERE consommation_produit_fini.`date`>='$firstJ'";
      
             $prodA=$db->selectInTab($sqlProductionA)[0]['qt'];
             $retrA=$db->selectInTab($sqlRetourA)[0]['qt'];
             $VenteA=$db->selectInTab($sqlVenteA)[0]['qt'];
             $ConsoA=$db->selectInTab($sqlConsommationA)[0]['qt'];
             
           //avoir le Nombre de Demande A chat effectuées de Mat Premiere
          $sql4="SELECT demandeachat.bordereaux as code,demandeachat.`date`,CONCAT(personnel.nom,CONCAT(' ',personnel.prenom)) as nom,services.designation as des " 
                 ."FROM demandeachat INNER JOIN services ON services.id=demandeachat.service  " 
                 ."INNER JOIN personnel ON personnel.id=demandeachat.demandeur " 
                 ."WHERE demandeachat.id IN( SELECT cotation.demandeAchat FROM cotation WHERE cotation.id IN(SELECT fournisseursurcotation.cotation FROM fournisseursurcotation )) " 
                 ."AND demandeachat.id  IN (SELECT demandesatisfaite.demandeAchat FROM demandesatisfaite) "
                 ."AND demandeachat.id IN (SELECT articlesdemandeachat.demandeAchat FROM articlesdemandeachat WHERE articlesdemandeachat.article IN(SELECT articles.id FROM articles WHERE articles.famille=(SELECT famille.id FROM famille WHERE famille.designation='Matiere premiere')))";
       $nbreDemandeM=Count($db->selectInTab($sql4));
       //avoir le Nombre de demande effectues satisfaite pour les Autres Produis
            $sqlAp="SELECT demandeachat.bordereaux as code,demandeachat.`date`,CONCAT(personnel.nom,CONCAT(' ',personnel.prenom)) as nom,services.designation as des "
                 ."FROM demandeachat INNER JOIN services ON services.id=demandeachat.service  " 
                 ."INNER JOIN personnel ON personnel.id=demandeachat.demandeur " 
                 ."WHERE demandeachat.id IN( SELECT cotation.demandeAchat FROM cotation WHERE cotation.id IN(SELECT fournisseursurcotation.cotation FROM fournisseursurcotation )) "
                 ."AND demandeachat.id  IN (SELECT demandesatisfaite_autreproduit.demandeAchat FROM demandesatisfaite_autreproduit) " 
                 ."AND demandeachat.id IN (SELECT articlesdemandeachat.demandeAchat FROM articlesdemandeachat WHERE articlesdemandeachat.article IN(SELECT articles.id FROM articles WHERE articles.famille IN (SELECT famille.id FROM famille WHERE famille.designation!='Matiere premiere')))";
       
        $nbreDemandeAp=Count($db->selectInTab($sqlAp));
            
            include 'contentIndex.php';
        
        
   include 'script.php';?>

</body>

</html>
