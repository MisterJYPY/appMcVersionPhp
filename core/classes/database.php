<?php
/**
 * 
 */
class Database extends PDO {

    private $db = BDBD;   // base de donn�es
    private $host = BDHOST;  // adresse de la base
    private $user = BDUSER;   // nom
    private $pwd = BDPASS;     // mot de passe
    private $con;     // 
    private $errlogfile = 'errlog.inc';
    private $operator ;
    public function __construct() {
        try {
            $this->con = parent::__construct($this->getDns(), $this->user, $this->pwd);
            // pour mysql on active le cache de requete
            if ($this->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql'):
                $this->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);                
            endif;
            return $this->con;
        } catch (PDOException $e) {
            //On indique par email qu'on n'a plus de connection disponible
            error_log(date('D/m/y') . ' ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $message = new Message();
            $message->outPut('Erreur 500', 'Serveur de BDD indisponible, nous nous excusons de la g&egrave;ne occasionn&eacute;e');
        }
    }

    public function nbrows($table, $cond = '') {
        try {
            $this->con = parent::beginTransaction();
            $sql = "SELECT COUNT(*) as nbRow FROM " . $table . $cond;
            $result = parent::prepare($sql);
            $result->execute();
            $nbRow = (int) $result->fetch(PDO::FETCH_OBJ)->nbRow;
            $this->con = parent::commit();
            $this->setOperator($sql) ;
            //echo $sql ;
            // ou
            // $this->con = parent::rollBack();
            return $nbRow;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�');
        }
    }

    public function select($reqSelect) {
        try {
            $this->con = parent::beginTransaction();
            //$result= parent::query($reqSelect);
            $result = parent::prepare($reqSelect);
            $result->execute();
            $this->con = parent::commit();
            $this->setOperator($reqSelect) ;
            // ou
            // $this->con = parent::rollBack();
            return $result;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            //var_dump($reqSelect) ;
            $message = new Message();
            $message->outPut('Erreur dans la requ&ecirc;tte', 'Votre requ&ecirc;te a &eacute;t&eacute; abandonn&eacute;e');
        }
    }

    /**
     * @insert = Cette fonction permet d'inserrer des données dans la base.
     * @table ==> la table concernée par les données
     * 			Par exemple ici:
     * 			$table = 'user' ;
     * @data ==> Tableau de données inserrer dans la table dont les clés sont
     * 			les colonnes de la table à mettre à jour.
     * 			Par exemple:
     * 			$data = array('firstname'=>'ZEZE', 'lastname'=>'Sylvain', 'email'=>'zds@notreafrique.net') ;
     * 			dans ce cas, (firstname, lastname, email) sont les champs de la table à mettre à jour
     * @Action: insert($table, $data) exécutera la requète
     * 			$sql = "INSERT INTO user  (firstname, lastname, email) VALUES('ZEZE', 'Sylvain', 'zds@notreafrique.net')";
     * @ret ==> correspond au retour de la requète.
     * 		true si la requète s'est exécutée correctement
     */
    public function insert($table, $data) {
        $sql = "INSERT INTO " . $table . " (";
        $listfield = '';
        $listvalue = ' VALUES(';
        $virg = '';
        $champ = $this->getListeChamp($table);
        foreach ($data as $key => $value) :
            if (in_array($key, $champ)) :
                $listfield .= $virg . $key;
                $listvalue .= is_numeric($value) ? $virg . $value : $virg . "'" . $value . "'";
                $virg = ', ';
            endif;
        endforeach;
        $listfield .= ')';
        $listvalue .= ')';
        $sql .=$listfield . $listvalue;
        try {
            $this->con = parent::beginTransaction();
            $stmt = parent::prepare($sql);
            $ret = $stmt->execute();
            $this->con = parent::commit();
            $this->setOperator($sql) ;
            return $ret;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />' . $sql . '<br /><br />');
        }
    }

    /**
     * @insert = Cette fonction permet d'inserrer des donn�es dans la base.
     * @table ==> la table concern�e par les donn�es
     * 			Par exemple ici:
     * 			$table = 'user' ;
     * @data ==> Tableau de donn�es inserrer dans la table dont les cl�s sont
     * 			les colonnes de la table � mettre � jour.
     * 			Par exemple:
     * 			$data = array('firstname'=>'ZEZE', 'lastname'=>'Sylvain', 'email'=>'zds@notreafrique.net') ;
     * 			dans ce cas, (firstname, lastname, email) sont les champs de la table � mettre � jour
     * @Action: insert($table, $data) ex�cutera la requ�te
     * 			$sql = "INSERT INTO user  (firstname, lastname, email) VALUES('ZEZE', 'Sylvain', 'zds@notreafrique.net')";
     * @ret ==> correspond au retour de la requ�te.
     * 		true si la requ�te s'est ex�cut�e correctement
     */
    public function insertdata($table, $data) { //tableau de tableau
        $sql = "INSERT INTO " . $table;
        $listvalue = '';
        $virg = '';
        $champ = $this->getListeChamp($table);
        $ind = 0;
        $listfield = ' (';
        foreach ($data as $rows) :
            $ind++;
            $listvalue .= $virg . '(';
            $virg = '';
            foreach ($rows as $key => $value) :
                if (in_array($key, $champ)) :
                    if ($ind == 1) :
                        $listfield .= $virg . $key;
                    endif; //
                    $val = !get_magic_quotes_gpc() ? addslashes($value) : $value;
                    //$val = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;
                    $listvalue .= is_numeric($value) ? $virg . $value : $virg . "'" . $val . "'";
                    $virg = ', ';
                endif;
            endforeach; // foreach($rows as $key => $value) :
            $listvalue .= ')';
        endforeach; //foreach($data as $rows) :
        $listfield .= ')  VALUES ';
        $sql .=$listfield . $listvalue;
       //echo "<pre>$sql </pre>" ;
        try {
            $this->con = parent::beginTransaction();
            $stmt = parent::prepare($sql);
            $ret = $stmt->execute();
            $this->con = parent::commit();
            //$this->setOperator($sql) ;
            // ou
            // $this->con = parent::rollBack();
            return $ret;
        } catch (Exception $e){
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            //echo 'Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />'.$sql.'<br /><br />' ;
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />' . $sql . '<br /><br />');
        }
    }

    /**
     * 	@update = Cette fonction permet la mise � jour de donn�es
     * 	@table ==> la table � mettre � jour
     * 				Par exemple ici:
     * 				$table = 'user' ;
     * 	@data ==> les donn�es � mettre � jour sous forme de table dont les cl�s sont
     * 				les colonnes de la table � mettre � jour.
     * 				Par exemple:
     * 				$data = array('firstname'=>'ZEZE', 'lastname'=>'Sylvain', 'email'=>'zds@notreafrique.net') ;
     * 				dans ce cas, (firstname, lastname, email) sont les champs de la table � mettre � jour
     * 	@cond ==> la condition dans la requ�te sql
     * 				Par exemple ici:
     * 	 			$cond = " WHERE id=2" ;
     * 	@Action: update($table, $data, $cond) ex�cutera la requ�te
     * 				$sql = "UPDATE user SET 
     * 						firstname='ZEZE',
     * 						lastname='Sylvain',
     * 						email='zds@notreafrique.net'
     * 						WHERE id=2
     * 				"
     * 	@ret ==> correspond au retour de la requ�te.
     * 			true si la requ�te s'est ex�cut�e correctement
     */
    public function update($table, $data, $cond) {
        $sql = "UPDATE  " . $table . " SET ";
        $virg = '';
        $champ = $this->getListeChamp($table);
        foreach ($data as $key => $value) :
            if (in_array($key, $champ)) :
                    $val = !get_magic_quotes_gpc() ? addslashes($value) : $value;
                    //$val = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;
                $sql .= is_numeric($val) ? $virg . $key . "=" . $val : $virg . $key . "='" . $val . "'";
                $virg = ', ';
            endif;
        endforeach;
        $sql .= $cond;
        //echo "<pre>$sql</pre>" ;
        try {
            $this->con = parent::beginTransaction();
           // echo $sql;
            $stmt = parent::prepare($sql);
            $ret = $stmt->execute();
            $this->con = parent::commit();
            $this->setOperator($sql) ;
            return $ret;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />' . $sql . '<br /><br />');
        }
    }

    // renvoie un tableau que l'on peux travailler avec count($result)...
    public function selectInTab($reqSelect) {
        try {
            /*/
              echo '<pre>'.$reqSelect.'</pre>' ;
              // */
            $this->con = parent::beginTransaction();
            $result = parent::prepare($reqSelect);
            $result->execute();
            /* Fabrication du tableau des r�sultats " */
            $resultat = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) :
                $resultat[] = $row;
            endwhile;
            $this->con = parent::commit();
            $this->setOperator($reqSelect) ;
            return $resultat;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�');
        }
    }

