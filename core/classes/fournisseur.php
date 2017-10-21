<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fournisseur
 *
 * @author Mr_JYPY
 */
class fournisseur extends personne{
    //put your code here
         private $id;
         private $localisation;
         private $telecopie;
         
         
         
         function getId() {
             return $this->id;
         }

         function setId($id) {
             $this->id = $id;
         }

                  
         function getLocalisation() {
             return $this->localisation;
         }

         function getTelecopie() {
             return $this->telecopie;
         }

         function setLocalisation($localisation) {
             $this->localisation = $localisation;
         }

         function setTelecopie($telecopie) {
             $this->telecopie = $telecopie;
         }


}
