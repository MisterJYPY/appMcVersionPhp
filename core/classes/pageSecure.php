<?php
         include 'headerSecure.php';
       // include 'cryptagePassWord.php';
    //echo realpath('core/config.php');
    include_once ('core/config.php'); ?>
         ?>
    <body>
            <script type="text/javascript" > 

$('body').css("margin-top","-1000000px"); 
$('body').prepend("<div id='wait' style='position:absolute;width:220px;top:40%;left:40%;text-align:center;font-weight:bold;' >Chargement en cours . . .<br/><img src='./img/chargement.gif' ></img></div>"); 

function body_ready(){$('body').css('margin-top','');$('#wait').css('display','none');} 
$(document).ready(function(){body_ready();}); 

</script>       
            <div class="container panel principal">
                <div class="row arrondis animated bounceInUp">
         <div class="" >
             <div class="row"> 
                 <div class="col-lg-2 col-md-2 col-xs-3 partieimage">
                     <img classe="cardena" src="img/cle.png" alt="LeLogo Ici">
                 </div>
                  <div class="col-lg-offset-3 col-md-offset-3 col-xs-offset-4 col-lg-6 miseEnGarde">
                      <p class="premierePhraseSecure">L'accès à cette page </p>
                      <p class="secondePhraseSecure">est restreint par un code d'accès </p><br><BR>
                      <?php
                      
                      if(isset($pos['valider']))
                      { 
                          // echo md5('nadir');
                             $loginCripter=md5($pos['login']);
                              $passwordCripter=md5($pos["password"]);
                            // echo '/'.md5('anass');
                             $login=$pos['login'];
                            $password=$pos['password'];
                           $nbrow=$db->nbrows('comptes_personnel'," WHERE login='$login' AND password='$passwordCripter'")  ;
                           
                              if($nbrow>0){
                                  //requete de selection de toutes les personnes
                           $sqlg="select comptes_personnel.personnel,personnel.id as id,nom,personnel.mail,personnel.contacts,prenom,fonction,service,services.designation,services.abreviation FROM comptes_personnel,personnel,services
                                              WHERE comptes_personnel.login='$login' and comptes_personnel.password='$passwordCripter' 
                                        and personnel.id=comptes_personnel.personnel and services.id=personnel.service";
                                  // recuperation sous forme de tableau
                                  $informationg=$db->selectInTab($sqlg);
                                          
                                     //creation du personnel
                                     $perso=new personnel();
                                     //creation du service
                                     $service=new service();
                    //var_dump($informationg);
                                foreach ($informationg as $ligne):
                                          $perso->setId($ligne['id']);
                                          $perso->setFonction($ligne['fonction']);
                                          $perso->setNom($ligne['nom']);
                                          $perso->setPrenoms($ligne['prenom']);
                                          $service->setId($ligne['service']);
                                          $service->setDesignation($ligne['designation']);
                                          $service->setAbreviaton($ligne['abreviation']);
                                          $perso->setService($service);
                                          $perso->setMail($ligne['mail']);
                                          $perso->setContacts($ligne['contacts']);
                                     endforeach;
                              var_dump($perso);
                                //verification pour le renvoyer a la page corespondante
                             echo 'avant ';
                                $f=new famille("hddh");
                             //   $v = new sessionUser();
                               echo 'apres';
                              sessionUser::start($login,$passwordCripter, $service->getId(), $perso->getId());
                     //   {
                     echo 'MR NANOU HGGGC';
                                    //  echo session_status();
                                         //completer toutes les variables de SESSION
                                     $_SESSION['nom']=$perso->getNom();
                                      $_SESSION['prenom']=$perso->getPrenoms();
                                     $_SESSION['Nomservice']=$perso->getService()->getDesignation();
                          $_SESSION['fonction']=$perso->getFonction();
                             
                                     //if($perso->getFonction()!='RESPONSABLE'){
                                         header('location:espacePrive.php');
                                     // header('location:ficheDemandeAchat.php');   
                                   //  }
//}
                                //  else{
                                 //    echo 'NO OO O O O O O '.
                                //    }
                                //  
                              }
                           else{
                               $msg['title']='Notification d\'echec';
                               $msg['type']='warning';
                               $msg['content']='Vous Avez Entrez des identifiants erronés';
                             }
                       }
                               ?>
                                 <?php if(!empty($msg)):?>
				<div class="row">
					<div class="col-lg-8">
					<div class="alert alert-dismissable alert-<?php echo $msg["type"];?>">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<h4><?php echo $msg["title"];?></h4>
					<p><?php echo $msg["content"];?></p>
					</div>
					</div>
					</div>
					<?php endif;//if(!empty($msg)):?>
                      
                 </div> 
                  </div>
                   
                   <div class="row"> 
                       
                       <div class="col-lg-offset-4 col-md-offset-4 col-xs-offset-5 col-lg-6 miseEnGarde"><br>
                        
   <h2 class='presentationFormulaireConnection'>veuillez vous connecter ici</h2>
   
     <div class="champDeSecurite">
       
         <form class="form-horizontal" action="<?php filter_input(INPUT_SERVER, "REQUEST_URI"); ?>" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-2" for="text">Login:</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" id="login" name="login" placeholder="Entrer votre login" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" name="password" placeholder="Entrer votre Mot de passe" required>
      </div>
    </div>
       <div class="form-group col-offset-2 ">
         <button type="submit" class="btn btn-default btn-lg animated bounceInUp icon-next" name='valider' > ENTRER </button>
       </div>
   </form>
</div>
                 </div> 
                  </div>
             
                   </div>
                
             </div>
    </body>
	 <script src="dist/js/jqueryDatepicker.js"></script>
            <script src="js/senddata.js"></script>
            <script src="js/traitementJs.js"></script>
    <script src="dist/js/datepicker.js"></script>
   
        <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
      
</html>
     <script type="text/javascript" src="js/roundies.js">
                         </script>
<script type="text/javascript">
    DD_roundies.addRule('div.arrondi', '10px');
     DD_roundies.addRule('h1', '10px');
     DD_roundies.addRule('a', '8px');
    </script>