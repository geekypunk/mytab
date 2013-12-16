<?php


include_once 'config/config.php.inc';
include_once 'DBConnectionInterface.php';
/**
 * Thus class implements DBConnectionInterface
 * Wrapper class on top of PHP PDO class
 * Used prepared statements to protect from SQL injections
 * The PDO driver automatically handles the security.
 */

class Database implements DBConnectionInterface{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;

    private $dbh; /* Holds PDO connection object*/
    private $error;
    private $stmt; /* Holds current set prepared statement*/

    /*
     * Constructor
     * */
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
            // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    /**
     * Sets the query SQL to the prepared statement object
     *
     * @param string $query Query SQL
     * @return void
     * */
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Bind the particular parameter to the prepared statement
     *
     * @param string $param Parameter name
     * @param string $value Parameter value
     * @param string $type Parameter type,Default value is null
     * @return void
     * */
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepared statement
     * @return void
     * */
    public function execute(){
        return $this->stmt->execute();
    }

    /**
     * For SELECT statements returning multiple rows
     *
     * @return array[] $array Returns all rows in the result set@return void
    */
    public function resultSet(){
        $this->execute();
        $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->stmt->closeCursor();
        return $result;
    }

    /**
     * For SELECT statements returning a single row
    *
    * @return array[] $array Returns a single row
    */
    public function single(){
         $this->execute();
		$result =  $this->stmt->fetch(PDO::FETCH_ASSOC);
		$this->stmt->closeCursor();
        return $result;
    }

    /**
     * Returns the number of rows in the resultset
     * @return void
     * */
    public function rowCount(){
        $result = $this->stmt->rowCount();
		$this->stmt->closeCursor();
        return $result;
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }


}
