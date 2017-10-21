<?php
  header('Content-type:text');
  include_once '../core/config.php';
    //$valeur=10;
    $idPersonnel=$_SESSION['idPersonnel'];
 $sqlNbreElement="SELECT * FROM demandeachat WHERE demandeur=$idPersonnel";
  $designationService=$_SESSION['Nomservice'];
  $fonction=$_SESSION['fonction'];
 $sqlAn="SELECT demandeachat.bordereaux,demandeachat.dateInsertion,suivi_validation.derniere_modif,
personnel.nom,personnel.prenom
FROM suivi_validation 
INNER JOIN demandeachat ON demandeachat.id=suivi_validation.demandeAchat and demandeachat.demandeur=$idPersonnel
INNER JOIN personnel ON personnel.id=suivi_validation.signataire
WHERE suivi_validation.demandeAchat IN (SELECT id FROM demandeachat WHERE demandeur=$idPersonnel) AND 
suivi_validation.type='AN'";
 $sqlPartieValider="SELECT demandeachat.bordereaux,demandeachat.dateInsertion,suivi_validation.derniere_modif,personnel.nom,personnel.id as idp,personnel.prenom
FROM suivi_validation
INNER JOIN demandeachat ON demandeachat.id=suivi_validation.demandeAchat
INNER JOIN personnel ON demandeachat.demandeur=personnel.id
WHERE suivi_validation.demandeAchat IN (SELECT id FROM demandeachat 
WHERE service=(SELECT id FROM  services WHERE designation='$designationService')) AND  suivi_validation.type='OK' AND suivi_validation.signataire=$idPersonnel";
 
  $sqlPartieAnnuler="SELECT demandeachat.bordereaux,demandeachat.dateInsertion,suivi_validation.derniere_modif,personnel.nom,personnel.prenom
FROM suivi_validation 
INNER JOIN demandeachat ON demandeachat.id=suivi_validation.demandeAchat
INNER JOIN personnel ON demandeachat.demandeur=personnel.id
WHERE suivi_validation.demandeAchat IN (SELECT id FROM demandeachat 
WHERE service=(SELECT id FROM  services WHERE designation='$designationService')) AND  suivi_validation.type='AN' AND suivi_validation.signataire=$idPersonnel";
 
 $sqlEc="SELECT demandeachat.bordereaux,demandeachat.dateInsertion,suivi_validation.derniere_modif,
