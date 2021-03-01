<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function ($routes) {
    $routes->plugin(
        'CmsManager', ['path' => '/cms-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

Router::prefix('api', function ($routes) {
    $routes->connect('/page/:slug/', ['controller' => 'Pages','action'=>'view','plugin'=>'CmsManager'], ['pass' => ['slug'], 'slug' => '[a-zA-Z0-9_-]+']);
    $routes->connect('/navigations', ['controller' => 'Navigations', 'action' => 'index', 'plugin' => 'CmsManager']);
    $routes->connect('/navigations/:action/*', ['controller' => 'Navigations', 'plugin' => 'CmsManager']);
    $routes->plugin(
        'CmsManager', ['path' => '/cms-manager'], function (RouteBuilder $routes) {
        $routes->resources('Pages');
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

Router::connect('/page/:slug/', ['controller' => 'Pages', 'action' => 'detail','plugin'=>'CmsManager'], ['pass' => ['slug'], 'slug' => '[a-zA-Z0-9_-]+']);

Router::plugin(
    'CmsManager', ['path' => '/cms-manager'], function (RouteBuilder $routes) {
    $routes->fallbacks(DashedRoute::class);
}
);
