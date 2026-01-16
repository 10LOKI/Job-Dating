<?php
use App\core\Security;

if (isset($errors)) {
    echo "<div style='color:red'><pre>" . print_r($errors, true) . "</pre></div>";
}
?>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= Security::generateCSRF() ?>">
    <input type="text" name="username" placeholder="Enter name">
    <input type="text" name="email" placeholder="Enter email">
    <input type="password" name="password" placeholder="veuillez saisir le password">
    <button type="submit">Submit</button>
</form>