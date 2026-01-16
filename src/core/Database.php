<?php
namespace App\core;
use PDO;
use PDOException;
class Database 
{
    private $pdo;
    public function __construct()
    {
        $host = 'localhost';
        $db = 'test';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options =
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try
        {
            $this -> pdo = new PDO($dsn,$user,$pass,$options);
        }
        catch (PDOException $e)
        {
            die("connecion perdue " . $e->getMessage());
        }
    }
    public function query($sql,$params = [])
    {
        $stmt = $this -> pdo -> prepare($sql);
        $stmt -> execute($params);
        return $stmt;
    }
}
?>