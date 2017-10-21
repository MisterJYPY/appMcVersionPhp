<?php
        require_once "../html2pdf/html2pdf.php";
        
 
ob_start();
         include_once '../core/config.php';
      //  include_once '../core/classes/modelPersonnel.php';
         $valeur=$get['da'];
         $cotation=$get['cot'];
                   /*             end of*/
         /**
           declaratio des informations relatifs aux fournisseurs
          */
         $nomFournisseur='Inconnu';
         $prenomFournisseur='Inconnu';
         $telecopie='Inconnu';
         $email='Inconnu';
         $delaiLivraison='Inconnu';
         $dateValidite='Inconnu';
         $conditionReglement='Inconnu';
         $attention='Inconnu';
         $concatNom='';
         //raffraichissement des info relatifs aux fournisseurs
         
         $idFournisseur=$get['fournisseur'];
         if($idFournisseur!='rien'){
         $idcotation=$get['cot'];
         $sqlF="SELECT * FROM fournisseur WHERE id=$idFournisseur";
         $resulF=$db->selectInTab($sqlF);
         $nomFournisseur=$resulF[0]['nom'];
         $email=$resulF[0]['mail'];
         $telecopie=$resulF[0]['telecopie'];
           /*Information Relatif aux livraisons */
       $sqlInfoSurLesDemande="SELECT * FROM fournisseursurcotation WHERE fournisseur=$idFournisseur and cotation=$cotation";
               $resutltInf=$db->selectInTab($sqlInfoSurLesDemande);
                 $attention=$resutltInf[0]['receptioniste'];
                 $conditionReglement=$resutltInf[0]['reglement'];
                 $delaiLivraison=$resutltInf[0]['delai_livraison'];
                 $dateValidite=$resutltInf[0]['validite'];
             /*end of */
         }
        //
          if($nomFournisseur=='Inconnu'){
             $concatNom='Inconnu';
          }
          else{
              $concatNom=$nomFournisseur;
             }
            
             $sql=" SELECT cotation.code_cotation,cotation.date_envoi as date,personnel.nom,personnel.prenom,personnel.mail
                     FROM cotation 
                      INNER JOIN personnel ON personnel.id=cotation.expediteur
                      INNER JOIN demandeachat ON demandeachat.id=cotation.demandeAchat
                      WHERE cotation.demandeAchat=$valeur";
                  
                  $inFdemande=$db->selectInTab($sql);
                      /*RECUPERATOION DU NOM ET PRENOM DU DEMANDEUR*/
                                 $nom=$inFdemande[0]['nom'];
                                 $prenom=$inFdemande[0]['prenom'];
                                 $mail=$inFdemande[0]['mail'];
                                 $code=$inFdemande[0]['code_cotation'];
                                 $date=$inFdemande[0]['date'];
                                 $service="ACHAT ET PRODUCTION";
                                /*EN OF RECUPERation */
                                 /*Informations concernant le delai de livraison*/
                                 
                                 /**/
                               /**/
          $sqlT="SELECT articlesdemandeachat.quantiter  as quantiteDemander,articlesdemandeachat.observation,articlesdemandeachat.justificatif,
              stocks.quantite as stocks,articles.code,
              articles.designation as designation,articles.unite,famille.code as codeFamille 
              FROM articlesdemandeachat
              INNER JOIN articles on articles.id=articlesdemandeachat.article
              INNER JOIN famille on famille.id=articles.famille
              INNER JOIN stocks on stocks.articles=articles.id
              WHERE articlesdemandeachat.demandeAchat=$valeur
              ORDER BY articlesdemandeachat.dateInsertion";
          $infoArticles=$db->selectInTab($sqlT);
                $compteur=1;
                              /**/
	?>
<style type="text/css">
    .normal{
        font-size:12px;
        font-weight:bold;
         }
    #mail{
        color:rgb(183,0,0);
    }
    #gras{
        font-size: 13px;
        font-weight: bold;
    }
