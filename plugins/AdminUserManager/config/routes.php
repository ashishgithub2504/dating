<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('api', function ($routes) {
	$routes->connect('/adminuser', ['controller' => 'AdminUsers', 'action' => 'index', 'plugin' => 'AdminUserManager']);
    $routes->connect('/adminuser/:action/*', ['controller' => 'AdminUsers', 'plugin' => 'AdminUserManager']);
    $routes->plugin(
        'AdminUserManager', ['path' => '/admin-user-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    });
});

Router::prefix('admin', function ($routes) {
    $routes->connect('/adminuser', ['controller' => 'AdminUsers', 'action' => 'index', 'plugin' => 'AdminUserManager']);
    $routes->connect('/adminuser/:action/*', ['controller' => 'AdminUsers', 'plugin' => 'AdminUserManager']);
    $routes->plugin(
        'AdminUserManager', ['path' => '/admin-user-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    });
});

