<?php

$router = $di->getRouter();

//default route
$router->add('/', ['controller' => 'index', 'action' => 'index']);

// Define your routes here
$router->add('/user/login', ['controller' => 'user', 'action' =>'login']);
$router->add('/user/login/submit', ['controller' => 'user', 'action' => 'loginSubmit']);
$router->add('/user/register', ['controller' => 'user', 'action' => 'register']);
$router->add('/user/register/submit', ['controller' => 'user', 'action' => 'registerSubmit']);
$router->add('/user/profile', ['controller' => 'user', 'action' => 'profile']);
$router->add('/user/logout', ['controller' => 'user', 'action' => 'logout']);

//Artikel
$router->add('/tambah/artikel',['controller' => 'artikel', 'action' => 'tambah']);
$router->add('/artikel/tambah/simpan',['controller' => 'artikel', 'action' => 'tambahSimpan']);

$router->handle();
