<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function ($routes) {
   $routes->connect('/categories/:action/*', ['controller' => 'Categories', 'plugin' => 'CategoryManager']);
    $routes->plugin(
        'CategoryManager', ['path' => '/category-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});
