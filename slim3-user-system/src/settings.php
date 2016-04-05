<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        
        // Monolog settings
        'logger' => [
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
