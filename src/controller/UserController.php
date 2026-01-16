<?php
namespace App\controller;

use App\core\BaseController;
use App\models\UserModel;
use App\core\Security;
use App\core\Validation;

class UserController extends BaseController
{
    public function profile($id)
    {
        $this->view('user', ['id' => $id, 'title' => 'User Profile']);
    }
    public function delete($id){
        $user = new UserModel();
        $user->delete($id);
        echo " user deleted successfuly !!";
    }
    public function all()
    {
        $user = new UserModel();
        $data = $user ->get();
        echo "list of users";
        var_dump($user);
        
    }
    
    public function register()
    {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<h3>Test CSRF:</h3>";
            $csrfValid = Security::verifyCSRF($_POST['csrf_token'] ?? '');
            echo "CSRF valide: " . ($csrfValid ? 'OUI' : 'NON') . "<br>";
            
            if (!$csrfValid) {
                die('CSRF token invalide');
            }
            
            echo "<h3>Test Clean:</h3>";
            $data = Security::clean($_POST);
            echo "<pre>" . print_r($data, true) . "</pre>";
            
            echo "<h3>Test Validation:</h3>";
            $isValid = Validation::validate($data, [
                'username' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
            
            if (!$isValid) {
                echo "Erreurs: <pre>" . print_r(Validation::getErrors(), true) . "</pre>";
                $this->view('login', ['errors' => Validation::getErrors()]);
                return;
            }
            
            echo "Validation: SUCCÈS<br>";
            
            echo "<h3>Test Hash Password:</h3>";
            $hash = Security::hashPassword($data['password']);
            echo "Hash créé: " . substr($hash, 0, 30) . "...<br>";
            $verifyOk = Security::verifyPassword($data['password'], $hash);
            echo "Vérification: " . ($verifyOk ? 'OUI' : 'NON') . "<br>";
            
            echo "<h3>Tous les tests passés!</h3>";
        } else {
            $this->view('login');
        }
    }
}
