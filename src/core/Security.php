<?php

namespace App\core;

class Security
{
    public static function clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::clean($value);
            }
            return $data;
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
    public static function isAuth()
    {
        
    }
    public static function generateCSRF() {
        if(!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
      
        $token = $_SESSION['csrf_token'];
        return $token;
    }
    public static function verifyCSRF($token) {
        if(isset($_SESSION['csrf_token']))
            {
                return hash_equals($_SESSION['csrf_token'],$token);
            }
            return false;
    }
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
