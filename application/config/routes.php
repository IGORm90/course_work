<?php

return [
    //MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    
    'main/index/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],

    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
    ],
    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],


    //AdminController

    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],

    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],

    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],

    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],

    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],

    'admin/posts/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'posts',
    ],
    
	'admin/posts' => [
		'controller' => 'admin',
		'action' => 'posts',
    ],
    
    // AccountController
	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
    ],
    
	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],

	'account/profile' => [
		'controller' => 'account',
		'action' => 'profile',
	],
	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
    ],
    
    'account/rating' => [
        'controller' => 'account',
		'action' => 'rating',
    ],

	
];