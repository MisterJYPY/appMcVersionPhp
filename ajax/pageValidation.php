<?php
         header('Content-type:text');
        include_once '../core/config.php';
      
           $idEntree=$pos['da'];
           $codeBordereaux=$pos['bor'];
          $sqlDemenadeur="SELECT demandeachat.demandeur,demandeachat.date,personnel.fonction,demandeachat.bordereaux,personnel.nom,personnel.prenom"
                        . " FROM demandeachat  "
                        . " INNER JOIN personnel ON personnel.id=demandeachat.demandeur "
                        . " WHERE demandeachat.id=$idEntree";
          $sqlServiceDesignationDemandeur="SELECT demandeachat.service,services.designation FROM demandeachat"
                        . " INNER JOIN services ON services.id=demandeachat.service"
                        . " WHERE demandeachat.id=$idEntree";
           $infServiceDemandeur=$db->selectInTab($sqlServiceDesignationDemandeur);
           $serviceDemandeur=$infServiceDemandeur[0]['designation'];
           $infDemandeur=null;
           $infDemandeur=$db->selectInTab($sqlDemenadeur);
           $nomDemandeur=$infDemandeur[0]['nom'];
           $prenomDemandeur=$infDemandeur[0]['prenom'];
           $serviceDesignation=$_SESSION['Nomservice'];
           $fonctionDemandeur=$infDemandeur[0]['fonction'];
           $dateCreation=$infDemandeur[0]['date'];
             /*-----------------------------Permet d'avoir le nom du prochain a valider */
          $nomProchain="";
          $prenomProchain="";
          $idProchain="";
           /*-------------------------------id demandeur---------------------------*/
                  $idPersonnel=$_SESSION['idPersonnel'];
         
               if($_SESSION['fonction']=="RESPONSABLE" and $serviceDesignation=="ACHAT ET PRODUCTION"){
                  $quantite='quantiterArt' ;
                  $idA='article';
                    $nombreArtcle=$pos['nbre'];
                  /*DETERMINATION DE LA PROCHAINE PERSONNE A SIGNER*/
                   $sql="SELECT personnel.id,personnel.nom,personnel.prenom,personnel.fonction,services.designation "
                             . " FROM personnel,services "
                             . "WHERE services.designation='ACHAT ET PRODUCTION' AND "
                             . "personnel.fonction='ASSISTANT' AND services.id=personnel.service";
                          
                       $infProchain=$db->selectInTab($sql);
                            // var_dump($infProchain);
                      $nomProchain=$infProchain[0]['nom'];
                      $prenomProchain=$infProchain[0]['prenom'];
                      $idProchain=$infProchain[0]['id'];
                    //une boucle et faire le update en meme temps
                    /*DETERMINATION DES INFORMATIONS DE L'ASSISTANT POUR PRODUIRE LA DEMANDE DE COTATION*/
                $requeteAssistant="SELECT id from personnel WHERE service=("
                                  . " SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION') AND fonction='ASSISTANT'";
                $infAssistant=$db->selectInTab($requeteAssistant);
                   $idAssistant=$infAssistant[0]['id'];
                      /*FIN DEMANDE*/
                   $compteurSucces=0;
                   for($cpt=1;$cpt<=$nombreArtcle;$cpt++):
                        $quantite="quantiterArt$cpt" ;
                        $idA="article$cpt";
                      $quantite=$pos[$quantite];
                      $idArtcledmandeAchat=$pos[$idA];
                     $requeteActualisati=" WHERE id=$idArtcledmandeAchat";
                   if($db->update('articlesdemandeachat',array("quantiter"=>$quantite),$requeteActualisati)){
                        $compteurSucces++;
                        //echo 'OK FIRST';
                    }
                    endfor;
                    //echo  $compteurSucces;
                    /* SI TOUT EST OK NOUS ALLONNS ACTUALISER LA TABLE SUIVI_VALIDATION*/
                    if($compteurSucces==$nombreArtcle):
                        $code="MC".$codeBordereaux;
                  $requeteActualisation=" WHERE demandeAchat=$idEntree and signataire=$idPersonnel and estSigne='NON' ";
                                               /*actualisation des elements pour le validant */
                 if($db->update('suivi_validation',array("estSigne"=>'OUI',"type"=>'OK'),$requeteActualisation)){
                if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnel)))): 
                   // 
     if($db->insertdata('cotation',array(array("demandeAchat"=>$idEntree ,"expediteur"=>$idAssistant,"delai_reponse"=>2,"code_cotation"=>$code,"statut"=>"EC")))):
                         include '../ajax/recapitulatif.php';
              endif;
                     endif;
                       
                   }
                    endif;
               }
               else{
                 if($_SESSION['fonction']=='ASSISTANT' and $serviceDesignation=="ACHAT ET PRODUCTION")
                 {
                  $sql="SELECT personnel.id,personnel.nom,personnel.prenom,personnel.fonction,services.designation "
                             . " FROM personnel,services "
                             . "WHERE services.designation='ACHAT ET PRODUCTION' AND "
                             . "personnel.fonction='RESPONSABLE' AND services.id=personnel.service";
                 }
                 else{
                      $sql="SELECT personnel.id,personnel.nom,personnel.prenom,personnel.fonction,services.designation "
                             . " FROM personnel,services "
                             . "WHERE services.designation='ACHAT ET PRODUCTION' AND "
                             . "personnel.fonction='ASSISTANT' AND services.id=personnel.service";
                     }
                      $infProchain=$db->selectInTab($sql);
                      $nomProchain=$infProchain[0]['nom'];
                      $prenomProchain=$infProchain[0]['prenom'];
                      $idProchain=$infProchain[0]['id'];
                      //insertion dans la base de donnéé en faisant une actualisation
                    
                 $requeteActualisation="WHERE demandeAchat=$idEntree and signataire=$idPersonnel and estSigne='NON' ";
                                               /*actualisation des elements pour le validant */
                 if($db->update('suivi_validation',array("estSigne"=>'OUI',"type"=>'OK'),$requeteActualisation)){
                                                 /*insertion */
                 if($db->insertdata('suivi_validation',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idProchain
                ,"date_envoi"=>date('Y-m-d'),"estSigne"=>'NON',"type"=>'EC')))){
                 if($db->insertdata('signataire_approber',array(array("demandeAchat"=>$idEntree ,"signataire"=>$idPersonnel)))){
                       include '../ajax/recapitulatif.php';
                    // echo 'C BIEN OOOOOOOOOOOOOOOOOOKKKK';
               }
                   }   
               }
                 else{ 
                     echo 'PROBLEMMMMMMMMMMMMMMMME';
                 }
               }
