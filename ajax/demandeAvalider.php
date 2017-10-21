  <?php
     header('Content-type:text');
        include_once '../core/config.php';
        include_once '../core/classes/modelPersonnel.php';
          $idEntree=$pos['da'];
         $codeBordereaux=$pos['bor'];
         $nbreArticle=$pos['nbre'];
          $sqlDemenadeur="SELECT demandeachat.demandeur,demandeachat.date,personnel.fonction,demandeachat.bordereaux,personnel.nom,personnel.prenom"
                        . " FROM demandeachat  "
                        . " INNER JOIN personnel ON personnel.id=demandeachat.demandeur "
                        . " WHERE demandeachat.id=$idEntree";
          $sqlServiceDesignationDemandeur="SELECT demandeachat.service,services.designation FROM demandeachat"
                        . " INNER JOIN services ON services.id=demandeachat.service"
                        . " WHERE demandeachat.id=$idEntree";
          $infServiceDemandeur=$db->selectInTab($sqlServiceDesignationDemandeur);
           $serviceDemandeur=$infServiceDemandeur[0]['designation'];
          $infDemandeur=null;
          $infDemandeur=$db->selectInTab($sqlDemenadeur);
          $nomDemandeur=$infDemandeur[0]['nom'];
          $prenomDemandeur=$infDemandeur[0]['prenom'];
          $serviceDesignation=$_SESSION['Nomservice'];
          $fonctionDemandeur=$infDemandeur[0]['fonction'];
          $dateCreation=$infDemandeur[0]['date'];
        
         
  ?>
  <html lang="en">
<head>
         <link href="../css/style.css" rel="stylesheet" />
	 <link type="text/css" rel="stylesheet" href="../assets/stylePersonel.css">

</head>
    <body class="wrapper">
         
        <div class="container" class="conteneur">
           <head class='row parie1'>
           <div class="col-xs-3 col-md-2 col-lg-2 logo"><img src="img/LogoMc.jpg" class="imageMc" alt="NotreLogo"></div>
            <div class="col-xs-4 col-md-6 col-lg-8">
                   <table class='table table-bordered'>
                       <thead>
                           <tr>
                               <th><p class="center-block TitreFeuille">FICHE DE DEMANDE D'ACHAT </p>
                       </th>
                           </tr>
                       </thead> 
                   </table>
            </div>
            <input type="hidden"  id="champCacher" value="N°:Aucun">
            <div class="col-xs-4 col-md-3 col-lg-2">
            </div>
             <div class="col-xs-4 col-md-3 col-lg-2"><P>Date: <?php echo $dateCreation; ?>
                      </p><p id='bordereaux'>N°:<Strong ><?php echo $codeBordereaux; ?></strong></p>
            </div>
           <div class="">
           </div>
          </head>
            <div class='row'>
            </div>
            <div class='row partie2'>
                <div  class='col-lg-12'>
                    <form id="" methode="POST" action="#">
                        <div class="row">
                            <div class="col-lg-8">
              <div class="form-group-sm">
                   <div class="row">
                        <div class="col-md-3"><label for="NomDemandeur"><i class="icon-lock"></i> <b>Nom et Prenom(s):</b></label>  </div>
                        <div class="col-md-5"><label for="NomDemandeurs"><i class="icon-lock"></i> <strong><?php echo $nomDemandeur.' '.$prenomDemandeur ;?></strong></label></div>
                   </div>
                </div> 
                   <div class="form-group-sm">
                   <div class="row">
                        <div class="col-md-3"><label for="ServiceDemandeur"><i class="icon-lock"></i> <b>Service:</b></label>  </div>
                        <div class="col-md-4"><label for="ServiceDemandeurs"><i class="icon-lock"></i> <strong><?php echo $serviceDemandeur; ?></strong></label> </div>
                   </div>
                 </div> 
                            </div>
						</div>
                            </div>
                        </div>

        <div class='row partie3'>
               <div  class=' col-xs-12 col-lg-12 col-md-12 col-sm-12  table-responsive ' id="tableauAgenerAvecSenData"> 
                    <table class='table table-bordered'>
                   <thead>
<tr class=''>
      <th class="10p">N°</th>
      <th class="10p">code article</th>
      <th class="60p">code Famille</th>
      <th class="10p">Qté cmdé</th>
      <th class="10p">unite</th>
      <th class="10p">Stocks Theo</th>
      <th class="60p">designation</th>
      <th class="10p">Observation</th>
      <th class="10p">Justificatifs</th>
