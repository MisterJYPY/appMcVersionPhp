<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personnel
 *
 * @author Mr_JYPY
 */
class personnel extends personne{
    //put your code here
       private $id;
       private $code;
       private $fonction;
       private $service;
       
       
       function getId() {
           return $this->id;
       }

       function setId($id) {
           $this->id = $id;
       }

              function getCode() {
           return $this->code;
       }
       
       function getFonction() {
           return $this->fonction;
       }

       function getService() {
           return $this->service;
       }

       function setCode($code) {
           $this->code = $code;
       }

       function setFonction($fonction) {
           $this->fonction = $fonction;
       }

       function setService(service $service) {
           $this->service = $service;
       }
}
