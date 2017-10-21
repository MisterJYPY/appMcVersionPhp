<?php
header('Content-type:text');
        include_once '../core/config.php';
        include_once '../core/classes/modelPersonnel.php';
          //recuperation des elements saisies
              $idPersonnelDemandeur=(int)$pos['idPersonnel'];
              $idService=(int)$pos['idService'];
              $codeBordereaux=$pos['code'];
              $nombreArticle=$pos['nombreArticle'];
         //recuperation de toutes les informations de la personne qui demande
               $sql1="SELECT personnel.nom ,personnel.prenom,personnel.fonction,services.designation,
                      services.abreviation FROM personnel 
                      INNER JOIN services on services.id=personnel.service
                      where personnel.id =$idPersonnelDemandeur ";
              // echo $sql1;
           $infDemandeur=$db->selectInTab($sql1);
                   $nomDemandeur='';
                   $prenomDemandeur='';
                   $serviceDesignation='';
                   $serviceDemandeur='';
                   $fonctionDemandeur='';
                   //  var_dump($infDemandeur);
           foreach($infDemandeur as $row):
                             $nomDemandeur=$row['nom'];
                             $prenomDemandeur=$row['prenom'];
                             $serviceDesignation=$row['designation'];
                              $serviceDemandeur=$row['designation'];
                              $fonctionDemandeur=$row['fonction'];
                          endforeach;
         // echo  $observation1=$pos['nombreArticle'];
             // var_dump($pos);
            $validite=0;
     if($db->insertdata('demandeachat', array(array("bordereaux"=>$pos['code']
                ,"service"=>$idService,"date"=>date('Y-m-d'),"demandeur"=>$idPersonnelDemandeur))))
              {
                $sql="SELECT id from demandeachat WHERE bordereaux='$codeBordereaux'";
                $resultat=$db->selectInTab($sql);
                $idEntree=$resultat[0]['id'];
                     for($i=1;$i<=$nombreArticle;$i++){
                        $observation="observation$i";
                        $justificatif="justification$i";
                        $article="article$i";
                        $quantiter="quantiteCommander$i";
              $db->insertdata('articlesdemandeachat',array(array("article"=>$pos[$article],"observation"=>$pos[$observation] ,"justificatif"=>$pos[$justificatif]
                ,"demandeAchat"=>$idEntree,"quantiter"=>$pos[$quantiter])));
                          }
                            //recuperation de l'id du chef de service coorespondant
                          
                    if($_SESSION['fonction']=="RESPONSABLE"){
                           if($serviceDemandeur=='ACHAT ET PRODUCTION')
                                  {
                   $sql2="SELECT * FROM personnel WHERE service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION') and fonction='ASSISTANT'";
                                                     $resultat2=$db->selectInTab($sql2);
                           $nomProchain="";
                           $prenomProchain="";
                           $idProchain="";
                          foreach($resultat2 as $row):
                            $idProchain=$row['id'];
                             $nomProchain=$row['nom'];
                             $prenomProchain=$row['prenom'];
                          endforeach;
                if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'OUI',"type"=>'OK'))))
               {
                  // echo '<mark>Success ,Voila un recapitulatif de Tous ce que vous avez fait</mark>';
         if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur)))){
              $requeteAssistant="SELECT id from personnel WHERE service=("
                                  . " SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION') AND fonction='ASSISTANT'";
                $infAssistant=$db->selectInTab($requeteAssistant);
                $idAssistant=$infAssistant[0]['id'];
                 $code="MC".$codeBordereaux;
      if($db->insertdata('cotation',array(array("demandeAchat"=>$idEntree ,"expediteur"=>$idAssistant,"delai_reponse"=>2,"code_cotation"=>$code,"statut"=>"EC")))):
                   include '../ajax/recapitulatif.php';
                     endif;
               }
               
                }                
                                  }
                              else{
                 $sql2="SELECT * FROM personnel WHERE service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION') and fonction='ASSISTANT'";   
                            $resultat2=$db->selectInTab($sql2);
                           $nomProchain="";
                           $prenomProchain="";
                           $idProchain="";
                          foreach($resultat2 as $row):
                            $idProchain=$row['id'];
                             $nomProchain=$row['nom'];
                             $prenomProchain=$row['prenom'];
                          endforeach;
                          
               if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'OUI',"type"=>'OK'))))
                    {
           if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idProchain
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'NON',"type"=>'EC'))))
               {
                  // echo '<mark>Success ,Voila un recapitulatif de Tous ce que vous avez fait</mark>';
             if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur)))){
                 
                   include '../ajax/recapitulatif.php';
               }
               
                }
                   else
                   {
                      // echo 'PROBLEME QUELQUE PART';
                   }
               }
                                     }
                          }
                          else{
                         //si il est du service achat et Production
                      if($_SESSION['Nomservice']=='ACHAT ET PRODUCTION'){
                  if($_SESSION['fonction']=="ASSISTANT"){
                   $sql2="SELECT * FROM personnel WHERE service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION') and fonction='RESPONSABLE'";   
                    }
                  else{
                   $sql2="SELECT * FROM personnel WHERE service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION') and fonction='ASSISTANT'";   
                  }
                            $resultat2=$db->selectInTab($sql2);
                           $nomProchain="";
                           $prenomProchain="";
                           $idProchain="";
                          foreach($resultat2 as $row):
                            $idProchain=$row['id'];
                             $nomProchain=$row['nom'];
                             $prenomProchain=$row['prenom'];
                          endforeach;
                          
                            if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'OUI',"type"=>'OK'))))
                    {
           if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idProchain
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'NON',"type"=>'EC'))))
               {
                  // echo '<mark>Success ,Voila un recapitulatif de Tous ce que vous avez fait</mark>';
             if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur)))){
                   include '../ajax/recapitulatif.php';
               }
               
                }
                   else
                   {
                      // echo 'PROBLEME QUELQUE PART';
                   }
               }
                               
                          }else{
                        //gerer les fonctions
                             
                               
                        //gerer les fonctions
                   $sql2="SELECT * FROM personnel WHERE service=$idService and fonction='RESPONSABLE' ";
                           $resultat2=$db->selectInTab($sql2);
                           $nomProchain="";
                           $prenomProchain="";
                           $idProchain="";
                          foreach($resultat2 as $row):
                            $idProchain=$row['id'];
                             $nomProchain=$row['nom'];
                             $prenomProchain=$row['prenom'];
                          endforeach;
                       
                          
                 //insertion dans le panier de personne qui on deja signer
            if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'OUI',"type"=>'OK'))))
                    {
           if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idProchain
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'NON',"type"=>'EC'))))
               {
                  // echo '<mark>Success ,Voila un recapitulatif de Tous ce que vous avez fait</mark>';
             if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur)))){
                   include '../ajax/recapitulatif.php';
               }
               
                }
                   else
                   {
                      // echo 'PROBLEME QUELQUE PART';
                   }
               }
                
                             }
                              
                          }
