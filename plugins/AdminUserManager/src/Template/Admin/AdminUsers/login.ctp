<?php

use Cake\Core\Configure;

$this->layout = 'login-layout';
?>
<div class="login-box">

     <!-- /.login-logo -->
    <?= $this->Flash->render(); ?>
    <div class="login-box-body">

        <p class="login-box-msg">Sign in to start your session</p>

        <?php
        echo $this->Form->create(NULL, ['autocomplete' => 'off','valueSources' => ['query', 'data']]); ?>
        <div class="form-group has-feedback">
            <?php
            echo $this->Form->control('email', ["class" => "form-control",
                'type' => 'email',
                'placeholder' => 'Email',
                'autocomplete' => 'off',
                'label' => false,
                'required' => true,
                'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$'
            ]);
            ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?php
            echo $this->Form->control('password', [
                "class" => "form-control",
                'type' => 'password',
                'placeholder' => 'Password',
                'autocomplete' => 'off',
                'label' => false,
                'required' => true
            ]);
            ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <?= $this->Form->checkbox('adminremember_me'); ?>  
                        Remember Me
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?php echo $this->Form->button('Sign In', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
            </div>
            <!-- /.col -->
        </div>
        <?php echo $this->form->end(); ?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <?php echo $this->Html->link("Forgot Password ?", ['controller' => 'AdminUsers', 'action' => 'forgot']); ?>
        </div>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

