<?php
if (!isset($placeHolder)) {
    $placeHolder = 'Search keyword';
}
$q = '';
if (isset($this->request->query['q']) && $this->request->query['q'] != '') {
    $q = $this->request->query['q'];
}
?>
<div class="box box-primary box-solid">
    <div class="box-body">
        <div class="row">
            <?= $this->Form->create('Search', ['type' => 'get']); ?>
            <?= $this->Form->input('q', ['templates' => ['inputContainer' => '<div class="col-sm-4">{{content}}</div>'], 'value' => $q, 'class' => 'form-control', 'placeHolder' => $placeHolder, 'label' => false]); ?>
            <?php $this->Form->templates(['submitContainer' => '{{content}}']); ?>
            <?= $this->Form->submit('Search', ['class' => 'btn btn-primary btn-flat']); ?>
            <?= $this->Html->link('Reset', ['controller' => $ctrl, 'action' => 'index'], ['class' => 'btn btn-warning btn-flat']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
