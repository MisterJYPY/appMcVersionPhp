<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of signataireApprober
 *cette classe represente une validation de la fiche de demande dachat
 *A chaque fois qu'une personne valide il y a un instance de cette classe qui devra etre creer
 * cette classe est en complicité directe avec les classes : suivi_validation
 * @author Mr_JYPY
 */
class signataireApprober {
    //put your code here
      private $id;
      private $signataire;
      private $demandeAchat;
      private $heureSignature;
      
      function __construct(personne $signataire, demande $demandeAchat) {
          $this->signataire = $signataire;
          $this->demandeAchat = $demandeAchat;
      }

      function getId() {
          return $this->id;
      }

      function getSignataire() {
          return $this->signataire;
      }

      function getDemandeAchat() {
          return $this->demandeAchat;
      }

      function getHeureSignature() {
          return $this->heureSignature;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setSignataire(personne $signataire) {
          $this->signataire = $signataire;
      }

      function setDemandeAchat(demande $demandeAchat) {
          $this->demandeAchat = $demandeAchat;
      }

      function setHeureSignature($heureSignature) {
          $this->heureSignature = $heureSignature;
      }      
}
