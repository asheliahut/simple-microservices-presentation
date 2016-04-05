<?php
// Routes

$app->get('/users/{id}', 'UserController:readUser');
$app->get('/users', 'UserController:readAllUsers');
$app->get('/users/{filter}/{value}', 'UserController:readAllUsersWithFilter');
$app->post('/users', 'UserController:createUser');
$app->put('/users', 'UserController:updateUser');
$app->delete('/users/{id}', 'UserController:deleteUser');


