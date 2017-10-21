<?php
  $var ="demande";
  $page="FicheDemandeAchat.php";
  include_once 'heade.php';
   sessionUser::verification("comptes_personnel","login","password","pageSecure.php");
              if(isset($get['stop']) and $get['stop']==md5(base64_encode('couper'))){
                  sessionUser::stop("pageSecure.php");
                  }
  include_once 'newRequest.php';
 
  
 include_once 'foot.php';
 