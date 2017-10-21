<?php
        require_once "../html2pdf/html2pdf.php";
        
 
ob_start();
         include_once '../core/config.php';
      //  include_once '../core/classes/modelPersonnel.php';
         $valeur=$get['da'];
         
                   /*             end of*/
               $sql="SELECT personnel.id as iddemandeur,personnel.nom,personnel.prenom,demandeachat.bordereaux as code,demandeachat.dateInsertion as date,services.designation as nomservice
                      FROM demandeachat
                      INNER JOIN personnel ON personnel.id=demandeachat.demandeur
                      INNER JOIN services  ON services.id=demandeachat.service
                      WHERE demandeachat.id=$valeur";
                  
                  $inFdemande=$db->selectInTab($sql);
                      /*RECUPERATOION DU NOM ET PRENOM DU DEMANDEUR*/
                                 $nom=$inFdemande[0]['nom'];
                                 $prenom=$inFdemande[0]['prenom'];
                                 $date=$inFdemande[0]['date'];
                                 $code=$inFdemande[0]['code'];
                                 $service=$inFdemande[0]['nomservice'];
                                /*EN OF RECUPERation */
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
    div#premiere {
	float: left;
	width: 50px;
}
div#deuxieme {
	float: left;
	width: 100px;
}
div#troisieme {
	margin-left: 50px;
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
    margin-left:29;
    
    
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
        .15p { width: 25%; } .15p { width: 15%; heigh:15%; }
        .20p { width: 20%; heigh:20%; }   .5p { width: 5%; }
          .2p { width: 3%; }
        .4p { width: 4%; }    .7p { width: 7%; }
	.25p { width: 25%; } .50p { width: 50%; }
	.60p { width: 50%; } .75p { width: 75%; }
        .100p { width: 100%; }
        .dernier{margin-right:2px;}
</style>

<page backtop="40mm" backleft="" backright="" backbottom="10mm" footer="page;">
    
    <page_header >
                <table class="table">
                 
                           <tr>
                               <td ><img src="C:/wamp/www/MC.APP1/img/LogoMc.jpg" class="imageMc" alt="NotreLogo"></td>
                               
                               <td style="width:500px;" class="milieu second"> <p class="demande">FICHE DE DEMANDE D'ACHAT</p> </td>
                                
                               <td class="texts">Date: <?php echo substr($date,0,11); ?>
                                   <p style=" font-size: 14px;">N°:<?php echo $code;?></p></td>
                           </tr>
                           <tr>
                           <td></td>      
         <td><p style="text-align: center;color:rgb(102,0,0);">
             Les Informations du demandeur
         </p>
         </td>
                           <td>
                           </td></tr>
                   </table>
        
     </page_header>
    <div> <p>Nom et Prenom(s):<span style="font-Weight: Bold;"> <?php echo $nom.' '.$prenom; ?> </span></p>
                  <p>Service: <font> <?php echo $service; ?> </font></p></div>
      <p style="text-align: center;color:rgb(102,0,0);">
             Les Articles Demandés
         </p>
           <table class='border'>
                   <thead>
                       <tr class='' style="text-align:left">
      <th class="2p">N°</th>
      <th class="10p">code article</th>
      <th class="10p">code Famille</th>
      <th class="4p">Qté</th>
       <th class="5p">Unité</th>
      <th class="7p">Stocks Th</th>
      <th class="20p">designation</th>
      <th class="15p">Observation</th>
      <th class="20p">Justificatifs</th>
</tr>
                   </thead>
<tbody>
    <?php  foreach ($infoArticles as $ligne ):       ?>
    <tr class='' style="text-align:center line-height: 2px; ">
        <td class="2p"><?php echo $compteur; ?></td>
        <td class="10p"><?php echo $ligne['code']; ?></td>
        <td class="10p"><?php echo $ligne['codeFamille']; ?></td>
        <td  class="4p"><?php echo $ligne['quantiteDemander']; ?></td>
         <td  class="4p"><?php echo $ligne['unite']; ?></td>
        <td class="7p"><?php echo $ligne['stocks']; ?></td>
        <td class="20p"><?php echo $ligne['designation']; ?></td>
        <td class="15p"><span><?php echo $ligne['observation']; ?> </span></td>
        <td  class="20p" style="height:10px;"><span style=" white-space: nowrap;
  overflow: hidden; text-align: left;"><?php echo $ligne['justificatif']; ?></span></td>
    </tr>
    <?php 
       $compteur++;
    endforeach; ?>
</tbody>
                </table>
         
                    
	<page_footer style=" line-height: 2px; ">
            <table class='border dernier' style="margin-left:5px;" >
    
