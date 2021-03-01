<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/users', ['controller' => 'Users', 'action' => 'index', 'plugin' => 'UserManager']);
    $routes->connect('/users/:action/*', ['controller' => 'Users','plugin'=>'UserManager']);
    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admin', function ($routes) {
    $routes->connect('/users', ['controller' => 'Users', 'action' => 'index', 'plugin' => 'UserManager']);
    $routes->connect('/users/:action/*', ['controller' => 'Users','plugin'=>'UserManager']);
    $routes->plugin(
        'UserManager', ['path' => '/user-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

Router::prefix('api', function ($routes) {
    //$routes->connect('/users', ['controller' => 'Users', 'action' => 'index', 'plugin' => 'UserManager']);
    //$routes->connect('/users/:action/*', ['controller' => 'Users','plugin'=>'UserManager']);
    $routes->plugin(
        'UserManager', ['path' => '/user-manager'], function (RouteBuilder $routes) {
        $routes->resources('Users');
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

Router::plugin(
    'UserManager', ['path' => '/user-manager'], function (RouteBuilder $routes) {
    $routes->fallbacks(DashedRoute::class);
}
);
