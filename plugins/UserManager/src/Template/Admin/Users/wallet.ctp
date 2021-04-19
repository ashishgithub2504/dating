<section class="content-header">
    <h1>
        <?= __('Manage User Wallet History') ?>  
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>

<section class="content" data-table="users"> 
    <div class="row users">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase"><?= __('Users Wallet History') ?></span></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>    
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('name', 'Plan Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('no_of_coin') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($userPlan)):
                                foreach ($userPlan as $i=>$user):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i+1) ?>.</td>
                                        <td>
                                            <?= $user['plan']['name']; ?>
                                        </td>
                                        <td>
                                            <?= $user['amount']; ?>  
                                        </td>
                                        <td>
                                            <?= $user['created']; ?>
                                        </td>
                                        <td>
                                            <?= $user['no_of_coin']; ?>
                                        </td>
                                        <td>
                                            <?= $user['status']; ?>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach;

                                ?>
                            <?php else: ?>
                                <tr> <td colspan='16' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
<?php endif; ?>
                        </tbody>
                    </table>

                </div>            


            </div>
        </div>
    </div>
</section>