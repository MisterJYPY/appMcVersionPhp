<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelArticle
 *
 * @author Mr_JYPY
 */
//include_once '../../interface/interfaceArticles.php';

class modelArticle{
      
    public static function CreerArticles(\articles $articles) {
        
    }

    public static function ListeDesArticlesPourUneFamille(\famille $famille) {
         global $db;
         $id= $famille->getId();
        $sql="SELECT * FROM articles where famille=$id order by designation";
        $resultat=$db->selectInTab($sql);
            $tableau=array();
             $i=0;
               foreach($resultat as $ligne):
                     $article=new articles($famille,$ligne['designation']);
                      $article->setCode($ligne['code']);
                    //  $article->setDesigantion();
                      //$article->setFamille($famille);
                      $article->setId($ligne['id']);
                      $article->setUnite($ligne['unite']);
                      $tableau[$i]=$article;
                       $i++;
               endforeach;
               return $tableau;
    }

    public static function ListeDesFamilles() {
        global $db;
           $sql="SELECT * FROM famille order By designation";
             if(isset($_SESSION))
             {
          $nomService=$_SESSION['Nomservice'];
            if($nomService!="ACHAT ET PRODUCTION"):
           $sql="SELECT * FROM famille WHERE designation!='Matiere premiere' order By designation";      
                endif;
             }
           $resultat=$db->selectInTab($sql);
               $i=0;
           $tableau=array();
           foreach ($resultat as $ligne ):
                      $famille=new famille($ligne['designation']);
                      $famille->setId($ligne['id']);
                      $famille->setCode($ligne['code']);
                       $tableau[$i]=$famille;
                       $i++;
           endforeach;  
            return $tableau;
    }

    public static function supprimerArticles(\articles $articles) {
        
    }
    public static function Stocksarticle(\articles $article)
         {
           global $db;
           $id=$article->getId();
            $sql="SELECT quantite FROM stocks WHERE articles=$id";
            $resultat=$db->selectInTab($sql);
              $quantite=0;
              if(!empty($resultat)):
                  foreach($resultat as $ligne):
                  $quantite=$ligne['quantite'];
                  endforeach;
              endif;
            //var_dump($resultat)
            return $quantite;
              
           
        
         }

//put your code here
}
