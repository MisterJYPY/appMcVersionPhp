<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of suivi_validation
 *cette classe permet ici de verifier si une personne valide une demande une instance lie a la personne suivante 
 * est cree et mettra la variable est_signee à NON et restera telle tant que la validation n'as pas encore
 * ete effectuer.Dans ce cas la variable sera a oui et une instance de la personne suivante sera cree avec un "NON"
 * @author Mr_JYPY
 */
class suivi_validation {
    //put your code here
    
      private $id;
      private $demandeAchat=0;
      private $signataire=null;
      private $date_envoi=null;
      private $estSigne;
      private $derniere_modif=null;
      
      function __construct(demande $demandeAchat,  personne $signataire) {
          $this->demandeAchat = $demandeAchat;
          $this->signataire = $signataire;
      }

      
      function getId() {
          return $this->id;
      }

      function getDemandeAchat() {
          return $this->demandeAchat;
      }

      function getSignataire() {
          return $this->signataire;
      }

      function getDate_envoi() {
          return $this->date_envoi;
      }

      function getDerniere_modif() {
          return $this->derniere_modif;
      }

      function setId($id) {
          $this->id = $id;
      }
      function getEstSigne() {
          return $this->estSigne;
      }

      function setEstSigne($estSigne) {
          $this->estSigne = $estSigne;
      }

            function setDemandeAchat(demande $demandeAchat) {
          $this->demandeAchat = $demandeAchat;
      }

      function setSignataire(personne $signataire) {
          $this->signataire = $signataire;
      }

      function setDate_envoi($date_envoi) {
          $this->date_envoi = $date_envoi;
      }

      function setDerniere_modif($derniere_modif) {
          $this->derniere_modif = $derniere_modif;
      }


}
