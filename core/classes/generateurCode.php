<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generateurCode
 *
 * @author Mr_JYPY
 */
class generateurCode {
    //put your code here
    
      public static function DonnerInformationAvecId($sql,$id,$champ){
           global $db;
      //  $sql="SELECT libelle_type_clt_mag as libelle FROM type_client_magasin where id_type_clt_mag =:id";
         $element=$db->selectInTab($sql);
        //  var_dump($element);
       $ligne=null;
       if(!is_null($element)):
        foreach($element as $ligne)  :
           $libelle=$ligne[$champ];
        endforeach;  
       endif;
       return $libelle;    
   }
    
    static function getCodeDemandeAchat($idservice){
          global $db;
          $code="Aucun";
           if($idservice!="rien"){
            //recuperationDeL'abreviation
            $request="SELECT abreviation FROM services WHERE id =$idservice";
            $mot1=self::DonnerInformationAvecId($request,$idservice,'abreviation');
     do{
       
        $ligne=0;
        $mot2=mt_rand(1,999);
        $date=date('md');
        $position="P";
        $reponse=$db->selectInTab("SELECT COUNT(service) as nombre FROM demandeachat where service=$idservice");
        
         // foreach($reponse as $lignes){
                $lignes=$reponse[0]['nombre'];
        //  }
          $lignes++;
      $code=$mot1.$mot2.$date.$position.$lignes;
      $selection=$db->selectInTab("SELECT * FROM demandeachat Where bordereaux=code");
      foreach ($selection as $ligne2){
              $ligne++;
          }
      }    
     while( $ligne>0);
           }
     return $code;
        
    }
     static function getCodeCotation($idservice){
          global $db;
          $code="Aucun";
           if($idservice!="rien"){
            //recuperationDeL'abreviation
            $request="SELECT abreviation FROM services WHERE id =$idservice";
            $mot1=self::DonnerInformationAvecId($request,$idservice,'abreviation');
     do{
       
        $ligne=0;
        $mot2=mt_rand(1,999);
        $date=date('md');
        $position="P";
        $reponse=$db->selectInTab("SELECT COUNT(service) as nombre FROM demandeachat where service=$idservice");
        
         // foreach($reponse as $lignes){
                $lignes=$reponse[0]['nombre'];
        //  }
          $lignes++;
      $code="Cot".$mot1.$mot2.$date.$position.$lignes;
      $selection=$db->selectInTab("SELECT * FROM demandeachat Where bordereaux=code");
      foreach ($selection as $ligne2){
              $ligne++;
          }
      }    
     while( $ligne>0);
           }
     return $code;
        
    }
    static function getCodeArticle($idF){
 
      global $db;
      $code='';
      // $sql="SELECT abreviation as abrg FROM famille WHERE";
            //recuperationDeL'abreviation
        $request="SELECT abreviation as abrg FROM famille WHERE id=$idF";
        $reponse=$db->selectInTab($request);
        $mot1=$reponse[0]['abrg'];
     do{
        $ligne=0;
        $mot2=mt_rand(1,999);
        $position="A";
        $reponse=$db->selectInTab("SELECT COUNT(designation) as nombre FROM articles where famille=$idF");
         // foreach($reponse as $lignes){
                $lignes=$reponse[0]['nombre'];
        //  }
          $lignes++;
      $code=$mot1.$mot2.$position.$lignes."Mc";
      $selection=$db->selectInTab("SELECT * FROM articles Where code=$code");
      foreach ($selection as $ligne2){
              $ligne++;
          }
      }    
     while( $ligne>0);
         return $code;
         
   
        
    }
     static function getCodeFamille($idF){
 
      global $db;
      $code='';
      // $sql="SELECT abreviation as abrg FROM famille WHERE";
            //recuperationDeL'abreviation
        $request="SELECT abreviation as abrg FROM famille WHERE id=$idF";
        $reponse=$db->selectInTab($request);
        $mot1=strtoupper($reponse[0]['abrg']);
     do{
        $ligne=0;
        $mot2=mt_rand(1,999);
      $code=$mot1.$mot2."Mc";
      $selection=$db->selectInTab("SELECT * FROM famille Where code=$code");
      foreach ($selection as $ligne2){
              $ligne++;
          }
      }    
     while( $ligne>0);
         return $code;
         
   
        
    }
    static function getCodeCommandeClientCommercial(){
          
    }
    static function getCodeDemande()
    {
        $code="";
     do{
        $ligne=0;
        $mot1=  mt_rand(1, 400)+  mt_rand(0, 90);
        $date=date('Ymd');
        $bdd=connectionPDO::getInstance();
          //Nom entrepot
        $repNomm=$bdd->query("SELECT COUNT(code) as nbre FROM demandeAchat ");
          while($reps=$repNomm->fetch()){
              $lignes=$reps['nbre'];
          }
          $lignes++;
          //icoi
      $code=$mot1.$date.$lignes;
      $selection=$bdd->prepare("SELECT * FROM commercial  WHERE code_commercial= ?");
       $selection->execute(array($code));
          while($rep=$selection->fetch()){
              $ligne++;
          }
      }    
     while( $ligne>0);
     
     return $code;   
        
    }
     static function genererCodeSession()
    
