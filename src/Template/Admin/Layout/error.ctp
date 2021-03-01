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
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            <?= Configure::read("Setting.SYSTEM_APPLICATION_NAME") ?>:
            <?= $this->fetch('title') ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php echo $this->Html->meta(Configure::read("Setting.MAIN_FAVICON"), 'img/uploads/settings/' . Configure::read("Setting.MAIN_FAVICON"), ['type' => 'icon']); ?>

        <?php
        echo $this->Html->css([
            '/assets/bower_components/bootstrap/dist/css/bootstrap.min', //Bootstrap 3.3.7
            '/assets/bower_components/font-awesome/css/font-awesome.min',
            '/assets/bower_components/Ionicons/css/ionicons.min', //Ionicons
            '/assets/dist/css/AdminLTE.min', //Theme style
            '/assets/dist/css/skins/_all-skins.min', //AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load.
            '/assets/bower_components/gritter/css/jquery.gritter.css', // sweet alert popup box
            '/assets/bower_components/ladda/dist/ladda.min.css', // button spine
            '/assets/plugins/jquery-confirm-master/css/jquery-confirm', // jquery confirm
            '/assets/bower_components/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css', // input checkbox or radio box switch
        ]);
        ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <script type="text/javascript">
            var baseurl = '<?php echo $this->request->webroot; ?>';
        </script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .form-inline form{ display: inline;}
            .error-occur{border: solid 1px #ff0000 !important;}
            .required label::after {
                color: #cc0000;
                content: "*";
                font-weight: bold;
                margin-left: 5px;
            }
        </style>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
        <div class="wrapper">
            <?php echo $this->element("header"); ?>
            <?php echo $this->element("sidebar"); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> <?php echo Configure::version(); ?>
                </div>
                <strong>Copyright &copy; <?php echo date("Y"); ?> <?php echo $this->Html->link(Configure::read("Setting.SYSTEM_APPLICATION_NAME"), ['controller' => 'dashboard', 'action' => 'index', "plugin" => false]); ?>.</strong> All rights reserved.
            </footer>
        </div>
        <?php
        echo $this->Html->script([
            '/assets/bower_components/jquery/dist/jquery.min', //jQuery 3
            '/assets/bower_components/jquery-ui/jquery-ui.min', //jQuery UI 1.11.4
            '/assets/bower_components/bootstrap/dist/js/bootstrap.min', //Bootstrap 3.3.7
            '/assets/bower_components/fastclick/lib/fastclick', //FastClick
            '/assets/dist/js/adminlte.min', //AdminLTE App
            '/assets/bower_components/ckeditor/ckeditor',
            '/assets/bower_components/gritter/js/jquery.gritter', // gritter notifications
            '/assets/bower_components/ladda/dist/spin.min.js', // button spin
            '/assets/bower_components/ladda/dist/ladda.min.js', // button spin
             '/assets/plugins/jquery-confirm-master/js/jquery-confirm', // jquery confirm
            '/assets/bower_components/bootstrap-switch-master/dist/js/bootstrap-switch', // input checkbox, radio
            '/js/admin/common', //common
        ]);
        ?>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <?php echo $this->fetch('script'); ?>
        <script>
            if (typeof (Storage) !== "undefined") {
                if (localStorage.getItem('sidBarClass') != null) {
                    $("body").addClass(localStorage.getItem('sidBarClass'));
                }
            }
            $(function () {
                $('input.switch-status')
                        .not('[data-switch-no-init]')
                        .bootstrapSwitch();
                $('[data-toggle="tooltip"]').tooltip();
            });
            $(".sidebar-toggle").on("click", function () {
                if (typeof (Storage) !== "undefined") {
                    if ($('body').hasClass('sidebar-collapse')) {
                        localStorage.removeItem('sidBarClass');
                        console.log("exist");
                    } else {
                        localStorage.setItem('sidBarClass', 'sidebar-collapse');
                        console.log("add class");
                    }
                }
            });
        </script>
    </body>
</html>
