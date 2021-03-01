<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function ($routes) {
    $routes->connect('/banners', ['controller' => 'Banners', 'action' => 'index', 'plugin' => 'BannerManager']);
    $routes->connect('/banners/:action/*', ['controller' => 'Banners', 'plugin' => 'BannerManager']);
    $routes->plugin(
        'BannerManager', ['path' => '/banner-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});