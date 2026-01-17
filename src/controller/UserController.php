<?php
namespace App\controller;

use App\core\BaseController;
use App\models\UserModel;
use App\core\Security;
use App\core\Validation;
use App\core\Session;

class UserController extends BaseController
{
    public function profile($id)
    {
        $this->view('layout', ['id' => $id, 'title' => 'User Profile']);
    }
    public function delete($id){
        $user = new UserModel();
        $user->delete($id);
        echo " layout deleted successfuly !!";
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $testResults = "";
            
            // Test CSRF
            $testResults .= "<h4>Test CSRF:</h4>";
            $csrfValid = Security::verifyCSRF($_POST['csrf_token'] ?? '');
            $testResults .= "CSRF valide: " . ($csrfValid ? 'OUI' : 'NON') . "<br>";
            
            if (!$csrfValid) {
                $this->view('test-security.twig', ['errors' => ['csrf' => ['Token CSRF invalide']]]);
                return;
            }
            
            // Test Clean
            $testResults .= "<h4>Test Clean:</h4>";
            $data = Security::clean($_POST);
            $testResults .= "<pre>" . htmlspecialchars(print_r($data, true)) . "</pre>";
            
            // Test Validation
            $testResults .= "<h4>Test Validation:</h4>";
            $isValid = Validation::validate($data, [
                'username' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
            
            if (!$isValid) {
                $this->view('test-security.twig', [
                    'errors' => Validation::getErrors(),
                    'testResults' => $testResults,
                    'username' => $data['username'] ?? '',
                    'email' => $data['email'] ?? ''
                ]);
                return;
            }
            
            $testResults .= "Validation: SUCCÈS<br>";
            
            // Test Hash Password
            $testResults .= "<h4>Test Hash Password:</h4>";
            $hash = Security::hashPassword($data['password']);
            $testResults .= "Hash créé: " . substr($hash, 0, 30) . "...<br>";
            $verifyOk = Security::verifyPassword($data['password'], $hash);
            $testResults .= "Vérification: " . ($verifyOk ? 'OUI' : 'NON') . "<br>";
            
            // Test Session
            $testResults .= "<h4>Test Session:</h4>";
            Session::set('user', $data['username']);
            $testResults .= "Session set: user = " . Session::get('user') . "<br>";
            $testResults .= "Session has 'user': " . (Session::has('user') ? 'OUI' : 'NON') . "<br>";
            Session::flash('success', 'Test réussi!');
            $testResults .= "Flash message: " . Session::flash('success') . "<br>";
            
            $this->view('test-security.twig', [
                'success' => 'Tous les tests passés avec succès!',
                'testResults' => $testResults
            ]);
        } else {
            $this->view('test-security.twig');
        }
    }
}
