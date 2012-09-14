<?php
/*
 * @version 1.3
 * @since 2011-07-05
*/
class MyPDO extends \PDO {
	
	private $query		= null;
	private static $instance;
	

    private function MyPDO() {
    	try {
    		/*
    		Pour tester le singleton
			$fileDest = "log.txt";
			$hd = fopen ($fileDest, "w+") or die ("Cannot open $fileDest");
			fwrite($hd, 'a');
			fclose($hd);
			*/

    		parent::__construct(DB_BASE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, array(1002 => 'SET NAMES utf8'));
    		
    	}
    	catch(PDOException $e) {
    		throw new MyException($e->getMessage());
    	}
    }
    
	/**
	 * Regarde si un objet connexion a déjà été instancier,
	 * si c'est le cas alors il retourne l'objet déjà existant
	 * sinon il en créer un autre.
	 * @return $instance
	*/
	public static function getInstance() {
		if (!self::$instance instanceof self) {
			self::$instance = new self;
		}
		
		return self::$instance;
	}
    
    /**
     * @author yoann
     * @param	$query		String	Requete ex: "SELECT * FROM places WHERE name = :name AND address = :address;"
     * @param	$arrayVal	Array	Tableau des valeurs ex: array( 'name' => $name, 'address' => $address )
     */
	public function select($query, $arrayVal=array(), $mode=PDO::FETCH_OBJ) {
		return $this->selectOne($query, $arrayVal, $mode);
    }
    public function selectOne($query, $arrayVal=array(), $mode=PDO::FETCH_OBJ) {
		$this->query = parent::prepare($query);
		$this->query->execute($arrayVal);
		$this->catchError();
		
		$res = array();
		if( is_object($this->query) )
			$res = $this->query->fetch($mode);
		$this->query->closeCursor();
		
		return $res;
    }
    
    public function selectAll($query, $arrayVal=array(), $mode=PDO::FETCH_OBJ) {
    	$this->query = parent::prepare($query);
		$this->query->execute($arrayVal);
		$this->catchError();
		
		$res = array();
		if( is_object($this->query) )
			$res = $this->query->fetchAll($mode);
		$this->query->closeCursor();
		
		return $res;
    }
	
	public function selectAllForPagination($query, $arrayVal=array(), $mode=PDO::FETCH_OBJ) {
    	// Query format
		$select_pos	= strripos($query, 'select') + 7;
		$query		= substr($query, 0, $select_pos) . ' SQL_CALC_FOUND_ROWS ' . substr($query, $select_pos, strlen($query));
		
		
		$this->query = parent::prepare($query);
		$this->query->execute($arrayVal);
		$this->catchError();
		
		$res = array();
		if( is_object($this->query) )
			$res = $this->query->fetchAll($mode);
		
		// Count
		$count = !is_object($this->query)? 0:$this->query("SELECT FOUND_ROWS() count;")->fetch(PDO::FETCH_OBJ)->count;
				
		$this->query->closeCursor();
		
		return array( 'res' => $res, 'count' => $count );
    }
    
	
	/*
	 * @author yoann
	 * Force catch error 
	*/
    public function catchError($query=null) {
    	$error = (!empty($this->query))? $this->query->errorInfo():$query->errorInfo();
    	if(count($error)>2 and $error[2] != '')
			throw new MyException($error[2]);
    }
	
	
	/*
	 * @author yoann
	 * @since 23/12/2010
	 * return the query (For debugging)
	*/
    public function getQuery() {
    	return $this->query->queryString;
    }
    
}