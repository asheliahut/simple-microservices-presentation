<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        
        //Illuminate settings should really use remote 
        'capsule' => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'database',
			'username'  => 'root',
			'password'  => 'passsword',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => ''
		]
    ],
];
