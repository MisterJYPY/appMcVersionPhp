 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <?php
         $sql="SELECT * from demandeachat where id IN 
             (select demandeAchat FROM suivi_validation WHERE signataire!=(SELECT id FROM personnel WHERE fonction='RESPONSABLE' AND service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION'))
             OR (signataire=(SELECT id FROM personnel WHERE fonction='RESPONSABLE' AND service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION'))
             AND estSigne='NON'))";       
                ?>
                <a class="navbar-brand" href="index.php" style="color:orangered;font-size: 18px;font-weight: bold;">Centre Privé d'Administration</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                   
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-shopping-cart fa-fw"></i>Nbre DA en cours:<strong style='color:indigo;font-weight:bold;'> A.prod</strong>
                                    <span class="pull-right text-muted small"><strong><?php echo 0; ?></strong></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-shopping-cart fa-fw"></i> Nbre DA en cours:<strong style='color:indigo;font-weight:bold;'> COM</strong>
                                    <span class="pull-right text-muted small"><strong><?php echo 0; ?></strong></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-shopping-cart fa-fw"></i> Nbre DA en cours:<strong style='color:indigo;font-weight:bold;'>Fnce</strong>
                                    <span class="pull-right text-muted small"><strong><?php echo 0; ?></strong></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-shopping-cart fa-fw "></i>Nbre DA en cours:<strong style='color:indigo;font-weight:bold;'>RH</strong>
                                    <span class="pull-right text-muted small"><strong><?php echo 0; ?></strong></span>
                                </div>
                            </a>
                        </li>
                      
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Voir Plus de details</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>Vous etes L'administrateur</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i>Reglages</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i>Deconnecter</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php include 'menu.php'; ?>
            <!-- /.navbar-static-side -->
        </nav>
 </div>