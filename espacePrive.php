<?php
   $var="perso";
   $page="espacePrive.php";
  include_once 'heade.php';
                     //verification 
         if($_SESSION['fonction']=="RESPONSABLE" or ($_SESSION['fonction']=="ASSISTANT" and $_SESSION['Nomservice']=="ACHAT ET PRODUCTION")):
                                      $sign="NON";
                                      $idp=$_SESSION['idPersonnel'];
                     $sqlA="SELECT * FROM suivi_validation WHERE signataire=$idp and estSigne=\"$sign\" and type='EC' ORDER BY derniere_modif DESC ";
                     $listeB=$db->selectInTab($sqlA);
                     $_SESSION['demande']=count($listeB);
                            endif;
  sessionUser::verification("comptes_personnel","login","password","pageSecure.php");
              if(isset($get['stop']) and $get['stop']==md5(base64_encode('couper'))){
                     $code=$_SESSION['code_session'];
          $requeteActualisation="WHERE code_session= $code";
         // $_SESSION['heure_connection']=date('H:i:s');
         /*actualisation des elements pour le validant */
      if($db->update('etatconnection',array("fin"=>date('H:i:s')),$requeteActualisation)){         
                  sessionUser::stop("pageSecure.php");
                 }
                  //   header("location:pageSecure.php");
                   //fin verification
                  }?>
     <div class="pagePrincipale" id="milieu">
         <?php
  include_once 'contenuPerso.php';?>
         </div>
<?php
 include_once 'foot.php';