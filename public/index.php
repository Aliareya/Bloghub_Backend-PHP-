<?php
require_once(dirname(__FILE__) ."/../bootstrap/init.php");


use App\Routes\Routes;

$router = new Routes();

// مسیر ساده /users بدون کنترلر
$router->add('GET', '/users', function() {
    echo "This is the /users route!";
});

// مسیر با پارامتر /users/{id} بدون کنترلر
$router->add('GET', '/users/{id}', function($id) {
    echo "User ID is: $id";
});

// اجرای Router
$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


