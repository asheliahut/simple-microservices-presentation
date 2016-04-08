<?php
// DIC configuration

$container = $app->getContainer();

// illuminate capsule
$container['UserController'] = function ($c) {
    $userTable = $c->get('capsule')->getConnection('userConnection')->table("Users");
    return new UserSystem\Controllers\UserController($userTable);
};
