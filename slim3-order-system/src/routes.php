<?php
// Routes
$app->get('/', 'DefaultController:indexAction');

$app->get('/orders/{id:[0-9]+}', 'OrderController:readOrder');
$app->get('/orders', 'OrderController:readAllOrders');
$app->get('/orders/{filter}/{value}', 'OrderController:readAllOrdersWithFilter');
$app->post('/orders', 'OrderController:createOrder');
$app->put('/orders/{id:[0-9]+}', 'OrderController:updateOrder');
$app->delete('/orders/{id:[0-9]+}', 'OrderController:deleteOrder');


