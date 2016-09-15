<?php
// DIC configuration

$container = $app->getContainer();

// illuminate capsule
$container['capsule'] = function ($c) {
    $settings = $c->get('settings')['capsule'];
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings, "orderConnection");
    return $capsule;
};
