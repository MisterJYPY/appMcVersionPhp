
 <?php
      header('Content-type:text');
      include_once '../core/config.php';
            $nombreVariable=$pos['nbre'];
            $da='';
            $par='nbre=';
            $par.=$nombreVariable;
            $par.='&';
          for($p=1;$p<=$nombreVariable;$p++):
            $da.=$pos['da'.$p];
            if($p<$nombreVariable){
             $da.=" ";
            }
            endfor;
            
             for($t=1;$t<=$nombreVariable;$t++):
             $par.="da$t=";
            $par.=$pos['da'.$t];
             if($t<$nombreVariable){
             $par.="&";
            }
             endfor;
             // $da='';
         if($nombreVariable>0){
               $valeur='';
               $sign="OUI";
               $demande='';
  ?>
<body class="wrapper">
   
    <div class="container">
    <head class='row parie1'>
           <div class="col-xs-3 col-md-3 col-lg-2 logo"></div>
            <div class="col-xs-4 col-md-6 col-lg-8">
                   <table class='table table-bordered'>
                       <thead>
                           <tr>
                               <th><p class="center-block TitreFeuille"><a href="#">Presentation de vos documents imprimables</a> </p>
                       </th>
                           </tr>
                       </thead> 
                   </table>
            </div>
            <input type="hidden"  id="champCacher" value="N°
                   :Aucun">
            <div class="col-xs-4 col-md-3 col-lg-2">
                <p></p><br>
                <p>  <a href='#' onclick="sendData('<?php echo $par;?>','ajax/pdfPage.php', 'milieu')"><img  src="img/refresh.jpg" class="iconDeco"  alt="Log out" class="img-thumbnail"/></a></p>
            </div>
           <div class="">
           </div>
    </head>
    <div class="row">
<div class=" col-xs-12 col-sm-12 col-lg-12 col-md-12">
    <table class="table table-bordered">
          
        <thead>
                 <thead>
                     <tr class='text-center'>
      <th class="text-center">N°</th>
      <th class="text-center">Bordereaux</th>
         <th class="text-center">Date Dmde</th>
      <th class="text-center">Demandeur</th>
      <th class="text-center">Service</th>
      <th class="text-center">D.Achat</th>
      <th class="text-center"  colspan=2 ><strong>Cotation</strong></th>
</tr>
                   </thead>
              <tbody>
                  
                  <?php
                 
                   for($n=1;$n<=$nombreVariable;$n++){
                     $valeur=(int)$pos['da'.$n];
                       /* cette partie pour recuperer la valeur ou le nombre de produit demander*/
                      /*             end of*/
               $sql="SELECT personnel.id as iddemandeur,personnel.nom,personnel.prenom,demandeachat.bordereaux as code,demandeachat.dateInsertion as date,services.designation as nomservice
                      FROM demandeachat
                      INNER JOIN personnel ON personnel.id=demandeachat.demandeur
                      INNER JOIN services  ON services.id=demandeachat.service
                      WHERE demandeachat.id=$valeur ORDER BY demandeachat.dateInsertion ASC";
                  
                  $inFdemande=$db->selectInTab($sql);
                      /*RECUPERATOION DU NOM ET PRENOM DU DEMANDEUR*/
                                 $nom=$inFdemande[0]['nom'];
                                 $prenom=$inFdemande[0]['prenom'];
                                 $date=$inFdemande[0]['date'];
                                 $code=$inFdemande[0]['code'];
                                 $service=$inFdemande[0]['nomservice'];
                                /*EN OF RECUPERation */
               $idcot='no';             
             $sqlCotation="SELECT id,code_cotation,date_envoi as date FROM cotation WHERE demandeAchat=$valeur";
              $infcota=$db->selectInTab($sqlCotation);
              $idcot=$infcota[0]['id'];
              $dateEnvoi=$infcota[0]['date'];
              $sqlFournisseur="SELECT * FROM fournisseursurcotation WHERE cotation=$idcot";
              $resulTcot=$db->selectInTab($sqlFournisseur);
              $nbre=count($resulTcot);
              
                  ?>
                
                  <tr class='text-center'>
                  <td><?php echo $n;?></td>
                  <td><strong><?php echo $code ?></strong></td>
                  <td><?php echo $date ?></td>
                  <td><?php echo $nom.' '.$prenom; ?></td>
                  <td><strong><?php echo $service; ?></strong></td>
                 <td><a href="ajax/pdfDemandeAchat.php?da=<?php echo $valeur;?>" target="ok" ><img  src="img/pdf.jpg" class="iconDeco"  alt="Log out" class="img-thumbnail"/></a></td>
   <td><?php if($nbre<=1){?>
       <a href="ajax/pdfCotation.php?da=<?php echo $valeur;?>&cot=<?php echo $idcot; ?>&fournisseur=<?php
         $fournisseur='rien';
       if($nbre==1){
          $fournisseur=$resulTcot[0]['fournisseur'];
         }
       echo $fournisseur;?>" target="ok"><img  src="img/pdf.jpg" class="iconDeco"  alt="Log out" /></a><?php } if($nbre>1) 
                {
            ?>
  <a href="#" data-toggle="modal" data-target="#modale<?php echo $n;?>"><img  src="img/pdf.jpg" class="iconDeco" alt="Log out" class="img-thumbnail"/></a>
                <?php } ?> </td>
   <td><a href="#" data-toggle="modal" data-target="#myModal<?php echo $n;?>"><img  src="img/edit.jpg" width="40px" height="40px" alt="Log out" class="img-thumbnail"/></a><strong id="fournisseur<?php echo $n;?>" style="color:rgb(53,34,111)">(<?php echo $nbre;?>)</strong></td>
         <!--  
            premiere modale
              -->
         <?php   if($nbre>1) : ?>
          <div id="modale<?php echo $n;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Veuillez Choisir Une Cotation en Fonction Du fournisseur</h4>
      </div>
      <div class="modal-body">
        <?php  
        $sql=" SELECT fournisseursurcotation.cotation,fournisseursurcotation.fournisseur,fournisseur.nom,fournisseur.id as idf "
                  . " FROM fournisseursurcotation"
                  . " INNER JOIN fournisseur ON fournisseur.id=fournisseursurcotation.fournisseur"
                  . "  WHERE fournisseursurcotation.cotation=$idcot";
          $result= $db->selectInTab($sql);
            foreach($result as $ligne):
          ?>
     <div class="form-group col-sm-6 col-lg-6">
         <label for="noms"><a href="#" target="ok">
             <?php echo $ligne['nom'];?></a></label>
    <a href="ajax/pdfCotation.php?da=<?php echo $valeur;?>&cot=<?php echo $idcot; ?>&fournisseur=<?php echo $ligne['idf']?>"  target="ok"><img  src="img/logopdfAll.jpg" width="60" height="40px" alt="Log out" class="img-thumbnail"/></a>
     </div>
          <?php endforeach; ?>
         
      </div>
      <div class="modal-footer">
          <div class="col-sm-12  col-lg-12 col-xs-12"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>

  </div>
</div>
               <?php endif; ?>
<!--    end of first modale              -->
  <div id="myModal<?php echo $n; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Configuration de la cotation</strong> <a href="#"><?php echo $code;?></a> etabli le <span class='success'><?php echo  substr($dateEnvoi,0,11);?></span></h4>
        <p>Nombre de Fournisseur Deja Enregistrer pour cette Cotation: <mark style='font-size:20px;font-weight:bold;'><?php  echo $nbre; ?></mark></p>
        <div id="messageErr<?php echo $n; ?>"></div>
      </div>
        
      <div class="modal-body">
        
   <form action="#" method='POST' name="formulaire<?php echo $n;?>">
      
   <div class="form-group col-sm-6">
       <label for="nom">Fournisseur(<strong style="color:rgb(0,66,0);">Encien</strong>):</label>
       <select class="form-control" id="sel1" 
               onchange="traitementModal(this.value,'<?php echo $n; ?>','<?php echo $da; ?>')">
  <?php  echo genererListeDeroulanteFournisseur("fournisseur","nom",$idcot) ;  ?>
  </select>
  </div>
  <div class="form-group col-sm-6">
     <label for="noms">Fournisseur(<a href="#">Nouveau</a>):</label>
    <input type="text" class="form-control" id="nom<?php echo $n; ?>" placeholder='nom du nouveau Fournisseur'>
     <input type="hidden" id="ol<?php echo $n;?>" value="-1">
  </div>
  <div class="form-group col-sm-6">
   <label for="contact">Contact(s):</label>
    <input type="text" class="form-control" id="contact<?php echo $n; ?>" placeholder='contact(s)'>
  </div>
     <div class="form-group col-sm-6">
    <label for="email">mail Fournisseur:</label>
    <input type="email" class="form-control" id="mail<?php echo $n; ?>" placeholder='mail du nouveau Fournisseur'>
  </div>
  <div class="form-group col-sm-6">
    <label for="telecopie">N°Telecopie:</label>
    <input type="text" class="form-control" id="telecopie<?php echo $n; ?>" placeholder='numero de telecopie'>
  </div>
   <div class="form-group col-sm-6">
    <label for="validite">Date Validité:</label>
    <input type="text" class="form-control" id="validite<?php echo $n; ?>" placeholder='date de validite'>
  </div>
       <div class="form-group col-sm-12 col-lg-12">
           <label for="reglement" style='text-align: center;'>Condition Reglement:</label>
    <input type="text" class="form-control" id="condition<?php echo $n; ?>" placeholder='condition reglement'>
  </div>
  <div class="form-group col-sm-6">
    <label for="livraison">Delai Livraison:</label>
<!--    <input type="date" class="form-control"  id="livraison<?php //echo $n; ?>" placeholder='condition reglement'>-->
    <div class='input-group date' id='datepicker'>
                <input type='date' class="form-control" id="livraison<?php echo $n; ?>"  placeholder='Le delai de livraison'/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
  </div>
  <div class="form-group col-sm-6">
    <label for="attention">A l'attention de Mr,Mdme,Mlle:</label>
    <input type="text" class="form-control" id="attention<?php echo $n; ?>">
  </div>
     <div class="col-sm-12  col-lg-12 col-xs-12">
  <button type="submit" class="btn btn-default btn-success" onclick="traitementModalInsert('<?php echo $n; ?>','<?php echo $da; ?>','<?php echo $idcot; ?>')" value='Enregistrer'>Submit</button>
     </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Fermer</button>
      </div>
    </div>

  </div>
                     
</div>
                  
                  </tr>  
                   <?php  }?>
              </tbody>
     
    </table>
</div>
	</div>
    </div>
   
    <?php 
     }
  else{
       echo " <div class='container'>"
       . " <div class='row'>"
       . " <div class='col-lg-12 col-md-12 col-xs-12' ><marquee><h5  style='color:red'><strong>Aucune</strong> "
               . "Notification Ou Demande en Attente pour le momment...</h5></marquee></div></div></div>";
   }
    ?>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker8').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
        });
    </script>
     <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('#dateform').datepicker({
                    altField: "#datepicker",
                  closeText: 'Fermer',
                 prevText: 'Précédent',
                 nextText: 'Suivant',
                 currentText: 'Aujourd\'hui',
                monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                 dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                 dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
              weekHeader: 'Sem.',
               dateFormat: 'yy-mm-dd',
                    language:"fr"
                });  
                          
            });
     </script>
</body>
   