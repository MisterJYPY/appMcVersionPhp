<?php

class Tableau{
    private $entetes = array();
    private $colonnes = array();
    private $titre ;
    private $contenuBody;
    private $contenuHead;
    public $leTableau;
    public $class;
    public $id;
    

    public function __construct($requete,$class="",$id, $titre = "", $entetes = array(), $colonnes = array(),$idBalise=""){
        
        global $db;
        $this->titre = $titre;
        $this->entetes = $entetes;
        $this->colonnes = $colonnes;
        $this->class=$class;
       // $this->id=$id;
       // echo $requete;
        $listeItem = $db->selectInTab($requete);
       // var_dump($listeItem);
        $this->fabriquerContenu($listeItem);
          if(empty($idBalise)){
        $this->leTableau = $this->genererTableau($this->contenuBody,$this->class,$id,$this->contenuHead, $this->titre);
          }
          else{
    $this->leTableau = $this->genererTableaux($this->contenuBody,$this->class,$id,$this->contenuHead, $this->titre,$idBalise);           
          }
    }
    
    private function fabriquerContenu($listeItem) {
      //  var_dump($listeItem);
        $i = 1;
		foreach($listeItem as $row):
                    if ($i == 1) :
                        $enteteTableau = array_keys($row);
                     //   var_dump($enteteTableau);
                        unset($enteteTableau[array_search ( "id" , $enteteTableau )]);
                         unset($enteteTableau[array_search ( "derniere_modif" , $enteteTableau )]);
                       //   var_dump($enteteTableau);
                        if (count($this->colonnes)) :
                            $enteteTableau = $this->colonnes;
                          //var_dump($this->colonne);
                        endif;
                    endif;
                  
                    
                    $this->contenuBody .= "<tr class=\"odd gradeX\"> 
						<td>$i</td>";
                    foreach ($enteteTableau as $v):
                           
                        $this->contenuBody .= "
						<td>$row[$v]</td>
                                                    
			  ";
                    endforeach;

                          
if($this->titre=="Liste des Enseignants"):

                    
			$this->contenuBody .= "		<td><a href=\"?id=$row[id]\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-pencil\"></span></td> 
<td><a href=\"listeEnseignant.php?id=$row[id]\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-education\"></span></td>
				  </tr>
                               "
                                ;

else:

$this->contenuBody .= "		<td><a href=\"?id=$row[id]\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-pencil\"></span></td>  
				</tr>
                               "
                                ;

endif;
                    
			
			$i++;
		endforeach;
                
                $this->contenuHead = "";
                
                foreach ($enteteTableau as $v):
                    $label = array_key_exists($v, $this->entetes)? $this->entetes[$v] : $v;
                        $this->contenuHead .= "
						<th>$label</th>
                                                    
			  ";
                 endforeach;
        
    }
    
    public function genererTableau($contenuTableau,$class,$id, $enteteTableau, $titreTableau){  
         return <<<TAB
             
                 $id
            <div class="row">
                <div class="$class">
                    <h1 class="page-header">$titreTableau</h1>
                </div>
            </div>
            <div class="row">
                <div class="$class">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           $titreTableau
                        </div>
                        <div class="panel-body table-responsive">
                            <div class="dataTable_wrapper ">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            $enteteTableau
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         $contenuTableau;
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                 </div>
TAB;
        
    }
    public function genererTableaux($contenuTableau,$class,$id, $enteteTableau, $titreTableau,$idBalise){  
         return <<<TAB
             
                 $id
            <div class="row">
                <div class="$class">
                    <h1 class="page-header">$titreTableau</h1>
                </div>
            </div>
            <div class="row">
                <div class="$class">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           $titreTableau
                        </div>
                        <div class="panel-body table-responsive">
                            <div class="dataTable_wrapper ">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="$idBalise">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            $enteteTableau
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         $contenuTableau;
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                 </div>
TAB;
        
    }
    
}