</tr>
                   </thead>
                   <div id='corpsTableauArticles'>
<tbody>
<div id="number1">
     <?php  
          $sqlT="SELECT articlesdemandeachat.quantiter  as quantiteDemander,articlesdemandeachat.id as idADA,articlesdemandeachat.observation,articlesdemandeachat.justificatif,
              stocks.quantite as stocks,articles.code,
              articles.designation as designation,articles.unite,famille.code as codeFamille 
              FROM articlesdemandeachat
              INNER JOIN articles on articles.id=articlesdemandeachat.article
              INNER JOIN famille on famille.id=articles.famille
              INNER JOIN stocks on stocks.articles=articles.id
              WHERE articlesdemandeachat.demandeAchat=$idEntree
              ORDER BY articlesdemandeachat.dateInsertion";
            $infoArticles=$db->selectInTab($sqlT);
           $compteur=1;
     foreach ($infoArticles as $ligne ): 
          //echo 'quantiterArt'.$compteur;
         ?>
    
    <tr class='tab-content' >
        <td><?php echo $compteur; ?></td>
        <td class="codeArticle1"><?php echo $ligne['code']; ?></td>
        <td class="codeFamille1"><?php echo $ligne['codeFamille']; ?></td>
        <?php if($_SESSION['fonction']=='RESPONSABLE' and $serviceDesignation=='ACHAT ET PRODUCTION') {?>
        <td><input type="number" id="<?php echo 'quantiterArt'.$compteur; ?>" value="<?php echo $ligne['quantiteDemander']; ?>"></td>
        <?php } else{?>
            <td><?php echo $ligne['quantiteDemander']; ?></td>
        <?php } ?>
            <td class="quantiteStocks1"><?php echo $ligne['unite']; ?></td>
        <td class="quantiteStocks1"><?php echo $ligne['stocks']; ?></td>
        <input type="hidden" id="<?php echo 'article'.$compteur; ?>" value="<?php echo $ligne['idADA']; ?>">
        <td><?php echo $ligne['designation']; ?></td>
        <td><textarea type="text"  class="observation1" placeholder="<?php echo $ligne['observation']; ?>"></textarea></td>
        <td><textarea type="text"   class="justification1" placeholder="<?php echo $ligne['justificatif']; ?>"></textarea></td>
    </tr>
    <?php
             $compteur++;
    endforeach;  ?>
    </div>

</tbody>
                   </div>
                </table></div>
            </div>    
          
            <div class='row partie4'>
                <div  class='col-xs-12 col-lg-12 col-md-12 col-sm-12'>
                        <table class='table table-bordered'>
                   <thead>
</thead>
   <?php
                  $signe="oui";
                 $sqlS="SELECT suivi_validation.derniere_modif as date,personnel.nom,personnel.prenom 
                        FROM suivi_validation
                        INNER JOIN personnel on suivi_validation.signataire=personnel.id
                        WHERE  suivi_validation.demandeAchat=$idEntree  and estSigne=\"$signe\" ORDER BY derniere_modif";
                 $liste=$db->selectInTab($sqlS);
                 $nombrePersonne=count($liste);
      ?>
<tbody>
    <tr class='tab-content'>
        <td>
            <p><strong>NOM</strong></p>
            <p><strong>+</strong></p>
            <p><strong>VISA</strong></p>
        </td>
           <?php
         //    var_dump($liste);
