<?php
        header('Content-type:text');
        include_once '../core/config.php';
        include_once '../core/classes/modelPersonnel.php';
           $idService=$_SESSION['idPersonnel'];
        echo genererListeDeroulante2("personnel","nom","prenom",$idService);
        
        
  
                          