//                          if($serviceDemandeur!='ACHAT ET PRODUCTION'){
//                           $sql2="SELECT * FROM personnel WHERE service=$idService and fonction='RESPONSABLE' ";
//                          }
//                            else{
//                          $sql2="SELECT * FROM personnel WHERE service=$idService and fonction='ASSISTANT'"; 
////                            }
//                           $resultat2=$db->selectInTab($sql2);
//                           $nomProchain="";
//                           $prenomProchain="";
//                           $idProchain="";
//                          foreach($resultat2 as $row):
//                            $idProchain=$row['id'];
//                             $nomProchain=$row['nom'];
//                             $prenomProchain=$row['prenom'];
//                          endforeach;
//                       
//                          
//                 //insertion dans le panier de personne qui on deja signer
//            if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur
//                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'OUI',"type"=>'OK'))))
//                    {
//           if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idProchain
//                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'NON',"type"=>'EC'))))
//               {
//                  // echo '<mark>Success ,Voila un recapitulatif de Tous ce que vous avez fait</mark>';
//             if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnelDemandeur)))){
//                   include '../ajax/recapitulatif.php';
//               }
//               
//                }
//                   else
//                   {
//                      // echo 'PROBLEME QUELQUE PART';
//                   }
//               }
//                
              }
        //echo 'OOOOOOOOOOOOOOOOOOOOK';
          //    endif;