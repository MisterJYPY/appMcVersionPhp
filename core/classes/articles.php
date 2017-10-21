<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of articles
 *
 * @author Mr_JYPY
 */
class articles {
    //put your code here
    private $id;
    private $code;
    private $famille;
    private $desigantion;
    private $unite;
    
    function __construct(famille $famille, $desigantion) {
        $this->famille = $famille;
        $this->desigantion = $desigantion;
    }
    function getUnite() {
        return $this->unite;
    }

    function setUnite($unite) {
        $this->unite = $unite;
    }

        function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getFamille() {
        return $this->famille;
    }

    function getDesignation() {
        return $this->desigantion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setFamille($famille) {
        $this->famille = $famille;
    }

    function setDesigantion($desigantion) {
        $this->desigantion = $desigantion;
    }


   
}