       {
          global $db;
          $code=567;
     do{
        $ligne=0;
        $code=  mt_rand(1, 1001009777788);
     $ligne=$db->nbrows('etatconnection'," WHERE code_session=$code");
      }    
     while( $ligne>0);
     
     return $code;
         
      }
    static function getCodeCommandeCommercial(){
                $code="";
     do{
        $ligne=0;
        $mot1=  mt_rand(1, 400);
        $date=date('Ymd');
        $bdd=connectionPDO::getInstance();
          //Nom entrepot
        $repNomm=$bdd->query("SELECT COUNT(code_commande_cial) as nbre FROM commande_cial ");
          while($reps=$repNomm->fetch()){
              $lignes=$reps['nbre'];
          }
          $lignes++;
          //icoi
      $code=$mot1.$date.$lignes;
      $selection=$bdd->execute("SELECT * FROM commande_cial");
          while($rep=$selection->fetch()){
              $ligne++;
          }
      }    
     while( $ligne>0);
     
     return $code;
         
    }
    static function getCodeLivraisonCommercial(){
                   
    }
    static function getCodeLivraisonClientCommercial(){
              $code="";
     do{
        $ligne=0;
        $mot1=  mt_rand(1, 400)+  mt_rand(0, 90);
        $date=date('Ymd');
        $bdd=connectionPDO::getInstance();
          //Nom entrepot
        $repNomm=$bdd->query("SELECT COUNT(code_livraison) as nbre FROM livraison_clt_ccial ");
          while($reps=$repNomm->fetch()){
              $lignes=$reps['nbre'];
          }
          $lignes++;
          //icoi
      $code=$mot1.$date.$lignes;
      $selection=$bdd->prepare("SELECT * FROM livraison_clt_ccial where code_livraison=?");
       $selection->execute(array($code));
         while($rep=$selection->fetch()){
              $ligne++;
          }
      }    
     while( $ligne>0);
     
     return $code;
    }
    static function getCodeLivraisonClientMagasin(){
               $code="";
     do{
        $ligne=0;
        $mot1=  mt_rand(1, 400)+  mt_rand(0, 100);
        $date=date('Ymd');
        $bdd=connectionPDO::getInstance();
          //Nom entrepot
        $repNomm=$bdd->query("SELECT COUNT(code_livraison) as nbre FROM livraison_client_magasin ");
          while($reps=$repNomm->fetch()){
              $lignes=$reps['nbre'];
          }
          $lignes++;
          //icoi
      $code=$mot1.$date.$lignes;
      $selection=$bdd->prepare("SELECT * FROM livraison_client_magasin WHERE code_livraison=?");
       $selection->execute(array($code));
          while($rep=$selection->fetch()){
              $ligne++;
          }
      }    
     while( $ligne>0);
     
     return $code;
    }
    static function getCodeVersementClientMagasin(){
             $code="";
     do{
        $ligne=0;
        $mot1=  mt_rand(1, 400)+  mt_rand(0, 500);
        $date=date('Ymd');
        $bdd=connectionPDO::getInstance();
          //Nom entrepot
        $repNomm=$bdd->query("SELECT COUNT(code_vers_clt_mag) as nbre FROM versement_client_magasin ");
          while($reps=$repNomm->fetch()){
              $lignes=$reps['nbre'];
          }
          $lignes++;
          //icoi
      $code=$mot1.$date.$lignes;
      $selection=$bdd->prepare("SELECT * FROM versement_client_magasin WHERE code_vers_clt_mag=?");
       $selection->execute(array($code));
          while($rep=$selection->fetch()){
              $ligne++;
          }
      }    
     while( $ligne>0);
     
     return $code;
    }
    static function getCodeVersementClientCommercial(){
               $code="";
     do{
        $ligne=0;
        $mot1=  mt_rand(1, 400)+  mt_rand(0, 200);
        $date=date('Ymd');
        $bdd=connectionPDO::getInstance();
          //Nom entrepot
        $repNomm=$bdd->query("SELECT COUNT(code_vers_clt_ccial) as nbre FROM versement_clt_ccial ");
          while($reps=$repNomm->fetch()){
              $lignes=$reps['nbre'];
          }
          $lignes++;
          //icoi
      $code=$mot1.$date.$lignes;
      $selection=$bdd->prepare("SELECT * FROM versement_clt_ccial WHERE code_vers_clt_ccial=?  ");
        $selection->execute(array($code));
          while($rep=$selection->fetch()){
              $ligne++;
          }
      }    
     while( $ligne>0);
     
     return $code; 
    }
}
