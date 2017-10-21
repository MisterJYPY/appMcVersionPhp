<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of demande
 *
 * @author Mr_JYPY
 */
class demande {
    //put your code here
    
            private $motif;
            private $objectif;
            private $justificatif;
            private $observation;
            private $date_demande;
            private $service;
            
            function getMotif() {
                return $this->motif;
            }

            function getObjectif() {
                return $this->objectif;
            }

            function getJustificatif() {
                return $this->justificatif;
            }

            function getObservation() {
                return $this->observation;
            }

            function getDate_demande() {
                return $this->date_demande;
            }

            function getService() {
                return $this->service;
            }

            function setMotif($motif) {
                $this->motif = $motif;
            }

            function setObjectif($objectif) {
                $this->objectif = $objectif;
            }

            function setJustificatif($justificatif) {
                $this->justificatif = $justificatif;
            }

            function setObservation($observation) {
                $this->observation = $observation;
            }

            function setDate_demande($date_demande) {
                $this->date_demande = $date_demande;
            }

            function setService(service $service) {
                $this->service = $service;
            }


}
