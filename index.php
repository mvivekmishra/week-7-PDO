<?php
/** User: vivekmishra */
//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);
define('DATABASE', 'vm368');
define('USERNAME', 'vm368');
define('PASSWORD', 'o2dwjU2Q');
define('CONNECTION', 'sql2.njit.edu');
class dbConn{
    //variable to hold connection object.
    protected static $db;
    //private construct - class cannot be instatiated externally.
    private function __construct() {
        try {
            // assign PDO object to db variable
            self::$db = new PDO( 'mysql:host=' . CONNECTION .';dbname=' . DATABASE, USERNAME, PASSWORD );
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			echo 'Answer for 1. connected successfully'."</br>"."<hr>";
			}
        catch (PDOException $e) {
            //Output error - would normally log this to error file rather than output to user.
            echo "Connection Error: " . $e->getMessage();
        }
    }
    // get connection function. Static method - accessible without instantiation
    public static function getConnection() {
        //Guarantees single instance, if no connection object exists then create one.
        if (!self::$db) {
            //new connection object.
            new dbConn();
        }
        //return connection.
        return self::$db;
    }
}
class collection {
    static protected $table;
    static protected $modelClass;
    protected $records;
	protected $recordall;
	static private function setTable()
    {
        self::$table;
    }
    static protected function loadCollection() {
        $db = dbConn::getConnection();
        $table = self::$table;
        $class = self::$modelClass;
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM $table");
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        $stmt->execute();
        $recordall = $stmt->fetchAll();
        //return $recordall;
		//echo 'Answer for 3 A.';
		//print_r($recordall);
		echo " <hr>";
		
    }
    
	Static protected function loadnewCollection(){
		$db=dbConn::getConnection();
		$table= self::$table;
		$class= self::$modelClass;
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$stmt=$db->prepare("SELECT * FROM $table where id<'6'");
		$stmt->setFetchMode(PDO::FETCH_CLASS, $class);
	    $stmt->execute();
		$records= $stmt->fetchAll();
		echo 'Answer for 2. ';
		include 'htmltable.php';
		//return $records;
		//print_r($records);
	}
}
	
	
class accounts extends collection {
    public function __construct()
    {
        collection::$table = 'accounts';
        collection::$modelClass = 'account';
        $records=self::loadnewCollection();
        $this->records = $records;
		$recordall = self::loadCollection();
		$this->recordall=$recordall;
		
		
		
    }
}
class model {
    public static function save(){
        //this is a generic save method
    }
    public static function loadModel() {
        //method to load model
    }
}
class account extends model {
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;
    public function __construct($id =null)
    {
        if(!is_null($id)) {
            //load the record using the ID
        }
    }
}
class todo {}
$accounts = new accounts();
//$todos = new todos();
//print_r($todos);
//print_r($accounts);


?>
