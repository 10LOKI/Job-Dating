<?php
namespace App\controller;

use App\core\BaseController;
use App\models\UserModel;

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
}
