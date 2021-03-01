<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/*
 * Routing for admin section
 */
Router::prefix('admin', function ($routes) {
	$routes->connect('/contact-us', ['plugin' => 'ContactManager', 'controller' => 'Inquiries', 'action' => 'index']);
	$routes->plugin(
            'ContactManager', ['path' => '/contact-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

/*
 * Routing for front section
 */
Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/contact-us', ['plugin' => 'ContactManager', 'controller' => 'Inquiries', 'action' => 'index']);
});
