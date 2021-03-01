<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;

$cakeDescription = Configure::read("Setting.SYSTEM_APPLICATION_NAME");

?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            <?= $cakeDescription ?>
            :
            <?= $this->fetch('title') ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php echo $this->Html->meta('img/' . Configure::read("Setting.favicon"), 'img/' . Configure::read("Setting.favicon"), ['type' => 'icon']); ?>
        <?php
        echo $this->Html->css([
            '/assets/bower_components/bootstrap/dist/css/bootstrap.min',
            '/assets/bower_components/font-awesome/css/font-awesome.min',
            '/assets/Ionicons/css/ionicons.min',
            '/assets/dist/css/AdminLTE.min',
            '/assets/plugins/iCheck/square/blue']);

        ?>

        <?= $this->fetch('meta') ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <?php
                echo $this->Html->image(Configure::read("Setting.MAIN_LOGO"), ["class" => "logo-default", "alt" => Configure::read("Setting.TITLE"), "height" => 45]);

                ?>
            </div>
            <?= $this->Flash->render(); ?>
            <?= $this->fetch('content') ?>
        </div>
        <?php
        echo $this->Html->script([
            '/assets/bower_components/jquery/dist/jquery.min',
            '/assets/bower_components/bootstrap/dist/js/bootstrap.min',
            '/assets/plugins/iCheck/icheck.min',
        ]);

        ?>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>				
        <?= $this->fetch('script') ?>
    </body>
</html>
