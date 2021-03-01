<div class="alert alert-success alert-dismissable" style="border-radius:0px;margin: 0px <?= strtolower(trim($this->request->getParam('action'))) == 'login' ? '' : '0px' ?>;">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <i class="icon fa fa-check"></i>
    <?= h($message) ?>
</div>  

