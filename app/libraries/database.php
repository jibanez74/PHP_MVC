<?php
/*
class for PDO and DB
1 - connect to db
2 - create a prepared statement for pdo
3 - bind all the values
4 - return rows and results
*/

class Database {
  //values from config.php
  private $host = DBHOST;
  private $user = DBUSER;
  private $db_password = DBPASSWORD;
  private $db_name = DBNAME;
  
  //database handlers
  private $dbh;
  //pdo statement
  private $stmt;
  //variable to hold any errors
  private $error;

  public function __construct () {
    //set the dsn
    $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    //create a pdo instance
    try{
      $this->dbh = new PDO($dsn, $this->user, $this->db_password, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error; 
    }
  }

  //prepare a statement to make queries
  public function query ($sql) {
    $this->stmt = $this->dbh->prepare($sql);
  }

  //bind values
  public function bind_values ($param, $value, $type = null) {
    if (is_null($type)) {
      switch (true) {
        case is_int ($value):
          $type = PDO::PARAM_INT;
          break;
      case is_bool ($value):
        $type = PDO::PARAM_BOOL;
        break;
      case is_null ($value):
        $type = PDO::PARAM_NULL;
        break;
      default:
        $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bind_values($param, $value, $type);
  }

  //execute the statement
  public function execute () {
    return $this->stmt->execute();
  }

  //get data as array
  public function result_set () {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  //get single record as object
  public function single () {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  } 

  //return row count
  public function row_count () {
    return $this->stmt->row_count();
  }
}