<?php
  
  include 'entete.php';
  include 'bordure.php';
 // include './menu.php';
  
   $id=$get['id'];
    
   // include 'contenu/tableauRes.php';
  $sql4="SELECT demandeachat.id,demandeachat.bordereaux as code,demandeachat.`date`,CONCAT(personnel.nom,CONCAT(' ',personnel.prenom)) as nom,services.designation as des "
                 ."FROM demandeachat INNER JOIN services ON services.id=demandeachat.service "
                 ."INNER JOIN personnel ON personnel.id=demandeachat.demandeur "
                . " WHERE 1";
     $entete=array("nom"=>"Nom Demandeur","code"=>"bordereaux","date"=>"date demande","des"=>"Services");
     //$entete=null;           
  $tab=new Tableau($sql4,"col-lg-12",'<div id="page-wrapper">',"Les Demandes achats",$entete);
  
  echo $tab->leTableau;
      
   
   

  ?>

  <div id='page-wrapper'>
      <div class='row'>
        <strong>
            Liste par service
        </strong>
    </div>
     <?php  foreach($infService as $ligne) :
            $ids=$ligne['id'];
     $sqlDas="SELECT demandeachat.id,demandeachat.bordereaux as code,demandeachat.`date`,CONCAT(personnel.nom,CONCAT(' ',personnel.prenom)) as nom,services.designation as des "
                 ."FROM demandeachat INNER JOIN services ON services.id=demandeachat.service "
                 ."INNER JOIN personnel ON personnel.id=demandeachat.demandeur "
                . " WHERE demandeachat.service=$ids";
        $resultDaS=$db->selectInTab($sqlDas);
       // var_dump($resultDaS);
         ?>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong> <?php echo $ligne['designation']; ?></strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Bordereaux</th>
                                            <th>Demandeur</th>
                                            <th>Date Demde</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($resultDaS as $res): ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $res['code'];?></td>
                                            <td><?php echo $res['nom'];?></td>
                                            <td><?php echo $res['date'];?></td>
                                        </tr>
                                       <?php
                                       $i++;
                                       endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
      <?php endforeach; ?>
  </div>
                <!-- /.col-lg-6 -->
              <?php    include './scriptData.php'; ?> 
</body>
 <!-- DataTables JavaScript -->
    

</html>