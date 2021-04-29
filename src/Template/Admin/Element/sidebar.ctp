<?php
$session = $this->request->getSession();
$authData = $session->read('Auth.Admin');
$userdir = isset($userdir) ? $userdir : "";
$act = $this->request->getParam('action');
$ctrl = strtolower($this->request->getParam('controller'));
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
      
        <!-- search form -->
       
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo (($act == "index") && $ctrl == "dashboard") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>", ["controller" => "dashboard", "action" => "index", "plugin" => null], ["class" => "", "escape" => false]);
                ?>
            </li>
            
            <?= $this->fetch('sidebar') ?>
            
         <li class="treeview <?php echo $custs = (in_array($act, array("index", "add", "edit", "view", 'profile', 'patient', 'doctor')) && (in_array($ctrl, array("adminusers", "admin-users", "users")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-user"></i> <span>Users</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $custs == "active" ? "menu-open" : ""; ?>">
                    <!-- <li class="<?php echo (in_array($act, array("index", "add", "edit", "view", "profile")) && $ctrl == "adminusers") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Admin Users", ["controller" => "AdminUsers", "action" => "index", "plugin" => 'AdminUserManager'], ["class" => "", "escape" => false]);
                        ?>
                    </li> -->
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view", "profile")) && $ctrl == "users") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Website Users", ["controller" => "Users", "action" => "index", "plugin" => 'UserManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                </ul>
            </li>
            
            <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "plans") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Plan Manager", ["controller" => "plans", "action" => "index", "plugin" => false], ["class" => "", "escape" => false]);

                ?>
            </li>

            <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "gifts") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Gift Manager", ["controller" => "gifts", "action" => "index", "plugin" => false], ["class" => "", "escape" => false]);

                ?>
            </li>

            <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "playwins") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Playwin Manager", ["controller" => "playwins", "action" => "index", "plugin" => false], ["class" => "", "escape" => false]);

                ?>
            </li>

            <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "coupons") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Coupon Manager", ["controller" => "coupons", "action" => "index", "plugin" => false], ["class" => "", "escape" => false]);

                ?>
            </li>

            <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "categories") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Category Manager", ["controller" => "categories", "action" => "index", "plugin" => false], ["class" => "", "escape" => false]);

                ?>
            </li>

             <li class="treeview <?php echo $cms = (in_array($act, array("index", "add", "view")) && (in_array($ctrl, array("pages", "modules", "navigations")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-th"></i> <span>CMS Manager</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $cms == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "pages") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> CMS Pages", ["controller" => "Pages", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "modules") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Modules", ["controller" => "Modules", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li> 
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "navigations") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i>  Navigation Menu", ["controller" => "Navigations", "action" => "index", "plugin" => 'CmsManager'], ["class" => "", "escape" => false]);

?>
                    </li>

                </ul>
            </li>
            

            
            
         <!--  <li class="treeview <?php echo $active = (in_array($act, array("index", "add", "edit", "view","logs","queueLogs","logView")) && (in_array($ctrl, array("emailhooks", "emailpreferences", "emailtemplates","queue","queuedjobs")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-envelope-o"></i> <span>Email Templates</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $active == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "emailhooks") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Hooks (slugs)", ["controller" => "EmailHooks", "action" => "index", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>

                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "emailpreferences") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Email Preferences (Layouts)", ["controller" => "EmailPreferences", "action" => "index", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit", "view")) && $ctrl == "emailtemplates") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Email Templates", ["controller" => "EmailTemplates", "action" => "index", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

?>
                    </li>
                    
                     <li class="<?php echo (in_array($act, array("logs")) && $ctrl == "emailtemplates") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> All Email Logs", ["controller" => "EmailTemplates", "action" => "logs", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

?>
                    </li>
                    
                    <li class="<?php echo (in_array($act, array("queueLogs",'logView')) && $ctrl == "emailtemplates") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Queue Logs", ["controller" => "EmailTemplates", "action" => "queueLogs", 'plugin' => 'EmailManager'], ["class" => "", "escape" => false]);

?>
                    </li>
                    
                     <li class="<?php echo (in_array($act, array("index",'logView')) && ($ctrl == "queue" || $ctrl == "queuedjobs")) ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Main Queue", ['controller' => 'Queue', 'action' => 'index', 'plugin' => 'Queue'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                   

                </ul>
            </li>-->
            
            
             <li class="treeview <?php echo $menu = (in_array($act, array("index", "add", "logos", "options", "social", "themeOptions", "smtp")) && (in_array($ctrl, array("settings")))) ? "active" : ""; ?>"> <a href="#"> <i class="fa fa-fw fa-cog"></i> <span>Settings</span> <span class="pull-right-container"> <i class="fa fa-angle-right pull-right"></i> </span> </a>
                <ul class="treeview-menu <?php echo $menu == "active" ? "menu-open" : ""; ?>">
                    <li class="<?php echo (in_array($act, array("logos")) && $ctrl == "settings") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Logo/Fav icon", ["controller" => "Settings", "action" => "logos", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("index", "add", "edit")) && $ctrl == "settings") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> General Setting", ["controller" => "Settings", "action" => "index", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("smtp")) && $ctrl == "settings") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> SMTP Detail", ["controller" => "settings", "action" => "smtp", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

                        ?>
                    </li>
                    <li class="<?php echo (in_array($act, array("social")) && $ctrl == "settings") ? "active" : ""; ?>">
<?php
echo $this->Html->link("<i class=\"fa fa-circle-o\"></i> Social Links", ["controller" => "settings", "action" => "social", "plugin" => 'SettingManager'], ["class" => "", "escape" => false]);

?>
                    </li>
                </ul>
            </li> 
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
