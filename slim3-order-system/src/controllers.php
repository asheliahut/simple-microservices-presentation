<?php
// DIC configuration

$container = $app->getContainer();

// illuminate capsule
$container['OrderController'] = function ($c) {
    $orderTable = $c->get('capsule')->getConnection('orderConnection')->table("Orders");
    return new OrderSystem\Controllers\OrderController($orderTable);
};
$container['DefaultController'] = function ($c) {
    return new OrderSystem\Controllers\DefaultController();
};