    // renvoie un tableau que l'on peux travailler avec count($result)...
    public function selectTableau($reqSelect) {
        try {
            $this->con = parent::beginTransaction();
            $result = parent::prepare($reqSelect);
            $result->execute();
            /* R�cup�ration de toutes les lignes d'un jeu de r�sultats "�quivalent � mysql_num_row() " */
            $resultat = $result->fetchAll();
            $this->con = parent::commit();
            $this->setOperator($reqSelect) ;
            return $resultat;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requète', 'Votre requète a été abandonnée');
        }
    }


    // renvoie un tableau que l'on peux travailler avec count($result)...
    public function delete($table, $cond) {
        $sql = "DELETE FROM  " . $table . " $cond";
        // Attention: NE PAS VIDER LES TABLES
        try {
            $this->con = parent::beginTransaction();
            $stmt = parent::prepare($sql);
            $ret = $stmt->execute();
            $this->con = parent::commit();
            $this->setOperator($sql) ;
            //echo $sql ;
            return $ret;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />' . $sql . '<br /><br />');
        }
    }
    public function getId($table, $cond = array()) {
        $c = " WHERE ";
        $and = " ";
        foreach ($cond as $k => $v) :
            $c .= "$and $k = '$v' ";
            $and = " AND ";
        endforeach;
        $sql = "SELECT id FROM $table $c";
        $r = $this->selectInTab($sql);
        if (count($r)):
            return $r[0]['id'];
        else:
            return 0;
        endif;
    }

