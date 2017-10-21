<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of famille
 *
 * @author Mr_JYPY
 */
class famille {
    //put your code here
      private $id;
      private $designation;
      private $code;
      
      
      function __construct($designation) {
          $this->designation = $designation;
      }
      function getCode() {
          return $this->code;
      }

      function setCode($code) {
          $this->code = $code;
      }

      
      function getId() {
          return $this->id;
      }

      function getDesignation() {
          return $this->designation;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setDesignation($designation) {
          $this->designation = $designation;
      }


}
