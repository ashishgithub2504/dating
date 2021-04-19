<section class="content-header">
    <h1>
        <?= __('Manage User Call History') ?>  
    </h1>
    <?= $this->element('breadcrumb') ?>
</section>

<section class="content" data-table="users"> 
    <div class="row users">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><span class="caption-subject font-green bold uppercase"><?= __('Users Call History') ?></span></h3>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>    
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col"><?= $this->Paginator->sort('first_name', 'User Name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('start_time') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('end_time') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($callInfo)):
                                foreach ($callInfo as $i=>$user):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i+1) ?>.</td>
                                        <td>
                                            <?= $user['Users']['username']; ?>
                                        </td>
                                        <td>
                                            <?= $user['type']; ?>  
                                        </td>
                                        <td>
                                            <?= $user['start_time']; ?>
                                        </td>
                                        <td>
                                            <?= $user['end_time']; ?>
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