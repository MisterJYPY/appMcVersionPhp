<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>McCroftApp</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="EntrePrise McCroft Tobacco" />
<meta name="author" content="NANOU KAKOU JEAN-PAUL,
      Etudiant Master Genie-Informatique Université Nanguy Abrogoua(Cote d'ivoire)
       mail:nanoukakoujeanpaul@gmail.com/kaksolechic@gmail.com
       contacts telephonique=(225)02134218
       ">
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/cubeportfolio.min.css" rel="stylesheet"/>
<link href="css/style.css" rel="stylesheet" />
<link rel="author" href="humans.txt" />
<link rel="icon" type="image/png" href="img/favicon.png" />
 <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


<!-- Theme skin -->
<link id="t-colors" href="skins/default.css" rel="stylesheet" />

	<!-- boxed bg -->
	<link id="bodybg" href="bodybg/bg2.css" rel="stylesheet" type="text/css" />
	<link type="text/css" rel="stylesheet" href="assets/datepickercontrol.css">
    <link type="text/css" rel="stylesheet" href="assets/stylePersonel.css">
    <script type="text/javascript" src="js/jquery.reveal.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/boostrap.min.js"></script>
      <script type="text/javascript" src="core/traitementJs.js"></script>

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <?php   include 'core/config.php'; 
            // include 'cryptagePassWord.php';
      if(isset($_SESSION)){
    ?>
</head>
<body>


<div id="wrapper">
	<!-- start header -->
	<header>		
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <?php if($var=="demande") {  
                  echo " <a  href='#'>Le Système vous a reconnu comme :<strong><mark>Demandeur D'achat</mark></strong></a>";
                         } 
                     if($var=="perso") {  
        echo  "<a  href='#'><img src='img/avatar.png' alt='' width='80' height='52' />". "<strong>".$_SESSION['prenom']." ".$_SESSION['nom']."</strong></a>";
                         }  
                         ?>
                </div> 
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
            <?php 
                         /*ZONE ALERTE POUR INDIQUER AU RESPONSABLE A.PROD OU A SON ASSISTANT SIL YA A DES DOCS A TELECHARGER */
       
            if($_SESSION['fonction']=="RESPONSABLE" and $_SESSION['Nomservice']=="ACHAT ET PRODUCTION"): ?>
          <li class="dropdown ">
              <a href="administrator/index.php"  target="ok">
    <img  src="img/admin22.jpg" class="iconDeco"  width="40"
    height="40"  alt="Admin" /><i class=""></i></a>     
                    </li>    
<!--                     <li class="dropdown ">
<a href="#" onclick="mettreMileu('admin','milieu','parametre/admin.php')" class=" " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
    <img  src="img/admin1.png" class="iconDeco"  alt="Admin" class="img-thumbnail"/><i class=""></i></a>     
                    </li>      -->
             <?php
         endif; 
             
            
    if(($_SESSION['fonction']=="RESPONSABLE" and $_SESSION['Nomservice']=="ACHAT ET PRODUCTION") or ($_SESSION['fonction']=="ASSISTANT" and $_SESSION['Nomservice']=="ACHAT ET PRODUCTION")):
                $sqlDispo="SELECT * FROM suivi_validation WHERE estSigne='OUI' AND signataire=(SELECT id FROM personnel 
                 WHERE fonction='RESPONSABLE' and service=(
                 SELECT id FROM services 
                 WHERE designation='ACHAT ET PRODUCTION')) ORDER BY derniere_modif DESC"; 
                 $resultPDF=$db->selectInTab($sqlDispo);
                 $nombrePdf=count($resultPDF);
                       $compteu1=1;
                        $idDA1='';
                        $num='da';
                 foreach($resultPDF as $ligne):
                                       $idDA1.=$num;
                                       $idDA1.=$compteu1; 
                                       $idDA1.="=";
                                       $idDA1.=$ligne['demandeAchat'];
                                      if($compteu1<$nombrePdf):
                                       $idDA1.='&';
                                       endif;
                                       $compteu1++;
                                     endforeach;
                                       $idDA1.='&nbre=';
                                       $idDA1.=$nombrePdf;
                ?>
                  <li class="dropdown ">
<a href="#?<?php echo $nombrePdf; ?> " onclick="mettreMileu('<?php echo $idDA1; ?>','milieu','ajax/pdfPage.php')" class=" " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
<img  src="img/pdf.jpg" class="iconDeco"  alt="Pdf" class="img-thumbnail"/><mark><?php echo '('.$nombrePdf.')'; ?></mark><i class=""></i></a>     
                    </li>      
              <?php
            endif;
                               /*FIN DE CETTE PARTIE*/
         $sqlId="SELECT id FROM personnel WHERE service=(SELECT id FROM services WHERE designation='ACHAT ET PRODUCTION ') and fonction='ASSISTANT'";
               $res=$db->selectInTab($sqlId);
                  $idAchatProduction=$res[0]['id'];
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
                              ?>
                             <li class="dropdown active" id="notifications"> 
<a href="#" onclick="mettreMileu('<?php echo $envoiDonnee; ?>','milieu','ajax/VueNotif.php')"  class="dropdown-toggle rouge animated flash" data-toggle="dropdown" 
           data-hover="dropdown" data-delay="0" data-close-others="false">(<strong>
                   <?php echo count($listeA) ;?> )</strong>
    <i class=""></i></a></li>
                       <?php endif;
                        ?>
            <li class="dropdown">
    
<a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Mon Compte<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="afficherDemende(<?php echo $_SESSION['idPersonnel']; ?>,'milieu','ajax/changementInfo.php')">Changer Identifiants</a></li>
                                <li><a href="#" onclick="sendData('v=v','ajax/modificationInformationPersonnel.php','milieu')">Mes informations</a></li>
                            </ul>		
                        </li>
                        <li class="dropdown ">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Mes Activités <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Archives</a></li>
                                <li><a href="#" onclick="sendData('v=v','ajax/historiqueDemande.php','milieu')">Demande de Validation</a></li>
								
                            </ul>
                        </li>
                        <?php //if($_SESSION['fonction']!="RESPONSABLE" and $_SESSION['idPersonnel']!=$idAchatProduction) :
                            
                            ?>
          <li class="dropdown active"> 
              <a href="#" class="dropdown-toggle rouge animated flash" data-toggle="dropdown" 
                 data-hover="dropdown" data-delay="0" data-close-others="false" onclick="afficherDemende(1,'milieu','ajax/newRequest.php')">EFFECTUER UNE DEMANDE
                  <i class="fa fa-angle-down"></i></a></li> 
                
                      <?php //endif;?>
          <li><a href="<?php echo $page;?>?stop=<?php echo md5(base64_encode('couper'));?>"><img  src="img/dec.jpg" class="iconDeco"  alt="Log out" class="img-thumbnail"/></a></li>
                    </ul>
                </div>
            </div>
        </div>
            <?php 
                        }else{
                            
                            header("location:pageSecure.php")    ;        
                        }
                        
             ?>
	</header>