<?php
namespace App\core;
class Security
{
    public function generateCSRF()
    {

    }
    public function verifyCSRF()
    {

    }
    public static function clean($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data,ENT_QUOTES,'UTF-8');
    }
    public function validateEmail()
    {

    }
    public function validatePassword()
    {

    }
    public function hashPassword()
    {

    }
    public function verifyPassword()
    {
        
    }
    public static function isAuth()
    {
        return isset($_SESSION['user_id']);
    }
}
?>