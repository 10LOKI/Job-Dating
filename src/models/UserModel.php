<?php
namespace App\models;
use App\core\BaseModel;

class UserModel extends BaseModel
{
    protected  $table = "users";

    public function getAllUsers()
    {
        return $this -> db -> query("SELECT * FROM users") -> fetchAll();
    }
    public function findUser($id)
    {
        return $this -> db -> query("SELECT * FROM users WHERE id = ?",[$id]) -> fetch();
    }
}
?>