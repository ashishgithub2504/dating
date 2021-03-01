<?php 
$this->layout = 'login-layout';
use Cake\Core\Configure;
?>
<div class="login-box-body">
     
    <p class="login-box-msg" style="padding-bottom: 5px;">Forgot Password ?</p>
    <p  style="padding-left: 15px;"><small>Enter your e-mail address below to reset your password.</small> </p>
    <?php echo $this->Form->create('AdminUser', ['type' => 'file']); ?>
    <div class="form-group has-feedback">
        <?php
        echo $this->Form->input('email', ["class" => "form-control",
            'type' => 'email',
            'placeholder' => 'Email',
            'label' => false,
            'required'=>true,
            'pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$'
        ]);
        ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="row">
        <div class="col-xs-4 pull-left">
            <?php echo $this->Html->link('Back', ['action' => 'login'], ['class' => 'btn btn-default btn-block btn-flat']); ?>
        </div><!-- /.col -->
        <div class="col-xs-4 pull-right">
            <?php echo $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div><!-- /.col -->
    </div>
    <?php echo $this->form->end(); ?>
    <br>
</div><!-- /.login-box-body -->