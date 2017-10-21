<?php
if(!isset($_SESSION)):
		session_start();
endif;
           function DonnerJour($id){
                                $jour="";
			   switch($id):
                                case 1:
                                   $jour="Lundi" ;
                                    break;
                                case 2:
                                   $jour="Mardi" ;
                                    break;
                                case 3:
                                   $jour="Mercredi" ;
                                    break;
                                case 4:
                                   $jour="Jeudi" ;
                                    break;
                                case 5:
                                   $jour="Vendredi" ;
                                    break;
                                case 6:
                                   $jour="Samedi" ;
                                    break;
                           endswitch;
			   return $jour;
			   
		   }
        function genererFichier($classes="",$enseignants="",$semestres="",$ues=""){
               if($classes==""){
                   $table=array();
                   $table[]='core/config.php'; 
                   $table[]="contenus/listeReservationRetrait.php"; 
                   return $table;
               }
             
             else{
                 $classe=$classes;
             $enseignant=$enseignants;
              $semestre=$semestres;
              $ue=$ues;
            $table=array();
              $table[]=$classe;
              $table[]=$enseignant;
              $table[]=$semestre;
              $table[]=$ues;
               $table[]='../core/config.php'; 
              $table[]="../contenus/listeReservationRetrait.php";
              return $table;
              }
               
        }
	 function genererListeDeroulanteRequete($requete, $champ ,$champ1=""){

		global $db;
		$resultat = "";
                           
                           $tableau = $db->selectInTab($requete);  
                               
             
		foreach ($tableau as $ligne) {
			$concat="";
                             if(!empty($champ1))
                                {
                             $concat.=$ligne[$champ]; 
                             $concat.=" ";
                             $concat.=$ligne[$champ1]; 
                                }
                              else{
                                    $concat=$ligne[$champ];
                                }
			$resultat .= "<option value=\"$ligne[id]\">$concat</option>
			";

		}
                return $resultat;
	}
        function genererListeDeroulante($table, $champ ,$element=""){

		global $db;
		$resultat = "";
                              if($table=='services' and empty($element)){
                             $id=$_SESSION['idService'];
                  $tableau = $db->selectInTab("SELECT id, $champ FROM $table WHERE services.id=$id ");
                    }
                               else {
                           $tableau = $db->selectInTab("SELECT id, $champ FROM $table ");  
                               }
             
		foreach ($tableau as $ligne) {
			  
			$resultat .= "<option value=\"$ligne[id]\">$ligne[$champ]</option>
			";

		}
                return $resultat;
	}
         function genererListeDeroulante2($table, $champ,$champ2,$ids ){

		global $db;
                       $sql="SELECT * FROM $table WHERE id=$ids";         
		$resultat = " <option value='rien'>.......................................................................</option>";
                
                    $tableau = $db->selectInTab($sql);
		
		
             
		foreach ($tableau as $ligne) {
			 // if($ligne['fonction']!='ASSISTANT' and $ligne['service']!=$idService){
	$resultat .= "<option value=\"$ligne[$champ] $ligne[$champ2] $ligne[id]\">$ligne[$champ] $ligne[$champ2]</option>
			";
                          //}
		}
                return $resultat;
	}
        function genererListeDeroulanteFournisseur($table, $champ,$cotation ){

		global $db;
                       $sql="SELECT * FROM $table WHERE id NOT IN (SELECT fournisseur FROM "
                               . " fournisseursurcotation WHERE cotation=$cotation)";         
		$resultat = " <option value='-1_saisissez_saisissez_saisissez_saisissez'></option>";
                
                    $tableau = $db->selectInTab($sql);
		
		
             
		foreach ($tableau as $ligne) {
			 // if($ligne['fonction']!='ASSISTANT' and $ligne['service']!=$idService){
 $resultat .= "<option value=\"$ligne[id]_$ligne[mail]_$ligne[telecopie]_$ligne[$champ]_$ligne[contacts]\">$ligne[$champ]</option>
			";
                          //}
		}
                return $resultat;
	}
       
       function genererListeDeroulanteCours($table, $champ ){
                $tableau = $db->selectInTab("SELECT * from $table where semestre=$_SESSION[$semestre] and classe=$_SESSION[$classe]");
              
                foreach ($tableau as $ligne) {
			  
			$resultat .= "<option value=\"$ligne[id]\">$ligne[$champ]</option>
			";

		} 
            } 
            function generelisteDeroulanteMateriel($champ,$table,$champIndexe1,$idIndexe1,$champIndexe2="",$idIndexe2=""){
                  global $db;
                  global $compteurDeDiv;
                 $resultat="";
                    if($champIndexe2="" and $idIndexe2=""){
                   $tableau = $db->selectInTab("SELECT id, $champ FROM $table WHERE $champIndexe1 =$idType");
                     //var_dump($tableau);
                          }
                 else{
                   $sql="SELECT id, $champ FROM $table WHERE $champIndexe1=$idIndexe1 and fonctionnel=\"$idIndexe2\"";
                    //var_dump($sql);
                $tableau = $db->selectInTab($sql);        
                 //  var_dump($tableau);
                }
		foreach ($tableau as $ligne) {
                                //echo $compteurDeDiv;
			$resultat .= "<option value=\"$ligne[id]\" id=\"option$compteurDeDiv\">$ligne[$champ]</option>
			";
		}
                return $resultat;
             }
        function getClasse($id, $in = "IN" ){
            global $db;

            $in = in_array($in, array("IN", "NOT IN"))? $in : "IN";
            $requete = "SELECT * FROM classe WHERE id $in (SELECT classe FROM enseignant_classe WHERE enseignant = $id)";
            return $db->selectInTab($requete);   
        }
  
        function genererListeClasse($data, $ide, $sens ){
            
            $text="<ul>";
            foreach ($data as $row ):
              $lien = "<a href=\"#\" ondblclick=\"sendData('ide=$ide&idc=$row[id]&sens=$sens','ajax/enseignantClasse.php','sesClasses');sendData('ide=$ide&idc=$row[id]&sens=$sens','ajax/enseignantClasseBis.php','nonClasses')\" > $row[libelle_classe] </a>";

                $text .= "<li> $lien </li>";
            endforeach;
            
            $text .= "</ul>";
            
            return $text;
        }

	function genererReservationTimes($jour, $i)
		{	
			return  <<<TET
<div class="form-group col-xs-2">
                            $jour <input type="checkbox" value="$i" name="jours[]" onclick="sendData('jour=$i&valeur='+this.checked,'ajax/reservationTimeTable.php','jour-$i')">
                            <div id="jour-$i">
                            </div>
                      </div>
TET;

		}
                /**
                 * function qui retourne le Mois en cour ou le jour sous format String
                 * le parametre a passer est soit "jour" ou "mois" ou "annee" en fonction de notre besoin
                 * methode derivante du Projet M1GI de web avancé ecrite par Fofana Bintou et mise sous forme de
                 * fonction par Mister_JYPY
                 * @param type $voulu la specification
                 * @return type une chaine de caractere qui est soit le mois ou l'annee ou le jour
                 */
                function retournerJourOuMoisOuAnneeActuel($voulu)
                {
                  //date du jour 
$date=date("d/m/y");

$joursem=array('dim','lun','mar','mer','jeu','ven','sam');
// extraction des jours , mois , annee
list($jour,$mois,$annee)= explode('/',$date);
//cacul du timestamp
$timestamp=  mktime(0,0,0,$mois,$jour,$annee);

//selon le serveur c'est fr ou fr_FR ou fr_FR.ISO8859-1 qui est correct
setlocale(LC_TIME,'fr','fr_FR', 'fr_FR.ISO8859-1');

//voici les 2 tableaux des jours et des mois traduits en francais 
$nom_jour_fr=array("dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");

$mois_fr=array("","Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
// on extrait la date du jour 


list($nom_jour,$jour,$mois,$annee)=  explode('/',  date("w/d/n/Y"));
      if($voulu=="jour"){
$valeur=$nom_jour_fr[$nom_jour];
      }
      if($voulu=="mois"){
      $valeur= $mois_fr[$mois];  
      }
      if($voulu=="annee"){
          $valeur=$annee;
      }
       if($voulu=="jchiffre"){
          $valeur=$jour;
      }
      return $valeur;
                }
                
                
                /***********************************************mccroft*******************************************/
                
                function verificationDeconnexion()
                {
                
                           
                }
                 
                                
?>



   
