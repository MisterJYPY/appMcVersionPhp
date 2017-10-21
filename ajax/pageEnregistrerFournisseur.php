<?php
 header('Content-type:text');
 include_once '../core/config.php';
 $idFournisseur=(int)$pos['controle'];
 $nom=$pos['nom'];
 $contact=$pos['contact'];
 $mail=$pos['mail'];
 $livraison=$pos['livraison'];
 $attention=$pos['attention'];
 $telecopie=$pos['telecopie'];
 $condition=$pos['condition'];
 $validite=$pos['validite'];
 $cotation=$pos['cotation'];
 /*  NOTIF DE REUSSITE TOTALE   */
     $msg1='';  /*Success! Info! Warning! Danger!*/
     $msg2='';
     $class='';/*  alert-success     alert-info  alert-warning  alert alert-danger*/
 /*END OF NOTIF*/
   if($idFournisseur!=-1)
   {
      //echo "ON INSERE AVEC UN FOURNISSEUR EXISTANT $idFournisseur et la cotation esr $cotation" ;
      if($db->insertdata('fournisseursurcotation',array(array("fournisseur"=>$idFournisseur ,"cotation"=>$cotation
         ,"date"=>date('Y-m-d'),"validite"=>$validite,"delai_livraison"=>$livraison,"reglement"=>$condition,"receptioniste"=>$attention)))){
           $msg1='Succes!';
           $msg2='Nouveau Fournisseur associer a cette cotation!';
           $class='alert-success';
                }
                else{
            $msg1='Echec!';
           $msg2='Non Enregistrer veuillez reesayer ou contactez le developpeur si cela persiste!';   
            $class='lert alert-danger';
                }
   }
else{
    //creation fournisseur avant insertion';
   if($db->insertdata('fournisseur',array(array("nom"=>$nom,"mail"=>$mail
         ,"contacts"=>$contact,"telecopie"=>$telecopie)))){
       //recuperation de l'id du fournisseur crrer a linstant
  $sqlIdFournisseur="SELECT id FROM fournisseur WHERE nom='$nom' and mail='$mail' and contacts='$contact' and telecopie='$telecopie'";
  $resultat=$db->selectInTab($sqlIdFournisseur);
          $idF=$resultat[0]['id'];
      //insertion dans la nouvelle table
     if($db->insertdata('fournisseursurcotation',array(array("fournisseur"=>$idF ,"cotation"=>$cotation
         ,"date"=>date('Y-m-d'),"validite"=>$validite,"delai_livraison"=>$livraison,"reglement"=>$condition,"receptioniste"=>$attention)))){
           $msg1='Succes!';
           $msg2='Nouveau Fournisseur associer a cette cotation!';
           $class='alert-success';
         }
         else{
              $msg1='Echec!';
           $msg2='Non Enregistrer veuillez reesayer ou contactez le developpeur si cela persiste!';   
            $class='lert alert-danger'; 
         }
                }
                else{
           $msg1='Echec!';
           $msg2='Non Enregistrer veuillez reesayer ou contactez le developpeur si cela persiste!';   
           $class='lert alert-danger';
                }
    //fin creation du fournisseur
    
    }
    ?>
<div class="<?php echo $class ?>">
    <a href="#" class="close" data-dismiss="alert" aria-label="fermer">&times;</a>
  <strong><?php echo $msg1; ?></strong> <?php echo $msg2;?>
</div>
