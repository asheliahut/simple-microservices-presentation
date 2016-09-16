<?php

namespace UserSystem\Controllers;

class DefaultController
{
	public function indexAction($request, $response, $args)
        {
        	return $response->withJson(["success" => true, "message" => "This is the default route for our user system", "data" => ["isDefault" => true]]);
        }

}
