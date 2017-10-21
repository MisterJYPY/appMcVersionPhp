<body>
<div id="page-wrapper">
    <marquee ><a href="#" style="color:rgb(138,0,0)"><strong style="color:red">page ADministration en construction...(certaines listes peuvent etre vue)</strong></a></marquee>
            <div class="row" >
                <div class="col-lg-12">
                    <h1 class="page-header">Tableau de Bord</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" id=" milieu2">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
                          $sqlVisiteur="SELECT * FROM etatconnection WHERE date=CURRENT_DATE()";   
                            echo count($db->selectInTab($sqlVisiteur));
                                    ?></div>
                                    <div>Connection Today </div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Voir Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
                           $sql="SELECT quantite FROM stocks_produit_fini WHERE libelle='cartonMc'" ;
                            echo $db->selectInTab($sql)[0]['quantite'];
                                    ?></div>
                                    <div>Stocks de Carton Mc</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Voir Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                      <i class="fa fa-support fa-5x"></i>
                                    
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
                      $sqlP="SELECT SUM(quantite) as quantite FROM entree_produit_fini "
                              . " WHERE type='PRODUCTION'"
                              . " AND date=CURRENT_DATE()";  
                        count($db->selectInTab($sqlP));
                              if($db->selectInTab($sqlP)[0]['quantite']!=NULL)
                                  {
                                echo $db->selectInTab($sqlP)[0]['quantite'];   
                                  }
                                  else{
                                 echo 00;     
                                  }
                     
                                    ?>
                                     
                                    </div>
                                    <div><strong>Production Mc Today</strong></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Voir Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                  <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                             <div class="huge"><?php
                                    
                                  $sqlP="SELECT SUM(quantite) as quantite FROM vente_produit_fini "
                              . " WHERE date=CURRENT_DATE()";  
                        count($db->selectInTab($sqlP));
                              if($db->selectInTab($sqlP)[0]['quantite']!=NULL)
                                  {
                                echo $db->selectInTab($sqlP)[0]['quantite'];   
                                  }
                                  else{
                                 echo 00;     
                                  }    
                                ?></div>
                                    <div>Vente Mc Today</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Voir Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                         <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
    Representation en % des Operations (Produit finis) de <mark>Ventes,Productions,Retours et Consommations </mark>du Mois de <strong> <?php echo retournerJourOuMoisOuAnneeActuel("mois");?></strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                 
                    <!-- /.panel -->
                </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                  
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Bilan Annuel Des Operations  <strong class="annee"> <?php echo retournerJourOuMoisOuAnneeActuel("annee");?></strong>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item ">
                                    <i class="bilan"></i> <strong class="bilan">qte Produite(Mc)</strong>
                                    <span class="pull-right text-muted small"><strong class="valeurB"><?php echo $prodA;?></strong>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item bilan">
                                    <i class="bilan"></i> <strong class="bilan">qte Vendue(Mc)</strong>
                                    <span class="pull-right text-muted small"><strong class="valeurB"><?php echo $VenteA;?></strong>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item bilan">
                                    <i class="bilan"></i> <strong class="bilan">qte Consommeée(Mc)</strong>
                                    <span class="pull-right text-muted small"><strong class="valeurB"><?php echo $ConsoA;?></strong>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item bilan">
                                    <i class="bilan"></i> <strong class="bilan">qté Retournée(Mc)</strong>
                                    <span class="pull-right text-muted small"><strong class="valeurB"><?php echo $retrA;?></strong>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item bilan">
                                    <i class="bilan"></i><strong class="bilan"> Dmde Achat Mat Premiere</strong>
                                    <span class="pull-right text-muted small"><strong class="valeurBD"><?php echo $nbreDemandeM;?></strong>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item bilan">
                                    <i class="bilan"></i><strong class="bilan">  Dmde Achat Autre Mat</strong>
                                    <span class="pull-right text-muted small"><strong class="valeurBD "><?php echo $nbreDemandeAp;?></strong>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    <!-- /.panel -->
              
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            
            <!-- /.row -->
        </div>