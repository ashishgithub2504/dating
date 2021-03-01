<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< First') ?>
        <?= $this->Paginator->prev('Previous') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Next') ?>
        <?= $this->Paginator->last('Last >>') ?>
    </ul>    
    <div>
        <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'); ?></div>
    <?php /* $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]); */ ?>
</div>