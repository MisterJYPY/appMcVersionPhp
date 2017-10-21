<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelPersonnel
 *
 * @author Mr_JYPY
 */
class modelPersonnel {
    //put your code here
    
    public static  function ListeDesServices()
    {
       global $db;
           $sql="SELECT * FROM services order By designation";
           $resultat=$db->selectInTab($sql);
               $i=0;
           $tableau=array();
           foreach ($resultat as $ligne ):
                      $service=new service();
                      $service->setId($ligne['id']);
                      $service->setDesignation($ligne['designation']);
                      $service->setAbreviaton($ligne['abreviation']);
                       $tableau[$i]=$service;
                       $i++;
           endforeach;  
            return $tableau;
        
    }
    public static function listeDesEmployeDuService(service $service)
    {
        global $db;
         $id= $service->getId();
        $sql="SELECT * FROM personnel where service=$id order by nom";
        $resultat=$db->selectInTab($sql);
            $tableau=array();
             $i=0;
               foreach($resultat as $ligne):
                     $personnel=new personnel();
                     $personnel->setAdresse($ligne['adresse']);
                     $personnel->setNom($ligne['nom']);
                     $personnel->setPrenoms($ligne['prenom']);
                     $personnel->setId($ligne['id']);
                     $personnel->setService($service);
                     $personnel->setContacts($ligne['contacts']);
                     $personnel->setCode($ligne['code']);
                     $personnel->setMail($ligne['mail']);
                      $personnel->setFonction($ligne['fonction']);
                    //  $article->setDesigantion();
                    //  $article->setDesigantion();
                      //$article->setFamille($famille);
                     $tableau[$i]=$personnel;
                       $i++;
               endforeach;
               return $tableau;
    }
}
