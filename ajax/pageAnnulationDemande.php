 <?php
      header('Content-type:text');
        include_once '../core/config.php';
        include_once '../core/classes/modelPersonnel.php';
        $codeBordereaux=$pos['bor'];
        $demande=$pos['da'];
        /*  NOTIF DE REUSSITE TOTALE   */
     $msg1='';  /*Success! Info! Warning! Danger!*/
     $msg2='';
     $class='';/*  alert-success     alert-info  alert-warning  alert alert-danger*/
 /*END OF NOTIF*/
        $sql="SELECT personnel.id as iddemandeur,personnel.nom,personnel.prenom,demandeachat.bordereaux as code,demandeachat.dateInsertion as date,services.designation as nomservice
                      FROM demandeachat
                      INNER JOIN personnel ON personnel.id=demandeachat.demandeur
                      INNER JOIN services  ON services.id=demandeachat.service
                      WHERE demandeachat.id=$demande ";
        
                         $inFdemande=$db->selectInTab($sql);
                      /*RECUPERATOION DU NOM ET PRENOM DU DEMANDEUR*/
                                 $nom=$inFdemande[0]['nom'];
                                 $prenom=$inFdemande[0]['prenom'];
                                 $date=$inFdemande[0]['date'];
                                 $code=$inFdemande[0]['code'];
                                 $service=$inFdemande[0]['nomservice'];
                    $idPersonnel=$_SESSION['idPersonnel'];
                    $requeteActualisation="WHERE demandeAchat=$demande and signataire=$idPersonnel and estSigne='NON' ";
                                               /*actualisation des elements pour le validant */
                   if($db->update('suivi_validation',array("estSigne"=>'NON',"type"=>'AN'),$requeteActualisation)){
                    $msg1='Succes!';
                    $msg2='demande Achat Annule avec succes!';
                    $class='alert-success';     
                    $annonce='Vous avez Annuler La demande Suivante';
                }
                  else{
                  $msg1='Echec!';
                $msg2='Veuillez soit reesayer svp!';   
                $class='lert alert-danger'; 
                $annonce="La demande N'a pas ete Annule Desole";
                  }
         
  ?>
 <body class="wrapper">
         
        <div class="container" class="conteneur">
            <head>
            <div class='row'>
                <div class='col-lg-3'>
                    
                </div>
           <div class='center-block col-lg-6 col-xs-12 col-md-6 col-sm-6'>
<!--               <a href='#' style='color:darkorange;text-align: center;font-size: 20px;'><?php //echo $annonce;?></a>-->
               <table class='table table-bordered'>
                       <thead>
                           <tr>
                               <th><a href='#' class="center-block " style='color:darkorange;text-align: center;font-size: 20px;' ><?php echo $annonce;?> </a>
                       </th>
                           </tr>
                       </thead> 
                   </table>
           </div>
                 <div class='col-lg-3'>
                    
                </div>
            </div>
        </head>
           <div class='row'>
               <div class='col-lg-8 col-md-8 col-xs-8 col-sm-8'>
                   <p>Bordereaux:<strong><?php echo $code; ?></strong></p>
                   <p>Nom Demandeur:<strong><?php echo $nom.' '.$prenom;?></strong></p>
                   <p>Date Demande:<strong><?php echo $date;?></strong></p>
                   <p>Service Demandeur:<strong><?php echo $service ;?></strong></p>
               </div>
               <div class='col-lg-4 col-md-4 col-xs-4 col-sm-4 <?php echo $class ?>'>
                   <a href="#" class="close" data-dismiss="alert" aria-label="fermer">&times;</a>
                    <strong><?php echo $msg1; ?></strong> <?php echo $msg2;?>
               </div>
           </div>
 </div>
 </body>