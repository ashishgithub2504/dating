<?php
use Cake\Core\Configure;
?>
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
<?php echo $this->Html->image(Configure::read('Setting.MAIN_FAVICON'), ["alt" => "logo", "style" => "height:38px;"]); ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
<?php echo $this->Html->image(Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => "max-height:40px; max-width:200px;"]); ?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('/assets/dist/img/user2-160x160.jpg',['class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Rohan sharma
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('/assets/dist/img/user3-128x128.jpg',['class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Shalini
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        
                        <?php echo $this->Html->image('/assets/dist/img/user4-128x128.jpg',['class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Kirti nagar
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('/assets/dist/img/user3-128x128.jpg',['class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Anushri yaday
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <?php echo $this->Html->image('/assets/dist/img/user2-160x160.jpg',['class' => 'img-circle']); ?>
                      </div>
                      <h4>
                        Pankaj jain
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

            <?php if (!empty($authData)) { ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <?php
                            if (!empty($authData['profile_photo']) && file_exists("img/".$authData['profile_photo'])) {
                                echo $this->Html->image($authData['profile_photo'], ["class" => "user-image", "style" => "max-height:100px;"]);
                            } else {
                                echo $this->Html->image("no_image.gif", ["class" => "user-image"]);
                            }
                            ?>
                            <span class="hidden-xs">
    <?php echo $authData['name']; ?>
                            </span> </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-left"> <?php echo $this->Html->link('<i class="fa fa-fw fa-user"></i> Profile', array("controller" => "AdminUsers", "action" => "profile", "plugin" => 'AdminUserManager'), array("class" => 'btn btn-default btn-flat', "escape" => false)); ?> </div>
                                <div class="pull-right"> <?php echo $this->Html->link('<i class="fa fa-key"></i> Sign Out', array("controller" => "AdminUsers", "action" => "logout", "plugin" => 'AdminUserManager'), array("class" => 'btn btn-default btn-flat', "escape" => false)); ?> </div>
                            </li>
                        </ul>
                    </li>
<?php } ?>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>