    /**
     *
     * @param type $sql : requete à exécuter
     * @return type les résultats retourné par l'exécution de la requete
     */
    public function queryexec($sql) {
        // Attention: NE PAS utiliser en désordre car peut exécuter toute sorte de requête.
        //echo $sql ;
        try {
            $this->con = parent::beginTransaction();
            $stmt = parent::prepare($sql);
            $ret = $stmt->execute();
            $this->con = parent::commit();
            $this->setOperator($sql);
            return $ret;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />' . $sql . '<br /><br />');
        }
    }

    public function queryTransaction($tabquery = array()) {
        // Attention: NE PAS utiliser en désordre car peut exécuter toute sorte de requête.
        //echo $sql ;
        try {
            $this->con = parent::beginTransaction();
            foreach ($tabquery as $sql) :
                $stmt = parent::prepare($sql);
                $stmt->execute();
            endforeach;
            $this->con = parent::commit();
            //$this->setOperator($sql) ;
            return true ;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ�tte', 'Votre requ�te a �t� abandonn�<br /><br />');
            return false;
        }
    }
    public function istable($tablename) {
        try {
            $this->con = parent::beginTransaction();
            $result = parent::prepare("SHOW TABLES");
            $result->execute();
            $resultat = $result->fetchAll();
            $this->con = parent::commit();
            $res = array();
            foreach ($resultat as $value) :
                $res[] = $value[0];
            endforeach;
            $retour = in_array($tablename, $res) ? true : false ;
            return $retour ;
        } catch (Exception $e) {
            //On indique par email que la requ�te n'a pas fonctionn�.
            error_log(date('D/m/y') . ' � ' . date("H:i:s") . ' : ' . $e->getMessage() . "\n", 3, $this->errlogfile);
            $this->con = parent::rollBack();
            $message = new Message();
            $message->outPut('Erreur dans la requ&ecirc;tte', 'Votre requ&ecirc;te a &eacute;t&eacute; abandonn&eacute;e');
        }
    }

    /**
     * 	@m�thode retourne les champs d'une table<br />
     * 	@table dont on veut les colonnes
     *
     */
    public function getListeChamp($table) {
        $sql = "SHOW COLUMNS FROM $table";
        $champ = array();
        //return $result;
        $result = $this->select($sql);
        foreach ($result as $field) :
            $champ[] = $field['Field'];
        endforeach;
        return $champ;
    }

    /**
     * 	@m�thode retourne les champs d'une table<br />
     * 	@table dont on veut les colonnes
     *
     */
    public function getListeChampDetail($table) {
        $sql = "SHOW COLUMNS FROM $table";
        $result = $this->select($sql);
        foreach ($result as $field) :
            $champ[] = $field;
        endforeach;
        return $champ;
    }

    /**
     * 
     * Cette function permet la facilitation des archives.
     * @param type $sql : requete executée à sauvegarder dans la base de donn
     * 
     */
    private function setOperator(){
            if(isset($_SESSION['user'])):
                $this->operator= $_SESSION['user'] ;
            else :
                $this->operator = array('nom' => 'Guest',
                                        'prenom' => 'Guest',
                                        'id'    => 0
                                        ) ;
            endif;
            //$sqlite = explode('WHERE', $sql) ;
        //error_log(date('D/m/y') . ' a ' . date("H:i:s") . ' : ' . $sqlite[0] . " \npar l'utilisateur ".$this->operator['nom']."(".$this->operator['id'].")\n", 3, $this->archive);
    }
    // on change le type de base ici
    private function getDns() {
        return 'mysql:dbname=' . $this->db . ';host=' . $this->host;
    }

}
