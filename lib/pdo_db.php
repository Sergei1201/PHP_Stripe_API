<?php
// Create Database Class with PDO
class Database
{
    // DB stuff
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;

    // PDO stuff
    private $dbh;
    private $error;
    private $stmt;

    // Contructor
    public function __construct()
    {
        // DSN
        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    // Prepare statement
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Bind params
    public function bind($param, $value, $type = null)
    {
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
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute statement
    public function execute()
    {
        $this->stmt->execute();
    }

    // Fetch all objects from DB
    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Fetch a single row as an object
    public function fetchSingle()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function getRowCount()
    {
        $this->execute();
        return $this->stmt->getRowCount();
    }

    // Get last ID
    public function getLastId()
    {
        $this->execute();
        return $this->stmt->getLastId();
    }
}
