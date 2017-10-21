<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personne
 *
 * @author Mr_JYPY
 */
class personne {
    //put your code here
    
     private $nom;
     private $prenoms;
     private $adresse;
     private $mail;
     private $contacts;
     

     function getNom() {
         return $this->nom;
     }

     function getPrenoms() {
         return $this->prenoms;
     }

     function getAdresse() {
         return $this->adresse;
     }

     function setNom($nom) {
         $this->nom = $nom;
     }

     function setPrenoms($prenoms) {
         $this->prenoms = $prenoms;
     }

     function setAdresse($adresse) {
         $this->adresse = $adresse;
     }

     function getMail() {
         return $this->mail;
     }

     function getContacts() {
         return $this->contacts;
     }

     function setMail($mail) {
         $this->mail = $mail;
     }

     function setContacts($contacts) {
         $this->contacts = $contacts;
     }



}
