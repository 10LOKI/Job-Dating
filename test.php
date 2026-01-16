<?php
require_once __DIR__ . '/vendor/autoload.php';

$userModel = new \App\models\UserModel();
$data = [
    'name' => 'Oussama'
];
// $users = $userModel -> create($data);
// $users = $userModel -> update(1,$data);
// $users = $userModel -> delete(0);
$users = $userModel -> getAllUsers();
echo "<pre>";
print_r($users);
echo "</pre>";
?>
