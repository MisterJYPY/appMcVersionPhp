 <?php
      header('Content-type:text');
      include_once '../core/config.php';
            $nombreVariable=$pos['nbre'];
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
                               <th><p class="center-block TitreFeuille"><a href="#">Vos Demandes en Attentes</a> </p>
                       </th>
                           </tr>
                       </thead> 
                   </table>
            </div>
            <input type="hidden"  id="champCacher" value="N°:Aucun">
            <div class="col-xs-4 col-md-3 col-lg-2"><P></p>
                      </p></p>
            </div>
           <div class="">
           </div>
          </head>
    <div class="row">
<div class=" col-xs-12 col-sm-12 col-lg-12 col-md-12">
    <table class="table table-bordered">
          
        <thead>
                 <thead>
<tr class=''>
      <th class="10p">N°</th>
      <th class="10p">Bordereaux</th>
      <th class="10p">Date de creations</th>
      <th class="60p">Dernier Signataire</th>
      <th class="10p">Date d'envoi</th>
      <th class="60p">details</th>
</tr>
                   </thead>
              <tbody>
                  
                  <?php
                 
                   for($n=1;$n<=$nombreVariable;$n++){
                     $valeur=(int)$pos['da'.$n];
                       /* cette partie pour recuperer la valeur ou le nombre de produit demander*/
                   $sqlNombrerticle="SELECT COUNT(article) as nombre FROM articlesdemandeachat WHERE demandeAchat=$valeur";
                   $result=$db->selectInTab($sqlNombrerticle);
                    
                       $nombreArticles=$result[0]['nombre'];
                      /*             end of*/
                  $sql="SELECT
                       signataire_approber.signataire,signataire_approber.demandeAchat,signataire_approber.heure_signature,
                       demandeachat.demandeur,demandeachat.bordereaux, personnel.nom as nom,personnel.prenom,personnel.fonction,demandeachat.dateInsertion
                       FROM signataire_approber 
                       INNER JOIN demandeachat ON demandeachat.id=$valeur
                       INNER JOIN personnel ON personnel.id=signataire_approber.signataire 
                       WHERE signataire_approber.demandeAchat=$valeur and personnel.id=signataire_approber.signataire 
                       ORDER BY  signataire_approber.heure_signature DESC LIMIT 0,1";
                  $listeSignataire=$db->selectInTab($sql);
                  foreach($listeSignataire as $row): 
                        $da=$row['demandeAchat'];
                        $bor=$row['bordereaux'];
                       $valeur="da="
                              . "$da"
                              . " &bor="
                               . "$bor"
                               . "&nbre="
                               . "$nombreArticles";
                  ?>
                  <tr>
                      <td><?php echo $n;?></td>
                      <td><strong><?php echo $row['bordereaux']; ?></strong></td>
                      <td><?php echo $row['dateInsertion']; ?></td>
                      <td><strong style='font-weight:bold;'><?php echo $row['nom'].' '.$row['prenom']; ?></strong></td>
                      <td><?php echo $row['heure_signature']; ?></td>
                   <td ><a href="#?v=<?php echo $nombreArticles;?>"  onclick="mettreMileu('<?php echo $valeur; ?>','milieu','ajax/demandeAvalider.php')">Valider Ici</a></td>
                  </tr>  
                   <?php endforeach; }?>
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
               . "Notification Ou Demande en Attente pour le moment...</h5></marquee></div></div></div>";
   }
    ?>
</body>
   