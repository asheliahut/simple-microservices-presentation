<?php
// Routes
$app->get('/', 'DefaultController:indexAction');

$app->get('/users/{id:[0-9]+}', 'UserController:readUser');
$app->get('/users', 'UserController:readAllUsers');
$app->get('/users/{filter}/{value}', 'UserController:readAllUsersWithFilter');
$app->post('/users', 'UserController:createUser');
$app->put('/users/{id:[0-9]+}', 'UserController:updateUser');
$app->delete('/users/{id:[0-9]+}', 'UserController:deleteUser');


