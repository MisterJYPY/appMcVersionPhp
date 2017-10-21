<?php

class Tableau{
    private $entetes = array();
    private $colonnes = array();
    private $titre ;
    private $contenuBody;
    private $contenuHead;
    public $leTableau;


    public function __construct($requete, $titre = "", $entetes = array(), $colonnes = array()){
        
        global $db;
        $this->titre = $titre;
        $this->entetes = $entetes;
        $this->colonnes = $colonnes;
        $listeItem = $db->selectInTab($requete);
        $this->fabriquerContenu($listeItem);
        $this->leTableau = $this->genererTableau($this->contenuBody, $this->contenuHead, $this->titre);
        
    }
    
    private function fabriquerContenu($listeItem) {
        
        $i = 1;
		foreach($listeItem as $row):
                    if ($i == 1) :
                        $enteteTableau = array_keys($row);
                        unset($enteteTableau[array_search ( "id" , $enteteTableau )]);
                        unset($enteteTableau[array_search ( "derniere_modif" , $enteteTableau )]);
                        if (count($this->colonnes)) :
                            $enteteTableau = $this->colonnes;
                        endif;
                    endif;
                    
                    $this->contenuBody .= "<tr class=\"odd gradeX\"> 
						<td>$i</td>";
                    foreach ($enteteTableau as $v):
                        $this->contenuBody .= "
						<td>$row[$v]</td>
                                                    
			  ";
                    endforeach;
                    
			$this->contenuBody .= "		<td><a href=\"?id=$row[id]\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-pencil\"></span></td> 
<td><a href=\"listeEnseignant.php?id=$row[id]\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-pencil\"></span></td>
				  </tr>
                               "
                                ;
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
    
    public function genererTableau($contenuTableau, $enteteTableau, $titreTableau){
        
         return <<<TAB
            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">$titreTableau</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           $titreTableau
                        </div>
                        <div class="panel-body table-responsive">
                            <div class="dataTable_wrapper ">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
TAB;
        
    }
    
}
