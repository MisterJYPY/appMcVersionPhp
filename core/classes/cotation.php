<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cotation
 *
 * @author Mr_JYPY
 */
class cotation {
    //put your code here
        private $id;
        private $code;
        private $date_envoi;
        private $delai_de_reponse;
        private $demandeAchat;
        private $fournisseur;
        private $expediteur;
        
        function __construct($code,  fournisseur $fournisseur,  personnel $expediteur,demandeAchat $demandeAchat) {
            $this->code = $code;
            $this->fournisseur = $fournisseur;
            $this->expediteur = $expediteur;
            $this->demandeAchat= $demandeAchat;
        }

        function getId() {
            return $this->id;
        }

        function setId($id) {
            $this->id = $id;
        }

                function getCode() {
            return $this->code;
        }

        function getDate_envoi() {
            return $this->date_envoi;
        }

        function getDelai_de_reponse() {
            return $this->delai_de_reponse;
        }

        function getDemandeAchat() {
            return $this->demandeAchat;
        }

        function getFournisseur() {
            return $this->fournisseur;
        }

        function getExpediteur() {
            return $this->expediteur;
        }

        function setCode($code) {
            $this->code = $code;
        }

        function setDate_envoi($date_envoi) {
            $this->date_envoi = $date_envoi;
        }

        function setDelai_de_reponse($delai_de_reponse) {
            $this->delai_de_reponse = $delai_de_reponse;
        }

        function setDemandeAchat(demandeAchat $demandeAchat) {
            $this->demandeAchat = $demandeAchat;
        }

        function setFournisseur(fournisseur $fournisseur) {
            $this->fournisseur = $fournisseur;
        }

        function setExpediteur(personnel $expediteur) {
            $this->expediteur = $expediteur;
        }


    
}
