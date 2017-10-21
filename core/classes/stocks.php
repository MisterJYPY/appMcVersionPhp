<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stocks
 *
 * @author Mr_JYPY
 */
class stocks {
    //put your code here
      private $article;
      private $quantite;
      private $id;
      private $dernière_modif;
      
      function getArticle() {
          return $this->article;
      }

      function getQuantite() {
          return $this->quantite;
      }

      function getId() {
          return $this->id;
      }

      function getDernière_modif() {
          return $this->dernière_modif;
      }

      function setArticle(articles $article) {
          $this->article = $article;
      }

      function setQuantite($quantite) {
          $this->quantite = $quantite;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setDernière_modif($dernière_modif) {
          $this->dernière_modif = $dernière_modif;
      }


    
      
    
}