//                 $compteur=1;
//               foreach ($liste as $inf):
                if($nombrePersonne==1):
               ?>
        <td class="ChampSignaturenewRequest">
            <p id="nomPremier"><strong><?php echo $liste[0]['nom'].' '.$liste[0]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[0]['date']; ?></p>  
        </td>
         <?php ?>
        <td class="ChampSignaturenewRequest">
               <p>          </p>
               <p>          </p>    
        </td >
        <td class="ChampSignaturenewRequest">
               <p>         </p>
               <p>         </p>  
        </td>
       
        <td class="ChampSignaturenewRequest">
            <p> <strong>NON VALABLE POUR<strong></p>
                        <p><strong>UNE COMMANDE A UN</strong></p> 
                        <p><strong>FOURNISSEUR</strong></p>
        </td>
         <td class="ChampSignaturenewRequest">
             <p></p>
               <p></p> 
        </td>
        <?php           endif; 
        
        
       if($nombrePersonne==2):
               ?>
        <td class="ChampSignaturenewRequest">
            <p id="nomPremier"><strong><?php echo $liste[0]['nom'].' '.$liste[0]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[0]['date']; ?></p>  
        </td>
         <?php ?>
        <td class="ChampSignaturenewRequest">
               <p id="nomPremier"><strong><?php echo $liste[1]['nom'].' '.$liste[1]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[1]['date']; ?></p>  
        </td >
        <td class="ChampSignaturenewRequest">
               <p>         </p>
               <p>         </p>  
        </td>
       
        <td class="ChampSignaturenewRequest">
            <p> <strong>NON VALABLE POUR<strong></p>
                        <p><strong>UNE COMMANDE A UN</strong></p> 
                        <p><strong>FOURNISSEUR</strong></p>
        </td>
         <td class="ChampSignaturenewRequest">
             <p></p>
               <p></p> 
        </td>
        <?php           endif;
           if($nombrePersonne==3):
               ?>
        <td class="ChampSignaturenewRequest">
            <p id="nomPremier"><strong><?php echo $liste[0]['nom'].' '.$liste[0]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[0]['date']; ?></p>  
        </td>
         <?php ?>
        <td class="ChampSignaturenewRequest">
               <p id="nomPremier"><strong><?php echo $liste[1]['nom'].' '.$liste[1]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[1]['date']; ?></p>  
        </td >
        <td class="ChampSignaturenewRequest">
                <p id="nomPremier"><strong><?php echo $liste[2]['nom'].' '.$liste[2]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[2]['date']; ?></p>   
        </td>
       
        <td class="ChampSignaturenewRequest">
            <p> <strong>NON VALABLE POUR<strong></p>
                        <p><strong>UNE COMMANDE A UN</strong></p> 
                        <p><strong>FOURNISSEUR</strong></p>
        </td>
         <td class="ChampSignaturenewRequest">
             <p></p>
               <p></p> 
        </td>
        <?php           endif;
               if($nombrePersonne==4):
               ?>
        <td class="ChampSignaturenewRequest">
            <p id="nomPremier"><strong><?php echo $liste[0]['nom'].' '.$liste[0]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[0]['date']; ?></p>  
        </td>
         <?php ?>
        <td class="ChampSignaturenewRequest">
               <p id="nomPremier"><strong><?php echo $liste[1]['nom'].' '.$liste[1]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[1]['date']; ?></p>  
        </td >
        <td class="ChampSignaturenewRequest">
                <p id="nomPremier"><strong><?php echo $liste[2]['nom'].' '.$liste[2]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[2]['date']; ?></p>   
        </td>
       
        <td class="ChampSignaturenewRequest">
            <p> <strong>NON VALABLE POUR<strong></p>
                        <p><strong>UNE COMMANDE A UN</strong></p> 
                        <p><strong>FOURNISSEUR</strong></p>
        </td>
         <td class="ChampSignaturenewRequest">
               <p id="nomPremier"><strong><?php echo $liste[2]['nom'].' '.$liste[2]['prenom']; ?></strong></p>
              <p id="datePremier"><?php echo $liste[2]['date']; ?></p>   
        </td>
        <?php           endif;
        ?>
    </tr>
</tbody>
                </table> 
                    
                </div>
            </div>   
            <div class='row partie5'>
                <div  class='col-lg-6 col-sm-6 col-md-6 col-xs-6'></div>
                <div class='col-offset-3 col-xs-3 col-lg-3 col-md-3 col-sm-3'>
                    <input type="button" class="btn btn-danger" value="Annuler"  onclick="ValiderDemande('<?php echo $idEntree; ?>','milieu','ajax/pageAnnulationDemande.php','ajourner','<?php echo $serviceDesignation; ?>','<?php echo $_SESSION['fonction']; ?>',0)"></input></div>
                     <div  class='col-xs-3 col-lg-3 col-md-3 col-sm-3'>
                         <input type="button" class="btn btn-success"  value="Approuver" onclick="ValiderDemande('<?php echo $idEntree; ?>','<?php echo $codeBordereaux; ?>','milieu','ajax/pageValidation.php','valider','<?php echo $serviceDesignation; ?>','<?php echo $_SESSION['fonction']; ?>','<?php echo $nbreArticle; ?>')"></input></div>
            </div>   
        </div>
        </form>
                </div>
    </div>
    </body>
   
     

