<?php
namespace App\core;

use PDO;

abstract class BaseModel
{
    public $db;
    protected $table;
    
    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function create($data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $this->db->query($sql, $data);
        return $this->db->query("SELECT LAST_INSERT_ID() as id")->fetch()['id'];
    }
    
    public function update($id, $data)
    {
        $fields = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE {$this->table} SET $fields WHERE id = :id";
        $data['id'] = $id;
        return $this->db->query($sql, $data);
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->query($sql, ['id' => $id]);
    }
    
    public function find($id)
    {
        
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            // var_dump($sql);
            return $this->db->query($sql, ['id' => $id])->fetchAll();
        
       
    }
    public function get()
    {
      
        $sql = "SELECT * FROM {$this->table}";
        
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}
?>