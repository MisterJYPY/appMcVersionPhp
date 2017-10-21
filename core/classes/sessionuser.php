<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of deconnexion
 *
 * @author Mr_JYPY
 */
class sessionUser {
    //put your code here
    private $var=0;
    
    static function stop($pageRedirectins){
      
	// On détruit les variables de notre session
	session_unset ();

	// On détruit notre session
	 session_destroy ();
         header("location:$pageRedirectins");
    //return session_status()===PHP_SESSION_DISABLED ? TRUE : FALSE ;
	// On redirige le visiteur vers la page d'accueil
	//header ('location: login.php'); 
    }
    static function start($login,$password,$service="",$idpersonnel=""){
         echo 'NOUS Y SOMMES';
          if(!isset($_SESSION)):
		session_start();
	   endif;
         $_SESSION['login']=$login;
         $_SESSION['password']=$password;
         $_SESSION['idService']=$service;
         $_SESSION['idPersonnel']=$idpersonnel;
           
         return session_status()===PHP_SESSION_ACTIVE ? TRUE : FALSE ;
        
    }
     static function verification($table,$champ1="",$champ2="",$pageRedirectin=""){
           if(!isset($_SESSION)):
		session_start();
	   endif;
         if(isset($_SESSION['login']) and isset($_SESSION['password'])){
 $nom=$_SESSION['login'];
 $mdp=$_SESSION['password'];
 $login="";
 $pass="";
//$cp=md5($mdp)
    global $db;
   $bdd=$db->prepare("SELECT * FROM $table WHERE $champ1=? AND $champ2=?");
	$bdd->execute(array($nom,$mdp));
     while($resultat=$bdd->fetch()):
         $login=$resultat[$champ1];
         $pass=$resultat[$champ2];
     endwhile;
	if($_SESSION['login']!=$login or $_SESSION['password']!=$pass)
			{ 
                      sessionUser::stop($pageRedirectin);
	               	}
                    else{
                        
                        }
			}
			else{
		header("location:$pageRedirectin"); 
			}
     }
}
