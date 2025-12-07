<?php
class Database 
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;    // Database Handler
    private $stmt;   // Statement
    private $error;

    public function __construct() 
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try 
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } 
        catch (PDOException $e) 
        {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Chuẩn bị query
    public function query($sql) 
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind giá trị vào câu lệnh SQL
    public function bind($param, $value, $type = null) 
    {
        if (is_null($type)) 
        {
            switch(true) 
            {
                case is_int($value):  $type = PDO::PARAM_INT; break;
                case is_bool($value): $type = PDO::PARAM_BOOL; break;
                case is_null($value): $type = PDO::PARAM_NULL; break;
                default:              $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Thực thi SQL
    public function execute() 
    {
        return $this->stmt->execute();
    }

    // Trả nhiều dòng
    public function resultSet() 
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Trả 1 dòng
    public function single() 
    {
        $this->execute();
        return $this->stmt->fetch();
    }
    public function lastInsertId() 
    {
        return $this->dbh->lastInsertId();
    }

    // Lấy số lượng hàng (row count)
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}
