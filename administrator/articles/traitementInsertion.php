<?php
   header('Content-type:text');
include_once '../../core/config.php';

      $nbreM=count($db->selectInTab("SELECT * FROM magasin WHERE type!='cartonMc' ")) ;
     $nbre=$pos['nbre'];
      $famille=$pos['famille'];
      $cptInsertionStocks=0;
      $cptInsertionArticles=0;
      $class='';
      $msg1='';
      $msg2='';
        for($i=1;$i<=$nbre;$i++):
            $article=$pos["article$i"];
             $code=$pos["code$i"];
             $unite=$pos["unite$i"];
             $quantite=$pos["stocks$i"];
      if($db->insertdata('articles',array(array("designation"=>$article,"famille"=>$famille ,"code"=>$code,"unite"=>$unite
                )))){
           $cptInsertionArticles++;
         $sql="SELECT id FROM articles WHERE designation='$article' and code='$code' and famille=$famille";
           $InfArtcle=$db->selectInTab($sql);
           $idArtcle=$InfArtcle[0]['id'];
           if($db->insertdata('stocks',array(array("quantite"=>$quantite,"articles"=>$idArtcle
                )))){
             //insertion ou actualisation du stocks en magasin
           for($cpt=1;$cpt<=$nbreM;$cpt++):
               //pour recuperer l'id
               $nomId='idM';
               $nomId.=$i;
               $nomId.=$cpt;
              $idM=(int)$pos[$nomId];
              //pour recuperer la quantite
                $nomq='quantiteM';
                $nomq.=$i;
                $nomq.=$cpt;
               $quantiteM=(int)$pos[$nomq];
                  $var=1;
 if($db->insertdata('stocks_magasin',array(array("produit"=>$idArtcle,"quantite"=>$quantiteM ,"magasin"=>$idM
          )))){
               $var++;
              }
           endfor;
              if($var=$nbreM)
              {
               $cptInsertionStocks++;
              }
                }
            } 
               
         endfor;
         if($cptInsertionStocks==$cptInsertionArticles){
              $class='alert-success';
              $msg1='Insertion Reussie';
              $msg2='Tous les produits on bien ete Enregister pour La Famille Mentionné';
         }
         else{
                $class='danger';
              $msg1='!!ECHEC INSERTION!!!!';
              $msg2='Un probleme Inattendu est survenu quelque part';
             }
             ?>
                    <div class="col-lg-12">
	                     	<div class="alert alert-dismissable <?php echo $class;?>">
			        <button data-dismiss="alert" class="close" type="button">×</button>
			        <h4><?php echo $msg1; ?></h4>
                                <p class='active'><?php echo $msg2;?></p>
			        </div>
			    </div>