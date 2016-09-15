<?php

namespace OrderSystem\Controllers;

class DefaultController
{
	public function indexAction($request, $response, $args)
        {
        	return $response->withJson(["success" => true, "message" => "This is the default route", "data" => ["isDefault" => true]]);
        }

}
