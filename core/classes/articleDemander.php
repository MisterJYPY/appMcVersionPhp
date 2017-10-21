<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of articleDemander
 *
 * @author Mr_JYPY
 */
class articleDemander {
    //put your code here
    
      private $id;
      private $article;
      private $quantiter;
      private $demandeAchat;
      
      function __construct(articles $article, $quantiter,  demande $demandeAchat) {
          $this->article = $article;
          $this->quantiter = $quantiter;
          $this->demandeAchat = $demandeAchat;
      }

      
      function getId() {
          return $this->id;
      }

      function getArticle() {
          return $this->article;
      }

      function getQuantiter() {
          return $this->quantiter;
      }

      function getDemandeAchat() {
          return $this->demandeAchat;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setArticle(articles $article) {
          $this->article = $article;
      }

      function setQuantiter($quantiter) {
          $this->quantiter = $quantiter;
      }

      function setDemandeAchat(demande $demandeAchat) {
          $this->demandeAchat = $demandeAchat;
      }


}
