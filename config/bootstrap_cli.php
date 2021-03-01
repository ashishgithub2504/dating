<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Core\Plugin;

/**
 * Additional bootstrapping and configuration for CLI environments should
 * be put here.
 */

// Set the fullBaseUrl to allow URLs to be generated in shell tasks.
// This is useful when sending email from shells.
//Configure::write('App.fullBaseUrl', php_uname('n'));

// Set logs to different files so they don't have permission conflicts.
Configure::write('Log.debug.file', 'cli-debug');
Configure::write('Log.error.file', 'cli-error');

use Cake\Event\Event;
use Cake\Event\EventManager;
EventManager::instance()->on(
    'Bake.beforeRender.Controller.controller', function (Event $event) {
    $view = $event->getSubject();
    $actions = [
        'index',
        'view',
        'add',
        'edit',
        'delete'
    ];
    if (str_replace(".", "", $view->viewVars['plugin']) == "BackEnd") {
        //$actions = array_merge($actions, ['hanuman']);
    }

    if (strtolower(str_replace("\\", "", $view->viewVars['prefix'])) == "admin") {
        $gA = ['changeFlag'];
        $actions = array_merge($actions, $gA);
        if ($view->viewVars['name'] == 'AdminUsers') {
            $ua = [
                'login',
                'logout',
            ];
            $actions = array_merge($ua, $actions);
        }
    } else {
        if ($view->viewVars['name'] == 'Users') {
            $ua = [
                'login',
                'logout',
            ];
            $actions = array_merge($ua, $actions);
        }
    }
    $view->viewVars['actions'] = $actions;
}
);
