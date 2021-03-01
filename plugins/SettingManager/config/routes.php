<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function ($routes) {
    $routes->plugin(
        'SettingManager', ['path' => '/setting-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

Router::prefix('api', function ($routes) {
    $routes->connect('/settings', ['controller' => 'Settings', 'action' => 'index', 'plugin' => 'SettingManager']);
    $routes->plugin(
        'SettingManager', ['path' => '/setting-manager'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});