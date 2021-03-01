<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailTemplate
 */
$backUrl = $this->request->referer() ? $this->request->referer() : ['action' => 'logs'];

?>
<section class="content-header">
    <h1>
        <?php echo __('Email Log Preview'); ?>  <small>View email content preview</small>
    </h1>
    <?php echo $this->element('breadcrumb'); ?>
</section>

<section class="content" data-table="emailTemplates">
    <div class="box">
        <div class="box-header">
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), $backUrl, ['class' => 'btn btn-default pull-right', 'title' => __('Back'), 'escape' => false]); ?>
        </div>

        <div class="box-body">

            <table class="table table-hover table-striped">
                <tr>
                    <th scope="row"><?= __('From') ?></th>
                    <td><?php
                        if (!empty($email->from_email) && !empty($email->from_name)) {
                            echo $email->from_email;
                        } else {
                            echo \Cake\Core\Configure::read('Setting.FROM_EMAIL');
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?= __('To') ?></th>
                    <td><?= h($email->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email Type') ?></th>
                    <td><?= h($email->template) ?></td>
                </tr>

                <tr>
                    <th scope="row"><?= __('Email Sent') ?></th>
                    <td><?= $email->sent == 1 ? "<span class=\"label label-success\">Email Sent</span>" : "<span class=\"label label-danger\">Pending</span>" ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Send tries') ?></th>
                    <td><?= $email->send_tries . " time(s)" ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Locked') ?></th>
                    <td><?= $email->locked == 1 ? "<span class=\"label label-danger\">Locked</span>" : "N/A" ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Send At') ?></th>
                    <td>
                        <?php
                        if ($email->send_at != "") {
                            echo $email->send_at->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td>
                        <?php
                        if ($email->created != "") {
                            echo $email->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td>
                        <?php
                        if ($email->created != "") {
                            echo $email->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                        }

                        ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
    
      <div class="box">
        <div class="box-header">
            <h3 class="box-title"><span class="caption-subject font-green bold uppercase"><strong>Subject:</strong> <?= $messageTemplate['subject'] ?></span></h3>
            <hr>
            
        </div>

        <div class="box-body">

            <?= $messageTemplate['message'] ?>
            
        </div>
    </div>
</section>
