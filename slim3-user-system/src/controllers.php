<?php
// DIC configuration

$container = $app->getContainer();

// illuminate capsule
$container['UserController'] = function ($c) {
    return new UserSystem\Controllers\UserController;
};
