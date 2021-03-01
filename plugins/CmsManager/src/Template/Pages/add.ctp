<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pages form large-9 medium-8 columns content">
    <?= $this->Form->create($page) ?>
    <fieldset>
        <legend><?= __('Add Page') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('sub_title');
            echo $this->Form->control('slug');
            echo $this->Form->control('short_description');
            echo $this->Form->control('description');
            echo $this->Form->control('banner');
            echo $this->Form->control('meta_title');
            echo $this->Form->control('meta_keyword');
            echo $this->Form->control('meta_description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
