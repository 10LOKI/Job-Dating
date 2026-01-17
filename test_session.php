<?php
require_once 'src/core/session.php';

use App\core\Session;

$session = Session::getInstance();

// Test actions based on URL parameter
$action = $_GET['action'] ?? 'show';

switch ($action) {
    case 'set':
        $session->set('test_key', 'Hello World!');
        $session->set('user_id', 123);
        echo "Session data set!<br>";
        break;
        
    case 'flash':
        $session->flash('message', 'This is a flash message!');
        echo "Flash message set!<br>";
        break;
        
    case 'clear':
        $session->clear();
        echo "Session cleared!<br>";
        break;
        
    case 'destroy':
        $session->destroy();
        echo "Session destroyed!<br>";
        break;
}

// Always show current session data
echo "<h3>Current Session Data:</h3>";
echo "<pre>" . print_r($session->all(), true) . "</pre>";

// Show flash message if exists
$flashMsg = $session->flash('message');
if ($flashMsg) {
    echo "<div style='color: green;'>Flash: $flashMsg</div>";
}

// Test links
echo "<hr>";
echo "<a href='?action=set'>Set Data</a> | ";
echo "<a href='?action=flash'>Set Flash</a> | ";
echo "<a href='?action=show'>Show Data</a> | ";
echo "<a href='?action=clear'>Clear Session</a> | ";
echo "<a href='?action=destroy'>Destroy Session</a>";
?>