personnel.nom,personnel.prenom
       FROM suivi_validation 
       INNER JOIN demandeachat ON demandeachat.id=suivi_validation.demandeAchat and demandeachat.demandeur=$idPersonnel
       INNER JOIN personnel ON personnel.id=suivi_validation.signataire
       WHERE suivi_validation.demandeAchat IN (SELECT id FROM demandeachat WHERE demandeur=$idPersonnel) AND 
       suivi_validation.type='EC'";
 $sqlSuc="SELECT demandeachat.bordereaux,demandeachat.dateInsertion,suivi_validation.derniere_modif
       FROM suivi_validation 
       INNER JOIN demandeachat ON demandeachat.id=suivi_validation.demandeAchat and demandeachat.demandeur=$idPersonnel
       WHERE suivi_validation.signataire=(SELECT id FROM personnel WHERE fonction='RESPONSABLE' and service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION'))
       AND suivi_validation.type='OK'";
               /*partie1*/
 $sqlPartieAnnulerAP="SELECT demandeachat.bordereaux,demandeachat.dateInsertion,services.designation,suivi_validation.derniere_modif,personnel.nom,personnel.prenom
              FROM suivi_validation 
              INNER JOIN demandeachat ON demandeachat.id=suivi_validation.demandeAchat
              INNER JOIN personnel ON demandeachat.demandeur=personnel.id
              INNER JOIN services ON services.id=demandeachat.service
              WHERE suivi_validation.demandeAchat IN (SELECT id FROM demandeachat 
              WHERE service IN (SELECT id FROM  services)) AND  suivi_validation.type='AN' AND suivi_validation.signataire=$idPersonnel";
 
                /*  LES REQUETES BD*/
       $resultatAn=$db->selectInTab($sqlAn);
       $resultatSucces=$db->selectInTab($sqlSuc);
       $resultatEc=$db->selectInTab($sqlEc);
       $resultaPartie=$db->selectInTab( $sqlPartieValider);
       $resultatElement=$db->selectInTab($sqlNbreElement);
       $resultatAnnuler=$db->selectInTab($sqlPartieAnnuler);
       $resultatAnnulerAP=$db->selectInTab($sqlPartieAnnulerAP);
                   /*FIN ET NBREELEMENT*/
       $nbreDemandeAchat=count($resultatElement);
       $nbreEchec=count($resultatAn);
       $nbreSuces=count($resultatSucces);
       $nbrEc=count($resultatEc);
       $nbreActif=count($resultaPartie);
       $nbreAnnuler=count($resultatAnnuler);
        $nbreAnnulerAP=count($resultatAnnulerAP);
       /*part1*/
       /*part2*/
      // echo count($resultatSucces);
   ?>
<body class="wrapper">
    <div class="container">
          <?php 
          //--------------------------
            if($designationService!='ACHAT ET PRODUCTION'){
                   if($nbreActif>=1 and $fonction=='RESPONSABLE') { ?>
        <div class="row border">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <p class="center" style=" text-align: center;margin-top:10px; font-size:20px;font-weight: bold;color: rgb(94,94,0)"> Liste des Demandes que vous avez Validé(e) </p>  
                  <table class="table table-bordered table-responsive">
                      <thead>
                        <tr style="text-align:center">
                 <th class="10p" style="text-align:center">N°</th>
                 <th class="10p" style="text-align:center">bordereaux</th>
                 <th class="10p" style="text-align:center">Demandeur</th>
                 <th class="60p" style="text-align:center">Date Demande</th>
                 <th class="10p" style="text-align:center">date Signature</th>
                       </tr>
                       
                      </thead>
                      <tbody>
                            
                            <?php 
                             $n=1;
                            foreach($resultaPartie as $lignep): 
                                $idp=$lignep['idp'];
                                  if($idp!=$idPersonnel):
                                ?>
                          <tr style="text-align:center">
                              <td><?php echo $n; ?></td>
                               <td style="font-size:13px;font-weight: bold;color:rgb(72,0,36)"><?php echo $lignep['bordereaux'];?></td>  
                                <td><?php echo $lignep['nom'].' '.$lignep['prenom'];?></td>  
                              <td><?php echo $lignep['dateInsertion'];?></td>  
                              <td><?php echo $lignep['derniere_modif']; ?></td>  
                              
                          </tr> 
                          <?php endif;
                          $n++; endforeach; ?>
                      </tbody>
                  </table>
            </div>
        </div>
                  <?php } 
                //------------------------------
                  if($nbreAnnuler>=1) { ?>
        <div class="row border">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 center ">
      <p class="center" style=" text-align: center;margin-top:10px; font-size:20px;font-weight: bold;color: rgb(94,94,0)"> Liste des Demandes que vous avez Annulé(e) </p>  
                  <table class="table table-bordered table-responsive" >
                      <thead>
                        <tr style="text-align:center">
                 <th class="10p" style="text-align:center">N°</th>
                 <th class="10p" style="text-align:center">bordereaux</th>
                 <th class="10p" style="text-align:center">Demandeur</th>
                 <th class="60p" style="text-align:center">Date Demande</th>
                 <th class="10p" style="text-align:center">date Signature</th>
                       </tr>
                       
                      </thead>
                      <tbody>
                            
                            <?php 
                             $n=1;
                            foreach($resultatAnnuler as $lignep):  ?>
                          <tr style="text-align:center">
                              <td><?php echo $n; ?></td>
                               <td style="font-size:13px;font-weight: bold;color:rgb(72,0,36)"><?php echo $lignep['bordereaux'];?></td>  
                                <td><?php echo $lignep['nom'].' '.$lignep['prenom'];?></td>  
                              <td><?php echo $lignep['dateInsertion'];?></td>  
                              <td><?php echo $lignep['derniere_modif']; ?></td>  
                              
                          </tr> 
                          <?php $n++; endforeach; ?>
                      </tbody>
                  </table>
            </div>
        </div>
            <?php }}
            else{
                if($nbreAnnulerAP>=1) { ?>
        <div class="row border">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 center ">
      <p class="center" style=" text-align: center;margin-top:10px; font-size:20px;font-weight: bold;color: rgb(94,94,0)"> Liste des Demandes que vous avez Annulés </p>  
                  <table class="table table-bordered table-responsive" >
                      <thead>
                        <tr style="text-align:center">
                 <th class="10p" style="text-align:center">N°</th>
                 <th class="10p" style="text-align:center">bordereaux</th>
                 <th class="10p" style="text-align:center">Demandeur</th>
                  <th class="10p" style="text-align:center">Date Demande</th>
                 <th class="60p" style="text-align:center">Service</th>
                 <th class="10p" style="text-align:center">Annulée le:</th>
                       </tr>
                       
                      </thead>
                      <tbody>
                            
                            <?php 
                             $n=1;
                            foreach($resultatAnnulerAP as $lignepa):  ?>
                          <tr style="text-align:center">
                              <td><?php echo $n; ?></td>
                              <td style="font-size:13px;font-weight: bold;color:rgb(72,0,36)"><?php echo $lignepa['bordereaux'];?></td>  
                              <td><?php echo $lignepa['nom'].' '.$lignepa['prenom'];?></td>  
                              <td><?php echo $lignepa['dateInsertion'];?></td>  
                              <td><?php echo $lignepa['designation'];?></td>  
                              <td><?php echo $lignepa['derniere_modif']; ?></td>  
                          </tr> 
                          <?php $n++; endforeach; ?>
                      </tbody>
                  </table>
            </div>
        </div>
            <?php }
            }
            if( $nbreDemandeAchat>=1){
                //
          if($nbrEc>=1) { ?>
        <div class="row border">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 center ">
      <p class="center" style=" text-align: center;margin-top:10px; font-size:20px;font-weight: bold;color: rgb(159,159,0)">Liste des Demandes En Cours De Validation... </p>  
                  <table class="table table-bordered table-responsive" >
                      <thead>
                        <tr style="text-align:center">
                 <th class="10p" style="text-align:center">N°</th>
                 <th class="10p" v>bordereaux</th>
                 <th class="60p" style="text-align:center">Date Demande</th>
                 <th class="10p" style="text-align:center">Prochain Signataire</th>
                  <th class="10p" style="text-align:center">arrivée le:</th>
                       </tr>
                       
                      </thead>
                      <tbody>
                            
                            <?php 
                             $n=1;
                            foreach($resultatEc as $ligneEc):  ?>
                          <tr style="text-align:center">
                              <td><?php echo $n; ?></td>
                               <td style="font-size:13px;font-weight: bold;color:rgb(72,0,36)"><?php echo $ligneEc['bordereaux'];?></td>  
                              <td><?php echo $ligneEc['dateInsertion'];?></td>  
                                <td style="font-size:15px;font-weight: bold;color:rgb(168,84,0)"><?php echo $ligneEc['nom'].' '.$ligneEc['prenom']; ?></td>  
                              <td><?php echo $ligneEc['derniere_modif']; ?></td>  
                              
                          </tr> 
                          <?php $n++; endforeach; ?>
                      </tbody>
                  </table>
            </div>
        </div>
          <?php } 
            else{
                
            }
             if($nbreSuces>=1){
          ?>
             <div class="row border">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 center ">
      <p class="center" style=" text-align: center;margin-top:10px; font-size:20px;font-weight: bold;color: rgb(159,159,0)">Demandes Effectuées Entièrement Validées Par le service Achat et Production </p>  
                  <table class="table table-bordered table-responsive" >
                      <thead >
                          <tr style="text-align: center;">
                 <th class="10p" style="text-align:center">N°</th>
                 <th class="10p" style="text-align:center">bordereaux</th>
                 <th class="60p" style="text-align:center">Date Demande</th>
                 <th class="10p" style="text-align:center">Date Derniere Signature</th>
                       </tr>
                      </thead>
                      <tbody>
                            
                            <?php 
                             $n=1;
                            foreach($resultatSucces as $ligneRes):  ?>
                        <tr style="text-align:center">
                              <td><?php echo $n; ?></td>
                               <td style="font-size:13px;font-weight: bold;color:rgb(72,0,36)"><?php echo $ligneRes['bordereaux'];?></td>  
                              <td><?php echo $ligneRes['dateInsertion'];?></td>  
                              <td><?php echo $ligneRes['derniere_modif']; ?></td>  
                          </tr> 
                          <?php $n++; endforeach; ?>
                      </tbody>
                  </table>
            </div>
        </div>
             <?php }
               else{
                   
               }
                 if($nbreEchec>=1){
             ?>
         <div class="row border">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 center ">
      <p class="center" style=" text-align: center;margin-top:10px; font-size:20px;font-weight: bold;color: rgb(159,159,0)">Liste de Vos Demandes Annulées </p>  
                  <table class="table table-bordered table-responsive" >
                      <thead>
                       <tr style="text-align:center">
                 <th class="10p" style="text-align:center">N°</th>
                 <th class="10p" style="text-align:center">bordereaux</th>
                 <th class="60p" style="text-align:center">Date Demande</th>
                 <th class="10p" style="text-align:center">Annuler Par Mrs/Mdme/Mslle:</th>
                  <th class="10p" style="text-align:center">à la date du:</th>
                       </tr>
                       
                      </thead>
                      <tbody>
                            
                            <?php 
                             $n=1;
                            foreach($resultatAn as $ligneAn):  ?>
                        <tr style="text-align:center">
                              <td><?php echo $n; ?></td>
                               <td style="font-size:13px;font-weight: bold;color:rgb(72,0,36)"><?php echo $ligneAn['bordereaux'];?></td>  
                              <td><?php echo $ligneAn['dateInsertion'];?></td>  
                            <td style="font-size:15px;font-weight: bold;color:rgb(168,84,0)"><?php echo $ligneAn['nom'].' '.$ligneAn['prenom']; ?></td>  
                              <td><?php echo $ligneAn['derniere_modif'];?></td> 
                          </tr> 
                          <?php $n++; endforeach; ?>
                      </tbody>
                  </table>
            </div>
        </div>
                 <?php } 
                 else{
                       
                 }
            }
            else{
            echo " <div class='row'>"
                    ."   <div class='col-lg-12 col-md-12 col-xs-12 col-sm-12'>"
                    . "<a href='#' style='font-size:55;text-align:center;font-weight:bold;margin-left:350px;margin-top:15px;'><strong>AUCUNE OPERATION DE DEMANDE ETABLIE A CE JOUR...</strong></a>"
                    . " </div> </div>";
            }
                 ?>
    </div>
</body>