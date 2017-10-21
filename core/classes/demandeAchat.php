<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of demandeAchat
 *
 * @author Mr_JYPY
 */
class demandeAchat extends demande{
    //put your code here
    
            private $id;
            private $bordereaux;
            private $validité;
            
            
            function getId() {
                return $this->id;
            }

            function getBordereaux() {
                return $this->bordereaux;
            }

            function getValidité() {
                return $this->validité;
            }

            function setId($id) {
                $this->id = $id;
            }

            function setBordereaux($bordereaux) {
                $this->bordereaux = $bordereaux;
            }

            function setValidité($validité) {
                $this->validité = $validité;
            }


}
