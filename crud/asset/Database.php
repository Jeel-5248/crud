<?php
class Database
{
    public $username = 'root';
    public $password = 'evrig';
    public $host = '127.0.0.1:3306';
    public $dbname = 'product_management';
    public $connection;

    //make a connection

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    //add products  

    public function insertProduct($table, $array)
    {
        try {
            $keys = implode(",", array_keys($array));
            $values = implode(",", array_values($array));
            $sql = "INSERT INTO $table ($keys) VALUES ($values)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        // {
        //     try {
        //         $columns = implode(", ", array_keys($data));
        //         $placeholders = ":" . implode(", :", array_keys($data));
        //         $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        //         $stmt =$this->connection->prepare($sql);
        //         foreach ($data as $column => &$value) {
        //             $stmt->bindParam(":$column", $value);
        //         }
         
        //        echo '<br>Name<br>File: '. __FILE__.'<br>Line: '.__LINE__.'<br><pre>';print_r($stmt);echo '</pre>'; die();
            
        //         $stmt->execute();
        //         return $this->connection->lastInsertId();
        //     } catch (PDOException $e) {

        //         return $e->getMessage();
        //     }
        // }
    }

    //get productss

    public function getProductData($fields, $table, $condition = null)
    {
        $sql = "SELECT $fields FROM $table $condition";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $res = $stmt->fetchAll();
        return $res;
    }

    //update products

    public function updateProduct($table, $array, $condition)
    {
        try {
            $value2 = array();
            $params = array();
            foreach ($array as $key => $value) {
                array_push($value2, "$key=:$key");
                $params[":$key"] = $value;
            }
            $datavalue = implode(',', $value2);
            $sql = "UPDATE $table SET $datavalue $condition";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    //delete products

    public function deleteProductData($table, $condition)
    {
        try {
            $sql = "DELETE FROM $table $condition";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
