 <?php
        header('Content-type:text');
        include_once '../core/config.php';
        include_once '../core/classes/modelPersonnel.php';
         $service=new service();
         $service->setId(1);
         $service->setDesignation("ACHAT ET PRODUCTION");
         $listePersonnel= modelPersonnel::listeDesEmployeDuService();
           if(count($listePersonnel)):
            for($p=0;$p<count($listePersonnel);$p++):
   ?>
  <option value="<?php echo ($listePersonnel[$p]->getNom().' '.$listePersonnel[$p]->getPrenoms().' '.$listePersonnel[$p]->getId()); ?>" > <?php echo html_entity_decode($listePersonnel[$p]->getNom().' '.$listePersonnel[$p]->getPrenoms()); ?> </option> 
       <?php endfor;
       endif; ?>