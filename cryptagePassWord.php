<?php
  
//   $sql='SELECT * FROM comptes_personnel';
//  $cpte=$db->selectInTab($sql);
//         $nbreFait=count($cpte);
//         $compteurSucces=1;
//       foreach($cpte as $ligne):
//           $idPer=$ligne['personnel'];
//           $login=$ligne['login'];
//           $passEncien=$ligne['password'];
//           //if($login=='anass'):
//         $nvoPassword=md5($passEncien);
//           $requeteActualisati=" WHERE personnel=$idPer AND login='$login' and password='$passEncien' ";
//                   if($db->update('comptes_personnel',array("password"=>$nvoPassword),$requeteActualisati)){
//                        $compteurSucces++;
//                        //echo 'OK FIRST';
//                    }
//    // endif;
//           
//              
//       endforeach;
//         if($compteurSucces>=$nbreFait):
//             echo 'Tout a bien ete Fait Avec Succes';
//         endif;
//   $sql="SELECT * FROM famille";
//   $res=$db->selectInTab($sql);
//   $compteur=1;
//   foreach($res as $resultat)
//   {
//       $id=$resultat['id'];
//       $code= generateurCode::getCodeFamille($id);
//      $requeteActualisati=" WHERE id=$id";
//   if($db->update('famille',array("code"=>$code),$requeteActualisati)){
//                   $compteur2++;
//                     //echo 'OK FIRST';
//                  }
//       
//   }
    $sqlMagasin="SELECT * FROM magasin";
    $sqlStocks="SELECT * FROM stocks";
       $stocksResults=$db->selectInTab($sqlStocks);
        $resultMa=$db->selectInTab($sqlMagasin);
       foreach($stocksResults as $ligne):
           $nbreMagasin=count($resultMa);
           //calcul du quotient
          $quantite=$ligne["quantite"];
          $article=$ligne["articles"];
          $rest=$quantite%$nbreMagasin;
          $nbreDivisible=$quantite-$rest;
          $valeur=$nbreDivisible/$nbreMagasin;
          $last=$valeur+$rest;
              if($rest>0)
              {  
                   $i=1;
          foreach($resultMa as $ligne2)  :
               if($i<$nbreMagasin)
                {
   $db->insertdata('stocks_magasin',array(array("produit"=>$ligne["articles"],"quantite"=>$valeur,"magasin"=>$ligne2["id"]
                )));     
                }
                else {
                 if($i=$nbreMagasin):
    $db->insertdata('stocks_magasin',array(array("produit"=>$ligne["articles"],"quantite"=>$last,"magasin"=>$ligne2["id"])));   
                 endif;
                }
                $i++;
            endforeach;  
              }
       else {
             $valeur=$quantite/$nbreMagasin;
          if($rest==0):
            foreach($resultMa as $ligne2)  :
   $db->insertdata('stocks_magasin',array(array("produit"=>$ligne["articles"],"quantite"=>$valeur,"magasin"=>$ligne2["id"]
                )));     

            endforeach;  
             endif;
           }
       endforeach;
     