img{
    width:100px;
    height:100px;
}
.table{
    width:100%;
}
page_header{
    display: inline-block;
}
.milieu{
    text-align: center;
}
.second{
    
  //  margin-left:29;
    
    
}
 .demande{
     font-size: 25px;
    font-weight: 400;
    border-width:1px;
    border-style:solid;
    border-color:black;
}
.troisiemeTable{
   margin-top: 20px;
    margin-bottom: 160px;  
}
/*table {
 border-width:1px; 
 border-style:solid; 
 border-color:black;
 width:50%;
 }*/
p{
   
}

 th {
 border:0.5px solid black;

 }
 .tab-content{
     border:1px solid black;
 //width:20%;
 }
 table{
     margin-right: 10px;
 }
 td{
     width: auto;
 }
 .border th {
		border: 1px solid #000;
		color: white;
		background: #000;
		//padding: 5px;
		font-weight: normal;
		font-size: 14px;
		text-align: center; }
	.border td {
		border: 1px solid #CFD1D2;
		padding: 5px 10px;
		text-align: center;
	}
        .border {
		width: 100%;
		color: #717375;
		font-family: helvetica;
		//line-height: 5mm;
		border-collapse: collapse;
	}
         .border1 tr{
   
	}
        .15p { width: 25%; } .15p { width: 15%;// heigh:15%; }
        .20p { width: 20%; //heigh:20%; }   .5p { width: 5%; }
	.25p { width: 25%; } .50p { width: 50%; }
	.60p { width: 50%; } .75p { width: 75%; }
        .100p { width: 100%; } .10p { width: 10%; } 
        .dernier{margin-right:2px;}
</style>

<page backtop="40mm" backleft="" backright="" backbottom="10mm" footer="page;">
    
    <page_header >
                <table class="table">
                 
                           <tr>
                               <td ><img src="C:/wamp/www/MC.APP1/img/LogoMc.jpg" class="imageMc" alt="NotreLogo"></td>
                               
        <td style="width:500px;" class="milieu second"> <p class="demande"><h4 style='color:rgb(125,125,255)'>Société McCroft Tobacco  Côte d’Ivoire
                                                                            Société Anonyme au Capital de 600.000.000 F CFA
                                                                                Siège Social :Yopougon Zone industrielle -16 B.P 422 ABIDJAN 16 CI 
                                                                               Tél. (225) 23-50-33-42
                                                                               Fax (225)23-50-33-44 
                                                                               N° CI-ABJ-2006-3127</h4></p> </td>
                                
                              
                           </tr>
                           <tr>
                           <td></td>      
         <td><p style="text-align: center;color:rgb(102,0,0); font-size:25px; font-weight:bold;">
                 DEMANDE DE COTATION N°: <span style='text-decoration : underline;'><?php echo $code;?></span>
         </p>
         </td>
                           <td>
                           </td></tr>
                   </table>
        
     </page_header>
    <div style='margin-left:550px;margin-top:30px;margin-bottom:5px;'>
        <p>Date Cotation:<span style='font-weight:bold;'><?php echo substr($date,0,11); ?></span></p></div>
    <div style='border:2px solid black;
-moz-border-radius:5px;
-webkit-border-radius:5px;
border-radius:7px;'><table>
    
        <tr style="" >
             <td style='text-decoration : underline; font-weight:bold;'>EXPEDITEUR</td> 
             <td></td>
             <td style='text-decoration : underline; font-weight:bold;'>DESTINATAIRE</td>
             <td></td> 
        </tr>
         <tr>
               <td>Expéditeur  </td> 
               <td id="gras">:<?php echo $nom.' '.$prenom; ?></td>
               <td>Fournisseur  </td> 
               <td id="gras">:<?php echo $concatNom; ?></td> 
        </tr>
         <tr>
               <td >E-email  </td>
               <td>:<a id="mail"><?php echo $mail;?></a></td>
               <td>N°Télécopie</td> 
               <td class="normal">:<?php echo $telecopie; ?></td> 
        </tr>
         <tr>
               <td>Date d'envoi  </td> 
               <td class="normal">:<?php echo substr($date,0,11); ?></td>
               <td>E-mail  </td> 
               <td>:<a id="mail"><?php echo $email; ?></a></td> 
        </tr>
         <tr>
                 <td>Delai de Reponse</td> 
                <td class="normal">:2 Jours</td>
                <td>Date Validité</td> 
                 <td class="normal">:<?php echo $dateValidite; ?></td> 
        </tr>
         <tr>
                 <td>delai de Livraison    </td> 
                 <td class="normal">:<?php echo $delaiLivraison;?></td>
                 <td>Condition Règlment </td> 
                 <td class="normal">:<?php echo $conditionReglement; ?></td> 
        </tr>
        
        <tr >
                 <td></td> 
                 <td>A l'attention de Mr,Mme,Mlle</td>
                 <td style="font-size:12px;font-weight:bold;color:rgb(47,0,0)">:<?php echo $attention; ?></td> 
                 <td></td> 
        </tr>
    
        </table></div>
           <table class='border' style='margin-top:90px;'>
                   <thead>
                <tr class='' style="text-align:center">
      <th class="5p">N°</th>
      <th class="15p">code article</th>
      <th class="10p">Qté cmdé</th>
      <th class="10p">Unité</th>
      <th class="20p">designation</th>
      <th class="20p">Observation</th>
      <th class="20p">Justificatifs</th>
</tr>
                   </thead>
<tbody>
    <?php  foreach ($infoArticles as $ligne ):       ?>
    <tr class='' style="text-align:center line-height: 2px; ">
        <td class="5p"><?php echo $compteur; ?></td>
        <td class="15p"><?php echo $ligne['code']; ?></td>
        <td  class="10p"><?php echo $ligne['quantiteDemander']; ?></td>
         <td  class="10p"><?php echo $ligne['unite']; ?></td>
        <td class="20p"><?php echo $ligne['designation']; ?></td>
        <td class="20p"><span><?php echo $ligne['observation']; ?> </span></td>
        <td  class="20p" style="height:10px;"><span style=" white-space: nowrap;
  overflow: hidden; text-align: left;"><?php echo $ligne['justificatif']; ?></span></td>
    </tr>
    <?php 
       $compteur++;
    endforeach; ?>
</tbody>
                </table>
         
    <div style=" line-height: 1px; "> 

       
    </div>
	<page_footer style=" line-height: 2px; ">
             <table class='' >
            <tr><td>Les offres devront nous parvenir au plus tard Une semaine après la date de la demande (En précisant la période de garantie):
                    <p>-Par Fax au Siège Social</p>
                    <p>-Par Email ( Voir l'expéditeur)</p>
                </td></tr>
            <tr><td></td></tr>
            <tr><td><h4> NB: Prière reporter le numéro de cotation sur votre offre et préciser vos délais de livraison.</h4>
                    <h4>  Prière respecter strictement le délai de livraison mentionné sur B.C si vous êtes retenu </h4> 
                       <h4>pour cette offre</h4> 
                    </td></tr>
        </table>
		<hr style=" line-height: 2px; "/>
                <p>Fait a Yopougon, le <?php echo substr($date,0,11); ?> par le Service <span class='bold' style="color:rgb(108,0,0)">Achat et Production</span></p>
                <p><span style="color:rgb(172,114,34);">McCroft Tobacco Cote d'Ivoire S.A</span>,Yopougon Zone Industrielle.Tél:23 50 33 42/43 Fax:23 50 33 44</p>
		<p>&nbsp;</p>
       </page_footer>	
   
    
    	
    
</page>

<?php
	$content = ob_get_clean();
	try {
		$pdf = new HTML2PDF("p","A4","fr");
		$pdf->pdf->SetAuthor('McCroft Tobacco');
		$pdf->pdf->SetTitle('PdfDemandeAchat');
		$pdf->pdf->SetSubject('Création d\'un Pdf');
                $nameDocument="DemandeAchat".date("d/m/y");
		$pdf->pdf->SetKeywords('HTML2PDF,'.$nameDocument.', PHP');
		$pdf->writeHTML($content);
		$ct=$pdf->Output($nameDocument.'.pdf');
                 $pdf->pdf->SetDisplayMode('fullpage');
                   //file_put_contents('../PDFdemande/fichier.pdf', $ct); 
		//$pdf->Output('../ajax/Devis.pdf', 'D');
                $pdf->setModeDebug();
	} catch (HTML2PDF_exception $e) {
		die($e);
	}
