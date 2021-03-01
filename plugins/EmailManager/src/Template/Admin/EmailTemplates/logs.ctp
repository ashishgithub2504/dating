<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emails
 */
use Cake\Core\Configure;
?>
<section class="content-header">
    <h1>
        <?= __('All Email logs') ?>  
        <small><?php echo __('Here you can manage the email logs'); ?></small>
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>
<section class="content">   
    <div class="row adminUsers">
        <div class="col-md-12">
            <div class="box box-info">
                <h3></h3>

                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase">List <?= __('Email logs') ?></span></h3>
                    
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email From</th>
                                <th><?= $this->Paginator->sort('email','Email To') ?></th>
                                <th><?= $this->Paginator->sort('template','Email Type') ?></th>
                                <th><?= $this->Paginator->sort('sent', 'Sent') ?></th>
                                <th><?= $this->Paginator->sort('send_tries') ?></th>
                                <th><?= $this->Paginator->sort('locked') ?></th>
                                <th><?= $this->Paginator->sort('send_at') ?></th>
                                <th><?= $this->Paginator->sort('created') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($emails->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($emails as $email):

                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td>
                                            <?php 
                                            if (!empty($email->from_email) && !empty($email->from_name)) {
                                                echo $email->from_email;
                                            }else{
                                                echo Configure::read('Setting.FROM_EMAIL');
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= h($email->email) ?>
                                        </td>
                                        <td><?= h($email->template) ?></td>
                                        <td><?= $email->sent == 1 ? "<span class=\"label label-success\">Email Sent</span>": "<span class=\"label label-danger\">Pending</span>" ?></td>
                                        <td><?= $email->send_tries ." time(s)" ?></td>
                                        <td><?= $email->locked == 1 ? "<span class=\"label label-danger\">Locked</span>": "N/A" ?></td>
                                       
                                     <td>
                                        <?php
                                        if ($email->send_at != "") {
                                            echo $email->send_at->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                        }

                                        ?>
                                    </td>
                                     <td>
                                        <?php
                                        if ($email->created != "") {
                                            echo $email->created->format($ConfigSettings['ADMIN_DATE_TIME_FORMAT']);
                                        }

                                        ?>
                                    </td>
                                        <td class="actions">
                                            <div class="form-group">
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'logView', $email->id], ['class' => 'btn btn-warning btn-sm btn-flat', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Email Log Preview'), 'title' => __('Email Log Preview')]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;

                                ?>
                            <?php else: ?>
                                <tr> <td colspan='11' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>            

                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>            

            </div>
        </div>
    </div>
</section>