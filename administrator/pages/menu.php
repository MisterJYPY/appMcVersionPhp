<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                  <a href="index.php"><i class="fa fa-dashboard fa-fw"></i><strong> VOTRE MENU </strong></a>
                        </li>
                          <li>
                              <a href="#"><img  src="../img/iconUser.jpg"   width="30"
                                                height="30"  class="img-thumbnail"/><strong class="titres">Gestion des Comptes</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" class="sous-titre">Enregister Un compte</a>
                                </li>
                                <li>
                                    <a href="#" class="sous-titre">Supprimer un code</a>
                                </li>
                                <li>
                                    <a href="#" class="sous-titre">Reparation de Compte</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><img  src="../img/per.png"   width="30"
                                              height="30"  class="img-thumbnail"/></i><strong class="titres">Gestion Personnel</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li>
                                <a href="enregistrerPersonnel.php" class="sous-titre">Enregistrement de Personnel</a>
                             </li>
                              <li>
                                  <a href="enregisterSecteurZoneAd.php" class="sous-titre">Joindre AD-secteur</a>
                              </li>
                             <li>
                                 <a href="personnel.php" class="sous-titre">Liste de tous le personel</a>
                             </li>
                                <li>
                                    <a href="responsableDistInterne.php" class="sous-titre">Liste des RDI</a>
                                </li>
                                 <li>
                                     <a href="listesAd.php" class="sous-titre">Liste des AD</a>
                                </li>
                             
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                          <li>
                            <a href="#"><img  src="../img/per.png"   width="30px"
                                              height="30px"  class="img-thumbnail"/></i><strong class="titres">Gestion Demandes Achats</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li>
                                  <a href="demandeAchatGlobal.php">Voir Toutes Les Demandes</a>
                             </li>
                              <li>
                                    <a href="flot.html" class="sous-titre-ul">DA Par service <span class="fa arrow"></span></a>
                                     <ul class="nav">
                                     <?php  
                                    foreach ($infService as $ligne):
                                    echo "  <li>
                                    <a href='tables.html' class='sous-titre-ul-sous'><strong>$ligne[abreviation]</strong></a>
                                  </li> " ;   
                                    endforeach;
                                     
                                     ?>
                               
                                  </ul>
                              </li>
                              <li>
                                  <a href="listeCotation.php" class="sous-titre">Voir Toutes Les Cotations</a>
                             </li>
                                <li>
                                    <a href="flot.html"><h5 class="sous-titre-ul">Cotations Par service</h5><span class="fa arrow"></span></a>
                                    <ul class="nav">
                               <?php  
                                    foreach ($infService as $ligne):
                                    echo "  <li>
                                    <a href='cotationService.php?id=$ligne[id]'><strong>$ligne[abreviation]</strong></a>
                                  </li> " ;   
                                    endforeach;
                                     
                                     ?>
                                  </ul>
                              </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><img  src="../img/article.jpg"   width="30px"
                                              height="30px"  class="img-thumbnail"/></i><strong class="titres">Gestion Articles</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="stocksMp.php" class="sous-titre">liste Matière Première</a>
                                </li>
                                <li>
                            <a href="#"><h5 class="sous-titre-ul">liste Autre</h5><span class="fa arrow"></span></a>
                               
                                    <ul class="nav">
                                <?php  
                                    foreach ($infFamille as $ligne):
                                    echo "  <li>
                                    <a href='listeAutreP.php?id=$ligne[id]'><strong>$ligne[designation]</strong></a>
                                  </li> " ;   
                                    endforeach;
                                     
                                     ?>
                                  </ul>
                                </li> 
                                 <li>
                                     <a href="enregisterArticle.php" class="sous-titre">Enregistrement d'article</a>
                                 </li>
                            </ul>
                        </li>
                         <li>
                              <a href="#"><img  src="../img/ville.png"   width="30px"
    height="30px"  class="img-thumbnail"/><strong class="titres">Gestion du stocks</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html" class="sous-titre-ul">Matiere Premiere<span class="fa arrow"></span></a>
                                    <ul class="nav">
                                <li>
                                    <a href="stocksMp.php" class="sous-titre-ul-sous">voir le Stocks Mp</a>
                                </li>
                               <li>
                                    <a href="entreeMp.php" class="sous-titre-ul-sous">voir les entree de Mp</a>
                                </li>
                                <li>
                                    <a href="sortieMp.php" class="sous-titre-ul-sous">voir les sorties de Mp</a>
                                </li>
                                 <li>
                                    <a href="#" class="sous-titre-ul-sous">faire un Etat Global entree</a>
                                </li>
                                 <li>
                                    <a href="#" class="sous-titre-ul-sous">faire un Etat Global Sortie</a>
                                </li>
                                  </ul>
                              </li>
                             <li>
                                 <a href="flot.html" class="sous-titre-ul">Autres Articles<span class="fa arrow"></span></a>
                                    <ul class="nav">
                            <li>
                                    <a href="#" class="sous-titre-ul-sous">Les entrees Autre</a>
                                </li>
                                <li>
                                    <a href="#" class="sous-titre-ul-sous">les sorties Autres</a>
                                </li>
                                 <li>
                                    <a href="#" class="sous-titre-ul-sous">Etat Global entree Autre</a>
                                </li>
                                 <li>
                                    <a href="#" class="sous-titre-ul-sous">Etat Global Sortie</a>
                                </li>
                                  </ul>
                              </li>
                               <li>
                                    <a href="" style='color:mediumvioletred'>Produits Fini<span class="fa arrow"></span></a>
                                    <ul class="nav">
                            <li>
                                    <a href="#">les entree de CartonMc<span class="fa arrow"></span></a>
                                      <ul class="nav">
                            <li>
                                <a href="listeProduction.php" class="sous-titre-ul-sous">Production</a>
                                </li>
                                <li>
                                    <a href="listeRetour.php" class="sous-titre-ul-sous">Retour</a>
                                </li>
                                
                                  </ul>
                                </li>
                                <li>
                                    <a href="#">les sorties de CartonMc<span class="fa arrow"></span></a>
                                    <ul class="nav">
                            <li>
                                <a href="listeVente.php" class="sous-titre-ul-sous">Vente</a>
                                </li>
                                <li>
                                    <a href="listeDivers.php" class="sous-titre-ul-sous">Divers</a>
                                </li>
                                
                                  </ul>
                                </li>
                                 <li>
                                    <a href="#" class="sous-titre-ul-sous">Etat Global entree Mc </a>
                                </li>
                                 <li>
                                    <a href="#" class="sous-titre-ul-sous">Etat Global Sortie Mc</a>
                                </li>
                                  </ul>
                                </li>
                                <li>
                                    <a href="etatStocksDeTousLesArticles.php" class="sous-titre">L'Etat des Articles</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                            <li>
                              <a href="#"><img  src="../img/ville.png"   width="30px"
    height="30px"  class="img-thumbnail"/><strong class="titres">Gestion des S-Zones</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" class="sous-titre">Enregister Une Zone</a>
                                </li>
                                <li>
                                    <a href="#" class="sous-titre">Enregister un Secteur</a>
                                </li>
                                <li>
                                    <a href="#" class="sous-titre">Voir Tous les S-Zone</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                           <li>
                              <a href="#"><img  src="../img/iconUser.jpg"   width="30px"
    height="30px"  class="img-thumbnail"/><strong class="titres">Gestion des Clients</strong><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="enregistrerClients.php" class="sous-titre">Enregister Un client</a>
                                </li>
                                <li>
                                    <a href="listeClients.php" class="sous-titre">Voir tous les Clients</a>
                                </li>
                                <li>
                                    <a href="#" class="sous-titre">Detail sur un client</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                        <li>
                            <ul>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>