<?php
/**
 * @var \App\View\AppView $this
 */
 $this->layout = 'login-layout';
?>
<div class="login-box">
<?= $this->Flash->render('auth') ?>
    <div class="login-box-body">
<?php
        $this->loadHelper('Form', [
            'templates' => 'default_form',
        ]);

        ?>
    <?= $this->Form->create() ?>
        <p class="login-box-msg"><?= __('Sign in to start your session') ?></p>
    <fieldset>
        <?= $this->Form->control('email',["class" => "form-control"]) ?>
        <?= $this->Form->control('password',["class" => "form-control"]) ?>
    </fieldset>
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
                <?= $this->Form->button(__('Login'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
            </div>
            <!-- /.col -->
        </div>
    <div class="social-auth-links text-center">
            <p>- OR -</p>
            <?php echo $this->Html->link("Forgot Password ?", ['action' => 'forgot']); ?>
        </div>
    
    <?= $this->Form->end() ?>
    </div>
</div>
