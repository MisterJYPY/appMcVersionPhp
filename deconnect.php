<?php
   $var="perso";
   $page="espacePrive.php";
  include_once 'headerSecure.php';
 include_once 'core/config.php';
                     //verification 
  sessionUser::verification("comptes_personnel","login","password","pageSecure.php");
              if(isset($get['stop']) and $get['stop']==md5(base64_encode('couper'))){
                //  sessionUser::stop("pageSecure.php");
                  $code=$_SESSION['code_session'];
                  $debut= $_SESSION['heure_connection'];
          $requeteActualisation="WHERE debut='$debut'";
                    /*actualisation des elements pour le validant */
      if($db->update('etatconnection',array("fin"=>date('H:i:s')),$requeteActualisation)){         
                 sessionUser::stop("pageSecure.php");
                 header("location:pageSecure.php");
                 }
                  
                   //fin verification
                  }
  