<tbody>
      <?php
                $signe="OUI";
                $sqlS="SELECT suivi_validation.derniere_modif as date,personnel.nom,personnel.prenom ,personnel.mail
                        FROM suivi_validation
                        INNER JOIN personnel on suivi_validation.signataire=personnel.id
                        WHERE  suivi_validation.demandeAchat=$valeur  and estSigne=\"$signe\" ORDER BY derniere_modif";
                 $liste=$db->selectInTab($sqlS);
                 $nombrePersonne=count($liste);
      ?>
    <tr class='' style=" line-height: 2px; ">
        <td class="5p">
            <p style="color:rgb(67,33,33)">NOM</p>
            <p style="color:rgb(67,33,33)">+</p>
            <p style="color:rgb(67,33,33)">VISA</p>
        </td>
           <?php
                if($nombrePersonne==1):
               ?>
        <td class="10p">
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['nom'];?></p>
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['prenom'];?></p>
             <p> <?php echo substr($liste[0]['date'],0,11); ?></p> 
        </td>
        <td class="20p">
                <p style="color:rgb(206,0,0)"></p>
             <p style="color:rgb(206,0,0)"></p>
             <p></p> 
        </td>
        <td class="20p">
               <p ></p>
             <p > </p>
             <p > </p>
        </td>
       
        <td class="25p">
            <p style="color:rgb(67,33,33)"> NON VALABLE POUR</p>
                        <p style="color:rgb(67,33,33)">UNE COMMANDE A UN</p> 
                        <p style="color:rgb(67,33,33)">FOURNISSEUR</p>
        </td>
        <td class='signature 15p' style=" word-wrap: break-word; " >
            <p > </p>
               <p> </p>
             <p> </p>
        </td>
        <?php   endif;
            if($nombrePersonne==2):
               ?>
         <td class="10p">
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['nom'];?></p>
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['prenom'];?></p>
             <p> <?php echo substr($liste[0]['date'],0,11); ?></p> 
        </td>
        <td class="20p">
                <p style="color:rgb(206,0,0)"><?php echo $liste[1]['nom'];?></p>
             <p style="color:rgb(206,0,0)"><?php echo $liste[1]['prenom'];?></p>
             <p><?php echo substr($liste[1]['date'],0,11);?></p> 
        </td>
        <td class="20p">
               <p ></p>
             <p > </p>
             <p > </p>
        </td>
       
        <td class="25p">
            <p style="color:rgb(67,33,33)"> NON VALABLE POUR</p>
                        <p style="color:rgb(67,33,33)">UNE COMMANDE A UN</p> 
                        <p style="color:rgb(67,33,33)">FOURNISSEUR</p>
        </td>
        <td class='signature 15p' style=" word-wrap: break-word; " >
            <p > </p>
               <p> </p>
             <p> </p>
        </td>
        <?php   endif;
         if($nombrePersonne==3):
               ?>
        <td class="10p">
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['nom'];?></p>
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['prenom'];?></p>
             <p> <?php echo substr($liste[0]['date'],0,11); ?></p> 
        </td>
        <td class="20p">
                <p style="color:rgb(125,0,0)"><?php echo $liste[1]['nom'];?></p>
             <p style="color:rgb(125,0,0)"><?php echo $liste[1]['prenom'];?></p>
             <p><?php echo substr($liste[1]['date'],0,11);?></p> 
        </td>
        <td class="20p">
               <p style="color:rgb(125,0,0)"><?php echo $liste[2]['nom'];?></p>
             <p style="color:rgb(125,0,0)"> <?php echo $liste[2]['prenom'];?></p>
             <p> <?php echo substr($liste[2]['date'],0,11); ?></p>
        </td>
       
       <td class="25p">
            <p style="color:rgb(67,33,33)"> NON VALABLE POUR</p>
                        <p style="color:rgb(67,33,33)">UNE COMMANDE A UN</p> 
                        <p style="color:rgb(67,33,33)">FOURNISSEUR</p>
        </td>
        <td class='signature 15p' style=" word-wrap: break-word; " >
            <p > </p>
               <p> </p>
             <p> </p>
        </td>
        <?php   endif;
         if($nombrePersonne==4):
               ?>
        <td class="10p">
             <p style="color:rgb(125,0,0)"><?php echo $liste[0]['nom'];?></p>
             <p style="color:rgb(125,0,0)" ><?php echo $liste[0]['prenom'];?></p>
             <p> <?php echo substr($liste[0]['date'],0,11); ?></p> 
        </td>
        <td class="20p">
                <p style="color:rgb(125,0,0)"><?php echo $liste[1]['nom'];?></p>
             <p style="color:rgb(125,0,0)"><?php echo $liste[1]['prenom'];?></p>
             <p><?php echo substr($liste[1]['date'],0,11);?></p> 
        </td>
        <td class="20p">
               <p style="color:rgb(125,0,0)"><?php echo $liste[2]['nom'];?></p>
             <p style="color:rgb(125,0,0)"> <?php echo $liste[2]['prenom'];?></p>
             <p > <?php echo substr($liste[2]['date'],0,11); ?></p>
        </td>
       
        <td class="25p">
            <p style="color:rgb(67,33,33)"> NON VALABLE POUR</p>
                        <p style="color:rgb(67,33,33)">UNE COMMANDE A UN</p> 
                        <p style="color:rgb(67,33,33)">FOURNISSEUR</p>
        </td>
        <td class='signature 15p' style=" word-wrap: break-word; " >
            <p style="color:rgb(125,0,0)"> <?php echo $liste[3]['nom'];?></p>
               <p style="color:rgb(125,0,0)"> <?php echo $liste[3]['prenom'];?></p>
             <p>  <?php echo substr($liste[3]['date'],0,11);?></p>
        </td>
        <?php   endif;  ?>
    </tr>
</tbody>
                </table> 
		<hr style=" line-height: 2px; "/>
                <p>Fait a Yopougon, le <?php echo date("d/m/y"); ?> par le Service: <span class='bold' style="color:rgb(221,221,0);font-size:16;">Achat et Production</span></p>
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
