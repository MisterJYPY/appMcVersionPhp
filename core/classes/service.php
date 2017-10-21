<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of service
 *
 * @author Mr_JYPY
 */
class service {
    //put your code here
    
    private $id;
    private $designation;
    private $abreviaton;
    
    function getAbreviaton() {
        return $this->abreviaton;
    }

    function setAbreviaton($abreviaton) {
        $this->abreviaton = $abreviaton;
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
