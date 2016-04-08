<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        
        //Illuminate settings should really use remote 
        'capsule' => [
			'driver'    => 'mysql',
			'host'      => '172.17.42.1',
			'database'  => 'database',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => ''
		]
    ],
];
