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
}