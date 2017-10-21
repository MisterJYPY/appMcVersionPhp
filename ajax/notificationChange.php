<?php
       header('Content-type:text');
      
      include_once '../core/config.php';
           if(isset($_SESSION['fonction'])):
  if($_SESSION['fonction']=="RESPONSABLE" or ($_SESSION['fonction']=="ASSISTANT" and $_SESSION['Nomservice']=="ACHAT ET PRODUCTION")):
                              $sign="NON";
                              $idp=$_SESSION['idPersonnel'];
        $sqlA="SELECT * FROM suivi_validation WHERE signataire=$idp and estSigne=\"$sign\" and type='EC' ORDER BY derniere_modif DESC ";
        $listeA=$db->selectInTab($sqlA);
                               // var_dump($listeA);
                                   $idDA='';
                                   $num='da';
                                   $compteur=1;
                                   $nbre=count($listeA);
                       if($nbre>0){
                                     foreach($listeA as $ligne):
                                        $idDA.=$num;
                                        $idDA.=$compteur; 
                                        $idDA.="=";
                                        $idDA.=$ligne['demandeAchat'];
                                       if($compteur<$nbre):
                                           $idDA.='&';
                                       endif;
                                       $compteur++;
                                     endforeach;
                                        }
                              $envoiDonnee='nbre='.$nbre.'&'.$idDA; 
                                 // var_dump($envoiDonnee);
                               //if($_SESSION['demande']!=count($listeA)):
                              ?>
   
<a href="#" onclick="mettreMileu('<?php echo $envoiDonnee; ?>','milieu','ajax/VueNotif.php')"  class="dropdown-toggle rouge animated flash" data-toggle="dropdown" 
           data-hover="dropdown" data-delay="0" data-close-others="false">(<strong>
                   <?php echo count($listeA) ;?> )</strong>
                  <i class=""></i></a>
                       <?php endif;
                       endif;
                        ?>