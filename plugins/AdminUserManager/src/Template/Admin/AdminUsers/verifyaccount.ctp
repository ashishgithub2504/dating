<?php
$this->layout = 'login-layout';

use Cake\Core\Configure;

?>
<div class="login-box-body">

    <div class="login-box-body">
        <p class="login-box-msg">Create Your password ?</p>
        <?php
        $myTemplates = [
            'inputContainerError' => '<div class="input {{type}}{{required}} has-error">{{content}}{{error}}</div>',
            'error' => '<div class="text-danger">{{content}}</div>',
        ];
        $this->Form->setTemplates($myTemplates);
        echo $this->Form->create($adminUser, ['context' => ['validator' => 'Resetpassword']]);

        ?>
        <div class="form-group has-feedback">
            <?php
            echo $this->Form->control('password', ["class" => "form-control",
                'type' => 'password',
                'placeholder' => 'Password',
                'label' => false,
                'value' => ($this->request->getData('password') != "") ? $this->request->getData('password') : '',
            ]);

            ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?php
            echo $this->Form->control('confirm_password', ["class" => "form-control",
                'type' => 'password',
                'placeholder' => 'Confirm Password',
                'label' => false,
            ]);

            ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">

            <div class="col-xs-6 pull-right">
                <?php echo $this->Form->button('Create Password', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
            </div><!-- /.col -->
        </div>
        <?php echo $this->form->end(); ?>
        <br>
    </div><!-- /.login-box-body -->
</div>